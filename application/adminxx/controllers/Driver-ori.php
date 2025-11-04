<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Driver extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('driver_model');
        $this->lang->load('driver_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $driver = $this->driver_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'driver_data' => $driver,
                'permission' => $this->permission,
            ];

            $this->content = 'driver/driver_list';
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
            $row = $this->driver_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'driver_name' => $row->driver_name,
                    'driver_dob' => $row->driver_dob,
                    'driver_ic' => $row->driver_ic,
                    'driver_designation' => $row->driver_designation,
                    'driver_department' => $row->driver_department,
                    'driver_nationality_country_id' => $row->ref_country_name_driver_nationality_country_id,
                    'driver_address' => $row->driver_address,
                    'driver_officeno' => $row->driver_officeno,
                    'driver_hpno' => $row->driver_hpno,
                    'driver_email' => $row->driver_email,
                    'driver_drivinglicenseno' => $row->driver_drivinglicenseno,
                    'driver_drivingclass' => $row->driver_drivingclass,
                    'driver_licenseexpirydate' => $row->driver_licenseexpirydate,
                    'driver_blacklistedremark' => $row->driver_blacklistedremark,
                    'driver_permit_typeid' => $row->driver_permit_typeid,
                    'driver_activity_statusid' => $row->driver_activity_statusid,
                    'driver_application_date' => $row->driver_application_date,

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

                    $this->content = 'driver/driver_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('driver/driver_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('driver'));
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
                'action' => site_url('driver/create_action'),
                'driver_name' => set_value('driver_name'),
                'driver_company_id' => set_value('driver_company_id'),
                'driver_dob' => set_value('driver_dob'),
                'driver_ic' => set_value('driver_ic'),
                'driver_designation' => set_value('driver_designation'),
                'driver_department' => set_value('driver_department'),
                'driver_nationality_country_id' => set_value('driver_nationality_country_id'),
                'ref_country' => $this->driver_model->get_all_ref_country(),
                'driver_address' => set_value('driver_address'),
                'driver_officeno' => set_value('driver_officeno'),
                'driver_hpno' => set_value('driver_hpno'),
                'driver_email' => set_value('driver_email'),
                'driver_drivinglicenseno' => set_value('driver_drivinglicenseno'),
                'driver_drivingclass' => set_value('driver_drivingclass'),
                'driver_licenseexpirydate' => set_value('driver_licenseexpirydate'),
                'driver_blacklistedremark' => set_value('driver_blacklistedremark'),
                'driver_permit_typeid' => set_value('driver_permit_typeid'),
                'driver_activity_statusid' => set_value('driver_activity_statusid'),
                'driver_application_date' => set_value('driver_application_date'),

            ];
            $this->content = 'driver/driver_form';
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
                    'driver_name' => $this->input->post('driver_name', true),
                    'driver_company_id' => $this->input->post('driver_company_id', true),
                    'driver_dob' => $this->input->post('driver_dob', true),
                    'driver_ic' => $this->input->post('driver_ic', true),
                    'driver_designation' => $this->input->post('driver_designation', true),
                    'driver_department' => $this->input->post('driver_department', true),
                    'driver_nationality_country_id' => $this->input->post('driver_nationality_country_id', true),
                    'driver_address' => $this->input->post('driver_address', true),
                    'driver_officeno' => $this->input->post('driver_officeno', true),
                    'driver_hpno' => $this->input->post('driver_hpno', true),
                    'driver_email' => $this->input->post('driver_email', true),
                    'driver_drivinglicenseno' => $this->input->post('driver_drivinglicenseno', true),
                    'driver_drivingclass' => $this->input->post('driver_drivingclass', true),
                    'driver_licenseexpirydate' => $this->input->post('driver_licenseexpirydate', true),
                    'driver_blacklistedremark' => $this->input->post('driver_blacklistedremark', true),
                    'driver_permit_typeid' => $this->input->post('driver_permit_typeid', true),
                    'driver_activity_statusid' => $this->input->post('driver_activity_statusid', true),
                    'driver_application_date' => $this->input->post('driver_application_date', true),
                    'driver_created_at' => date('Y-m-d H:i:s'),
                    'driver_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->driver_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('driver'));
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
            $row = $this->driver_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('driver/update_action'),
                    'id' => $id,
                    'driver_name' => set_value('driver_name', $row->driver_name),
                    'driver_company_id' => set_value('driver_company_id', $row->driver_company_id),
                    'driver_dob' => set_value('driver_dob', $row->driver_dob),
                    'driver_ic' => set_value('driver_ic', $row->driver_ic),
                    'driver_designation' => set_value('driver_designation', $row->driver_designation),
                    'driver_department' => set_value('driver_department', $row->driver_department),
                    'driver_nationality_country_id' => set_value('driver_nationality_country_id', $row->driver_nationality_country_id),
                    'ref_country' => $this->driver_model->get_all_ref_country(),
                    'driver_address' => set_value('driver_address', $row->driver_address),
                    'driver_officeno' => set_value('driver_officeno', $row->driver_officeno),
                    'driver_hpno' => set_value('driver_hpno', $row->driver_hpno),
                    'driver_email' => set_value('driver_email', $row->driver_email),
                    'driver_drivinglicenseno' => set_value('driver_drivinglicenseno', $row->driver_drivinglicenseno),
                    'driver_drivingclass' => set_value('driver_drivingclass', $row->driver_drivingclass),
                    'driver_licenseexpirydate' => set_value('driver_licenseexpirydate', $row->driver_licenseexpirydate),
                    'driver_blacklistedremark' => set_value('driver_blacklistedremark', $row->driver_blacklistedremark),
                    'driver_permit_typeid' => set_value('driver_permit_typeid', $row->driver_permit_typeid),
                    'driver_activity_statusid' => set_value('driver_activity_statusid', $row->driver_activity_statusid),
                    'driver_application_date' => set_value('driver_application_date', $row->driver_application_date),

                ];
                $this->content = 'driver/driver_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('driver'));
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
                $this->update($this->input->post('driver_id', true));
            } else {
                $data = [
                    'driver_name' => $this->input->post('driver_name', true),
                    'driver_company_id' => $this->input->post('driver_company_id', true),
                    'driver_dob' => $this->input->post('driver_dob', true),
                    'driver_ic' => $this->input->post('driver_ic', true),
                    'driver_designation' => $this->input->post('driver_designation', true),
                    'driver_department' => $this->input->post('driver_department', true),
                    'driver_nationality_country_id' => $this->input->post('driver_nationality_country_id', true),
                    'driver_address' => $this->input->post('driver_address', true),
                    'driver_officeno' => $this->input->post('driver_officeno', true),
                    'driver_hpno' => $this->input->post('driver_hpno', true),
                    'driver_email' => $this->input->post('driver_email', true),
                    'driver_drivinglicenseno' => $this->input->post('driver_drivinglicenseno', true),
                    'driver_drivingclass' => $this->input->post('driver_drivingclass', true),
                    'driver_licenseexpirydate' => $this->input->post('driver_licenseexpirydate', true),
                    'driver_updated_at' => date('Y-m-d H:i:s'),
                    'driver_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->driver_model->update(fixzy_decoder($this->input->post('driver_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('driver'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->driver_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->driver_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('driver'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('driver'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->driver_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'driver_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->driver_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('driver'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('driver'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('driver_name', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('driver_dob', ' ', 'trim');
        $this->form_validation->set_rules('driver_ic', ' ', 'trim|required|callback_notexist_driver');
        $this->form_validation->set_rules('driver_designation', ' ', 'trim');
        $this->form_validation->set_rules('driver_department', ' ', 'trim');
        $this->form_validation->set_rules('driver_nationality_country_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('driver_address', ' ', 'trim');
        $this->form_validation->set_rules('driver_officeno', ' ', 'trim');
        $this->form_validation->set_rules('driver_hpno', ' ', 'trim');
        $this->form_validation->set_rules('driver_email', ' ', 'trim');
        $this->form_validation->set_rules('driver_drivinglicenseno', ' ', 'trim');
        $this->form_validation->set_rules('driver_drivingclass', ' ', 'trim');
        $this->form_validation->set_rules('driver_licenseexpirydate', ' ', 'trim');
        $this->form_validation->set_rules('driver_blacklistedremark', ' ', 'trim');
        $this->form_validation->set_rules('driver_permit_typeid', ' ', 'trim|integer');
        $this->form_validation->set_rules('driver_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('driver_application_date', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
        $this->form_validation->set_message('notexist_driver','User already exist');
    }

function notexist_driver($str)
{
   $field_value = $str; //this is redundant, but it's to show you how
   if($this->driver_model->notexist_driver($field_value)==0)
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
            'driver_id',
            'driver_name',
            'driver_company_id',
            'driver_dob',
            'driver_ic',
            'driver_designation',
            'driver_department',
            'driver_nationality_country_id',
            'driver_address',
            'driver_officeno',
            'driver_hpno',
            'driver_email',
            'driver_drivinglicenseno',
            'driver_drivingclass',
            'driver_licenseexpirydate',
            'driver_blacklistedremark',
            'driver_permit_typeid',
            'driver_activity_statusid',
            'driver_application_date',

        ];
        $results = $this->driver_model->listajax(
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
                $rud .= anchor(site_url('driver/read/' . fixzy_encoder($r['driver_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('driver/update/' . fixzy_encoder($r['driver_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('driver/delete/' . fixzy_encoder($r['driver_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['driver_name'],
                /*$r['driver_dob'],*/
                $r['driver_ic'],
/*              $r['driver_designation'],
$r['driver_department'],
$r['ref_country_name_driver_nationality_country_id'],
$r['driver_address'],
$r['driver_officeno'],
$r['driver_hpno'],
$r['driver_email'],
$r['driver_jpjdrivinglicenseno'],
$r['driver_jpjdrivingclass'],
$r['driver_jpjlicenseexpirydate'],
$r['driver_drivinglicenseno'],
$r['driver_drivingclass'],
$r['driver_licenseexpirydate'],
$r['driver_blacklistedremark'],*/
                $r['permit_group_name_driver_permit_typeid'],
                $r['activity_status_name_driver_activity_statusid'],
                $r['driver_application_date'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->driver_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->driver_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Driver.php */
/* Location: ./application/controllers/Driver.php */
