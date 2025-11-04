<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitpendingdocscheckvehicle extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitpendingdocscheckvehicle_model');
        $this->load->model('permitall_model');
        $this->load->model('avppermit_model');
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
        $this->load->model('avpevpinspectionmanagement_model');
        $this->lang->load('permitpendingdocscheckvehicle_lang', $this->session->userdata('language'));
        $this->lang->load('adppermit_lang', $this->session->userdata('language'));
        $this->lang->load('evdppermit_lang', $this->session->userdata('language'));
        $this->lang->load('driver_lang', $this->session->userdata('language'));
        $this->lang->load('permittimeline_lang', $this->session->userdata('language'));
        $this->lang->load('uploadfiles_lang', $this->session->userdata('language'));
        $this->lang->load('vehicle_lang', $this->session->userdata('language'));
        $this->lang->load('avpchecklist_lang', $this->session->userdata('language'));
        $this->load->model('wippermit_model');
        $this->load->model('wipchecklist_model');
        $this->lang->load('wipchecklist_lang', $this->session->userdata('language'));
        $this->load->model('cspermit_model');
        $this->load->model('shpermit_model');
        $this->load->model('shinspermit_model');
        $this->load->model('shinschecklist_model');
        $this->lang->load('shinschecklist_lang', $this->session->userdata('language'));
$this->load->model('wipbriefingpermit_model');
$this->lang->load('wipbriefingpermit_lang', $this->session->userdata('language'));
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
                'controller' => 'Permitpendingdocscheckvehicle',
                'pagetitle' => 'Verify Documents',
            ];

            $this->content = 'permitall/permitall_list_verifyvehicle';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function avp($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data = $this->avp_detail($id);

        $this->infopage = 'permitall/permitall_avp';
        $this->content  = 'permitpendingdocscheckvehicle/permitpendingdocscheckvehicle_avp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function evp($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data = $this->evp_detail($id);

        $this->infopage = 'permitall/permitall_evp';
        $this->content  = 'permitpendingdocscheckvehicle/permitpendingdocscheckvehicle_evp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function avp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_avprules();

            if ($this->form_validation->run() == false) {
                $this->avp($this->input->post('permit_id', true));
            } else {
                $permitid_encoder    = $this->input->post('permit_id', true);
                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'inspectionpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_avppermit = [
                        'avppermit_approved_to_inspect' => 'y',
                        'avppermit_completed_docs' => 'y',
                        'avppermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'avppermit_inspection_date' => dateserver($this->input->post('activitydate', true)),
                        'avppermit_updated_at' => $nowdatetime,
                        'avppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_AVP,
                        'permit_timeline_desc' => INSPECTION_CONFIRMED_AVP,
                        'permit_timeline_status' => 'inspectionpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->avppermit_model->update_by_permitid($permitid, $data_avppermit);
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
            $this->change_slottaken_avpevp(dateserver($this->input->post('activitydate', true)), 'added');

//remove slottaken date lama
            $this->change_slottaken_avpevp($this->input->post('current_activitydate', true), 'deduct');
######################
}
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('AVP', 'pic', $data_pic, $emails);
                        //$this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendinginspection/avp/'.$permitid_encoder));
                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_avppermit = [
                        'avppermit_approved_to_inspect' => 'n',
                        'avppermit_updated_at' => $nowdatetime,
                        'avppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_AVP,
                        'permit_timeline_desc' => PERMIT_REJECTED_AVP_DESC,
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
                        //TODO - 19/4/2019
/*                        $data_vehicle = [
                            'vehicle_permit_typeid' => NULL,
                            'vehicle_application_date' => NULL,
                            'vehicle_activity_statusid' => '1',
                            'vehicle_updated_at' => $nowdatetime,
                            'vehicle_lastchanged_by' => $this->session->userdata('id'),
                        ];*/

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->avppermit_model->update_by_permitid($permitid, $data_avppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    //TODO - 19/4/2019
                    //$this->vehicle_model->update($vehicle_id, $data_vehicle);
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
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('AVP', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));
                }
/*                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('AVP', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));*/
            }

        } else {
            redirect('/');
        }

    }

    public function evp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_evprules();

            if ($this->form_validation->run() == false) {
                $this->evp($this->input->post('permit_id', true));
            } else {
                $permitid_encoder =$this->input->post('permit_id', true);
                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'inspectionpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_evppermit = [
                        'evppermit_approved_to_inspect' => 'y',
                        'evppermit_completed_docs' => 'y',
                        'evppermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'evppermit_inspection_date' => dateserver($this->input->post('activitydate', true)),
                        'evppermit_updated_at' => $nowdatetime,
                        'evppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_EVP,
                        'permit_timeline_desc' => INSPECTION_CONFIRMED_EVP,
                        'permit_timeline_status' => 'inspectionpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->evppermit_model->update_by_permitid($permitid, $data_evppermit);
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

                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('EVP', 'pic', $data_pic, $emails);
                        //$this->session->set_flashdata('message', 'Update Record Success');
                                                redirect(site_url('permitpendinginspection/evp/'.$permitid_encoder));

                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_evppermit = [
                        'evppermit_approved_to_inspect' => 'n',
                        'evppermit_updated_at' => $nowdatetime,
                        'evppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_EVP,
                        'permit_timeline_desc' => PERMIT_REJECTED_EVP_DESC,
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
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->evppermit_model->update_by_permitid($permitid, $data_evppermit);
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
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('EVP', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));
                }
