<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Uploadfiles extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('uploadfiles_model');
        $this->lang->load('uploadfiles_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $uploadfiles = $this->uploadfiles_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'uploadfiles_data' => $uploadfiles,
                'permission' => $this->permission,
            ];

            $this->content = 'uploadfiles/uploadfiles_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function avp_inspectordoc($vehicleid, $permitid = '', $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = '../uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();
                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']     = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'avp_inspectordoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                    $uploadData[$i]['uploadfiles_permit_id']    = $permitid;
                }
            }
            //print_r($uploadData)  ; exit;
            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);

                // Upload status message
                $statusMsg = $insert ? 'Files uploaded successfully.' : 'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_avp_inspectordoc($vehicleid,$permitid);
        $data['processtype'] = 'avp_inspectordoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function evp_inspectordoc($vehicleid, $permitid = '', $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = '../uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();
                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']     = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'evp_inspectordoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                    $uploadData[$i]['uploadfiles_permit_id']    = $permitid;
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);

                // Upload status message
                $statusMsg = $insert ? 'Files uploaded successfully.' : 'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_evp_inspectordoc($vehicleid,$permitid);
        $data['processtype'] = 'evp_inspectordoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function wip_inspectordoc($vehicleid, $permitid = '', $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = '../uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();
                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']     = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'wip_inspectordoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                    $uploadData[$i]['uploadfiles_permit_id']    = $permitid;
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);

                // Upload status message
                $statusMsg = $insert ? 'Files uploaded successfully.' : 'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_wip_inspectordoc($vehicleid,$permitid);
        $data['processtype'] = 'wip_inspectordoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function shins_inspectordoc($vehicleid, $permitid = '', $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = '../uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();
                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']     = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'shins_inspectordoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                    $uploadData[$i]['uploadfiles_permit_id']    = $permitid;
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);

                // Upload status message
                $statusMsg = $insert ? 'Files uploaded successfully.' : 'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_shins_inspectordoc($vehicleid,$permitid);
        $data['processtype'] = 'shins_inspectordoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
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
            $row = $this->uploadfiles_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'uploadfiles_filename' => $row->uploadfiles_filename,
                    'uploadfiles_filesize' => $row->uploadfiles_filesize,
                    'uploadfiles_ext' => $row->uploadfiles_ext,
                    'uploadfiles_type' => $row->uploadfiles_type,
                    'uploadfiles_company_id' => $row->company_name_uploadfiles_company_id,
                    'uploadfiles_permit_id' => $row->permit_bookingid_uploadfiles_permit_id,
                    'uploadfiles_driver_id' => $row->driver_name_uploadfiles_driver_id,
                    'uploadfiles_vehicle_id' => $row->vehicle_registration_no_uploadfiles_vehicle_id,
                    'uploadfiles_fixedfacilities_id' => $row->fixedfacilitiespermit_recent_permitno_uploadfiles_fixedfacilities_id,
                    'uploadfiles_processtype' => $row->uploadfiles_processtype,

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

                    $this->content = 'uploadfiles/uploadfiles_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('uploadfiles/uploadfiles_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('uploadfiles'));
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
                'action' => site_url('uploadfiles/create_action'),
                'uploadfiles_filename' => set_value('uploadfiles_filename'),
                'uploadfiles_filesize' => set_value('uploadfiles_filesize'),
                'uploadfiles_ext' => set_value('uploadfiles_ext'),
                'uploadfiles_type' => set_value('uploadfiles_type'),
                'uploadfiles_company_id' => set_value('uploadfiles_company_id'),
                'company' => $this->uploadfiles_model->get_all_company(),
                'uploadfiles_permit_id' => set_value('uploadfiles_permit_id'),
                'permit' => $this->uploadfiles_model->get_all_permit(),
                'uploadfiles_driver_id' => set_value('uploadfiles_driver_id'),
                'driver' => $this->uploadfiles_model->get_all_driver(),
                'uploadfiles_vehicle_id' => set_value('uploadfiles_vehicle_id'),
                'vehicle' => $this->uploadfiles_model->get_all_vehicle(),
                'uploadfiles_fixedfacilities_id' => set_value('uploadfiles_fixedfacilities_id'),
                'fixedfacilitiespermit' => $this->uploadfiles_model->get_all_fixedfacilitiespermit(),
                'uploadfiles_processtype' => set_value('uploadfiles_processtype'),

            ];
            $this->content = 'uploadfiles/uploadfiles_form';
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
                    'uploadfiles_filename' => $this->input->post('uploadfiles_filename', true),
                    'uploadfiles_filesize' => $this->input->post('uploadfiles_filesize', true),
                    'uploadfiles_ext' => $this->input->post('uploadfiles_ext', true),
                    'uploadfiles_type' => $this->input->post('uploadfiles_type', true),
                    'uploadfiles_company_id' => $this->input->post('uploadfiles_company_id', true),
                    'uploadfiles_permit_id' => $this->input->post('uploadfiles_permit_id', true),
                    'uploadfiles_driver_id' => $this->input->post('uploadfiles_driver_id', true),
                    'uploadfiles_vehicle_id' => $this->input->post('uploadfiles_vehicle_id', true),
                    'uploadfiles_fixedfacilities_id' => $this->input->post('uploadfiles_fixedfacilities_id', true),
                    'uploadfiles_processtype' => $this->input->post('uploadfiles_processtype', true),
                    'uploadfiles_created_at' => date('Y-m-d H:i:s'),
                    'uploadfiles_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->uploadfiles_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('uploadfiles'));
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
            $row = $this->uploadfiles_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('uploadfiles/update_action'),
                    'id' => $id,
                    'uploadfiles_filename' => set_value('uploadfiles_filename', $row->uploadfiles_filename),
                    'uploadfiles_filesize' => set_value('uploadfiles_filesize', $row->uploadfiles_filesize),
                    'uploadfiles_ext' => set_value('uploadfiles_ext', $row->uploadfiles_ext),
                    'uploadfiles_type' => set_value('uploadfiles_type', $row->uploadfiles_type),
                    'uploadfiles_company_id' => set_value('uploadfiles_company_id', $row->uploadfiles_company_id),
                    'company' => $this->uploadfiles_model->get_all_company(),
                    'uploadfiles_permit_id' => set_value('uploadfiles_permit_id', $row->uploadfiles_permit_id),
                    'permit' => $this->uploadfiles_model->get_all_permit(),
                    'uploadfiles_driver_id' => set_value('uploadfiles_driver_id', $row->uploadfiles_driver_id),
                    'driver' => $this->uploadfiles_model->get_all_driver(),
                    'uploadfiles_vehicle_id' => set_value('uploadfiles_vehicle_id', $row->uploadfiles_vehicle_id),
                    'vehicle' => $this->uploadfiles_model->get_all_vehicle(),
                    'uploadfiles_fixedfacilities_id' => set_value('uploadfiles_fixedfacilities_id', $row->uploadfiles_fixedfacilities_id),
                    'fixedfacilitiespermit' => $this->uploadfiles_model->get_all_fixedfacilitiespermit(),
                    'uploadfiles_processtype' => set_value('uploadfiles_processtype', $row->uploadfiles_processtype),

                ];
                $this->content = 'uploadfiles/uploadfiles_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('uploadfiles'));
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
                $this->update($this->input->post('uploadfiles_id', true));
            } else {
                $data = [
                    'uploadfiles_filename' => $this->input->post('uploadfiles_filename', true),
                    'uploadfiles_filesize' => $this->input->post('uploadfiles_filesize', true),
                    'uploadfiles_ext' => $this->input->post('uploadfiles_ext', true),
                    'uploadfiles_type' => $this->input->post('uploadfiles_type', true),
                    'uploadfiles_company_id' => $this->input->post('uploadfiles_company_id', true),
                    'uploadfiles_permit_id' => $this->input->post('uploadfiles_permit_id', true),
                    'uploadfiles_driver_id' => $this->input->post('uploadfiles_driver_id', true),
                    'uploadfiles_vehicle_id' => $this->input->post('uploadfiles_vehicle_id', true),
                    'uploadfiles_fixedfacilities_id' => $this->input->post('uploadfiles_fixedfacilities_id', true),
                    'uploadfiles_processtype' => $this->input->post('uploadfiles_processtype', true),
                    'uploadfiles_updated_at' => date('Y-m-d H:i:s'),
                    'uploadfiles_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->uploadfiles_model->update(fixzy_decoder($this->input->post('uploadfiles_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('uploadfiles'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->uploadfiles_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->uploadfiles_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('uploadfiles'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('uploadfiles'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->uploadfiles_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'uploadfiles_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->uploadfiles_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('uploadfiles'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('uploadfiles'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('uploadfiles_filename', ' ', 'trim|required');
        $this->form_validation->set_rules('uploadfiles_filesize', ' ', 'trim|required');
        $this->form_validation->set_rules('uploadfiles_ext', ' ', 'trim');
        $this->form_validation->set_rules('uploadfiles_type', ' ', 'trim|required');
        $this->form_validation->set_rules('uploadfiles_company_id', ' ', 'trim|integer');
        $this->form_validation->set_rules('uploadfiles_permit_id', ' ', 'trim|integer');
        $this->form_validation->set_rules('uploadfiles_driver_id', ' ', 'trim|integer');
        $this->form_validation->set_rules('uploadfiles_vehicle_id', ' ', 'trim|integer');
        $this->form_validation->set_rules('uploadfiles_fixedfacilities_id', ' ', 'trim|integer');
        $this->form_validation->set_rules('uploadfiles_processtype', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'uploadfiles_id',
            'uploadfiles_filename',
            'uploadfiles_filesize',
            'uploadfiles_ext',
            'uploadfiles_type',
            'uploadfiles_company_id',
            'uploadfiles_permit_id',
            'uploadfiles_driver_id',
            'uploadfiles_vehicle_id',
            'uploadfiles_fixedfacilities_id',
            'uploadfiles_processtype',

        ];
        $results = $this->uploadfiles_model->listajax(
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
                $rud .= anchor(site_url('uploadfiles/read/' . fixzy_encoder($r['uploadfiles_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('uploadfiles/update/' . fixzy_encoder($r['uploadfiles_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('uploadfiles/delete/' . fixzy_encoder($r['uploadfiles_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['uploadfiles_filename'],
                $r['uploadfiles_filesize'],
                $r['uploadfiles_ext'],
                $r['uploadfiles_type'],
                $r['company_name_uploadfiles_company_id'],
                $r['permit_bookingid_uploadfiles_permit_id'],
                $r['driver_name_uploadfiles_driver_id'],
                $r['vehicle_registration_no_uploadfiles_vehicle_id'],
                $r['fixedfacilitiespermit_recent_permitno_uploadfiles_fixedfacilities_id'],
                $r['uploadfiles_processtype'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->uploadfiles_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->uploadfiles_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Uploadfiles.php */
/* Location: ./application/controllers/Uploadfiles.php */
