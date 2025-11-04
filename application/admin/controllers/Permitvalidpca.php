<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitvalidpca extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitvalidpca_model');
        $this->load->model('adppermit_model');
        $this->load->model('pcapermit_model');
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
        $this->lang->load('permitvalidpca_lang', $this->session->userdata('language'));
        $this->lang->load('pcapermit_lang', $this->session->userdata('language'));
        $this->lang->load('pcapermit_lang', $this->session->userdata('language'));
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
                'controller' => 'Permitvalidpca',
                'pagetitle' => 'Active FFOP (Preconditioned Air Unit) Permits',
            ];

            $this->content = 'permitall/permitall_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function pca($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->pca_detail($id);
        $this->infopage = 'permitall/permitall_pca';
        $this->content  = 'permitvalid/permitvalid_pca_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function get_json($location='all')
    {

        $i       = $this->input->get('start');
        $columns = [
            'permit_id',
            'permit_groupid',
            'permit_typeid',
            'permit_condition',
            'permit_bookingid',
            'permit_picid',
            'permit_companyid',
            'permit_issuance_serialno',
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
            'permit_status',
            'permit_officialstatus',
            'permit_remark',
            'permit_recent_permitid',
            'permit_created_at',

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

        $results = $this->permitvalidpca_model->listajax(
            $location,
            $columns,
           $columnfilter,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value'],
            /* $columns[$this->input->get('order')[0]['column']], */
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";

            if ($this->permission->cp_read == true) {

            if($r['permit_officialstatus_name_permit_officialstatus']=="completed"){
                $rud .= anchor(site_url('permitvalidpca/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary btn-xs"') .' '.anchor(site_url('permitvalidpca/replacement/' . fixzy_encoder($r['permit_id'])), 'Replace', 'class="btn btn-primary btn-xs"') .' '. anchor(site_url('permitvalidpca/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), 'Renew', 'class="btn btn-primary btn-xs"').
                    ' ';
            }else{
            if($r['permit_officialstatus_name_permit_officialstatus']!="canceled" && $r['permit_officialstatus_name_permit_officialstatus']!="paid" && $r['permit_status']!="permitterminationpending" && $r['permit_status']!="permitreplacementpending"){
                $rud .= anchor(site_url('permitvalidpca/cancellation/'  . fixzy_encoder($r['permit_id'])), 'Cancel', 'class="btn btn-primary btn-xs"') .
                    ' ';
            }

            }

            }
if($r['permit_type_name_permit_typeid']=="pca"){
     $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
     $val = '<a href="/Driver/update/' .fixzy_encoder($driver_id). '">'.$this->driver_model->get_by_id($driver_id)->driver_ic.'</a>';
}elseif($r['permit_type_name_permit_typeid']=="PCA"){
    $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
    $val = '<a href="/Driver/update/' .fixzy_encoder($driver_id). '">'.$this->driver_model->get_by_id($driver_id)->driver_ic.'</a>';

                if($r['permit_officialstatus_name_permit_officialstatus']=='completed'/* || $r['permit_officialstatus_name_permit_officialstatus']=='pendingpayment'*/){
                                $rud .= anchor_popup(site_url('permitprintout/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>') .
                    ' ';
                }

}elseif($r['permit_type_name_permit_typeid']=="AVP"){
    /*$val = 'NA';*/
    $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
    $val = '<a href="/Vehicle/update/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
}elseif($r['permit_type_name_permit_typeid']=="EVP"){
    /*$val = 'NA';*/
        $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
    $val = '<a href="/Vehicle/update/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
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
                "recordsTotal" => $this->permitvalidpca_model->recordsTotal($location)->recordstotal,
                "recordsFiltered" => $this->permitvalidpca_model->recordsTotal($location)->recordstotal,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Permitvalidpca.php */
/* Location: ./application/controllers/Permitvalidpca.php */
