<?php

class Upload extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        // Load the helpers
        $this->load->helper(['form', 'url']);
    }

    public function index()
    {

        // Load the form
        //$this->load->view('templates/header');
        $this->load->view('upload/upload_form', ['error' => ' ']);
        //$this->load->view('templates/footer');
    }

    /**
     * Multiple upload functionality will fallback to CodeIgniters default do_upload()
     * method so configuration is backwards compatible between do_upload() and the new do_multi_upload()
     * method provided by Multi File Upload extension.
     *
     */
    public function do_upload()
    {

        // Detect form submission.
        if ($this->input->post('submit')) {
            if ($this->input->post('filetype') == "video") {
                $path = './resources/shared_video/';
            } else {
                $path = './resources/shared_img/';
            }

            $this->load->library('upload');

            /**
             * Refer to https://ellislab.com/codeigniter/user-guide/libraries/file_uploading.html
             * for full argument documentation.
             *
             */
            // Define file rules
            if ($this->input->post('filetype') == "video") {
                $this->upload->initialize([
                    "upload_path" => $path,
                    "allowed_types" => "mp4|avi|ogv",
                    "max_size" => '50000', //50mb
                    /*                "max_width"         =>  '1024',
                "max_height"        =>  '768' */
                ]);
            } else {
                $this->upload->initialize([
                    "upload_path" => $path,
                    "allowed_types" => "gif|jpg|png",
                    "max_size" => '5000', //5mb
                    "max_width" => '1024',
                    "max_height" => '768'
                ]);
            }

            if ($this->upload->do_multi_upload("uploadfile")) {

                $data['upload_data'] = $this->upload->get_multi_upload_data();

                if ($this->input->post('filetype') == "video") {
                    echo $data['upload_data'][0]['file_name'] . '*' . $data['upload_data'][0]['file_size'] . '*' . $data['upload_data'][0]['file_ext'];
                } else {
                    echo $data['upload_data'][0]['file_name'] . '*' . 'success';
                }
            } else {
                // Output the errors
                $errors = ['error' => $this->upload->display_errors('<p class = "bg-danger">',
                    '</p>')];

                foreach ($errors as $k => $error) {
                    echo $error . '*' . 'failed';
                }
            }
        } else {
            echo '<p class = "bg-danger">An error occured, please try again later.</p>' . '*' . 'failed';
        }
        // Exit to avoid further execution
        exit();
    }
}
