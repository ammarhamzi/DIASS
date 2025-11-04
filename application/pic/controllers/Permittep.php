<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permittep extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('permittep_lang', $this->session->userdata('language'));

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
                'controller' => 'permittep',
                'pagetitle' => 'Temporary Entry Permits',
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
/* End of file Permittep.php */
/* Location: ./application/controllers/Permittep.php */
