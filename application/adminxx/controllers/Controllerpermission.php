<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controllerpermission extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('controllerpermission_model');
        $this->lang->load('controllerpermission_lang',
            $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'modalpage',
                'patern' => 'list',
            ];
            $controllerpermission = $this->controllerpermission_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'controllerpermission_data' => $controllerpermission,
                'permission' => $this->permission,
            ];
            $this->content = 'controllerpermission/controllerpermission_list';
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

    public function read($id)
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'modalpage',
                'patern' => 'read',
            ];
            $row = $this->controllerpermission_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'cp_controller_id' => $row->control_name_cp_controller_id,
                    'cp_usergroup' => $row->usergroup_name_cp_usergroup,
                    'showlist' => $row->showlist,
                    'cp_create' => $row->cp_create,
                    'cp_update' => $row->cp_update,
                    'cp_delete' => $row->cp_delete,
                    'cp_read' => $row->cp_read,
                    'printlist' => $row->printlist,
                ];
                $this->content = 'controllerpermission/controllerpermission_read';
                $this->layout($data, $setting, 0);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('controllerpermission'));
            }
        } else {
            redirect('/');
        }
    }

    public function create()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'modalpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',
                'action' => site_url('controllerpermission/create_action'),
                'cp_controller_id' => set_value('cp_controller_id'),
                'reg_controller' => $this->controllerpermission_model->get_all_reg_controller(),
                'cp_usergroup' => set_value('cp_usergroup'),
                'usergroup' => $this->controllerpermission_model->get_all_usergroup(),
                'showlist' => set_value('showlist'),
                'dropdown_showlist' => [
                    (object) ['id' => '1', 'value' => 'Show'], (object) [
                        'id' => '0', 'value' => 'Hidden'],
                ],
                'cp_create' => set_value('cp_create'),
                'dropdown_cp_create' => [
                    (object) ['id' => '1', 'value' => 'Show'], (object) [
                        'id' => '0', 'value' => 'Hidden'],
                ],
                'cp_update' => set_value('cp_update'),
                'dropdown_cp_update' => [
                    (object) ['id' => '1', 'value' => 'Show'], (object) [
                        'id' => '0', 'value' => 'Hidden'],
                ],
                'cp_delete' => set_value('cp_delete'),
                'dropdown_cp_delete' => [
                    (object) ['id' => '1', 'value' => 'Show'], (object) [
                        'id' => '0', 'value' => 'Hidden'],
                ],
                'cp_read' => set_value('cp_read'),
                'dropdown_cp_read' => [
                    (object) ['id' => '1', 'value' => 'Show'], (object) [
                        'id' => '0', 'value' => 'Hidden'],
                ],
                'printlist' => set_value('printlist'),
                'dropdown_printlist' => [
                    (object) ['id' => '1', 'value' => 'Show'], (object) [
                        'id' => '0', 'value' => 'Hidden'],
                ],
            ];
            $this->content = 'controllerpermission/controllerpermission_form';
            $this->layout($data, $setting, 0);
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
                    'cp_controller_id' => $this->input->post('cp_controller_id',
                        true),
                    'cp_usergroup' => $this->input->post('cp_usergroup', true),
                    'showlist' => $this->input->post('showlist', true),
                    'cp_create' => $this->input->post('cp_create', true),
                    'cp_update' => $this->input->post('cp_update', true),
                    'cp_delete' => $this->input->post('cp_delete', true),
                    'cp_read' => $this->input->post('cp_read', true),
                    'printlist' => $this->input->post('printlist', true),
                    'cp_created_at' => date('Y-m-d H:i:s'),
                    'cp_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->controllerpermission_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                js_redirect_parent();
            }
        } else {
            redirect('/');
        }
    }

    public function update($id)
    {

        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'modalpage',
                'patern' => 'form',
            ];
            $row = $this->controllerpermission_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('controllerpermission/update_action'),
                    'id' => $id,
                    'cp_controller_id' => set_value('cp_controller_id',
                        $row->cp_controller_id),
                    'reg_controller' => $this->controllerpermission_model->get_all_reg_controller(),
                    'cp_usergroup' => set_value('cp_usergroup',
                        $row->cp_usergroup),
                    'usergroup' => $this->controllerpermission_model->get_all_usergroup(),
                    'showlist' => set_value('showlist', $row->showlist),
                    'dropdown_showlist' => [
                        (object) ['id' => '1', 'value' => 'Show'], (object) [
                            'id' => '0', 'value' => 'Hidden'],
                    ],
                    'cp_create' => set_value('cp_create', $row->cp_create),
                    'dropdown_cp_create' => [
                        (object) ['id' => '1', 'value' => 'Show'], (object) [
                            'id' => '0', 'value' => 'Hidden'],
                    ],
                    'cp_update' => set_value('cp_update', $row->cp_update),
                    'dropdown_cp_update' => [
                        (object) ['id' => '1', 'value' => 'Show'], (object) [
                            'id' => '0', 'value' => 'Hidden'],
                    ],
                    'cp_delete' => set_value('cp_delete', $row->cp_delete),
                    'dropdown_cp_delete' => [
                        (object) ['id' => '1', 'value' => 'Show'], (object) [
                            'id' => '0', 'value' => 'Hidden'],
                    ],
                    'cp_read' => set_value('cp_read', $row->cp_read),
                    'dropdown_cp_read' => [
                        (object) ['id' => '1', 'value' => 'Show'], (object) [
                            'id' => '0', 'value' => 'Hidden'],
                    ],
                    'printlist' => set_value('printlist', $row->printlist),
                    'dropdown_printlist' => [
                        (object) ['id' => '1', 'value' => 'Show'], (object) [
                            'id' => '0', 'value' => 'Hidden'],
                    ],
                ];
                $this->content = 'controllerpermission/controllerpermission_form';
                $this->layout($data, $setting, 0);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                js_redirect_parent();
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
                $this->update($this->input->post('cp_id', true));
            } else {
                $data = [
                    'showlist' => $this->input->post('showlist', true),
                    'cp_create' => $this->input->post('cp_create', true),
                    'cp_update' => $this->input->post('cp_update', true),
                    'cp_delete' => $this->input->post('cp_delete', true),
                    'cp_read' => $this->input->post('cp_read', true),
                    'printlist' => $this->input->post('printlist', true),
                    'cp_updated_at' => date('Y-m-d H:i:s'),
                    'cp_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->controllerpermission_model->update(fixzy_decoder($this->input->post('cp_id')),
                    $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                js_redirect_parent();
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->controllerpermission_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->controllerpermission_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('controllerpermission'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('controllerpermission'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->controllerpermission_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'cp_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->controllerpermission_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('controllerpermission'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('controllerpermission'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('cp_controller_id', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('cp_usergroup', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('showlist', ' ',
            'trim|required|is_natural');
        $this->form_validation->set_rules('cp_create', ' ',
            'trim|required|is_natural');
        $this->form_validation->set_rules('cp_update', ' ',
            'trim|required|is_natural');
        $this->form_validation->set_rules('cp_delete', ' ',
            'trim|required|is_natural');
        $this->form_validation->set_rules('cp_read', ' ',
            'trim|required|is_natural');
        $this->form_validation->set_rules('printlist', ' ',
            'trim|required|is_natural');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'cp_id',
            'cp_controller_id',
            'cp_usergroup',
            'showlist',
            'cp_create',
            'cp_update',
            'cp_delete',
            'cp_read',
            'printlist',
        ];
        $results = $this->controllerpermission_model->listajax(
            $columns, $this->input->get('start'), $this->input->get('length'),
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            array_push($data,
                [
                    $i,
                    $r['control_name_cp_controller_id'],
                    $r['usergroup_name_cp_usergroup'],
                    $r['showlist'],
                    $r['cp_create'],
                    $r['cp_update'],
                    $r['cp_delete'],
                    $r['cp_read'],
                    $r['printlist'],
                    anchor(site_url('controllerpermission/read/' . fixzy_encoder($r['cp_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('controllerpermission/update/' . fixzy_encoder($r['cp_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('controllerpermission/delete/' . fixzy_encoder($r['cp_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->controllerpermission_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->controllerpermission_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Controllerpermission.php */
/* Location: ./application/controllers/Controllerpermission.php */
