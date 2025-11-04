<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Foundation extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('foundation_model');
        $this->lang->load('foundation_lang',
            $this->session->userdata('language'));
    }

    public function config()
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'form',
        ];

        /* $this->logQueries($this->config->item('dblog')); */

        $config = $this->foundation_model->get_all();
        //printr($config);
        $data = [
            'button' => $this->lang->line('edit'),
            'action' => site_url('foundation/update_config'),
            'authentication' => set_value('authentication',
                $config[0]->config_value),
            'theme' => set_value('theme', $config[1]->config_value),
            'language' => set_value('language', $config[2]->config_value),
            'admintitle_long' => set_value('admintitle_long',
                $config[3]->config_value),
            'admintitle_short' => set_value('admintitle_short',
                $config[4]->config_value),
            'copyright_notice' => set_value('copyright_notice',
                $config[5]->config_value),
            'version_info' => set_value('version_info', $config[6]->config_value),
        ];
        $this->content = 'foundation/configure';
        $this->layout($data, $setting);
    }

    public function update_config()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->config();
        } else {

            $this->foundation_model->update('authentication',
                ['config_value' => $this->input->post('authentication',
                    true)]);
            $this->foundation_model->update('theme',
                ['config_value' => $this->input->post('theme', true)]);
            $this->foundation_model->update('language',
                ['config_value' => $this->input->post('language', true)]);
            $this->foundation_model->update('admintitle_long',
                ['config_value' => $this->input->post('admintitle_long',
                    true)]);
            $this->foundation_model->update('admintitle_short',
                ['config_value' => $this->input->post('admintitle_short',
                    true)]);
            $this->foundation_model->update('copyright_notice',
                ['config_value' => $this->input->post('copyright_notice',
                    true)]);
            $this->foundation_model->update('version_info',
                ['config_value' => $this->input->post('version_info', true)]);

            $this->session->set_userdata('theme',
                $this->input->post('theme', true));
            $this->session->set_userdata('language',
                $this->input->post('language', true));
            $this->session->set_userdata('admintitle_long',
                $this->input->post('admintitle_long', true));
            $this->session->set_userdata('admintitle_short',
                $this->input->post('admintitle_short', true));
            $this->session->set_userdata('copyright_notice',
                $this->input->post('copyright_notice', true));
            $this->session->set_userdata('version_info',
                $this->input->post('version_info', true));

            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('foundation/config'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('authentication', ' ', 'trim|required');
        $this->form_validation->set_rules('theme', ' ', 'trim|required');
        $this->form_validation->set_rules('language', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }
}
;
/* End of file Refcountry.php */
/* Location: ./application/controllers/Refcountry.php */
