<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vdgspermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('vdgspermit_model');
        $this->load->model('permitall_model');
        $this->load->model('permit_model');
        $this->load->model('permittimeline_model');
        $this->lang->load('vdgspermit_lang', $this->session->userdata('language'));
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
            $vdgspermit = $this->vdgspermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'vdgspermit_data' => $vdgspermit,
                'permission' => $this->permission,
            ];

            $this->content = 'vdgspermit/vdgspermit_list';
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

            $this->content = 'vdgspermit/vdgspermit_attendance';
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
            $row = $this->vdgspermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'vdgspermit_permit_id' => $row->vdgspermit_permit_id,
                    'vdgspermit_driver_id' => $row->vdgspermit_driver_id,
                    'vdgspermit_recent_permitno' => $row->vdgspermit_recent_permitno,
                    'vdgspermit_recent_expirydate' => $row->vdgspermit_recent_expirydate,
                    'vdgspermit_driveracknowledgement' => $row->vdgspermit_driveracknowledgement,
                    'vdgspermit_driveracknowledgement_date' => $row->vdgspermit_driveracknowledgement_date,
                    'vdgspermit_certbyemployer' => $row->vdgspermit_certbyemployer,
                    'vdgspermit_certbyemployer_date' => $row->vdgspermit_certbyemployer_date,
                    'vdgspermit_certbytrainer' => $row->vdgspermit_certbytrainer,
                    'vdgspermit_certbytrainer_date' => $row->vdgspermit_certbytrainer_date,
                    'vdgspermit_course_date' => $row->vdgspermit_course_date,
                    'vdgspermit_vdgsbriefingscheduled' => $row->vdgspermit_vdgsbriefingscheduled,
                    'vdgspermit_vdgsbriefingapproval' => $row->vdgspermit_vdgsbriefingapproval,
                    'vdgspermit_attendvgdsbriefing' => $row->vdgspermit_attendvgdsbriefing,
                    'vdgspermit_completed_docs' => $row->vdgspermit_completed_docs,
                    'vdgspermit_approvedby_airside' => $row->vdgspermit_approvedby_airside,
                    'vdgspermit_created_at' => $row->vdgspermit_created_at,
                    'vdgspermit_updated_at' => $row->vdgspermit_updated_at,
                    'vdgspermit_deleted_at' => $row->vdgspermit_deleted_at,
                    'vdgspermit_lastchanged_by' => $row->vdgspermit_lastchanged_by,

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

                    $this->content = 'vdgspermit/vdgspermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('vdgspermit/vdgspermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgspermit'));
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
                'action' => site_url('vdgspermit/create_action'),
                'vdgspermit_permit_id' => set_value('vdgspermit_permit_id'),
                'vdgspermit_driver_id' => set_value('vdgspermit_driver_id'),
                'vdgspermit_recent_permitno' => set_value('vdgspermit_recent_permitno'),
                'vdgspermit_recent_expirydate' => set_value('vdgspermit_recent_expirydate'),
                'vdgspermit_driveracknowledgement' => set_value('vdgspermit_driveracknowledgement'),
                'vdgspermit_driveracknowledgement_date' => set_value('vdgspermit_driveracknowledgement_date'),
                'vdgspermit_certbyemployer' => set_value('vdgspermit_certbyemployer'),
                'vdgspermit_certbyemployer_date' => set_value('vdgspermit_certbyemployer_date'),
                'vdgspermit_certbytrainer' => set_value('vdgspermit_certbytrainer'),
                'vdgspermit_certbytrainer_date' => set_value('vdgspermit_certbytrainer_date'),
                'vdgspermit_course_date' => set_value('vdgspermit_course_date'),
                'vdgspermit_vdgsbriefingscheduled' => set_value('vdgspermit_vdgsbriefingscheduled'),
                'vdgspermit_vdgsbriefingapproval' => set_value('vdgspermit_vdgsbriefingapproval'),
                'vdgspermit_attendvgdsbriefing' => set_value('vdgspermit_attendvgdsbriefing'),
                'vdgspermit_completed_docs' => set_value('vdgspermit_completed_docs'),
                'vdgspermit_approvedby_airside' => set_value('vdgspermit_approvedby_airside'),
                'vdgspermit_created_at' => set_value('vdgspermit_created_at'),
                'vdgspermit_updated_at' => set_value('vdgspermit_updated_at'),
                'vdgspermit_deleted_at' => set_value('vdgspermit_deleted_at'),
                'vdgspermit_lastchanged_by' => set_value('vdgspermit_lastchanged_by'),

            ];
            $this->content = 'vdgspermit/vdgspermit_form';
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

            $vdgsbriefing = $this->vdgspermit_model->get_all_by_date($date);
            $data = [
                'button' => 'Create',
                'action' => site_url('vdgspermit/check_action'),
                'vdgsbriefing' => $vdgsbriefing,
                'course_date' =>$date,

            ];
            $this->content = 'vdgspermit/vdgspermit_briefing';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }
    
    public function briefingattend2($date,$loc)
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            //coding asal
            //$evdpbriefing = $this->evdppermit_model->get_all_by_date($date);
            //first modification
            //$evdpbriefing = $this->evdppermit_model->get_all_by_date2($date);
            //second modification
            $vdgsbriefing = $this->vdgspermit_model->get_all_by_date3($date,$loc);
            $data = [
                'button' => 'Create',
                'action' => site_url('vdgspermit/check_action'),
                'vdgsbriefing' => $vdgsbriefing,
                'course_date' =>$date,

            ];
            $this->content = 'vdgspermit/vdgspermit_briefing';
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
                    'vdgspermit_permit_id' => $this->input->post('vdgspermit_permit_id', true),
                    'vdgspermit_driver_id' => $this->input->post('vdgspermit_driver_id', true),
                    'vdgspermit_recent_permitno' => $this->input->post('vdgspermit_recent_permitno', true),
                    'vdgspermit_recent_expirydate' => $this->input->post('vdgspermit_recent_expirydate', true),
                    'vdgspermit_driveracknowledgement' => $this->input->post('vdgspermit_driveracknowledgement', true),
                    'vdgspermit_driveracknowledgement_date' => $this->input->post('vdgspermit_driveracknowledgement_date', true),
                    'vdgspermit_certbyemployer' => $this->input->post('vdgspermit_certbyemployer', true),
                    'vdgspermit_certbyemployer_date' => $this->input->post('vdgspermit_certbyemployer_date', true),
                    'vdgspermit_certbytrainer' => $this->input->post('vdgspermit_certbytrainer', true),
                    'vdgspermit_certbytrainer_date' => $this->input->post('vdgspermit_certbytrainer_date', true),
                    'vdgspermit_course_date' => $this->input->post('vdgspermit_course_date', true),
                    'vdgspermit_vdgsbriefingscheduled' => $this->input->post('vdgspermit_vdgsbriefingscheduled', true),
                    'vdgspermit_vdgsbriefingapproval' => $this->input->post('vdgspermit_vdgsbriefingapproval', true),
                    'vdgspermit_attendvgdsbriefing' => $this->input->post('vdgspermit_attendvgdsbriefing', true),
                    'vdgspermit_completed_docs' => $this->input->post('vdgspermit_completed_docs', true),
                    'vdgspermit_approvedby_airside' => $this->input->post('vdgspermit_approvedby_airside', true),
                    'vdgspermit_created_at' => $this->input->post('vdgspermit_created_at', true),
                    'vdgspermit_updated_at' => $this->input->post('vdgspermit_updated_at', true),
                    'vdgspermit_deleted_at' => $this->input->post('vdgspermit_deleted_at', true),
                    'vdgspermit_lastchanged_by' => $this->input->post('vdgspermit_lastchanged_by', true),
                    'vdgspermit_created_at' => date('Y-m-d H:i:s'),
                    'vdgspermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->vdgspermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('vdgspermit'));
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
            $row = $this->vdgspermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('vdgspermit/update_action'),
                    'id' => $id,
                    'vdgspermit_permit_id' => set_value('vdgspermit_permit_id', $row->vdgspermit_permit_id),
                    'vdgspermit_driver_id' => set_value('vdgspermit_driver_id', $row->vdgspermit_driver_id),
                    'vdgspermit_recent_permitno' => set_value('vdgspermit_recent_permitno', $row->vdgspermit_recent_permitno),
                    'vdgspermit_recent_expirydate' => set_value('vdgspermit_recent_expirydate', $row->vdgspermit_recent_expirydate),
                    'vdgspermit_driveracknowledgement' => set_value('vdgspermit_driveracknowledgement', $row->vdgspermit_driveracknowledgement),
                    'vdgspermit_driveracknowledgement_date' => set_value('vdgspermit_driveracknowledgement_date', $row->vdgspermit_driveracknowledgement_date),
                    'vdgspermit_certbyemployer' => set_value('vdgspermit_certbyemployer', $row->vdgspermit_certbyemployer),
                    'vdgspermit_certbyemployer_date' => set_value('vdgspermit_certbyemployer_date', $row->vdgspermit_certbyemployer_date),
                    'vdgspermit_certbytrainer' => set_value('vdgspermit_certbytrainer', $row->vdgspermit_certbytrainer),
                    'vdgspermit_certbytrainer_date' => set_value('vdgspermit_certbytrainer_date', $row->vdgspermit_certbytrainer_date),
                    'vdgspermit_course_date' => set_value('vdgspermit_course_date', $row->vdgspermit_course_date),
                    'vdgspermit_vdgsbriefingscheduled' => set_value('vdgspermit_vdgsbriefingscheduled', $row->vdgspermit_vdgsbriefingscheduled),
                    'vdgspermit_vdgsbriefingapproval' => set_value('vdgspermit_vdgsbriefingapproval', $row->vdgspermit_vdgsbriefingapproval),
                    'vdgspermit_attendvgdsbriefing' => set_value('vdgspermit_attendvgdsbriefing', $row->vdgspermit_attendvgdsbriefing),
                    'vdgspermit_completed_docs' => set_value('vdgspermit_completed_docs', $row->vdgspermit_completed_docs),
                    'vdgspermit_approvedby_airside' => set_value('vdgspermit_approvedby_airside', $row->vdgspermit_approvedby_airside),
                    'vdgspermit_created_at' => set_value('vdgspermit_created_at', $row->vdgspermit_created_at),
                    'vdgspermit_updated_at' => set_value('vdgspermit_updated_at', $row->vdgspermit_updated_at),
                    'vdgspermit_deleted_at' => set_value('vdgspermit_deleted_at', $row->vdgspermit_deleted_at),
                    'vdgspermit_lastchanged_by' => set_value('vdgspermit_lastchanged_by', $row->vdgspermit_lastchanged_by),

                ];
                $this->content = 'vdgspermit/vdgspermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgspermit'));
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
                $this->update($this->input->post('vdgspermit_id', true));
            } else {
                $data = [
                    'vdgspermit_permit_id' => $this->input->post('vdgspermit_permit_id', true),
                    'vdgspermit_driver_id' => $this->input->post('vdgspermit_driver_id', true),
                    'vdgspermit_recent_permitno' => $this->input->post('vdgspermit_recent_permitno', true),
                    'vdgspermit_recent_expirydate' => $this->input->post('vdgspermit_recent_expirydate', true),
                    'vdgspermit_driveracknowledgement' => $this->input->post('vdgspermit_driveracknowledgement', true),
                    'vdgspermit_driveracknowledgement_date' => $this->input->post('vdgspermit_driveracknowledgement_date', true),
                    'vdgspermit_certbyemployer' => $this->input->post('vdgspermit_certbyemployer', true),
                    'vdgspermit_certbyemployer_date' => $this->input->post('vdgspermit_certbyemployer_date', true),
                    'vdgspermit_certbytrainer' => $this->input->post('vdgspermit_certbytrainer', true),
                    'vdgspermit_certbytrainer_date' => $this->input->post('vdgspermit_certbytrainer_date', true),
                    'vdgspermit_course_date' => $this->input->post('vdgspermit_course_date', true),
                    'vdgspermit_vdgsbriefingscheduled' => $this->input->post('vdgspermit_vdgsbriefingscheduled', true),
                    'vdgspermit_vdgsbriefingapproval' => $this->input->post('vdgspermit_vdgsbriefingapproval', true),
                    'vdgspermit_attendvgdsbriefing' => $this->input->post('vdgspermit_attendvgdsbriefing', true),
                    'vdgspermit_completed_docs' => $this->input->post('vdgspermit_completed_docs', true),
                    'vdgspermit_approvedby_airside' => $this->input->post('vdgspermit_approvedby_airside', true),
                    'vdgspermit_created_at' => $this->input->post('vdgspermit_created_at', true),
                    'vdgspermit_updated_at' => $this->input->post('vdgspermit_updated_at', true),
                    'vdgspermit_deleted_at' => $this->input->post('vdgspermit_deleted_at', true),
                    'vdgspermit_lastchanged_by' => $this->input->post('vdgspermit_lastchanged_by', true),
                    'vdgspermit_updated_at' => date('Y-m-d H:i:s'),
                    'vdgspermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->vdgspermit_model->update(fixzy_decoder($this->input->post('vdgspermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('vdgspermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function check_action()
    {

        if ($this->permission->cp_update == true) {

        $selected_vdgspermit = $this->input->post("vdgspermit_id");
        $nowdatetime   = date('Y-m-d H:i:s');
        //$permitid = $this->input->post("permit_id", true);

        foreach ($selected_vdgspermit as $vdgspermit) {
            $permit_ = explode("|", $vdgspermit);
            $vdgspermitid = $permit_[0]; // piece1
            $permitid = $permit_[1]; // piece2

                $data = [
                    'vdgspermit_attendvgdsbriefing' => 'y',
                    'vdgspermit_certbytrainer' => $this->input->post('vdgspermit_certbytrainer', true),
                    'vdgspermit_certbytrainer_date' => $this->input->post('vdgspermit_certbytrainer_date', true),
                    'vdgspermit_updated_at' => $nowdatetime,
                    'vdgspermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->vdgspermit_model->update($vdgspermitid, $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $data_permit = [
                  'permit_status' => 'approvalairsidepending',
                  'permit_officialstatus' => 'inprogress',
                  'permit_updated_at' => $nowdatetime,
                  'permit_lastchanged_by' => $this->session->userdata('id'),
                ];

                //$this->permit_model->update($permitid, $data_permit);
                $this->permit_model->update_only_inprogress($permitid, $data_permit);
                /* $this->logQueries($this->config->item('dblog')); */

                        $data_timeline = [
                            'permit_timeline_permitid' => $permitid,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => ATTEND_BRIEFING_VDGS,
                            'permit_timeline_desc' => ATTEND_BRIEFING_VDGS_DESC,
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
            $row = $this->vdgspermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->vdgspermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('vdgspermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgspermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->vdgspermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'vdgspermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->vdgspermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('vdgspermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgspermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('vdgspermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vdgspermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vdgspermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vdgspermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_vdgsbriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_vdgsbriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vdgspermit_attendvgdsbriefing', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vdgspermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('vdgspermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('vdgspermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'vdgspermit_id',
            'vdgspermit_permit_id',
            'vdgspermit_driver_id',
            'vdgspermit_recent_permitno',
            'vdgspermit_recent_expirydate',
            'vdgspermit_driveracknowledgement',
            'vdgspermit_driveracknowledgement_date',
            'vdgspermit_certbyemployer',
            'vdgspermit_certbyemployer_date',
            'vdgspermit_certbytrainer',
            'vdgspermit_certbytrainer_date',
            'vdgspermit_course_date',
            'vdgspermit_vdgsbriefingscheduled',
            'vdgspermit_vdgsbriefingapproval',
            'vdgspermit_attendvgdsbriefing',
            'vdgspermit_completed_docs',
            'vdgspermit_approvedby_airside',
            'vdgspermit_created_at',
            'vdgspermit_updated_at',
            'vdgspermit_deleted_at',
            'vdgspermit_lastchanged_by',

        ];
        $results = $this->vdgspermit_model->listajax(
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
                $rud .= anchor(site_url('vdgspermit/read/' . fixzy_encoder($r['vdgspermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('vdgspermit/update/' . fixzy_encoder($r['vdgspermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('vdgspermit/delete/' . fixzy_encoder($r['vdgspermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['vdgspermit_permit_id'],
                $r['vdgspermit_driver_id'],
                $r['vdgspermit_recent_permitno'],
                $r['vdgspermit_recent_expirydate'],
                $r['vdgspermit_driveracknowledgement'],
                $r['vdgspermit_driveracknowledgement_date'],
                $r['vdgspermit_certbyemployer'],
                $r['vdgspermit_certbyemployer_date'],
                $r['vdgspermit_certbytrainer'],
                $r['vdgspermit_certbytrainer_date'],
                $r['vdgspermit_course_date'],
                $r['vdgspermit_vdgsbriefingscheduled'],
                $r['vdgspermit_vdgsbriefingapproval'],
                $r['vdgspermit_attendvgdsbriefing'],
                $r['vdgspermit_completed_docs'],
                $r['vdgspermit_approvedby_airside'],
                $r['vdgspermit_created_at'],
                $r['vdgspermit_updated_at'],
                $r['vdgspermit_deleted_at'],
                $r['vdgspermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->vdgspermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->vdgspermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Vdgspermit.php */
/* Location: ./application/controllers/Vdgspermit.php */
