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
                'method' => 'modalpage',
                'patern' => 'read',
            ];
            $data = [];

            $this->content = 'foundation/tutorial';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting, 0);

        } else {
            redirect('/');
        }

    }

}
;
/* End of file Testschool.php */
/* Location: ./application/controllers/Testschool.php */
