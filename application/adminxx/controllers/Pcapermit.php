<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pcapermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pcapermit_model');
        $this->load->model('permitall_model');
        $this->load->model('permit_model');
        $this->load->model('permittimeline_model');
        $this->lang->load('pcapermit_lang', $this->session->userdata('language'));
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
            $pcapermit = $this->pcapermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'pcapermit_data' => $pcapermit,
                'permission' => $this->permission,
            ];

            $this->content = 'pcapermit/pcapermit_list';
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

            $this->content = 'pcapermit/pcapermit_attendance';
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
            $row = $this->pcapermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pcapermit_permit_id' => $row->pcapermit_permit_id,
                    'pcapermit_driver_id' => $row->pcapermit_driver_id,
                    'pcapermit_recent_permitno' => $row->pcapermit_recent_permitno,
                    'pcapermit_recent_expirydate' => $row->pcapermit_recent_expirydate,
                    'pcapermit_driveracknowledgement' => $row->pcapermit_driveracknowledgement,
                    'pcapermit_driveracknowledgement_date' => $row->pcapermit_driveracknowledgement_date,
                    'pcapermit_certbyemployer' => $row->pcapermit_certbyemployer,
                    'pcapermit_certbyemployer_date' => $row->pcapermit_certbyemployer_date,
                    'pcapermit_certbytrainer' => $row->pcapermit_certbytrainer,
                    'pcapermit_certbytrainer_date' => $row->pcapermit_certbytrainer_date,
                    'pcapermit_course_date' => $row->pcapermit_course_date,
                    'pcapermit_pcabriefingscheduled' => $row->pcapermit_pcabriefingscheduled,
                    'pcapermit_pcabriefingapproval' => $row->pcapermit_pcabriefingapproval,
                    'pcapermit_attendpcabriefing' => $row->pcapermit_attendpcabriefing,
                    'pcapermit_completed_docs' => $row->pcapermit_completed_docs,
                    'pcapermit_approvedby_airside' => $row->pcapermit_approvedby_airside,
                    'pcapermit_created_at' => $row->pcapermit_created_at,
                    'pcapermit_updated_at' => $row->pcapermit_updated_at,
                    'pcapermit_deleted_at' => $row->pcapermit_deleted_at,
                    'pcapermit_lastchanged_by' => $row->pcapermit_lastchanged_by,

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

                    $this->content = 'pcapermit/pcapermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('pcapermit/pcapermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcapermit'));
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
                'action' => site_url('pcapermit/create_action'),
                'pcapermit_permit_id' => set_value('pcapermit_permit_id'),
                'pcapermit_driver_id' => set_value('pcapermit_driver_id'),
                'pcapermit_recent_permitno' => set_value('pcapermit_recent_permitno'),
                'pcapermit_recent_expirydate' => set_value('pcapermit_recent_expirydate'),
                'pcapermit_driveracknowledgement' => set_value('pcapermit_driveracknowledgement'),
                'pcapermit_driveracknowledgement_date' => set_value('pcapermit_driveracknowledgement_date'),
                'pcapermit_certbyemployer' => set_value('pcapermit_certbyemployer'),
                'pcapermit_certbyemployer_date' => set_value('pcapermit_certbyemployer_date'),
                'pcapermit_certbytrainer' => set_value('pcapermit_certbytrainer'),
                'pcapermit_certbytrainer_date' => set_value('pcapermit_certbytrainer_date'),
                'pcapermit_course_date' => set_value('pcapermit_course_date'),
                'pcapermit_pcabriefingscheduled' => set_value('pcapermit_pcabriefingscheduled'),
                'pcapermit_pcabriefingapproval' => set_value('pcapermit_pcabriefingapproval'),
                'pcapermit_attendpcabriefing' => set_value('pcapermit_attendpcabriefing'),
                'pcapermit_completed_docs' => set_value('pcapermit_completed_docs'),
                'pcapermit_approvedby_airside' => set_value('pcapermit_approvedby_airside'),
                'pcapermit_created_at' => set_value('pcapermit_created_at'),
                'pcapermit_updated_at' => set_value('pcapermit_updated_at'),
                'pcapermit_deleted_at' => set_value('pcapermit_deleted_at'),
                'pcapermit_lastchanged_by' => set_value('pcapermit_lastchanged_by'),

            ];
            $this->content = 'pcapermit/pcapermit_form';
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

            $pcabriefing = $this->pcapermit_model->get_all_by_date($date);
            $data = [
                'button' => 'Create',
                'action' => site_url('pcapermit/check_action'),
                'pcabriefing' => $pcabriefing,
                'course_date' =>$date,

            ];
            $this->content = 'pcapermit/pcapermit_briefing';
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
                    'pcapermit_permit_id' => $this->input->post('pcapermit_permit_id', true),
                    'pcapermit_driver_id' => $this->input->post('pcapermit_driver_id', true),
                    'pcapermit_recent_permitno' => $this->input->post('pcapermit_recent_permitno', true),
                    'pcapermit_recent_expirydate' => $this->input->post('pcapermit_recent_expirydate', true),
                    'pcapermit_driveracknowledgement' => $this->input->post('pcapermit_driveracknowledgement', true),
                    'pcapermit_driveracknowledgement_date' => $this->input->post('pcapermit_driveracknowledgement_date', true),
                    'pcapermit_certbyemployer' => $this->input->post('pcapermit_certbyemployer', true),
                    'pcapermit_certbyemployer_date' => $this->input->post('pcapermit_certbyemployer_date', true),
                    'pcapermit_certbytrainer' => $this->input->post('pcapermit_certbytrainer', true),
                    'pcapermit_certbytrainer_date' => $this->input->post('pcapermit_certbytrainer_date', true),
                    'pcapermit_course_date' => $this->input->post('pcapermit_course_date', true),
                    'pcapermit_pcabriefingscheduled' => $this->input->post('pcapermit_pcabriefingscheduled', true),
                    'pcapermit_pcabriefingapproval' => $this->input->post('pcapermit_pcabriefingapproval', true),
                    'pcapermit_attendpcabriefing' => $this->input->post('pcapermit_attendpcabriefing', true),
                    'pcapermit_completed_docs' => $this->input->post('pcapermit_completed_docs', true),
                    'pcapermit_approvedby_airside' => $this->input->post('pcapermit_approvedby_airside', true),
                    'pcapermit_created_at' => $this->input->post('pcapermit_created_at', true),
                    'pcapermit_updated_at' => $this->input->post('pcapermit_updated_at', true),
                    'pcapermit_deleted_at' => $this->input->post('pcapermit_deleted_at', true),
                    'pcapermit_lastchanged_by' => $this->input->post('pcapermit_lastchanged_by', true),
                    'pcapermit_created_at' => date('Y-m-d H:i:s'),
                    'pcapermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pcapermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pcapermit'));
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
            $row = $this->pcapermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('pcapermit/update_action'),
                    'id' => $id,
                    'pcapermit_permit_id' => set_value('pcapermit_permit_id', $row->pcapermit_permit_id),
                    'pcapermit_driver_id' => set_value('pcapermit_driver_id', $row->pcapermit_driver_id),
                    'pcapermit_recent_permitno' => set_value('pcapermit_recent_permitno', $row->pcapermit_recent_permitno),
                    'pcapermit_recent_expirydate' => set_value('pcapermit_recent_expirydate', $row->pcapermit_recent_expirydate),
                    'pcapermit_driveracknowledgement' => set_value('pcapermit_driveracknowledgement', $row->pcapermit_driveracknowledgement),
                    'pcapermit_driveracknowledgement_date' => set_value('pcapermit_driveracknowledgement_date', $row->pcapermit_driveracknowledgement_date),
                    'pcapermit_certbyemployer' => set_value('pcapermit_certbyemployer', $row->pcapermit_certbyemployer),
                    'pcapermit_certbyemployer_date' => set_value('pcapermit_certbyemployer_date', $row->pcapermit_certbyemployer_date),
                    'pcapermit_certbytrainer' => set_value('pcapermit_certbytrainer', $row->pcapermit_certbytrainer),
                    'pcapermit_certbytrainer_date' => set_value('pcapermit_certbytrainer_date', $row->pcapermit_certbytrainer_date),
                    'pcapermit_course_date' => set_value('pcapermit_course_date', $row->pcapermit_course_date),
                    'pcapermit_pcabriefingscheduled' => set_value('pcapermit_pcabriefingscheduled', $row->pcapermit_pcabriefingscheduled),
                    'pcapermit_pcabriefingapproval' => set_value('pcapermit_pcabriefingapproval', $row->pcapermit_pcabriefingapproval),
                    'pcapermit_attendpcabriefing' => set_value('pcapermit_attendpcabriefing', $row->pcapermit_attendpcabriefing),
                    'pcapermit_completed_docs' => set_value('pcapermit_completed_docs', $row->pcapermit_completed_docs),
                    'pcapermit_approvedby_airside' => set_value('pcapermit_approvedby_airside', $row->pcapermit_approvedby_airside),
                    'pcapermit_created_at' => set_value('pcapermit_created_at', $row->pcapermit_created_at),
                    'pcapermit_updated_at' => set_value('pcapermit_updated_at', $row->pcapermit_updated_at),
                    'pcapermit_deleted_at' => set_value('pcapermit_deleted_at', $row->pcapermit_deleted_at),
                    'pcapermit_lastchanged_by' => set_value('pcapermit_lastchanged_by', $row->pcapermit_lastchanged_by),

                ];
                $this->content = 'pcapermit/pcapermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcapermit'));
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
                $this->update($this->input->post('pcapermit_id', true));
            } else {
                $data = [
                    'pcapermit_permit_id' => $this->input->post('pcapermit_permit_id', true),
                    'pcapermit_driver_id' => $this->input->post('pcapermit_driver_id', true),
                    'pcapermit_recent_permitno' => $this->input->post('pcapermit_recent_permitno', true),
                    'pcapermit_recent_expirydate' => $this->input->post('pcapermit_recent_expirydate', true),
                    'pcapermit_driveracknowledgement' => $this->input->post('pcapermit_driveracknowledgement', true),
                    'pcapermit_driveracknowledgement_date' => $this->input->post('pcapermit_driveracknowledgement_date', true),
                    'pcapermit_certbyemployer' => $this->input->post('pcapermit_certbyemployer', true),
                    'pcapermit_certbyemployer_date' => $this->input->post('pcapermit_certbyemployer_date', true),
                    'pcapermit_certbytrainer' => $this->input->post('pcapermit_certbytrainer', true),
                    'pcapermit_certbytrainer_date' => $this->input->post('pcapermit_certbytrainer_date', true),
                    'pcapermit_course_date' => $this->input->post('pcapermit_course_date', true),
                    'pcapermit_pcabriefingscheduled' => $this->input->post('pcapermit_pcabriefingscheduled', true),
                    'pcapermit_pcabriefingapproval' => $this->input->post('pcapermit_pcabriefingapproval', true),
                    'pcapermit_attendpcabriefing' => $this->input->post('pcapermit_attendpcabriefing', true),
                    'pcapermit_completed_docs' => $this->input->post('pcapermit_completed_docs', true),
                    'pcapermit_approvedby_airside' => $this->input->post('pcapermit_approvedby_airside', true),
                    'pcapermit_created_at' => $this->input->post('pcapermit_created_at', true),
                    'pcapermit_updated_at' => $this->input->post('pcapermit_updated_at', true),
                    'pcapermit_deleted_at' => $this->input->post('pcapermit_deleted_at', true),
                    'pcapermit_lastchanged_by' => $this->input->post('pcapermit_lastchanged_by', true),
                    'pcapermit_updated_at' => date('Y-m-d H:i:s'),
                    'pcapermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pcapermit_model->update(fixzy_decoder($this->input->post('pcapermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('pcapermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function check_action()
    {

        if ($this->permission->cp_update == true) {

        $selected_pcapermit = $this->input->post("pcapermit_id");
        $nowdatetime   = date('Y-m-d H:i:s');
        //$permitid = $this->input->post("permit_id", true);

        foreach ($selected_pcapermit as $pcapermit) {
            $permit_ = explode("|", $pcapermit);
            $pcapermitid = $permit_[0]; // piece1
            $permitid = $permit_[1]; // piece2

                $data = [
                    'pcapermit_attendpcabriefing' => 'y',
                    'pcapermit_certbytrainer' => $this->input->post('pcapermit_certbytrainer', true),
                    'pcapermit_certbytrainer_date' => $this->input->post('pcapermit_certbytrainer_date', true),
                    'pcapermit_updated_at' => $nowdatetime,
                    'pcapermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pcapermit_model->update($pcapermitid, $data);
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
                            'permit_timeline_name' => ATTEND_BRIEFING_PCA,
                            'permit_timeline_desc' => ATTEND_BRIEFING_PCA_DESC,
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
            $row = $this->pcapermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->pcapermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pcapermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcapermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pcapermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pcapermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->pcapermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pcapermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcapermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('pcapermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pcapermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pcapermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pcapermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_pcabriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_pcabriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pcapermit_attendpcabriefing', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pcapermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('pcapermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('pcapermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'pcapermit_id',
            'pcapermit_permit_id',
            'pcapermit_driver_id',
            'pcapermit_recent_permitno',
            'pcapermit_recent_expirydate',
            'pcapermit_driveracknowledgement',
            'pcapermit_driveracknowledgement_date',
            'pcapermit_certbyemployer',
            'pcapermit_certbyemployer_date',
            'pcapermit_certbytrainer',
            'pcapermit_certbytrainer_date',
            'pcapermit_course_date',
            'pcapermit_pcabriefingscheduled',
            'pcapermit_pcabriefingapproval',
            'pcapermit_attendpcabriefing',
            'pcapermit_completed_docs',
            'pcapermit_approvedby_airside',
            'pcapermit_created_at',
            'pcapermit_updated_at',
            'pcapermit_deleted_at',
            'pcapermit_lastchanged_by',

        ];
        $results = $this->pcapermit_model->listajax(
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
                $rud .= anchor(site_url('pcapermit/read/' . fixzy_encoder($r['pcapermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('pcapermit/update/' . fixzy_encoder($r['pcapermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('pcapermit/delete/' . fixzy_encoder($r['pcapermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['pcapermit_permit_id'],
                $r['pcapermit_driver_id'],
                $r['pcapermit_recent_permitno'],
                $r['pcapermit_recent_expirydate'],
                $r['pcapermit_driveracknowledgement'],
                $r['pcapermit_driveracknowledgement_date'],
                $r['pcapermit_certbyemployer'],
                $r['pcapermit_certbyemployer_date'],
                $r['pcapermit_certbytrainer'],
                $r['pcapermit_certbytrainer_date'],
                $r['pcapermit_course_date'],
                $r['pcapermit_pcabriefingscheduled'],
                $r['pcapermit_pcabriefingapproval'],
                $r['pcapermit_attendpcabriefing'],
                $r['pcapermit_completed_docs'],
                $r['pcapermit_approvedby_airside'],
                $r['pcapermit_created_at'],
                $r['pcapermit_updated_at'],
                $r['pcapermit_deleted_at'],
                $r['pcapermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->pcapermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->pcapermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Pcapermit.php */
/* Location: ./application/controllers/Pcapermit.php */
