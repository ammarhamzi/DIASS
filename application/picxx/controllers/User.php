<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->lang->load('user_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $user = $this->user_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'user_data' => $user,
                'permission' => $this->permission,
            ];
            $this->content = 'user/user_list';
            ##--slave_combine_to_list--##
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
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->user_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'user_username' => $row->user_username,
                    'user_password' => $row->user_password,
                    'user_name' => $row->user_name,
                    'user_email' => $row->user_email,
                    'user_photo' => $row->user_photo,
                    'user_groupid' => $row->usergroup_name_user_groupid,
                ];
                $this->content = 'user/user_read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('user'));
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
                'action' => site_url('user/create_action'),
                'user_username' => set_value('user_username'),
                'user_password' => set_value('user_password'),
                'user_name' => set_value('user_name'),
                'user_email' => set_value('user_email'),
                'user_photo' => set_value('user_photo'),
                'user_groupid' => set_value('user_groupid'),
                'usergroup' => $this->user_model->get_all_usergroup(),
            ];
            $this->content = 'user/user_form';
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
                    'user_username' => $this->input->post('user_username', true),
                    'user_password' => sha512($this->input->post('user_password',
                        true)),
                    'user_name' => $this->input->post('user_name', true),
                    'user_email' => $this->input->post('user_email', true),
                    'user_photo' => $this->input->post('user_photo', true),
                    'user_groupid' => $this->input->post('user_groupid', true),
                    'user_created_at' => date('Y-m-d H:i:s'),
                    'user_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->user_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('user'));
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
            $row = $this->user_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('user/update_action'),
                    'id' => $id,
                    'user_username' => set_value('user_username',
                        $row->user_username),
                    'user_password' => set_value('user_password',
                        $row->user_password),
                    'user_name' => set_value('user_name', $row->user_name),
                    'user_email' => set_value('user_email', $row->user_email),
                    'user_photo' => set_value('user_photo', $row->user_photo),
                    'user_groupid' => set_value('user_groupid',
                        $row->user_groupid),
                    'usergroup' => $this->user_model->get_all_usergroup(),
                ];
                $this->content = 'user/user_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('user'));
            }
        } else {
            redirect('/');
        }
    }

    public function update_action()
    {

        if ($this->permission->cp_update == true) {

            if ($this->input->post('user_password', true) != "") {
                $this->_rules();
            } else {
                $this->_rules_nopassword();
            }

            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('user_id', true));
            } else {
                if ($this->input->post('user_password', true) != "") {
                    $data = [
                        'user_password' => sha512($this->input->post('user_password',
                            true)),
                        'user_name' => $this->input->post('user_name', true),
                        'user_email' => $this->input->post('user_email', true),
                        'user_photo' => $this->input->post('user_photo', true),
                        'user_groupid' => $this->input->post('user_groupid',
                            true),
                        'user_updated_at' => date('Y-m-d H:i:s'),
                        'user_lastchanged_by' => $this->session->userdata('id'),
                    ];
                } else {
                    $data = [
                        'user_name' => $this->input->post('user_name', true),
                        'user_email' => $this->input->post('user_email', true),
                        'user_photo' => $this->input->post('user_photo', true),
                        'user_groupid' => $this->input->post('user_groupid',
                            true),
                    ];
                }

                $this->user_model->update(fixzy_decoder($this->input->post('user_id')),
                    $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('user'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->user_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->user_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('user'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('user'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->user_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'user_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->user_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('user'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('user'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('user_username', ' ', 'trim|required');
        $this->form_validation->set_rules('user_password', ' ', 'trim|required');
        $this->form_validation->set_rules('user_name', ' ', 'trim|required');
        $this->form_validation->set_rules('user_email', ' ', 'trim|required');
        $this->form_validation->set_rules('user_photo', ' ', 'trim');
        $this->form_validation->set_rules('user_groupid', ' ',
            'trim|required|integer');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }

    public function _rules_nopassword()
    {
        $this->form_validation->set_rules('user_username', ' ', 'trim|required');
        $this->form_validation->set_rules('user_name', ' ', 'trim|required');
        $this->form_validation->set_rules('user_email', ' ', 'trim|required');
        $this->form_validation->set_rules('user_photo', ' ', 'trim');
        $this->form_validation->set_rules('user_groupid', ' ',
            'trim|required|integer');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'user_id',
            'user_username',
            'user_password',
            'user_name',
            'user_email',
            'user_photo',
            'user_groupid',
        ];
        $results = $this->user_model->listajax(
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
                    $r['user_username'],
                    $r['user_password'],
                    $r['user_name'],
                    $r['user_email'],
                    $r['user_photo'],
                    $r['usergroup_name_user_groupid'],
                    anchor(site_url('user/read/' . fixzy_encoder($r['user_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('user/update/' . fixzy_encoder($r['user_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('user/delete/' . fixzy_encoder($r['user_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->user_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->user_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file User.php */
/* Location: ./application/controllers/User.php */
