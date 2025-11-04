<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitvalidevp extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitvalidevp_model');
        $this->load->model('evppermit_model');
        $this->load->model('evdppermit_model');
        $this->load->model('driver_model');
        $this->load->model('permittimelinedom_model');
        $this->load->model('uploadfiles_model');
        $this->load->model('exambank_model');
        $this->load->model('examtaker_model');
        $this->load->model('examresult_model');
        $this->load->model('avppermit_model');
        $this->load->model('vehicle_model');
        $this->load->model('avpchecklist_model');
        $this->load->model('evppermit_model');
        $this->load->model('evpchecklist_model');
        $this->lang->load('permitvalidevp_lang', $this->session->userdata('language'));
        $this->lang->load('evppermit_lang', $this->session->userdata('language'));
        $this->lang->load('evdppermit_lang', $this->session->userdata('language'));
        $this->lang->load('driver_lang', $this->session->userdata('language'));
        $this->lang->load('permittimeline_lang', $this->session->userdata('language'));
        $this->lang->load('uploadfiles_lang', $this->session->userdata('language'));
        $this->lang->load('vehicle_lang', $this->session->userdata('language'));
        $this->lang->load('avpchecklist_lang', $this->session->userdata('language'));
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
                'controller' => 'Permitvalidevp',
                'pagetitle' => 'Active Electrical Vehicle Permits',
            ];

            $this->content = 'permitall/permitall_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function evp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->evp_detail($id);
        $this->infopage = 'permitall/permitall_evp';
        $this->content  = 'permitvalid/permitvalid_evp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function get_json($location='all')
    {

        $i       = $this->input->get('start');
//        $columns = [
//            'permit_id',
//            'permit_groupid',
//            'permit_typeid',
//            'permit_condition',
//            'permit_bookingid',
//            'permit_picid',
//            'permit_companyid',
//            'permit_issuance_serialno',
//            'permit_issuance_date',
//            'permit_issuance_startdate',
//            'permit_issuance_expirydate',
//            'permit_issuance_processedby',
//            'permit_payment_invoiceno',
//            'permit_payment_trainingfee',
//            'permit_payment_new',
//            'permit_payment_renew_oneyear',
//            'permit_payment_renew_prorated',
//            'permit_payment_sst',
//            'permit_payment_total',
//            'permit_payment_processedby',
//            'permit_status',
//            'permit_officialstatus',
//            'permit_remark',
//            'permit_recent_permitid',
//            'permit_created_at',
//
//        ];
          $columns = [
            'permit_companyid',
            'permit_bookingid',
            'permit_status',
            'permit_issuance_serialno',
            'permit_typeid',
            'permit_officialstatus',
            'permit_created_at',
            'permit_id',
            'permit_groupid',
            'permit_condition',
            'permit_picid',
            'permit_issuance_date',
            'permit_issuance_startdate',
            'permit_issuance_expirydate',
            'permit_issuance_processedby',
            'permit_payment_invoiceno',
            'permit_payment_trainingfee',
            'permit_payment_new',
            'permit_payment_renew_oneyear',
            'permit_payment_renew_prorated',
            'permit_payment_sst',
            'permit_payment_total',
            'permit_payment_processedby',
            'permit_remark',
            'permit_recent_permitid',
            
        ];
                $columnfilter = [
                    'company' => $this->input->get('columns')[0]['search']['value'],
                    'bookingid' => $this->input->get('columns')[1]['search']['value'],
                    'serialno' => $this->input->get('columns')[2]['search']['value'],
                    'identity' => $this->input->get('columns')[3]['search']['value'],
                    'permittype' => $this->input->get('columns')[4]['search']['value'],
                    'status' => $this->input->get('columns')[5]['search']['value'],
                    'appdate' => $this->input->get('columns')[6]['search']['value'],
                    'exdate' => $this->input->get('columns')[7]['search']['value'],
                    'condition' => $this->input->get('columns')[9]['search']['value'],
                ];

        $results = $this->permitvalidevp_model->listajax(
            $location,
            $columns,
           $columnfilter,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value'],
            /* $columns[$this->input->get('order')[0]['column']], */
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";

            if ($this->permission->cp_read == true) {
                $rud .= anchor(site_url('permitall/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($r['permit_type_name_permit_typeid'] == "ADP") {
                $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVDP") {
                $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "AVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;

                if($r['permit_officialstatus_name_permit_officialstatus']=='completed'/* || $r['permit_officialstatus_name_permit_officialstatus']=='pendingpayment'*/){
                                $rud .= anchor_popup(site_url('permitprintout/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>') .
                    ' ' . anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                }

            } elseif ($r['permit_type_name_permit_typeid'] == "PBB") {
                $driver_id = $this->pbbpermit_model->get_read_by_permitid($r['permit_id'])->pbbpermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "SH") {
                $vehicle_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_vehicle_id;
                $val       = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "VDGS") {
                $driver_id = $this->vdgspermit_model->get_read_by_permitid($r['permit_id'])->vdgspermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "CS") {
                $vehicle_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_vehicle_id;
                $val       = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "GPU") {
                $driver_id = $this->gpupermit_model->get_read_by_permitid($r['permit_id'])->gpupermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "PCA") {
                $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        =  $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "SHINS") {
                /*$val = 'NA';*/
                $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
                $val        =  $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIPBRIEFING") {
                $vehicle_id = $this->wipbriefingpermit_model->get_read_by_permitid($r['permit_id'])->wipbriefingpermit_vehicle_id;
                $val        =  $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
 }

$appdate = explode(" ", $r['permit_created_at']);


                                if ($r['permit_officialstatus_name_permit_officialstatus']=='completed'){
                                     $officialstatus = '<span class="label label-success">'.$r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='inprogress'){
                                     $officialstatus =  '<span class="label label-primary">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='pending'){
                                     $officialstatus =  '<span class="label label-warning">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='failed'){
                                     $officialstatus =  '<span class="label label-danger">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='pendingpayment'){
                                     $officialstatus =  '<span class="label label-warning">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='rejected'){
                                     $officialstatus =  '<span class="label label-danger">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='suspended'){
                                     $officialstatus =  '<span class="label label-danger">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='canceled'){
                                      $officialstatus =  '<span class="label label-danger">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='terminated'){
                                      $officialstatus =  '<span class="label label-danger">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
                                }elseif($r['permit_officialstatus_name_permit_officialstatus']=='expired'){
                                      $officialstatus =  '<span class="label label-danger">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
}elseif($r['permit_officialstatus_name_permit_officialstatus']=='paid'){
    $officialstatus =  '<span class="label label-primary">'. $r['permit_officialstatus_name_permit_officialstatus'].'</span>';
}

            array_push($data, [
/*                $i, */
                $r['company_name_permit_companyid'],
$r['permit_bookingid'],
$r['permit_issuance_serialno'],
                $val,
                $r['permit_type_desc'],
                $officialstatus,
                datelocal($appdate[0]),
                datelocal($r['permit_issuance_expirydate']),
                // Hidden column start [6]
                $r['permit_group_name_permit_groupid'], // Permit Type 6
                $r['permit_condition_name_permit_condition'], // Permit Condition 7
                $r['pic_fullname_permit_picid'], // PIC 8
                
                $r['user_name_permit_issuance_processedby'], // Processed By 10
                $r['permit_status_desc_permit_status'], // Current Step   11             
                // Hidden column end
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permitvalidevp_model->recordsTotal($location)->recordstotal,
                "recordsFiltered" => $this->permitvalidevp_model->recordsTotal($location)->recordstotal,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Permitvalidevp.php */
/* Location: ./application/controllers/Permitvalidevp.php */
