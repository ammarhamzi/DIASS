<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fullcalendar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fullcalendar_model');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {

        $config = $this->my_model->get_value("config", "config_value",
            "config_deleted_at IS NULL and config_name = 'authentication'");

        if ($config->config_value == "y" && !$this->session->userdata('islogin')) {
            redirect(site_url('Authentication'));
        } else {
            $data = [
                'fullcalendar_event' => json_encode($this->fullcalendar_model->get_all()),
            ];
            $setting = [
                'method' => 'modalpage',
                'patern' => 'list',
            ];

            $this->content = 'foundation/fullcalendar';
            $this->layout($data, $setting);
        }
    }

    public function insert()
    {
        $data = [
            'calendar_title' => $this->input->post('dbtitle'),
            'calendar_start' => $this->input->post('dbstart'),
            'calendar_end' => $this->input->post('dbend'),
        ];
        $this->fullcalendar_model->insert($data);
    }

    public function update()
    {
        $data = [
            'calendar_title' => $this->input->post('dbtitle'),
        ];
        $this->fullcalendar_model->update($this->input->post('id'), $data);
    }
}
