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
        $this->load->model('permitvalid_model');
        $this->load->model('adppermit_model');
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
        $this->lang->load('permitvalid_lang', $this->session->userdata('language'));
        $this->lang->load('adppermit_lang', $this->session->userdata('language'));
        $this->lang->load('evdppermit_lang', $this->session->userdata('language'));
        $this->lang->load('driver_lang', $this->session->userdata('language'));
        $this->lang->load('permittimeline_lang', $this->session->userdata('language'));
        $this->lang->load('uploadfiles_lang', $this->session->userdata('language'));
        $this->lang->load('vehicle_lang', $this->session->userdata('language'));
        $this->lang->load('avpchecklist_lang', $this->session->userdata('language'));
        $this->load->model('pbbpermit_model');
        $this->lang->load('pbbpermit_lang', $this->session->userdata('language'));
        $this->load->model('shpermit_model');
        $this->lang->load('shpermit_lang', $this->session->userdata('language'));
        $this->load->model('vdgspermit_model');
        $this->lang->load('vdgspermit_lang', $this->session->userdata('language'));
        $this->load->model('cspermit_model');
        $this->lang->load('cspermit_lang', $this->session->userdata('language'));
        $this->load->model('gpupermit_model');
        $this->lang->load('gpupermit_lang', $this->session->userdata('language'));
        $this->load->model('pcapermit_model');
        $this->lang->load('pcapermit_lang', $this->session->userdata('language'));
        $this->load->model('wippermit_model');
        $this->load->model('wipchecklist_model');
        $this->lang->load('wipchecklist_lang', $this->session->userdata('language'));
        $this->load->model('shinspermit_model');
        $this->load->model('shinschecklist_model');
        $this->lang->load('shinschecklist_lang', $this->session->userdata('language'));
$this->load->model('wipbriefingpermit_model');
$this->lang->load('wipbriefingpermit_lang', $this->session->userdata('language'));
    }

    public function index($permittype)
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
                'permittype' => fixzy_decoder($permittype),
                'controller' => 'Permitvalid',
                'pagetitle' => 'Active Permits',
            ];

            $this->content = 'permitvalid/permitvalid_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function adp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->adp_detail($id);
        $this->infopage = 'permitall/permitall_adp';
        $this->content  = 'permitvalid/permitvalid_adp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function evdp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->evdp_detail($id);
        $this->infopage = 'permitall/permitall_evdp';
        $this->content  = 'permitvalid/permitvalid_evdp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function avp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->avp_detail($id);
        $this->infopage = 'permitall/permitall_avp';
        $this->content  = 'permitvalid/permitvalid_avp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

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

    public function get_json($permittype)
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
        $results = $this->permitvalid_model->listajax(
            $permittype,
            $columns,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";

            if ($this->permission->cp_read == true) {
                $rud .= anchor(site_url('permitvalid/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }

            if ($r['permit_type_name_permit_typeid'] == "ADP") {
                $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVDP") {
                $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
                $val       =  $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "AVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
                $val        =  $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no ;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
                $val        =  $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no ;
            } elseif ($r['permit_type_name_permit_typeid'] == "PBB") {
                $driver_id = $this->pbbpermit_model->get_read_by_permitid($r['permit_id'])->pbbpermit_driver_id;
                $val       =  $this->driver_model->get_by_id($driver_id)->driver_ic ;
            } elseif ($r['permit_type_name_permit_typeid'] == "PCA") {
                $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
                $val       =  $this->driver_model->get_by_id($driver_id)->driver_ic ;
            } elseif ($r['permit_type_name_permit_typeid'] == "GPU") {
                $driver_id = $this->gpupermit_model->get_read_by_permitid($r['permit_id'])->gpupermit_driver_id;
                $val       =  $this->driver_model->get_by_id($driver_id)->driver_ic ;
            } elseif ($r['permit_type_name_permit_typeid'] == "CS") {
                $driver_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_driver_id;
                $val       =  $this->driver_model->get_by_id($driver_id)->driver_ic ;
            } elseif ($r['permit_type_name_permit_typeid'] == "VDGS") {
                $driver_id = $this->vdgspermit_model->get_read_by_permitid($r['permit_id'])->vdgspermit_driver_id;
                $val       =  $this->driver_model->get_by_id($driver_id)->driver_ic ;
            } elseif ($r['permit_type_name_permit_typeid'] == "SH") {
                $driver_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_driver_id;
                $val       =  $this->driver_model->get_by_id($driver_id)->driver_ic ;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        =  $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no ;
            }elseif($r['permit_type_name_permit_typeid']=="SHINS"){
    /*$val = 'NA';*/
    $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
    $val = '<a href="/Vehicle/update/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
}elseif($r['permit_type_name_permit_typeid'] == "WIPBRIEFING"){
    $vehicle_id = $this->wipbriefingpermit_model->get_read_by_permitid($r['permit_id'])->wipbriefingpermit_vehicle_id;
    $val = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
}

            $appdate = explode(" ", $r['permit_created_at']);

            if ($r['permit_officialstatus_name_permit_officialstatus'] == 'completed') {
                $officialstatus = '<span class="label label-success">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'inprogress') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'pending') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'failed') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'pendingpayment') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'rejected') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'suspended') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'canceled') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'terminated') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'expired') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'paid') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            }

            array_push($data, [
/*                $i, */
                $r['permit_bookingid'],
                $val,
                $r['permit_type_name_permit_typeid'],
                $officialstatus,
                $appdate[0],
                $r['permit_issuance_expirydate'],
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permitvalid_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->permitvalid_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function pbb($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->pbb_detail($id);
        $this->infopage = 'permitall/permitall_pbb';
        $this->content  = 'permitvalid/permitvalid_pbb_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function gpu($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->gpu_detail($id);
        $this->infopage = 'permitall/permitall_gpu';
        $this->content  = 'permitvalid/permitvalid_gpu_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

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

    public function cs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->cs_detail($id);
        $this->infopage = 'permitall/permitall_cs';
        $this->content  = 'permitvalid/permitvalid_cs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function vdgs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->vdgs_detail($id);
        $this->infopage = 'permitall/permitall_vdgs';
        $this->content  = 'permitvalid/permitvalid_vdgs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function sh($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->sh_detail($id);
        $this->infopage = 'permitall/permitall_sh';
        $this->content  = 'permitvalid/permitvalid_sh_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wip($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->wip_detail($id);
        $this->infopage = 'permitall/permitall_wip';
        $this->content  = 'permitvalid/permitvalid_wip_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function shins($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->shins_detail($id);
        $this->infopage = 'permitall/permitall_shins';
        $this->content  = 'permitvalid/permitvalid_shins_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }
    public function wipbriefing($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->wipbriefing_detail($id);
        $this->infopage = 'permitall/permitall_wipbriefing';
        $this->content  = 'permitvalid/permitvalid_wipbriefing_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }
}
;
/* End of file Permitvalid.php */
/* Location: ./application/controllers/Permitvalid.php */
