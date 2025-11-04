<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitglobalreport extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitglobalreport_model');
        $this->load->model('permit_model');
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
        $this->load->model('company_model');
        $this->lang->load('permitglobalreport_lang', $this->session->userdata('language'));
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

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
                'controller' => 'permitglobalreport',
                'pagetitle' => 'Pending Approval Permits',
                'company' => $this->company_model->get_all('company_name'),
                'permit_type' => $this->permit_model->get_all_permit_type(),
                'permit_officialstatus' => $this->permit_model->get_all_permit_officialstatus(),
                'permit_group' => $this->permit_model->get_all_permit_group(),
                'permit_condition' => $this->permit_model->get_all_permit_condition(),
                'vehiclegroup' => $this->vehicle_model->get_all_vehiclegroup(),
                'enginecapacity' => $this->vehicle_model->get_all_enginecapacity(),
            ];

            $this->content = 'permitglobalreport/permitall_list_process';
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
        $this->content  = 'permitglobalreport/permitglobalreport_adp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function adp_debug($id)
    {
        $this->output->enable_profiler(true);
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->adp_detail($id);
        $this->infopage = 'permitall/permitall_adp';
        $this->content  = 'permitglobalreport/permitglobalreport_adp_raw';
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
        $this->content  = 'permitglobalreport/permitglobalreport_evdp_raw';
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
        $this->content  = 'permitglobalreport/permitglobalreport_avp_raw';
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
        $this->content  = 'permitglobalreport/permitglobalreport_evp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function adp_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_adprules();

        if ($this->form_validation->run() == false) {
            $this->adp($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_ADP,
                    'permit_timeline_desc' => PERMIT_APPROVED_ADP_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {

                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];

                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);
                //update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);
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
            $this->emailcontent->shoot_email_approval('ADP', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function evdp_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_evdprules();

        if ($this->form_validation->run() == false) {
            $this->evdp($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_EVDP,
                    'permit_timeline_desc' => PERMIT_APPROVED_EVDP_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('EVDP', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function avp_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_avprules();

        if ($this->form_validation->run() == false) {
            $this->avp($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_AVP,
                    'permit_timeline_desc' => PERMIT_APPROVED_AVP_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];

                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('AVP', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function evp_submit()
    {

        //if ($this->permission->cp_update == true) {

        $this->_evprules();

        if ($this->form_validation->run() == false) {
            $this->evp($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_EVP,
                    'permit_timeline_desc' => PERMIT_APPROVED_EVP_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('EVP', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

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

    public function get_json()
    {

/*    print_r($this->input->post());
    exit;*/
/*    print_r($_POST);
    exit;*/
        //$this->output->enable_profiler(TRUE);
        $i = $this->input->get('start');

        $columnfilter = [
             'permit_location' => $this->input->get('permit_location'),
            'company_name' => $this->input->get('company_name'),
            'permit_type_desc' =>  $this->input->get('permit_type_desc'),
            'permit_group_name' => $this->input->get('permit_group_name'),
            'permit_condition_name' => $this->input->get('permit_condition_name'),
            'permit_officialstatus_name' => $this->input->get('permit_officialstatus_name'),
            'vehiclegroup_name' => $this->input->get('vehiclegroup_name'),
            'enginecapacity_name' => htmlspecialchars($this->input->get('enginecapacity_name')),
           'ref_country_printable_name' => $this->input->get('ref_country_printable_name'),
           'permit_issuance_startdate' => (!empty($this->input->get('permit_issuance_startdate'))?dateserver($this->input->get('permit_issuance_startdate')):""),
           'permit_issuance_expirydate' => (!empty($this->input->get('permit_issuance_expirydate'))?dateserver($this->input->get('permit_issuance_expirydate')):""),
           'permit_created_at_from' => (!empty($this->input->get('permit_created_at_from'))?dateserver($this->input->get('permit_created_at_from')):""),
           'permit_created_at_to' => (!empty($this->input->get('permit_created_at_to'))?dateserver($this->input->get('permit_created_at_to')):""),
        ];

        $results = $this->permitglobalreport_model->listajax(
            $columnfilter,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value']
//            $columns[$this->input->get('order')[0]['column']],
//            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";

            if ($this->permission->cp_read == true) {
                $rud .= anchor(site_url('permitglobalreport/' . strtolower($r['permit_type_name']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
$driver_id = "";
                $val       = "";
                $applicant_name       = "";
                $categoryz = "";
            if ($r['permit_type_name'] == "ADP") {
                $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
                $applicant_name       = $r['driver_name'];
                if ($this->driver_model->get_by_id($driver_id) != false) {
                    $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
                    $applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
                //$val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
                //$applicant_name       = $r['driver_name'];
                $categoryz = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_verifybymahb_drivingarea;
            } elseif ($r['permit_type_name'] == "EVDP") {
                $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
                $applicant_name       = $r['driver_name'];
                if ($this->driver_model->get_by_id($driver_id) != false) {
                    $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
                    $applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
//                $applicant_name       = $r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "AVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
                $applicant_name       = "";
                if ($this->vehicle_model->get_by_id($vehicle_id) != false) {
                    $val       = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
                    $applicant_name = "";
                }
//                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
//                $applicant_name       = ""; //$r['driver_name'];
                $categoryz = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_avpcategory;
            } elseif ($r['permit_type_name'] == "EVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
                $applicant_name       = "";
                if ($this->vehicle_model->get_by_id($vehicle_id) != false) {
                    $val       = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
                    $applicant_name = "";
                }
//                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
//                $applicant_name       = "";//$r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "PBB") {
                $driver_id = $this->pbbpermit_model->get_read_by_permitid($r['permit_id'])->pbbpermit_driver_id;
                $applicant_name       = $r['driver_name'];
                if ($this->driver_model->get_by_id($driver_id) != false) {
                    $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
                    $applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
//                $applicant_name       = $r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "SH") {
                $vehicle_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_vehicle_id;
                $applicant_name       = "";
                if ($this->vehicle_model->get_by_id($vehicle_id) != false) {
                    $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
                    //$applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
//                $applicant_name       = "";//$r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "VDGS") {
                $driver_id = $this->vdgspermit_model->get_read_by_permitid($r['permit_id'])->vdgspermit_driver_id;
                $applicant_name       = $r['driver_name'];
                if ($this->driver_model->get_by_id($driver_id) != false) {
                    $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
                    $applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
//                $applicant_name       = $r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "CS") {
                $vehicle_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_vehicle_id;
                $applicant_name       = "";
                if ($this->vehicle_model->get_by_id($vehicle_id) != false) {
                    $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
                    //$applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
//                $applicant_name       = "";//$r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "GPU") {
                $driver_id = $this->gpupermit_model->get_read_by_permitid($r['permit_id'])->gpupermit_driver_id;
                $applicant_name       = $r['driver_name'];
                if ($this->driver_model->get_by_id($driver_id) != false) {
                    $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
                    $applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
//                $applicant_name       = $r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "PCA") {
                $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
                $applicant_name       = $r['driver_name'];
                if ($this->driver_model->get_by_id($driver_id) != false) {
                    $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
                    $applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
//                $applicant_name       = $r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $applicant_name       = "";
                if ($this->vehicle_model->get_by_id($vehicle_id) != false) {
                    $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
                    //$applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
//                $applicant_name       = "";//$r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "SHINS") {
                /*$val = 'NA';*/
                $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
                $applicant_name       = "";
                if ($this->vehicle_model->get_by_id($vehicle_id) != false) {
                    $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
                    //$applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
//                $applicant_name       = "";//$r['driver_name'];
                $categoryz = "";
            } elseif ($r['permit_type_name'] == "WIPBRIEFING") {
                $vehicle_id = $this->wipbriefingpermit_model->get_read_by_permitid($r['permit_id'])->wipbriefingpermit_vehicle_id;
                $applicant_name       = "";
                if ($this->vehicle_model->get_by_id($vehicle_id) != false) {
                    $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
                    //$applicant_name = $this->driver_model->get_by_id($driver_id)->driver_name;
                }
//                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
//                $applicant_name       = "";//$r['driver_name'];
                $categoryz = "";
            }

            $appdate = explode(" ", $r['permit_created_at']);
            if ($r['permit_officialstatus_name'] == 'completed') {
                $officialstatus = '<span class="label label-success">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'inprogress') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'pending') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'failed') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'pendingpayment') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'rejected') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'suspended') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'canceled') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'terminated') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'expired') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name'] . '</span>';
            } elseif ($r['permit_officialstatus_name'] == 'paid') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name'] . '</span>';
            }
            $contactno = "";
            if ($r['pic_handphone'] != "") {
                $contactno .= $r['pic_handphone'];
                if ($r['pic_phoneoffice'] != "") {
                    $contactno .= "/" . $r['pic_phoneoffice'];
                }
            } else {
                if ($r['pic_phoneoffice'] != "") {
                    $contactno .= $r['pic_phoneoffice'];
                }
            }

            $first_exam_result = "";
            if(!empty($r['first_exam_result'])){
               if($r['first_exam_result']=='y'){
                 $first_exam_result = 'PASSED';
               }elseif($r['first_exam_result']=='n'){
                 $first_exam_result = 'FAILED';
               }
            }

            $second_exam_result = "";
            if(!empty($r['second_exam_result'])){
               if($r['second_exam_result']=='y'){
                 $second_exam_result = 'PASSED';
               }elseif($r['second_exam_result']=='n'){
                 $second_exam_result = 'FAILED';
               }
            }

            array_push($data, [
                $i,
                $r['pic_fullname'],
                $r['pic_email'],
                $contactno,
                $r['permit_location'],
                $applicant_name,
                $r['company_name'],
                $r['permit_bookingid'],
                $val,
                $r['permit_type_desc'],
                $categoryz,
                $officialstatus,
                datelocal($appdate[0]),
                datelocal($r['permit_issuance_expirydate']),
                // Hidden column start [6]
                $r['permit_group_name'], // Permit Type 7
                $r['permit_condition_name'], // Permit Condition 8
                /*$r['pic_fullname'],*/ // PIC 9
                $r['user_name_permit_issuance_processedby'], // Processed By 10
                $r['permit_status_desc'], // Current Step   11
                // Hidden column end
                $r['ref_country_printable_name'],
                $r['driver_designation'],
                $r['driver_drivingclass'],

                datelocal($r['permit_issuance_date']),
                datelocal($r['permit_issuance_startdate']),
                datelocal($r['permit_op_date']),

                $r['vehiclegroup_name'],
                $r['vehicle_chasis_no'],
                $r['enginecapacity_name'],
                datelocal($r['permit_issuance_expirydate']),
                //$first_exam_result,
                //$second_exam_result,
                //$r['permit_approved_by']
                //$rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                /*"recordsTotal" => $this->permitglobalreport_model->recordsTotal()->recordstotal,*/
                /*"recordsFiltered" => $this->permitglobalreport_model->recordsFiltered($location, $columns, $columnfilter, $this->input->get('search')['value'])->recordsfiltered,*/
                /*"recordsFiltered" => $this->permitglobalreport_model->recordsTotal()->recordstotal,*/
                'data' => $data
            ]
        );
    }

    public function _pbbrules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function pbb($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->pbb_detail($id);
        $this->infopage = 'permitall/permitall_pbb';
        $this->content  = 'permitglobalreport/permitglobalreport_pbb_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pbb_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_pbbrules();

        if ($this->form_validation->run() == false) {
            $this->pbb($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_PBB,
                    'permit_timeline_desc' => PERMIT_APPROVED_PBB_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('PBB', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function _shrules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

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
        $this->content  = 'permitglobalreport/permitglobalreport_sh_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function sh_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_shrules();

        if ($this->form_validation->run() == false) {
            $this->sh($this->input->post('permit_id', true));

        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_SH,
                    'permit_timeline_desc' => PERMIT_APPROVED_SH_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('SH', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function _vdgsrules()
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
        $this->content  = 'permitglobalreport/permitglobalreport_vdgs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function vdgs_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_vdgsrules();

        if ($this->form_validation->run() == false) {
            $this->vdgs($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_VDGS,
                    'permit_timeline_desc' => PERMIT_APPROVED_VDGS_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('VDGS', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function _csrules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

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
        $this->content  = 'permitglobalreport/permitglobalreport_cs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function cs_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_csrules();

        if ($this->form_validation->run() == false) {
            $this->cs($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_CS,
                    'permit_timeline_desc' => PERMIT_APPROVED_CS_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('CS', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function _gpurules()
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
        $this->content  = 'permitglobalreport/permitglobalreport_gpu_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function gpu_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_gpurules();

        if ($this->form_validation->run() == false) {
            $this->gpu($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_GPU,
                    'permit_timeline_desc' => PERMIT_APPROVED_GPU_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('GPU', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function _pcarules()
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
        $this->content  = 'permitglobalreport/permitglobalreport_pca_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pca_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_pcarules();

        if ($this->form_validation->run() == false) {
            $this->pca($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_PCA,
                    'permit_timeline_desc' => PERMIT_APPROVED_PCA_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('PCA', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function wip($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->wip_detail($id);
        $this->infopage = 'permitall/permitall_wip';
        $this->content  = 'permitglobalreport/permitglobalreport_wip_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wip_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_wiprules();

        if ($this->form_validation->run() == false) {
            $this->wip($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_WIP,
                    'permit_timeline_desc' => PERMIT_APPROVED_WIP_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('WIP', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function _wiprules()
    {
        $this->form_validation->set_rules('adminapproval', ' ', 'trim|required');
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function shins($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->shins_detail($id);
        $this->infopage = 'permitall/permitall_shins';
        $this->content  = 'permitglobalreport/permitglobalreport_shins_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function shins_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_shinsrules();

        if ($this->form_validation->run() == false) {
            $this->shins($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_SHINS,
                    'permit_timeline_desc' => PERMIT_APPROVED_SHINS_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('SHINS', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
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

    public function _wipbriefingrules()
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
        $this->content  = 'permitglobalreport/permitglobalreport_wipbriefing_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wipbriefing_submit()
    {

        // if ($this->permission->cp_update == true) {

        $this->_wipbriefingrules();

        if ($this->form_validation->run() == false) {
            $this->wipbriefing($this->input->post('permit_id', true));
        } else {

            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $bookingId   = $this->input->post('permit_bookingid', true);

            if ($this->input->post('adminapproval', true) == 'y') {

                $data_permit = [
                    'permit_status' => 'paymentpending',
                    'permit_officialstatus' => 'pendingpayment',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PERMIT_APPROVED_WIPBRIEFING,
                    'permit_timeline_desc' => PERMIT_APPROVED_WIPBRIEFING_DESC,
                    'permit_timeline_status' => 'paymentpending',
                    'permit_timeline_officialstatus' => 'pendingpayment',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    $data_pic = [
                        'bookingId' => $bookingId,
                        'status' => 'success'
                    ];
                }
            } else {
                $data_permit = [
                    'permit_status' => 'applicationrejected',
                    'permit_officialstatus' => 'rejected',
                    'permit_approval_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
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
                $driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype, $permitid);
//update driver/vehicle status
                $this->permitall_model->update_driver_vehicle_status($permittype, $driver_vehicle_id, 9);

                $this->db->trans_start();
                $this->permitglobalreport_model->update($permitid, $data_permit);
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
            $this->emailcontent->shoot_email_approval('WIPBRIEF', 'pic', $data_pic, $emails);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitglobalreport'));
        }
    }

}
;
/* End of file Permitglobalreport.php */
/* Location: ./application/controllers/Permitglobalreport.php */
