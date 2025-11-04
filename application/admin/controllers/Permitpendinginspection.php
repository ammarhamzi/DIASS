<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitpendinginspection extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitpendinginspection_model');
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
        $this->load->model('mtwchecklist_model');
        $this->lang->load('permitpendinginspection_lang', $this->session->userdata('language'));
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
        $this->load->model('shinspermit_model');
        $this->load->model('shinschecklist_model');
        $this->lang->load('shinschecklist_lang', $this->session->userdata('language'));
    }

    function listavpevp($date) 
    {
        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [

                'permission' => $this->permission,
                'controller' => 'Permitpendinginspection',
                'pagetitle' => 'Inspection List',
                'selecteddate' => $date
            ];

            $this->content = 'permitall/permitall_custom_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }
    
    function list($permittype,$date) 
    {
        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [

                'permission' => $this->permission,
                'controller' => 'Permitpendinginspection',
                'pagetitle' => 'Inspection List',
                'permittype' => $permittype,
                'selecteddate' => $date
            ];

            $this->content = 'permitall/permitall_custom_list';
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
        $this->content  = 'permitpendinginspection/permitpendinginspection_avp_raw';
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
        $this->content  = 'permitpendinginspection/permitpendinginspection_evp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function avp_submit()
    {
        //print_r($this->input->post());exit;
        if ($this->permission->cp_update == true) {

        $inspect_y = [];
        $inspect_n = [];
        $inspect_na = [];

        $mtwchecklist_ids = $this->input->post("mtwchecklist_ids");
        foreach ($mtwchecklist_ids as $mtwchecklist_id){
                if ($this->input->post("mtwinspect_" . $mtwchecklist_id)=="y") {
                    $inspect_y[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n"){
                    $inspect_n[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n/a"){
                    $inspect_na[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }
        }
                //$avp_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);
                $avp_selfchecked_selected = $this->input->post('selfchecklist_selected', true);
                $permitid                = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime             = date('Y-m-d H:i:s');
                $userid                  = $this->session->userdata('id');
            if($this->input->post('submit', true)){

            $this->_avprules();

            if ($this->form_validation->run() == false) {
                $this->avp($this->input->post('permit_id', true));
            } else {
               if ($this->input->post('adminapproval', true) == 'y') {
            // check jika semua yg ditanda pic ditanda oleh inspector
            $intersect_result = array_intersect($avp_selfchecked_selected, $inspect_mtw_checked);


            //semua checked
            //if($avp_selfchecked_selected==$avp_mtwchecked_selected){


            if($avp_selfchecked_selected==$intersect_result){
            //if($avp_selfchecked_selected==$inspect_mtw_checked){
                    $data_permit = [
                        'permit_status' => 'inspectionpassed',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_avppermit = [
                        'avppermit_result' => 'passed',
                        'avppermit_result_inspector_id' => $userid,
                        'avppermit_inspection_date' => $this->input->post('activitydate', true),
/*                        'avppermit_smokecondition_checked' => ($this->input->post('smokecondition_checked') ? $this->input->post('smokecondition_checked') : 'n'),
                        'avppermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno_checked') ? $this->input->post('fireext_serialno_checked') : 'n'),
                        'avppermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate_checked') ? $this->input->post('fireext_expirydate_checked') : 'n'),
                        'avppermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate_checked') ? $this->input->post('tyre_manufacturingdate_checked') : 'n'),*/
                        'avppermit_smokecondition_mtw' => $this->input->post('smokecondition_mtw'),
                        'avppermit_fireext_serialno_mtw' => $this->input->post('fireext_serialno_mtw'),
                        'avppermit_fireext_expirydate_mtw' => dateserver($this->input->post('fireext_expirydate_mtw')),
                        'avppermit_tyre_manufacturingdate_mtw' => nl2br($this->input->post('tyre_manufacturingdate_mtw')),
                        'avppermit_updated_at' => $nowdatetime,
                        'avppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_PASSED_AVP,
                        'permit_timeline_desc' => INSPECTION_PASSED_AVP_DESC,
                        'permit_timeline_status' => 'inspectionpassed',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->avpchecklist_model->update_mtw_inspection($permitid, $avp_mtwchecked_selected);
                    $this->avpchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->avppermit_model->update_by_permitid($permitid, $data_avppermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Avppermit/inspectioncalendar'));
                    }
            }else{
                        $this->session->set_flashdata('message_notcompleted', 'Please check all inspection list');
                        //redirect(site_url('Avppermit/inspectioncalendar'));
                        $this->avp($this->input->post('permit_id', true));
            }

                } else {
                    $data_permit = [
                        'permit_status' => 'inspectionfailed',
                        'permit_officialstatus' => 'failed',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_avppermit = [
                        'avppermit_result' => 'failed',
                        'avppermit_result_inspector_id' => $userid,
                        //'avppermit_inspection_date' => $this->input->post('approvaldate', true),
/*                        'avppermit_smokecondition_checked' => ($this->input->post('smokecondition') ? $this->input->post('smokecondition') : 'n'),
                        'avppermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno') ? $this->input->post('fireext_serialno') : 'n'),
                        'avppermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate') ? $this->input->post('fireext_expirydate') : 'n'),
                        'avppermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate') ? $this->input->post('tyre_manufacturingdate') : 'n'),*/
                        'avppermit_smokecondition_mtw' => $this->input->post('smokecondition_mtw'),
                        'avppermit_fireext_serialno_mtw' => $this->input->post('fireext_serialno_mtw'),
                        'avppermit_fireext_expirydate_mtw' => dateserver($this->input->post('fireext_expirydate_mtw')),
                        'avppermit_tyre_manufacturingdate_mtw' => nl2br($this->input->post('tyre_manufacturingdate_mtw')),
                        'avppermit_updated_at' => $nowdatetime,
                        'avppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_FAILED_AVP,
                        'permit_timeline_desc' => INSPECTION_FAILED_AVP_DESC,
                        'permit_timeline_status' => 'inspectionfailed',
                        'permit_timeline_officialstatus' => 'failed',
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
                    //$this->avpchecklist_model->update_mtw_inspection($permitid, $avp_mtwchecked_selected);
                    $this->avpchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->avppermit_model->update_by_permitid($permitid, $data_avppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Avppermit/inspectioncalendar'));
                    }

                }
            }
            }else{

                    $data_permit = [
                        'permit_status' => 'inspectionkiv',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_avppermit = [
                        'avppermit_result' => 'kiv',
                        'avppermit_result_inspector_id' => $userid,
                        //'avppermit_inspection_date' => $this->input->post('approvaldate', true),
                        'avppermit_smokecondition_mtw' => $this->input->post('smokecondition_mtw'),
                        'avppermit_fireext_serialno_mtw' => $this->input->post('fireext_serialno_mtw'),
                        'avppermit_fireext_expirydate_mtw' => dateserver($this->input->post('fireext_expirydate_mtw')),
                        'avppermit_tyre_manufacturingdate_mtw' => nl2br($this->input->post('tyre_manufacturingdate_mtw')),
                        'avppermit_updated_at' => $nowdatetime,
                        'avppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_KIV_AVP,
                        'permit_timeline_desc' => INSPECTION_KIV_AVP_DESC,
                        'permit_timeline_status' => 'inspectionkiv',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
                        'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->avpchecklist_model->update_mtw_inspection($permitid, $avp_mtwchecked_selected);
                    $this->avpchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->avppermit_model->update_by_permitid($permitid, $data_avppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Save record as draf success');
                        //redirect(site_url('Avppermit/inspectioncalendar'));
                        $this->avp($this->input->post('permit_id', true));
                    }
            }

        } else {
            redirect('/');
        }

    }

    public function evp_submit()
    {

        if ($this->permission->cp_update == true) {
        $inspect_y = [];
        $inspect_n = [];
        $inspect_na = [];

        $mtwchecklist_ids = $this->input->post("mtwchecklist_ids");
        foreach ($mtwchecklist_ids as $mtwchecklist_id){
                if ($this->input->post("mtwinspect_" . $mtwchecklist_id)=="y") {
                    $inspect_y[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n"){
                    $inspect_n[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n/a"){
                    $inspect_na[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }
        }
                //$evp_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);
                $evp_selfchecked_selected = $this->input->post('selfchecklist_selected', true);
                $permitid                = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime             = date('Y-m-d H:i:s');
                $userid                  = $this->session->userdata('id');

if($this->input->post('submit', true)){
            $this->_evprules();

            if ($this->form_validation->run() == false) {
                $this->evp($this->input->post('permit_id', true));
            } else {


                if ($this->input->post('adminapproval', true) == 'y') {
/*            print_r($evp_selfchecked_selected);
            print_r($evp_mtwchecked_selected);
            exit;*/
            //semua checked
            //if($evp_selfchecked_selected==$evp_mtwchecked_selected){
            if($evp_selfchecked_selected==$inspect_mtw_checked){
                    $data_permit = [
                        'permit_status' => 'inspectionpassed',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_evppermit = [
                        'evppermit_result' => 'passed',
                        'evppermit_result_inspector_id' => $userid,
                        'evppermit_inspection_date' => $this->input->post('activitydate', true),
                        'evppermit_updated_at' => $nowdatetime,
                        'evppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_PASSED_EVP,
                        'permit_timeline_desc' => INSPECTION_PASSED_EVP_DESC,
                        'permit_timeline_status' => 'inspectionpassed',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->evpchecklist_model->update_mtw_inspection($permitid, $evp_mtwchecked_selected);
                    $this->evpchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->evppermit_model->update_by_permitid($permitid, $data_evppermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Evppermit/inspectioncalendar'));
                    }
            }else{
                        $this->session->set_flashdata('message_notcompleted', 'Please check all inspection list');
                        //redirect(site_url('Avppermit/inspectioncalendar'));
                        $this->evp($this->input->post('permit_id', true));
            }

                } else {
                    $data_permit = [
                        'permit_status' => 'inspectionfailed',
                        'permit_officialstatus' => 'failed',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_evppermit = [
                        'evppermit_result' => 'failed',
                        'evppermit_result_inspector_id' => $userid,
                        'evppermit_inspection_date' => $this->input->post('activitydate', true),
                        'evppermit_updated_at' => $nowdatetime,
                        'evppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_FAILED_EVP,
                        'permit_timeline_desc' => INSPECTION_FAILED_EVP_DESC,
                        'permit_timeline_status' => 'inspectionfailed',
                        'permit_timeline_officialstatus' => 'failed',
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
                    $this->evpchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->evppermit_model->update_by_permitid($permitid, $data_evppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Evppermit/inspectioncalendar'));
                    }

                }




            }
}else{
                    $data_permit = [
                        'permit_status' => 'inspectionkiv',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_evppermit = [
                        'evppermit_result' => 'kiv',
                        'evppermit_result_inspector_id' => $userid,
                        'evppermit_inspection_date' => $this->input->post('activitydate', true),
                        'evppermit_updated_at' => $nowdatetime,
                        'evppermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_KIV_EVP,
                        'permit_timeline_desc' => INSPECTION_KIV_EVP_DESC,
                        'permit_timeline_status' => 'inspectionkiv',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->evpchecklist_model->update_mtw_inspection($permitid, $evp_mtwchecked_selected);
                    $this->evpchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->evppermit_model->update_by_permitid($permitid, $data_evppermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Save record as draf success');
                        //redirect(site_url('Avppermit/inspectioncalendar'));
                        $this->evp($this->input->post('permit_id', true));
                    }
}

        } else {
            redirect('/');
        }

    }

    public function _avprules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        //$this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _evprules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        //$this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json($permittype, $selecteddate, $location='all')
    {
        $condition = [
            'permittype' => $permittype,
            'selecteddate' => $selecteddate
        ];
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
            'permit_inspection_remark',
            'permit_recent_permitid',
            'permit_created_at',

        ];
        $results = $this->permitpendinginspection_model->listajax(
        $location,
            $condition,
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
                $rud .= anchor(site_url('permitpendinginspection/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
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
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            }     elseif ($r['permit_type_name_permit_typeid'] == "SHINS") {
                /*$val = 'NA';*/
                $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            }

            $appdate = explode(" ", $r['permit_created_at']);

/*            if ($r['permit_officialstatus_name_permit_officialstatus'] == 'completed') {
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
            }*/

            if($r['permit_status']=='inspectionpending'){
                 $status = '<span class="label label-primary">inspection not started</span>';
            }elseif($r['permit_status']=='inspectionkiv'){
                 $status = '<span class="label label-warning">Saved as draft</span>';
            }elseif($r['permit_status']=='inspectionpassed'){
                 $status = '<span class="label label-success">Inspected (Passed)</span>';
            }elseif($r['permit_status']=='inspectionfailed'){
                 $status = '<span class="label label-danger">Inspected (failed)</span>';
            }elseif($r['permit_status']=='mtwreviewpending'){
                 $status = '<a href="/admin/permitpendingdocscheckvehicle/' .strtolower ($r['permit_type_name_permit_typeid']). '/' .fixzy_encoder($r['permit_id']). '">Pending for Docs verification</a>';
            }elseif($r['permit_status']=='applicationrejected'){
                 $status = '<span class="label label-danger">rejected</span>';
            }else{
                 $status = '<span class="label label-danger">Application cancelled</span>';
            }

            array_push($data, [
/*                $i, */
                $r['company_name_permit_companyid'],
                $r['permit_bookingid'],
                $val,
                $r['permit_type_desc'],
                $r['inspection_location'],
                $status,
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
                "recordsTotal" => $this->permitpendinginspection_model->recordsTotal($condition,$location)->recordstotal,
                "recordsFiltered" => $this->permitpendinginspection_model->recordsFiltered($condition, $location,$columns, $this->input->get('search')['value'])->recordsfiltered,
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
        $this->content  = 'permitpendinginspection/permitpendinginspection_wip_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

/*    public function wip_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_wiprules();

            if ($this->form_validation->run() == false) {
                $this->wip($this->input->post('permit_id', true));
            } else {

        $mtwchecklist_ids = $this->input->post("mtwchecklist_ids");
        foreach ($mtwchecklist_ids as $mtwchecklist_id){
                if ($this->input->post("mtwinspect_" . $mtwchecklist_id)=="y") {
                    $inspect_y[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n"){
                    $inspect_n[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n/a"){
                    $inspect_na[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }
        }
                //$wip_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);
                $permitid                = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime             = date('Y-m-d H:i:s');
                $userid                  = $this->session->userdata('id');
                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'inspectionpassed',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_wippermit = [
                        'wippermit_result' => 'passed',
                        'wippermit_result_inspector_id' => $userid,
                        'wippermit_inspection_date' => $this->input->post('activitydate', true),
                        'wippermit_smokecondition_checked' => ($this->input->post('smokecondition_checked') ? $this->input->post('smokecondition_checked') : 'n'),
                        'wippermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno_checked') ? $this->input->post('fireext_serialno_checked') : 'n'),
                        'wippermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate_checked') ? $this->input->post('fireext_expirydate_checked') : 'n'),
                        'wippermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate_checked') ? $this->input->post('tyre_manufacturingdate_checked') : 'n'),
                        'wippermit_updated_at' => $nowdatetime,
                        'wippermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_PASSED_WIP,
                        'permit_timeline_desc' => INSPECTION_PASSED_WIP_DESC,
                        'permit_timeline_status' => 'inspectionpassed',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->wipchecklist_model->update_mtw_inspection($permitid, $wip_mtwchecked_selected);
                    $this->wipchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->wippermit_model->update_by_permitid($permitid, $data_wippermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {


                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Wippermit/inspectioncalendar'));
                    }
                } else {
                    $data_permit = [
                        'permit_status' => 'inspectionfailed',
                        'permit_officialstatus' => 'failed',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_wippermit = [
                        'wippermit_result' => 'failed',
                        'wippermit_result_inspector_id' => $userid,
                        'wippermit_inspection_date' => $this->input->post('activitydate', true),
                        'wippermit_smokecondition_checked' => ($this->input->post('smokecondition') ? $this->input->post('smokecondition') : 'n'),
                        'wippermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno') ? $this->input->post('fireext_serialno') : 'n'),
                        'wippermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate') ? $this->input->post('fireext_expirydate') : 'n'),
                        'wippermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate') ? $this->input->post('tyre_manufacturingdate') : 'n'),
                        'wippermit_updated_at' => $nowdatetime,
                        'wippermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_FAILED_WIP,
                        'permit_timeline_desc' => INSPECTION_FAILED_WIP_DESC,
                        'permit_timeline_status' => 'inspectionfailed',
                        'permit_timeline_officialstatus' => 'failed',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];
                    $this->db->trans_start();
                    //$this->wipchecklist_model->update_mtw_inspection($permitid, $wip_mtwchecked_selected);
                    $this->wipchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->adppermit_model->update_by_permitid($permitid, $data_adppermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {


                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Wippermit/inspectioncalendar'));
                    }

                }

            }

        } else {
            redirect('/');
        }

    }*/

    public function wip_submit()
    {
        //print_r($this->input->post());exit;
        if ($this->permission->cp_update == true) {

        $inspect_y = [];
        $inspect_n = [];
        $inspect_na = [];

        $mtwchecklist_ids = $this->input->post("mtwchecklist_ids");
        foreach ($mtwchecklist_ids as $mtwchecklist_id){
                if ($this->input->post("mtwinspect_" . $mtwchecklist_id)=="y") {
                    $inspect_y[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n"){
                    $inspect_n[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n/a"){
                    $inspect_na[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }
        }
                //$wip_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);
                $wip_selfchecked_selected = $this->input->post('selfchecklist_selected', true);
                $permitid                = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime             = date('Y-m-d H:i:s');
                $userid                  = $this->session->userdata('id');
            if($this->input->post('submit', true)){

            $this->_wiprules();

            if ($this->form_validation->run() == false) {
            //var_dump($this->input->post());exit;
            $this->session->set_flashdata('message', 'Rules problem');
                $this->wip($this->input->post('permit_id', true));
            } else {

               if ($this->input->post('adminapproval', true) == 'y') {

            //semua checked
            //if($wip_selfchecked_selected==$wip_mtwchecked_selected){
            if($wip_selfchecked_selected==$inspect_mtw_checked){

                    $data_permit = [
                        'permit_status' => 'inspectionpassed',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_wippermit = [
                        'wippermit_result' => 'passed',
                        'wippermit_result_inspector_id' => $userid,
                        'wippermit_inspection_date' => $this->input->post('activitydate', true),
/*                        'wippermit_smokecondition_checked' => ($this->input->post('smokecondition_checked') ? $this->input->post('smokecondition_checked') : 'n'),
                        'wippermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno_checked') ? $this->input->post('fireext_serialno_checked') : 'n'),
                        'wippermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate_checked') ? $this->input->post('fireext_expirydate_checked') : 'n'),
                        'wippermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate_checked') ? $this->input->post('tyre_manufacturingdate_checked') : 'n'),*/
                        'wippermit_smokecondition_mtw' => $this->input->post('smokecondition_mtw'),
                        'wippermit_fireext_serialno_mtw' => $this->input->post('fireext_serialno_mtw'),
                        'wippermit_fireext_expirydate_mtw' => dateserver($this->input->post('fireext_expirydate_mtw')),
                        'wippermit_tyre_manufacturingdate_mtw' => nl2br($this->input->post('tyre_manufacturingdate_mtw')),
                        'wippermit_updated_at' => $nowdatetime,
                        'wippermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_PASSED_AVP,
                        'permit_timeline_desc' => INSPECTION_PASSED_AVP_DESC,
                        'permit_timeline_status' => 'inspectionpassed',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->wipchecklist_model->update_mtw_inspection($permitid, $wip_mtwchecked_selected);
                    $this->wipchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->wippermit_model->update_by_permitid($permitid, $data_wippermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Wippermit/inspectioncalendar'));
                    }
            }else{
            //var_dump($this->input->post());exit;
            //var_dump($wip_selfchecked_selected);
            //print("<pre>".print_r($wip_selfchecked_selected,true)."</pre>");
            //print("<pre>".print_r($inspect_mtw_checked,true)."</pre>");
            //var_dump($inspect_mtw_checked);
           // exit;
                        $this->session->set_flashdata('message_notcompleted', 'Please check all inspection list');
                        //redirect(site_url('Avppermit/inspectioncalendar'));
                        $this->wip($this->input->post('permit_id', true));
            }

                } else {
                    $data_permit = [
                        'permit_status' => 'inspectionfailed',
                        'permit_officialstatus' => 'failed',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_wippermit = [
                        'wippermit_result' => 'failed',
                        'wippermit_result_inspector_id' => $userid,
                        //'wippermit_inspection_date' => $this->input->post('approvaldate', true),
                        'wippermit_smokecondition_checked' => ($this->input->post('smokecondition') ? $this->input->post('smokecondition') : 'n'),
                        'wippermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno') ? $this->input->post('fireext_serialno') : 'n'),
                        'wippermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate') ? $this->input->post('fireext_expirydate') : 'n'),
                        'wippermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate') ? $this->input->post('tyre_manufacturingdate') : 'n'),
                        'wippermit_updated_at' => $nowdatetime,
                        'wippermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_FAILED_AVP,
                        'permit_timeline_desc' => INSPECTION_FAILED_AVP_DESC,
                        'permit_timeline_status' => 'inspectionfailed',
                        'permit_timeline_officialstatus' => 'failed',
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
                    //$this->wipchecklist_model->update_mtw_inspection($permitid, $wip_mtwchecked_selected);
                    $this->wipchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->wippermit_model->update_by_permitid($permitid, $data_wippermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Wippermit/inspectioncalendar'));
                    }

                }
            }
            }else{

                    $data_permit = [
                        'permit_status' => 'inspectionkiv',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_wippermit = [
                        'wippermit_result' => 'kiv',
                        'wippermit_result_inspector_id' => $userid,
                        //'wippermit_inspection_date' => $this->input->post('approvaldate', true),
                        'wippermit_smokecondition_mtw' => $this->input->post('smokecondition_mtw'),
                        'wippermit_fireext_serialno_mtw' => $this->input->post('fireext_serialno_mtw'),
                        'wippermit_fireext_expirydate_mtw' => dateserver($this->input->post('fireext_expirydate_mtw')),
                        'wippermit_tyre_manufacturingdate_mtw' => nl2br($this->input->post('tyre_manufacturingdate_mtw')),
                        'wippermit_updated_at' => $nowdatetime,
                        'wippermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_KIV_AVP,
                        'permit_timeline_desc' => INSPECTION_KIV_AVP_DESC,
                        'permit_timeline_status' => 'inspectionkiv',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
                        'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->wipchecklist_model->update_mtw_inspection($permitid, $wip_mtwchecked_selected);
                    $this->wipchecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->wippermit_model->update_by_permitid($permitid, $data_wippermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Save record as draf success');
                        //redirect(site_url('Avppermit/inspectioncalendar'));
                        $this->wip($this->input->post('permit_id', true));
                    }
            }

        } else {
        $this->session->set_flashdata('message', 'not allowed to update');
            redirect('/');
        }

    }

    public function _wiprules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        //$this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

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
        $this->content  = 'permitpendinginspection/permitpendinginspection_shins_raw';
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

        $mtwchecklist_ids = $this->input->post("mtwchecklist_ids");
        foreach ($mtwchecklist_ids as $mtwchecklist_id){
                if ($this->input->post("mtwinspect_" . $mtwchecklist_id)=="y") {
                    $inspect_y[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n"){
                    $inspect_n[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }elseif($this->input->post("mtwinspect_" . $mtwchecklist_id)=="n/a"){
                    $inspect_na[] = $mtwchecklist_id;
                    $inspect_mtw_checked[] = $mtwchecklist_id;
                }
        }
                //$shins_mtwchecked_selected = $this->input->post('mtwchecklist_selected', true);
                $permitid                = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime             = date('Y-m-d H:i:s');
                $userid                  = $this->session->userdata('id');
                if ($this->input->post('adminapproval', true) == 'y') {

                    $data_permit = [
                        'permit_status' => 'inspectionpassed',
                        'permit_officialstatus' => 'inprogress',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];
                    $data_shinspermit = [
                        'shinspermit_result' => 'passed',
                        'shinspermit_result_inspector_id' => $userid,
                        'shinspermit_inspection_date' => $this->input->post('activitydate', true),
                        'shinspermit_smokecondition_checked' => ($this->input->post('smokecondition_checked') ? $this->input->post('smokecondition_checked') : 'n'),
                        'shinspermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno_checked') ? $this->input->post('fireext_serialno_checked') : 'n'),
                        'shinspermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate_checked') ? $this->input->post('fireext_expirydate_checked') : 'n'),
                        'shinspermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate_checked') ? $this->input->post('tyre_manufacturingdate_checked') : 'n'),
                        'shinspermit_updated_at' => $nowdatetime,
                        'shinspermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_PASSED_SHINS,
                        'permit_timeline_desc' => INSPECTION_PASSED_SHINS_DESC,
                        'permit_timeline_status' => 'inspectionpassed',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => $nowdatetime,
                        'permit_timeline_lastchanged_by' => $userid,
'permit_timeline_remark' => $this->input->post('remark', true)
                    ];

                    $this->db->trans_start();
                    //$this->shinschecklist_model->update_mtw_inspection($permitid, $shins_mtwchecked_selected);
                    $this->shinschecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->shinspermit_model->update_by_permitid($permitid, $data_shinspermit);
                    $this->permittimelinedom_model->insert($data_timeline);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Shinspermit/inspectioncalendar'));
                    }
                } else {
                    $data_permit = [
                        'permit_status' => 'inspectionfailed',
                        'permit_officialstatus' => 'failed',
                        'permit_inspection_remark' => $this->input->post('remark', true),
                        'permit_updated_at' => $nowdatetime,
                        'permit_lastchanged_by' => $userid,
                    ];

                    $data_shinspermit = [
                        'shinspermit_result' => 'failed',
                        'shinspermit_result_inspector_id' => $userid,
                        'shinspermit_inspection_date' => $this->input->post('activitydate', true),
                        'shinspermit_smokecondition_checked' => ($this->input->post('smokecondition') ? $this->input->post('smokecondition') : 'n'),
                        'shinspermit_fireext_serialno_checked' => ($this->input->post('fireext_serialno') ? $this->input->post('fireext_serialno') : 'n'),
                        'shinspermit_fireext_expirydate_checked' => ($this->input->post('fireext_expirydate') ? $this->input->post('fireext_expirydate') : 'n'),
                        'shinspermit_tyre_manufacturingdate_checked' => ($this->input->post('tyre_manufacturingdate') ? $this->input->post('tyre_manufacturingdate') : 'n'),
                        'shinspermit_updated_at' => $nowdatetime,
                        'shinspermit_lastchanged_by' => $userid,
                    ];

                    $data_timeline = [
                        'permit_timeline_permitid' => $permitid,
                        'permit_timeline_userid' => $userid,
                        'permit_timeline_name' => INSPECTION_FAILED_SHINS,
                        'permit_timeline_desc' => INSPECTION_FAILED_SHINS_DESC,
                        'permit_timeline_status' => 'inspectionfailed',
                        'permit_timeline_officialstatus' => 'failed',
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
                    //$this->shinschecklist_model->update_mtw_inspection($permitid, $shins_mtwchecked_selected);
                    $this->shinschecklist_model->update_mtw_inspection_v3($permitid, $inspect_y, $inspect_n, $inspect_na);
                    $this->permitpendinginspection_model->update($permitid, $data_permit);
                    $this->shinspermit_model->update_by_permitid($permitid, $data_shinspermit);
                    $this->permittimelinedom_model->insert($data_timeline);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                        echo 'error';
                    } else {
                        /* $this->logQueries($this->config->item('dblog')); */

                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('Shinspermit/inspectioncalendar'));
                    }

                }

            }

        } else {
            redirect('/');
        }

    }

    public function _shinsrules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        //$this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }
}
;
/* End of file Permitpendinginspection.php */
/* Location: ./application/controllers/Permitpendinginspection.php */
