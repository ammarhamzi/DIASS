<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('my_model');
        $this->load->model('usergroup_model');
        $this->load->model('permit_model');
        $this->load->model('permitall_model');
        $this->load->model('Enforcement_permit_model');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {

        //$theme = $this->my_model->get_value("config","config_value", "config_deleted_at IS NULL and config_name = 'theme'")->config_value;
        //$this->session->set_userdata('theme', $theme);
        //if($config[0]->config_value == "y" && !$this->session->userdata('islogin')){
        //$exist = $this->my_model->get_columnscheme($table);
        //redirect(site_url('Authentication'));
        //}else{

        $setting = [
            'method' => 'modalpage',
            'patern' => 'list',
        ];
        //get user type
        $usergroup = $this->usergroup_model->get_by_id($this->session->userdata('groupid'));
        if($usergroup){
          $user_type = $usergroup->usergroup_type;
        }else{
          redirect(site_url('authentication/logout'));
        }

        if ($user_type == 1) {

            $data = [
                'permit_summary' => $this->permit_model->permit_summary(),
                'adppermit_summary' => $this->permit_model->adppermit_summary(),
                'avppermit_summary' => $this->permit_model->avppermit_summary(),
                'pending_checkdoc' => $this->permit_model->permit_pending_checkdoc(),
                'pending_checkdocvehicle' => $this->permit_model->permit_pending_checkdocvehicle(),
                'pending_approval' => $this->permit_model->permit_pending_approval(),
                'pending_payment' => $this->permit_model->permit_pending_payment(),
                'permit_expired' => $this->permit_model->permit_expired(),
                'permit_terminate' => $this->permit_model->permit_terminate(),
                'permit_cancel' => $this->permit_model->permit_cancel(),
                'permit_replace' => $this->permit_model->permit_replace(),
                'pending_printout' => $this->permit_model->permit_uncollected(),
                'permit_suspend_count' => $this->Enforcement_permit_model->count_suspend_permit(),
            ];

            if($this->session->userdata('groupid')=="9"){
            //Admin Licensing
              $this->content = 'foundation/dashboard/dashboard_airsideadmin';
            }elseif($this->session->userdata('groupid')=="8"){
            //Inspector
              $this->content = 'foundation/dashboard/dashboard_mtwadmin';
            }elseif($this->session->userdata('groupid')=="7"){
            //terminal admin
              //$this->content = 'foundation/dashboard/dashboard_terminaladmin';
              redirect(site_url('Evdppermit'));

            }elseif($this->session->userdata('groupid')=="10"){
            //airside manager
               $this->content = 'foundation/dashboard/dashboard_airsidemanager';

            }elseif($this->session->userdata('groupid')=="11"){
            //Mechanical Engineer
               $this->content = 'foundation/dashboard/dashboard_mtwmanager';

            }elseif($this->session->userdata('groupid')=="12"){
            //enforcement
               redirect(site_url('Enforcement'));

            }else{
            // super admin
              $this->content = 'foundation/dashboard/dashboard_superadmin';
            }

        } elseif ($user_type == 2) {
            $this->content = 'foundation/dashboard_client';
        } elseif ($user_type == 3) {
            $this->content = 'foundation/dashboard_vendor';
        } else {
        redirect(site_url('authentication/logout'));
        }

        $this->layout($data, $setting);

        //}
        //$this->load->view('welcome_message');
    }

    public function test(){
/*        $setting = [
            'method' => 'modalpage',
            'patern' => 'list',
        ];

        $data = [];

        $this->content = 'foundation/dashboard';
        $this->layout($data, $setting);*/
        $current_serialno = $this->permitall_model->get_lastinvoiceno();
        echo extractNumber($current_serialno);
    }
}
