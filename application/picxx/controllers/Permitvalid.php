<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitvalid extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('permitvalid_lang', $this->session->userdata('language'));

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
                'controller' => 'permitvalid',
                'pagetitle' => 'Active Permits',
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
/* End of file Permitvalid.php */
/* Location: ./application/controllers/Permitvalid.php */
