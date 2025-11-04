<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Profile extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
        $this->lang->load('profile_lang', $this->session->userdata('language'));
        $this->load->model('pic_model');
        $this->lang->load('pic_lang', $this->session->userdata('language'));
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
        $row = $this->profile_model->get_by_id(fixzy_decoder($id));

        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $rowpic = $this->pic_model->get_by_id($row->user_customid);
            $data   = [
                'button' => $this->lang->line('edit'),
                'action' => site_url('profile/update_action'),
                'id' => $id,
                'user_username' => set_value('user_username',
                    $row->user_username),
                'user_name' => set_value('user_name', $row->user_name),
                'user_email' => set_value('user_email', $row->user_email),
                'user_photo' => set_value('user_photo', $row->user_photo),
                'picid' => fixzy_encoder($row->user_customid),
                'pic_handphone' => set_value('pic_handphone', $rowpic->pic_handphone),
            ];
            $this->content = 'profile/profile_form';
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profile'));
        }
    }

    public function update_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('user_id', true));
        } else {
            $data = [
                'user_name' => $this->input->post('user_name', true),
                'user_email' => $this->input->post('user_email', true),
                'user_photo' => $this->input->post('user_photo', true),
                'user_updated_at' => date('Y-m-d H:i:s'),
                'user_lastchanged_by' => $this->session->userdata('id'),
            ];
            $this->profile_model->update(fixzy_decoder($this->input->post('user_id')),
                $data);
            $this->pic_model->update(fixzy_decoder($this->input->post('pic_id')),
                ['pic_handphone' => $this->input->post('pic_handphone', true)]);
            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profile'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('user_username', ' ', 'trim|required');
        $this->form_validation->set_rules('user_name', ' ', 'trim|required');
        $this->form_validation->set_rules('user_email', ' ', 'trim|required');
        $this->form_validation->set_rules('user_photo', ' ', 'trim');
        $this->form_validation->set_rules('pic_handphone', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }
}
;
/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */
