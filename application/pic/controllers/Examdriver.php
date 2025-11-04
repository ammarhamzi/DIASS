<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examdriver extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('examdriver_model');
        $this->load->model('pic_model');
        $this->load->model('user_model');
        $this->load->model('driver_model');
        $this->lang->load('examdriver_lang', $this->session->userdata('exam_language'));
    }

    public function index()
    {
        if($this->authorized_ip()) {
            if($this->session->flashdata('message')) {
                $data['message'] = $this->session->flashdata('message');
            }
            else {
                $data['message'] = '';
            }
            $this->load->view('examdriver/examdriver_credentials', $data);
        }
        else {
            // print_r($this->get_client_ip());
            $this->load->view('examdriver/unauthorized');
        }
    }

    public function authorized_ip() {
        $array_ip = EXAM_ALLOWED_IP;

        $client_ip = $this->get_client_ip();

        // Enable this for ip checking
        //return in_array($client_ip, $array_ip);
         return true;
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function view_exam($examsession_id, $permit_id) {
        
        if ($examsession_id && $permit_id) {

            $questions = $this->examdriver_model->get_questions([
                'examsession_id' => fixzy_decoder($examsession_id),
                'permit_id' => fixzy_decoder($permit_id)
            ]);
            $answers = $this->examdriver_model->get_answers(['examsession_id' => fixzy_decoder($examsession_id)]);
            $examsession = $this->examdriver_model->get_examsession(fixzy_decoder($examsession_id));
            //$data->driver = $this->create_driver_info($data);
            $examquestions = [];
                    
            foreach($questions as $q) {
                
                $searching = true;
                $answer = [];
                
                while( $searching ) {
                    $key = array_search($q->examresult_id, array_column($answers, 'examresult_id'));

                    if($key === false) {
                        $searching = false;
                    }
                    else {                    
                        $answ = $answers[$key];
                        // Populate  answer options
                        if($answ->examresult_result == $answ->examresult_answer) {
                            $answer_selected = $answ->examanswerlist_correctanswer;
                        }
                        else {
                            $answer_selected = ($answ->examresult_answer == $answ->examanswerlist_id ? 'y' : 'n') ;
                        }
                        array_push($answer, array(
                            'answerlist_id' => $answ->examanswerlist_id,
                            'answerlist_content' => $answ->examanswerlist_content,
                            'answerlist_content_eng' => $answ->examanswerlist_content_eng,
                            'answerlist_correct' => $answ->examanswerlist_correctanswer,
                            'answer_selected' => $answer_selected
                        ));
                        // Remove answer from list
                        $answers[$key]->examresult_id = 0;
                    }
                }

                $q->answer_options = $answer;
                array_push($examquestions, $q);
            }

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'examsession_id' => $examsession_id,
                'permit_id' => $permit_id,
                'controller' => 'examdriver',
                'pagetitle' => 'Exam Result',
                'examquestions' => $examquestions,
                'language' => $examsession->examsession_language
            ];

            $this->content = 'examdriver/examdriver_result';
            $this->layout($data, $setting);
            // $data->examset = json_encode($examquestions);
            // $this->load->view('examdriver/examdriver_do_exam', $data);
        }
        else {
            redirect('/');
        }
    }

    public function do_exam()
    {        
        $this->set_rules('do_exam');
        $data = [
            'booking_id' => $this->input->post('booking_id', true),
            'ic_no' => $this->input->post('ic_no', true)
        ];
        
        if($this->input->post('language')) {
            $this->session->set_userdata('exam_language', $this->input->post('language'));
            $this->lang->load('examdriver_lang', $this->session->userdata('exam_language'));
        }

        if($this->input->post('starting')) {
            $starting = true;
        }
        else {
            $starting = false;
        }

        if($this->input->post('exam_answers', true)) {
            $marking_exam = true;            
        }
        else if($this->input->post('dummy_result', true)) {
            $marking_exam = true; 
            $data['dummy_result'] = $this->input->post('dummy_result');
        }
        else {
            $marking_exam = false;
        }

        if($this->input->post('retake_exam', true)) {
            $retake_exam = true;
        }
        else {
            $retake_exam = false;
        }
        $data['retake_exam'] = $retake_exam;

        if (!$this->form_validation->run() == false) {
            $examsession = $this->examdriver_model->check_exam_session($data);
            foreach($examsession as $key => $value) {
                $data[$key] = $value;
            }

            $examsession = (object) $examsession;

            if(strtolower($examsession->driver_category) == 'a') {
                $this->lang->load('examdriver_lang', $this->session->userdata('exam_language'));
            }          
            
            // Enable this for doc complete checking
            if($examsession->docs_complete != 'y') {
                $message = ($examsession->docs_complete == 'n' ? 'Your documents are incomplete' : 'Sorry, your documents are not reviewed yet');
                $this->session->set_flashdata('message', $message.'<br>'.date('Y-m-d H:i:s'));
                redirect('/Examdriver');
                return;
            }
            // Enable this for date checking            
             if($examsession->examstate == 'scheduled') {
                 $today_date = time();
                 $dateStart = strtotime($examsession->examtaker_date);
                 $dateEnd = strtotime($examsession->examtaker_date. ' + 14 days');

                 if($today_date >= $dateStart && $today_date <= $dateEnd) {
                     $date_message = '';
                 }
                 else if($today_date < $dateStart) {
                     $date_message = sprintf('Your exam date of %s have not arrived.', $examsession->examtaker_date);
                 }
                 else {
                     $date_message = sprintf('Your exam date of %s have expired.', $examsession->examtaker_date);
                 }
                 if($date_message != '') {
                     $this->session->set_flashdata('message', $date_message);
                     redirect('/Examdriver');
                     return;
                 }
             }

            $examstate = $examsession->examstate;
            $data['starting'] = $starting;
            $driver = $this->create_driver_info($data);
            
            // unscheduled
            // scheduled 
            // created 
            // started 
            // expired 
            // completed
            
            switch($examsession->examstate){
                case 'unscheduled':
                    $this->session->set_flashdata('message','Booking ID or IC No incorrect');
                    redirect('/Examdriver');
                break;

                case 'unscheduled_session_am':
                    $this->session->set_flashdata('message',$this->lang->line('examdriver_session_am'));
                    redirect('/Examdriver');
                break;

                case 'unscheduled_session_pm':
                    $this->session->set_flashdata('message',$this->lang->line('examdriver_session_pm'));
                    redirect('/Examdriver');
                break;

                case 'scheduled':
                    // Default BM for every login
                    $this->session->set_userdata('exam_language', 'malay');
                    $this->lang->load('examdriver_lang', 'malay');
                    // Generate random question
                    $exam = $this->create_exam($data);
                    foreach($exam as $key => $value) {
                        $data[$key] = $value;
                    }
                    $this->run_exam($data);
                break; 

                case 'created':
                    // Get question and populate the questions
                    // Start the exam
                    if($starting) {
                        $this->start_exam($data);
                        $reload_examsession = $this->examdriver_model->check_exam_session($data);
                        foreach($reload_examsession as $key => $value) {
                            $data[$key] = $value;
                        }
                    }
                    $this->run_exam($data);
                break;
                
                case 'started':
                    if(!$marking_exam) {
                        // Get question and populate the questions and resume the exam
                        $this->run_exam($data);
                    }
                    else {
                        $data['exam_answers'] = $this->input->post('exam_answers', true);
                        $data['examsession_language'] = $this->input->post('examsession_language', true);
                        $this->end_exam($data);
                        $data_result = $this->examdriver_model->get_result($data);
                        $data_result->booking_id = $data['booking_id'];
                        $data_result->ic_no      = $data['ic_no'];
                        $data_result->examtaker_id = $data_result->examsession_examtaker_id;
                        $data_result->driver = $driver;
                        $this->load->view('examdriver/examdriver_result_screen', $data_result);
                    }
                break;

                case 'completed':
                    // later load exam result page: Button retake exam
                    $data_result = $this->examdriver_model->get_result($data);
                    $data_result->booking_id = $data['booking_id'];
                    $data_result->ic_no      = $data['ic_no'];
                    $data_result->examtaker_id = $data_result->examsession_examtaker_id;
                    $data_result->driver = $driver;
                    $this->load->view('examdriver/examdriver_result_screen', $data_result);
                break;

                case 'expired':
                    if(!$marking_exam) { 
                        $this->session->set_flashdata('message','Your time limit for the exam is up');
                        //redirect('/Examdriver');
                        $this->run_exam($data);
                    }
                    else {
                        $data['exam_answers'] = $this->input->post('exam_answers', true);
                        $data['examsession_language'] = $this->input->post('examsession_language', true);
                        $this->end_exam($data);
                        $data_result = $this->examdriver_model->get_result($data);
                        $data_result->booking_id = $data['booking_id'];
                        $data_result->ic_no      = $data['ic_no'];
                        $data_result->examtaker_id = $data_result->examsession_examtaker_id;
                        $data_result->driver = $driver;
                        $this->load->view('examdriver/examdriver_result_screen', $data_result);
                        // later load exam result page
                    }                    
                break;
            }
        } 
        else {
            $this->session->set_flashdata('message','Booking ID or IC No incorrect');
            // $this->load->view('examdriver/examdriver_credentials', $data);
            redirect('/Examdriver');
        }
        
    }

    private function create_exam($data) {
        return $this->examdriver_model->create_exam_session($data);
    }

    private function start_exam($data) {
        $this->examdriver_model->start_exam($data);
    } 

    private function create_driver_info($data) {
        $data = (object) $data;
        $driver = $this->driver_model->get_raw_by_id($data->driver_id);  
        $driver->booking_id =  $data->booking_id;
        $driver->driver_category = $data->driver_category;
        return $this->load->view('examdriver/driverinfo', $driver, TRUE);  
    }   

    private function run_exam($data) {
        $data = (object) $data;
        $examcookiename = 'examsession' . $data->examsession_id;

        if($data->examstate == 'created' || $data->examstate == 'scheduled') {
            if($data->question_count == 20) {
                $data->schema = '18/20';
            }
            else {
                $data->schema = '36/40';
            }
            $data->driver = $this->create_driver_info($data);
            $this->load->view('examdriver/examdriver_start_screen', $data);
        }
        else {
            $data->var_cookies = json_encode($this->get_exam_cookies($data));
            $this->load_exam($data);
        }
    }

    public function get_exam_cookies($data) {
        $data = (object) $data;
        
        if($this->session->userdata('exam_language') == 'english') {
            $cookielanguage = 'eng';
        }
        else {
            $cookielanguage = 'my';
        }

        if(strtolower($data->driver_category) == 'a') {
            $cookielanguage = 'my';
        }
        
        $cookieexpiry = strtotime("+360 days", time());
        $cookiename = 'examsession' . $data->examsession_id;
        $cookievalues = array(
            'language' => $cookielanguage, 
            'booking_id' => $data->booking_id,
            'status' => $data->examstate,
            'answers' => (object)[],
            'current_question' => 0,
            'start_time' => $data->startdatetime,
            'end_time' => $data->enddatetime,
            'exact_enddatetime' => null
        );

        $cookie = array(
            'name'   => $cookiename,
            'value'  => $cookievalues,
            'expire' => $cookieexpiry
        );

        // set_cookie($cookie);

        return (object)$cookie;
    }

    private function update_exam_cookies($data, $cookies_value) {
        $cvalue = (object) $cookies_value;
        if($cvalue->language == 'eng') {
            $this->session->set_userdata('exam_language', 'english');
        }
        else if($cvalue->language == 'my') {
            $this->session->set_userdata('exam_language', 'malay');
        }
        $data = (object) $data;
        $cookieexpiry = strtotime("+360 days", time());
        $cookiename = 'examsession' . $data->examsession_id;
        
        $cookie = array(
            'name'   => $cookiename,
            'value'  => json_encode($cookies_value),
            'expire' => $cookieexpiry
        );

        set_cookie($cookie);
    }

    private function load_exam($data) {
        $questions = $this->examdriver_model->get_questions($data);
        $answers = $this->examdriver_model->get_answers($data);
        $data->driver = $this->create_driver_info($data);
        $examquestions = [];
                
        foreach($questions as $q) {
            
            $searching = true;
            $answer = [];
            
            while( $searching ) {
                $key = array_search($q->examresult_id, array_column($answers, 'examresult_id'));

                if($key === false) {
                    $searching = false;
                }
                else {                    
                    $answ = $answers[$key];
                    // Populate  answer options
                    array_push($answer, array(
                        'answerlist_id' => $answ->examanswerlist_id,
                        'answerlist_content' => $answ->examanswerlist_content,
                        'answerlist_content_eng' => $answ->examanswerlist_content_eng
                    ));
                    // Remove answer from list
                    $answers[$key]->examresult_id = 0;
                }
            }

            $q->answer_options = $answer;
            array_push($examquestions, $q);
        }

        $data->examset = json_encode($examquestions);
        $this->load->view('examdriver/examdriver_do_exam', $data);
    }

    private function end_exam($data) {      
        $result_exam = $this->examdriver_model->end_exam($data);

        if(isset($result_exam->examsession_pass)) {
            $this->notify_pic($result_exam);
        }
    }

    private function notify_pic($data) {
        $pic = $this->user_model->get_by_id($data->pic_id);
        $driver = $this->driver_model->get_by_id($data->driver_id);

        if(!$pic || !$driver) {
            return;
        }

        $subject = sprintf('DIASS - Exam Result (Booking ID %s)', $data->booking_id);

        $body    = '
            Good day ' . $pic->user_name . ',
            <br><br>

            The following driver have ' . $data->examsession_pass . ' the Proficiency Exam.  
            <br><br>

            Name: ' .$driver->driver_name. '<br>
            IC No: ' .$driver->driver_ic. '<br><br>

            Thank you.
            <br><br>

            Regards,<br>
            -DIASS Administrator';

        $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
        $this->email->to($pic->user_email);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    private function set_rules($action) 
    {
        if($action == 'do_exam') {
            $this->form_validation->set_rules('booking_id', 'Booking ID', 'required', ['required' => 'Please fill in Booking ID']);
            $this->form_validation->set_rules('ic_no', 'IC No', 'required', ['required' => 'Please fill in IC No']);
        }//|exact_length[12]
    }
}
?>