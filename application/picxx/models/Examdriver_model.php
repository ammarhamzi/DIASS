<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examdriver_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('general_helper');
    }

    private function check_credentials($credential) 
    {
        // Later check session am/pm if examonly
        $today = date('Y-m-d');
        /*$this->db->select('
            permit.*, 
            driver.driver_id,
            examtaker.examtaker_id,
            examtaker.examtaker_exammanagement_id,
            examtaker.examtaker_examonlymanagement_id,
            m.examonlymanagement_session session_booked,
            CASE WHEN DATEPART(HOUR, GETDATE()) BETWEEN 0 AND 11 THEN \'m\' ELSE \'a\' END session_now,
            examtaker.examtaker_startdatetime,
            examtaker.examtaker_enddatetime,
            examtaker.examtaker_exact_enddatetime,
            convert(varchar, examtaker.examtaker_date, 105) examtaker_date,
            LTRIM(RTRIM(adppermit.adppermit_verifybymahb_drivingarea)) driver_category,
            adppermit.adppermit_completed_docs,
            examtaker.examtaker_totalmark
        ');*/
        $this->db->select('
            permit.*, 
            driver.driver_id,
            examtaker.examtaker_id,
            examtaker.examtaker_exammanagement_id,
            examtaker.examtaker_examonlymanagement_id,
            m.examonlymanagement_session session_booked,
            CASE WHEN DATEPART(HOUR, GETDATE()) BETWEEN 0 AND 11 THEN \'m\' ELSE \'a\' END session_now,
            examtaker.examtaker_startdatetime,
            examtaker.examtaker_enddatetime,
            examtaker.examtaker_exact_enddatetime,
            convert(varchar, examtaker.examtaker_date, 105) examtaker_date,
            LTRIM(RTRIM(adppermit.adppermit_verifybymahb_drivingarea)) driver_category,
            adppermit.adppermit_completed_docs,
            examtaker.examtaker_totalmark
        ');
        //m.examonlymanagement_session session_booked,
        $this->db->from('examtaker');
        $this->db->join('permit', 'permit.permit_id = examtaker.examtaker_permit_id', 'inner');
        $this->db->join('driver', 'driver.driver_id = examtaker.examtaker_driverid', 'inner');
        $this->db->join('adppermit', 'permit.permit_id = adppermit.adppermit_permit_id', 'inner');
        $this->db->join('examonlymanagement m', 'm.examonlymanagement_id = examtaker.examtaker_examonlymanagement_id', 'left');
        $this->db->where('permit.permit_bookingid', $credential->booking_id);
        $this->db->where('driver.driver_ic', $credential->ic_no);

        return $this->db->get()->row();
    }

    public function check_exam_session($data) 
    {   
        $data = (object) $data;
        $credential = $this->check_credentials($data);
        $examtaker_id = null;
        $driver_category = '';
        $driver_id = 0;
        $exam_counter = 0; // Default
        $examsession_id = 0;
        $timelimit = 0;
        $question_count = 0; 
        $docs_complete = 'n';
        $examtaker_date = '';
        
        // if (isset($credential) && ($credential->session_booked == null || $credential->session_booked == $credential->session_now)) {
        if (isset($credential)) {
            $permit_status = $credential->permit_status;
            $examtaker_id = $credential->examtaker_id;
            $driver_id = $credential->driver_id;
            $driver_category = $credential->driver_category;
            $docs_complete = $credential->adppermit_completed_docs;
            $examtaker_date = $credential->examtaker_date;
            //approvalairsidepending = exam pass
            //examfailed_1 = exam failed 1 time, have another try
            //examfailed = exam failed 2 times

            $this->db->select("
                $driver_id driver_id,
                '$driver_category' driver_category,
                '$docs_complete' docs_complete,
                '$examtaker_date' examtaker_date,
                examsession_id,
                examsession_examtaker_id examtaker_id,
                examsession_timelimit timelimit,
                examsession_question_count question_count,
                examsession_count exam_counter,
                examsession_startdatetime startdatetime,
                examsession_exact_enddatetime exact_enddatetime,
                examsession_enddatetime enddatetime,
                examsession_pass pass,
                CASE
                    WHEN examsession_exact_enddatetime IS NOT NULL THEN 'completed'
                    WHEN examsession_enddatetime <= getDate() THEN 'expired'
                    WHEN examsession_startdatetime IS NOT NULL THEN 'started'
                    ELSE 'created'
                END as examstate
            ");
            $this->db->from('examsession');
            $this->db->where('examsession_examtaker_id', $examtaker_id);
            $this->db->order_by('examsession_count', 'DESC');

            $examsession = $this->db->get()->row();  
            
            if(isset($examsession)) {
                // Exam take 1 
                if($examsession->exam_counter == 1 && $examsession->pass == 'n' && $data->retake_exam) {
                    $examstate = 'scheduled';
                    $exam_counter = 2;
                }
                else {
                    return $examsession;
                }
            }
            else {
                $examstate = 'scheduled';
                $exam_counter = 1;
            }
        } 
        // else if (isset($credential) && $credential->session_booked != null  && $credential->session_booked != $credential->session_now) {
        //     if($credential->session_booked == 'm') { // morning
        //         $examstate = 'unscheduled_session_am';
        //     }
        //     else {
        //         $examstate = 'unscheduled_session_pm';
        //     }           
        // }
        else {
            $examstate = 'unscheduled';
        } 

        return array(
            'examstate' => $examstate,
            'examtaker_id' => $examtaker_id,
            'examtaker_date' => $examtaker_date,
            'driver_id' => $driver_id,
            'exam_counter' => $exam_counter,
            'examsession_id' => $examsession_id,
            'timelimit' => $timelimit,
            'question_count' => $question_count,
            'driver_category' => $driver_category,
            'docs_complete' => $docs_complete
        );
    }

    public function create_exam_session($data) 
    {
        $data = (object) $data;
        $questions = [];
        $examinfo = $this->get_examtaker_info($data);
        $examtaker_id = $examinfo->examtaker_id;
        $adppermit_id = $examinfo->adppermit_id;
        $permit_condition = $examinfo->permit_condition;

        // Exam setting
        $q_compulsory_count = EXAM_COMPULSORY_COUNT;
        if( (int)$permit_condition == 1) { 
            $q_optional_count = EXAM_NEW_NONCOMPULSORY_COUNT;
            $q_timelimit = EXAM_NEW_TIMELIMIT; // 45

            $category1_count = EXAM_NEW_CATEGORY1_COUNT;
            $category2_count = EXAM_NEW_CATEGORY2_COUNT;
            $category3_count = EXAM_NEW_CATEGORY3_COUNT;
        }
        else {
            $q_optional_count = EXAM_RENEW_NONCOMPULSORY_COUNT;
            $q_timelimit = EXAM_RENEW_TIMELIMIT; // 30

            $category1_count = EXAM_RENEW_CATEGORY1_COUNT;
            $category2_count = EXAM_RENEW_CATEGORY2_COUNT;
            $category3_count = EXAM_RENEW_CATEGORY3_COUNT;
        } 

        if( strtolower($data->driver_category) != 'a' ) {
            $examsession_question_count = $q_compulsory_count + $q_optional_count;
        }
        else {
            $examsession_question_count = $category1_count + $category2_count + $category3_count;
        }
        
        $examsession_data = array(
            'examsession_examtaker_id' => $examtaker_id,
            'examsession_count' => $data->exam_counter,
            'examsession_question_count' => $examsession_question_count,
            'examsession_timelimit' => $q_timelimit, 
            'examsession_created_at' => date('Y-m-d H:i:s')
        );
        
        $examsession_id = $this->insert_examsession($examsession_data);

        if( strtolower($data->driver_category) != 'a' ) {            
            $question_optional      = $this->get_optional_questions($data, $q_optional_count);
            $question_compulsory    = $this->get_compulsory_questions($data,  $q_compulsory_count);
            $questions_stacked      = array_merge($question_optional, $question_compulsory);            
        }
        else {
            $questions_category1 = $this->get_questions_by_category($data, $category1_count, 1);
            $questions_category2 = $this->get_questions_by_category($data, $category2_count, 2);
            $questions_category3 = $this->get_questions_by_category($data, $category3_count, 3);
            $questions_stacked   = array_merge($questions_category1, $questions_category2, $questions_category3); 
        }

        foreach ($questions_stacked as $q)
        {
            array_push($questions, array(
                'examresult_examsession_id' => $examsession_id,
                'examresult_adppermit_id' => $adppermit_id,
                'examresult_examtaker_id' => $examtaker_id,   
                'examresult_examquestion_id' => $q->examquestion_id,             
                'examresult_result' => $q->examresult_result,
                'examresult_answer' => 0, // Default to 0
                'examresult_created_at' => date('Y-m-d H:i:s'),                
                'examresult_lastchanged_by' => 1
            ));
        }
            
        $this->insert_examresult($questions);

        return array(
            'examsession_id' => $examsession_id,
            'timelimit' => $q_timelimit,
            'question_count' => $q_compulsory_count + $q_optional_count
        );        
    }

    private function insert_examsession($data) {
        $this->db->insert('examsession', $data);
        return $this->db->insert_id();
    }

    private function insert_examresult($data) {
        $this->db->insert_batch('examresult', $data);
    }

    public function get_examsession($examsession_id) {
        $this->db->select('
            examsession_id,
            examsession_language,
            examsession_examtaker_id,
            examsession_totalmark,
            examsession_pass,
            examsession_startdatetime,
            examsession_enddatetime,
            examsession_exact_enddatetime
        ');
        $this->db->from('examsession');
        $this->db->where('examsession_id', $examsession_id);

        return $this->db->get()->row();                
    }

    private function get_examtaker_info($data) {
        $this->db->select('
            examtaker.examtaker_id,
            examtaker.examtaker_permit_id,
            examtaker.examtaker_driverid,
            adppermit.adppermit_id,
            adppermit.adppermit_verifybymahb_drivingarea exam_category,
            permit.permit_condition,
            permit.permit_picid
        ');
        $this->db->from('examtaker');
        $this->db->join('permit', 'permit.permit_id = examtaker.examtaker_permit_id', 'inner');
        $this->db->join('adppermit', 'permit.permit_id = adppermit.adppermit_permit_id', 'inner');
        $this->db->where('permit.permit_bookingid', $data->booking_id);
        
        return $this->db->get()->row();
    }

    private function get_optional_questions($data, $limit) {        
        $driver_category = strtolower($data->driver_category);
        //Get elective questions
        $this->db->select('
            examquestion.examquestion_id,
            examanswerlist.examanswerlist_id AS examresult_result
        ');
        $this->db->from('examquestion');
        $this->db->join('examanswerlist', 'examquestion.examquestion_id = examanswerlist.examanswerlist_examquestion_id', 'inner');
        $this->db->where('examanswerlist.examanswerlist_correctanswer', 'y');
        // $this->db->where('examquestion.examquestion_compulsory', 'n');
        $this->db->where('examquestion.examquestion_cat_'.$driver_category, 'y');
        $this->db->where('examquestion.examquestion_cat_'.$driver_category.'_compulsory', 'n');

        $this->db->order_by('examquestion.examquestion_id', 'RANDOM');
        $this->db->limit($limit);

        return $this->db->get()->result();
    }

    private function get_compulsory_questions($data, $limit) {
        $driver_category = strtolower($data->driver_category);
        //Get compulsory questions
        $this->db->select('
            examquestion.examquestion_id,
            examanswerlist.examanswerlist_id AS examresult_result
        ');
        $this->db->from('examquestion');
        $this->db->join('examanswerlist', 'examquestion.examquestion_id = examanswerlist.examanswerlist_examquestion_id', 'inner');
        $this->db->where('examanswerlist.examanswerlist_correctanswer', 'y');
        // $this->db->where('examquestion.examquestion_compulsory', 'y');
        // $this->db->where('examquestion.examquestion_cat_'.$driver_category, 'y');
        $this->db->where('examquestion.examquestion_cat_'.$driver_category.'_compulsory', 'y');

        $this->db->order_by('examquestion.examquestion_id', 'RANDOM');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }

    private function get_questions_by_category($data, $limit, $category_id) {        
        $driver_category = strtolower($data->driver_category);
        //Get elective questions
        $this->db->select('
            examquestion.examquestion_id,
            examanswerlist.examanswerlist_id AS examresult_result
        ');
        $this->db->from('examquestion');
        $this->db->join('examanswerlist', 'examquestion.examquestion_id = examanswerlist.examanswerlist_examquestion_id', 'inner');
        $this->db->where('examanswerlist.examanswerlist_correctanswer', 'y');
        // $this->db->where('examquestion.examquestion_compulsory', 'n');
        $this->db->where('examquestion.examquestion_cat_'.$driver_category, 'y');
        $this->db->where('examquestion.examquestion_cat_'.$driver_category.'_compulsory', 'n');
        $this->db->where('examquestion.examquestion_examtopic_id', $category_id);

        $this->db->order_by('examquestion.examquestion_id', 'RANDOM');
        $this->db->limit($limit);

        return $this->db->get()->result();
    }

    public function get_category($data){
        $driver_category = 'a'; // default to something
        $this->db->select('
            LTRIM(RTRIM(adppermit.adppermit_verifybymahb_drivingarea)) driver_category
        ');
        $this->db->from('adppermit');
        $this->db->where('adppermit.adppermit_permit_id', $data->permit_id);
        $permit = $this->db->get()->row();

        return strtolower($permit->driver_category);
    }
 
    public function get_questions($data) {
        $data = (object) $data;
        if(isset($data->driver_category)) {
            $driver_category = strtolower($data->driver_category);
        }
        else {
            $driver_category = $this->get_category($data);
        }       

        $this->db->select('
            r.examresult_id, 
            q.examquestion_id, 
            q.examquestion_content, 
            q.examquestion_content_eng,
            q.examquestion_cat_'.$driver_category.'_compulsory examquestion_compulsory,
            q.examquestion_image
        ');
        $this->db->from('examresult r');
        $this->db->join('examquestion q', 'r.examresult_examquestion_id = q.examquestion_id', 'inner');
        $this->db->where('r.examresult_examsession_id', $data->examsession_id);
        $this->db->order_by('r.examresult_id', 'ASC');

        return $this->db->get()->result();
    }

    public function get_answers($data) {
        $data = (object) $data;
        $this->db->select('
            r.examresult_id, 
            r.examresult_result,
            r.examresult_answer,
            l.examanswerlist_id,
            l.examanswerlist_examquestion_id, 
            l.examanswerlist_content,  
            l.examanswerlist_content_eng,
            l.examanswerlist_correctanswer
        ');
        $this->db->from('examresult r');
        $this->db->join('examanswerlist l', 'l.examanswerlist_examquestion_id = r.examresult_examquestion_id', 'inner');
        $this->db->where('r.examresult_examsession_id', $data->examsession_id);
        $this->db->order_by('r.examresult_id', 'ASC');
        $this->db->order_by('l.examanswerlist_id', 'RANDOM');

        return $this->db->get()->result();       
    }

    public function start_exam($data)
    {
        $data = (object) $data;
        
        $this->db->select('examsession_startdatetime started');
        $this->db->from('examsession');
        $this->db->where('examsession_id', $data->examsession_id);

        $checkStarted = $this->db->get()->row();
        // Set start, end
        $start = time();
        $end = strtotime("+". $data->timelimit ." minutes", $start);

        // Session exist, not started
        if(isset($checkStarted) && $checkStarted->started === null) {
            $this->db->where('examsession_id', $data->examsession_id);
            $this->db->update('examsession', array(                
                'examsession_startdatetime' => date('Y-m-d H:i:s ', $start),
                'examsession_enddatetime' => date('Y-m-d H:i:s', $end)
            ));

            return $start;
        }
        // Session exist, started, return start datetime
        else if( $checkStarted->started !== null) {
            return strtotime($checkStarted->started);
        }
        else {
            return $start;
        }
    }
    public function end_exam($data) 
    {
        $data = (object) $data;        
        $examresult_answer = [];
        
        // Real exam
        if(!(isset($data->dummy_result) && $data->dummy_result != '')) {   
            $json_answer = json_decode($data->exam_answers);         
            foreach($json_answer as $resid => $answerid) {
                array_push($examresult_answer, array(
                    'examresult_id' => $resid,
                    'examresult_answer' => $answerid
                ));
            }
        }
        // Dummy exam
        else {
            $this->db->select('
                examresult_id, 
                examresult_result
            ');
            $this->db->from('examresult');
            $this->db->where('examresult_examsession_id', $data->examsession_id);
            $resultpass = $this->db->get()->result();

            foreach($resultpass as $res) {
                array_push($examresult_answer, array(
                    'examresult_id' => $res->examresult_id,
                    'examresult_answer' => ($data->dummy_result == 'pass') ? $res->examresult_result : 0
                ));
            }
        }
        
        // Update users answers
        $this->db->update_batch('examresult', $examresult_answer, 'examresult_id'); 
        
        // Calculate result | Update exam result
        $data_exam_result = $this->mark_exam($data);
        
        // Update examsession
        $this->db->where('examsession_id', $data->examsession_id);
        $this->db->update('examsession', $data_exam_result);

        // Update respected tables
        $exam_result = $this->update_result($data, $data_exam_result);

        return $exam_result;
    
    }

    private function mark_exam($data) {
        $data = (object) $data;
        $category = $data->driver_category;
        $language = $data->examsession_language;

        $this->db->select('
            r.examresult_result _schema, 
            r.examresult_answer _answer,
            q.examquestion_cat_'.$category.'_compulsory _compulsory
        ');
        $this->db->from('examresult r');
        $this->db->join('examquestion q', 'r.examresult_examquestion_id = q.examquestion_id', 'inner');
        $this->db->where('r.examresult_examsession_id', $data->examsession_id);
        $exam_marking = $this->db->get()->result();
        // Marking rules
        if(strtolower($category) != 'a') {
            $correct_compulsory_schema = EXAM_COMPULSORY_COUNT;
        }
        else {
            $correct_compulsory_schema = 0;
        }
        
        $passing_score = 90;

        // Initialize variable
        $exam_remark = '';
        $correct_compulsory = 0;
        $correct_all = 0;
        $correct_optional = 0;
        $question_count = count($exam_marking);

        foreach($exam_marking as $answer) {
            if($answer->_schema === $answer->_answer) {
                $correct_all++;
                if($answer->_compulsory == 'y') {
                    $correct_compulsory++;
                }
                else{
                    $correct_optional++;
                }
            }
        }
        $percentage_correct = $correct_all / $question_count * 100;
        if ($correct_compulsory == $correct_compulsory_schema && $percentage_correct >= $passing_score) {
            $exam_pass = 'y';
        }
        else {
            $exam_pass = 'n';
        }

        if($correct_compulsory < $correct_compulsory_schema) {
            $exam_remark .= sprintf($this->lang->line('examdriver_examremark1'), $correct_compulsory);
        }

        if($percentage_correct < $passing_score) {
            $exam_remark .= sprintf($this->lang->line('examdriver_examremark2'), $percentage_correct);
        }

        return array(
            'examsession_language' => $language,
            'examsession_totalmark' => $correct_all,
            'examsession_totalcompulsorymark' => $correct_compulsory,
            'examsession_totaloptionalmark' => $correct_optional,
            'examsession_pass' => $exam_pass,
            'examsession_remark' => $exam_remark,
            'examsession_exact_enddatetime' => date('Y-m-d H:i:s'),
            'examsession_updated_at' => date('Y-m-d H:i:s')
        );
    }

    private function update_result($data, $result)
    {
        $data = (object) $data;
        $result = (object) $result;
        $return_result = new stdClass();

        $examsession_pass = $result->examsession_pass;
        $exam_counter = $data->exam_counter;
        
        
        // Get permit info
        $examtakerinfo = $this->get_examtaker_info($data);
        $permit_id = $examtakerinfo->examtaker_permit_id;
        $adppermit_id = $examtakerinfo->adppermit_id;
        $driver_id = $examtakerinfo->examtaker_driverid;

        // Populate return value
        $return_result->examsession_pass = ($examsession_pass == 'y' ? 'Passed':'Failed');
        $return_result->booking_id = $data->booking_id;
        $return_result->pic_id = $examtakerinfo->permit_picid;
        $return_result->exam_counter = $exam_counter;
        $return_result->driver_id = $driver_id;

        // Get user
        $user = $this->get_user(array('driver_id' => $driver_id));
        $user_id = $driver_id; // $user->user_id;

        // Update examtaker
        $examsession = (object) $this->get_examsession($data->examsession_id);
        $data_exam_taker = array(
            'examtaker_startdatetime' => $examsession->examsession_startdatetime,
            'examtaker_enddatetime' => $examsession->examsession_enddatetime,
            'examtaker_exact_enddatetime' => $examsession->examsession_exact_enddatetime,
            'examtaker_totalmark' => $examsession->examsession_totalmark,
            'examtaker_pass' => $examsession->examsession_pass,
            'examtaker_updated_at' => date('Y-m-d H:i:s'),
            'examtaker_lastchanged_by' => ($user_id == null) ? 0 : $user_id
        );
        $this->db->where('examtaker_id', $examsession->examsession_examtaker_id);
        $this->db->update('examtaker', $data_exam_taker);
        
        if($examsession_pass == 'y') {
            $data_adppermit = array('adppermit_exampass' => 'y');
            $data_permit = array(
                'permit_status' => 'approvalairsidepending',
                'permit_officialstatus' => 'inprogress'
            );
            $data_permit_timeline = array(
                'permit_timeline_permitid' => $permit_id,
                'permit_timeline_userid' => $user_id,
                'permit_timeline_name' => 'exam passed',
                'permit_timeline_desc' => 'driver pass the exam',
                'permit_timeline_remark' => 'Exam passed',
                'permit_timeline_status' => 'approvalairsidepending',
                'permit_timeline_officialstatus' => 'inprogress',
                'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                'permit_timeline_lastchanged_by' => $user_id
            );
        }
        else if($examsession_pass == 'n' && $exam_counter == 1) {
            $data_adppermit = array('adppermit_exampass' => 'n');
            $data_permit = array(
                'permit_status' => 'examfailed_1',
                'permit_officialstatus' => 'inprogress'
            );
            $data_permit_timeline = array(
                'permit_timeline_permitid' => $permit_id,
                'permit_timeline_userid' => $user_id,
                'permit_timeline_name' => 'exam failed 1st time',
                'permit_timeline_desc' => 'driver fail the exam for the 1st time',
                'permit_timeline_remark' => 'Exam failed',
                'permit_timeline_status' => 'examfailed_1',
                'permit_timeline_officialstatus' => 'inprogress',
                'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                'permit_timeline_lastchanged_by' => $user_id
            );
        }
        else if($examsession_pass == 'n' && $exam_counter == 2) {
            $data_adppermit = array('adppermit_exampass' => 'n');
            $data_permit = array(
                'permit_status' => 'examfailed',
                'permit_officialstatus' => 'failed'
            );
            $data_permit_timeline = array(
                'permit_timeline_permitid' => $permit_id,
                'permit_timeline_userid' => $user_id,
                'permit_timeline_name' => 'exam failed 2nd time',
                'permit_timeline_desc' => 'driver fail the exam for the 2nd time',
                'permit_timeline_status' => 'examfailed',
                'permit_timeline_remark' => 'Exam failed',
                'permit_timeline_officialstatus' => 'failed',
                'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                'permit_timeline_lastchanged_by' => $user_id
            );
        }

        // Update permit
        $this->db->where('adppermit_id', $adppermit_id);
        $this->db->update('adppermit', $data_adppermit);
        // Update adppermit
        $this->db->where('permit_id', $permit_id);
        $this->db->update('permit', $data_permit);
        // Update permit_timeline
        $this->db->insert('permit_timeline', $data_permit_timeline);

        return $return_result;
    }

    private function get_user($filter) {
        $filter = (object) $filter;
        $this->db->select('*');
        $this->db->from('userlist');
        $this->db->where('user_groupid', 2);
        $this->db->where('user_customid', $filter->driver_id);

        return $this->db->get()->row();
    }

    public function get_result($data) {
        $data = (object) $data;
        $this->db->select('*');
        $this->db->from('examsession');
        $this->db->where('examsession_id', $data->examsession_id);
        $this->db->order_by('examsession_count', 'DESC');

        return $this->db->get()->row();
    }
}

?>