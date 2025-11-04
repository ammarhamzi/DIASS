<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Exambanklist extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('exambanklist_model');
        $this->lang->load('exambanklist_lang', $this->session->userdata('language'));

    }

    public function compulsoryquestion($id)
    {

        if ($this->permission->showlist == true) {
            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $exambanklist = $this->exambanklist_model->get_all_filter_fk($id);
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'exambanklist_data' => $exambanklist,
                'permission' => $this->permission,
                'parent_id' => fixzy_encoder($id),
            ];
//check if parentchild exist
            $parent_id = $this->my_model->get_value2('tabslave', 'tabslave_parent_id',
                "tabslave_controller = '" . strtolower($this->router->fetch_class()) . "' and tabslave_parent_id != 0");

            if (!empty($parent_id)) {
                $data_parentchild = [
                    'parentchildmenu' => $this->my_model->get_data('tabslave', '*',
                        "tabslave_id = $parent_id or tabslave_parent_id = $parent_id"),
                    'currentcontroller' => strtolower($this->router->fetch_class()),
                    'currentmethod' => strtolower($this->router->fetch_method()),
                    'parentid' => fixzy_encoder($id),
                ];

                $this->parentchildmenu = $this->load->view('foundation/parentchildmenu',
                    $data_parentchild, true);
            }
            $this->content = 'exambanklist/exambanklist_compulsory_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function generalquestion($id)
    {

        if ($this->permission->showlist == true) {
            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $exambanklist = $this->exambanklist_model->get_all_filter_fk($id);
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'exambanklist_data' => $exambanklist,
                'permission' => $this->permission,
                'parent_id' => fixzy_encoder($id),
            ];
//check if parentchild exist
            $parent_id = $this->my_model->get_value2('tabslave', 'tabslave_parent_id',
                "tabslave_controller = '" . strtolower($this->router->fetch_class()) . "' and tabslave_parent_id != 0");

            if (!empty($parent_id)) {
                $data_parentchild = [
                    'parentchildmenu' => $this->my_model->get_data('tabslave', '*',
                        "tabslave_id = $parent_id or tabslave_parent_id = $parent_id"),
                    'currentcontroller' => strtolower($this->router->fetch_class()),
                    'currentmethod' => strtolower($this->router->fetch_method()),
                    'parentid' => fixzy_encoder($id),
                ];

                $this->parentchildmenu = $this->load->view('foundation/parentchildmenu',
                    $data_parentchild, true);
            }
            $this->content = 'exambanklist/exambanklist_general_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function read($parent_id, $id)
    {

        if ($this->permission->cp_read == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->exambanklist_model->get_read(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'exambanklist_examquestion_id' => $row->examquestion_content_exambanklist_examquestion_id,

                    'parent_id' => $parent_id,
                ];

                $this->content = 'exambanklist/exambanklist_read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exambanklist'));
            }

        } else {
            redirect('/');
        }

    }

    public function create($parent_id)
    {
        $id = fixzy_decoder($parent_id);
        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];

            $selected_examquestion = $this->exambanklist_model->get_selected_examquestion($id);
            $examquestion          = [];
            foreach ($selected_examquestion as $value) {
                $examquestion[] = $value->exambanklist_examquestion_id;
            }
            $data = [
                'button' => 'Create',
                'action' => site_url('exambanklist/create_action'),
                'parent_id' => $parent_id,
                'exambanklist_examquestion_id' => $examquestion,
                'examquestion' => $this->exambanklist_model->get_all_examquestion(),

            ];
            $this->content = 'exambanklist/exambanklist_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function create_action()
    {

        if ($this->permission->cp_create == true) {

            $parent_id = $this->input->post('exambanklist_exambank_id', true);
            $id        = fixzy_decoder($parent_id);
            $this->_rules();

/*    if ($this->form_validation->run() == FALSE) {
$this->create($parent_id);
}
else {*/
            $selected_examquestion = $this->input->post("exambanklist_examquestion_id");
            //print_r($selected_examquestion);
            $this->exambanklist_model->delete($id);
            foreach ($selected_examquestion as $question) {
                $data = [
                    'exambanklist_exambank_id' => fixzy_decoder($this->input->post('exambanklist_exambank_id', true)),
                    'exambanklist_examquestion_id' => $question,
                    'exambanklist_created_at' => date('Y-m-d H:i:s'),
                    'exambanklist_lastchanged_by' => $this->session->userdata('id'),
                ];

                $this->exambanklist_model->insert($data);
                //$primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */
            }

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('exambanklist/generalquestion/' . $parent_id));
            //}

        } else {
            redirect('/');
        }

    }

    public function update($parent_id, $id)
    {

        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $row = $this->exambanklist_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('exambanklist/update_action'),
                    'id' => $id,
                    'parent_id' => $parent_id,
                    'exambanklist_examquestion_id' => set_value('exambanklist_examquestion_id', $row->exambanklist_examquestion_id),
                    'examquestion' => $this->exambanklist_model->get_all_examquestion(),

                ];
                $this->content = 'exambanklist/exambanklist_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exambanklist'));
            }

        } else {
            redirect('/');
        }

    }

    public function update_action()
    {

        if ($this->permission->cp_update == true) {

            $parent_id = $this->input->post('exambanklist_exambank_id', true);

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->update($parent_id, $this->input->post('exambanklist_id', true));
            } else {
                $data = [
                    'exambanklist_examquestion_id' => $this->input->post('exambanklist_examquestion_id', true),
                    'exambanklist_updated_at' => date('Y-m-d H:i:s'),
                    'exambanklist_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->exambanklist_model->update(fixzy_decoder($this->input->post('exambanklist_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('exambanklist/index/' . $parent_id));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->exambanklist_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->exambanklist_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('exambanklist'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exambanklist'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->exambanklist_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'exambanklist_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->exambanklist_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('exambanklist'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exambanklist'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('exambanklist_examquestion_id', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json($parent_id, $type = "")
    {
        $id = fixzy_decoder($parent_id);
        $i  = $this->input->get('start');

        if ($type == 'general') {
            $columns = [
                'exambanklist_id',
                'exambanklist_examquestion_id',

            ];
            $results = $this->exambanklist_model->listajax_general($id,
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
                    $rud .= anchor(site_url('examquestion/read//' . fixzy_encoder($r['exambanklist_examquestion_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                        ' ';
                }
/*                if($this->permission->cp_update == true){
$rud .=    anchor(site_url('exambanklist/update/'.$parent_id.'/'.fixzy_encoder($r['exambanklist_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
' ';
}
if($this->permission->cp_delete == true){
$rud .= anchor(site_url('exambanklist/delete/'.$parent_id.'/'.fixzy_encoder($r['exambanklist_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
}*/
                array_push($data, [
                    $i,
                    $r['examquestion_content_exambanklist_examquestion_id'],

                    $rud

                ]);
            }
            echo json_encode(
                [
                    "draw" => intval($this->input->get('draw')),
                    "recordsTotal" => $this->exambanklist_model->recordsTotal_general($id)->recordstotal,
                    "recordsFiltered" => $this->exambanklist_model->recordsFiltered_general($id, $columns, $this->input->get('search')['value'])->recordsfiltered,
                    'data' => $data
                ]
            );
        } else {
            $columns = [
                'examquestion_id',
                'examquestion_id',

            ];
            $results = $this->exambanklist_model->listajax(
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
                    $rud .= anchor(site_url('examquestion/read//' . fixzy_encoder($r['examquestion_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                        ' ';
                }
/*                if($this->permission->cp_update == true){
$rud .=    anchor(site_url('exambanklist/update/'.$parent_id.'/'.fixzy_encoder($r['exambanklist_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
' ';
}
if($this->permission->cp_delete == true){
$rud .= anchor(site_url('exambanklist/delete/'.$parent_id.'/'.fixzy_encoder($r['exambanklist_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
}*/
                array_push($data, [
                    $i,
                    $r['examquestion_content_exambanklist_examquestion_id'],

                    $rud

                ]);
            }

            echo json_encode(
                [
                    "draw" => intval($this->input->get('draw')),
                    "recordsTotal" => $this->exambanklist_model->recordsTotal()->recordstotal,
                    "recordsFiltered" => $this->exambanklist_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                    'data' => $data
                ]
            );
        }

    }

/* public function decode($id){
echo fixzy_decoder($id);
}*/
}
;
/* End of file Exambanklist.php */
/* Location: ./application/controllers/Exambanklist.php */
