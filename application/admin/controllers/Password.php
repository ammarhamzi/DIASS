<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Password extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('password_model');
        $this->lang->load('password_lang', $this->session->userdata('language'));
    }

    public function index()
    {
        $this->update($this->input->post('user_id', true));
    }

    public function update($id = '')
    {
        $id      = fixzy_encoder($this->session->userdata('id'));
        $setting = [
            'method' => 'newpage',
            'patern' => 'form',
        ];
        $row = $this->password_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'button' => $this->lang->line('edit'),
                'action' => site_url('password/update_action'),
                'id' => $id,
                'user_username' => set_value('user_username',
                    $row->user_username),
                'user_password' => set_value('user_password'),
                'user_oldpassword' => set_value('user_oldpassword'),
            ];
            $this->content = 'password/password_form';
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('password'));
        }
    }

    public function update_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('user_id', true));
        } else {

        $now = date('Y-m-d H:i:s');
            $data = [
                'user_password' => sha512($this->input->post('user_password',
                    true)),
                'user_updated_at' => $now,
                'user_lastchanged_by' => $this->session->userdata('id'),
            ];
            $this->password_model->update(fixzy_decoder($this->input->post('user_id')),
                $data);

                $data_changepassword = [
                 'changepassword_userid' => $this->session->userdata('id'),
                 'changepassword_username' => $this->session->userdata('username'),
                 'changepassword_timedate' => $now,
                 'changepassword_method' => 'self',
                 'changepassword_by' => $this->session->userdata('id'),
                 'changepassword_created_at' => $now,
                ];

            $this->password_model->insert_changepwd($data_changepassword);
            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('password'));
        }
    }

    public function check_oldpassword($pwd)
    {
        $myinfo = $this->password_model->get_by_id($this->session->userdata('id'));

        $oldpwd = sha512($pwd);
        if ($myinfo->user_password != $oldpwd) {
            $this->form_validation->set_message('check_oldpassword',
                'Wrong Password');
            return false;
        } else {
            return true;
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('user_username', ' ', 'trim|required');
        $this->form_validation->set_rules('user_password', ' ', 'trim|required');
        $this->form_validation->set_rules('user_oldpassword', ' ',
            'trim|required|callback_check_oldpassword');
        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }
}
;
/* End of file Password.php */
/* Location: ./application/controllers/Password.php */
