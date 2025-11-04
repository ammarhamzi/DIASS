<?php defined('BASEPATH') or exit('No direct script access allowed');

class Uploadfiles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load session library
        $this->load->library('session');

        // Load file model
        $this->load->model('uploadfiles_model');
    }

    public function adp_requireddoc($driverid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                $files_name = $this->input->post('files_name');

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // echo $_FILES['file']['name'].' || '.$files_name[$i].'<br />';

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    
                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('adp_requireddoc','uploadfiles_driver_id',$driverid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }
                    
                    /*=====  End of MAL edit  ======*/

                    //insert
                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'adp_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_adp_requireddoc($driverid);
        $data['processtype'] = 'adp_requireddoc';
        $data['filelist'] = [
          // 'Recent photograph',
          'Copy of IC/Passport',
          'Driving License (JPJ/International)',
          'KLIA/KLIA2 Airport Pass',
          'Supporting letter from employer',
          'Special Equipment support documents',
          'Working Permit (Foreigner)',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function file_updatedocname(){
    $id = $this->input->post('id');
    $updatethis = $this->input->post('updatethis');
     $this->uploadfiles_model->update($id,['uploadfiles_docname'=>$updatethis]);
    }

    public function adp_trainercert($driverid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'adp_trainercert';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_adp_trainercert($driverid);
        $data['processtype'] = 'adp_trainercert';

        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function driver_photo($driverid = NULL, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';

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
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'driver_photo';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
				// else
				// {
					// echo $this->upload->display_errors();
				// }
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
        $data['files']       = $this->uploadfiles_model->get_driver_photo($driverid);
        $data['processtype'] = 'driver_photo';
        $data['show_image']  = 'show_image';

        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function evdp_requireddoc($driverid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();
 
                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');

                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('evdp_requireddoc','uploadfiles_driver_id',$driverid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }

                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'evdp_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_evdp_requireddoc($driverid);
        $data['processtype'] = 'evdp_requireddoc';
        $data['filelist'] = [
            // 'Recent photograph',
            // 'IC/Passport/Working Permit/Employment Pass',
            // 'KLIA/KLIA2 Airport Pass',
            // 'Support letter from employer/company',
            'Copy of IC/Passport',
            'Driving License (JPJ/International)',
            'KLIA/KLIA2 Airport Pass',
            'Supporting letter from employer',
            'Special Equipment support documents',
            'Working Permit (Foreigner)',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function driver_info($driverid = NULL, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'driver_info';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_driver_info($driverid);
        $data['processtype'] = 'driver_info';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function avp_requireddoc($vehicleid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');
                    
                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('avp_requireddoc','uploadfiles_vehicle_id',$vehicleid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }
                    
                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']     = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'avp_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_avp_requireddoc($vehicleid);
        $data['processtype'] = 'avp_requireddoc';
        $data['filelist'] = [
            // 'letter of employer/owner',
            // 'letter of award/contract',
            // 'registration card/proof of purchase',
            // 'previous vehicle service sheet',
            // 'PUSPAKOM Cert',
            'Letter of employer/owner',
            'Letter of award/contract',
            'Registration card/proof of purchase',
            'Previous Vehicle Service Sheet or PUSPAKOM Cert',
            'Perakuan kelayakan mesin angkat (PMA)',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function avp_insurancedoc($vehicleid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $name = $_FILES['files']['tmp_name'];
            $filesCount = count($_FILES['files']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';
                $config['file_size'] = '3072';
                $config['max_size'] = '8192';

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
                    $uploadData[$i]['uploadfiles_processtype']    = 'avp_insurancedoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_avp_insurancedoc($vehicleid);
        $data['processtype'] = 'avp_insurancedoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function evp_insurancedoc($vehicleid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_processtype']    = 'evp_insurancedoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_evp_insurancedoc($vehicleid);
        $data['processtype'] = 'evp_insurancedoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function evp_requireddoc($vehicleid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');
                    
                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('evp_requireddoc','uploadfiles_vehicle_id',$vehicleid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }
                    
                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']     = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'evp_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_evp_requireddoc($vehicleid);
        $data['processtype'] = 'evp_requireddoc';
        $data['filelist'] = [
            'Letter of employer/owner',
            'Registration card/proof of purchase',
            'Previous Vehicle Service Sheet or PUSPAKOM Cert',
            'Perakuan kelayakan mesin angkat (PMA)',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function permit_termination($permitid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_permit_id']      = $permitid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'permit_termination';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_permit_termination($permitid);
        $data['processtype'] = 'permit_termination';

        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function permit_replacement($permitid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_permit_id']      = $permitid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'permit_replacement';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_permit_replacement($permitid);
        $data['processtype'] = 'permit_replacement';

        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function pbb_requireddoc($driverid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                $files_name = $this->input->post('files_name');

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    
                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('pbb_requireddoc','uploadfiles_driver_id',$driverid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }
                    
                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'pbb_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_pbb_requireddoc($driverid);
        $data['processtype'] = 'pbb_requireddoc';
        $data['filelist'] = [
            // 'Recent photograph',
            // 'IC/Passport/Working Permit/Employment Pass',
            // 'KLIA/KLIA2 Airport Pass',
            // 'Supporting letter from employer',
            'Copy of MA Sepang Permanent Pass',
            'On Job Training (OJT) Sheet',
            // 'Letter of employer',
            // 'Certificate of attendance',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function sh_requireddoc($vehicleid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');

                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('sh_requireddoc','uploadfiles_driver_id',$driverid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }

                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']      = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'sh_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_sh_requireddoc($vehicleid);
        $data['processtype'] = 'sh_requireddoc';
        $data['filelist'] = [
            'letter of employer/owner',
            'registration card/proof of purchase',
            'Supporting letter from company (stated reason for TEP application)',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function sh_insurancedoc($vehicleid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_processtype']    = 'sh_insurancedoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_sh_insurancedoc($vehicleid);
        $data['processtype'] = 'sh_insurancedoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function vdgs_requireddoc($driverid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                $files_name = $this->input->post('files_name');

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/

                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('vdgs_requireddoc','uploadfiles_driver_id',$driverid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }

                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'vdgs_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_vdgs_requireddoc($driverid);
        $data['processtype'] = 'vdgs_requireddoc';
        $data['filelist'] = [
            // 'Recent photograph',
            'IC/Passport/Working Permit/Employment Pass',
            'KLIA/KLIA2 Airport Pass',
            'Supporting letter from employer',
            // 'Copy of MA (Sepang) Permanent Pass',
            // 'Letter of employer',
            // 'Certificate of attendance',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function cs_requireddoc($vehicleid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');
                    
                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('cs_requireddoc','uploadfiles_vehicle_id',$vehicleid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }
                    
                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']      = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'cs_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_cs_requireddoc($vehicleid);
        $data['processtype'] = 'cs_requireddoc';
        $data['filelist'] = [
            'Letter of employer/owner',
            'Registration card/proof of purchase',
            'Offer letter (Proof of having job at KLIA/KLIA2)',
/*            'Previous Vehicle Service Sheet or PUSPAKOM Cert',
            'Perakuan kelayakan mesin angkat (PMA)',*/
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function cs_insurancedoc($vehicleid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_processtype']    = 'cs_insurancedoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_cs_insurancedoc($vehicleid);
        $data['processtype'] = 'cs_insurancedoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function gpu_requireddoc($driverid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');

                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('gpu_requireddoc','uploadfiles_driver_id',$driverid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }

                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'gpu_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_gpu_requireddoc($driverid);
        $data['processtype'] = 'gpu_requireddoc';
        $data['filelist'] = [
            // 'Recent photograph',
            'IC/Passport/Working Permit/Employment Pass',
            'KLIA/KLIA2 Airport Pass',
            'Supporting letter from employer',
            // 'Copy of MA (Sepang) Permanent Pass',
            // 'Letter of employer',
            // 'Certificate of attendance',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function pca_requireddoc($driverid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');

                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('pca_requireddoc','uploadfiles_driver_id',$driverid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }

                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_driver_id']      = $driverid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'pca_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_pca_requireddoc($driverid);
        $data['processtype'] = 'pca_requireddoc';
        $data['filelist'] = [
            // 'Recent photograph',
            'IC/Passport/Working Permit/Employment Pass',
            'KLIA/KLIA2 Airport Pass',
            'Supporting letter from employer',
            // 'Copy of MA (Sepang) Permanent Pass',
            // 'Letter of employer',
            // 'Certificate of attendance',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function wip_requireddoc($vehicleid, $deleteid = '')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');
                    
                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('wip_requireddoc','uploadfiles_vehicle_id',$vehicleid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }
                    
                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']     = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'wip_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if (!empty($deleteid)) {
            $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_wip_requireddoc($vehicleid);
        $data['processtype'] = 'wip_requireddoc';
        $data['filelist'] = [
            // 'letter of employer/owner',
            // 'letter of award/contract',
            // 'registration card/proof of purchase',
            // 'previous vehicle service sheet',
            // 'PUSPAKOM Cert',
            'Letter of employer/owner',
            'Letter of award/contract',
            'Registration card/proof of purchase',
            'Airside work permit',
            'Airside safety briefing attendance',
            'Previous Vehicle Service Sheet or PUSPAKOM Cert',
            'Perakuan kelayakan mesin angkat (PMA)',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function wip_insurancedoc($vehicleid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_processtype']    = 'wip_insurancedoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_wip_insurancedoc($vehicleid);
        $data['processtype'] = 'wip_insurancedoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function shins_requireddoc($vehicleid,$deleteid='')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_vehicle_id']      = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'shins_requireddoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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

        if(!empty($deleteid)){
        $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_shins_requireddoc($vehicleid);
        $data['processtype'] = 'shins_requireddoc';
        $data['filelist'] = [
            'letter of employer/owner',
            'letter of award/contract',
            'registration card/proof of purchase',
            'previous vehicle service sheet',
            'PUSPAKOM Cert',
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function shins_insurancedoc($vehicleid,$deleteid='')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_vehicle_id']      = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'shins_insurancedoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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

        if(!empty($deleteid)){
        $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_shins_insurancedoc($vehicleid);
        $data['processtype'] = 'shins_insurancedoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function wipbriefing_requireddoc($vehicleid,$deleteid='')
    {

        $data = [];
        // If file upload form submitted
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $res = 0;
            for ($i = 0; $i < $filesCount; $i++) {
                if(empty($_FILES['files']['name'][$i]))
                {
                    continue;
                }
                $_FILES['file']['name']     = date("YmdHis") . '--' . $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $uploadPath              = 'uploads/files/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|odt|odp|fodt|fodp';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData                                     = $this->upload->data();

                    /*================================
                    =            MAL edit            =
                    ================================*/
                    //file name
                    $files_name = $this->input->post('files_name');
                    
                    //=======For existing file
                    $selected_docname = $files_name[$i];
                    $check_existing_id = $this->uploadfiles_model->check_existing_file('wipbriefing_requireddoc','uploadfiles_vehicle_id',$vehicleid,$selected_docname);
                    if($check_existing_id > 0)
                    {
                        $update_file_data['uploadfiles_filename']       = $fileData['file_name'];
                        $update_file_data['uploadfiles_filesize']       = $fileData['file_size'];
                        $update_file_data['uploadfiles_ext']            = $fileData['file_ext'];
                        $update_file_data['uploadfiles_type']           = $fileData['file_type'];
                        $update_file_data['uploadfiles_updated_at']     = date("Y-m-d H:i:s");
                        $update_file_data['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                        $q_update_file_data = $this->uploadfiles_model->update($check_existing_id, $update_file_data);
                        $res = 1;
                        continue; // skip insert script
                    }
                    
                    /*=====  End of MAL edit  ======*/

                    $uploadData[$i]['uploadfiles_filename']       = $fileData['file_name'];
                    $uploadData[$i]['uploadfiles_filesize']       = $fileData['file_size'];
                    $uploadData[$i]['uploadfiles_ext']            = $fileData['file_ext'];
                    $uploadData[$i]['uploadfiles_type']           = $fileData['file_type'];
                    $uploadData[$i]['uploadfiles_company_id']     = $this->session->userdata('companyid');
                    $uploadData[$i]['uploadfiles_vehicle_id']      = $vehicleid;
                    $uploadData[$i]['uploadfiles_processtype']    = 'wipbriefing_requireddoc';
                    $uploadData[$i]['uploadfiles_docname']        = $files_name[$i];
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
                }
            }

            if (!empty($uploadData)) {
                // Insert files data into the database
                $insert = $this->uploadfiles_model->insert($uploadData);
                $res = 1;
            }

            if($res == 1)
            {
                // Upload status message
                $statusMsg = 'Files uploaded successfully.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }

        if(!empty($deleteid)){
        $this->uploadfiles_model->delete($deleteid);
        }

        // Get files data from the database
        $data['files']       = $this->uploadfiles_model->get_wipbriefing_requireddoc($vehicleid);
        $data['processtype'] = 'wipbriefing_requireddoc';
        $data['filelist'] = [
            // 'letter of employer/owner',
            // 'registration card/proof of purchase',
            'Letter of employer/owner',
            'Registration card/proof of purchase',
            'Airside work permit',
            'Airside safety briefing attendance',
/*            'Previous Vehicle Service Sheet or PUSPAKOM Cert',
            'Perakuan kelayakan mesin angkat (PMA)',*/
        ];
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    public function wipbriefing_insurancedoc($vehicleid, $deleteid = '')
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
                $uploadPath              = 'uploads/files/';
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
                    $uploadData[$i]['uploadfiles_processtype']    = 'wipbriefing_insurancedoc';
                    $uploadData[$i]['uploadfiles_created_at']     = date("Y-m-d H:i:s");
                    $uploadData[$i]['uploadfiles_lastchanged_by'] = $this->session->userdata('id');
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
        $data['files']       = $this->uploadfiles_model->get_wipbriefing_insurancedoc($vehicleid);
        $data['processtype'] = 'wipbriefing_insurancedoc';
        // Pass the files data to view
        $this->load->view('upload_files/index', $data);
    }

    function remove_file($deleteid)
    {
        if(isset($deleteid) && $deleteid > 0)
        {
            $this->uploadfiles_model->delete($deleteid);
            // echo $this->db->last_query();
            echo json_encode(array('res'=>1,));
            die();
        }
        echo json_encode(array('res'=>0,));
    }

}
