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
}

?>