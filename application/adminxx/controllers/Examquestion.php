<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examquestion extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('examquestion_model');
        $this->lang->load('examquestion_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $examquestion = $this->examquestion_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'examquestion_data' => $examquestion,
                'permission' => $this->permission,
            ];

            $this->content = 'examquestion/examquestion_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function view($id)
    {
        if ($this->permission->cp_read == true) {
            $question_id = $id;
            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $question = $this->examquestion_model->get_questions(array('examquestion_id' => $id));
            $answer = $this->examquestion_model->get_answers(array('examquestion_id' => $id));
            
            if ($question) {
                $compulsory = array();
                if($question->examquestion_cat_a_compulsory == 'y'){
                    array_push($compulsory, 'A');
                }
                if($question->examquestion_cat_b1_compulsory == 'y'){
                    array_push($compulsory, 'B1');
                }
                if($question->examquestion_cat_b2_compulsory == 'y'){
                    array_push($compulsory, 'B2');
                }
                if($question->examquestion_cat_c_compulsory == 'y'){
                    array_push($compulsory, 'C');
                }
                if(count($compulsory)) {
                    $str_compulsory = implode( ", ", $compulsory );
                }
                else {
                    $str_compulsory = 'N/A';
                }

                $category = array();
                if($question->examquestion_cat_a == 'y'){
                    array_push($category, 'A');
                }
                if($question->examquestion_cat_b1 == 'y'){
                    array_push($category, 'B1');
                }
                if($question->examquestion_cat_b2 == 'y'){
                    array_push($category, 'B2');
                }
                if($question->examquestion_cat_c == 'y'){
                    array_push($category, 'C');
                }

                if(count($category)) {
                    $str_category = implode( ", ", $category );
                }
                else {
                    $str_category = 'N/A';
                }
                
                $data = [
                    'button' => 'View', 
                    'examquestion_id' => $question_id,
                    'examquestion_content' => $question->examquestion_content,
                    'examquestion_content_eng' => $question->examquestion_content_eng,
                    'examquestion_image' => $question->examquestion_image,
                    'examquestion_answers' => $answer,
                    'examquestion_compulsory' => $str_compulsory,
                    'examquestion_category' => $str_category
                ];

                 $this->content = 'examquestion/examquestion_view';
                ##--slave_combine_to_list--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion'));
            }

        } else {
            redirect('/');
        }

    }

    //type=normal/raw
    public function read($id, $type = "normal")
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->examquestion_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examquestion_content' => $row->examquestion_content,
                    'examquestion_compulsory' => $row->examquestion_compulsory,
                    'examquestion_examtopic_id' => $row->examtopic_title_examquestion_examtopic_id,
                    'examquestion_mark' => $row->examquestion_mark,

                ];

                if ($type === 'normal') {
//check if parentchild exist
                    $parent_id = $this->my_model->get_value2('tabslave', 'tabslave_id',
                        "tabslave_controller = '" . strtolower($this->router->fetch_class()) . "' and tabslave_parent_id = 0");

                    if (!empty($parent_id)) {
                        $data_parentchild = [
                            'parentchildmenu' => $this->my_model->get_data('tabslave', '*',
                                "tabslave_parent_id = $parent_id"),
                            'currentcontroller' => strtolower($this->router->fetch_class()),
                            'parentid' => fixzy_encoder($id),
                        ];

                        $this->parentchildmenu = $this->load->view('foundation/parentchildmenu',
                            $data_parentchild, true);
                    }

                    $this->content = 'examquestion/examquestion_read';

                    $this->load->model('examanswerlist_model');
                    $this->lang->load('examanswerlist_lang', 'english');
                    $examanswerlist              = $this->examanswerlist_model->get_all_filter_fk($id);
                    $this->slave                 = 'examanswerlist/examanswerlist_list';
                    $data['examanswerlist_data'] = $examanswerlist;
                    $data['parent_id']           = fixzy_encoder($id);
                    $data['permission']          = $this->permission;
##--slave_combine_to_read--##

                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('examquestion/examquestion_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion'));
            }

        } else {
            redirect('/');
        }

    }

    public function create()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',   
                'action' => site_url('examquestion/create_action'),
                'examquestion_id' => set_value('examquestion_id'),
                'examquestion_content' => set_value('examquestion_content'),
                'examquestion_content_eng' => set_value('examquestion_content_eng'),
                'examquestion_category' => set_value('examquestion_category'),
                'examquestion_correctanswer' => set_value('examquestion_correctanswer'),

                'examquestion_cat_a' => set_value('examquestion_cat_a'),
                'examquestion_cat_b1' => set_value('examquestion_cat_b1'),
                'examquestion_cat_b2' => set_value('examquestion_cat_b2'),
                'examquestion_cat_c' => set_value('examquestion_cat_c'),
                'examquestion_cat_a_compulsory' => set_value('examquestion_cat_a_compulsory'),
                'examquestion_cat_b1_compulsory' => set_value('examquestion_cat_b1_compulsory'),
                'examquestion_cat_b2_compulsory' => set_value('examquestion_cat_b2_compulsory'),
                'examquestion_cat_c_compulsory' => set_value('examquestion_cat_c_compulsory'),

                'examanswerlist_correctanswer_1' => set_value('examanswerlist_correctanswer_1'),
                'examanswerlist_id_1' => set_value('examanswerlist_id_1'),
                'examanswerlist_content_1' => set_value('examanswerlist_content_1'),
                'examanswerlist_content_eng_1' => set_value('examanswerlist_content_eng_1'),

                'examanswerlist_correctanswer_2' => set_value('examanswerlist_correctanswer_2'),
                'examanswerlist_id_2' => set_value('examanswerlist_id_2'),
                'examanswerlist_content_2' => set_value('examanswerlist_content_2'),
                'examanswerlist_content_eng_2' => set_value('examanswerlist_content_eng_2'),

                'examanswerlist_correctanswer_3' => set_value('examanswerlist_correctanswer_3'),
                'examanswerlist_id_3' => set_value('examanswerlist_id_3'),
                'examanswerlist_content_3' => set_value('examanswerlist_content_3'),
                'examanswerlist_content_eng_3' => set_value('examanswerlist_content_eng_3'),

                'examquestion_image' => set_value('examquestion_image')


            ];
            $this->content = 'examquestion/examquestion_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function default_examquestion_value($action) {
        $data = [
            'examquestion_cat_a' => 'n',
            'examquestion_cat_b1' => 'n',
            'examquestion_cat_b2' => 'n',
            'examquestion_cat_c' => 'n',
            'examquestion_cat_a_compulsory' => 'n',
            'examquestion_cat_b1_compulsory' => 'n',
            'examquestion_cat_b2_compulsory' => 'n',
            'examquestion_cat_c_compulsory' => 'n',
            'examquestion_lastchanged_by' => $this->session->userdata('id'),
        ];

        if($action == 'insert') {
            $data['examquestion_created_at'] = date('Y-m-d H:i:s');
        }
        else {
            $data['examquestion_updated_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }

    public function default_examanswerlist_value($action) {

        $data = [
            'examanswerlist_correctanswer' => 'n',            
            'examanswerlist_lastchanged_by' => $this->session->userdata('id'),
        ];

        if($action == 'insert') {
            $data['examanswerlist_created_at'] = date('Y-m-d H:i:s');
        }
        else {
            $data['examanswerlist_updated_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }

    public function create_action()
    {

        if ($this->permission->cp_create == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->create();
            } else {

                $data_examquestion = $this->default_examquestion_value('insert');
                $data_examanswerlist_1 = $this->default_examanswerlist_value('insert');
                $data_examanswerlist_2 = $this->default_examanswerlist_value('insert');
                $data_examanswerlist_3 = $this->default_examanswerlist_value('insert');

                // print_r($_POST);exit;
                foreach ($_POST as $key => $value) {
                    switch($key) {
                        case 'examquestion_correctanswer':
                        case 'examquestion_category':
                        case 'examquestion_id':
                        case 'examanswerlist_id_1':
                        case 'examanswerlist_id_2':
                        case 'examanswerlist_id_3':
                        case 'files':                        
                            // do nothing
                            break;
                        default:
                            if (preg_match("/^examquestion(.*)/i", $key)) {
                                $data_examquestion[$key] = $value;
                            }
                            else if (preg_match("/^examanswerlist(.*)/i", $key)) {
                                if (preg_match("/\_(1)$/", $key)) {
                                    $data_examanswerlist_1[rtrim($key,"_1")] = strip_tags(trim($value));;
                                }
                                else if (preg_match("/\_(2)$/", $key)) {
                                    $data_examanswerlist_2[rtrim($key,"_2")] = strip_tags(trim($value));;
                                }
                                else if (preg_match("/\_(3)$/", $key)) {
                                    $data_examanswerlist_3[rtrim($key,"_3")] = strip_tags(trim($value));;
                                }                                
                            }                            
                            break;
                    }
                }

                // Upload image if there is
                if (!empty($_FILES['examquestion_image']['name'])) {
                    $data_examquestion['examquestion_image'] = $this->do_upload('examquestion_image');
                }
                else {
                    unset($data_examquestion['examquestion_image']);
                }
                
                $this->examquestion_model->insert($data_examquestion);
                $primary_id = $this->db->insert_id();

                $data_examanswerlist_1['examanswerlist_examquestion_id'] = $primary_id;
                $data_examanswerlist_2['examanswerlist_examquestion_id'] = $primary_id;
                $data_examanswerlist_3['examanswerlist_examquestion_id'] = $primary_id;

                $this->examquestion_model->insert_answer(array($data_examanswerlist_1, $data_examanswerlist_2, $data_examanswerlist_3));

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('examquestion'));
            }

        } else {
            redirect('/');
        }

    }

    public function get_category($data) {
        $examcategory = '';
        if($data->examquestion_cat_a == 'y') {
            $examcategory .= 'examquestion_cat_a|';
        }
        if($data->examquestion_cat_b1 == 'y') {
            $examcategory .= 'examquestion_cat_b1|';
        }
        if($data->examquestion_cat_b2 == 'y') {
            $examcategory .= 'examquestion_cat_b2|';
        }   
        if($data->examquestion_cat_c == 'y') {
            $examcategory .= 'examquestion_cat_c|';
        }

        return $examcategory;
    }

    public function update($id)
    {

        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $question = $this->examquestion_model->get_by_id(fixzy_decoder($id));
            $answer = $this->examquestion_model->get_answer_by_id(fixzy_decoder($id));

            /* $this->logQueries($this->config->item('dblog')); */
            if ($question) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('examquestion/update_action'),
                    'id' => $id,     
                    'examquestion_image' => set_value('examquestion_image', $question->examquestion_image),             
                    'examquestion_content' => set_value('examquestion_content', $question->examquestion_content),
                    'examquestion_content_eng' => set_value('examquestion_content_eng', $question->examquestion_content_eng),                    
                    'examquestion_category' => set_value('examquestion_category', $this->get_category($question)),
                    'examquestion_correctanswer' => set_value('examquestion_correctanswer', ''),
                    'examquestion_cat_a' => set_value('examquestion_cat_a', $question->examquestion_cat_a),
                    'examquestion_cat_b1' => set_value('examquestion_cat_b1', $question->examquestion_cat_b1),
                    'examquestion_cat_b2' => set_value('examquestion_cat_b2', $question->examquestion_cat_b2),
                    'examquestion_cat_c' => set_value('examquestion_cat_c', $question->examquestion_cat_c),
                    'examquestion_cat_a_compulsory' => set_value('examquestion_cat_a_compulsory', $question->examquestion_cat_a_compulsory),
                    'examquestion_cat_b1_compulsory' => set_value('examquestion_cat_b1_compulsory', $question->examquestion_cat_b1_compulsory),
                    'examquestion_cat_b2_compulsory' => set_value('examquestion_cat_b2_compulsory', $question->examquestion_cat_b2_compulsory),
                    //modified on 30 Oct 2019
                    //to rectify compulsory category c not appear after update
                    //start                
                    'examquestion_cat_c_compulsory' => set_value('examquestion_cat_c_compulsory', $question->examquestion_cat_c_compulsory),
                    //end
                    'examquestion_mark' => set_value('examquestion_mark', $question->examquestion_mark),

                ];

                $i = 0;
                foreach($answer as $a) {
                    $i++;
                    $data['examanswerlist_id_'.$i] = $a->examanswerlist_id;
                    $data['examanswerlist_content_'.$i] = $a->examanswerlist_content;
                    $data['examanswerlist_content_eng_'.$i] = $a->examanswerlist_content_eng;
                    $data['examanswerlist_correctanswer_'.$i] = $a->examanswerlist_correctanswer;
                }

                $this->content = 'examquestion/examquestion_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion'));
            }

        } else {
            redirect('/');
        }

    }

    public function update_action()
    {
        // print_r($_FILES);exit;

        if ($this->permission->cp_update == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('examquestion_id', true));
            } else {
                $data_examquestion = $this->default_examquestion_value('update');
                $data_examanswerlist_1 = $this->default_examanswerlist_value('update');
                $data_examanswerlist_2 = $this->default_examanswerlist_value('update');
                $data_examanswerlist_3 = $this->default_examanswerlist_value('update');

                // print_r($_POST);exit;
                foreach ($_POST as $key => $value) {
                    switch($key) {
                        case 'examquestion_correctanswer':
                        case 'examquestion_category':
                        case 'examquestion_id':
                        case 'files':                        
                            // do nothing
                            break;
                        default:
                            if (preg_match("/^examquestion(.*)/i", $key)) {
                                $data_examquestion[$key] = $value;
                            }
                            else if (preg_match("/^examanswerlist(.*)/i", $key)) {
                                if (preg_match("/\_(1)$/", $key)) {
                                    $data_examanswerlist_1[rtrim($key,"_1")] = strip_tags(trim($value));
                                }
                                else if (preg_match("/\_(2)$/", $key)) {
                                    $data_examanswerlist_2[rtrim($key,"_2")] = strip_tags(trim($value));;
                                }
                                else if (preg_match("/\_(3)$/", $key)) {
                                    $data_examanswerlist_3[rtrim($key,"_3")] = strip_tags(trim($value));;
                                }                                
                            }                            
                            break;
                    }
                }
                // Upload image if there is
                if (!empty($_FILES['examquestion_image']['name'])) {
                    $data_examquestion['examquestion_image'] = $this->do_upload('examquestion_image');
                }
                else {
                    unset($data_examquestion['examquestion_image']);
                }

                $this->examquestion_model->update(fixzy_decoder($this->input->post('examquestion_id')), $data_examquestion);
                $this->examquestion_model->update_answer(array($data_examanswerlist_1, $data_examanswerlist_2, $data_examanswerlist_3));
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('examquestion'));
            }

        } else {
            redirect('/');
        }

    }

    public function do_upload($file) {
        // File upload configuration
        $config['file_name'] = date("YmdHis").'_'.$_FILES[$file]['name'];
        //modified on 30 Oct 2019
        //to ensure filename with spaces is replaced with underscore
        //start
        $config['file_name'] = str_replace(' ', '_', $config['file_name']);
        //end
        $config['upload_path']   = './../resources/shared_img//question_bank/';
        // 
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '5000';

        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // Return filename if successfully upload
        if ($this->upload->do_upload($file)) {
            return $config['file_name'];
        }
        else {
            return '';
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examquestion_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->examquestion_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examquestion'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examquestion_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examquestion_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->examquestion_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examquestion'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('examquestion_category', ' ', 'trim|required', array('required' => $this->lang->line('examquestion_select_atleast_one').' '.$this->lang->line('examquestion_category')));
        $this->form_validation->set_rules('examquestion_correctanswer', ' ', 'trim|required', array('required' => $this->lang->line('examquestion_select_one').' '.$this->lang->line('examquestion_correct_answer')));
        $this->form_validation->set_rules('examquestion_content', ' ', 'trim|callback_validate_string');
        $this->form_validation->set_rules('examquestion_content_eng', ' ', 'trim|callback_validate_string');        
        $this->form_validation->set_rules('examanswerlist_content_1', ' ', 'trim|callback_validate_string');
        $this->form_validation->set_rules('examanswerlist_content_eng_1', ' ', 'trim|callback_validate_string');
        $this->form_validation->set_rules('examanswerlist_content_2', ' ', 'trim|callback_validate_string');
        $this->form_validation->set_rules('examanswerlist_content_eng_2', ' ', 'trim|callback_validate_string');
        $this->form_validation->set_rules('examanswerlist_content_3', ' ', 'trim|callback_validate_string');
        $this->form_validation->set_rules('examanswerlist_content_eng_3', ' ', 'trim|callback_validate_string');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">&nbsp;', '&nbsp;</span>');
        $this->form_validation->set_message('validate_string','Required');
    }

    public function validate_string($str)
    {   
        $str = strip_tags(trim($str));
        
        if($str == ''){
            return false;
        }
        else {
            return true;
        }
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'examquestion_id',
            'examquestion_content',
            'examquestion_content_eng'
        ];
        $results = $this->examquestion_model->listajax(
            $columns,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";
            if ($this->permission->cp_read == true) {
                $rud .= anchor(site_url('examquestion/view/' . fixzy_encoder($r['examquestion_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('examquestion/update/' . fixzy_encoder($r['examquestion_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('examquestion/delete/' . fixzy_encoder($r['examquestion_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }

            $compulsory = array();
            if($r['examquestion_cat_a_compulsory'] == 'y'){
                array_push($compulsory, 'A');
            }
            if($r['examquestion_cat_b1_compulsory'] == 'y'){
                array_push($compulsory, 'B1');
            }
            if($r['examquestion_cat_b2_compulsory'] == 'y'){
                array_push($compulsory, 'B2');
            }
            if($r['examquestion_cat_c_compulsory'] == 'y'){
                array_push($compulsory, 'C');
            }
            if(count($compulsory)) {
                $str_compulsory = implode( ", ", $compulsory );
            }
            else {
                $str_compulsory = 'N/A';
            }

            $category = array();
            if($r['examquestion_cat_a'] == 'y'){
                array_push($category, 'A');
            }
            if($r['examquestion_cat_b1'] == 'y'){
                array_push($category, 'B1');
            }
            if($r['examquestion_cat_b2'] == 'y'){
                array_push($category, 'B2');
            }
            if($r['examquestion_cat_c'] == 'y'){
                array_push($category, 'C');
            }
            if(count($category)) {
                $str_category = implode( ", ", $category );
            }
            else {
                $str_category = 'N/A';
            }


            array_push($data, [
                $i,
                $r['examquestion_content'],                
                $str_compulsory,
                $str_category,
                $rud
            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->examquestion_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->examquestion_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Examquestion.php */
/* Location: ./application/controllers/Examquestion.php */
