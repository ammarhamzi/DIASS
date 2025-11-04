<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examanswerlist extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('examanswerlist_model');
        $this->lang->load('examanswerlist_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $examanswerlist = $this->examanswerlist_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'examanswerlist_data' => $examanswerlist,
                'permission' => $this->permission,
            ];
            $this->content = 'examanswerlist/examanswerlist_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function read($parent_id, $id)
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->examanswerlist_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examanswerlist_content' => $row->examanswerlist_content,
                    'examanswerlist_correctanswer' => $row->examanswerlist_correctanswer,

                    'parent_id' => $parent_id,
                ];
                $this->content = 'examanswerlist/examanswerlist_read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion/read/' . $parent_id));
            }

        } else {
            redirect('/');
        }

    }

    public function create($parent_id)
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',
                'action' => site_url('examanswerlist/create_action'),
                'parent_id' => $parent_id,
                'examanswerlist_content' => set_value('examanswerlist_content'),
                'examanswerlist_correctanswer' => set_value('examanswerlist_correctanswer'),
                'dropdown_examanswerlist_correctanswer' => [
                    (object) ['id' => 'n', 'value' => 'No'], (object) ['id' => 'y', 'value' => 'Yes'],
                ],

            ];
            $this->content = 'examanswerlist/examanswerlist_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function create_action()
    {

        if ($this->permission->cp_create == true) {

            $parent_id = $this->input->post('examanswerlist_examquestion_id', true);

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->create($parent_id);
            } else {
                $data = [
                    'examanswerlist_examquestion_id' => fixzy_decoder($this->input->post('examanswerlist_examquestion_id', true)),
                    'examanswerlist_content' => $this->input->post('examanswerlist_content', true),
                    'examanswerlist_correctanswer' => $this->input->post('examanswerlist_correctanswer', true),
                    'examanswerlist_created_at' => date('Y-m-d H:i:s'),
                    'examanswerlist_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->examanswerlist_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('examquestion/read/' . $parent_id));
            }

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
            $row = $this->examanswerlist_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('examanswerlist/update_action'),
                    'id' => $id,
                    'parent_id' => $parent_id,
                    'examanswerlist_content' => set_value('examanswerlist_content', $row->examanswerlist_content),
                    'examanswerlist_correctanswer' => set_value('examanswerlist_correctanswer', $row->examanswerlist_correctanswer),
                    'dropdown_examanswerlist_correctanswer' => [
                        (object) ['id' => 'n', 'value' => 'No'], (object) ['id' => 'y', 'value' => 'Yes'],
                    ],

                ];
                $this->content = 'examanswerlist/examanswerlist_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion/read/' . $parent_id));
            }

        } else {
            redirect('/');
        }

    }

    public function update_action()
    {

        if ($this->permission->cp_update == true) {

            $parent_id = $this->input->post('examanswerlist_examquestion_id', true);

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->update($parent_id, $this->input->post('examanswerlist_id', true));
            } else {
                $data = [
                    'examanswerlist_content' => $this->input->post('examanswerlist_content', true),
                    'examanswerlist_correctanswer' => $this->input->post('examanswerlist_correctanswer', true),
                    'examanswerlist_updated_at' => date('Y-m-d H:i:s'),
                    'examanswerlist_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->examanswerlist_model->update(fixzy_decoder($this->input->post('examanswerlist_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('examquestion/read/' . $parent_id));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($parent_id, $id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examanswerlist_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->examanswerlist_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examquestion/read/' . $parent_id));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion/read/' . $parent_id));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($parent_id, $id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examanswerlist_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examanswerlist_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->examanswerlist_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examquestion/read/' . $parent_id));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examquestion/read/' . $parent_id));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('examanswerlist_content', ' ', 'trim|required');
        $this->form_validation->set_rules('examanswerlist_correctanswer', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json($parent_id)
    {
        $id      = fixzy_decoder($parent_id);
        $i       = $this->input->get('start');
        $columns = [
            'examanswerlist_id',
            'examanswerlist_content',
            'examanswerlist_correctanswer',

        ];
        $results = $this->examanswerlist_model->listajax(
            $id,
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
                $rud .= anchor(site_url('examanswerlist/read/' . $parent_id . '/' . fixzy_encoder($r['examanswerlist_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('examanswerlist/update/' . $parent_id . '/' . fixzy_encoder($r['examanswerlist_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('examanswerlist/delete/' . $parent_id . '/' . fixzy_encoder($r['examanswerlist_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['examanswerlist_content'],
                $r['examanswerlist_correctanswer'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->examanswerlist_model->recordsTotal($id)->recordstotal,
                "recordsFiltered" => $this->examanswerlist_model->recordsFiltered($id, $columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Examanswerlist.php */
/* Location: ./application/controllers/Examanswerlist.php */
