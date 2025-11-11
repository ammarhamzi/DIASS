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
        $this->load->model('uploadfiles_model');
        $this->load->model('pic_model');
        $this->lang->load('driver_lang', $this->session->userdata('language'));

    }

    public function index()
    {
        //$this->uploadfiles_model->delete_unusedfiles_driver();
        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$driver = $this->driver_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'driver_data' => $driver,
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
                    'driver_displayname' => $row->driver_displayname,
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

/*    public function create()
{

if ($this->permission->cp_create == true) {

$setting = [
'method' => 'newpage',
'patern' => 'form',
];
$data = [
'button' => 'Create',
'action' => site_url('driver/create_action'),
'driver_id' => set_value('driver_id'),
'driver_name' => set_value('driver_name'),
'driver_displayname' => set_value('driver_displayname'),
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
//'driver_drivertype' => set_value('driver_drivertype'),

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

$this->createrules();

if ($this->form_validation->run() == false) {
$this->create();
} else {

$driver_photo = $this->input->post('driver_photo', true);
$driver_info = $this->input->post('driver_info', true);
$all_doc = explode(",", $driver_photo . ',' . $driver_info);

$data = [
'driver_name' => strtoupper($this->input->post('driver_name', true)),
'driver_displayname' => strtoupper($this->input->post('driver_displayname', true)),
'driver_company_id' => $this->input->post('driver_company_id', true),
'driver_dob' => dateserver($this->input->post('driver_dob', true)),
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
'driver_licenseexpirydate' => dateserver($this->input->post('driver_licenseexpirydate', true)),
'driver_blacklistedremark' => $this->input->post('driver_blacklistedremark', true),
'driver_permit_typeid' => $this->input->post('driver_permit_typeid', true),
'driver_activity_statusid' => $this->input->post('driver_activity_statusid', true),
'driver_application_date' => $this->input->post('driver_application_date', true),
//'driver_drivertype' => $this->input->post('driver_drivertype', true),
'driver_created_at' => date('Y-m-d H:i:s'),
'driver_lastchanged_by' => $this->session->userdata('id'),
];
$this->driver_model->insert($data);
$primary_id = $this->db->insert_id();
// $this->logQueries($this->config->item('dblog'));

foreach ($all_doc as $doc) {
$this->uploadfiles_model->update($doc, ['uploadfiles_driver_id' => $primary_id]);

}
//$this->session->set_flashdata('message', 'Please update driver photo & others compulsory documents');
//$this->update(fixzy_encoder($primary_id));
$this->session->set_flashdata('message', 'Create Record Success');
redirect(site_url('driver'));
}

} else {
redirect('/');
}

}*/

    public function update($id)
    {
        //$this->output->enable_profiler(true);
        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $row = $this->driver_model->get_by_id(fixzy_decoder($id));
            $driverhistory = $this->driver_model->get_all_companyhistory(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $adppermitdriver = $this->driver_model->get_by_adpdriver_id(fixzy_decoder($id));
                $evdppermitdriver = $this->driver_model->get_by_evdpdriver_id(fixzy_decoder($id));
                if ($adppermitdriver != null)
                {
                $adp = $adppermitdriver[0];
                }
                if ($evdppermitdriver != null)
                {
                $evdp = $evdppermitdriver[0];
                }
                $dh = $driverhistory;
                $adpserialno='';
                $adppermitstatus='';
                $adppermitofficialstatus='';
                if($adppermitdriver != null)
                {
                    $adpserialno = $adp->permit_issuance_serialno;
                    $adppermitstatus = $adp->permit_status;
                    $adppermitofficialstatus = $adp->permit_status_desc;
                }
                $evdpserialno='';
                $evdppermitstatus='';
                $evdppermitofficialstatus='';
                if($evdppermitdriver != null)
                {
                    $evdpserialno = $evdp->permit_issuance_serialno;
                    $evdppermitstatus = $evdp->permit_status;
                    $evdppermitofficialstatus = $evdp->permit_status_desc;
                }
                $data = [
                    'adppermitno' => $adpserialno,
                    'adppermitstatus' => $adppermitstatus,
                    'adppermitstatusdesc' => $adppermitofficialstatus,
                    'evdppermitno' => $evdpserialno,
                    'evdppermitstatus' => $evdppermitstatus,
                    'evdppermitstatusdesc' => $evdppermitofficialstatus,
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('driver/update_action'),
                    'id' => $id,
                    'driver_id' => fixzy_decoder($id),
                    'driver_name' => set_value('driver_name', $row->driver_name),
                    'driver_displayname' => set_value('driver_displayname', $row->driver_displayname),
                    'driver_company_id' => set_value('driver_company_id', $row->driver_company_id),
                    'company' => $this->pic_model->get_all_company(),
                    'companyhistory' => $dh, //$this->driver_model->get_all_companyhistory(fixzy_decoder($id)),
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
                    /* 'driver_drivertype' => set_value('driver_drivertype', $row->driver_drivertype),*/

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

            $this->updaterules();

            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('driver_id', true));
            } else {
                $newcompany = $this->input->post('driver_company_id_dummy', true);
                if($newcompany == null)
                    $newcompany = $this->input->post('driver_company_id', true);
                $now  = date('Y-m-d H:i:s');
                $data = [
                    'driver_name' => $this->input->post('driver_name', true),
                    'driver_displayname' => $this->input->post('driver_displayname', true),
                    'driver_company_id' => $newcompany, //$this->input->post('driver_company_id', true),
                    'driver_dob' => dateserver($this->input->post('driver_dob', true)),
                    'driver_ic' => $this->input->post('driver_ic', true),
                    'driver_designation' => $this->input->post('driver_designation', true),
                    'driver_department' => $this->input->post('driver_department', true),
                    'driver_nationality_country_id' => $this->input->post('driver_nationality_country_id', true),
                    'driver_address' => $this->input->post('driver_address', true),
                    // 'driver_officeno' => $this->input->post('driver_officeno', true),
                    'driver_hpno' => $this->input->post('driver_hpno', true),
                    'driver_email' => $this->input->post('driver_email', true),
                    'driver_drivinglicenseno' => $this->input->post('driver_drivinglicenseno', true),
                    'driver_drivingclass' => $this->input->post('driver_drivingclass', true),
                    'driver_licenseexpirydate' => dateserver($this->input->post('driver_licenseexpirydate', true)),
                    //'driver_drivertype' => $this->input->post('driver_drivertype', true),
                    'driver_blacklistedremark' => $this->input->post('driver_blacklistedremark', true),
                    'driver_updated_at' => $now,
                    'driver_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->driver_model->update(fixzy_decoder($this->input->post('driver_id')), $data);

                $updatemessage='Update Record Success';
                // record history

                //if ($this->input->post('driver_company_id', true) != $this->input->post('driver_company_id_ori', true)) {
                if ($newcompany != $this->input->post('driver_company_id_ori', true)) {
                    $datahistory = [
                        'drivercompanyhistory_driver_id' => fixzy_decoder($this->input->post('driver_id')),
                        'drivercompanyhistory_company_id' => $this->input->post('driver_company_id_ori', true),
                        'drivercompanyhistory_created_at' => $now,
                        'drivercompanyhistory_lastchanged_by' => $this->session->userdata('id'),
                    ];

                    $this->driver_model->createhistory($datahistory);
                    $updatemessage = 'Change of Company and Update Record Success';
                }
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', $updatemessage);
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

    public function updaterules()
    {
        $this->form_validation->set_rules('driver_name', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_displayname', ' ', 'trim|required');
        //$this->form_validation->set_rules('driver_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('driver_dob', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_ic', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_designation', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_department', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_nationality_country_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('driver_address', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_officeno', ' ', 'trim');
        $this->form_validation->set_rules('driver_hpno', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_email', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_drivinglicenseno', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_drivingclass', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_licenseexpirydate', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_blacklistedremark', ' ', 'trim');
        $this->form_validation->set_rules('driver_permit_typeid', ' ', 'trim|integer');
        $this->form_validation->set_rules('driver_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('driver_application_date', ' ', 'trim');
        /*$this->form_validation->set_rules('driver_drivertype', ' ', 'trim|required');*/
/*        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required');
$this->form_validation->set_rules('driver_info', ' ', 'trim|required');*/

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');

    }

    public function createrules()
    {
        $this->form_validation->set_rules('driver_name', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_displayname', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('driver_dob', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_ic', ' ', 'trim|required|callback_notexist_driver');
        $this->form_validation->set_rules('driver_designation', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_department', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_nationality_country_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('driver_address', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_officeno', ' ', 'trim');
        $this->form_validation->set_rules('driver_hpno', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_email', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_drivinglicenseno', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_drivingclass', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_licenseexpirydate', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_blacklistedremark', ' ', 'trim');
        $this->form_validation->set_rules('driver_permit_typeid', ' ', 'trim|integer');
        $this->form_validation->set_rules('driver_activity_statusid', ' ', 'trim|integer');
        $this->form_validation->set_rules('driver_application_date', ' ', 'trim');
        /*$this->form_validation->set_rules('driver_drivertype', ' ', 'trim|required');*/
        $this->form_validation->set_rules('driver_photo', ' ', 'trim|required');
        $this->form_validation->set_rules('driver_info', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
        $this->form_validation->set_message('notexist_driver', 'Driver already registered');
    }

    public function notexist_driver($str)
    {
        $field_value = $str; //this is redundant, but it's to show you how
        if ($this->driver_model->notexist_driver($field_value) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
//        $columns = [
//            'driver_id',
//            'driver_name',
//            'driver_company_id',
//            'driver_dob',
//            'driver_ic',
//            'driver_designation',
//            'driver_department',
//            'driver_nationality_country_id',
//            'driver_address',
//            'driver_officeno',
//            'driver_hpno',
//            'driver_email',
//            'driver_drivinglicenseno',
//            'driver_drivingclass',
//            'driver_licenseexpirydate',
//            'driver_blacklistedremark',
//            /*'driver_drivertype',*/
//            'driver_permit_typeid',
//            'driver_activity_statusid',
//            'driver_application_date',
//
//        ];
        $columns = [
            'driver_id',
            'driver_company_id',
            'driver_name',
            'driver_ic',
            'driver_activity_statusid',
            'driver_application_date',
            
            'driver_dob',
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
            /*'driver_drivertype',*/
            'driver_permit_typeid',
            
            

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
            $rud        = "";
            $can_delete = "";
/*                      if($this->permission->cp_read == true){
$rud .=  anchor(site_url('driver/read/'.fixzy_encoder($r['driver_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
' ';
}*/
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('admin/driver/update/' . fixzy_encoder($r['driver_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
/*            if ($this->permission->cp_update == true) {
$rud .= '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' .
' ';
}*/
/*                if($this->permission->cp_delete == true){
$rud .= anchor(site_url('driver/delete/'.fixzy_encoder($r['driver_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
}*/

            if ($r['activity_status_name_driver_activity_statusid'] == 'Active') {
                $officialstatus = '<span class="label label-success">New</span>';
                $can_delete     = '<a href="/admin/driver/delete/' . fixzy_encoder($r['driver_id']) . '" onclick="javasciprt:return confirm(\'' . $this->lang->line('delete_alert') . '\')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>';
            } elseif ($r['activity_status_name_driver_activity_statusid'] == 'Expiry') {
                $officialstatus = '<span class="label label-primary">' . $r['activity_status_name_driver_activity_statusid'] . '</span>';
            } elseif ($r['activity_status_name_driver_activity_statusid'] == 'In-active') {
                $officialstatus = '<span class="label label-warning">' . $r['activity_status_name_driver_activity_statusid'] . '</span>';
            } elseif ($r['activity_status_name_driver_activity_statusid'] == 'Suspended') {
                $officialstatus = '<span class="label label-danger">' . $r['activity_status_name_driver_activity_statusid'] . '</span>';
            } elseif ($r['activity_status_name_driver_activity_statusid'] == 'Not Completed') {
                $officialstatus = '<span class="label label-warning">' . $r['activity_status_name_driver_activity_statusid'] . '</span>';
            }

            array_push($data, [
                $i,
                '<a href="/admin/company/read/' . fixzy_encoder($r['company_id']) . '">' . $r['company_name'] . '</a>',
                '<a href="/admin/driver/show/' . fixzy_encoder($r['driver_id']) . '">' . $r['driver_name'] . '</a>',
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
                /* $r['driver_drivertype'],*/
                /*$officialstatus,*/
                datelocal($r['driver_application_date']),
                '<a href="/admin/driver/update/' . fixzy_encoder($r['driver_id']) . '"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a> ' . $can_delete,
/*                $rud */

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->driver_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->driver_model->recordsFiltered($columns,
                        $this->input->get('search')['value'])->recordsfiltered,
                
                'data' => $data
            ]
        );
    }

    public function companydriver($type  = '')
    {
        $data = $this->driver_model->get_companydriver($type);

        $string = $this->load->view('driver/companydriver', ['data' => $data]);
    }

    public function verify($id)
    {
        $data = $this->driver_model->get_verifydriver($id);

        echo $data->driver_activity_statusid;
        //print_r($data) ;
    }

    public function show($id)
    {
        if ($this->permission->cp_create == true && !empty($id)) {

            $this->load->model('Enforcement_model');
            $this->load->model('Offendlist_model');
            $id = fixzy_decoder($id);

            $driver_det = $this->Enforcement_model->driver_detail($id);
            if (!isset($driver_det) || empty($driver_det)) {
                redirect('driver');
                die();
            }

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];

            unset($_SESSION['offense_detail']);
            $offend_list         = $this->Offendlist_model->category_sort_inarray();
            $history_list        = $this->Enforcement_model->get_history_driver($id);
            $permits_list        = $this->Enforcement_model->find_driver_all_permit($id);
            $companyhistory_list = $this->driver_model->get_all_companyhistory($id);

            $this->load->model('uploadfiles_model');
            $driver_file_list = $this->uploadfiles_model->get_driver_info($id);

            $data = [
                'button' => 'Driver',
                'action' => '',
                'permission' => $this->permission,
                'ids' => $id, //set_value('ids'),
                'offend_list' => $offend_list,
                'driver_det' => $driver_det,
                'history_list' => $history_list,
                'permits_list' => $permits_list,
                'companyhistory_list' => $companyhistory_list,
                'driver_file_list' => $driver_file_list,
                'driver_photo' => base_url().'../uploads/files/'.$this->Enforcement_model->get_driver_photo($id),
                'merit_point_txt' => $this->Enforcement_model->sum_merit_point(1, $id),
            ];
            $this->content = 'driver/driver_show';
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

}
;
/* End of file Driver.php */
/* Location: ./application/controllers/Driver.php */
