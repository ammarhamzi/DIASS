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
        $this->load->model('driver_model');
        $this->load->model('vehicle_model');
        $this->load->model('permitpendingapproval_model');
        $this->load->model('permitpendingpayment_model');
        $this->load->model('permitrenew_model');
        $this->load->model('permittep_model');
        $this->lang->load('permit_lang', $this->session->userdata('language'));

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

        // $theme = $this->my_model->get_value("config","config_value", "config_deleted_at is null and config_name = 'theme'")->config_value;
        // $this->session->set_userdata('theme', $theme);
        // if($config[0]->config_value == "y" && !$this->session->userdata('islogin')){
        // $exist = $this->my_model->get_columnscheme($table);
        // redirect(site_url('authentication'));
        // }else{

        $setting = [
            'method' => 'modalpage',
            'patern' => 'list',
        ];
        //get user type
        $user_type = $this->usergroup_model->get_by_id($this->session->userdata('groupid'))->usergroup_type;
        $permit = $this->permit_model->getfull_by_companyid($this->session->userdata('companyid'),10);
        $totalpermit = $this->permit_model->get_count_allpermit_bycompany($this->session->userdata('companyid'));
        $totalpermitpendingapproval = $this->permitpendingapproval_model->get_count_allpermit_bycompany($this->session->userdata('companyid'));
        $totalpermitpendingpayment = $this->permitpendingpayment_model->get_count_allpermit_bycompany($this->session->userdata('companyid'));
        $totalpermitexpiredsoon = $this->permitrenew_model->get_count_allpermit_bycompany($this->session->userdata('companyid'));
        $totaldriver = $this->driver_model->get_count_alldriver_bycompany($this->session->userdata('companyid'));
        $totalvehicle = $this->vehicle_model->get_count_allvehicle_bycompany($this->session->userdata('companyid'));


$totalpermittep = $this->permittep_model->get_count_allpermit_bycompany($this->session->userdata('companyid'));
/*        print_r($permit);
        exit;*/
            $data = [
                'permit_data' => $permit,
                'permission' => $this->permission,
                'totalpermit' => $totalpermit,
                'totalpermitpendingapproval' =>$totalpermitpendingapproval,
                'totalpermitpendingpayment' => $totalpermitpendingpayment,
                'totalpermitexpiredsoon' => $totalpermitexpiredsoon,
                'totaldriver' => $totaldriver,
                'totalvehicle' => $totalvehicle,
                'totalpermittep' => $totalpermittep,
            ];

        if ($user_type == 1) {
            $this->content = 'foundation/dashboard_staff';
        } elseif ($user_type == 2) {
            $this->content = 'foundation/dashboard_client';
        } elseif ($user_type == 3) {
            $this->content = 'foundation/dashboard_vendor';
        }

        $this->layout($data, $setting);

        //}
        //$this->load->view('welcome_message');
    }
	public function home()
	{
		$this->load->view('home');
	}
	
	public function hello() { 
         echo "This is hello function."; 
      }

    public function test(){

        $setting = [
            'method' => 'modalpage',
            'patern' => 'list',
        ];
        $data = [];

      $this->content = 'foundation/my-permit';
      $this->layout($data, $setting);
    }
}
