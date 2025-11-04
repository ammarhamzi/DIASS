<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examdriver extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('examdriver_model');
        $this->load->model('driver_model');
        $this->lang->load('examdriver_lang', $this->session->userdata('language'));
    }

    public function index()
    {
        redirect('/');
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
}
?>