<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitrenew extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('permitrenew_lang', $this->session->userdata('language'));
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
                'controller' => 'permitrenew',
                'pagetitle' => 'Expired Soon Permits',
            ];

            $this->content = 'permitall/permitall_list_nostatus';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

}
;
/* End of file Permitrenew.php */
/* Location: ./application/controllers/Permitrenew.php */