/*                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('EVP', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));*/
            }

        } else {
            redirect('/');
        }

    }

    public function _avprules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _evprules()
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
            'permit_created_at'

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

        $results = $this->permitpendingdocscheckvehicle_model->listajax(
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
                $rud .= anchor(site_url('permitpendingdocscheckvehicle/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($r['permit_type_name_permit_typeid'] == "ADP") {
                $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
                $val       = '<a href="/Driver/update/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "EVDP") {
                $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
                $val       = '<a href="/Driver/update/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "AVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            }  elseif ($r['permit_type_name_permit_typeid'] == "WIPBRIEFING") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wipbriefingpermit_model->get_read_by_permitid($r['permit_id'])->wipbriefingpermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            }elseif ($r['permit_type_name_permit_typeid'] == "CS") {
                /*$val = 'NA';*/
                $vehicle_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "SH") {
                /*$val = 'NA';*/
                $vehicle_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "SHINS") {
                /*$val = 'NA';*/
                $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
                $val        =  $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no ;
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
                $r['company_name_permit_companyid'],
                $r['permit_bookingid'],
                $val,
                $r['permit_type_desc'],
                $officialstatus,
                datelocal($r['permit_inspection_date']),
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
                "recordsTotal" => $this->permitpendingdocscheckvehicle_model->recordsTotal($location)->recordstotal,
                "recordsFiltered" => $this->permitpendingdocscheckvehicle_model->recordsFiltered($location,$columns, $columnfilter,$this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function wip($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data = $this->wip_detail($id);

        $this->infopage = 'permitall/permitall_wip';
        $this->content  = 'permitpendingdocscheckvehicle/permitpendingdocscheckvehicle_wip_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function wip_submit()
    {

        if ($this->permission->cp_update == true) {
            $needescort =  $this->input->post('needescort', true);
            $this->_wiprules($needescort);

            if ($this->form_validation->run() == false) {
                $this->wip($this->input->post('permit_id', true));
            } else {
                $permitid_encoder = $this->input->post('permit_id', true);
                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);
                $escortname =  $this->input->post('escortname', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'inspectionpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_wippermit = [
                        'wippermit_approved_to_inspect' => 'y',
                        'wippermit_completed_docs' => 'y',
                        'wippermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'wippermit_inspection_date' => dateserver($this->input->post('activitydate', true)),
                        'wippermit_updated_at' => $nowdatetime,
                        'wippermit_lastchanged_by' => $userid,
                        'wippermit_escortname' => $escortname,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_WIP,
                        'permit_timeline_desc' => INSPECTION_CONFIRMED_WIP,
                        'permit_timeline_status' => 'inspectionpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->wippermit_model->update_by_permitid($permitid, $data_wippermit);
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

                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('WIP', 'pic', $data_pic, $emails);
                        //$this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendinginspection/wip/'.$permitid_encoder));

                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_wippermit = [
                        'wippermit_approved_to_inspect' => 'n',
                        'wippermit_inspection_date' => dateserver($this->input->post('activitydate', true)),
                        'wippermit_updated_at' => $nowdatetime,
                        'wippermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_WIP,
                        'permit_timeline_desc' => PERMIT_REJECTED_WIP_DESC,
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
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->wippermit_model->update_by_permitid($permitid, $data_wippermit);
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
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('WIP', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));
                }
/*                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('WIP', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));*/
            }

        } else {
            redirect('/');
        }

    }

    public function _wiprules($needescort)
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');
        if($needescort=='y'){
        $this->form_validation->set_rules('escortname', ' ', 'trim|required');
        }
        
        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function cs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->cs_detail($id);
        $this->infopage = 'permitall/permitall_cs';
        $this->content  = 'permitpendingdocscheckvehicle/permitpendingdocscheckvehicle_cs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function cs_submit()
    {

        if ($this->permission->cp_update == true) {
            $needescort =  $this->input->post('needescort', true);
            $this->_csrules($needescort);

            if ($this->form_validation->run() == false) {
                $this->cs($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);
                $escortname =  $this->input->post('escortname', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        /*'permit_status' => 'csbriefingpending',*/
                        'permit_status' => 'approvalairsidepending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_cspermit = [
                        'cspermit_approvedby_airside' => 'y',
                        'cspermit_completed_docs' => 'y',
                        'cspermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'cspermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'cspermit_updated_at' => $nowdatetime,
                        'cspermit_lastchanged_by' => $userid,
                        'cspermit_escortname' => $escortname,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_CS,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_CS,
                        'permit_timeline_status' => 'csbriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->cspermit_model->update_by_permitid($permitid, $data_cspermit);
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

                    $data_cspermit = [
                        'cspermit_approvedby_airside' => 'n',
                        'cspermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'cspermit_updated_at' => $nowdatetime,
                        'cspermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_CS,
                        'permit_timeline_desc' => PERMIT_REJECTED_CS_DESC,
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
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->cspermit_model->update_by_permitid($permitid, $data_cspermit);
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
                //$this->emailcontent->shoot_email_docscheck('CS', 'pic', $data_pic, $emails);
                $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));
            }

        } else {
            redirect('/');
        }

    }

    public function _csrules($needescort)
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');
        if($needescort=='y'){
        $this->form_validation->set_rules('escortname', ' ', 'trim|required');
        }

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function sh($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->sh_detail($id);
        $this->infopage = 'permitall/permitall_sh';
        $this->content  = 'permitpendingdocscheckvehicle/permitpendingdocscheckvehicle_sh_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function sh_submit()
    {

        if ($this->permission->cp_update == true) {
            $needescort =  $this->input->post('needescort', true);
            $this->_shrules($needescort);

            if ($this->form_validation->run() == false) {
                $this->sh($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);
                $escortname =  $this->input->post('escortname', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        /*'permit_status' => 'shbriefingpending',*/
                        'permit_status' => 'approvalairsidepending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_shpermit = [
                        'shpermit_approvedby_airside' => 'y',
                        'shpermit_completed_docs' => 'y',
                        'shpermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'shpermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'shpermit_updated_at' => $nowdatetime,
                        'shpermit_lastchanged_by' => $userid,
                        'shpermit_escortname' => $escortname,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_SH,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_SH,
                        'permit_timeline_status' => 'shbriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->shpermit_model->update_by_permitid($permitid, $data_shpermit);
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

                    $data_shpermit = [
                        'shpermit_approvedby_airside' => 'n',
                        'shpermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'shpermit_updated_at' => $nowdatetime,
                        'shpermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_SH,
                        'permit_timeline_desc' => PERMIT_REJECTED_SH_DESC,
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
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->shpermit_model->update_by_permitid($permitid, $data_shpermit);
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
                //$this->emailcontent->shoot_email_docscheck('SH', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));
            }

        } else {
            redirect('/');
        }

    }

    public function _shrules($needescort)
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');
        if($needescort=='y'){
        $this->form_validation->set_rules('escortname', ' ', 'trim|required');
        }

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function shins($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data = $this->shins_detail($id);

        $this->infopage = 'permitall/permitall_shins';
        $this->content  = 'permitpendingdocscheckvehicle/permitpendingdocscheckvehicle_shins_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function shins_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_shinsrules();

            if ($this->form_validation->run() == false) {
                $this->shins($this->input->post('permit_id', true));
            } else {
                $permitid_encoder = $this->input->post('permit_id', true);
                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'inspectionpending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_shinspermit = [
                        'shinspermit_approved_to_inspect' => 'y',
                        'shinspermit_completed_docs' => 'y',
                        'shinspermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'shinspermit_inspection_date' => dateserver($this->input->post('activitydate', true)),
                        'shinspermit_updated_at' => $nowdatetime,
                        'shinspermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_SHINS,
                        'permit_timeline_desc' => INSPECTION_CONFIRMED_SHINS,
                        'permit_timeline_status' => 'inspectionpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->shinspermit_model->update_by_permitid($permitid, $data_shinspermit);
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

                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('SHINS', 'pic', $data_pic, $emails);
                        //$this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendinginspection/shins/'.$permitid_encoder));

                } else {
                    $data_permit = [
                        'permit_status' => 'applicationrejected',
                        'permit_officialstatus' => 'rejected',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_shinspermit = [
                        'shinspermit_approved_to_inspect' => 'n',
                        'shinspermit_inspection_date' => dateserver($this->input->post('activitydate', true)),
                        'shinspermit_updated_at' => $nowdatetime,
                        'shinspermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_SHINS,
                        'permit_timeline_desc' => PERMIT_REJECTED_SHINS_DESC,
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
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->shinspermit_model->update_by_permitid($permitid, $data_shinspermit);
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
                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                //$this->emailcontent->shoot_email_docscheck('SHINS', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));
                }
/*                $companyid = $this->permitall_model->get_by_id($permitid)->permit_companyid;
                $emails    = array_unique($this->pic_list($companyid, 'pic_email'));
                $this->emailcontent->shoot_email_docscheck('SHINS', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));*/
            }

        } else {
            redirect('/');
        }

    }

    public function _shinsrules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function wipbriefing($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->wipbriefing_detail($id);
        $this->infopage = 'permitall/permitall_wipbriefing';
        $this->content  = 'permitpendingdocscheckvehicle/permitpendingdocscheck_wipbriefing_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wipbriefing_submit()
    {

        if ($this->permission->cp_update == true) {
            $needescort =  $this->input->post('needescort', true);
            $this->_wipbriefingrules($needescort);

            if ($this->form_validation->run() == false) {
                $this->wipbriefing($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');
                $bookingId =  $this->input->post('permit_bookingid', true);
                $escortname =  $this->input->post('escortname', true);

                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        /*'permit_status' => 'wipbriefingpending',*/
                        'permit_status' => 'approvalairsidepending',
                        'permit_officialstatus' => 'inprogress',
                        'permit_docscheck_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_wipbriefingpermit = [
                        'wipbriefingpermit_approvedby_airside' => 'y',
                        'wipbriefingpermit_completed_docs' => 'y',
                        'wipbriefingpermit_completed_docs_date' => $this->input->post('approvaldate', true),
                        'wipbriefingpermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'wipbriefingpermit_updated_at' => $nowdatetime,
                        'wipbriefingpermit_lastchanged_by' => $userid,
                        'wipbriefingpermit_escortname' => $escortname,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => DOCUMENTS_VERIFIED_WIPBRIEFING,
                        'permit_timeline_desc' => BRIEFING_CONFIRMED_WIPBRIEFING,
                        'permit_timeline_status' => 'wipbriefingpending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->wipbriefingpermit_model->update_by_permitid($permitid, $data_wipbriefingpermit);
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

                    $data_wipbriefingpermit = [
                        'wipbriefingpermit_approvedby_airside' => 'n',
                        'wipbriefingpermit_course_date' => dateserver($this->input->post('activitydate', true)),
                        'wipbriefingpermit_updated_at' => $nowdatetime,
                        'wipbriefingpermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => PERMIT_REJECTED_WIPBRIEFING,
                        'permit_timeline_desc' => PERMIT_REJECTED_WIPBRIEFING_DESC,
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
                    $this->permitpendingdocscheckvehicle_model->update($permitid, $data_permit);
                    $this->wipbriefingpermit_model->update_by_permitid($permitid, $data_wipbriefingpermit);
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
                //$this->emailcontent->shoot_email_docscheck('WIPBRIEFING', 'pic', $data_pic, $emails);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('permitpendingdocscheckvehicle'));
            }

        } else {
            redirect('/');
        }

    }

    public function _wipbriefingrules($needescort)
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');
        if($needescort=='y'){
        $this->form_validation->set_rules('escortname', ' ', 'trim|required');
        }

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    //added or deduct
    public function change_slottaken_avpevp($date, $type = 'added')
    {
        $avpevpinspectionmanagement = $this->avpevpinspectionmanagement_model->get_by_date($date);
        if ($type == 'added') {
            $slottaken = (int) $avpevpinspectionmanagement->avpevpinspectionmanagement_slottaken + 1;
        } else if ($type == 'deduct') {
            $slottaken = (int) $avpevpinspectionmanagement->avpevpinspectionmanagement_slottaken - 1;
        }

        $data_avpevpinspectionmanagement = [
            'avpevpinspectionmanagement_slottaken' => $slottaken,
        ];

        $this->avpevpinspectionmanagement_model->update($avpevpinspectionmanagement->avpevpinspectionmanagement_id, $data_avpevpinspectionmanagement);
    }
}
;
/* End of file Permitpendingdocscheckvehicle.php */
/* Location: ./application/controllers/Permitpendingdocscheckvehicle.php */
