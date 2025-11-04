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
        $this->lang->load('vehicle_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $vehicle = $this->vehicle_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'vehicle_data' => $vehicle,
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
                    'vehicle_parkingarea_id' => $row->parkingarea_name_vehicle_parkingarea_id,
                    'vehicle_year_manufacture' => $row->vehicle_year_manufacture,
                    'vehicle_chasis_no' => $row->vehicle_chasis_no,
                    'vehicle_enginetype_id' => $row->enginetype_name_vehicle_enginetype_id,
                    'vehicle_engine_no' => $row->vehicle_engine_no,
                    'vehicle_engine_capacity' => $row->vehicle_engine_capacity,
                    'vehicle_activity_statusid' => $row->activity_status_name_vehicle_activity_statusid,
                    'vehicle_application_date' => $row->vehicle_application_date,
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
                    (object) ['id' => 'AV', 'value' => 'Airside Vehicle'], (object) ['id' => 'EV', 'value' => 'Electrical Vehicle'],
                ],
                'vehicle_insurance_policy_no' => set_value('vehicle_insurance_policy_no'),
                'vehicle_insurance_expiry_date' => set_value('vehicle_insurance_expiry_date'),
                'vehicle_vehicleequipmenttype_id' => set_value('vehicle_vehicleequipmenttype_id'),
                'vehicleequipmenttype' => $this->vehicle_model->get_all_vehicleequipmenttype(),
                'vehicle_parkingarea_id' => set_value('vehicle_parkingarea_id'),
                'parkingarea' => $this->vehicle_model->get_all_parkingarea(),
                'vehicle_year_manufacture' => set_value('vehicle_year_manufacture'),
                'vehicle_chasis_no' => set_value('vehicle_chasis_no'),
                'vehicle_enginetype_id' => set_value('vehicle_enginetype_id'),
                'enginetype' => $this->vehicle_model->get_all_enginetype(),
                'vehicle_engine_no' => set_value('vehicle_engine_no'),
                'vehicle_engine_capacity' => set_value('vehicle_engine_capacity'),
                'vehicle_activity_statusid' => set_value('vehicle_activity_statusid'),
                'activity_status' => $this->vehicle_model->get_all_activity_status(),
                'vehicle_application_date' => set_value('vehicle_application_date'),
                'vehicle_blacklistedremark' => set_value('vehicle_blacklistedremark'),

            ];
            $this->content = 'vehicle/vehicle_form';
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
                    'vehicle_company_id' => $this->input->post('vehicle_company_id', true),
                    'vehicle_registration_no' => $this->input->post('vehicle_registration_no', true),
                    'vehicle_type' => $this->input->post('vehicle_type', true),
                    'vehicle_insurance_policy_no' => $this->input->post('vehicle_insurance_policy_no', true),
                    'vehicle_insurance_expiry_date' => $this->input->post('vehicle_insurance_expiry_date', true),
                    'vehicle_vehicleequipmenttype_id' => $this->input->post('vehicle_vehicleequipmenttype_id', true),
                    'vehicle_parkingarea_id' => $this->input->post('vehicle_parkingarea_id', true),
                    'vehicle_year_manufacture' => $this->input->post('vehicle_year_manufacture', true),
                    'vehicle_chasis_no' => $this->input->post('vehicle_chasis_no', true),
                    'vehicle_enginetype_id' => $this->input->post('vehicle_enginetype_id', true),
                    'vehicle_engine_no' => $this->input->post('vehicle_engine_no', true),
                    'vehicle_engine_capacity' => $this->input->post('vehicle_engine_capacity', true),
                    'vehicle_activity_statusid' => $this->input->post('vehicle_activity_statusid', true),
                    'vehicle_application_date' => $this->input->post('vehicle_application_date', true),
                    'vehicle_blacklistedremark' => $this->input->post('vehicle_blacklistedremark', true),
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
                        (object) ['id' => 'AV', 'value' => 'Airside Vehicle'], (object) ['id' => 'EV', 'value' => 'Electrical Vehicle'],
                    ],
                    'vehicle_insurance_policy_no' => set_value('vehicle_insurance_policy_no', $row->vehicle_insurance_policy_no),
                    'vehicle_insurance_expiry_date' => set_value('vehicle_insurance_expiry_date', $row->vehicle_insurance_expiry_date),
                    'vehicle_vehicleequipmenttype_id' => set_value('vehicle_vehicleequipmenttype_id', $row->vehicle_vehicleequipmenttype_id),
                    'vehicleequipmenttype' => $this->vehicle_model->get_all_vehicleequipmenttype(),
                    'vehicle_parkingarea_id' => set_value('vehicle_parkingarea_id', $row->vehicle_parkingarea_id),
                    'parkingarea' => $this->vehicle_model->get_all_parkingarea(),
                    'vehicle_year_manufacture' => set_value('vehicle_year_manufacture', $row->vehicle_year_manufacture),
                    'vehicle_chasis_no' => set_value('vehicle_chasis_no', $row->vehicle_chasis_no),
                    'vehicle_enginetype_id' => set_value('vehicle_enginetype_id', $row->vehicle_enginetype_id),
                    'enginetype' => $this->vehicle_model->get_all_enginetype(),
                    'vehicle_engine_no' => set_value('vehicle_engine_no', $row->vehicle_engine_no),
                    'vehicle_engine_capacity' => set_value('vehicle_engine_capacity', $row->vehicle_engine_capacity),
                    'vehicle_activity_statusid' => set_value('vehicle_activity_statusid', $row->vehicle_activity_statusid),
                    'activity_status' => $this->vehicle_model->get_all_activity_status(),
                    'vehicle_application_date' => set_value('vehicle_application_date', $row->vehicle_application_date),
                    'vehicle_blacklistedremark' => set_value('vehicle_blacklistedremark', $row->vehicle_blacklistedremark),

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

        if ($this->permission->cp_update == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('vehicle_id', true));
            } else {
                $data = [
                    'vehicle_company_id' => $this->input->post('vehicle_company_id', true),
                    'vehicle_registration_no' => $this->input->post('vehicle_registration_no', true),
                    'vehicle_type' => $this->input->post('vehicle_type', true),
                    'vehicle_insurance_policy_no' => $this->input->post('vehicle_insurance_policy_no', true),
                    'vehicle_insurance_expiry_date' => $this->input->post('vehicle_insurance_expiry_date', true),
                    'vehicle_vehicleequipmenttype_id' => $this->input->post('vehicle_vehicleequipmenttype_id', true),
                    'vehicle_parkingarea_id' => $this->input->post('vehicle_parkingarea_id', true),
                    'vehicle_year_manufacture' => $this->input->post('vehicle_year_manufacture', true),
                    'vehicle_chasis_no' => $this->input->post('vehicle_chasis_no', true),
                    'vehicle_enginetype_id' => $this->input->post('vehicle_enginetype_id', true),
                    'vehicle_engine_no' => $this->input->post('vehicle_engine_no', true),
                    'vehicle_engine_capacity' => $this->input->post('vehicle_engine_capacity', true),
                    'vehicle_activity_statusid' => $this->input->post('vehicle_activity_statusid', true),
                    'vehicle_application_date' => $this->input->post('vehicle_application_date', true),
                    'vehicle_blacklistedremark' => $this->input->post('vehicle_blacklistedremark', true),
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

    public function _rules()
    {
        $this->form_validation->set_rules('vehicle_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_registration_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_type', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_insurance_policy_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_insurance_expiry_date', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_vehicleequipmenttype_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_parkingarea_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_year_manufacture', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_chasis_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_enginetype_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vehicle_engine_no', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_engine_capacity', ' ', 'trim|required');
        $this->form_validation->set_rules('vehicle_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('vehicle_application_date', ' ', 'trim');
        $this->form_validation->set_rules('vehicle_blacklistedremark', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'vehicle_id',
            'vehicle_company_id',
            'vehicle_registration_no',
            'vehicle_type',
            'vehicle_insurance_policy_no',
            'vehicle_insurance_expiry_date',
            'vehicle_vehicleequipmenttype_id',
            'vehicle_parkingarea_id',
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
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";
            if ($this->permission->cp_read == true) {
                $rud .= anchor(site_url('vehicle/read/' . fixzy_encoder($r['vehicle_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('vehicle/update/' . fixzy_encoder($r['vehicle_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('vehicle/delete/' . fixzy_encoder($r['vehicle_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
/*                $r['company_name_vehicle_company_id'],*/
                $r['vehicle_registration_no'],
                $r['vehicle_type'],
/*              $r['vehicle_insurance_policy_no'],
$r['vehicle_insurance_expiry_date'],
$r['vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id'],
$r['parkingarea_name_vehicle_parkingarea_id'],
$r['vehicle_year_manufacture'],
$r['vehicle_chasis_no'],
$r['enginetype_name_vehicle_enginetype_id'],
$r['vehicle_engine_no'],
$r['vehicle_engine_capacity'],*/
                $r['activity_status_name_vehicle_activity_statusid'],
                $r['vehicle_application_date'],
/*              $r['vehicle_blacklistedremark'],*/

                $rud

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

}
;
/* End of file Vehicle.php */
/* Location: ./application/controllers/Vehicle.php */
