
<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shinsinspection extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('shinsinspection_model');
        $this->lang->load('shinsinspection_lang', $this->session->userdata('language'));
        $this->lang->load('global', $this->session->userdata('language'));
    }

    public function index()
    {
        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $shinsinspection = $this->shinsinspection_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'shinsinspection_data' => $shinsinspection,
                'permission' => $this->permission,
                'controller' => 'shinsinspection',
                'pagetitle' => 'SHINS Inspection',
            ];

            $this->content = 'shinsinspection/shinsinspection_list';
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

            $data_inspection = $this->shinsinspection_model->get_shinschecklist_by_id($permitid);
            $general_requirement = [];
            $additional_requirement = [];
            $special_requirement = [];
            $all_requirement = [];

            if(isset($data_inspection)) {
                foreach($data_inspection as $requirement) {
                    if($requirement->shinschecklist_group == 'g') {
                        array_push($general_requirement, $requirement);
                    }
                    else if($requirement->shinschecklist_group == 'a') {
                        array_push($additional_requirement, $requirement);
                    }
                    else if($requirement->shinschecklist_group == 's') {
                        array_push($special_requirement, $requirement);
                    }
                    $all_requirement[$requirement->shinschecklist_id] = array(
                        'id' => $requirement->shinschecklist_id,
                        'chk' => ($requirement->shinschecklist_checked == 'y') ? true : false,
                        'chkmtw' => ($requirement->shinschecklist_mtwchecked == 'y') ? true : false
                    );
                }
            }

            $maxrow = max(count($general_requirement), count($additional_requirement), count($special_requirement));
            $permit_info = (object) $this->shinsinspection_model->get_by_id($permitid);
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
                'shinspermit_id' => $permit_info->shinspermit_id,
                'action' => site_url('shinsinspection/inspect_action'),
                'maxrow' => $maxrow,
                'general_requirement' => $general_requirement,
                'additional_requirement' => $additional_requirement,
                'special_requirement' => $special_requirement,
                'vehicle_reg_no' => $vehicle_regno,
                'all_requirement' => $all_requirement

            ];
            $this->content = 'shinsinspection/shinsinspection_form';
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
                $data_shinspermit = [];
                $data_permit = [];
                $data_permit_timeline = [];
                $permit_id = $this->input->post('permit_id');
                $shinspermit_id = $this->input->post('shinspermit_id');
                $inspection_comply = $this->input->post('inspection_comply');
                $remark = $this->input->post('remark');
                // Update checklist Start
                $inspection_result = json_decode($this->input->post('inspection_result'));
                ;
                foreach($inspection_result as $checklist) {
                    array_push($data_checklist, array(
                        'shinschecklist_id' => $checklist->id,
                        'shinschecklist_mtwchecked' => ($checklist->chkmtw == true) ? 'y' : 'n',
                        'shinschecklist_updated_at' => date('Y-m-d H:i:s'),
                        'shinschecklist_lastchanged_by' => $this->session->userdata('id')
                    ));
                }
                
                $updated_checklist = $this->shinsinspection_model->update_checklist($data_checklist, $permit_id ); 
                // Update checklist End

                $unchecked = 0;
                foreach($updated_checklist as $chk) {
                    if($chk->shinschecklist_checked != $chk->shinschecklist_mtwchecked) {
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
                    $data_shinspermit = array(
                        'shinspermit_inspection_remark' => $remark,
                        'shinspermit_result' => 'pass',
                        'shinspermit_result_inspector_id' => $this->session->userdata('id'),
                        'shinspermit_inspection_date' => date('Y-m-d'),
                        'shinspermit_inspectionapproval' => $inspection_comply
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
                    $data_shinspermit = array(
                        'shinspermit_inspection_remark' => $remark,
                        'shinspermit_result' => 'fail',
                        'shinspermit_result_inspector_id' => $this->session->userdata('id'),
                        'shinspermit_inspection_date' => date('Y-m-d'),
                        'shinspermit_inspectionapproval' => $inspection_comply
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
                    'shinspermit_id' => $shinspermit_id
                );

                $this->shinsinspection_model->update_inspection_result($data_id, $data_shinspermit, $data_permit, $data_permit_timeline);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Inspection Done');
                redirect(site_url('shinsinspection'));                
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

            $data_inspection = $this->shinsinspection_model->get_shinschecklist_by_id($permitid);
            $general_requirement = [];
            $additional_requirement = [];
            $special_requirement = [];
            $all_requirement = [];

            if(isset($data_inspection)) {
                foreach($data_inspection as $requirement) {
                    if($requirement->shinschecklist_group == 'g') {
                        array_push($general_requirement, $requirement);
                    }
                    else if($requirement->shinschecklist_group == 'a') {
                        array_push($additional_requirement, $requirement);
                    }
                    else if($requirement->shinschecklist_group == 's') {
                        array_push($special_requirement, $requirement);
                    }
                    $all_requirement[$requirement->shinschecklist_id] = array(
                        'id' => $requirement->shinschecklist_id,
                        'chk' => ($requirement->shinschecklist_checked == 'y') ? true : false,
                        'chkmtw' => ($requirement->shinschecklist_mtwchecked == 'y') ? true : false,
                        'chkmtwman' => ($requirement->shinschecklist_mtwmanagerchecked == 'y') ? true : false
                    );
                }
            }

            $maxrow = max(count($general_requirement), count($additional_requirement), count($special_requirement));
            $permit_info = (object) $this->shinsinspection_model->get_by_id($permitid);
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
                'shinspermit_id' => $permit_info->shinspermit_id,
                'action' => site_url('shinsinspection/verification_action'),
                'maxrow' => $maxrow,
                'general_requirement' => $general_requirement,
                'additional_requirement' => $additional_requirement,
                'special_requirement' => $special_requirement,
                'vehicle_reg_no' => $vehicle_regno,
                'all_requirement' => $all_requirement

            ];
            $this->content = 'shinsinspection/shinsinspection_verification_form';
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
                $data_shinspermit = [];
                $data_permit = [];
                $data_permit_timeline = [];
                $permit_id = $this->input->post('permit_id');
                $shinspermit_id = $this->input->post('shinspermit_id');
                $inspection_comply = $this->input->post('inspection_comply');
                $remark = $this->input->post('remark');
                // Update checklist Start
                $inspection_result = json_decode($this->input->post('inspection_result'));
                ;
                foreach($inspection_result as $checklist) {
                    array_push($data_checklist, array(
                        'shinschecklist_id' => $checklist->id,
                        'shinschecklist_mtwmanagerchecked' => ($checklist->chkmtwman == true) ? 'y' : 'n',
                        'shinschecklist_updated_at' => date('Y-m-d H:i:s'),
                        'shinschecklist_lastchanged_by' => $this->session->userdata('id')
                    ));
                }
                
                $updated_checklist = $this->shinsinspection_model->update_checklist($data_checklist, $permit_id ); 
                // Update checklist End

                $unchecked = 0;
                foreach($updated_checklist as $chk) {
                    if($chk->shinschecklist_mtwchecked != $chk->shinschecklist_mtwmanagerchecked) {
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
                    $data_shinspermit = array(
                        'shinspermit_inspectionapproval_verification' => $inspection_comply,
                        'shinspermit_inspection_verification_remark' => $remark,
                        'shinspermit_managerverified_id' => $this->session->userdata('id'),
                        'shinspermit_managerverified_date' => date('Y-m-d')
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
                    $data_shinspermit = array(
                        'shinspermit_inspectionapproval_verification' => $inspection_comply,
                        'shinspermit_inspection_verification_remark' => $remark,
                        'shinspermit_managerverified_id' => $this->session->userdata('id'),
                        'shinspermit_managerverified_date' => date('Y-m-d')
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
                    'shinspermit_id' => $shinspermit_id
                );

                $this->shinsinspection_model->update_inspection_result($data_id, $data_shinspermit, $data_permit, $data_permit_timeline);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Inspection Done');
                redirect(site_url('shinsinspection'));                
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
        $results = $this->shinsinspection_model->listajax(
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
                    $rud .= anchor(site_url('shinsinspection/verification/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') ;
                }
                else if($r['vehicle_status'] == 'inspectionpending') {
                    $rud .= anchor(site_url('shinsinspection/inspect/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') ;
                }
                else {
                    $rud .= anchor(site_url('shinsinspection/verification/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') ;
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
                "recordsTotal" => $this->shinsinspection_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->shinsinspection_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file shinsinspection.php */
/* Location: ./application/controllers/shinsinspection.php */
