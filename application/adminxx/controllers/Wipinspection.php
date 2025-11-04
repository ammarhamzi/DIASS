
<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wipinspection extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wipinspection_model');
        $this->lang->load('wipinspection_lang', $this->session->userdata('language'));
        $this->lang->load('global', $this->session->userdata('language'));
    }

    public function index()
    {
        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $wipinspection = $this->wipinspection_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'wipinspection_data' => $wipinspection,
                'permission' => $this->permission,
                'controller' => 'wipinspection',
                'pagetitle' => 'WIP Inspection',
            ];

            $this->content = 'wipinspection/wipinspection_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function inspect($permitid)
    {
        $permitid = fixzy_decoder($permitid);
        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];

            $data_inspection = $this->wipinspection_model->get_wipchecklist_by_id($permitid);
            $general_requirement = [];
            $additional_requirement = [];
            $special_requirement = [];
            $all_requirement = [];

            if(isset($data_inspection)) {
                foreach($data_inspection as $requirement) {
                    if($requirement->wipchecklist_group == 'g') {
                        array_push($general_requirement, $requirement);
                    }
                    else if($requirement->wipchecklist_group == 'a') {
                        array_push($additional_requirement, $requirement);
                    }
                    else if($requirement->wipchecklist_group == 's') {
                        array_push($special_requirement, $requirement);
                    }
                    $all_requirement[$requirement->wipchecklist_id] = array(
                        'id' => $requirement->wipchecklist_id,
                        'chk' => ($requirement->wipchecklist_checked == 'y') ? true : false,
                        'chkmtw' => ($requirement->wipchecklist_mtwchecked == 'y') ? true : false
                    );
                }
            }

            $maxrow = max(count($general_requirement), count($additional_requirement), count($special_requirement));
            $permit_info = (object) $this->wipinspection_model->get_by_id($permitid);
            $vehicle_regno = $permit_info->vehicle_regno;

            $data = [
                'button_submit' => ($permit_info->vehicle_status == 'inspectionpending') ? true : false,
                'inspectionapproval' => $permit_info->inspectionapproval,                
                'inspection_remark' => $permit_info->inspection_remark,    
                'inspectionapproval_verification' => $permit_info->inspectionapproval_verification,
                'inspection_verification_remark' => $permit_info->inspection_verification_remark,   
                'inspector' => $permit_info->inspector,    
                'inspection_date' => $permit_info->inspection_date,    
                'permit_id' => $permitid,
                'wippermit_id' => $permit_info->wippermit_id,
                'action' => site_url('wipinspection/inspect_action'),
                'maxrow' => $maxrow,
                'general_requirement' => $general_requirement,
                'additional_requirement' => $additional_requirement,
                'special_requirement' => $special_requirement,
                'vehicle_reg_no' => $vehicle_regno,
                'all_requirement' => $all_requirement

            ];
            $this->content = 'wipinspection/wipinspection_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function inspect_action()
    {
        // print_r($this->input->post());
        // return;
        if ($this->permission->cp_create == true) {

            $this->_rules();

            if ($this->form_validation->run() != false) {

                $data_checklist = [];
                $data_wippermit = [];
                $data_permit = [];
                $data_permit_timeline = [];
                $permit_id = $this->input->post('permit_id');
                $wippermit_id = $this->input->post('wippermit_id');
                $inspection_comply = $this->input->post('inspection_comply');
                $remark = $this->input->post('remark');
                // Update checklist Start
                $inspection_result = json_decode($this->input->post('inspection_result'));
                ;
                foreach($inspection_result as $checklist) {
                    array_push($data_checklist, array(
                        'wipchecklist_id' => $checklist->id,
                        'wipchecklist_mtwchecked' => ($checklist->chkmtw == true) ? 'y' : 'n',
                        'wipchecklist_updated_at' => date('Y-m-d H:i:s'),
                        'wipchecklist_lastchanged_by' => $this->session->userdata('id')
                    ));
                }
                
                $updated_checklist = $this->wipinspection_model->update_checklist($data_checklist, $permit_id ); 
                // Update checklist End

                $unchecked = 0;
                foreach($updated_checklist as $chk) {
                    if($chk->wipchecklist_checked != $chk->wipchecklist_mtwchecked) {
                        $unchecked++;
                    }
                }

                if($unchecked == 0) {
                    $pass = 'y';
                }
                else {
                    $pass = 'n';
                }

                if($pass == 'y') {
                    $data_wippermit = array(
                        'wippermit_inspection_remark' => $remark,
                        'wippermit_result' => 'pass',
                        'wippermit_result_inspector_id' => $this->session->userdata('id'),
                        'wippermit_inspection_date' => date('Y-m-d'),
                        'wippermit_inspectionapproval' => $inspection_comply
                    );
                    
                    $data_permit = array (
                        'permit_status' => 'inspectionpassed',
                        'permit_officialstatus' => 'inprogress'
                    );
                    
                    $data_permit_timeline = array(
                        'permit_timeline_permitid' => $permit_id,
                        'permit_timeline_userid' => $this->session->userdata('id'),
                        'permit_timeline_name' => '1st inspection passed',
                        'permit_timeline_desc' => 'vehicle pass the 1st inspection',
                        'permit_timeline_status' => 'inspectionpassed',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                        'permit_timeline_lastchanged_by' => $this->session->userdata('id')
                    );                    
                }
                else {
                    $data_wippermit = array(
                        'wippermit_inspection_remark' => $remark,
                        'wippermit_result' => 'fail',
                        'wippermit_result_inspector_id' => $this->session->userdata('id'),
                        'wippermit_inspection_date' => date('Y-m-d'),
                        'wippermit_inspectionapproval' => $inspection_comply
                    );
                    
                    $data_permit = array (
                        'permit_status' => 'inspectionfailed',
                        'permit_officialstatus' => 'failed'
                    );
                    
                    $data_permit_timeline = array(
                        'permit_timeline_permitid' => $permit_id,
                        'permit_timeline_userid' => $this->session->userdata('id'),
                        'permit_timeline_name' => '1st inspection failed',
                        'permit_timeline_desc' => 'vehicle fail the 1st inspection',
                        'permit_timeline_status' => 'inspectionfailed',
                        'permit_timeline_officialstatus' => 'failed',
                        'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                        'permit_timeline_lastchanged_by' => $this->session->userdata('id')
                    );
                }

                $data_id = array(
                    'permit_id' => $permit_id,
                    'wippermit_id' => $wippermit_id
                );

                $this->wipinspection_model->update_inspection_result($data_id, $data_wippermit, $data_permit, $data_permit_timeline);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Inspection Done');
                redirect(site_url('wipinspection'));                
            }
            else {
                echo 'something wrong';
            }

        } else {
            redirect('/');
        }

    }

    public function verification($permitid)
    {
        $permitid = fixzy_decoder($permitid);
        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];

            $data_inspection = $this->wipinspection_model->get_wipchecklist_by_id($permitid);
            $general_requirement = [];
            $additional_requirement = [];
            $special_requirement = [];
            $all_requirement = [];

            if(isset($data_inspection)) {
                foreach($data_inspection as $requirement) {
                    if($requirement->wipchecklist_group == 'g') {
                        array_push($general_requirement, $requirement);
                    }
                    else if($requirement->wipchecklist_group == 'a') {
                        array_push($additional_requirement, $requirement);
                    }
                    else if($requirement->wipchecklist_group == 's') {
                        array_push($special_requirement, $requirement);
                    }
                    $all_requirement[$requirement->wipchecklist_id] = array(
                        'id' => $requirement->wipchecklist_id,
                        'chk' => ($requirement->wipchecklist_checked == 'y') ? true : false,
                        'chkmtw' => ($requirement->wipchecklist_mtwchecked == 'y') ? true : false,
                        'chkmtwman' => ($requirement->wipchecklist_mtwmanagerchecked == 'y') ? true : false
                    );
                }
            }

            $maxrow = max(count($general_requirement), count($additional_requirement), count($special_requirement));
            $permit_info = (object) $this->wipinspection_model->get_by_id($permitid);
            $vehicle_regno = $permit_info->vehicle_regno;

            $data = [
                'button_submit' => ($permit_info->vehicle_status == 'inspectionpassed') ? true : false,
                'inspectionapproval' => $permit_info->inspectionapproval,                
                'inspection_remark' => $permit_info->inspection_remark,
                'inspectionapproval_verification' => $permit_info->inspectionapproval_verification,
                'inspection_verification_remark' => $permit_info->inspection_verification_remark,
                'permit_id' => $permitid,
                'inspector' => $permit_info->inspector,
                'manager' => $permit_info->manager,
                'inspection_date' => $permit_info->inspection_date,
                'managerverified_date' => $permit_info->managerverified_date,
                'wippermit_id' => $permit_info->wippermit_id,
                'action' => site_url('wipinspection/verification_action'),
                'maxrow' => $maxrow,
                'general_requirement' => $general_requirement,
                'additional_requirement' => $additional_requirement,
                'special_requirement' => $special_requirement,
                'vehicle_reg_no' => $vehicle_regno,
                'all_requirement' => $all_requirement

            ];
            $this->content = 'wipinspection/wipinspection_verification_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function verification_action()
    {
        // print_r($this->input->post());
        // return;
        if ($this->permission->cp_create == true) {

            $this->_rules();

            if ($this->form_validation->run() != false) {

                $data_checklist = [];
                $data_wippermit = [];
                $data_permit = [];
                $data_permit_timeline = [];
                $permit_id = $this->input->post('permit_id');
                $wippermit_id = $this->input->post('wippermit_id');
                $inspection_comply = $this->input->post('inspection_comply');
                $remark = $this->input->post('remark');
                // Update checklist Start
                $inspection_result = json_decode($this->input->post('inspection_result'));
                ;
                foreach($inspection_result as $checklist) {
                    array_push($data_checklist, array(
                        'wipchecklist_id' => $checklist->id,
                        'wipchecklist_mtwmanagerchecked' => ($checklist->chkmtwman == true) ? 'y' : 'n',
                        'wipchecklist_updated_at' => date('Y-m-d H:i:s'),
                        'wipchecklist_lastchanged_by' => $this->session->userdata('id')
                    ));
                }
                
                $updated_checklist = $this->wipinspection_model->update_checklist($data_checklist, $permit_id ); 
                // Update checklist End

                $unchecked = 0;
                foreach($updated_checklist as $chk) {
                    if($chk->wipchecklist_mtwchecked != $chk->wipchecklist_mtwmanagerchecked) {
                        $unchecked++;
                    }
                }

                if($unchecked == 0) {
                    $pass = 'y';
                }
                else {
                    $pass = 'n';
                }

                if($pass == 'y') {
                    $data_wippermit = array(
                        'wippermit_inspectionapproval_verification' => $inspection_comply,
                        'wippermit_inspection_verification_remark' => $remark,
                        'wippermit_managerverified_id' => $this->session->userdata('id'),
                        'wippermit_managerverified_date' => date('Y-m-d')
                    );
                    
                    $data_permit = array (
                        'permit_status' => 'approvalairsidepending',
                        'permit_officialstatus' => 'inprogress'
                    );
                    
                    $data_permit_timeline = array(
                        'permit_timeline_permitid' => $permit_id,
                        'permit_timeline_userid' => $this->session->userdata('id'),
                        'permit_timeline_name' => '2nd inspection passed',
                        'permit_timeline_desc' => 'vehicle pass the 2nd inspection',
                        'permit_timeline_status' => 'approvalairsidepending',
                        'permit_timeline_officialstatus' => 'inprogress',
                        'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                        'permit_timeline_lastchanged_by' => $this->session->userdata('id')
                    );                    
                }
                else {
                    $data_wippermit = array(
                        'wippermit_inspectionapproval_verification' => $inspection_comply,
                        'wippermit_inspection_verification_remark' => $remark,
                        'wippermit_managerverified_id' => $this->session->userdata('id'),
                        'wippermit_managerverified_date' => date('Y-m-d')
                    );
                    
                    $data_permit = array (
                        'permit_status' => 'inspectionmanagerfailed',
                        'permit_officialstatus' => 'failed'
                    );
                    
                    $data_permit_timeline = array(
                        'permit_timeline_permitid' => $permit_id,
                        'permit_timeline_userid' => $this->session->userdata('id'),
                        'permit_timeline_name' => '2nd inspection failed',
                        'permit_timeline_desc' => 'vehicle fail the 2nd inspection',
                        'permit_timeline_status' => 'inspectionmanagerfailed',
                        'permit_timeline_officialstatus' => 'failed',
                        'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                        'permit_timeline_lastchanged_by' => $this->session->userdata('id')
                    );
                }

                $data_id = array(
                    'permit_id' => $permit_id,
                    'wippermit_id' => $wippermit_id
                );

                $this->wipinspection_model->update_inspection_result($data_id, $data_wippermit, $data_permit, $data_permit_timeline);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Inspection Done');
                redirect(site_url('wipinspection'));                
            }

        } else {
            redirect('/');
        }

    }


    public function _rules()
    {
        $this->form_validation->set_rules('inspection_result', ' ', 'required');
        $this->form_validation->set_rules('inspection_comply', ' ', 'required');
        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'p.permit_bookingid',
            'v.vehicle_registration_no',
            'vc.vehiclegroup_name',
            'v.vehicle_year_manufacture',
            'c.company_name',
            'v.vehicle_type',
            'p.permit_status'
        ];
        $results = $this->wipinspection_model->listajax(
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
                if($r['vehicle_status'] == 'inspectionpassed') {// verification
                    $rud .= anchor(site_url('wipinspection/verification/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') ;
                }
                else if($r['vehicle_status'] == 'inspectionpending') {
                    $rud .= anchor(site_url('wipinspection/inspect/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') ;
                }
                else {
                    $rud .= anchor(site_url('wipinspection/verification/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') ;
                }
                
            }

            array_push($data, [
                $r['booking_id'],
                $r['vehicle_regno'],
                $r['vehicle_type'],
                $r['vehicle_year_manufacture'],
                $r['company_name'],
                $r['vehicle_category'],
                $r['vehicle_status'],
                $rud
            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->wipinspection_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->wipinspection_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file wipinspection.php */
/* Location: ./application/controllers/wipinspection.php */
