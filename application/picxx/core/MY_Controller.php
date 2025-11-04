<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller
{

//set the class variable.
    public $permission = '';
    public function __construct()
    {

        parent::__construct();
                     if (_LOGIN_METHOD == 'PRODUCTION')
             {
         if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
             $url = "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
             redirect($url);
             exit;
         }
             }
        $this->load->model('my_model');
        $this->load->model('permission_model');
        $this->load->model('mtwchecklist_model');
        $this->load->model('Enforcement_model');
/*        $this->load->model('avpchecklist_model');
$this->load->model('evpchecklist_model');*/
        $this->config->load('custom_config');
        $this->lang->load('global_lang', $this->session->userdata('language'));
        $this->lang->load('parentchild_lang', $this->session->userdata('language'));
        $this->output->enable_profiler($this->config->item('profiler'));
        $this->form_validation->set_message('required', 'Required');
        //check controller is registered or not.

        $this->permission = $this->permission_model->access_role($this->session->userdata('groupid'), $this->router->fetch_class());

        if (!$this->session->userdata('authentication')) {
            $config = $this->my_model->get_data('config', '*', "config_identifier ='" . $this->config->item('dbconfig_identifier') . "'");

            $this->session->set_userdata('authentication', $config[0]->config_value);
            $this->session->set_userdata('theme', $config[1]->config_value);
            $this->session->set_userdata('language', $config[2]->config_value);
            $this->session->set_userdata('admintitle_long', $config[3]->config_value);
            $this->session->set_userdata('admintitle_short', $config[4]->config_value);
            $this->session->set_userdata('copyright_notice', $config[5]->config_value);
            $this->session->set_userdata('version_info', $config[6]->config_value);
            $this->session->set_userdata('menutype', $config[7]->config_value);
        }

        if($this->session->userdata('menutype') != 'top-nav')
        {
            $config = $this->my_model->get_data('config', '*', "config_identifier ='" . $this->config->item('dbconfig_identifier') . "'");
            $this->session->set_userdata('menutype', $config[7]->config_value);
        }

        if ($this->session->userdata('authentication') == "y" && !$this->session->userdata('islogin') && strtolower($this->router->fetch_class()) != "authentication" && strtolower($this->router->fetch_class()) != "examdriver") {
            redirect(site_url('Authentication'));
        } else {
            if ($this->check_requiredinfo() == false && strtolower($this->router->fetch_class()) != "profile" && strtolower($this->router->fetch_class()) != "authentication") {

                $this->session->set_flashdata('required_info', 'You are required to fill up compulsory information before continue to use this system.');

                redirect('profile');
            }
        }

                if($this->session->userdata('islogin') == '1' && $this->session->userdata('groupid') != '2'){
                    redirect('admin/');
                }

    }

    public function layout($data = [], $setting = [], $show_menu = 1, $parentchildmenu = [])
    {

        if ($this->config->item('apps_type') == 'web') {
            $data['title'] = $this->config->item('title');
            $template      = ['menu' => $this->get_menu($show_menu), 'content' => $this->load->view($this->content, $data, true), 'genlist' => $this->load->view('layout/genoption/' . $setting['method'] . '-' . $setting['patern'], ['controller' => strtolower($this->router->fetch_class())], true), ];
            if (isset($this->slave)) {
                $template['slave_combine'] = $this->load->view($this->slave, $data, true);
            }

            if (isset($this->parentchildmenu)) {
                $template['parentchildmenu'] = $this->parentchildmenu;
            }
            $this->load->view('layout/themes/' . $this->session->userdata('theme') . '/' . $setting['method'] . '/' . $setting['patern'], $template);
        } elseif ($this->config->item('apps_type') == 'json') {
            $raw = ['menu' => $this->get_menu($show_menu), 'content' => $data, ];
            echo json_encode($raw);
        }
    }

    public function get_menu($showme = 1, $is_gen = 0)
    {
        $groupid         = $this->session->userdata('groupid');
        $parentmenus     = $this->my_model->get_data('menu', '*', "menu_parentid = 0 and menu_isactive = 1 and menu_deleted_at IS NULL and menu_id in (select permission_menuid from permission where permission_usergroup = $groupid) order by menu_sort asc");
        $menus['parent'] = $parentmenus;
        if ($parentmenus) {
            foreach ($parentmenus as $menu) {
                $childmenus                     = $this->my_model->get_data('menu', '*', 'menu_parentid = ' . $menu->menu_id . ' and menu_isactive = 1 and menu_deleted_at IS NULL order by menu_sort asc');
                $menus['child'][$menu->menu_id] = array();
                if(!empty($childmenus))
                {
                    $menus['child'][$menu->menu_id] = $childmenus;
                }

            }
        }

        if ($is_gen == 0) {
            if ($this->config->item('apps_type') == 'web') {
                if ($showme == 1) {
                    $menus['theme']     = $this->session->userdata('theme');
                    $menus['parent_id'] = ($this->router->fetch_class() ? $this->my_model->get_value2('menu', 'menu_parentid', "menu_controller='" . $this->router->fetch_class() . "' group by menu_parentid") : 'Fixzycrud');
                    return $this->load->view('foundation/menu', $menus, true);
                } else {
                    return null;
                }

            } elseif ($this->config->item('apps_type') == 'json') {
                if ($showme == 1) {
                    return $menus;
                } else {
                    return [];
                }
            }

        } else {
            $this->load->view('foundation/menu', $menus);
        }

    }

    public function logQueries($enabled = true)
    {
        if ($enabled === true) {
            $times = $this->db->query_times;
            foreach ($this->db->queries as $key => $query) {

                if (preg_match("/\blogging\b/i", $query)) {
                    if (preg_match("/\binsert\b/i", $query)) {
                        $log_action = 'Add New';
                    } else if (preg_match("/\bupdate\b/i", $query)) {
                        $log_action = 'Edit';
                    } else if (preg_match("/\bdelete\b/i", $query)) {
                        $log_action = 'Remove';
                    } else {
                        $log_action = 'Display';
                    }
                    $sql = $query . " \n Execution Time:" . $times[$key];
                    $this->db->insert('logging', ['user_id' => $this->session->userdata('id'), 'string_query' => $query, 'query_type' => $log_action, 'executetime' => $times[$key], 'datetime_query' => date('Y-m-d h:m:s')]);
                }

            }
        }

    }

    public function check_requiredinfo()
    {

        $id             = $this->session->userdata('id');
        $requiredfields = [
            "user_username",
            "user_name",
            "user_email",
        ];
        if (!empty($id)) {
            return $this->my_model->required_done('userlist', 'user_id', $id, $requiredfields);
        } else {
            return true;
        }

    }

    public function adp_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $adppermit   = $this->adppermit_model->get_read_by_permitid($row->permit_id);
        $examresult  = $this->adppermit_model->get_exam_results($row->permit_id);
        $driver      = $this->driver_model->get_read($adppermit->adppermit_driver_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "adp_requireddoc");
        $certdoc     = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "adp_trainercert");
        $driverinfo     = $this->uploadfiles_model->get_driverinfo_by_driverid($driver->driver_id);
        $otherfile   = $this->uploadfiles_model->get_allother_by_permitid($row->permit_id);
        $driverphoto = $this->uploadfiles_model->get_photo_by_driverid($driver->driver_id);
        $competency  = $this->examresult_model->get_candidate_answer($adppermit->adppermit_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_driver($driver->driver_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_adp_list($driver->driver_id);

        $data_adppermit   = [];
        $data_driver      = [];
        $data_timeline    = [];
        $data_files       = [];
        $data_driverphoto = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
                'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($adppermit) {
                $data_adppermit = [
                    'adppermit_permit_id' => $adppermit->adppermit_permit_id,
                    'adppermit_driver_id' => $adppermit->adppermit_driver_id,
                    'adppermit_driveracknowledgement' => $adppermit->adppermit_driveracknowledgement,
                    'adppermit_verifybyemployer' => $adppermit->adppermit_verifybyemployer,
                    'adppermit_certbytrainer' => (!empty($adppermit->adppermit_certbytrainer)?$adppermit->adppermit_certbytrainer:"-"),
                    'adppermit_certbytrainer_date' => (!empty($adppermit->adppermit_certbytrainer_date)?$adppermit->adppermit_certbytrainer_date:"-"),
                    'adppermit_verifybymahb' => $adppermit->adppermit_verifybymahb,
                    'adppermit_verifybymahb_drivingarea' => $adppermit->adppermit_verifybymahb_drivingarea,
                    'adppermit_verifybymahb_vehicleclass' => $adppermit->adppermit_verifybymahb_vehicleclass,
                    'adppermit_course_date' => $adppermit->adppermit_course_date,
                    'adppermit_competencytest_date' => $adppermit->adppermit_competencytest_date,
                    'adppermit_attendbriefing' => $adppermit->adppermit_attendbriefing,
                    'adppermit_attendanceslip' => $adppermit->adppermit_attendanceslip,
                    'adppermit_examscheduled' => $adppermit->adppermit_examscheduled,
                    'adppermit_approvedtotakeexam_by' => $adppermit->adppermit_approvedtotakeexam_by,
                    'adppermit_exampass' => $adppermit->adppermit_exampass,
                    'adppermit_completed_docs' => $adppermit->adppermit_completed_docs,
                    'adppermit_approvedby_airside' => $adppermit->adppermit_approvedby_airside,
                    'adppermit_created_at' => $adppermit->adppermit_created_at,
                    'adppermit_updated_at' => $adppermit->adppermit_updated_at,
                    'adppermit_deleted_at' => $adppermit->adppermit_deleted_at,
                    'adppermit_lastchanged_by' => $adppermit->adppermit_lastchanged_by,
                    'adppermit_course_location' => $adppermit->adppermit_course_location,
                    'adppermit_competencytest_session'  => $adppermit->adppermit_competencytest_session,
                ];
            }

            if ($driver) {
                $data_driver = [
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
'driver_displayname' => $driver->driver_displayname,
                    'driver_dob' => $driver->driver_dob,
                    'driver_ic' => $driver->driver_ic,
                    'driver_designation' => $driver->driver_designation,
                    'driver_department' => $driver->driver_department,
                    'driver_nationality_country_id' => $driver->ref_country_name_driver_nationality_country_id,
                    'driver_address' => $driver->driver_address,
                    'driver_officeno' => $driver->driver_officeno,
                    'driver_hpno' => $driver->driver_hpno,
                    'driver_email' => $driver->driver_email,
                    'driver_jpjdrivinglicenseno' => $driver->driver_jpjdrivinglicenseno,
                    'driver_jpjdrivingclass' => $driver->driver_jpjdrivingclass,
                    'driver_jpjlicenseexpirydate' => $driver->driver_jpjlicenseexpirydate,
                    'driver_drivinglicenseno' => $driver->driver_drivinglicenseno,
                    'driver_drivingclass' => $driver->driver_drivingclass,
                    'driver_licenseexpirydate' => $driver->driver_licenseexpirydate,
                    'driver_blacklistedremark' => $driver->driver_blacklistedremark,
                    'driver_permit_typeid' => $driver->driver_permit_typeid,
                    'driver_activity_statusid' => $driver->driver_activity_statusid,
                    'driver_application_date' => $driver->driver_application_date,
                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'other_files' => $otherfile,
                    'certdoc' => $certdoc,
                    'driver_info' => $driverinfo,
                ];
            }

            if ($driverphoto) {
                $data_driverphoto = [
                    'driver_photo' => $driverphoto,
                ];
            }

            $data_examset = [
                'examresult' => $examresult,
                'exambank' => $this->exambank_model->get_all(),
                'competency' => $competency,
            ];

            $data = array_merge($data_permit, $data_adppermit, $data_driver, $data_timeline, $data_files, $data_driverphoto, $data_examset, $data_extra);

            return $data;
        }

    }

    public function evdp_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $evdppermit  = $this->evdppermit_model->get_read_by_permitid($row->permit_id);
        $driver      = $this->driver_model->get_read($evdppermit->evdppermit_driver_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "evdp_requireddoc");
        $driverphoto = $this->uploadfiles_model->get_photo_by_driverid($driver->driver_id);
        $driverinfo     = $this->uploadfiles_model->get_driverinfo_by_driverid($driver->driver_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_driver($driver->driver_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_evdp_list($driver->driver_id);

        $data_evdppermit  = [];
        $data_driver      = [];
        $data_timeline    = [];
        $data_files       = [];
        $data_driverphoto = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($evdppermit) {
                $data_evdppermit = [
                    'evdppermit_permit_id' => $evdppermit->evdppermit_permit_id,
                    'evdppermit_driver_id' => $evdppermit->evdppermit_driver_id,

                    'evdppermit_driveracknowledgement' => $evdppermit->evdppermit_driveracknowledgement,
                    'evdppermit_driveracknowledgement_date' => $evdppermit->evdppermit_driveracknowledgement_date,
                    'evdppermit_certbyemployer' => $evdppermit->evdppermit_certbyemployer,
                    'evdppermit_certbyemployer_date' => $evdppermit->evdppermit_certbyemployer_date,
                    'evdppermit_certbytrainer' => $evdppermit->evdppermit_certbytrainer,
                    'evdppermit_certbytrainer_date' => $evdppermit->evdppermit_certbytrainer_date,
                    'evdppermit_course_date' => $evdppermit->evdppermit_course_date,
                    'evdppermit_course_session' => $evdppermit->evdppermit_course_session,
                    'evdppermit_terminalbriefingscheduled' => $evdppermit->evdppermit_terminalbriefingscheduled,
                    'evdppermit_terminalbriefingapproval' => $evdppermit->evdppermit_terminalbriefingapproval,
                    'evdppermit_attendterminalbriefing' => $evdppermit->evdppermit_attendterminalbriefing,
                    'evdppermit_completed_docs' => $evdppermit->evdppermit_completed_docs,
                    'evdppermit_approvedby_airside' => $evdppermit->evdppermit_approvedby_airside,
                    'evdppermit_created_at' => $evdppermit->evdppermit_created_at,
                    'evdppermit_updated_at' => $evdppermit->evdppermit_updated_at,
                    'evdppermit_deleted_at' => $evdppermit->evdppermit_deleted_at,
                    'evdppermit_lastchanged_by' => $evdppermit->evdppermit_lastchanged_by,
                    'evdppermit_course_location' => $evdppermit->evdppermit_course_location,
                ];
            }

            if ($driver) {
                $data_driver = [
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
'driver_displayname' => $driver->driver_displayname,
                    'driver_dob' => $driver->driver_dob,
                    'driver_ic' => $driver->driver_ic,
                    'driver_designation' => $driver->driver_designation,
                    'driver_department' => $driver->driver_department,
                    'driver_nationality_country_id' => $driver->ref_country_name_driver_nationality_country_id,
                    'driver_address' => $driver->driver_address,
                    'driver_officeno' => $driver->driver_officeno,
                    'driver_hpno' => $driver->driver_hpno,
                    'driver_email' => $driver->driver_email,
                    'driver_jpjdrivinglicenseno' => $driver->driver_jpjdrivinglicenseno,
                    'driver_jpjdrivingclass' => $driver->driver_jpjdrivingclass,
                    'driver_jpjlicenseexpirydate' => $driver->driver_jpjlicenseexpirydate,
                    'driver_drivinglicenseno' => $driver->driver_drivinglicenseno,
                    'driver_drivingclass' => $driver->driver_drivingclass,
                    'driver_licenseexpirydate' => $driver->driver_licenseexpirydate,
                    'driver_blacklistedremark' => $driver->driver_blacklistedremark,
                    'driver_permit_typeid' => $driver->driver_permit_typeid,
                    'driver_activity_statusid' => $driver->driver_activity_statusid,
                    'driver_application_date' => $driver->driver_application_date,
                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'driver_info' => $driverinfo,
                ];
            }

            if ($driverphoto) {
                $data_driverphoto = [
                    'driver_photo' => $driverphoto,
                ];
            }

            $data = array_merge($data_permit, $data_evdppermit, $data_driver, $data_timeline, $data_files, $data_driverphoto, $data_extra);
            return $data;

        }
    }

    public function avp_detail($id)
    {

        $id = fixzy_decoder($id);

        $row            = $this->permitall_model->get_read($id);
        $avppermit      = $this->avppermit_model->get_read_by_permitid($row->permit_id);
        $vehicle        = $this->vehicle_model->get_read($avppermit->avppermit_vehicle_id);
        $timeline       = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files          = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "avp_requireddoc");
        $insurancefiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "avp_insurancedoc");
        $inspectorfiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "avp_inspectordoc");
        $inspection     = $this->avpchecklist_model->get_all_by_permitid($row->permit_id);
        $selfchecked    = $this->avpchecklist_model->get_selfchecked_by_permitid($row->permit_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_vehicle($vehicle->vehicle_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_avp_list($vehicle->vehicle_id);

        foreach ($selfchecked as $mtwid) {
            $selfchecked_ids[] = $mtwid->avpchecklist_mtwchecklist_id;
        }

        $mtwchecked_y = $this->avpchecklist_model->get_mtwchecked_y_by_permitid($row->permit_id);
        $mtwchecked_n = $this->avpchecklist_model->get_mtwchecked_n_by_permitid($row->permit_id);
        $mtwchecked_na = $this->avpchecklist_model->get_mtwchecked_na_by_permitid($row->permit_id);
        if ($mtwchecked_y) {
            foreach ($mtwchecked_y as $mtwid_y) {
                $mtwchecked_y_ids[] = $mtwid_y->avpchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_y_ids = [];
        }

         if ($mtwchecked_n) {
            foreach ($mtwchecked_n as $mtwid_n) {
                $mtwchecked_n_ids[] = $mtwid_n->avpchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_n_ids = [];
        }

         if ($mtwchecked_na) {
            foreach ($mtwchecked_na as $mtwid_na) {
                $mtwchecked_na_ids[] = $mtwid_na->avpchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_na_ids = [];
        }

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                'permit_status' => $row->permit_status_desc_permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,

            ];

            if ($avppermit) {
                $data_avppermit = [
                    'avppermit_permit_id' => $avppermit->avppermit_permit_id,
                    'avppermit_vehicle_id' => $avppermit->avppermit_vehicle_id,
                    'avppermit_required_briefing' => $avppermit->avppermit_required_briefing,
                    'avppermit_attendbriefing' => $avppermit->avppermit_attendbriefing,
                    'avppermit_approved_to_inspect' => $avppermit->avppermit_approved_to_inspect,
                    'avppermit_ownchecked_by' => $avppermit->avppermit_ownchecked_by,
                    'avppermit_ownchecked_date' => $avppermit->avppermit_ownchecked_date,
                    'avppermit_ownverified_by' => $avppermit->avppermit_ownverified_by,
                    'avppermit_ownverified_date' => $avppermit->avppermit_ownverified_date,
                    'avppermit_result' => $avppermit->avppermit_result,
                    'avppermit_result_inspector_id' => (!empty($avppermit->inspector_name)?$avppermit->inspector_name:"-"),
                    'avppermit_inspection_date' => (!empty($avppermit->avppermit_inspection_date)?$avppermit->avppermit_inspection_date:"-"),
                    'avppermit_retest_result' => $avppermit->avppermit_retest_result,
                    'avppermit_retest_result_inspector_id' => (!empty($avppermit->avppermit_retest_result_inspector_id)?$avppermit->avppermit_retest_result_inspector_id:"-"),
                    'avppermit_retest_inspection_date' => (!empty($avppermit->avppermit_retest_inspection_date)?$avppermit->avppermit_retest_inspection_date:"-"),
                    'avppermit_managerverified_id' => $avppermit->avppermit_managerverified_id,
                'engineer_name' => $avppermit->engineer_name,
                    'avppermit_managerverified_date' => $avppermit->avppermit_managerverified_date,
/*        'avppermit_recent_avp_serialno' => $avppermit->avppermit_recent_avp_serialno,*/
/*        'avppermit_recent_avp_expirydate' => $avppermit->avppermit_recent_avp_expirydate,*/
                    'avppermit_recent_avp_typecolor' => $avppermit->avppermit_recent_avp_typecolor,
                    'avppermit_completed_docs' => $avppermit->avppermit_completed_docs,
                    'avppermit_inspectionscheduled' => $avppermit->avppermit_inspectionscheduled,
                    'avppermit_inspectionapproval' => $avppermit->avppermit_inspectionapproval,
                    'avppermit_policyno' => $avppermit->avppermit_policyno,
                    'avppermit_policyexpirydate' => $avppermit->avppermit_policyexpirydate,
                    'avppermit_fireext_serialno' => $avppermit->avppermit_fireext_serialno,
                    'avppermit_fireext_expirydate' => $avppermit->avppermit_fireext_expirydate,
                    'avppermit_tyre_manufacturingdate' => $avppermit->avppermit_tyre_manufacturingdate,
                    'avppermit_smokecondition' => $avppermit->avppermit_smokecondition,
                    'avppermit_fireext_serialno_checked' => $avppermit->avppermit_fireext_serialno_checked,
                    'avppermit_fireext_expirydate_checked' => $avppermit->avppermit_fireext_expirydate_checked,
                    'avppermit_tyre_manufacturingdate_checked' => $avppermit->avppermit_tyre_manufacturingdate_checked,
                    'avppermit_smokecondition_checked' => $avppermit->avppermit_smokecondition_checked,
                'avppermit_fireext_serialno_mtw' => (!empty($avppermit->avppermit_fireext_serialno_mtw)?$avppermit->avppermit_fireext_serialno_mtw:"-"),
                'avppermit_fireext_expirydate_mtw' => (!empty($avppermit->avppermit_fireext_expirydate_mtw)?$avppermit->avppermit_fireext_expirydate_mtw:"-"),
                'avppermit_tyre_manufacturingdate_mtw' => (!empty($avppermit->avppermit_tyre_manufacturingdate_mtw)?$avppermit->avppermit_tyre_manufacturingdate_mtw:"-"),
                'avppermit_smokecondition_mtw' => (!empty($avppermit->avppermit_smokecondition_mtw)?$avppermit->avppermit_smokecondition_mtw:"-"),
                    'avppermit_inspection_location' => $avppermit->avppermit_inspection_location,
                ];
            }

            if ($vehicle) {
                $data_vehicle = [
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_company_id' => $vehicle->company_name_vehicle_company_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'vehicle_insurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $vehicle->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
/*                        'vehicle_parkingarea_id' => $vehicle->parkingarea_name_vehicle_parkingarea_id,*/
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_activity_statusid' => $vehicle->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $vehicle->vehicle_application_date,
                    'vehicle_blacklistedremark' => (!empty($vehicle->vehicle_blacklistedremark)?$vehicle->vehicle_blacklistedremark:"-"),

                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'insurance_files' => $insurancefiles,
                    'inspector_files' => $inspectorfiles,
                ];
            }

            if ($inspection) {
                $data_inspection = [
                    /*'avpchecklist_data' => $inspection,*/
                    'mtwchecklist_data' => $this->mtwchecklist_model->get_all('avp'),
                    'avp_selfchecked_selected' => $selfchecked_ids,
                'avp_mtwchecked_y_selected' => $mtwchecked_y_ids,
                'avp_mtwchecked_n_selected' => $mtwchecked_n_ids,
                'avp_mtwchecked_na_selected' => $mtwchecked_na_ids,
                ];
            }

            $data = array_merge($data_permit, $data_avppermit, $data_vehicle, $data_timeline, $data_files, $data_inspection, $data_extra);

            return $data;

        }

    }

    public function evp_detail($id)
    {

        $id = fixzy_decoder($id);

        $row            = $this->permitall_model->get_read($id);
        $evppermit      = $this->evppermit_model->get_read_by_permitid($row->permit_id);
        $vehicle        = $this->vehicle_model->get_read($evppermit->evppermit_vehicle_id);
        $timeline       = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files          = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "evp_requireddoc");
        $insurancefiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "evp_insurancedoc");
        $inspectorfiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "evp_inspectordoc");
        $inspection     = $this->evpchecklist_model->get_all_by_permitid($row->permit_id);
        $selfchecked    = $this->evpchecklist_model->get_selfchecked_by_permitid($row->permit_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_vehicle($vehicle->vehicle_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_evp_list($vehicle->vehicle_id);

        foreach ($selfchecked as $mtwid) {
            $selfchecked_ids[] = $mtwid->evpchecklist_mtwchecklist_id;
        }

        $mtwchecked_y = $this->evpchecklist_model->get_mtwchecked_y_by_permitid($row->permit_id);
        $mtwchecked_n = $this->evpchecklist_model->get_mtwchecked_n_by_permitid($row->permit_id);
        $mtwchecked_na = $this->evpchecklist_model->get_mtwchecked_na_by_permitid($row->permit_id);
        if ($mtwchecked_y) {
            foreach ($mtwchecked_y as $mtwid_y) {
                $mtwchecked_y_ids[] = $mtwid_y->evpchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_y_ids = [];
        }

         if ($mtwchecked_n) {
            foreach ($mtwchecked_n as $mtwid_n) {
                $mtwchecked_n_ids[] = $mtwid_n->evpchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_n_ids = [];
        }

         if ($mtwchecked_na) {
            foreach ($mtwchecked_na as $mtwid_na) {
                $mtwchecked_na_ids[] = $mtwid_na->evpchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_na_ids = [];
        }

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                'permit_status' => $row->permit_status_desc_permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,

            ];

            if ($evppermit) {
                $data_evppermit = [
                    'evppermit_permit_id' => $evppermit->evppermit_permit_id,
                    'evppermit_vehicle_id' => $evppermit->evppermit_vehicle_id,
                    'evppermit_required_briefing' => $evppermit->evppermit_required_briefing,
                    'evppermit_attendbriefing' => $evppermit->evppermit_attendbriefing,
                    'evppermit_approved_to_inspect' => $evppermit->evppermit_approved_to_inspect,
                    'evppermit_ownerauthorization' => $evppermit->evppermit_ownerauthorization,
                    'evppermit_ownerauthorization_date' => $evppermit->evppermit_ownerauthorization_date,
                    'evppermit_result' => $evppermit->evppermit_result,
                    'evppermit_result_inspector_id' => $evppermit->inspector_name,
                    'evppermit_inspection_date' => $evppermit->evppermit_inspection_date,
                    'evppermit_managerverified_id' => $evppermit->evppermit_managerverified_id,
                'engineer_name' => $evppermit->engineer_name,
                    'evppermit_managerverified_date' => $evppermit->evppermit_managerverified_date,
                    'evppermit_inspectionapproval' => $evppermit->evppermit_inspectionapproval,
                    'evppermit_inspectionapproval_verification' => $evppermit->evppermit_inspectionapproval_verification,
                    'evppermit_inspection_remark' => $evppermit->evppermit_inspection_remark,
                    'evppermit_inspection_verification_remark' => $evppermit->evppermit_inspection_verification_remark,
                    'evppermit_completed_docs' => $evppermit->evppermit_completed_docs,
                    'evppermit_policyno' => $evppermit->evppermit_policyno,
                    'evppermit_policyexpirydate' => $evppermit->evppermit_policyexpirydate,
                    'evppermit_inspection_location'  => $evppermit->evppermit_inspection_location,
                ];
            }

            if ($vehicle) {
                $data_vehicle = [
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_company_id' => $vehicle->company_name_vehicle_company_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'vehicle_insurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $vehicle->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_activity_statusid' => $vehicle->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $vehicle->vehicle_application_date,
                    'vehicle_blacklistedremark' => (!empty($vehicle->vehicle_blacklistedremark)?$vehicle->vehicle_blacklistedremark:"-"),

                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

			if($files == false)
                $files = [];
            if($insurancefiles == false)
                $insurancefiles = [];
            if($inspectorfiles == false)
                $inspectorfiles = [];            
            //if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'insurance_files' => $insurancefiles,
                    'inspector_files' => $inspectorfiles,
                ];
            //}

            if ($inspection) {
                $data_inspection = [
                    /*'evpchecklist_data' => $inspection*/
                    'mtwchecklist_data' => $this->mtwchecklist_model->get_all('evp'),
                    'evp_selfchecked_selected' => $selfchecked_ids,
                'evp_mtwchecked_y_selected' => $mtwchecked_y_ids,
                'evp_mtwchecked_n_selected' => $mtwchecked_n_ids,
                'evp_mtwchecked_na_selected' => $mtwchecked_na_ids,
                ];
            }

            $data = array_merge($data_permit, $data_evppermit, $data_vehicle, $data_timeline, $data_files, $data_inspection, $data_extra);

            return $data;
        }

    }

    public function pbb_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $pbbpermit   = $this->pbbpermit_model->get_read_by_permitid($row->permit_id);
        $driver      = $this->driver_model->get_read($pbbpermit->pbbpermit_driver_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "pbb_requireddoc");
        $driverphoto = $this->uploadfiles_model->get_photo_by_driverid($driver->driver_id);
        $driverinfo     = $this->uploadfiles_model->get_driverinfo_by_driverid($driver->driver_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_driver($driver->driver_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_pbb_list($driver->driver_id);

        $data_pbbpermit   = [];
        $data_driver      = [];
        $data_timeline    = [];
        $data_files       = [];
        $data_driverphoto = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($pbbpermit) {
                $data_pbbpermit = [
                    'pbbpermit_permit_id' => $pbbpermit->pbbpermit_permit_id,
                    'pbbpermit_driver_id' => $pbbpermit->pbbpermit_driver_id,

                    'pbbpermit_driveracknowledgement' => $pbbpermit->pbbpermit_driveracknowledgement,
                    'pbbpermit_driveracknowledgement_date' => $pbbpermit->pbbpermit_driveracknowledgement_date,
                    'pbbpermit_certbyemployer' => $pbbpermit->pbbpermit_certbyemployer,
                    'pbbpermit_certbyemployer_date' => $pbbpermit->pbbpermit_certbyemployer_date,
                    'pbbpermit_certbytrainer' => $pbbpermit->pbbpermit_certbytrainer,
                    'pbbpermit_certbytrainer_date' => $pbbpermit->pbbpermit_certbytrainer_date,
                    'pbbpermit_course_date' => $pbbpermit->pbbpermit_course_date,
                    'pbbpermit_course_session' => $pbbpermit->pbbpermit_course_session,
                    'pbbpermit_pbbbriefingscheduled' => $pbbpermit->pbbpermit_pbbbriefingscheduled,
                    'pbbpermit_pbbbriefingapproval' => $pbbpermit->pbbpermit_pbbbriefingapproval,
                    'pbbpermit_attendpbbbriefing' => $pbbpermit->pbbpermit_attendpbbbriefing,
                    'pbbpermit_completed_docs' => $pbbpermit->pbbpermit_completed_docs,
                    'pbbpermit_approvedby_airside' => $pbbpermit->pbbpermit_approvedby_airside,
                    'pbbpermit_created_at' => $pbbpermit->pbbpermit_created_at,
                    'pbbpermit_updated_at' => $pbbpermit->pbbpermit_updated_at,
                    'pbbpermit_deleted_at' => $pbbpermit->pbbpermit_deleted_at,
                    'pbbpermit_lastchanged_by' => $pbbpermit->pbbpermit_lastchanged_by,
                    'pbbpermit_course_location' => $pbbpermit->pbbpermit_course_location,
                ];
            }

            if ($driver) {
                $data_driver = [
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
'driver_displayname' => $driver->driver_displayname,
                    'driver_dob' => $driver->driver_dob,
                    'driver_ic' => $driver->driver_ic,
                    'driver_designation' => $driver->driver_designation,
                    'driver_department' => $driver->driver_department,
                    'driver_nationality_country_id' => $driver->ref_country_name_driver_nationality_country_id,
                    'driver_address' => $driver->driver_address,
                    'driver_officeno' => $driver->driver_officeno,
                    'driver_hpno' => $driver->driver_hpno,
                    'driver_email' => $driver->driver_email,
                    'driver_jpjdrivinglicenseno' => $driver->driver_jpjdrivinglicenseno,
                    'driver_jpjdrivingclass' => $driver->driver_jpjdrivingclass,
                    'driver_jpjlicenseexpirydate' => $driver->driver_jpjlicenseexpirydate,
                    'driver_drivinglicenseno' => $driver->driver_drivinglicenseno,
                    'driver_drivingclass' => $driver->driver_drivingclass,
                    'driver_licenseexpirydate' => $driver->driver_licenseexpirydate,
                    'driver_blacklistedremark' => $driver->driver_blacklistedremark,
                    'driver_permit_typeid' => $driver->driver_permit_typeid,
                    'driver_activity_statusid' => $driver->driver_activity_statusid,
                    'driver_application_date' => $driver->driver_application_date,
                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'driver_info' => $driverinfo,
                ];
            }

            if ($driverphoto) {
                $data_driverphoto = [
                    'driver_photo' => $driverphoto,
                ];
            }

            $data = array_merge($data_permit, $data_pbbpermit, $data_driver, $data_timeline, $data_files, $data_driverphoto, $data_extra);
            return $data;

        }
    }

    public function pca_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $pcapermit   = $this->pcapermit_model->get_read_by_permitid($row->permit_id);
        $driver      = $this->driver_model->get_read($pcapermit->pcapermit_driver_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "pca_requireddoc");
        $driverphoto = $this->uploadfiles_model->get_photo_by_driverid($driver->driver_id);
        $driverinfo     = $this->uploadfiles_model->get_driverinfo_by_driverid($driver->driver_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_driver($driver->driver_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_pca_list($driver->driver_id);

        $data_pcapermit   = [];
        $data_driver      = [];
        $data_timeline    = [];
        $data_files       = [];
        $data_driverphoto = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($pcapermit) {
                $data_pcapermit = [
                    'pcapermit_permit_id' => $pcapermit->pcapermit_permit_id,
                    'pcapermit_driver_id' => $pcapermit->pcapermit_driver_id,

                    'pcapermit_driveracknowledgement' => $pcapermit->pcapermit_driveracknowledgement,
                    'pcapermit_driveracknowledgement_date' => $pcapermit->pcapermit_driveracknowledgement_date,
                    'pcapermit_certbyemployer' => $pcapermit->pcapermit_certbyemployer,
                    'pcapermit_certbyemployer_date' => $pcapermit->pcapermit_certbyemployer_date,
                    'pcapermit_certbytrainer' => $pcapermit->pcapermit_certbytrainer,
                    'pcapermit_certbytrainer_date' => $pcapermit->pcapermit_certbytrainer_date,
                    'pcapermit_course_date' => $pcapermit->pcapermit_course_date,
                    'pcapermit_course_session' => $pcapermit->pcapermit_course_session,
                    'pcapermit_pcabriefingscheduled' => $pcapermit->pcapermit_pcabriefingscheduled,
                    'pcapermit_pcabriefingapproval' => $pcapermit->pcapermit_pcabriefingapproval,
                    'pcapermit_attendpcabriefing' => $pcapermit->pcapermit_attendpcabriefing,
                    'pcapermit_completed_docs' => $pcapermit->pcapermit_completed_docs,
                    'pcapermit_approvedby_airside' => $pcapermit->pcapermit_approvedby_airside,
                    'pcapermit_created_at' => $pcapermit->pcapermit_created_at,
                    'pcapermit_updated_at' => $pcapermit->pcapermit_updated_at,
                    'pcapermit_deleted_at' => $pcapermit->pcapermit_deleted_at,
                    'pcapermit_lastchanged_by' => $pcapermit->pcapermit_lastchanged_by,
                    'pcapermit_course_location' => $pcapermit->pcapermit_course_location,
                ];
            }

            if ($driver) {
                $data_driver = [
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
'driver_displayname' => $driver->driver_displayname,
                    'driver_dob' => $driver->driver_dob,
                    'driver_ic' => $driver->driver_ic,
                    'driver_designation' => $driver->driver_designation,
                    'driver_department' => $driver->driver_department,
                    'driver_nationality_country_id' => $driver->ref_country_name_driver_nationality_country_id,
                    'driver_address' => $driver->driver_address,
                    'driver_officeno' => $driver->driver_officeno,
                    'driver_hpno' => $driver->driver_hpno,
                    'driver_email' => $driver->driver_email,
                    'driver_jpjdrivinglicenseno' => $driver->driver_jpjdrivinglicenseno,
                    'driver_jpjdrivingclass' => $driver->driver_jpjdrivingclass,
                    'driver_jpjlicenseexpirydate' => $driver->driver_jpjlicenseexpirydate,
                    'driver_drivinglicenseno' => $driver->driver_drivinglicenseno,
                    'driver_drivingclass' => $driver->driver_drivingclass,
                    'driver_licenseexpirydate' => $driver->driver_licenseexpirydate,
                    'driver_blacklistedremark' => $driver->driver_blacklistedremark,
                    'driver_permit_typeid' => $driver->driver_permit_typeid,
                    'driver_activity_statusid' => $driver->driver_activity_statusid,
                    'driver_application_date' => $driver->driver_application_date,
                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'driver_info' => $driverinfo,
                ];
            }

            if ($driverphoto) {
                $data_driverphoto = [
                    'driver_photo' => $driverphoto,
                ];
            }

            $data = array_merge($data_permit, $data_pcapermit, $data_driver, $data_timeline, $data_files, $data_driverphoto, $data_extra);
            return $data;

        }
    }

    public function gpu_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $gpupermit   = $this->gpupermit_model->get_read_by_permitid($row->permit_id);
        $driver      = $this->driver_model->get_read($gpupermit->gpupermit_driver_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "gpu_requireddoc");
        $driverphoto = $this->uploadfiles_model->get_photo_by_driverid($driver->driver_id);
        $driverinfo     = $this->uploadfiles_model->get_driverinfo_by_driverid($driver->driver_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_driver($driver->driver_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_gpu_list($driver->driver_id);

        $data_gpupermit   = [];
        $data_driver      = [];
        $data_timeline    = [];
        $data_files       = [];
        $data_driverphoto = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($gpupermit) {
                $data_gpupermit = [
                    'gpupermit_permit_id' => $gpupermit->gpupermit_permit_id,
                    'gpupermit_driver_id' => $gpupermit->gpupermit_driver_id,

                    'gpupermit_driveracknowledgement' => $gpupermit->gpupermit_driveracknowledgement,
                    'gpupermit_driveracknowledgement_date' => $gpupermit->gpupermit_driveracknowledgement_date,
                    'gpupermit_certbyemployer' => $gpupermit->gpupermit_certbyemployer,
                    'gpupermit_certbyemployer_date' => $gpupermit->gpupermit_certbyemployer_date,
                    'gpupermit_certbytrainer' => $gpupermit->gpupermit_certbytrainer,
                    'gpupermit_certbytrainer_date' => $gpupermit->gpupermit_certbytrainer_date,
                    'gpupermit_course_date' => $gpupermit->gpupermit_course_date,
                    'gpupermit_course_session' => $gpupermit->gpupermit_course_session,
                    'gpupermit_gpubriefingscheduled' => $gpupermit->gpupermit_gpubriefingscheduled,
                    'gpupermit_gpubriefingapproval' => $gpupermit->gpupermit_gpubriefingapproval,
                    'gpupermit_attendgpubriefing' => $gpupermit->gpupermit_attendgpubriefing,
                    'gpupermit_completed_docs' => $gpupermit->gpupermit_completed_docs,
                    'gpupermit_approvedby_airside' => $gpupermit->gpupermit_approvedby_airside,
                    'gpupermit_created_at' => $gpupermit->gpupermit_created_at,
                    'gpupermit_updated_at' => $gpupermit->gpupermit_updated_at,
                    'gpupermit_deleted_at' => $gpupermit->gpupermit_deleted_at,
                    'gpupermit_lastchanged_by' => $gpupermit->gpupermit_lastchanged_by,
                    'gpupermit_course_location' => $gpupermit->gpupermit_course_location,
                ];
            }

            if ($driver) {
                $data_driver = [
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
'driver_displayname' => $driver->driver_displayname,
                    'driver_dob' => $driver->driver_dob,
                    'driver_ic' => $driver->driver_ic,
                    'driver_designation' => $driver->driver_designation,
                    'driver_department' => $driver->driver_department,
                    'driver_nationality_country_id' => $driver->ref_country_name_driver_nationality_country_id,
                    'driver_address' => $driver->driver_address,
                    'driver_officeno' => $driver->driver_officeno,
                    'driver_hpno' => $driver->driver_hpno,
                    'driver_email' => $driver->driver_email,
                    'driver_jpjdrivinglicenseno' => $driver->driver_jpjdrivinglicenseno,
                    'driver_jpjdrivingclass' => $driver->driver_jpjdrivingclass,
                    'driver_jpjlicenseexpirydate' => $driver->driver_jpjlicenseexpirydate,
                    'driver_drivinglicenseno' => $driver->driver_drivinglicenseno,
                    'driver_drivingclass' => $driver->driver_drivingclass,
                    'driver_licenseexpirydate' => $driver->driver_licenseexpirydate,
                    'driver_blacklistedremark' => $driver->driver_blacklistedremark,
                    'driver_permit_typeid' => $driver->driver_permit_typeid,
                    'driver_activity_statusid' => $driver->driver_activity_statusid,
                    'driver_application_date' => $driver->driver_application_date,
                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'driver_info' => $driverinfo,
                ];
            }

            if ($driverphoto) {
                $data_driverphoto = [
                    'driver_photo' => $driverphoto,
                ];
            }

            $data = array_merge($data_permit, $data_gpupermit, $data_driver, $data_timeline, $data_files, $data_driverphoto, $data_extra);
            return $data;

        }
    }

    public function cs_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $cspermit    = $this->cspermit_model->get_read_by_permitid($row->permit_id);
        $vehicle        = $this->vehicle_model->get_read($cspermit->cspermit_vehicle_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "cs_requireddoc");
        $insurancefiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "cs_insurancedoc");
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_vehicle($vehicle->vehicle_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_cs_list($vehicle->vehicle_id);
        /*$driverphoto = $this->uploadfiles_model->get_photo_by_driverid($driver->driver_id); */

        $data_cspermit    = [];
        $data_vehicle      = [];
        $data_timeline    = [];
        $data_files       = [];


        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($cspermit) {
                $data_cspermit = [
                    'cspermit_permit_id' => $cspermit->cspermit_permit_id,
                    'cspermit_driver_id' => $cspermit->cspermit_driver_id,

                    'cspermit_driveracknowledgement' => $cspermit->cspermit_driveracknowledgement,
                    'cspermit_driveracknowledgement_date' => $cspermit->cspermit_driveracknowledgement_date,
                    'cspermit_certbyemployer' => $cspermit->cspermit_certbyemployer,
                    'cspermit_certbyemployer_date' => $cspermit->cspermit_certbyemployer_date,
                    'cspermit_certbytrainer' => $cspermit->cspermit_certbytrainer,
                    'cspermit_certbytrainer_date' => $cspermit->cspermit_certbytrainer_date,
                    'cspermit_course_date' => $cspermit->cspermit_course_date,
                    'cspermit_csbriefingscheduled' => $cspermit->cspermit_csbriefingscheduled,
                    'cspermit_csbriefingapproval' => $cspermit->cspermit_csbriefingapproval,
                    'cspermit_attendcsbriefing' => $cspermit->cspermit_attendcsbriefing,
                    'cspermit_completed_docs' => $cspermit->cspermit_completed_docs,
                    'cspermit_approvedby_airside' => $cspermit->cspermit_approvedby_airside,
                    'cspermit_created_at' => $cspermit->cspermit_created_at,
                    'cspermit_updated_at' => $cspermit->cspermit_updated_at,
                    'cspermit_deleted_at' => $cspermit->cspermit_deleted_at,
                    'cspermit_lastchanged_by' => $cspermit->cspermit_lastchanged_by,

                    'cspermit_policyno' => $cspermit->cspermit_policyno,
                    'cspermit_policyexpirydate' => $cspermit->cspermit_policyexpirydate,
                    'cspermit_entrypurpose' => $cspermit->cspermit_entrypurpose,
                    'cspermit_entrypost' => $cspermit->cspermit_entrypost,
                    'cspermit_exitpost' => $cspermit->cspermit_exitpost,
                    'cspermit_steerman_name' => $cspermit->cspermit_steerman_name,
                    'cspermit_steerman_icno' => $cspermit->cspermit_steerman_icno,
                    'cspermit_steerman_adpno' => $cspermit->cspermit_steerman_adpno,
                    'cspermit_needescort' => $cspermit->cspermit_needescort,
                    'cspermit_escortname' => $cspermit->cspermit_escortname,
                    'cspermit_location' => $cspermit->cspermit_location,
                ];
            }

            if ($vehicle) {
                $data_vehicle = [
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_company_id' => $vehicle->company_name_vehicle_company_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'vehicle_insurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $vehicle->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_activity_statusid' => $vehicle->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $vehicle->vehicle_application_date,
                    'vehicle_blacklistedremark' => (!empty($vehicle->vehicle_blacklistedremark)?$vehicle->vehicle_blacklistedremark:"-"),

                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'insurance_files' => $insurancefiles,
                ];
            }


            $data = array_merge($data_permit, $data_cspermit, $data_vehicle, $data_timeline, $data_files, $data_extra);
            return $data;

        }
    }

    public function vdgs_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $vdgspermit  = $this->vdgspermit_model->get_read_by_permitid($row->permit_id);
        $driver      = $this->driver_model->get_read($vdgspermit->vdgspermit_driver_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "vdgs_requireddoc");
        $driverphoto = $this->uploadfiles_model->get_photo_by_driverid($driver->driver_id);
        $driverinfo     = $this->uploadfiles_model->get_driverinfo_by_driverid($driver->driver_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_driver($driver->driver_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_vdgs_list($driver->driver_id);

        $data_vdgspermit  = [];
        $data_driver      = [];
        $data_timeline    = [];
        $data_files       = [];
        $data_driverphoto = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($vdgspermit) {
                $data_vdgspermit = [
                    'vdgspermit_permit_id' => $vdgspermit->vdgspermit_permit_id,
                    'vdgspermit_driver_id' => $vdgspermit->vdgspermit_driver_id,

                    'vdgspermit_driveracknowledgement' => $vdgspermit->vdgspermit_driveracknowledgement,
                    'vdgspermit_driveracknowledgement_date' => $vdgspermit->vdgspermit_driveracknowledgement_date,
                    'vdgspermit_certbyemployer' => $vdgspermit->vdgspermit_certbyemployer,
                    'vdgspermit_certbyemployer_date' => $vdgspermit->vdgspermit_certbyemployer_date,
                    'vdgspermit_certbytrainer' => $vdgspermit->vdgspermit_certbytrainer,
                    'vdgspermit_certbytrainer_date' => $vdgspermit->vdgspermit_certbytrainer_date,
                    'vdgspermit_course_date' => $vdgspermit->vdgspermit_course_date,
                    'vdgspermit_course_session' => $vdgspermit->vdgspermit_course_session,
                    'vdgspermit_vgdsbriefingscheduled' => $vdgspermit->vdgspermit_vgdsbriefingscheduled,
                    'vdgspermit_vgdsbriefingapproval' => $vdgspermit->vdgspermit_vgdsbriefingapproval,
                    'vdgspermit_attendvgdsbriefing' => $vdgspermit->vdgspermit_attendvgdsbriefing,
                    'vdgspermit_completed_docs' => $vdgspermit->vdgspermit_completed_docs,
                    'vdgspermit_approvedby_airside' => $vdgspermit->vdgspermit_approvedby_airside,
                    'vdgspermit_created_at' => $vdgspermit->vdgspermit_created_at,
                    'vdgspermit_updated_at' => $vdgspermit->vdgspermit_updated_at,
                    'vdgspermit_deleted_at' => $vdgspermit->vdgspermit_deleted_at,
                    'vdgspermit_lastchanged_by' => $vdgspermit->vdgspermit_lastchanged_by,
                    'vdgspermit_course_location' => $vdgspermit->vdgspermit_course_location,
                ];
            }

            if ($driver) {
                $data_driver = [
                    'driver_id' => $driver->driver_id,
                    'driver_name' => $driver->driver_name,
'driver_displayname' => $driver->driver_displayname,
                    'driver_dob' => $driver->driver_dob,
                    'driver_ic' => $driver->driver_ic,
                    'driver_designation' => $driver->driver_designation,
                    'driver_department' => $driver->driver_department,
                    'driver_nationality_country_id' => $driver->ref_country_name_driver_nationality_country_id,
                    'driver_address' => $driver->driver_address,
                    'driver_officeno' => $driver->driver_officeno,
                    'driver_hpno' => $driver->driver_hpno,
                    'driver_email' => $driver->driver_email,
                    'driver_jpjdrivinglicenseno' => $driver->driver_jpjdrivinglicenseno,
                    'driver_jpjdrivingclass' => $driver->driver_jpjdrivingclass,
                    'driver_jpjlicenseexpirydate' => $driver->driver_jpjlicenseexpirydate,
                    'driver_drivinglicenseno' => $driver->driver_drivinglicenseno,
                    'driver_drivingclass' => $driver->driver_drivingclass,
                    'driver_licenseexpirydate' => $driver->driver_licenseexpirydate,
                    'driver_blacklistedremark' => $driver->driver_blacklistedremark,
                    'driver_permit_typeid' => $driver->driver_permit_typeid,
                    'driver_activity_statusid' => $driver->driver_activity_statusid,
                    'driver_application_date' => $driver->driver_application_date,
                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'driver_info' => $driverinfo,
                ];
            }

            if ($driverphoto) {
                $data_driverphoto = [
                    'driver_photo' => $driverphoto,
                ];
            }

            $data = array_merge($data_permit, $data_vdgspermit, $data_driver, $data_timeline, $data_files, $data_driverphoto, $data_extra);
            return $data;

        }
    }

    public function sh_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $shpermit    = $this->shpermit_model->get_read_by_permitid($row->permit_id);
        $vehicle        = $this->vehicle_model->get_read($shpermit->shpermit_vehicle_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "sh_requireddoc");
        $insurancefiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "sh_insurancedoc");
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_vehicle($vehicle->vehicle_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_sh_list($vehicle->vehicle_id);

        $data_shpermit    = [];
        $data_vehicle      = [];
        $data_timeline    = [];
        $data_files       = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($shpermit) {
                $data_shpermit = [
                    'shpermit_permit_id' => $shpermit->shpermit_permit_id,
                    'shpermit_driver_id' => $shpermit->shpermit_driver_id,

                    'shpermit_driveracknowledgement' => $shpermit->shpermit_driveracknowledgement,
                    'shpermit_driveracknowledgement_date' => $shpermit->shpermit_driveracknowledgement_date,
                    'shpermit_certbyemployer' => $shpermit->shpermit_certbyemployer,
                    'shpermit_certbyemployer_date' => $shpermit->shpermit_certbyemployer_date,
                    'shpermit_certbytrainer' => $shpermit->shpermit_certbytrainer,
                    'shpermit_certbytrainer_date' => $shpermit->shpermit_certbytrainer_date,
                    'shpermit_course_date' => $shpermit->shpermit_course_date,
                    'shpermit_shbriefingscheduled' => $shpermit->shpermit_shbriefingscheduled,
                    'shpermit_shbriefingapproval' => $shpermit->shpermit_shbriefingapproval,
                    'shpermit_attendshbriefing' => $shpermit->shpermit_attendshbriefing,
                    'shpermit_completed_docs' => $shpermit->shpermit_completed_docs,
                    'shpermit_approvedby_airside' => $shpermit->shpermit_approvedby_airside,
                    'shpermit_created_at' => $shpermit->shpermit_created_at,
                    'shpermit_updated_at' => $shpermit->shpermit_updated_at,
                    'shpermit_deleted_at' => $shpermit->shpermit_deleted_at,
                    'shpermit_lastchanged_by' => $shpermit->shpermit_lastchanged_by,

                    'shpermit_policyno' => $shpermit->shpermit_policyno,
                    'shpermit_policyexpirydate' => $shpermit->shpermit_policyexpirydate,
                    'shpermit_entrypurpose' => $shpermit->shpermit_entrypurpose,
                    'shpermit_entrypost' => $shpermit->shpermit_entrypost,
                    'shpermit_exitpost' => $shpermit->shpermit_exitpost,
                    'shpermit_steerman_name' => $shpermit->shpermit_steerman_name,
                    'shpermit_steerman_icno' => $shpermit->shpermit_steerman_icno,
                    'shpermit_steerman_adpno' => $shpermit->shpermit_steerman_adpno,
                    'shpermit_needescort' => $shpermit->shpermit_needescort,
                    'shpermit_escortname' => $shpermit->shpermit_escortname,
                    'shpermit_location' => $shpermit->shpermit_location,
                ];
            }

            if ($vehicle) {
                $data_vehicle = [
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_company_id' => $vehicle->company_name_vehicle_company_id,
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'vehicle_insurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $vehicle->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_activity_statusid' => $vehicle->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $vehicle->vehicle_application_date,
                    'vehicle_blacklistedremark' => (!empty($vehicle->vehicle_blacklistedremark)?$vehicle->vehicle_blacklistedremark:"-"),

                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'insurance_files' => $insurancefiles,
                ];
            }


            $data = array_merge($data_permit, $data_shpermit, $data_vehicle, $data_timeline, $data_files, $data_extra);
            return $data;

        }
    }

    public function wip_detail($id)
    {

        $id = fixzy_decoder($id);

        $row            = $this->permitall_model->get_read($id);
        $wippermit      = $this->wippermit_model->get_read_by_permitid($row->permit_id);
        $vehicle        = $this->vehicle_model->get_read($wippermit->wippermit_vehicle_id);
        $timeline       = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $otherfile      = $this->uploadfiles_model->get_allother_by_permitid($row->permit_id);        
        $files          = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "wip_requireddoc");
        $insurancefiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "wip_insurancedoc");
        $inspectorfiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "wip_inspectordoc");
        $inspection     = $this->wipchecklist_model->get_all_by_permitid($row->permit_id);
        $selfchecked    = $this->wipchecklist_model->get_selfchecked_by_permitid($row->permit_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_vehicle($vehicle->vehicle_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_wip_list($vehicle->vehicle_id);

        foreach ($selfchecked as $mtwid) {
            $selfchecked_ids[] = $mtwid->wipchecklist_mtwchecklist_id;
        }

        $mtwchecked_y = $this->wipchecklist_model->get_mtwchecked_y_by_permitid($row->permit_id);
        $mtwchecked_n = $this->wipchecklist_model->get_mtwchecked_n_by_permitid($row->permit_id);
        $mtwchecked_na = $this->wipchecklist_model->get_mtwchecked_na_by_permitid($row->permit_id);
        if ($mtwchecked_y) {
            foreach ($mtwchecked_y as $mtwid_y) {
                $mtwchecked_y_ids[] = $mtwid_y->wipchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_y_ids = [];
        }

         if ($mtwchecked_n) {
            foreach ($mtwchecked_n as $mtwid_n) {
                $mtwchecked_n_ids[] = $mtwid_n->wipchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_n_ids = [];
        }

         if ($mtwchecked_na) {
            foreach ($mtwchecked_na as $mtwid_na) {
                $mtwchecked_na_ids[] = $mtwid_na->wipchecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_na_ids = [];
        }

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                'permit_status' => $row->permit_status_desc_permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,

            ];

            if ($wippermit) {
                $data_wippermit = [
                    'wippermit_permit_id' => $wippermit->wippermit_permit_id,
                    'wippermit_vehicle_id' => $wippermit->wippermit_vehicle_id,
                    'wippermit_required_briefing' => $wippermit->wippermit_required_briefing,
                    'wippermit_attendbriefing' => $wippermit->wippermit_attendbriefing,
                    'wippermit_approved_to_inspect' => $wippermit->wippermit_approved_to_inspect,
                    'wippermit_ownchecked_by' => $wippermit->wippermit_ownchecked_by,
                    'wippermit_ownchecked_date' => $wippermit->wippermit_ownchecked_date,
                    'wippermit_ownverified_by' => $wippermit->wippermit_ownverified_by,
                    'wippermit_ownverified_date' => $wippermit->wippermit_ownverified_date,
                    'wippermit_result' => $wippermit->wippermit_result,
                    'wippermit_result_inspector_id' => $wippermit->inspector_name,
                    'wippermit_inspection_date' => $wippermit->wippermit_inspection_date,
                    'wippermit_retest_result' => $wippermit->wippermit_retest_result,
                    'wippermit_retest_result_inspector_id' => $wippermit->wippermit_retest_result_inspector_id,
                    'wippermit_retest_inspection_date' => $wippermit->wippermit_retest_inspection_date,
                    'wippermit_managerverified_id' => $wippermit->wippermit_managerverified_id,
                    'engineer_name' => $wippermit->engineer_name,
                    'wippermit_managerverified_date' => $wippermit->wippermit_managerverified_date,
/*        'wippermit_recent_wip_serialno' => $wippermit->wippermit_recent_wip_serialno,*/
/*        'wippermit_recent_wip_expirydate' => $wippermit->wippermit_recent_wip_expirydate,*/
                    'wippermit_recent_wip_typecolor' => $wippermit->wippermit_recent_wip_typecolor,
                    'wippermit_completed_docs' => $wippermit->wippermit_completed_docs,
                    'wippermit_inspectionscheduled' => $wippermit->wippermit_inspectionscheduled,
                    'wippermit_inspectionapproval' => $wippermit->wippermit_inspectionapproval,
                    'wippermit_policyno' => $wippermit->wippermit_policyno,
                    'wippermit_policyexpirydate' => $wippermit->wippermit_policyexpirydate,
                    'wippermit_fireext_serialno' => $wippermit->wippermit_fireext_serialno,
                    'wippermit_fireext_expirydate' => $wippermit->wippermit_fireext_expirydate,
                    'wippermit_tyre_manufacturingdate' => $wippermit->wippermit_tyre_manufacturingdate,
                    'wippermit_smokecondition' => $wippermit->wippermit_smokecondition,
                    'wippermit_fireext_serialno_checked' => $wippermit->wippermit_fireext_serialno_checked,
                    'wippermit_fireext_expirydate_checked' => $wippermit->wippermit_fireext_expirydate_checked,
                    'wippermit_tyre_manufacturingdate_checked' => $wippermit->wippermit_tyre_manufacturingdate_checked,
                    'wippermit_smokecondition_checked' => $wippermit->wippermit_smokecondition_checked,
                'wippermit_inspection_location' => $wippermit->wippermit_inspection_location,

                    'wippermit_entrypurpose' => $wippermit->wippermit_entrypurpose,
                    'wippermit_entrypost' => $wippermit->wippermit_entrypost,
                    'wippermit_exitpost' => $wippermit->wippermit_exitpost,
                    'wippermit_steerman_name' => $wippermit->wippermit_steerman_name,
                    'wippermit_steerman_icno' => $wippermit->wippermit_steerman_icno,
                    'wippermit_steerman_adpno' => $wippermit->wippermit_steerman_adpno,
                    'wippermit_needescort' => $wippermit->wippermit_needescort,
                    'wippermit_escortname' => $wippermit->wippermit_escortname,
                ];
            }

            if ($vehicle) {
                $data_vehicle = [
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_company_id' => $vehicle->company_name_vehicle_company_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'vehicle_insurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $vehicle->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
/*                        'vehicle_parkingarea_id' => $vehicle->parkingarea_name_vehicle_parkingarea_id,*/
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_activity_statusid' => $vehicle->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $vehicle->vehicle_application_date,
                    'vehicle_blacklistedremark' => (!empty($vehicle->vehicle_blacklistedremark)?$vehicle->vehicle_blacklistedremark:"-"),

                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'insurance_files' => $insurancefiles,
                    'inspector_files' => $inspectorfiles,
                ];
            }

            if ($inspection) {
                $data_inspection = [
                    /*'wipchecklist_data' => $inspection,*/
                    'mtwchecklist_data' => $this->mtwchecklist_model->get_all('wip'),
                    'wip_selfchecked_selected' => $selfchecked_ids,
                'wip_mtwchecked_y_selected' => $mtwchecked_y_ids,
                'wip_mtwchecked_n_selected' => $mtwchecked_n_ids,
                'wip_mtwchecked_na_selected' => $mtwchecked_na_ids,
                ];
            }

            $data = array_merge($data_permit, $data_wippermit, $data_vehicle, $data_timeline, $data_files, $data_inspection, $data_extra);

            return $data;

        }

    }

    public function shins_detail($id)
    {

        $id = fixzy_decoder($id);

        $row            = $this->permitall_model->get_read($id);
        $shinspermit      = $this->shinspermit_model->get_read_by_permitid($row->permit_id);
        $vehicle        = $this->vehicle_model->get_read($shinspermit->shinspermit_vehicle_id);
        $timeline       = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files          = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "shins_requireddoc");
        $insurancefiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "shins_insurancedoc");
        $inspectorfiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "shins_inspectordoc");
        $inspection     = $this->shinschecklist_model->get_all_by_permitid($row->permit_id);
        $selfchecked    = $this->shinschecklist_model->get_selfchecked_by_permitid($row->permit_id);
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_vehicle($vehicle->vehicle_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_shins_list($vehicle->vehicle_id);

        foreach ($selfchecked as $mtwid) {
            $selfchecked_ids[] = $mtwid->shinschecklist_mtwchecklist_id;
        }

        $mtwchecked_y = $this->shinschecklist_model->get_mtwchecked_y_by_permitid($row->permit_id);
        $mtwchecked_n = $this->shinschecklist_model->get_mtwchecked_n_by_permitid($row->permit_id);
        $mtwchecked_na = $this->shinschecklist_model->get_mtwchecked_na_by_permitid($row->permit_id);
        if ($mtwchecked_y) {
            foreach ($mtwchecked_y as $mtwid_y) {
                $mtwchecked_y_ids[] = $mtwid_y->shinschecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_y_ids = [];
        }

         if ($mtwchecked_n) {
            foreach ($mtwchecked_n as $mtwid_n) {
                $mtwchecked_n_ids[] = $mtwid_n->shinschecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_n_ids = [];
        }

         if ($mtwchecked_na) {
            foreach ($mtwchecked_na as $mtwid_na) {
                $mtwchecked_na_ids[] = $mtwid_na->shinschecklist_mtwchecklist_id;
            }
        } else {
            $mtwchecked_na_ids = [];
        }

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                'permit_status' => $row->permit_status_desc_permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,

            ];

            if ($shinspermit) {
                $data_shinspermit = [
                    'shinspermit_permit_id' => $shinspermit->shinspermit_permit_id,
                    'shinspermit_vehicle_id' => $shinspermit->shinspermit_vehicle_id,
                    'shinspermit_required_briefing' => $shinspermit->shinspermit_required_briefing,
                    'shinspermit_attendbriefing' => $shinspermit->shinspermit_attendbriefing,
                    'shinspermit_approved_to_inspect' => $shinspermit->shinspermit_approved_to_inspect,
                    'shinspermit_ownchecked_by' => $shinspermit->shinspermit_ownchecked_by,
                    'shinspermit_ownchecked_date' => $shinspermit->shinspermit_ownchecked_date,
                    'shinspermit_ownverified_by' => $shinspermit->shinspermit_ownverified_by,
                    'shinspermit_ownverified_date' => $shinspermit->shinspermit_ownverified_date,
                    'shinspermit_result' => $shinspermit->shinspermit_result,
                    'shinspermit_result_inspector_id' => $shinspermit->inspector_name,
                    'shinspermit_inspection_date' => $shinspermit->shinspermit_inspection_date,
                    'shinspermit_retest_result' => $shinspermit->shinspermit_retest_result,
                    'shinspermit_retest_result_inspector_id' => $shinspermit->shinspermit_retest_result_inspector_id,
                    'shinspermit_retest_inspection_date' => $shinspermit->shinspermit_retest_inspection_date,
                    'shinspermit_managerverified_id' => $shinspermit->shinspermit_managerverified_id,
                    'engineer_name' => $shinspermit->engineer_name,
                    'shinspermit_managerverified_date' => $shinspermit->shinspermit_managerverified_date,
/*        'shinspermit_recent_shins_serialno' => $shinspermit->shinspermit_recent_shins_serialno,*/
/*        'shinspermit_recent_shins_expirydate' => $shinspermit->shinspermit_recent_shins_expirydate,*/
                'shinspermit_recent_shins_typecolor' => $shinspermit->shinspermit_recent_shins_typecolor,
                'shinspermit_completed_docs' => $shinspermit->shinspermit_completed_docs,
                'shinspermit_inspectionscheduled' => $shinspermit->shinspermit_inspectionscheduled,
                'shinspermit_inspectionapproval' => $shinspermit->shinspermit_inspectionapproval,
                'shinspermit_policyno' => $shinspermit->shinspermit_policyno,
                'shinspermit_policyexpirydate' => $shinspermit->shinspermit_policyexpirydate,
                'shinspermit_fireext_serialno' => $shinspermit->shinspermit_fireext_serialno,
                'shinspermit_fireext_expirydate' => $shinspermit->shinspermit_fireext_expirydate,
                'shinspermit_tyre_manufacturingdate' => $shinspermit->shinspermit_tyre_manufacturingdate,
                'shinspermit_smokecondition' => $shinspermit->shinspermit_smokecondition,
                'shinspermit_fireext_serialno_checked' => $shinspermit->shinspermit_fireext_serialno_checked,
                'shinspermit_fireext_expirydate_checked' => $shinspermit->shinspermit_fireext_expirydate_checked,
                'shinspermit_tyre_manufacturingdate_checked' => $shinspermit->shinspermit_tyre_manufacturingdate_checked,
                'shinspermit_smokecondition_checked' => $shinspermit->shinspermit_smokecondition_checked,
                'shinspermit_inspection_location' => $shinspermit->shinspermit_inspection_location,
                ];
            }

            if ($vehicle) {
                $data_vehicle = [
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_company_id' => $vehicle->company_name_vehicle_company_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'vehicle_insurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $vehicle->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
/*                        'vehicle_parkingarea_id' => $vehicle->parkingarea_name_vehicle_parkingarea_id,*/
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_activity_statusid' => $vehicle->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $vehicle->vehicle_application_date,
                    'vehicle_blacklistedremark' => (!empty($vehicle->vehicle_blacklistedremark)?$vehicle->vehicle_blacklistedremark:"-"),

                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'insurance_files' => $insurancefiles,
                    'inspector_files' => $inspectorfiles,
                ];
            }

            if ($inspection) {
                $data_inspection = [
                /*'shinschecklist_data' => $inspection,*/
                'mtwchecklist_data' => $this->mtwchecklist_model->get_all('shins'),
                'shins_selfchecked_selected' => $selfchecked_ids,
                'shins_mtwchecked_y_selected' => $mtwchecked_y_ids,
                'shins_mtwchecked_n_selected' => $mtwchecked_n_ids,
                'shins_mtwchecked_na_selected' => $mtwchecked_na_ids,
                ];
            }

            $data = array_merge($data_permit, $data_shinspermit, $data_vehicle, $data_timeline, $data_files, $data_inspection, $data_extra);

            return $data;

        }

    }

    public function wipbriefing_detail($id)
    {

        $id = fixzy_decoder($id);

        $row         = $this->permitall_model->get_read($id);
        $wipbriefingpermit    = $this->wipbriefingpermit_model->get_read_by_permitid($row->permit_id);
        $vehicle        = $this->vehicle_model->get_read($wipbriefingpermit->wipbriefingpermit_vehicle_id);
        $timeline    = $this->permittimelinedom_model->get_all_by_permitid($row->permit_id);
        $files       = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "wipbriefing_requireddoc");
        $insurancefiles = $this->uploadfiles_model->get_all_by_permitid($row->permit_id, "wipbriefing_insurancedoc");
        $data_extra['history_list'] = $history_list = $this->Enforcement_model->get_history_vehicle($vehicle->vehicle_id);
        $data_extra['permits_list'] = $permits_list = $this->Enforcement_model->find_wipbriefing_list($vehicle->vehicle_id);

        $data_wipbriefingpermit    = [];
        $data_vehicle      = [];
        $data_timeline    = [];
        $data_files       = [];

        if ($row) {
            $data_permit = [
                'permit_id' => fixzy_encoder($row->permit_id),
                'raw_permit_id' => $row->permit_id,
                'permit_groupid' => $row->permit_group_name_permit_groupid,
                'permit_typeid' => $row->permit_type_name_permit_typeid,
'permit_type_desc' => $row->permit_type_desc,
                'permit_condition' => $row->permit_condition_name_permit_condition,
                'permit_bookingid' => $row->permit_bookingid,
                'permit_picid' => $row->pic_fullname_permit_picid,
                'permit_companyid' => $row->company_name_permit_companyid,
                'permit_issuance_serialno' => $row->permit_issuance_serialno,
                'permit_issuance_date' => $row->permit_issuance_date,
                'permit_issuance_startdate' => $row->permit_issuance_startdate,
                'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                'permit_payment_trainingfee' => (!empty($row->permit_payment_trainingfee)?$row->permit_payment_trainingfee:"-"),
                'permit_payment_new' => (!empty($row->permit_payment_new)?$row->permit_payment_new:"-"),
                'permit_payment_renew_oneyear' => (!empty($row->permit_payment_renew_oneyear)?$row->permit_payment_renew_oneyear:"-"),
                'permit_payment_renew_prorated' => (!empty($row->permit_payment_renew_prorated)?$row->permit_payment_renew_prorated:"-"),
                'permit_payment_sst' => (!empty($row->permit_payment_sst)?$row->permit_payment_sst:"-"),
                'permit_payment_total' => standardmoney($row->permit_payment_total),
                'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                /*'permit_status' => $row->permit_status_desc_permit_status,*/
                'permit_status' => $row->permit_status,
                'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                'permit_remark' => (!empty($row->permit_remark)?$row->permit_remark:"-"),
'permit_docscheck_remark' => $row->permit_docscheck_remark,
'permit_approval_remark' => $row->permit_approval_remark,
'permit_inspection_remark' => (!empty($row->permit_inspection_remark)?$row->permit_inspection_remark:"-"),
'permit_inspectionmanager_remark' => (!empty($row->permit_inspectionmanager_remark)?$row->permit_inspectionmanager_remark:"-"),
'permit_payment_remark' => $row->permit_payment_remark,
'permit_replacement_remark' => $row->permit_replacement_remark,
'permit_termination_remark' => $row->permit_termination_remark,
'permit_apply_remark' => $row->permit_apply_remark,

                'permit_recent_permitid' => $row->permit_recent_permitid,
                'permit_created_at' => $row->permit_created_at,
'permit_company_permit' => $row->permit_company_permit,
'permit_company_receipt' => $row->permit_company_receipt,
            ];

            if ($wipbriefingpermit) {
                $data_wipbriefingpermit = [
                    'wipbriefingpermit_permit_id' => $wipbriefingpermit->wipbriefingpermit_permit_id,
                    'wipbriefingpermit_driver_id' => $wipbriefingpermit->wipbriefingpermit_driver_id,

                    'wipbriefingpermit_driveracknowledgement' => $wipbriefingpermit->wipbriefingpermit_driveracknowledgement,
                    'wipbriefingpermit_driveracknowledgement_date' => $wipbriefingpermit->wipbriefingpermit_driveracknowledgement_date,
                    'wipbriefingpermit_certbyemployer' => $wipbriefingpermit->wipbriefingpermit_certbyemployer,
                    'wipbriefingpermit_certbyemployer_date' => $wipbriefingpermit->wipbriefingpermit_certbyemployer_date,
                    'wipbriefingpermit_certbytrainer' => $wipbriefingpermit->wipbriefingpermit_certbytrainer,
                    'wipbriefingpermit_certbytrainer_date' => $wipbriefingpermit->wipbriefingpermit_certbytrainer_date,
                    'wipbriefingpermit_course_date' => $wipbriefingpermit->wipbriefingpermit_course_date,
                    'wipbriefingpermit_wipbriefingscheduled' => $wipbriefingpermit->wipbriefingpermit_wipbriefingscheduled,
                    'wipbriefingpermit_wipbriefingapproval' => $wipbriefingpermit->wipbriefingpermit_wipbriefingapproval,
                    'wipbriefingpermit_attendwipbriefing' => $wipbriefingpermit->wipbriefingpermit_attendwipbriefing,
                    'wipbriefingpermit_completed_docs' => $wipbriefingpermit->wipbriefingpermit_completed_docs,
                    'wipbriefingpermit_approvedby_airside' => $wipbriefingpermit->wipbriefingpermit_approvedby_airside,
                    'wipbriefingpermit_created_at' => $wipbriefingpermit->wipbriefingpermit_created_at,
                    'wipbriefingpermit_updated_at' => $wipbriefingpermit->wipbriefingpermit_updated_at,
                    'wipbriefingpermit_deleted_at' => $wipbriefingpermit->wipbriefingpermit_deleted_at,
                    'wipbriefingpermit_lastchanged_by' => $wipbriefingpermit->wipbriefingpermit_lastchanged_by,

                    'wipbriefingpermit_policyno' => $wipbriefingpermit->wipbriefingpermit_policyno,
                    'wipbriefingpermit_policyexpirydate' => $wipbriefingpermit->wipbriefingpermit_policyexpirydate,

                    'wipbriefingpermit_entrypurpose' => $wipbriefingpermit->wipbriefingpermit_entrypurpose,
                    'wipbriefingpermit_entrypost' => $wipbriefingpermit->wipbriefingpermit_entrypost,
                    'wipbriefingpermit_exitpost' => $wipbriefingpermit->wipbriefingpermit_exitpost,
                    'wipbriefingpermit_steerman_name' => $wipbriefingpermit->wipbriefingpermit_steerman_name,
                    'wipbriefingpermit_steerman_icno' => $wipbriefingpermit->wipbriefingpermit_steerman_icno,
                    'wipbriefingpermit_steerman_adpno' => $wipbriefingpermit->wipbriefingpermit_steerman_adpno,
                    'wipbriefingpermit_needescort' => $wipbriefingpermit->wipbriefingpermit_needescort,
                    'wipbriefingpermit_escortname' => $wipbriefingpermit->wipbriefingpermit_escortname,
                    'wipbriefingpermit_location' => $wipbriefingpermit->wipbriefingpermit_location,
                ];
            }

            if ($vehicle) {
                $data_vehicle = [
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_company_id' => $vehicle->company_name_vehicle_company_id,
                    'vehicle_registration_no' => $vehicle->vehicle_registration_no,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'vehicle_insurance_policy_no' => $vehicle->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $vehicle->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $vehicle->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
                    'vehicle_vehiclegroup_name' => $vehicle->vehicle_vehiclegroup_name,
                    'vehicle_year_manufacture' => $vehicle->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $vehicle->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $vehicle->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $vehicle->vehicle_engine_no,
                    'vehicle_engine_capacity' => $vehicle->vehicle_enginecapacity_name,
                    'vehicle_activity_statusid' => $vehicle->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $vehicle->vehicle_application_date,
                    'vehicle_blacklistedremark' => (!empty($vehicle->vehicle_blacklistedremark)?$vehicle->vehicle_blacklistedremark:"-"),

                ];
            }

            if ($timeline) {
                $data_timeline = [
                    'timeline' => $timeline,

                ];
            }

            if ($files) {
                $data_files = [
                    'permit_files' => $files,
                    'insurance_files' => $insurancefiles,
                ];
            }


            $data = array_merge($data_permit, $data_wipbriefingpermit, $data_vehicle, $data_timeline, $data_files, $data_extra);
            return $data;

        }
    }

}
