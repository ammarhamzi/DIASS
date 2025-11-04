<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitall extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

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
                'controller' => 'permitall',
                'pagetitle' => 'My Permits',
            ];

            $this->content = 'permitall/permitall_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    //type=normal/raw
    public function read($id, $type = "normal")
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->permitall_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'permit_groupid' => $row->permit_group_name_permit_groupid,
                    'permit_typeid' => $row->permit_type_name_permit_typeid,
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
                    'permit_payment_trainingfee' => $row->permit_payment_trainingfee,
                    'permit_payment_new' => $row->permit_payment_new,
                    'permit_payment_renew_oneyear' => $row->permit_payment_renew_oneyear,
                    'permit_payment_renew_prorated' => $row->permit_payment_renew_prorated,
                    'permit_payment_sst' => $row->permit_payment_sst,
                    'permit_payment_total' => $row->permit_payment_total,
                    'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                    'permit_status' => $row->permit_status_desc_permit_status,
                    'permit_officialstatus' => $row->permit_officialstatus_name_permit_officialstatus,
                    'permit_remark' => $row->permit_remark,
                    'permit_recent_permitid' => $row->permit_recent_permitid,
                    'permit_created_at' => $row->permit_created_at,

                ];

                if ($type === 'normal') {

                    $this->content = 'permitall/permitall_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('permitall/permitall_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permitall'));
            }

        } else {
            redirect('/');
        }

    }

    public function create()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',
                'action' => site_url('permitall/create_action'),
                'permit_groupid' => set_value('permit_groupid'),
                'permit_group' => $this->permitall_model->get_all_permit_group(),
                'permit_typeid' => set_value('permit_typeid'),
                'permit_type' => $this->permitall_model->get_all_permit_type(),
                'permit_condition' => set_value('permit_condition'),
                'permit_condition' => $this->permitall_model->get_all_permit_condition(),
                'permit_bookingid' => set_value('permit_bookingid'),
                'permit_picid' => set_value('permit_picid'),
                'pic' => $this->permitall_model->get_all_pic(),
                'permit_companyid' => set_value('permit_companyid'),
                'company' => $this->permitall_model->get_all_company(),
                'permit_issuance_serialno' => set_value('permit_issuance_serialno'),
                'permit_issuance_date' => set_value('permit_issuance_date'),
                'permit_issuance_startdate' => set_value('permit_issuance_startdate'),
                'permit_issuance_expirydate' => set_value('permit_issuance_expirydate'),
                'permit_issuance_processedby' => set_value('permit_issuance_processedby'),
                'user' => $this->permitall_model->get_all_user(),
                'permit_payment_invoiceno' => set_value('permit_payment_invoiceno'),
                'permit_payment_trainingfee' => set_value('permit_payment_trainingfee'),
                'permit_payment_new' => set_value('permit_payment_new'),
                'permit_payment_renew_oneyear' => set_value('permit_payment_renew_oneyear'),
                'permit_payment_renew_prorated' => set_value('permit_payment_renew_prorated'),
                'permit_payment_sst' => set_value('permit_payment_sst'),
                'permit_payment_total' => set_value('permit_payment_total'),
                'permit_payment_processedby' => set_value('permit_payment_processedby'),
                'permit_status' => set_value('permit_status'),
                'permit_status' => $this->permitall_model->get_all_permit_status(),
                'permit_officialstatus' => set_value('permit_officialstatus'),
                'permit_officialstatus' => $this->permitall_model->get_all_permit_officialstatus(),
                'permit_remark' => set_value('permit_remark'),
                'permit_recent_permitid' => set_value('permit_recent_permitid'),
                'permit_created_at' => set_value('permit_created_at'),

            ];
            $this->content = 'permitall/permitall_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function create_action()
    {

        if ($this->permission->cp_create == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->create();
            } else {
                $data = [
                    'permit_groupid' => $this->input->post('permit_groupid', true),
                    'permit_typeid' => $this->input->post('permit_typeid', true),
                    'permit_condition' => $this->input->post('permit_condition', true),
                    'permit_bookingid' => $this->input->post('permit_bookingid', true),
                    'permit_picid' => $this->input->post('permit_picid', true),
                    'permit_companyid' => $this->input->post('permit_companyid', true),
                    'permit_issuance_serialno' => $this->input->post('permit_issuance_serialno', true),
                    'permit_issuance_date' => $this->input->post('permit_issuance_date', true),
                    'permit_issuance_startdate' => $this->input->post('permit_issuance_startdate', true),
                    'permit_issuance_expirydate' => $this->input->post('permit_issuance_expirydate', true),
                    'permit_issuance_processedby' => $this->input->post('permit_issuance_processedby', true),
                    'permit_payment_invoiceno' => $this->input->post('permit_payment_invoiceno', true),
                    'permit_payment_trainingfee' => $this->input->post('permit_payment_trainingfee', true),
                    'permit_payment_new' => $this->input->post('permit_payment_new', true),
                    'permit_payment_renew_oneyear' => $this->input->post('permit_payment_renew_oneyear', true),
                    'permit_payment_renew_prorated' => $this->input->post('permit_payment_renew_prorated', true),
                    'permit_payment_sst' => $this->input->post('permit_payment_sst', true),
                    'permit_payment_total' => $this->input->post('permit_payment_total', true),
                    'permit_payment_processedby' => $this->input->post('permit_payment_processedby', true),
                    'permit_status' => $this->input->post('permit_status', true),
                    'permit_officialstatus' => $this->input->post('permit_officialstatus', true),
                    'permit_remark' => $this->input->post('permit_remark', true),
                    'permit_recent_permitid' => $this->input->post('permit_recent_permitid', true),
                    'permit_created_at' => $this->input->post('permit_created_at', true),
                    'permit_created_at' => date('Y-m-d H:i:s'),
                    'permit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->permitall_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('permitall'));
            }

        } else {
            redirect('/');
        }

    }

    public function update($id)
    {

        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $row = $this->permitall_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('permitall/update_action'),
                    'id' => $id,
                    'permit_groupid' => set_value('permit_groupid', $row->permit_groupid),
                    'permit_group' => $this->permitall_model->get_all_permit_group(),
                    'permit_typeid' => set_value('permit_typeid', $row->permit_typeid),
                    'permit_type' => $this->permitall_model->get_all_permit_type(),
                    'permit_condition' => set_value('permit_condition', $row->permit_condition),
                    'permit_condition' => $this->permitall_model->get_all_permit_condition(),
                    'permit_bookingid' => set_value('permit_bookingid', $row->permit_bookingid),
                    'permit_picid' => set_value('permit_picid', $row->permit_picid),
                    'pic' => $this->permitall_model->get_all_pic(),
                    'permit_companyid' => set_value('permit_companyid', $row->permit_companyid),
                    'company' => $this->permitall_model->get_all_company(),
                    'permit_issuance_serialno' => set_value('permit_issuance_serialno', $row->permit_issuance_serialno),
                    'permit_issuance_date' => set_value('permit_issuance_date', $row->permit_issuance_date),
                    'permit_issuance_startdate' => set_value('permit_issuance_startdate', $row->permit_issuance_startdate),
                    'permit_issuance_expirydate' => set_value('permit_issuance_expirydate', $row->permit_issuance_expirydate),
                    'permit_issuance_processedby' => set_value('permit_issuance_processedby', $row->permit_issuance_processedby),
                    'user' => $this->permitall_model->get_all_user(),
                    'permit_payment_invoiceno' => set_value('permit_payment_invoiceno', $row->permit_payment_invoiceno),
                    'permit_payment_trainingfee' => set_value('permit_payment_trainingfee', $row->permit_payment_trainingfee),
                    'permit_payment_new' => set_value('permit_payment_new', $row->permit_payment_new),
                    'permit_payment_renew_oneyear' => set_value('permit_payment_renew_oneyear', $row->permit_payment_renew_oneyear),
                    'permit_payment_renew_prorated' => set_value('permit_payment_renew_prorated', $row->permit_payment_renew_prorated),
                    'permit_payment_sst' => set_value('permit_payment_sst', $row->permit_payment_sst),
                    'permit_payment_total' => set_value('permit_payment_total', $row->permit_payment_total),
                    'permit_payment_processedby' => set_value('permit_payment_processedby', $row->permit_payment_processedby),
                    'permit_status' => set_value('permit_status', $row->permit_status),
                    'permit_status' => $this->permitall_model->get_all_permit_status(),
                    'permit_officialstatus' => set_value('permit_officialstatus', $row->permit_officialstatus),
                    'permit_officialstatus' => $this->permitall_model->get_all_permit_officialstatus(),
                    'permit_remark' => set_value('permit_remark', $row->permit_remark),
                    'permit_recent_permitid' => set_value('permit_recent_permitid', $row->permit_recent_permitid),
                    'permit_created_at' => set_value('permit_created_at', $row->permit_created_at),

                ];
                $this->content = 'permitall/permitall_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permitall'));
            }

        } else {
            redirect('/');
        }

    }

    public function update_action()
    {

        if ($this->permission->cp_update == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('permit_id', true));
            } else {
                $data = [
                    'permit_groupid' => $this->input->post('permit_groupid', true),
                    'permit_typeid' => $this->input->post('permit_typeid', true),
                    'permit_condition' => $this->input->post('permit_condition', true),
                    'permit_bookingid' => $this->input->post('permit_bookingid', true),
                    'permit_picid' => $this->input->post('permit_picid', true),
                    'permit_companyid' => $this->input->post('permit_companyid', true),
                    'permit_issuance_serialno' => $this->input->post('permit_issuance_serialno', true),
                    'permit_issuance_date' => $this->input->post('permit_issuance_date', true),
                    'permit_issuance_startdate' => $this->input->post('permit_issuance_startdate', true),
                    'permit_issuance_expirydate' => $this->input->post('permit_issuance_expirydate', true),
                    'permit_issuance_processedby' => $this->input->post('permit_issuance_processedby', true),
                    'permit_payment_invoiceno' => $this->input->post('permit_payment_invoiceno', true),
                    'permit_payment_trainingfee' => $this->input->post('permit_payment_trainingfee', true),
                    'permit_payment_new' => $this->input->post('permit_payment_new', true),
                    'permit_payment_renew_oneyear' => $this->input->post('permit_payment_renew_oneyear', true),
                    'permit_payment_renew_prorated' => $this->input->post('permit_payment_renew_prorated', true),
                    'permit_payment_sst' => $this->input->post('permit_payment_sst', true),
                    'permit_payment_total' => $this->input->post('permit_payment_total', true),
                    'permit_payment_processedby' => $this->input->post('permit_payment_processedby', true),
                    'permit_status' => $this->input->post('permit_status', true),
                    'permit_officialstatus' => $this->input->post('permit_officialstatus', true),
                    'permit_remark' => $this->input->post('permit_remark', true),
                    'permit_recent_permitid' => $this->input->post('permit_recent_permitid', true),
                    'permit_created_at' => $this->input->post('permit_created_at', true),
                    'permit_updated_at' => date('Y-m-d H:i:s'),
                    'permit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->permitall_model->update(fixzy_decoder($this->input->post('permit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permitall'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->permitall_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->permitall_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('permitall'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permitall'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->permitall_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'permit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->permitall_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('permitall'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permitall'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('permit_groupid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_typeid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_condition', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_bookingid', ' ', 'trim');
        $this->form_validation->set_rules('permit_picid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_companyid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_issuance_serialno', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_date', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_startdate', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_processedby', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_payment_invoiceno', ' ', 'trim');
        $this->form_validation->set_rules('permit_payment_trainingfee', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_new', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_renew_oneyear', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_renew_prorated', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_sst', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_total', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_processedby', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_status', ' ', 'trim');
        $this->form_validation->set_rules('permit_officialstatus', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_remark', ' ', 'trim');
        $this->form_validation->set_rules('permit_recent_permitid', ' ', 'trim');
        $this->form_validation->set_rules('permit_created_at', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
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
        $results = $this->permitall_model->listajax(
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

            if($r['permit_officialstatus_name_permit_officialstatus']=="completed"){
                $rud .= anchor(site_url('permitall/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary btn-xs"') .' '.anchor(site_url('permitall/replacement/' . fixzy_encoder($r['permit_id'])), 'Replace', 'class="btn btn-primary btn-xs"') .' '. anchor(site_url('permitall/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), 'Renew', 'class="btn btn-primary btn-xs"').
                    ' ';
            }else{
            if($r['permit_officialstatus_name_permit_officialstatus']!="canceled" && $r['permit_officialstatus_name_permit_officialstatus']!="paid" && $r['permit_status']!="permitterminationpending" && $r['permit_status']!="permitreplacementpending"){
                $rud .= anchor(site_url('permitall/cancellation/'  . fixzy_encoder($r['permit_id'])), 'Cancel', 'class="btn btn-primary btn-xs"') .
                    ' ';
            }

            }

            }
if($r['permit_type_name_permit_typeid']=="ADP"){
     $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
     $val = '<a href="/Driver/update/' .fixzy_encoder($driver_id). '">'.$this->driver_model->get_by_id($driver_id)->driver_ic.'</a>';
}elseif($r['permit_type_name_permit_typeid']=="EVDP"){
    $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
    $val = '<a href="/Driver/update/' .fixzy_encoder($driver_id). '">'.$this->driver_model->get_by_id($driver_id)->driver_ic.'</a>';
}elseif($r['permit_type_name_permit_typeid']=="AVP"){
    /*$val = 'NA';*/
    $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
    $val = '<a href="/Vehicle/update/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
}elseif($r['permit_type_name_permit_typeid']=="EVP"){
    /*$val = 'NA';*/
        $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
    $val = '<a href="/Vehicle/update/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
}elseif($r['permit_type_name_permit_typeid']=="WIP"){
    /*$val = 'NA';*/
    $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
    $val = '<a href="/Vehicle/update/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
}elseif($r['permit_type_name_permit_typeid']=="SHINS"){
    /*$val = 'NA';*/
    $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
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
                '<a href="/permitall/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id']). '">'.$r['permit_bookingid'].'</a>',
                $val,
                $r['permit_type_name_permit_typeid'],
                $officialstatus,
                $appdate[0],
                $r['permit_issuance_expirydate'],
                // Hidden column start [6]
                $r['permit_group_name_permit_groupid'], // Permit Type 6
                $r['permit_condition_name_permit_condition'], // Permit Condition 7
                $r['pic_fullname_permit_picid'], // PIC 8
                $r['company_name_permit_companyid'], // Company 9
                $r['user_name_permit_issuance_processedby'], // Processed By 10
                $r['permit_status_desc_permit_status'], // Current Step   11             
                // Hidden column end
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permitall_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->permitall_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Permitall.php */
/* Location: ./application/controllers/Permitall.php */
