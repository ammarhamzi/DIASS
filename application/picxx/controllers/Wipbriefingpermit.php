<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wipbriefingpermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wipbriefingpermit_model');
        $this->lang->load('wipbriefingpermit_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$wipbriefingpermit = $this->wipbriefingpermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'wipbriefingpermit_data' => $wipbriefingpermit,
                'permission' => $this->permission,
            ];

            $this->content = 'wipbriefingpermit/wipbriefingpermit_list';
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
            $row = $this->wipbriefingpermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'wipbriefingpermit_permit_id' => $row->wipbriefingpermit_permit_id,
                    'wipbriefingpermit_driver_id' => $row->wipbriefingpermit_driver_id,
                    'wipbriefingpermit_recent_permitno' => $row->wipbriefingpermit_recent_permitno,
                    'wipbriefingpermit_recent_expirydate' => $row->wipbriefingpermit_recent_expirydate,
                    'wipbriefingpermit_driveracknowledgement' => $row->wipbriefingpermit_driveracknowledgement,
                    'wipbriefingpermit_driveracknowledgement_date' => $row->wipbriefingpermit_driveracknowledgement_date,
                    'wipbriefingpermit_certbyemployer' => $row->wipbriefingpermit_certbyemployer,
                    'wipbriefingpermit_certbyemployer_date' => $row->wipbriefingpermit_certbyemployer_date,
                    'wipbriefingpermit_certbytrainer' => $row->wipbriefingpermit_certbytrainer,
                    'wipbriefingpermit_certbytrainer_date' => $row->wipbriefingpermit_certbytrainer_date,
                    'wipbriefingpermit_course_date' => $row->wipbriefingpermit_course_date,
                    'wipbriefingpermit_wipbriefingscheduled' => $row->wipbriefingpermit_wipbriefingscheduled,
                    'wipbriefingpermit_wipbriefingapproval' => $row->wipbriefingpermit_wipbriefingapproval,
                    'wipbriefingpermit_attendwipbriefing' => $row->wipbriefingpermit_attendwipbriefing,
                    'wipbriefingpermit_completed_docs' => $row->wipbriefingpermit_completed_docs,
                    'wipbriefingpermit_approvedby_airside' => $row->wipbriefingpermit_approvedby_airside,
                    'wipbriefingpermit_created_at' => $row->wipbriefingpermit_created_at,
                    'wipbriefingpermit_updated_at' => $row->wipbriefingpermit_updated_at,
                    'wipbriefingpermit_deleted_at' => $row->wipbriefingpermit_deleted_at,
                    'wipbriefingpermit_lastchanged_by' => $row->wipbriefingpermit_lastchanged_by,

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

                    $this->content = 'wipbriefingpermit/wipbriefingpermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('wipbriefingpermit/wipbriefingpermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingpermit'));
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
                'action' => site_url('wipbriefingpermit/create_action'),
                'wipbriefingpermit_permit_id' => set_value('wipbriefingpermit_permit_id'),
                'wipbriefingpermit_driver_id' => set_value('wipbriefingpermit_driver_id'),
                'wipbriefingpermit_recent_permitno' => set_value('wipbriefingpermit_recent_permitno'),
                'wipbriefingpermit_recent_expirydate' => set_value('wipbriefingpermit_recent_expirydate'),
                'wipbriefingpermit_driveracknowledgement' => set_value('wipbriefingpermit_driveracknowledgement'),
                'wipbriefingpermit_driveracknowledgement_date' => set_value('wipbriefingpermit_driveracknowledgement_date'),
                'wipbriefingpermit_certbyemployer' => set_value('wipbriefingpermit_certbyemployer'),
                'wipbriefingpermit_certbyemployer_date' => set_value('wipbriefingpermit_certbyemployer_date'),
                'wipbriefingpermit_certbytrainer' => set_value('wipbriefingpermit_certbytrainer'),
                'wipbriefingpermit_certbytrainer_date' => set_value('wipbriefingpermit_certbytrainer_date'),
                'wipbriefingpermit_course_date' => set_value('wipbriefingpermit_course_date'),
                'wipbriefingpermit_wipbriefingscheduled' => set_value('wipbriefingpermit_wipbriefingscheduled'),
                'wipbriefingpermit_wipbriefingapproval' => set_value('wipbriefingpermit_wipbriefingapproval'),
                'wipbriefingpermit_attendwipbriefing' => set_value('wipbriefingpermit_attendwipbriefing'),
                'wipbriefingpermit_completed_docs' => set_value('wipbriefingpermit_completed_docs'),
                'wipbriefingpermit_approvedby_airside' => set_value('wipbriefingpermit_approvedby_airside'),
                'wipbriefingpermit_created_at' => set_value('wipbriefingpermit_created_at'),
                'wipbriefingpermit_updated_at' => set_value('wipbriefingpermit_updated_at'),
                'wipbriefingpermit_deleted_at' => set_value('wipbriefingpermit_deleted_at'),
                'wipbriefingpermit_lastchanged_by' => set_value('wipbriefingpermit_lastchanged_by'),

            ];
            $this->content = 'wipbriefingpermit/wipbriefingpermit_form';
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
                    'wipbriefingpermit_permit_id' => $this->input->post('wipbriefingpermit_permit_id', true),
                    'wipbriefingpermit_driver_id' => $this->input->post('wipbriefingpermit_driver_id', true),
                    'wipbriefingpermit_recent_permitno' => $this->input->post('wipbriefingpermit_recent_permitno', true),
                    'wipbriefingpermit_recent_expirydate' => $this->input->post('wipbriefingpermit_recent_expirydate', true),
                    'wipbriefingpermit_driveracknowledgement' => $this->input->post('wipbriefingpermit_driveracknowledgement', true),
                    'wipbriefingpermit_driveracknowledgement_date' => $this->input->post('wipbriefingpermit_driveracknowledgement_date', true),
                    'wipbriefingpermit_certbyemployer' => $this->input->post('wipbriefingpermit_certbyemployer', true),
                    'wipbriefingpermit_certbyemployer_date' => $this->input->post('wipbriefingpermit_certbyemployer_date', true),
                    'wipbriefingpermit_certbytrainer' => $this->input->post('wipbriefingpermit_certbytrainer', true),
                    'wipbriefingpermit_certbytrainer_date' => $this->input->post('wipbriefingpermit_certbytrainer_date', true),
                    'wipbriefingpermit_course_date' => $this->input->post('wipbriefingpermit_course_date', true),
                    'wipbriefingpermit_wipbriefingscheduled' => $this->input->post('wipbriefingpermit_wipbriefingscheduled', true),
                    'wipbriefingpermit_wipbriefingapproval' => $this->input->post('wipbriefingpermit_wipbriefingapproval', true),
                    'wipbriefingpermit_attendwipbriefing' => $this->input->post('wipbriefingpermit_attendwipbriefing', true),
                    'wipbriefingpermit_completed_docs' => $this->input->post('wipbriefingpermit_completed_docs', true),
                    'wipbriefingpermit_approvedby_airside' => $this->input->post('wipbriefingpermit_approvedby_airside', true),
                    'wipbriefingpermit_created_at' => $this->input->post('wipbriefingpermit_created_at', true),
                    'wipbriefingpermit_updated_at' => $this->input->post('wipbriefingpermit_updated_at', true),
                    'wipbriefingpermit_deleted_at' => $this->input->post('wipbriefingpermit_deleted_at', true),
                    'wipbriefingpermit_lastchanged_by' => $this->input->post('wipbriefingpermit_lastchanged_by', true),
                    'wipbriefingpermit_created_at' => date('Y-m-d H:i:s'),
                    'wipbriefingpermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->wipbriefingpermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('wipbriefingpermit'));
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
            $row = $this->wipbriefingpermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('wipbriefingpermit/update_action'),
                    'id' => $id,
                    'wipbriefingpermit_permit_id' => set_value('wipbriefingpermit_permit_id', $row->wipbriefingpermit_permit_id),
                    'wipbriefingpermit_driver_id' => set_value('wipbriefingpermit_driver_id', $row->wipbriefingpermit_driver_id),
                    'wipbriefingpermit_recent_permitno' => set_value('wipbriefingpermit_recent_permitno', $row->wipbriefingpermit_recent_permitno),
                    'wipbriefingpermit_recent_expirydate' => set_value('wipbriefingpermit_recent_expirydate', $row->wipbriefingpermit_recent_expirydate),
                    'wipbriefingpermit_driveracknowledgement' => set_value('wipbriefingpermit_driveracknowledgement', $row->wipbriefingpermit_driveracknowledgement),
                    'wipbriefingpermit_driveracknowledgement_date' => set_value('wipbriefingpermit_driveracknowledgement_date', $row->wipbriefingpermit_driveracknowledgement_date),
                    'wipbriefingpermit_certbyemployer' => set_value('wipbriefingpermit_certbyemployer', $row->wipbriefingpermit_certbyemployer),
                    'wipbriefingpermit_certbyemployer_date' => set_value('wipbriefingpermit_certbyemployer_date', $row->wipbriefingpermit_certbyemployer_date),
                    'wipbriefingpermit_certbytrainer' => set_value('wipbriefingpermit_certbytrainer', $row->wipbriefingpermit_certbytrainer),
                    'wipbriefingpermit_certbytrainer_date' => set_value('wipbriefingpermit_certbytrainer_date', $row->wipbriefingpermit_certbytrainer_date),
                    'wipbriefingpermit_course_date' => set_value('wipbriefingpermit_course_date', $row->wipbriefingpermit_course_date),
                    'wipbriefingpermit_wipbriefingscheduled' => set_value('wipbriefingpermit_wipbriefingscheduled', $row->wipbriefingpermit_wipbriefingscheduled),
                    'wipbriefingpermit_wipbriefingapproval' => set_value('wipbriefingpermit_wipbriefingapproval', $row->wipbriefingpermit_wipbriefingapproval),
                    'wipbriefingpermit_attendwipbriefing' => set_value('wipbriefingpermit_attendwipbriefing', $row->wipbriefingpermit_attendwipbriefing),
                    'wipbriefingpermit_completed_docs' => set_value('wipbriefingpermit_completed_docs', $row->wipbriefingpermit_completed_docs),
                    'wipbriefingpermit_approvedby_airside' => set_value('wipbriefingpermit_approvedby_airside', $row->wipbriefingpermit_approvedby_airside),
                    'wipbriefingpermit_created_at' => set_value('wipbriefingpermit_created_at', $row->wipbriefingpermit_created_at),
                    'wipbriefingpermit_updated_at' => set_value('wipbriefingpermit_updated_at', $row->wipbriefingpermit_updated_at),
                    'wipbriefingpermit_deleted_at' => set_value('wipbriefingpermit_deleted_at', $row->wipbriefingpermit_deleted_at),
                    'wipbriefingpermit_lastchanged_by' => set_value('wipbriefingpermit_lastchanged_by', $row->wipbriefingpermit_lastchanged_by),

                ];
                $this->content = 'wipbriefingpermit/wipbriefingpermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingpermit'));
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
                $this->update($this->input->post('wipbriefingpermit_id', true));
            } else {
                $data = [
                    'wipbriefingpermit_permit_id' => $this->input->post('wipbriefingpermit_permit_id', true),
                    'wipbriefingpermit_driver_id' => $this->input->post('wipbriefingpermit_driver_id', true),
                    'wipbriefingpermit_recent_permitno' => $this->input->post('wipbriefingpermit_recent_permitno', true),
                    'wipbriefingpermit_recent_expirydate' => $this->input->post('wipbriefingpermit_recent_expirydate', true),
                    'wipbriefingpermit_driveracknowledgement' => $this->input->post('wipbriefingpermit_driveracknowledgement', true),
                    'wipbriefingpermit_driveracknowledgement_date' => $this->input->post('wipbriefingpermit_driveracknowledgement_date', true),
                    'wipbriefingpermit_certbyemployer' => $this->input->post('wipbriefingpermit_certbyemployer', true),
                    'wipbriefingpermit_certbyemployer_date' => $this->input->post('wipbriefingpermit_certbyemployer_date', true),
                    'wipbriefingpermit_certbytrainer' => $this->input->post('wipbriefingpermit_certbytrainer', true),
                    'wipbriefingpermit_certbytrainer_date' => $this->input->post('wipbriefingpermit_certbytrainer_date', true),
                    'wipbriefingpermit_course_date' => $this->input->post('wipbriefingpermit_course_date', true),
                    'wipbriefingpermit_wipbriefingscheduled' => $this->input->post('wipbriefingpermit_wipbriefingscheduled', true),
                    'wipbriefingpermit_wipbriefingapproval' => $this->input->post('wipbriefingpermit_wipbriefingapproval', true),
                    'wipbriefingpermit_attendwipbriefing' => $this->input->post('wipbriefingpermit_attendwipbriefing', true),
                    'wipbriefingpermit_completed_docs' => $this->input->post('wipbriefingpermit_completed_docs', true),
                    'wipbriefingpermit_approvedby_airside' => $this->input->post('wipbriefingpermit_approvedby_airside', true),
                    'wipbriefingpermit_created_at' => $this->input->post('wipbriefingpermit_created_at', true),
                    'wipbriefingpermit_updated_at' => $this->input->post('wipbriefingpermit_updated_at', true),
                    'wipbriefingpermit_deleted_at' => $this->input->post('wipbriefingpermit_deleted_at', true),
                    'wipbriefingpermit_lastchanged_by' => $this->input->post('wipbriefingpermit_lastchanged_by', true),
                    'wipbriefingpermit_updated_at' => date('Y-m-d H:i:s'),
                    'wipbriefingpermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->wipbriefingpermit_model->update(fixzy_decoder($this->input->post('wipbriefingpermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('wipbriefingpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->wipbriefingpermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->wipbriefingpermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('wipbriefingpermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->wipbriefingpermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'wipbriefingpermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->wipbriefingpermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('wipbriefingpermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('wipbriefingpermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('wipbriefingpermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('wipbriefingpermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('wipbriefingpermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_wipbriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_wipbriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('wipbriefingpermit_attendwipbriefing', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('wipbriefingpermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('wipbriefingpermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingpermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'wipbriefingpermit_id',
            'wipbriefingpermit_permit_id',
            'wipbriefingpermit_driver_id',
            'wipbriefingpermit_recent_permitno',
            'wipbriefingpermit_recent_expirydate',
            'wipbriefingpermit_driveracknowledgement',
            'wipbriefingpermit_driveracknowledgement_date',
            'wipbriefingpermit_certbyemployer',
            'wipbriefingpermit_certbyemployer_date',
            'wipbriefingpermit_certbytrainer',
            'wipbriefingpermit_certbytrainer_date',
            'wipbriefingpermit_course_date',
            'wipbriefingpermit_wipbriefingscheduled',
            'wipbriefingpermit_wipbriefingapproval',
            'wipbriefingpermit_attendwipbriefing',
            'wipbriefingpermit_completed_docs',
            'wipbriefingpermit_approvedby_airside',
            'wipbriefingpermit_created_at',
            'wipbriefingpermit_updated_at',
            'wipbriefingpermit_deleted_at',
            'wipbriefingpermit_lastchanged_by',

        ];
        $results = $this->wipbriefingpermit_model->listajax(
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
                $rud .= anchor(site_url('wipbriefingpermit/read/' . fixzy_encoder($r['wipbriefingpermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('wipbriefingpermit/update/' . fixzy_encoder($r['wipbriefingpermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('wipbriefingpermit/delete/' . fixzy_encoder($r['wipbriefingpermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['wipbriefingpermit_permit_id'],
                $r['wipbriefingpermit_driver_id'],
                $r['wipbriefingpermit_recent_permitno'],
                $r['wipbriefingpermit_recent_expirydate'],
                $r['wipbriefingpermit_driveracknowledgement'],
                $r['wipbriefingpermit_driveracknowledgement_date'],
                $r['wipbriefingpermit_certbyemployer'],
                $r['wipbriefingpermit_certbyemployer_date'],
                $r['wipbriefingpermit_certbytrainer'],
                $r['wipbriefingpermit_certbytrainer_date'],
                $r['wipbriefingpermit_course_date'],
                $r['wipbriefingpermit_wipbriefingscheduled'],
                $r['wipbriefingpermit_wipbriefingapproval'],
                $r['wipbriefingpermit_attendwipbriefing'],
                $r['wipbriefingpermit_completed_docs'],
                $r['wipbriefingpermit_approvedby_airside'],
                $r['wipbriefingpermit_created_at'],
                $r['wipbriefingpermit_updated_at'],
                $r['wipbriefingpermit_deleted_at'],
                $r['wipbriefingpermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->wipbriefingpermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->wipbriefingpermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Wipbriefingpermit.php */
/* Location: ./application/controllers/Wipbriefingpermit.php */
