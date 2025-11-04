<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitpendingapproval extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('permitpendingapproval_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
                'controller' => 'permitpendingapproval',
                'pagetitle' => 'Pending Approval Permits',
            ];

            $this->content = 'permitall/permitall_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

}
;
/* End of file Permitpendingapproval.php */
/* Location: ./application/controllers/Permitpendingapproval.php */
