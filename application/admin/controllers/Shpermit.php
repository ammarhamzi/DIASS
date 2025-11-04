<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shpermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('shpermit_model');
        $this->load->model('permitall_model');
        $this->load->model('permit_model');
        $this->load->model('permittimeline_model');
        $this->lang->load('shpermit_lang', $this->session->userdata('language'));
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
            $shpermit = $this->shpermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'shpermit_data' => $shpermit,
                'permission' => $this->permission,
            ];

            $this->content = 'shpermit/shpermit_list';
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

            $this->content = 'shpermit/shpermit_attendance';
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
            $row = $this->shpermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'shpermit_permit_id' => $row->shpermit_permit_id,
                    'shpermit_driver_id' => $row->shpermit_driver_id,
                    'shpermit_recent_permitno' => $row->shpermit_recent_permitno,
                    'shpermit_recent_expirydate' => $row->shpermit_recent_expirydate,
                    'shpermit_driveracknowledgement' => $row->shpermit_driveracknowledgement,
                    'shpermit_driveracknowledgement_date' => $row->shpermit_driveracknowledgement_date,
                    'shpermit_certbyemployer' => $row->shpermit_certbyemployer,
                    'shpermit_certbyemployer_date' => $row->shpermit_certbyemployer_date,
                    'shpermit_certbytrainer' => $row->shpermit_certbytrainer,
                    'shpermit_certbytrainer_date' => $row->shpermit_certbytrainer_date,
                    'shpermit_course_date' => $row->shpermit_course_date,
                    'shpermit_shbriefingscheduled' => $row->shpermit_shbriefingscheduled,
                    'shpermit_shbriefingapproval' => $row->shpermit_shbriefingapproval,
                    'shpermit_attendshbriefing' => $row->shpermit_attendshbriefing,
                    'shpermit_completed_docs' => $row->shpermit_completed_docs,
                    'shpermit_approvedby_airside' => $row->shpermit_approvedby_airside,
                    'shpermit_created_at' => $row->shpermit_created_at,
                    'shpermit_updated_at' => $row->shpermit_updated_at,
                    'shpermit_deleted_at' => $row->shpermit_deleted_at,
                    'shpermit_lastchanged_by' => $row->shpermit_lastchanged_by,

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

                    $this->content = 'shpermit/shpermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('shpermit/shpermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shpermit'));
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
                'action' => site_url('shpermit/create_action'),
                'shpermit_permit_id' => set_value('shpermit_permit_id'),
                'shpermit_driver_id' => set_value('shpermit_driver_id'),
                'shpermit_recent_permitno' => set_value('shpermit_recent_permitno'),
                'shpermit_recent_expirydate' => set_value('shpermit_recent_expirydate'),
                'shpermit_driveracknowledgement' => set_value('shpermit_driveracknowledgement'),
                'shpermit_driveracknowledgement_date' => set_value('shpermit_driveracknowledgement_date'),
                'shpermit_certbyemployer' => set_value('shpermit_certbyemployer'),
                'shpermit_certbyemployer_date' => set_value('shpermit_certbyemployer_date'),
                'shpermit_certbytrainer' => set_value('shpermit_certbytrainer'),
                'shpermit_certbytrainer_date' => set_value('shpermit_certbytrainer_date'),
                'shpermit_course_date' => set_value('shpermit_course_date'),
                'shpermit_shbriefingscheduled' => set_value('shpermit_shbriefingscheduled'),
                'shpermit_shbriefingapproval' => set_value('shpermit_shbriefingapproval'),
                'shpermit_attendshbriefing' => set_value('shpermit_attendshbriefing'),
                'shpermit_completed_docs' => set_value('shpermit_completed_docs'),
                'shpermit_approvedby_airside' => set_value('shpermit_approvedby_airside'),
                'shpermit_created_at' => set_value('shpermit_created_at'),
                'shpermit_updated_at' => set_value('shpermit_updated_at'),
                'shpermit_deleted_at' => set_value('shpermit_deleted_at'),
                'shpermit_lastchanged_by' => set_value('shpermit_lastchanged_by'),

            ];
            $this->content = 'shpermit/shpermit_form';
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

            $shbriefing = $this->shpermit_model->get_all_by_date($date);
            $data = [
                'button' => 'Create',
                'action' => site_url('shpermit/check_action'),
                'shbriefing' => $shbriefing,
                'course_date' =>$date,

            ];
            $this->content = 'shpermit/shpermit_briefing';
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
                    'shpermit_permit_id' => $this->input->post('shpermit_permit_id', true),
                    'shpermit_driver_id' => $this->input->post('shpermit_driver_id', true),
                    'shpermit_recent_permitno' => $this->input->post('shpermit_recent_permitno', true),
                    'shpermit_recent_expirydate' => $this->input->post('shpermit_recent_expirydate', true),
                    'shpermit_driveracknowledgement' => $this->input->post('shpermit_driveracknowledgement', true),
                    'shpermit_driveracknowledgement_date' => $this->input->post('shpermit_driveracknowledgement_date', true),
                    'shpermit_certbyemployer' => $this->input->post('shpermit_certbyemployer', true),
                    'shpermit_certbyemployer_date' => $this->input->post('shpermit_certbyemployer_date', true),
                    'shpermit_certbytrainer' => $this->input->post('shpermit_certbytrainer', true),
                    'shpermit_certbytrainer_date' => $this->input->post('shpermit_certbytrainer_date', true),
                    'shpermit_course_date' => $this->input->post('shpermit_course_date', true),
                    'shpermit_shbriefingscheduled' => $this->input->post('shpermit_shbriefingscheduled', true),
                    'shpermit_shbriefingapproval' => $this->input->post('shpermit_shbriefingapproval', true),
                    'shpermit_attendshbriefing' => $this->input->post('shpermit_attendshbriefing', true),
                    'shpermit_completed_docs' => $this->input->post('shpermit_completed_docs', true),
                    'shpermit_approvedby_airside' => $this->input->post('shpermit_approvedby_airside', true),
                    'shpermit_created_at' => $this->input->post('shpermit_created_at', true),
                    'shpermit_updated_at' => $this->input->post('shpermit_updated_at', true),
                    'shpermit_deleted_at' => $this->input->post('shpermit_deleted_at', true),
                    'shpermit_lastchanged_by' => $this->input->post('shpermit_lastchanged_by', true),
                    'shpermit_created_at' => date('Y-m-d H:i:s'),
                    'shpermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->shpermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('shpermit'));
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
            $row = $this->shpermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('shpermit/update_action'),
                    'id' => $id,
                    'shpermit_permit_id' => set_value('shpermit_permit_id', $row->shpermit_permit_id),
                    'shpermit_driver_id' => set_value('shpermit_driver_id', $row->shpermit_driver_id),
                    'shpermit_recent_permitno' => set_value('shpermit_recent_permitno', $row->shpermit_recent_permitno),
                    'shpermit_recent_expirydate' => set_value('shpermit_recent_expirydate', $row->shpermit_recent_expirydate),
                    'shpermit_driveracknowledgement' => set_value('shpermit_driveracknowledgement', $row->shpermit_driveracknowledgement),
                    'shpermit_driveracknowledgement_date' => set_value('shpermit_driveracknowledgement_date', $row->shpermit_driveracknowledgement_date),
                    'shpermit_certbyemployer' => set_value('shpermit_certbyemployer', $row->shpermit_certbyemployer),
                    'shpermit_certbyemployer_date' => set_value('shpermit_certbyemployer_date', $row->shpermit_certbyemployer_date),
                    'shpermit_certbytrainer' => set_value('shpermit_certbytrainer', $row->shpermit_certbytrainer),
                    'shpermit_certbytrainer_date' => set_value('shpermit_certbytrainer_date', $row->shpermit_certbytrainer_date),
                    'shpermit_course_date' => set_value('shpermit_course_date', $row->shpermit_course_date),
                    'shpermit_shbriefingscheduled' => set_value('shpermit_shbriefingscheduled', $row->shpermit_shbriefingscheduled),
                    'shpermit_shbriefingapproval' => set_value('shpermit_shbriefingapproval', $row->shpermit_shbriefingapproval),
                    'shpermit_attendshbriefing' => set_value('shpermit_attendshbriefing', $row->shpermit_attendshbriefing),
                    'shpermit_completed_docs' => set_value('shpermit_completed_docs', $row->shpermit_completed_docs),
                    'shpermit_approvedby_airside' => set_value('shpermit_approvedby_airside', $row->shpermit_approvedby_airside),
                    'shpermit_created_at' => set_value('shpermit_created_at', $row->shpermit_created_at),
                    'shpermit_updated_at' => set_value('shpermit_updated_at', $row->shpermit_updated_at),
                    'shpermit_deleted_at' => set_value('shpermit_deleted_at', $row->shpermit_deleted_at),
                    'shpermit_lastchanged_by' => set_value('shpermit_lastchanged_by', $row->shpermit_lastchanged_by),

                ];
                $this->content = 'shpermit/shpermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shpermit'));
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
                $this->update($this->input->post('shpermit_id', true));
            } else {
                $data = [
                    'shpermit_permit_id' => $this->input->post('shpermit_permit_id', true),
                    'shpermit_driver_id' => $this->input->post('shpermit_driver_id', true),
                    'shpermit_recent_permitno' => $this->input->post('shpermit_recent_permitno', true),
                    'shpermit_recent_expirydate' => $this->input->post('shpermit_recent_expirydate', true),
                    'shpermit_driveracknowledgement' => $this->input->post('shpermit_driveracknowledgement', true),
                    'shpermit_driveracknowledgement_date' => $this->input->post('shpermit_driveracknowledgement_date', true),
                    'shpermit_certbyemployer' => $this->input->post('shpermit_certbyemployer', true),
                    'shpermit_certbyemployer_date' => $this->input->post('shpermit_certbyemployer_date', true),
                    'shpermit_certbytrainer' => $this->input->post('shpermit_certbytrainer', true),
                    'shpermit_certbytrainer_date' => $this->input->post('shpermit_certbytrainer_date', true),
                    'shpermit_course_date' => $this->input->post('shpermit_course_date', true),
                    'shpermit_shbriefingscheduled' => $this->input->post('shpermit_shbriefingscheduled', true),
                    'shpermit_shbriefingapproval' => $this->input->post('shpermit_shbriefingapproval', true),
                    'shpermit_attendshbriefing' => $this->input->post('shpermit_attendshbriefing', true),
                    'shpermit_completed_docs' => $this->input->post('shpermit_completed_docs', true),
                    'shpermit_approvedby_airside' => $this->input->post('shpermit_approvedby_airside', true),
                    'shpermit_created_at' => $this->input->post('shpermit_created_at', true),
                    'shpermit_updated_at' => $this->input->post('shpermit_updated_at', true),
                    'shpermit_deleted_at' => $this->input->post('shpermit_deleted_at', true),
                    'shpermit_lastchanged_by' => $this->input->post('shpermit_lastchanged_by', true),
                    'shpermit_updated_at' => date('Y-m-d H:i:s'),
                    'shpermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->shpermit_model->update(fixzy_decoder($this->input->post('shpermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('shpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function check_action()
    {

        if ($this->permission->cp_update == true) {

        $selected_shpermit = $this->input->post("shpermit_id");
        $nowdatetime   = date('Y-m-d H:i:s');
        //$permitid = $this->input->post("permit_id", true);

        foreach ($selected_shpermit as $shpermit) {
            $permit_ = explode("|", $shpermit);
            $shpermitid = $permit_[0]; // piece1
            $permitid = $permit_[1]; // piece2

                $data = [
                    'shpermit_attendshbriefing' => 'y',
                    'shpermit_certbytrainer' => $this->input->post('shpermit_certbytrainer', true),
                    'shpermit_certbytrainer_date' => $this->input->post('shpermit_certbytrainer_date', true),
                    'shpermit_updated_at' => $nowdatetime,
                    'shpermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->shpermit_model->update($shpermitid, $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $data_permit = [
                  'permit_status' => 'approvalairsidepending', //approvalairsidepending
                  'permit_officialstatus' => 'inprogress',//inprogress
                  'permit_updated_at' => $nowdatetime,
                  'permit_lastchanged_by' => $this->session->userdata('id'),
                ];

                $this->permit_model->update($permitid, $data_permit);
                /* $this->logQueries($this->config->item('dblog')); */

                        $data_timeline = [
                            'permit_timeline_permitid' => $permitid,
                            'permit_timeline_userid' => $this->session->userdata('id'),
                            'permit_timeline_name' => ATTEND_BRIEFING_SH,
                            'permit_timeline_desc' => ATTEND_BRIEFING_SH_DESC,
                            'permit_timeline_status' => 'approvalairsidepending', //approvalairsidepending
                            'permit_timeline_officialstatus' => 'inprogress',//inprogress
                            'permit_timeline_created_at' => $nowdatetime,
                            'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                        ];

                        $this->permittimeline_model->insert($data_timeline);
                        /* $this->logQueries($this->config->item('dblog')); */
        }


                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('shpermit/attendance'));


        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->shpermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->shpermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('shpermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->shpermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'shpermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->shpermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('shpermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('shpermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('shpermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('shpermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('shpermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_shbriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_shbriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('shpermit_attendshbriefing', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('shpermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('shpermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('shpermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'shpermit_id',
            'shpermit_permit_id',
            'shpermit_driver_id',
            'shpermit_recent_permitno',
            'shpermit_recent_expirydate',
            'shpermit_driveracknowledgement',
            'shpermit_driveracknowledgement_date',
            'shpermit_certbyemployer',
            'shpermit_certbyemployer_date',
            'shpermit_certbytrainer',
            'shpermit_certbytrainer_date',
            'shpermit_course_date',
            'shpermit_shbriefingscheduled',
            'shpermit_shbriefingapproval',
            'shpermit_attendshbriefing',
            'shpermit_completed_docs',
            'shpermit_approvedby_airside',
            'shpermit_created_at',
            'shpermit_updated_at',
            'shpermit_deleted_at',
            'shpermit_lastchanged_by',

        ];
        $results = $this->shpermit_model->listajax(
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
                $rud .= anchor(site_url('shpermit/read/' . fixzy_encoder($r['shpermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('shpermit/update/' . fixzy_encoder($r['shpermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('shpermit/delete/' . fixzy_encoder($r['shpermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['shpermit_permit_id'],
                $r['shpermit_driver_id'],
                $r['shpermit_recent_permitno'],
                $r['shpermit_recent_expirydate'],
                $r['shpermit_driveracknowledgement'],
                $r['shpermit_driveracknowledgement_date'],
                $r['shpermit_certbyemployer'],
                $r['shpermit_certbyemployer_date'],
                $r['shpermit_certbytrainer'],
                $r['shpermit_certbytrainer_date'],
                $r['shpermit_course_date'],
                $r['shpermit_shbriefingscheduled'],
                $r['shpermit_shbriefingapproval'],
                $r['shpermit_attendshbriefing'],
                $r['shpermit_completed_docs'],
                $r['shpermit_approvedby_airside'],
                $r['shpermit_created_at'],
                $r['shpermit_updated_at'],
                $r['shpermit_deleted_at'],
                $r['shpermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->shpermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->shpermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Shpermit.php */
/* Location: ./application/controllers/Shpermit.php */
