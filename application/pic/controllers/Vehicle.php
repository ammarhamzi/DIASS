<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vehicle extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('vehicle_model');
        $this->load->model('vehiclegroup_model');
        $this->load->model('enginecapacity_model');
        $this->lang->load('vehicle_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$vehicle = $this->vehicle_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                /*'vehicle_data' => $vehicle,*/
                'permission' => $this->permission,
            ];

            $this->content = 'vehicle/vehicle_list';
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
            $row = $this->vehicle_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'vehicle_company_id' => $row->company_name_vehicle_company_id,
                    'vehicle_registration_no' => $row->vehicle_registration_no,
                    'vehicle_type' => $row->vehicle_type,
                    'vehicle_insurance_policy_no' => $row->vehicle_insurance_policy_no,
                    'vehicle_insurance_expiry_date' => $row->vehicle_insurance_expiry_date,
                    'vehicle_vehicleequipmenttype_id' => $row->vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
                    /*'vehicle_parkingarea_id' => $row->parkingarea_name_vehicle_parkingarea_id,*/
                    'vehicle_year_manufacture' => $row->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $row->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $row->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $row->vehicle_engine_no,
                    'vehicle_engine_capacity' => $row->vehicle_engine_capacity,
                    'vehicle_activity_statusid' => $row->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $row->vehicle_application_date,
                    'vehicle_others' => $row->vehicle_others,
                    'vehicle_blacklistedremark' => $row->vehicle_blacklistedremark,

                ];

                if ($type === 'normal') {
//check if parentchild exist
                    $parent_id = $this->my_model->get_value2('tabslave', 'tabslave_id',
                        "tabslave_controller = '" . strtolower($this->router->fetch_class()) . "' and tabslave_parent_id = 0");

                    if (!empty($parent_id)) {
                        $data_parentchild = [
                            'parentchildmenu' => $this->my_model->get_data('tabslave', '*',
                                "tabslave_parent_id = $parent_id"),
                            'currentcontroller' => strtolower($this->router->fetch_class()),
                            'parentid' => fixzy_encoder($id),
                        ];

                        $this->parentchildmenu = $this->load->view('foundation/parentchildmenu',
                            $data_parentchild, true);
                    }

                    $this->content = 'vehicle/vehicle_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('vehicle/vehicle_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vehicle'));
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
                'action' => site_url('vehicle/create_action'),
                'vehicle_company_id' => set_value('vehicle_company_id'),
                'company' => $this->vehicle_model->get_all_company(),
                'vehicle_registration_no' => set_value('vehicle_registration_no'),
                'vehicle_type' => set_value('vehicle_type'),
                'dropdown_vehicle_type' => [
                    (object) ['id' => 'AV', 'value' => 'Airside'], (object) ['id' => 'EV', 'value' => 'Terminal'],
                ],
                'vehicle_insurance_policy_no' => set_value('vehicle_insurance_policy_no'),
                'vehicle_insurance_expiry_date' => set_value('vehicle_insurance_expiry_date'),
                'vehicle_vehicleequipmenttype_id' => set_value('vehicle_vehicleequipmenttype_id'),
                'vehicleequipmenttype' => $this->vehicle_model->get_all_vehicleequipmenttype(),
/*                'vehicle_parkingarea_id' => set_value('vehicle_parkingarea_id'),
                'parkingarea' => $this->vehicle_model->get_all_parkingarea(),*/
                'vehicle_year_manufacture' => set_value('vehicle_year_manufacture'),
                'vehicle_chasis_no' => set_value('vehicle_chasis_no'),
                'vehicle_enginetype_id' => set_value('vehicle_enginetype_id'),
                'enginetype' => $this->vehicle_model->get_all_enginetype(),
                    'vehicle_group' => set_value('vehicle_group'),
                    'other_equipment' => set_value('other_equipment'),
                    'dropdown_vehicle_group' => $this->vehiclegroup_model->get_all(),
                'vehicle_engine_no' => set_value('vehicle_engine_no'),
                'vehicle_engine_capacity' => set_value('vehicle_engine_capacity'),
                'dropdown_vehicle_engine_capacity' => $this->enginecapacity_model->get_all(),
                'vehicle_activity_statusid' => set_value('vehicle_activity_statusid'),
                'activity_status' => $this->vehicle_model->get_all_activity_status(),
                'vehicle_application_date' => set_value('vehicle_application_date'),
                'vehicle_others' => set_value('vehicle_others'),
                'vehicle_blacklistedremark' => set_value('vehicle_blacklistedremark'),
                'vehicle_distance_color' => set_value('vehicle_distance_color'),
            ];
            $this->content = 'vehicle/vehicle_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function create_action()
    {
          $vehicle_group = $this->input->post('vehicle_group', true);
        if ($this->permission->cp_create == true) {

            if($vehicle_group=="99"){
             $this->createrules_other();
            }else{
             $this->createrules();
            }


            if ($this->form_validation->run() == false) {
                $this->create();
            } else {

/*            if($this->input->post('vehicle_type', true)=='AV'){
            $distance_color = $this->input->post('vehicle_distance_color', true);
            }else{
            $distance_color = '';
            }*/


            if($vehicle_group=="99"){
            $otherequipment_data = [
            'vehiclegroup_name'=>strtoupper($this->input->post('other_equipment', true)),
            'vehiclegroup_created_at' => date('Y-m-d H:i:s'),
            'vehiclegroup_lastchanged_by' => $this->session->userdata('id'),
            ];
             $this->vehiclegroup_model->insert($otherequipment_data);
             $vehicle_group = $this->db->insert_id();
            }

                $data = [
                    'vehicle_company_id' => $this->input->post('vehicle_company_id', true),
                    'vehicle_registration_no' => strtoupper($this->input->post('vehicle_registration_no', true)),
                    'vehicle_type' => $this->input->post('vehicle_type', true),
                    'vehicle_group' => $vehicle_group,
/*                    'vehicle_insurance_policy_no' => $this->input->post('vehicle_insurance_policy_no', true),
                    'vehicle_insurance_expiry_date' => dateserver($this->input->post('vehicle_insurance_expiry_date', true)),*/
                    /*'vehicle_vehicleequipmenttype_id' => $this->input->post('vehicle_vehicleequipmenttype_id', true),*/
                    /*'vehicle_parkingarea_id' => $this->input->post('vehicle_parkingarea_id', true),*/
                    'vehicle_year_manufacture' => $this->input->post('vehicle_year_manufacture', true),
                    'vehicle_chasis_no' => strtoupper($this->input->post('vehicle_chasis_no', true)),
                    'vehicle_enginetype_id' => $this->input->post('vehicle_enginetype_id', true),
                    'vehicle_engine_no' => strtoupper($this->input->post('vehicle_engine_no', true)),
                    'vehicle_engine_capacity' => $this->input->post('vehicle_engine_capacity', true),
                    'vehicle_activity_statusid' => 1,
                    'vehicle_application_date' => $this->input->post('vehicle_application_date', true),
/*                    'vehicle_others' => $this->input->post('vehicle_others', true), */
                    'vehicle_blacklistedremark' => $this->input->post('vehicle_blacklistedremark', true),
/*                    'vehicle_distance_color' => $distance_color,*/
                    'vehicle_created_at' => date('Y-m-d H:i:s'),
                    'vehicle_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->vehicle_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('vehicle'));
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
            $row = $this->vehicle_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('vehicle/update_action'),
                    'id' => $id,
                    'vehicle_company_id' => set_value('vehicle_company_id', $row->vehicle_company_id),
                    'company' => $this->vehicle_model->get_all_company(),
                    'vehicle_registration_no' => set_value('vehicle_registration_no', $row->vehicle_registration_no),
                    'vehicle_type' => set_value('vehicle_type', $row->vehicle_type),
                    'dropdown_vehicle_type' => [
                        (object) ['id' => 'AV', 'value' => 'Airside'], (object) ['id' => 'EV', 'value' => 'Terminal'],
                    ],
                    'vehicle_group' => set_value('vehicle_group', $row->vehicle_group),
                    'other_equipment' => set_value('other_equipment'),
                    'dropdown_vehicle_group' => $this->vehiclegroup_model->get_all(),
                    'vehicle_insurance_policy_no' => set_value('vehicle_insurance_policy_no', $row->vehicle_insurance_policy_no),
                    'vehicle_insurance_expiry_date' => set_value('vehicle_insurance_expiry_date', $row->vehicle_insurance_expiry_date),
                    'vehicle_vehicleequipmenttype_id' => set_value('vehicle_vehicleequipmenttype_id', $row->vehicle_vehicleequipmenttype_id),
                    'vehicleequipmenttype' => $this->vehicle_model->get_all_vehicleequipmenttype(),
/*                    'vehicle_parkingarea_id' => set_value('vehicle_parkingarea_id', $row->vehicle_parkingarea_id),
                    'parkingarea' => $this->vehicle_model->get_all_parkingarea(),*/
                    'vehicle_year_manufacture' => set_value('vehicle_year_manufacture', $row->vehicle_year_manufacture),
                    'vehicle_chasis_no' => set_value('vehicle_chasis_no', $row->vehicle_chasis_no),
                    'vehicle_enginetype_id' => set_value('vehicle_enginetype_id', $row->vehicle_enginetype_id),
                    'enginetype' => $this->vehicle_model->get_all_enginetype(),
                    'vehicle_engine_no' => set_value('vehicle_engine_no', $row->vehicle_engine_no),
                    'vehicle_engine_capacity' => set_value('vehicle_engine_capacity', $row->vehicle_engine_capacity),
                    'dropdown_vehicle_engine_capacity' => $this->enginecapacity_model->get_all(),
                    'vehicle_activity_statusid' => set_value('vehicle_activity_statusid', $row->vehicle_activity_statusid),
                    'activity_status' => $this->vehicle_model->get_all_activity_status(),
                    'vehicle_application_date' => set_value('vehicle_application_date', $row->vehicle_application_date),
                    'vehicle_others' => set_value('vehicle_others', $row->vehicle_others),
                    'vehicle_blacklistedremark' => set_value('vehicle_blacklistedremark', $row->vehicle_blacklistedremark),
'vehicle_distance_color' => set_value('vehicle_distance_color', $row->vehicle_distance_color),

                ];
                $this->content = 'vehicle/vehicle_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vehicle'));
            }

        } else {
            redirect('/');
        }

    }

    public function update_action()
    {
         $vehicle_group = $this->input->post('vehicle_group', true);
        if ($this->permission->cp_update == true) {
            if($vehicle_group=="99"){
             $this->updaterules_other();
            }else{
             $this->updaterules();
            }


            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('vehicle_id', true));
            } else {

/*             if($this->input->post('vehicle_type', true)=='AV'){
            $distance_color = $this->input->post('vehicle_distance_color', true);
            }else{
            $distance_color = '';
            }*/

            if($vehicle_group=="99"){
            $otherequipment_data = [
            'vehiclegroup_name'=>strtoupper($this->input->post('other_equipment', true)),
            ];
             $this->vehiclegroup_model->insert($otherequipment_data);
             $vehicle_group = $this->db->insert_id();
            }
                $data = [
                    'vehicle_company_id' => $this->input->post('vehicle_company_id', true),
                    'vehicle_registration_no' => strtoupper($this->input->post('vehicle_registration_no', true)),
                    'vehicle_type' => $this->input->post('vehicle_type', true),
                    'vehicle_group' => $vehicle_group,
/*                    'vehicle_insurance_policy_no' => $this->input->post('vehicle_insurance_policy_no', true),
                    'vehicle_insurance_expiry_date' => dateserver($this->input->post('vehicle_insurance_expiry_date', true)),*/
                    /*'vehicle_vehicleequipmenttype_id' => $this->input->post('vehicle_vehicleequipmenttype_id', true),*/
                   /* 'vehicle_parkingarea_id' => $this->input->post('vehicle_parkingarea_id', true),*/
                    'vehicle_year_manufacture' => $this->input->post('vehicle_year_manufacture', true),
                    'vehicle_chasis_no' => strtoupper($this->input->post('vehicle_chasis_no', true)),
                    'vehicle_enginetype_id' => $this->input->post('vehicle_enginetype_id', true),
                    'vehicle_engine_no' => strtoupper($this->input->post('vehicle_engine_no', true)),
                    'vehicle_engine_capacity' => $this->input->post('vehicle_engine_capacity', true),
                    /*'vehicle_activity_statusid' => $this->input->post('vehicle_activity_statusid', true),*/
                    'vehicle_application_date' => $this->input->post('vehicle_application_date', true),
/*                    'vehicle_others' => $this->input->post('vehicle_others', true),*/
                    'vehicle_blacklistedremark' => $this->input->post('vehicle_blacklistedremark', true),
/*                    'vehicle_distance_color' => $distance_color,*/
                    'vehicle_updated_at' => date('Y-m-d H:i:s'),
                    'vehicle_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->vehicle_model->update(fixzy_decoder($this->input->post('vehicle_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('vehicle'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->vehicle_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->vehicle_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('vehicle'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vehicle'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->vehicle_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'vehicle_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->vehicle_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('vehicle'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vehicle'));
            }

        } else {
            redirect('/');
        }

    }

    public function updaterules()
    {
        $this->form_validation->set_rules('vehicle_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_registration_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_type', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_year_manufacture', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_chasis_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_enginetype_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_engine_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_engine_capacity', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('vehicle_application_date', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_blacklistedremark', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_group', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function updaterules_other()
    {
        $this->form_validation->set_rules('vehicle_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_registration_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_type', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_year_manufacture', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_chasis_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_enginetype_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_engine_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_engine_capacity', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('vehicle_application_date', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_blacklistedremark', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_group', ' ', 'trim|required');
        $this->form_validation->set_rules('other_equipment', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function createrules()
    {
        $this->form_validation->set_rules('vehicle_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_registration_no', ' ', 'trim|required|callback_notexist_vehicle');
        $this->form_validation->set_rules('vehicle_type', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_year_manufacture', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_chasis_no', ' ', 'trim|required|callback_notexist_chasisno');
        $this->form_validation->set_rules('vehicle_enginetype_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_engine_no', ' ', 'trim|required|callback_notexist_engineno');
        $this->form_validation->set_rules('vehicle_engine_capacity', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('vehicle_application_date', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_blacklistedremark', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_group', ' ', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
        $this->form_validation->set_message('notexist_vehicle','Vehicle already registered');

        $this->form_validation->set_message('notexist_chasisno','Chassis number already in used');
        $this->form_validation->set_message('notexist_engineno',' Engine number already in used');
    }

    public function createrules_other()
    {
        $this->form_validation->set_rules('vehicle_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_registration_no', ' ', 'trim|required|callback_notexist_vehicle');
        $this->form_validation->set_rules('vehicle_type', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_year_manufacture', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_chasis_no', ' ', 'trim|required|callback_notexist_chasisno');
        $this->form_validation->set_rules('vehicle_enginetype_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_engine_no', ' ', 'trim|required|callback_notexist_engineno');
        $this->form_validation->set_rules('vehicle_engine_capacity', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('vehicle_application_date', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_blacklistedremark', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_group', ' ', 'trim|required');
        $this->form_validation->set_rules('other_equipment', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
        $this->form_validation->set_message('notexist_vehicle','Vehicle already registered');

        $this->form_validation->set_message('notexist_chasisno','Chassis number already in used');
        $this->form_validation->set_message('notexist_engineno',' Engine number already in used');
    }

function notexist_vehicle($str)
{
   $field_value = $str; //this is redundant, but it's to show you how
   if($this->vehicle_model->notexist_vehicle($field_value)==0)
   {
     return TRUE;
   }
   else
   {
     return FALSE;
   }
}

function notexist_chasisno($str)
{
   $field_value = $str; //this is redundant, but it's to show you how
   if($this->vehicle_model->notexist_chasisno($field_value)==0)
   {
     return TRUE;
   }
   else
   {
     return FALSE;
   }
}

function notexist_engineno($str)
{
   $field_value = $str; //this is redundant, but it's to show you how
   if($this->vehicle_model->notexist_engineno($field_value)==0)
   {
     return TRUE;
   }
   else
   {
     return FALSE;
   }
}

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'vehicle_id',
            'vehicle_company_id',
            'vehicle_registration_no',
            'vehicle_type',
            'vehicle_group',
            'vehicle_insurance_policy_no',
            'vehicle_insurance_expiry_date',
            'vehicle_vehicleequipmenttype_id',
            /*'vehicle_parkingarea_id',*/
            'vehicle_year_manufacture',
            'vehicle_chasis_no',
            'vehicle_enginetype_id',
            'vehicle_engine_no',
            'vehicle_engine_capacity',
            'vehicle_activity_statusid',
            'vehicle_application_date',
            'vehicle_blacklistedremark',

        ];
        $results = $this->vehicle_model->listajax(
            $columns,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value']
            //$columns[$this->input->get('order')[0]['column']],
            //$this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";
            $can_delete = "";
/*                      if($this->permission->cp_read == true){
$rud .=  anchor(site_url('vehicle/read/'.fixzy_encoder($r['vehicle_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
' ';
}*/
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('vehicle/update/' . fixzy_encoder($r['vehicle_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
/*            if ($this->permission->cp_update == true) {
                $rud .= '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' .
                    ' ';
            }*/
/*                if($this->permission->cp_delete == true){
$rud .= anchor(site_url('vehicle/delete/'.fixzy_encoder($r['vehicle_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
}*/

            if ($r['activity_status_name_vehicle_activity_statusid']=='Active'){
                 $officialstatus = '<span class="label label-success">Vehicle with no active permit attached</span>';
$can_delete = '<a href="/vehicle/delete/' . fixzy_encoder($r['vehicle_id']) . '" onclick="javasciprt:return confirm(\'' .$this->lang->line('delete_alert'). '\')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>';
            }elseif($r['activity_status_name_vehicle_activity_statusid']=='Expiry'){
                 $officialstatus =  '<span class="label label-primary">Vehicle previous permit is not renewed</span>';
            }elseif($r['activity_status_name_vehicle_activity_statusid']=='In-active'){
                 $officialstatus =  '<span class="label label-warning">Vehicle had premit before and no longer serving the company</span>';
            }elseif($r['activity_status_name_vehicle_activity_statusid']=='Suspended'){
                 $officialstatus =  '<span class="label label-danger">The vehicle has suspended permit</span>';
            }elseif($r['activity_status_name_vehicle_activity_statusid']=='Not Completed'){
                 $officialstatus =  '<span class="label label-warning">Permit in Progress => Vehicle has an active permit in progress</span>';
            }elseif($r['activity_status_name_vehicle_activity_statusid']=='Permit Active'){
                 $officialstatus =  '<span class="label label-primary"> Vehicle has active permit attached</span>';
            }elseif($r['activity_status_name_vehicle_activity_statusid']=='Expired Soon'){
                 $officialstatus =  '<span class="label label-primary">Vehicle has active permit attached but permit is expiring</span>';
            }else{
                $officialstatus = $r['activity_status_name_vehicle_activity_statusid'];
            }

            array_push($data, [
                $i,
/*                $r['company_name_vehicle_company_id'],*/
                '<a href="/vehicle/show/'.fixzy_encoder($r['vehicle_id']).'">'.$r['vehicle_registration_no'].'</a>',
                $r['vehicle_type'],
                $r['vehicle_name'],
/*              $r['vehicle_insurance_policy_no'],
$r['vehicle_insurance_expiry_date'],
$r['vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id'],
$r['parkingarea_name_vehicle_parkingarea_id'],
$r['vehicle_year_manufacture'],
$r['vehicle_chasis_no'],
$r['enginetype_name_vehicle_enginetype_id'],
$r['vehicle_engine_no'],
$r['vehicle_engine_capacity'],*/
                /*$officialstatus,*/
                /*$r['vehicle_application_date'],*/
                '<a href="/vehicle/update/' . fixzy_encoder($r['vehicle_id']) . '"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a> '.$can_delete,
/*              $r['vehicle_blacklistedremark'],*/

/*                $rud  */

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->vehicle_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->vehicle_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function companyvehicle($type='')
    {
        $data = $this->vehicle_model->get_companyvehicle($type);

        $string = $this->load->view('vehicle/companyvehicle', ['data' => $data]);
    }

    public function verify($id)
    {
        $data = $this->vehicle_model->get_verifyvehicle($id);

        echo $data->vehicle_activity_statusid;
        //print_r($data) ;
    }

    function show($id)
    {
        if ($this->permission->cp_create == true && !empty($id)) {

            $this->load->model('Enforcement_model');
            $this->load->model('Offendlist_model');
            $id = fixzy_decoder($id);

            $vehicle_det = $this->Enforcement_model->vehicle_detail($id);
            if(!isset($vehicle_det) || empty($vehicle_det) )
            {
                redirect('vehicle');
                die();
            }

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            unset($_SESSION['offense_detail']);
            $offend_list = $this->Offendlist_model->category_sort_inarray();
            $history_list = $this->Enforcement_model->get_history_vehicle($id);
            $all_permit = $this->Enforcement_model->find_vehicle_all_permit($id);
            
            $data = [
                'button' => 'Enforcement Notice (Vehicle)',
                'action' => '',//site_url('enforcement/create_vehicle_action'),
                'permission' => $this->permission,
                'ids' => $id,//set_value('ids'),
                'offend_list' => $offend_list,
                'history_list' => $history_list,
                'permits_list' => $all_permit,
                'vehicle_det' => $vehicle_det,
                //'driver_photo' => _PIC_URL.'uploads/files/'.$this->Enforcement_model->get_driver_photo($id),
                'merit_point_txt' => $this->Enforcement_model->sum_merit_point(2,$id),
            ];
            $this->content = 'vehicle/vehicle_show';
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

}
;
/* End of file Vehicle.php */
/* Location: ./application/controllers/Vehicle.php */
