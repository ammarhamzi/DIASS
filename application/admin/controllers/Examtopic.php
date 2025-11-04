<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examtopic extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('examtopic_model');
        $this->lang->load('examtopic_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $examtopic = $this->examtopic_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'examtopic_data' => $examtopic,
                'permission' => $this->permission,
            ];

            $this->content = 'examtopic/examtopic_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

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
            $row = $this->examtopic_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examtopic_title' => $row->examtopic_title,
                    'examtopic_description' => $row->examtopic_description,

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

                    $this->content = 'examtopic/examtopic_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('examtopic/examtopic_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtopic'));
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
                'action' => site_url('examtopic/create_action'),
                'examtopic_title' => set_value('examtopic_title'),
                'examtopic_description' => set_value('examtopic_description'),

            ];
            $this->content = 'examtopic/examtopic_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function create_action()
    {

        if ($this->permission->cp_create == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->create();
            } else {
                $data = [
                    'examtopic_title' => $this->input->post('examtopic_title', true),
                    'examtopic_description' => $this->input->post('examtopic_description', true),
                    'examtopic_created_at' => date('Y-m-d H:i:s'),
                    'examtopic_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->examtopic_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('examtopic'));
            }

        } else {
            redirect('/');
        }

    }

    public function update($id)
    {

        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $row = $this->examtopic_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('examtopic/update_action'),
                    'id' => $id,
                    'examtopic_title' => set_value('examtopic_title', $row->examtopic_title),
                    'examtopic_description' => set_value('examtopic_description', $row->examtopic_description),

                ];
                $this->content = 'examtopic/examtopic_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtopic'));
            }

        } else {
            redirect('/');
        }

    }

    public function update_action()
    {

        if ($this->permission->cp_update == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('examtopic_id', true));
            } else {
                $data = [
                    'examtopic_title' => $this->input->post('examtopic_title', true),
                    'examtopic_description' => $this->input->post('examtopic_description', true),
                    'examtopic_updated_at' => date('Y-m-d H:i:s'),
                    'examtopic_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->examtopic_model->update(fixzy_decoder($this->input->post('examtopic_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('examtopic'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examtopic_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->examtopic_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examtopic'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtopic'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examtopic_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examtopic_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->examtopic_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examtopic'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtopic'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('examtopic_title', ' ', 'trim|required');
        $this->form_validation->set_rules('examtopic_description', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'examtopic_id',
            'examtopic_title',
            'examtopic_description',

        ];
        $results = $this->examtopic_model->listajax(
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
                $rud .= anchor(site_url('examtopic/read/' . fixzy_encoder($r['examtopic_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('examtopic/update/' . fixzy_encoder($r['examtopic_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('examtopic/delete/' . fixzy_encoder($r['examtopic_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['examtopic_title'],
                $r['examtopic_description'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->examtopic_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->examtopic_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Examtopic.php */
/* Location: ./application/controllers/Examtopic.php */
