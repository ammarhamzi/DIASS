<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitpendingdocscheck extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitpendingdocscheck_model');
        $this->load->model('permitall_model');
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
$this->load->model('ffvdgsbriefingmanagement_model');
$this->load->model('ffpbbbriefingmanagement_model');
        $this->lang->load('permitpendingdocscheck_lang', $this->session->userdata('language'));
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

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permission' => $this->permission,
                'controller' => 'permitpendingdocscheck',
                'pagetitle' => 'Verify Documents',
            ];

            $this->content = 'permitall/permitall_list_verify';
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
        $this->content  = 'permitpendingdocscheck/permitpendingdocscheck_adp_raw';
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
        $this->content  = 'permitpendingdocscheck/permitpendingdocscheck_evdp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function adp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_adprules();

            if ($this->form_validation->run() == false) {
                $this->adp($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                //$testdate    = $this->input->post('testdate', true);
                $coursedate    = $this->input->post('coursedate', true);
                $competencytestdate  = $this->input->post('competencytestdate', true);
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {
                    if ($this->input->post('examonly', true) == 'y') {
                        $data_permit = [
                            'permit_status' => 'exampending',
                            'permit_officialstatus' => 'inprogress',
                            'permit_docscheck_remark' => $this->input->post('remark', true),
                            'permit_updated_at' => $nowdatetime,
                            'permit_lastchanged_by' => $userid,
                        ];
                    } else {
                        $data_permit = [
                            'permit_status' => 'airsidebriefingpending',
                            'permit_officialstatus' => 'inprogress',
                            'permit_docscheck_remark' => $this->input->post('remark', true),
                            'permit_updated_at' => $nowdatetime,
                            'permit_lastchanged_by' => $userid,
                            'permit_op_date' =>  dateserver($this->input->post('activitydate', true)),
                        ];
                    }

                    if($coursedate == '1970-01-01' || $coursedate == '1900-01-01'){
                    $data_adppermit = [
                        'adppermit_examscheduled' => 'y',
                        'adppermit_approvedtotakeexam_by' => $userid,
                        'adppermit_completed_docs' => 'y',
                        'adppermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'adppermit_competencytest_date' => dateserver($this->input->post('activitydate', true)),
                        'adppermit_updated_at' => $nowdatetime,
                        'adppermit_lastchanged_by' => $userid,
                        'adppermit_original_examdate' => $competencytestdate,
                    ];
                    }else{
                    $data_adppermit = [
                        'adppermit_examscheduled' => 'y',
                        'adppermit_approvedtotakeexam_by' => $userid,
                        'adppermit_completed_docs' => 'y',
                        'adppermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'adppermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'adppermit_competencytest_date' => dateserver($this->input->post('activitydate', true)),
                        'adppermit_updated_at' => $nowdatetime,
                        'adppermit_lastchanged_by' => $userid,
                        'adppermit_original_examdate' => $competencytestdate,
                    ];
                    }


                    $data_examtaker = [
'examtaker_date' => dateserver($this->input->post('activitydate', true)),
'examtaker_updated_at' => $nowdatetime,
'examtaker_lastchanged_by' => $userid,
];
                    if ($this->input->post('examonly', true) == 'y') {
                        $data_timeline = [
                            'permit_timeline_permitid' => $permitid,
                            'permit_timeline_userid' => $userid,
                            'permit_timeline_name' => DOCUMENTS_VERIFIED_ADP,
                            'permit_timeline_desc' => EXAM_CONFIRMED_ADP,
                            'permit_timeline_status' => 'exampending',
                            'permit_timeline_officialstatus' => 'inprogress',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                        ];
                    } else {
                        $data_timeline = [
                            'permit_timeline_permitid' => $permitid,
                            'permit_timeline_userid' => $userid,
                            'permit_timeline_name' => DOCUMENTS_VERIFIED_ADP,
                            'permit_timeline_desc' => BRIEFING_CONFIRMED_ADP,
                            'permit_timeline_status' => 'airsidebriefingpending',
                            'permit_timeline_officialstatus' => 'inprogress',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                        ];
                    }

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->adppermit_model->update_by_permitid($permitid, $data_adppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->examtaker_model->update_by_permitid($permitid, $data_examtaker);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'success',
                            'bookingdate' => dateserver($this->input->post('activitydate', true)),
                        ];

                    }
                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_adppermit = [
                        'adppermit_examscheduled' => 'n',
                        'adppermit_approvedtotakeexam_by' => '',
                        'adppermit_completed_docs' => 'n',
                        'adppermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'adppermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'adppermit_updated_at' => $nowdatetime,
                        'adppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_ADP,
                        'permit_timeline_desc' => PERMIT_REJECTED_ADP_DESC,
                        'permit_timeline_status' => 'applicationrejected',
                        'permit_timeline_officialstatus' => 'rejected',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

//get permittype
$permittype = $this->permitall_model->get_permittype_by_id($permitid);
//get driver/vehicle id
$driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype,$permitid);
//update driver/vehicle status
$this->permitall_model->update_driver_vehicle_status($permittype,$driver_vehicle_id, 9);

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->adppermit_model->update_by_permitid($permitid, $data_adppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'failed'
                        ];
                    }

                }

                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('ADP', 'pic', $data_pic, $emails);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permitpendingdocscheck'));

            }

        } else {
            redirect('/');
        }

    }

    public function evdp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_evdprules();

            if ($this->form_validation->run() == false) {
                $this->evdp($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'terminalbriefingpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_evdppermit = [
                        'evdppermit_approvedby_airside' => 'y',
                        'evdppermit_completed_docs' => 'y',
                        'evdppermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'evdppermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'evdppermit_updated_at' => $nowdatetime,
                        'evdppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_EVDP,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_EVDP,
                        'permit_timeline_status' => 'terminalbriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->evdppermit_model->update_by_permitid($permitid, $data_evdppermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'success',
                            'bookingdate' => dateserver($this->input->post('activitydate', true)),
                        ];
                    }
                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_evdppermit = [
                        'evdppermit_approvedby_airside' => 'n',
                        'evdppermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'evdppermit_updated_at' => $nowdatetime,
                        'evdppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_EVDP,
                        'permit_timeline_desc' => PERMIT_REJECTED_EVDP_DESC,
                        'permit_timeline_status' => 'applicationrejected',
                        'permit_timeline_officialstatus' => 'rejected',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

//get permittype
$permittype = $this->permitall_model->get_permittype_by_id($permitid);
//get driver/vehicle id
$driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype,$permitid);
//update driver/vehicle status
$this->permitall_model->update_driver_vehicle_status($permittype,$driver_vehicle_id, 9);

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->evdppermit_model->update_by_permitid($permitid, $data_evdppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'failed'
                        ];
                    }

                }
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('EVDP', 'pic', $data_pic, $emails);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permitpendingdocscheck'));
            }

        } else {
            redirect('/');
        }

    }

    public function _adprules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _evdprules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
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
            'permit_docscheck_remark',
            'permit_recent_permitid',
            'permit_created_at',

        ];

                $columnfilter = [
                    'company' => $this->input->get('columns')[0]['search']['value'],
                    'bookingid' => $this->input->get('columns')[1]['search']['value'],
                    'identity' => $this->input->get('columns')[2]['search']['value'],
                    'permittype' => $this->input->get('columns')[3]['search']['value'],
                    'status' => $this->input->get('columns')[4]['search']['value'],
                    'opdate' => $this->input->get('columns')[5]['search']['value'],
                    'appdate' => $this->input->get('columns')[6]['search']['value'],
                    'exdate' => $this->input->get('columns')[7]['search']['value'],
                    'condition' => $this->input->get('columns')[9]['search']['value'],
                ];

        $results = $this->permitpendingdocscheck_model->listajax(
            $location,
            $columns,
            $columnfilter,
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
                $rud .= anchor(site_url('permitpendingdocscheck/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
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
            } elseif ($r['permit_type_name_permit_typeid'] == "PBB") {
                $driver_id = $this->pbbpermit_model->get_read_by_permitid($r['permit_id'])->pbbpermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "SH") {
                $vehicle_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "VDGS") {
                $driver_id = $this->vdgspermit_model->get_read_by_permitid($r['permit_id'])->vdgspermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "CS") {
                $vehicle_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "GPU") {
                $driver_id = $this->gpupermit_model->get_read_by_permitid($r['permit_id'])->gpupermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "PCA") {
                $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif($r['permit_type_name_permit_typeid']=="SHINS"){
    /*$val = 'NA';*/
    $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
    $val = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
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
            if($r['permit_course_date']=="1970-01-01" || $r['permit_course_date']=="1900-01-01"){
            $dateexam = $r['permit_competencytest_date'];
            }else{
            $dateexam = $r['permit_course_date'];
            }
            array_push($data, [
/*                $i, */
                $r['company_name_permit_companyid'],
                $r['permit_bookingid'],
                $val,
                $r['permit_type_desc'],
                $officialstatus,
                datelocal($dateexam),
                datelocal($appdate[0]),
                datelocal($r['permit_issuance_expirydate']),
                // Hidden column start [6]
                $r['permit_group_name_permit_groupid'], // Permit Type 7
                $r['permit_condition_name_permit_condition'], // Permit Condition 8
                $r['pic_fullname_permit_picid'], // PIC 9
                $r['user_name_permit_issuance_processedby'], // Processed By 10
                $r['permit_status_desc_permit_status'], // Current Step   11
                // Hidden column end
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permitpendingdocscheck_model->recordsTotal($location)->recordstotal,
                "recordsFiltered" => $this->permitpendingdocscheck_model->recordsFiltered($location,$columns,$columnfilter, $this->input->get('search')['value'])->recordsfiltered,
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
        $this->content  = 'permitpendingdocscheck/permitpendingdocscheck_pbb_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pbb_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_pbbrules();

            if ($this->form_validation->run() == false) {
                $this->pbb($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'pbbbriefingpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_pbbpermit = [
                        'pbbpermit_approvedby_airside' => 'y',
                        'pbbpermit_completed_docs' => 'y',
                        'pbbpermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'pbbpermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'pbbpermit_updated_at' => $nowdatetime,
                        'pbbpermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_PBB,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_PBB,
                        'permit_timeline_status' => 'pbbbriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->pbbpermit_model->update_by_permitid($permitid, $data_pbbpermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'success',
                            'bookingdate' => dateserver($this->input->post('activitydate', true)),
                        ];
                    }
if(dateserver($this->input->post('activitydate', true)) != $this->input->post('current_activitydate', true)){
######################
            //tambah slottaken date baru
            $this->change_slottaken_pbb(dateserver($this->input->post('activitydate', true)), 'added');

//remove slottaken date lama
            $this->change_slottaken_pbb($this->input->post('current_activitydate', true), 'deduct');
######################
}
                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_pbbpermit = [
                        'pbbpermit_approvedby_airside' => 'n',
                        'pbbpermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'pbbpermit_updated_at' => $nowdatetime,
                        'pbbpermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_PBB,
                        'permit_timeline_desc' => PERMIT_REJECTED_PBB_DESC,
                        'permit_timeline_status' => 'applicationrejected',
                        'permit_timeline_officialstatus' => 'rejected',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

//get permittype
$permittype = $this->permitall_model->get_permittype_by_id($permitid);
//get driver/vehicle id
$driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype,$permitid);
//update driver/vehicle status
$this->permitall_model->update_driver_vehicle_status($permittype,$driver_vehicle_id, 9);

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->pbbpermit_model->update_by_permitid($permitid, $data_pbbpermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'failed'
                        ];
                    }

                }
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('PBB', 'pic', $data_pic, $emails);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permitpendingdocscheck'));
            }

        } else {
            redirect('/');
        }

    }

    public function _pbbrules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function vdgs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->vdgs_detail($id);
        $this->infopage = 'permitall/permitall_vdgs';
        $this->content  = 'permitpendingdocscheck/permitpendingdocscheck_vdgs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function vdgs_submit()
    {
    //print_r($this->input->post());exit;
        if ($this->permission->cp_update == true) {

            $this->_vdgsrules();

            if ($this->form_validation->run() == false) {
                $this->vdgs($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'vdgsbriefingpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_vdgspermit = [
                        'vdgspermit_approvedby_airside' => 'y',
                        'vdgspermit_completed_docs' => 'y',
                        'vdgspermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'vdgspermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'vdgspermit_updated_at' => $nowdatetime,
                        'vdgspermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_VDGS,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_VDGS,
                        'permit_timeline_status' => 'vdgsbriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->vdgspermit_model->update_by_permitid($permitid, $data_vdgspermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'success',
                            'bookingdate' => dateserver($this->input->post('activitydate', true)),
                        ];
                    }
if(dateserver($this->input->post('activitydate', true)) != $this->input->post('current_activitydate', true)){
######################
            //tambah slottaken date baru
            $this->change_slottaken_vdgs(dateserver($this->input->post('activitydate', true)), 'added');

//remove slottaken date lama
            $this->change_slottaken_vdgs($this->input->post('current_activitydate', true), 'deduct');
######################
}
                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_vdgspermit = [
                        'vdgspermit_approvedby_airside' => 'n',
                        'vdgspermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'vdgspermit_updated_at' => $nowdatetime,
                        'vdgspermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_VDGS,
                        'permit_timeline_desc' => PERMIT_REJECTED_VDGS_DESC,
                        'permit_timeline_status' => 'applicationrejected',
                        'permit_timeline_officialstatus' => 'rejected',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

//get permittype
$permittype = $this->permitall_model->get_permittype_by_id($permitid);
//get driver/vehicle id
$driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype,$permitid);
//update driver/vehicle status
$this->permitall_model->update_driver_vehicle_status($permittype,$driver_vehicle_id, 9);

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->vdgspermit_model->update_by_permitid($permitid, $data_vdgspermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'failed'
                        ];
                    }

                }
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('VDGS', 'pic', $data_pic, $emails);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permitpendingdocscheck'));
            }

        } else {
            redirect('/');
        }

    }

    public function _vdgsrules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function gpu($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->gpu_detail($id);
        $this->infopage = 'permitall/permitall_gpu';
        $this->content  = 'permitpendingdocscheck/permitpendingdocscheck_gpu_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function gpu_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_gpurules();

            if ($this->form_validation->run() == false) {
                $this->gpu($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'gpubriefingpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_gpupermit = [
                        'gpupermit_approvedby_airside' => 'y',
                        'gpupermit_completed_docs' => 'y',
                        'gpupermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'gpupermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'gpupermit_updated_at' => $nowdatetime,
                        'gpupermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_GPU,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_GPU,
                        'permit_timeline_status' => 'gpubriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->gpupermit_model->update_by_permitid($permitid, $data_gpupermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'success',
                            'bookingdate' => dateserver($this->input->post('activitydate', true)),
                        ];
                    }
                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_gpupermit = [
                        'gpupermit_approvedby_airside' => 'n',
                        'gpupermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'gpupermit_updated_at' => $nowdatetime,
                        'gpupermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_GPU,
                        'permit_timeline_desc' => PERMIT_REJECTED_GPU_DESC,
                        'permit_timeline_status' => 'applicationrejected',
                        'permit_timeline_officialstatus' => 'rejected',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

//get permittype
$permittype = $this->permitall_model->get_permittype_by_id($permitid);
//get driver/vehicle id
$driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype,$permitid);
//update driver/vehicle status
$this->permitall_model->update_driver_vehicle_status($permittype,$driver_vehicle_id, 9);

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->gpupermit_model->update_by_permitid($permitid, $data_gpupermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'failed'
                        ];
                    }

                }
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('GPU', 'pic', $data_pic, $emails);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permitpendingdocscheck'));
            }

        } else {
            redirect('/');
        }

    }

    public function _gpurules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function pca($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->pca_detail($id);
        $this->infopage = 'permitall/permitall_pca';
        $this->content  = 'permitpendingdocscheck/permitpendingdocscheck_pca_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pca_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_pcarules();

            if ($this->form_validation->run() == false) {
                $this->pca($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'pcabriefingpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_pcapermit = [
                        'pcapermit_approvedby_airside' => 'y',
                        'pcapermit_completed_docs' => 'y',
                        'pcapermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'pcapermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'pcapermit_updated_at' => $nowdatetime,
                        'pcapermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_PCA,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_PCA,
                        'permit_timeline_status' => 'pcabriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->pcapermit_model->update_by_permitid($permitid, $data_pcapermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'success',
                            'bookingdate' => dateserver($this->input->post('activitydate', true)),
                        ];
                    }
                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_pcapermit = [
                        'pcapermit_approvedby_airside' => 'n',
                        'pcapermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'pcapermit_updated_at' => $nowdatetime,
                        'pcapermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_PCA,
                        'permit_timeline_desc' => PERMIT_REJECTED_PCA_DESC,
                        'permit_timeline_status' => 'applicationrejected',
                        'permit_timeline_officialstatus' => 'rejected',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

//get permittype
$permittype = $this->permitall_model->get_permittype_by_id($permitid);
//get driver/vehicle id
$driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype,$permitid);
//update driver/vehicle status
$this->permitall_model->update_driver_vehicle_status($permittype,$driver_vehicle_id, 9);

                    $this->db->trans_start();
                    $this->permitpendingdocscheck_model->update($permitid, $data_permit);
                    $this->pcapermit_model->update_by_permitid($permitid, $data_pcapermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        $data_pic = [
                            'bookingId' => $bookingId,
                            'status' => 'failed'
                        ];
                    }

                }
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('PCA', 'pic', $data_pic, $emails);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permitpendingdocscheck'));
            }

        } else {
            redirect('/');
        }

    }

    public function _pcarules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    //added or deduct
    public function change_slottaken_pbb($date, $type = 'added')
    {
        $ffpbbbriefingmanagement = $this->ffpbbbriefingmanagement_model->get_by_date($date);
        if ($type == 'added') {
            $slottaken = (int) $ffpbbbriefingmanagement->ffpbb_briefingmanagement_slottaken + 1;
        } else if ($type == 'deduct') {
            $slottaken = (int) $ffpbbbriefingmanagement->ffpbb_briefingmanagement_slottaken - 1;
        }
        $data_ffpbbbriefingmanagement = [
            'ffpbb_briefingmanagement_slottaken' => $slottaken,
        ];

        $this->ffpbbbriefingmanagement_model->update($ffpbbbriefingmanagement->ffpbb_briefingmanagement_id, $data_ffpbbbriefingmanagement);
    }

    //added or deduct
    public function change_slottaken_vdgs($date, $type = 'added')
    {
        $ffvdgsbriefingmanagement = $this->ffvdgsbriefingmanagement_model->get_by_date($date);
        if ($type == 'added') {
            $slottaken = (int) $ffvdgsbriefingmanagement->ffvdgs_briefingmanagement_slottaken + 1;
        } else if ($type == 'deduct') {
            $slottaken = (int) $ffvdgsbriefingmanagement->ffvdgs_briefingmanagement_slottaken - 1;
        }
        $data_ffvdgsbriefingmanagement = [
            'ffvdgs_briefingmanagement_slottaken' => $slottaken,
        ];

        $this->ffvdgsbriefingmanagement_model->update($ffvdgsbriefingmanagement->ffvdgs_briefingmanagement_id, $data_ffvdgsbriefingmanagement);
    }
}
;
/* End of file Permitpendingdocscheck.php */
/* Location: ./application/controllers/Permitpendingdocscheck.php */
