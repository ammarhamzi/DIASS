<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Enforcement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Charges_types_model');
        $this->load->model('Service_charges_model');
        $this->load->model('Enforcement_model');
        $this->load->model('Offendlist_model');
        $this->load->helper('enforcement'); // Load enforcement helper for period functions
        $this->lang->load('enforcement_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $data = $this->Service_charges_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'serviceCharges_data' => $data,
                'permission' => $this->permission,
                'driver_list' => $this->Enforcement_model->driver_list(),
                'vehicle_list' => $this->Enforcement_model->vehicle_list(),
            ];
            $this->content = 'enforcement/list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

    public function read($id)
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->Service_charges_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {

                /*----------  Requestor Date & Time split  ----------*/
                $raw_datetime = $row->servicecharges_requestordatetime;
                $txt_date = $txt_time = '';
                if(!empty($raw_datetime))
                {
                    $txt_date = date('d/m/Y',strtotime($raw_datetime));
                    $txt_time = date('H:i:s',strtotime($raw_datetime));
                }

                //current file list name
                $file_list_raw = $row->servicecharges_files;
                $file_list_arr = explode(',', $file_list_raw);
                $file_arr = array();
                if(!empty($file_list_raw) && count($file_list_arr) > 0)
                {
                    foreach($file_list_arr as $fla)
                    {
                        $file_arr[] = '<a href="'.base_url('resources/shared_file/'.$fla).'" target="_blank">'.$fla.'</a>';
                    }
                }
                $file_list_html = '';
                if(count($file_arr) > 0)
                {
                    $file_list_html = '<ol>
                                        <li>'.implode('</li><li>',$file_arr).'</li>
                                    </ol>';
                }

                $data = [
                    'id' => $id,
                    'ct_ids' => set_value('ct_ids',$row->servicecharges_ct_id),
                    'qty' => set_value('qty',$row->servicecharges_qty),
                    'flight_number' => set_value('flight_number',$row->servicecharges_flightNumber),
                    'reason' => set_value('reason',$row->servicecharges_reason),
                    'notes' => set_value('notes',$row->servicecharges_note),
                    'uploads' => set_value('uploads'),
                    'file_list_html' => $file_list_html,
                    'approval_choice' => set_value('approval_choice'),
                    'remarks_approval' => set_value('remarks_approval'),
                    'pic_id' => set_value('pic_id'),
                    'pic_name' => set_value('pic_name',$row->servicecharges_picname),
                    'requestor_txt' => set_value('requestor_txt',$row->servicecharges_requestor),
                    'req_phoneNo' => set_value('req_phoneNo',$row->servicecharges_requestorphone),
                    'req_email' => set_value('req_email',$row->servicecharges_requestoremail),
                    'date_field' => set_value('date_field',$txt_date),
                    'time_field' => set_value('time_field',$txt_time),
                    'pic_address' => set_value('pic_address',$row->servicecharges_picadrs),
                    'pic_phoneNo' => set_value('pic_phoneNo',$row->servicecharges_picphone),
                    'pic_email' => set_value('pic_email',$row->servicecharges_picemail),

                    'charges_types_list' => $this->Charges_types_model->get_all(),
                    // 'pic_list'=>$this->Charges_types_model->get_user_type('2'),
                ];
                $this->content = 'enforcement/read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ServiceCharges'));
            }
        } else {
            redirect('/');
        }
    }

    public function create()
    {
        redirect('/');
    }

    public function create_action()
    {
        redirect('/');
    }

    public function update($id)
    {

        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $row = $this->Service_charges_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {

                /*----------  Requestor Date & Time split  ----------*/
                $raw_datetime = $row->servicecharges_requestordatetime;
                $txt_date = $txt_time = '';
                if(!empty($raw_datetime))
                {
                    $txt_date = date('d/m/Y',strtotime($raw_datetime));
                    $txt_time = date('H:i:s',strtotime($raw_datetime));
                }

                //current file list name
                $file_list_raw = $row->servicecharges_files;
                $file_list_arr = explode(',', $file_list_raw);
                $file_arr = array();
                if(!empty($file_list_raw) && count($file_list_arr) > 0)
                {
                    foreach($file_list_arr as $fla)
                    {
                        $file_arr[] = '<a href="'.base_url('resources/shared_file/'.$fla).'" target="_blank">'.$fla.'</a>';
                    }
                }
                $file_list_html = '';
                if(count($file_arr) > 0)
                {
                    $file_list_html = '<ol>
                                        <li>'.implode('</li><li>',$file_arr).'</li>
                                    </ol>';
                }

                $data = [
                    'button' => 'Update',
                    'action' => site_url('enforcement/update_action'),
                    'id' => $id,
                    'ct_ids' => set_value('ct_ids',$row->servicecharges_ct_id),
                    'qty' => set_value('qty',$row->servicecharges_qty),
                    'flight_number' => set_value('flight_number',$row->servicecharges_flightNumber),
                    'reason' => set_value('reason',$row->servicecharges_reason),
                    'notes' => set_value('notes',$row->servicecharges_note),
                    'uploads' => set_value('uploads'),
                    'file_list_html' => $file_list_html,
                    'approval_choice' => set_value('approval_choice'),
                    'remarks_approval' => set_value('remarks_approval'),
                    'pic_id' => set_value('pic_id'),
                    'pic_name' => set_value('pic_name',$row->servicecharges_picname),
                    'requestor_txt' => set_value('requestor_txt',$row->servicecharges_requestor),
                    'req_phoneNo' => set_value('req_phoneNo',$row->servicecharges_requestorphone),
                    'req_email' => set_value('req_email',$row->servicecharges_requestoremail),
                    'date_field' => set_value('date_field',$txt_date),
                    'time_field' => set_value('time_field',$txt_time),
                    'pic_address' => set_value('pic_address',$row->servicecharges_picadrs),
                    'pic_phoneNo' => set_value('pic_phoneNo',$row->servicecharges_picphone),
                    'pic_email' => set_value('pic_email',$row->servicecharges_picemail),

                    'charges_types_list' => $this->Charges_types_model->get_all(),
                    // 'pic_list'=>$this->Charges_types_model->get_user_type('2'),
                ];
                $this->content = 'enforcement/form';

                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record NOT FOUND');
                redirect(site_url('ServiceCharges'));
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
                $this->update($this->input->post('sc_id', true));
            } else {

                //requestor date time field
                $req_date = $this->input->post('date_field');
                $req_time = $this->input->post('time_field');
                $req_datetime = date('Y-m-d H:i:s',strtotime($req_date.' '.$req_time));

                $data = [
                    'servicecharges_ct_id' => $this->input->post('ct_ids', true),
                    'servicecharges_qty' => ($this->input->post('qty',true)),
                    'servicecharges_flightNumber' => $this->input->post('flight_number', true),
                    'servicecharges_reason' => $this->input->post('reason', true),
                    'servicecharges_note' => $this->input->post('notes', true),
                    'servicecharges_requestor' => $this->input->post('requestor_txt', true),
                    'servicecharges_requestordatetime' => $req_datetime,
                    'servicecharges_requestorphone' => $this->input->post('req_phoneNo', true),
                    'servicecharges_requestoremail' => $this->input->post('req_email', true),
                    'servicecharges_picname' => $this->input->post('pic_name', true),
                    'servicecharges_picadrs' => $this->input->post('pic_address', true),
                    'servicecharges_picphone' => $this->input->post('pic_phoneNo', true),
                    'servicecharges_picemail' => $this->input->post('pic_email', true),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->id, 
                ];

                //upload file list
                $txt_file = '';
                $file_json = $this->input->post('file_arr');
                if(isset($file_json) && !empty($file_json))
                {
                    $txt_arr = array();
                    $file_arr = json_decode($file_json,true);
                    if(count($file_arr) > 1)
                    {
                        $txt_arr[] = $file_arr['file_name'];
                    }

                    $txt_file = implode(',',$txt_arr);
                }

                if(!empty($txt_file))
                {
                    $data['servicecharges_files'] = $txt_file;
                }

                $this->Service_charges_model->update(fixzy_decoder($this->input->post('sc_id')),$data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('ServiceCharges'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {
        redirect('/');
    }

    public function delete_update($id)
    {

        // if ($this->permission->cp_delete == true) {

        //     $id  = fixzy_decoder($id);
        //     $row = $this->user_model->get_by_id($id);
        //     /* $this->logQueries($this->config->item('dblog')); */
        //     if ($row) {
        //         $data = [
        //             'user_deleted_at' => date('Y-m-d H:i:s')
        //         ];
        //         $this->user_model->update($id, $data);
        //         /* $this->logQueries($this->config->item('dblog')); */
        //         $this->session->set_flashdata('message', 'Delete Record Success');
        //         redirect(site_url('user'));
        //     } else {
        //         $this->session->set_flashdata('message', 'Record Not Found');
        //         redirect(site_url('user'));
        //     }
        // } else {
        //     redirect('/');
        // }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('ct_ids', ' ', 'trim|required');
        $this->form_validation->set_rules('qty', ' ', 'trim|required');
        $this->form_validation->set_rules('flight_number', ' ', 'trim|required');
        $this->form_validation->set_rules('reason', ' ', 'trim|required');
        $this->form_validation->set_rules('notes', ' ', 'trim|required');
        $this->form_validation->set_rules('requestor_txt', ' ', 'trim|required');
        $this->form_validation->set_rules('req_phoneNo', ' ', 'trim|required');
        $this->form_validation->set_rules('req_email', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_name', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_address', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_phoneNo', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_email', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _rules_nopassword()
    {
        $this->form_validation->set_rules('user_username', ' ', 'trim|required');
        $this->form_validation->set_rules('user_name', ' ', 'trim|required');
        $this->form_validation->set_rules('user_email', ' ', 'trim|required');
        $this->form_validation->set_rules('user_photo', ' ', 'trim');
        $this->form_validation->set_rules('user_groupid[]', ' ', 'required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }


    public function find_keyword()
    {
        $search_by = $this->input->post('search_by');
        $search_keyword = $this->input->post('search_keyword');

        switch ($search_by) {
            case 1:
                $link = 'create_driver';
                $q = $this->Enforcement_model->search_driver($search_keyword);
                break;
            case 2:
                $link = 'create_vehicle';
                $q = $this->Enforcement_model->search_vehicle($search_keyword);
                break;
            default:
                $link = '';
                $q = array();
                break;
        }

        if(count($q) == 1)
        {
            $res = array(
                "res"=>1,
                "output"=>site_url('Enforcement/'.$link.'?i='.$q[0]->ids),
            );
        }
        else if(count($q) > 1)
        {
            $html = '<p>Result : </p><ol>';

            foreach($q as $rr)
            {
                $html .= '<li><a href="'.site_url('Enforcement/'.$link.'?i='.$rr->ids).'">'.$rr->reg_no.' - '.$rr->display_name.'</a></li>';
            }

            $html .= '</ol>';

            $res = array(
                "res"=>2,
                "output"=>$html,
            );
        }
        else
        {
            $res = array(
                "res"=>0,
                "output"=>'<div class="alert alert-danger">No Information Found.</div>',
            );
        }

        echo json_encode($res);
    }

    function create_vehicle()
    {
        $id = $this->input->get('i');

        if ($this->permission->cp_create == true && !empty($id)) {

            $vehicle_det = $this->Enforcement_model->vehicle_detail($id);
            if(!isset($vehicle_det) || empty($vehicle_det) )
            {
                redirect('Enforcement');
                die();
            }

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            unset($_SESSION['offense_detail']);
            $revision = defined('CURRENT_OFFENCE_REVISION') ? CURRENT_OFFENCE_REVISION : '2025';
            $offend_list = $this->Offendlist_model->severity_sort_inarray($revision);
            $history_list = $this->Enforcement_model->get_history_vehicle($id);
            
            $data = [
                'button' => 'Enforcement Notice (Vehicle)',
                'action' => site_url('enforcement/create_vehicle_action'),
                'permission' => $this->permission,
                'ids' => $id,//set_value('ids'),
                'offend_list' => $offend_list,
                'history_list' => $history_list,
                'vehicle_det' => $vehicle_det,
                //'driver_photo' => _PIC_URL.'uploads/files/'.$this->Enforcement_model->get_driver_photo($id),
                //'merit_point_txt' => $this->Enforcement_model->sum_merit_point(2,$id),
                'merit_point_txt' => $this->Enforcement_model->sum_merit_point(2,$id)
            ];
            $this->content = 'enforcement/form_vehicle';
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

    function create_vehicle_action()
    {
        if ($this->permission->cp_create == true) {

            // Start transaction for data integrity
            $this->db->trans_start();
            
            try {
                $hidden_type_arr = $this->input->post('hidden_type');
                $hidden_summon_arr = $this->input->post('hidden_summon');
                $hidden_date_arr = $this->input->post('hidden_date');
                $hidden_time_arr = $this->input->post('hidden_time');
                $hidden_location_arr = $this->input->post('hidden_location');
                $hidden_notes_arr = $this->input->post('hidden_notes');
                $hidden_point_arr = $this->input->post('hidden_point');
                $hidden_period_arr = $this->input->post('hidden_period');

                $adpadv_no = $this->input->post('adpadv_no');
                $period_date_suspension = $this->input->post('period_date_suspension');
                $addOffence_location_real = $this->input->post('addOffence_location_real');
                $admin_action = $this->input->post('admin_action');
                $vehicle_id = $this->input->post('vehicless');

                // Get current revision
                $revision = defined('CURRENT_OFFENCE_REVISION') ? CURRENT_OFFENCE_REVISION : '2025';

                $vehicle_det = $this->Enforcement_model->vehicle_detail($vehicle_id);
                $current_company_id = $vehicle_det->vehicle_company_id;
                $company_det = $this->Enforcement_model->find_company_detail($current_company_id);

                // Calculate highest period from hidden_period array
                $highest_period_result = get_highest_period($hidden_period_arr ?: []);
                $final_period_text = $highest_period_result['period_text'];
                $is_suspendable = $highest_period_result['is_suspendable'] ? 1 : 0;
                $auto_suspend = $highest_period_result['auto_suspend'] ? 1 : 0;


                $data_em = [
                    'enforcements_main_from_category' => 2,
                    'enforcements_main_driverOrVehicle' => $vehicle_id,
                    'enforcements_main_ispermitsuspend' => $is_suspendable,
                    'enforcements_main_period_suspension' => $final_period_text,
                    'enforcements_main_adpadv_no' => $adpadv_no,
                    'enforcements_main_remarks' => $admin_action,
                    'enforcements_main_location' => $addOffence_location_real,
                    'enforcements_main_company_id' => $current_company_id,
                    'enforcements_main_company_detail_json' => json_encode($company_det),

                    'enforcements_main_created_at' => date('Y-m-d H:i:s'),
                    'enforcements_main_created_by' => $this->session->id, 
                    'enforcements_main_active' => 1,
                    'enforcements_main_rev_year' => $revision,
                ];
                $this->Enforcement_model->insert_em($data_em);
                $primary_id_em = $this->db->insert_id();

                if(isset($hidden_type_arr) && count($hidden_type_arr) > 0 )
                {
                    foreach($hidden_type_arr as $i => $hidden_type)
                    {
                        $hidden_date = empty($hidden_date_arr[$i]) ? '' : date('Y-m-d',strtotime($hidden_date_arr[$i])) ;
                        $data = [
                            'enforcements_from_category' => 2,
                            'enforcements_driverOrVehicle' => $vehicle_id,
                            'enforcements_date' => $hidden_date,
                            'enforcements_time' => $hidden_time_arr[$i],
                            'enforcements_offendlist_id' => $hidden_type,
                            'enforcements_summon_no' => $hidden_summon_arr[$i],
                            'enforcements_notes' => $hidden_notes_arr[$i],
                            'enforcements_location' => $hidden_location_arr[$i],
                            'enforcements_offendlist_point' => $hidden_point_arr[$i],
                            'enforcements_ispermitsuspend' => 0,
                            'enforcements_period_suspension' => isset($hidden_period_arr[$i]) ? $hidden_period_arr[$i] : '',
                            'enforcements_remarks' => $admin_action,
                            'enforcements_main_id' => $primary_id_em,

                            'enforcements_created_at' => date('Y-m-d H:i:s'),
                            'enforcements_created_by' => $this->session->id, 
                            'enforcements_active' => 1,
                        ];
                        
                        $this->Enforcement_model->insert($data);
                        $primary_id = $this->db->insert_id();
                    }
                    
                    // Complete transaction
                    $this->db->trans_complete();
                    
                    if ($this->db->trans_status() === FALSE) {
                        throw new Exception('Transaction failed during enforcement creation');
                    }
                    
                    unset($_SESSION['offense_detail']);

                    // Suspend only if period is suspendable
                    if($is_suspendable) {
                        //suspend vehicle
                        $this->Enforcement_model->suspend_vehicle($vehicle_id);

                        //suspend AVP
                        $this->Enforcement_model->suspend_permit($adpadv_no);
                    }

                    /* $this->logQueries($this->config->item('dblog')); */
                    $this->session->set_flashdata('message', 'Create Record Success');
                }
                else
                {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('message', 'No Record Created');
                }
                
            } catch (Exception $e) {
                $this->db->trans_rollback();
                log_message('error', 'Vehicle enforcement creation failed: ' . $e->getMessage());
                $this->session->set_flashdata('message', 'Failed to create enforcement. Please try again.');
            }
            
            redirect(site_url('Enforcement'));
        } else {
            redirect('/');
        }
    }

    function create_driver()
    {
        $id = $this->input->get('i');

        if ($this->permission->cp_create == true && !empty($id)) {

            $driver_det = $this->Enforcement_model->driver_detail($id);
            if(!isset($driver_det) || empty($driver_det) )
            {
                redirect('Enforcement');
                die();
            }

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            unset($_SESSION['offense_detail']);
            $revision = defined('CURRENT_OFFENCE_REVISION') ? CURRENT_OFFENCE_REVISION : '2025';
            $offend_list = $this->Offendlist_model->severity_sort_inarray($revision);
            $history_list = $this->Enforcement_model->get_history_driver($id);
            $adp_detail_list = $this->Enforcement_model->driver_detail_adp($id);
            $permit_no = '';
            $adp_class='-';
            $adp_number='-';
            $adp_expiry='-';
            $merit_point = 0;
            if($adp_detail_list != null)
            {
                $permit_no = $adp_detail_list->permit_issuance_serialno;
                $adp_class = $adp_detail_list->adppermit_verifybymahb_drivingarea;
                $adp_number = $adp_detail_list->permit_issuance_serialno;
                $adp_expiry = date('d-m-Y',strtotime($adp_detail_list->permit_issuance_expirydate));
                $merit_point = $this->Enforcement_model->sum_merit_point(1,$id);
            }
            //$adp_list = $this->Enforcement_model->find_adp_list($id);
            
            $data = [
                'button' => 'Enforcement Notice (Driver / Operator)',
                'action' => site_url('enforcement/create_action_driver'),
                'permission' => $this->permission,
                'ids' => $id,//set_value('ids'),
                'offend_list' => $offend_list,
                'driver_det' => $driver_det,
                'adp_driver_det' => $adp_detail_list,
                'history_list' => $history_list,
                'adp_list' => array(),//$adp_list,
                'driver_photo' => base_url().'../uploads/files/'.$this->Enforcement_model->get_driver_photo($id),
                //'merit_point_txt' => $this->Enforcement_model->sum_merit_point(1,$id,$permit_no),
                'merit_point_txt' => $merit_point,
                'adp_class' => $adp_class,
                'adp_number' => $adp_number,
                'adp_expiry' => $adp_expiry,
            ];
            $this->content = 'enforcement/form_driver';
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

    function create_driver_action()
    {
        if ($this->permission->cp_create == true) {
            
            // Start transaction for data integrity
            $this->db->trans_start();
            
            try {
                $hidden_type_arr = $this->input->post('hidden_type');
                $hidden_summon_arr = $this->input->post('hidden_summon');
                $hidden_date_arr = $this->input->post('hidden_date');
                $hidden_time_arr = $this->input->post('hidden_time');
                $hidden_location_arr = $this->input->post('hidden_location');
                $hidden_notes_arr = $this->input->post('hidden_notes');
                $hidden_point_arr = $this->input->post('hidden_point');
                $hidden_period_arr = $this->input->post('hidden_period');

                $ispermitsuspend = $this->input->post('ispermitsuspend');
                $period_date_suspension = $this->input->post('period_date_suspension');
                $adpadv_no = $this->input->post('adpadv_no');
                $addOffence_location_real = $this->input->post('addOffence_location_real');
                $admin_action = $this->input->post('admin_action');
                $driver_id = $this->input->post('driverss');

                // Get current revision
                $revision = defined('CURRENT_OFFENCE_REVISION') ? CURRENT_OFFENCE_REVISION : '2025';

                $driver_det = $this->Enforcement_model->driver_detail($driver_id);
                $current_company_id = $driver_det->driver_company_id;
                $company_det = $this->Enforcement_model->find_company_detail($current_company_id);
                
                // Calculate highest period from hidden_period array
                $highest_period_result = get_highest_period($hidden_period_arr ?: []);
                $final_period_text = $highest_period_result['period_text'];
                $is_suspendable = $highest_period_result['is_suspendable'] ? 1 : 0;

                $data_em = [
                    'enforcements_main_from_category' => 1,
                    'enforcements_main_driverOrVehicle' => $driver_id,
                    'enforcements_main_ispermitsuspend' => $is_suspendable,
                    'enforcements_main_period_suspension' => $final_period_text,
                    'enforcements_main_adpadv_no' => $adpadv_no,
                    'enforcements_main_remarks' => $admin_action,
                    'enforcements_main_location' => $addOffence_location_real,
                    'enforcements_main_company_id' => $current_company_id,
                    'enforcements_main_company_detail_json' => json_encode($company_det),

                    'enforcements_main_created_at' => date('Y-m-d H:i:s'),
                    'enforcements_main_created_by' => $this->session->id, 
                    'enforcements_main_active' => 1,
                    'enforcements_main_rev_year' => $revision,
                ];
                $this->Enforcement_model->insert_em($data_em);
                $primary_id_em = $this->db->insert_id();

                if(isset($hidden_type_arr) && count($hidden_type_arr) > 0 )
                {
                    foreach($hidden_type_arr as $i => $hidden_type)
                    {
                        $hidden_date = empty($hidden_date_arr[$i]) ? '' : date('Y-m-d',strtotime($hidden_date_arr[$i])) ;
                        $data = [
                            'enforcements_from_category' => 1,
                            'enforcements_driverOrVehicle' => $driver_id,
                            'enforcements_date' => $hidden_date,
                            'enforcements_time' => $hidden_time_arr[$i],
                            'enforcements_offendlist_id' => $hidden_type,
                            'enforcements_summon_no' => $hidden_summon_arr[$i],
                            'enforcements_notes' => $hidden_notes_arr[$i],
                            //'enforcements_location' => $hidden_location_arr[$i],
                            'enforcements_offendlist_point' => $hidden_point_arr[$i],
                            'enforcements_ispermitsuspend' => $is_suspendable,
                            'enforcements_period_suspension' => isset($hidden_period_arr[$i]) ? $hidden_period_arr[$i] : '',
                            'enforcements_remarks' => $admin_action,
                            'enforcements_main_id' => $primary_id_em,

                            'enforcements_created_at' => date('Y-m-d H:i:s'),
                            'enforcements_created_by' => $this->session->id, 
                            'enforcements_active' => 1,
                        ];
                        
                        $this->Enforcement_model->insert($data);
                        $primary_id = $this->db->insert_id();
                    }
                    
                    // Complete transaction
                    $this->db->trans_complete();
                    
                    if ($this->db->trans_status() === FALSE) {
                        throw new Exception('Transaction failed during enforcement creation');
                    }
                    
                    unset($_SESSION['offense_detail']);

                    // Suspend only if period is suspendable
                    if($is_suspendable) {
                        //suspend driver
                        $this->Enforcement_model->suspend_driver($driver_id);

                        //suspend ADP
                        $this->Enforcement_model->suspend_permit($adpadv_no);
                    }

                    /* $this->logQueries($this->config->item('dblog')); */
                    $this->session->set_flashdata('message', 'Create Record Success');
                }
                else
                {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('message', 'No Record Created');
                }
                
            } catch (Exception $e) {
                $this->db->trans_rollback();
                log_message('error', 'Driver enforcement creation failed: ' . $e->getMessage());
                $this->session->set_flashdata('message', 'Failed to create enforcement. Please try again.');
            }
            
            redirect(site_url('Enforcement'));
        } else {
            redirect('/');
        }
    }

    function add_temporary_offence_detail()
    {
        $addOffence_type = $this->input->post('addOffence_type');
        $addOffence_date = $this->input->post('addOffence_date');
        $addOffence_time = $this->input->post('addOffence_time');
        $addOffence_summon = $this->input->post('addOffence_summon');
        $addOffence_location = $this->input->post('addOffence_location');
        $addOffence_notes = $this->input->post('addOffence_notes');

        if(!isset($_SESSION['offense_detail']))
        {
            $_SESSION['offense_detail'] = array();
        }

        $_SESSION['offense_detail'][] = array(
            "type"=>$addOffence_type,
            "date"=>$addOffence_date,
            "time"=>$addOffence_time,
            "summon"=>$addOffence_summon,
            "location"=>$addOffence_location,
            "notes"=>$addOffence_notes,
        );

        echo json_encode(array('res'=>1,));
    }

    function remove_temporary_offence_detail()
    {
        $enc = $this->input->post('enc');
        if(isset($_SESSION['offense_detail'][$enc]))
        {
            unset($_SESSION['offense_detail'][$enc]);
        }
        echo json_encode(array('res'=>1,));
    }

    function view_temporary_offence_detail()
    {
        // Determine flow type from POST parameter (driver or vehicle)
        $flow_type = $this->input->post('flow_type') ?: 'driver';
        $is_driver_flow = ($flow_type === 'driver');
        
        // Get current revision
        $revision = defined('CURRENT_OFFENCE_REVISION') ? CURRENT_OFFENCE_REVISION : '2025';
        
        ?>
            <table class="table table-bordered">
                <tr>
                    <th>Offence Type</th>
                    <th>Severity</th>
                    <th>Summon No</th>
                    <th>Date / Time</th>
                    <th>Notes</th>
                    <th class="text-center">Monetary Penalty</th>
                    <th class="text-center">Period</th>
                    <th class="text-center">Point</th>
                    <th class="text-center">Action</th>
                </tr>
                <?php 
                if(isset($_SESSION['offense_detail']) && count($_SESSION['offense_detail']) > 0)
                {
                    // Get all offence IDs
                    $offence_ids = array();
                    foreach($_SESSION['offense_detail'] as $rod) {
                        $offence_ids[] = $rod['type'];
                    }
                    
                    // Fetch all offences at once using revision-aware method
                    $offences = $this->Offendlist_model->get_offences_by_ids($offence_ids, $revision);
                    
                    // Create lookup array by ID
                    $offence_lookup = array();
                    foreach($offences as $off) {
                        $offence_lookup[$off['offendlist_id']] = $off;
                    }
                    
                    foreach($_SESSION['offense_detail'] as $i => $rod)
                    {
                        // Get offence details from lookup
                        $offend_det = isset($offence_lookup[$rod['type']]) ? $offence_lookup[$rod['type']] : null;
                        
                        if(!$offend_det) {
                            // Fallback to old method if not found
                            $offend_det_obj = $this->Offendlist_model->get_by_id($rod['type']);
                            if($offend_det_obj) {
                                $offend_det = array(
                                    'offendlist_violationNo' => $offend_det_obj->offendlist_violationNo,
                                    'offendlist_regNo' => $offend_det_obj->offendlist_regNo,
                                    'offence_severity' => isset($offend_det_obj->off_cat_name) ? $offend_det_obj->off_cat_name : '-',
                                    'monetary_penalty' => '-',
                                    'adp_suspension_text' => isset($offend_det_obj->offendlist_period) ? $offend_det_obj->offendlist_period : '0',
                                    'avp_suspension_text' => isset($offend_det_obj->offendlist_period) ? $offend_det_obj->offendlist_period : '0',
                                    'offendlist_offenddemeritpoint' => $offend_det_obj->offendlist_offenddemeritpoint
                                );
                            } else {
                                continue; // Skip if offence not found
                            }
                        }
                        
                        // Select correct period based on flow type
                        $display_period = $is_driver_flow ? $offend_det['adp_suspension_text'] : $offend_det['avp_suspension_text'];
                ?>
                <tr>
                    <td>
                        <?=$offend_det['offendlist_violationNo']?> - <?=$offend_det['offendlist_regNo']?>
                        <input type="hidden" name="hidden_type[]" value="<?=$rod['type']?>">
                    </td>
                    <td>
                        <span class="badge badge-info"><?=$offend_det['offence_severity']?></span>
                    </td>
                    <td>
                        <?=$rod['summon']?> 
                        <input type="hidden" name="hidden_summon[]" value="<?=$rod['summon']?>">
                    </td>
                    <td>
                        <?=$rod['date']?> / <?=$rod['time']?> 
                        <input type="hidden" name="hidden_date[]" value="<?=$rod['date']?>">
                        <input type="hidden" name="hidden_time[]" value="<?=$rod['time']?>">
                    </td>
                    <td>
                        <?=$rod['notes']?>
                        <input type="hidden" name="hidden_notes[]" value="<?=$rod['notes']?>">
                    </td>
                    <td class="text-center">
                        <strong><?=$offend_det['monetary_penalty']?></strong>
                    </td>
                    <td class="text-center">
                        <?=$display_period?>
                        <input type="hidden" name="hidden_period[]" value="<?=$display_period?>">    
                    </td>
                    <td class="text-center">
                        <?=$offend_det['offendlist_offenddemeritpoint']?>
                        <input type="hidden" name="hidden_point[]" value="<?=$offend_det['offendlist_offenddemeritpoint']?>">    
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="remove_offence_details text-danger" enc="<?=$i?>" title="Remove"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
                <?php 
                        
                    }
                }
                else
                {
                ?>
                <tr>
                    <td colspan="9">No Info</td>
                </tr>
                <?php
                }
                ?>
            </table>
            <?php 
            if(isset($_SESSION['offense_detail']) && count($_SESSION['offense_detail']) > 0)
            {
                echo '<input type="hidden" class="hidden_exist" name="hidden_exist" value="1" />';
            }
            ?>
        <?php
    }

    function get_highest_period()
    {
        // Determine flow type from POST parameter
        $flow_type = $this->input->post('flow_type') ?: 'driver';
        $is_driver_flow = ($flow_type === 'driver');
        
        // Get current revision
        $revision = defined('CURRENT_OFFENCE_REVISION') ? CURRENT_OFFENCE_REVISION : '2025';
        
        $period_highest = 'NIL';
        $period_rank = 0;
        
        if(isset($_SESSION['offense_detail']) && count($_SESSION['offense_detail']) > 0)
        {
            // Get all offence IDs
            $offence_ids = array();
            foreach($_SESSION['offense_detail'] as $rod) {
                $offence_ids[] = $rod['type'];
            }
            
            // Fetch all offences using revision-aware method
            $offences = $this->Offendlist_model->get_offences_by_ids($offence_ids, $revision);
            
            // Extract periods based on flow type
            $period_arr = array();
            foreach($offences as $offence) {
                $period = $is_driver_flow ? $offence['adp_suspension_text'] : $offence['avp_suspension_text'];
                $period_arr[] = $period;
            }
            
            // Use helper function to get highest period
            if(!empty($period_arr)) {
                $result = get_highest_period($period_arr);
                $period_highest = $result['period_text'];
                $period_rank = $result['rank'];
            }
        }

        echo json_encode(array(
            'res' => $period_rank, // Keep numeric for backward compatibility
            'period_text' => $period_highest,
            'rank' => $period_rank
        ));
    }

    function get_offence_list_table_html()
    {
        $enforcements_main_id = $this->input->post('enc');
        $enforcements_main_rev = $this->input->post('rev');

        // Use the new revision-aware method
        $q = $this->Enforcement_model->get_offence_history($enforcements_main_id);
        
        // Detect revision from first record if available
        $is_2025 = false;
        if(isset($q) && count($q) > 0 && isset($q[0]->_revision)) {
            $is_2025 = ($q[0]->_revision === '2025');
        }

        if(isset($q) && count($q) > 0)
        {
        ?>
            <table class="table table-bordered tbl_offence_dt">
                <thead>
                    <tr>
                        <th>Category</th>
                        <?php if($is_2025): ?>
                        <th>Severity</th>
                        <th>Monetary Penalty</th>
                        <?php endif; ?>
                        <th>Reg/Rule No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Summon No</th>
                        <th>Notes</th>
                        <!-- <th>Location</th> -->
                        <th>Point</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_point = 0; 
                    foreach($q as $r){
                        $total_point += $r->enforcements_offendlist_point;
                    ?>
                    <tr>
                        <td><?=$r->off_cat_name?></td>
                        <?php if($is_2025): ?>
                        <td><?=isset($r->offence_severity) ? $r->offence_severity : ''?></td>
                        <td><?=isset($r->monetary_penalty) ? $r->monetary_penalty : ''?></td>
                        <?php endif; ?>
                        <td><?=$r->offendlist_violationNo?>-<?=$r->offendlist_regNo?></td>
                        <td><?=$r->enforcements_date?></td>
                        <td><?=$r->enforcements_time?></td>
                        <td><?=$r->enforcements_summon_no?></td>
                        <td><?=$r->enforcements_notes?></td>
                        <!-- <td><?=$r->enforcements_location?></td> -->
                        <td><?=$r->enforcements_offendlist_point?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="<?=$is_2025 ? '8' : '6'?>" class="text-right">Total Point</th>
                    <th><?=$total_point?></th>
                </tr>
                </tfoot>
            </table>
        <?php
        }
        else
        {
            echo '<div class="alert alert-warning">No Offence List.</div>';
        }
    }

    function change_status($id)
    {
        if(empty($id))
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $id = fixzy_decoder($id);

        if($id <= 0)
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $data = array(
            'enforcements_main_status'=>'Close',
            'enforcements_main_statusDate'=>date('Y-m-d H:i:s'),
            'enforcements_main_files'=>$this->input->post('file_name'),
            'enforcements_main_updated_at' => date('Y-m-d H:i:s'),
            'enforcements_main_updated_by' => $this->session->id, 
        );

        $this->Enforcement_model->update_em($id,$data);

        $enforcment_det = $this->Enforcement_model->get_read_em($id);
        if(isset($enforcment_det->enforcements_main_adpadv_no) && !empty($enforcment_det->enforcements_main_adpadv_no))
        {
            $this->Enforcement_model->clear_suspend_permit($enforcment_det->enforcements_main_adpadv_no);

            if($enforcment_det->enforcements_main_from_category == 1)
            {
                $this->Enforcement_model->clear_suspend_driver($enforcment_det->enforcements_main_driverOrVehicle);
            }
            else if($enforcment_det->enforcements_main_from_category == 2)
            {
                $this->Enforcement_model->clear_suspend_vehicle($enforcment_det->enforcements_main_driverOrVehicle);
            }
        }

        echo json_encode(array('res'=>1,));
        die();
    }

    function cancel_offence_notice($id)
    {
        if(empty($id))
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $id = fixzy_decoder($id);

        if($id <= 0)
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $data = array(
            'enforcements_main_status'=>'Cancel',
            'enforcements_main_statusDate'=>date('Y-m-d H:i:s'),
            'enforcements_main_updated_at' => date('Y-m-d H:i:s'),
            'enforcements_main_updated_by' => $this->session->id, 
            'enforcements_main_cancel_date'=>date('Y-m-d H:i:s'),
            'enforcements_main_cancel_by'=>$this->session->id,
            'enforcements_main_cancel_reason'=>$this->input->post('cancel_reason'),
        );

        $this->Enforcement_model->update_em($id,$data);

        $enforcment_det = $this->Enforcement_model->get_read_em($id);
        
        //if(isset($enforcment_det->enforcements_main_adpadv_no) && !empty($enforcment_det->enforcements_main_adpadv_no))
        //if(($enforcment_det_cancel > 0) && ($enforcment_det_all > 0) && ($enforcment_det_cancel === $enforcment_det_all))
        //if($enforcment_det_cancel <= $enforcment_det_all)
        if(isset($enforcment_det->enforcements_main_adpadv_no) && !empty($enforcment_det->enforcements_main_adpadv_no))
        {
            $enforcment_det_cancel = $this->Enforcement_model->get_read_cancel($enforcment_det->enforcements_main_adpadv_no);
            $enforcment_det_all = $this->Enforcement_model->get_read_all($enforcment_det->enforcements_main_adpadv_no);            
            if($enforcment_det_cancel == $enforcment_det_all)
            {
                $this->Enforcement_model->clear_suspend_permit($enforcment_det->enforcements_main_adpadv_no);

                if($enforcment_det->enforcements_main_from_category == 1)
                {
                    $this->Enforcement_model->clear_suspend_driver($enforcment_det->enforcements_main_driverOrVehicle);
                }
                else if($enforcment_det->enforcements_main_from_category == 2)
                {
                    $this->Enforcement_model->clear_suspend_vehicle($enforcment_det->enforcements_main_driverOrVehicle);
                }
            }
        }

        echo json_encode(array('res'=>1,));
        die();
    }
    
    function close_offence_notice($id)
    {
        if(empty($id))
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $id = fixzy_decoder($id);

        if($id <= 0)
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $data = array(
            'enforcements_main_status'=>'Close',
            'enforcements_main_statusDate'=>date('Y-m-d H:i:s'),
            'enforcements_main_updated_at' => date('Y-m-d H:i:s'),
            'enforcements_main_updated_by' => $this->session->id, 
            'enforcements_main_cancel_date'=>date('Y-m-d H:i:s'),
            'enforcements_main_cancel_by'=>$this->session->id,
            'enforcements_main_cancel_reason'=>$this->input->post('close_reason'),
        );

        $this->Enforcement_model->update_em($id,$data);

        $enforcment_det = $this->Enforcement_model->get_read_em($id);
        if(isset($enforcment_det->enforcements_main_adpadv_no) && !empty($enforcment_det->enforcements_main_adpadv_no))
        {
            $this->Enforcement_model->clear_suspend_permit($enforcment_det->enforcements_main_adpadv_no);

            if($enforcment_det->enforcements_main_from_category == 1)
            {
                $this->Enforcement_model->clear_suspend_driver($enforcment_det->enforcements_main_driverOrVehicle);
            }
            else if($enforcment_det->enforcements_main_from_category == 2)
            {
                $this->Enforcement_model->clear_suspend_vehicle($enforcment_det->enforcements_main_driverOrVehicle);
            }
        }

        echo json_encode(array('res'=>1,));
        die();
    }
}
;
/* End of file User.php */
/* Location: ./application/controllers/User.php */
