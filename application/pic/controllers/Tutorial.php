<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tutorial extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
/*    $this->load->model('testschool_model');
$this->lang->load('testschool_lang', $this->session->userdata('language'));*/

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
            'method' => 'newpage',
            'patern' => 'list',
            ];
            $data = [];

            $this->content = 'tutorial/getting-started';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function adp_info()
    {
        if ($this->permission->showlist == true) {

            $setting = [
            'method' => 'newpage',
            'patern' => 'list',
            ];
            $data = [];

            $this->content = 'tutorial/kb-adp';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }
    }

    public function escort_info()
    {
        if ($this->permission->showlist == true) {

            $setting = [
            'method' => 'newpage',
            'patern' => 'list',
            ];
            $data = [];

            $this->content = 'tutorial/kb-escort';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }
    }

    public function speed_info()
    {
        if ($this->permission->showlist == true) {

            $setting = [
            'method' => 'newpage',
            'patern' => 'list',
            ];
            $data = [];

            $this->content = 'tutorial/kb-speed';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }
    }

    public function tep_info()
    {
        if ($this->permission->showlist == true) {

            $setting = [
            'method' => 'newpage',
            'patern' => 'list',
            ];
            $data = [];

            $this->content = 'tutorial/kb-tep';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }
    }

}
;
/* End of file Testschool.php */
/* Location: ./application/controllers/Testschool.php */
