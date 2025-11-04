<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Gpupermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('gpupermit_model');
        $this->load->model('permitall_model');
        $this->load->model('permit_model');
        $this->load->model('permittimeline_model');
        $this->lang->load('gpupermit_lang', $this->session->userdata('language'));
        $this->lang->load('driver_lang', $this->session->userdata('language'));
        $this->lang->load('company_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $gpupermit = $this->gpupermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'gpupermit_data' => $gpupermit,
                'permission' => $this->permission,
            ];

            $this->content = 'gpupermit/gpupermit_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function attendance()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
            ];

            $this->content = 'gpupermit/gpupermit_attendance';
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
            $row = $this->gpupermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'gpupermit_permit_id' => $row->gpupermit_permit_id,
                    'gpupermit_driver_id' => $row->gpupermit_driver_id,
                    'gpupermit_recent_permitno' => $row->gpupermit_recent_permitno,
                    'gpupermit_recent_expirydate' => $row->gpupermit_recent_expirydate,
                    'gpupermit_driveracknowledgement' => $row->gpupermit_driveracknowledgement,
                    'gpupermit_driveracknowledgement_date' => $row->gpupermit_driveracknowledgement_date,
                    'gpupermit_certbyemployer' => $row->gpupermit_certbyemployer,
                    'gpupermit_certbyemployer_date' => $row->gpupermit_certbyemployer_date,
                    'gpupermit_certbytrainer' => $row->gpupermit_certbytrainer,
                    'gpupermit_certbytrainer_date' => $row->gpupermit_certbytrainer_date,
                    'gpupermit_course_date' => $row->gpupermit_course_date,
                    'gpupermit_gpubriefingscheduled' => $row->gpupermit_gpubriefingscheduled,
                    'gpupermit_gpubriefingapproval' => $row->gpupermit_gpubriefingapproval,
                    'gpupermit_attendgpubriefing' => $row->gpupermit_attendgpubriefing,
                    'gpupermit_completed_docs' => $row->gpupermit_completed_docs,
                    'gpupermit_approvedby_airside' => $row->gpupermit_approvedby_airside,
                    'gpupermit_created_at' => $row->gpupermit_created_at,
                    'gpupermit_updated_at' => $row->gpupermit_updated_at,
                    'gpupermit_deleted_at' => $row->gpupermit_deleted_at,
                    'gpupermit_lastchanged_by' => $row->gpupermit_lastchanged_by,

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

                    $this->content = 'gpupermit/gpupermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('gpupermit/gpupermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpupermit'));
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
                'action' => site_url('gpupermit/create_action'),
                'gpupermit_permit_id' => set_value('gpupermit_permit_id'),
                'gpupermit_driver_id' => set_value('gpupermit_driver_id'),
                'gpupermit_recent_permitno' => set_value('gpupermit_recent_permitno'),
                'gpupermit_recent_expirydate' => set_value('gpupermit_recent_expirydate'),
                'gpupermit_driveracknowledgement' => set_value('gpupermit_driveracknowledgement'),
                'gpupermit_driveracknowledgement_date' => set_value('gpupermit_driveracknowledgement_date'),
                'gpupermit_certbyemployer' => set_value('gpupermit_certbyemployer'),
                'gpupermit_certbyemployer_date' => set_value('gpupermit_certbyemployer_date'),
                'gpupermit_certbytrainer' => set_value('gpupermit_certbytrainer'),
                'gpupermit_certbytrainer_date' => set_value('gpupermit_certbytrainer_date'),
                'gpupermit_course_date' => set_value('gpupermit_course_date'),
                'gpupermit_gpubriefingscheduled' => set_value('gpupermit_gpubriefingscheduled'),
                'gpupermit_gpubriefingapproval' => set_value('gpupermit_gpubriefingapproval'),
                'gpupermit_attendgpubriefing' => set_value('gpupermit_attendgpubriefing'),
                'gpupermit_completed_docs' => set_value('gpupermit_completed_docs'),
                'gpupermit_approvedby_airside' => set_value('gpupermit_approvedby_airside'),
                'gpupermit_created_at' => set_value('gpupermit_created_at'),
                'gpupermit_updated_at' => set_value('gpupermit_updated_at'),
                'gpupermit_deleted_at' => set_value('gpupermit_deleted_at'),
                'gpupermit_lastchanged_by' => set_value('gpupermit_lastchanged_by'),

            ];
            $this->content = 'gpupermit/gpupermit_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function briefingattend($date)
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $gpubriefing = $this->gpupermit_model->get_all_by_date($date);
            $data = [
                'button' => 'Create',
                'action' => site_url('gpupermit/check_action'),
                'gpubriefing' => $gpubriefing,
                'course_date' =>$date,

            ];
            $this->content = 'gpupermit/gpupermit_briefing';
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
                    'gpupermit_permit_id' => $this->input->post('gpupermit_permit_id', true),
                    'gpupermit_driver_id' => $this->input->post('gpupermit_driver_id', true),
                    'gpupermit_recent_permitno' => $this->input->post('gpupermit_recent_permitno', true),
                    'gpupermit_recent_expirydate' => $this->input->post('gpupermit_recent_expirydate', true),
                    'gpupermit_driveracknowledgement' => $this->input->post('gpupermit_driveracknowledgement', true),
                    'gpupermit_driveracknowledgement_date' => $this->input->post('gpupermit_driveracknowledgement_date', true),
                    'gpupermit_certbyemployer' => $this->input->post('gpupermit_certbyemployer', true),
                    'gpupermit_certbyemployer_date' => $this->input->post('gpupermit_certbyemployer_date', true),
                    'gpupermit_certbytrainer' => $this->input->post('gpupermit_certbytrainer', true),
                    'gpupermit_certbytrainer_date' => $this->input->post('gpupermit_certbytrainer_date', true),
                    'gpupermit_course_date' => $this->input->post('gpupermit_course_date', true),
                    'gpupermit_gpubriefingscheduled' => $this->input->post('gpupermit_gpubriefingscheduled', true),
                    'gpupermit_gpubriefingapproval' => $this->input->post('gpupermit_gpubriefingapproval', true),
                    'gpupermit_attendgpubriefing' => $this->input->post('gpupermit_attendgpubriefing', true),
                    'gpupermit_completed_docs' => $this->input->post('gpupermit_completed_docs', true),
                    'gpupermit_approvedby_airside' => $this->input->post('gpupermit_approvedby_airside', true),
                    'gpupermit_created_at' => $this->input->post('gpupermit_created_at', true),
                    'gpupermit_updated_at' => $this->input->post('gpupermit_updated_at', true),
                    'gpupermit_deleted_at' => $this->input->post('gpupermit_deleted_at', true),
                    'gpupermit_lastchanged_by' => $this->input->post('gpupermit_lastchanged_by', true),
                    'gpupermit_created_at' => date('Y-m-d H:i:s'),
                    'gpupermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->gpupermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('gpupermit'));
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
            $row = $this->gpupermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('gpupermit/update_action'),
                    'id' => $id,
                    'gpupermit_permit_id' => set_value('gpupermit_permit_id', $row->gpupermit_permit_id),
                    'gpupermit_driver_id' => set_value('gpupermit_driver_id', $row->gpupermit_driver_id),
                    'gpupermit_recent_permitno' => set_value('gpupermit_recent_permitno', $row->gpupermit_recent_permitno),
                    'gpupermit_recent_expirydate' => set_value('gpupermit_recent_expirydate', $row->gpupermit_recent_expirydate),
                    'gpupermit_driveracknowledgement' => set_value('gpupermit_driveracknowledgement', $row->gpupermit_driveracknowledgement),
                    'gpupermit_driveracknowledgement_date' => set_value('gpupermit_driveracknowledgement_date', $row->gpupermit_driveracknowledgement_date),
                    'gpupermit_certbyemployer' => set_value('gpupermit_certbyemployer', $row->gpupermit_certbyemployer),
                    'gpupermit_certbyemployer_date' => set_value('gpupermit_certbyemployer_date', $row->gpupermit_certbyemployer_date),
                    'gpupermit_certbytrainer' => set_value('gpupermit_certbytrainer', $row->gpupermit_certbytrainer),
                    'gpupermit_certbytrainer_date' => set_value('gpupermit_certbytrainer_date', $row->gpupermit_certbytrainer_date),
                    'gpupermit_course_date' => set_value('gpupermit_course_date', $row->gpupermit_course_date),
                    'gpupermit_gpubriefingscheduled' => set_value('gpupermit_gpubriefingscheduled', $row->gpupermit_gpubriefingscheduled),
                    'gpupermit_gpubriefingapproval' => set_value('gpupermit_gpubriefingapproval', $row->gpupermit_gpubriefingapproval),
                    'gpupermit_attendgpubriefing' => set_value('gpupermit_attendgpubriefing', $row->gpupermit_attendgpubriefing),
                    'gpupermit_completed_docs' => set_value('gpupermit_completed_docs', $row->gpupermit_completed_docs),
                    'gpupermit_approvedby_airside' => set_value('gpupermit_approvedby_airside', $row->gpupermit_approvedby_airside),
                    'gpupermit_created_at' => set_value('gpupermit_created_at', $row->gpupermit_created_at),
                    'gpupermit_updated_at' => set_value('gpupermit_updated_at', $row->gpupermit_updated_at),
                    'gpupermit_deleted_at' => set_value('gpupermit_deleted_at', $row->gpupermit_deleted_at),
                    'gpupermit_lastchanged_by' => set_value('gpupermit_lastchanged_by', $row->gpupermit_lastchanged_by),

                ];
                $this->content = 'gpupermit/gpupermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpupermit'));
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
                $this->update($this->input->post('gpupermit_id', true));
            } else {
                $data = [
                    'gpupermit_permit_id' => $this->input->post('gpupermit_permit_id', true),
                    'gpupermit_driver_id' => $this->input->post('gpupermit_driver_id', true),
                    'gpupermit_recent_permitno' => $this->input->post('gpupermit_recent_permitno', true),
                    'gpupermit_recent_expirydate' => $this->input->post('gpupermit_recent_expirydate', true),
                    'gpupermit_driveracknowledgement' => $this->input->post('gpupermit_driveracknowledgement', true),
                    'gpupermit_driveracknowledgement_date' => $this->input->post('gpupermit_driveracknowledgement_date', true),
                    'gpupermit_certbyemployer' => $this->input->post('gpupermit_certbyemployer', true),
                    'gpupermit_certbyemployer_date' => $this->input->post('gpupermit_certbyemployer_date', true),
                    'gpupermit_certbytrainer' => $this->input->post('gpupermit_certbytrainer', true),
                    'gpupermit_certbytrainer_date' => $this->input->post('gpupermit_certbytrainer_date', true),
                    'gpupermit_course_date' => $this->input->post('gpupermit_course_date', true),
                    'gpupermit_gpubriefingscheduled' => $this->input->post('gpupermit_gpubriefingscheduled', true),
                    'gpupermit_gpubriefingapproval' => $this->input->post('gpupermit_gpubriefingapproval', true),
                    'gpupermit_attendgpubriefing' => $this->input->post('gpupermit_attendgpubriefing', true),
                    'gpupermit_completed_docs' => $this->input->post('gpupermit_completed_docs', true),
                    'gpupermit_approvedby_airside' => $this->input->post('gpupermit_approvedby_airside', true),
                    'gpupermit_created_at' => $this->input->post('gpupermit_created_at', true),
                    'gpupermit_updated_at' => $this->input->post('gpupermit_updated_at', true),
                    'gpupermit_deleted_at' => $this->input->post('gpupermit_deleted_at', true),
                    'gpupermit_lastchanged_by' => $this->input->post('gpupermit_lastchanged_by', true),
                    'gpupermit_updated_at' => date('Y-m-d H:i:s'),
                    'gpupermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->gpupermit_model->update(fixzy_decoder($this->input->post('gpupermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('gpupermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function check_action()
    {

        if ($this->permission->cp_update == true) {

        $selected_gpupermit = $this->input->post("gpupermit_id");
        $nowdatetime   = date('Y-m-d H:i:s');
        //$permitid = $this->input->post("permit_id", true);

        foreach ($selected_gpupermit as $gpupermit) {
            $permit_ = explode("|", $gpupermit);
            $gpupermitid = $permit_[0]; // piece1
            $permitid = $permit_[1]; // piece2

                $data = [
                    'gpupermit_attendgpubriefing' => 'y',
                    'gpupermit_certbytrainer' => $this->input->post('gpupermit_certbytrainer', true),
                    'gpupermit_certbytrainer_date' => $this->input->post('gpupermit_certbytrainer_date', true),
                    'gpupermit_updated_at' => $nowdatetime,
                    'gpupermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->gpupermit_model->update($gpupermitid, $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $data_permit = [
                  'permit_status' => 'approvalairsidepending',
                  'permit_officialstatus' => 'inprogress',
                  'permit_updated_at' => $nowdatetime,
                  'permit_lastchanged_by' => $this->session->userdata('id'),
                ];

                $this->permit_model->update($permitid, $data_permit);
                /* $this->logQueries($this->config->item('dblog')); */

                        $data_timeline = [
                            'permit_timeline_permitid' => $permitid,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => ATTEND_BRIEFING_GPU,
                            'permit_timeline_desc' => ATTEND_BRIEFING_GPU_DESC,
                            'permit_timeline_status' => 'approvalairsidepending',
                            'permit_timeline_officialstatus' => 'inprogress',
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);
                        /* $this->logQueries($this->config->item('dblog')); */
        }


                $this->session->set_flashdata('message', 'Update Record Success');
                redirect('/');


        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->gpupermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->gpupermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('gpupermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpupermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->gpupermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'gpupermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->gpupermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('gpupermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpupermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('gpupermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('gpupermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('gpupermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('gpupermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_gpubriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_gpubriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('gpupermit_attendgpubriefing', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('gpupermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('gpupermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('gpupermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'gpupermit_id',
            'gpupermit_permit_id',
            'gpupermit_driver_id',
            'gpupermit_recent_permitno',
            'gpupermit_recent_expirydate',
            'gpupermit_driveracknowledgement',
            'gpupermit_driveracknowledgement_date',
            'gpupermit_certbyemployer',
            'gpupermit_certbyemployer_date',
            'gpupermit_certbytrainer',
            'gpupermit_certbytrainer_date',
            'gpupermit_course_date',
            'gpupermit_gpubriefingscheduled',
            'gpupermit_gpubriefingapproval',
            'gpupermit_attendgpubriefing',
            'gpupermit_completed_docs',
            'gpupermit_approvedby_airside',
            'gpupermit_created_at',
            'gpupermit_updated_at',
            'gpupermit_deleted_at',
            'gpupermit_lastchanged_by',

        ];
        $results = $this->gpupermit_model->listajax(
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
                $rud .= anchor(site_url('gpupermit/read/' . fixzy_encoder($r['gpupermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('gpupermit/update/' . fixzy_encoder($r['gpupermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('gpupermit/delete/' . fixzy_encoder($r['gpupermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['gpupermit_permit_id'],
                $r['gpupermit_driver_id'],
                $r['gpupermit_recent_permitno'],
                $r['gpupermit_recent_expirydate'],
                $r['gpupermit_driveracknowledgement'],
                $r['gpupermit_driveracknowledgement_date'],
                $r['gpupermit_certbyemployer'],
                $r['gpupermit_certbyemployer_date'],
                $r['gpupermit_certbytrainer'],
                $r['gpupermit_certbytrainer_date'],
                $r['gpupermit_course_date'],
                $r['gpupermit_gpubriefingscheduled'],
                $r['gpupermit_gpubriefingapproval'],
                $r['gpupermit_attendgpubriefing'],
                $r['gpupermit_completed_docs'],
                $r['gpupermit_approvedby_airside'],
                $r['gpupermit_created_at'],
                $r['gpupermit_updated_at'],
                $r['gpupermit_deleted_at'],
                $r['gpupermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->gpupermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->gpupermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Gpupermit.php */
/* Location: ./application/controllers/Gpupermit.php */
