<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitpendingpayment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('permitpendingpayment_lang', $this->session->userdata('language'));
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
                'controller' => 'permitpendingpayment',
                'pagetitle' => 'Pending Payment Permits',
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
/* End of file Permitpendingpayment.php */
/* Location: ./application/controllers/Permitpendingpayment.php */
