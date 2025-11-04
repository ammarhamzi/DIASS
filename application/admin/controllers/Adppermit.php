<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adppermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('adppermit_model');
        $this->load->model('permitall_model');
        $this->load->model('permit_model');
        $this->load->model('permittimeline_model');
        $this->lang->load('adppermit_lang', $this->session->userdata('language'));
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
            $adppermit = $this->adppermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'adppermit_data' => $adppermit,
                'permission' => $this->permission,
            ];

            $this->content = 'adppermit/adppermit_list';
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

            $this->content = 'adppermit/adppermit_attendance';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function exam()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
            ];

            $this->content = 'adppermit/adppermit_exam';
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
            $row = $this->adppermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'adppermit_permit_id' => $row->adppermit_permit_id,
                    'adppermit_driver_id' => $row->adppermit_driver_id,
                    'adppermit_driveracknowledgement' => $row->adppermit_driveracknowledgement,
                    'adppermit_verifybyemployer' => $row->adppermit_verifybyemployer,
                    'adppermit_certbytrainer' => $row->adppermit_certbytrainer,
                    'adppermit_certbytrainer_date' => $row->adppermit_certbytrainer_date,
                    'adppermit_verifybymahb' => $row->adppermit_verifybymahb,
                    'adppermit_verifybymahb_drivingarea' => $row->adppermit_verifybymahb_drivingarea,
                    'adppermit_verifybymahb_vehicleclass' => $row->adppermit_verifybymahb_vehicleclass,
                    'adppermit_course_date' => $row->adppermit_course_date,
                    'adppermit_competencytest_date' => $row->adppermit_competencytest_date,
                    'adppermit_attendbriefing' => $row->adppermit_attendbriefing,
                    'adppermit_attendanceslip' => $row->adppermit_attendanceslip,
                    'adppermit_examscheduled' => $row->adppermit_examscheduled,
                    'adppermit_approvedtotakeexam_by' => $row->adppermit_approvedtotakeexam_by,
                    'adppermit_exampass' => $row->adppermit_exampass,
                    'adppermit_completed_docs' => $row->adppermit_completed_docs,
                    'adppermit_approvedby_airside' => $row->adppermit_approvedby_airside,
                    'adppermit_created_at' => $row->adppermit_created_at,
                    'adppermit_updated_at' => $row->adppermit_updated_at,
                    'adppermit_deleted_at' => $row->adppermit_deleted_at,
                    'adppermit_lastchanged_by' => $row->adppermit_lastchanged_by,

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

                    $this->content = 'adppermit/adppermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('adppermit/adppermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adppermit'));
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
                'action' => site_url('adppermit/create_action'),
                'adppermit_permit_id' => set_value('adppermit_permit_id'),
                'adppermit_driver_id' => set_value('adppermit_driver_id'),
                'adppermit_driveracknowledgement' => set_value('adppermit_driveracknowledgement'),
                'adppermit_verifybyemployer' => set_value('adppermit_verifybyemployer'),
                'adppermit_certbytrainer' => set_value('adppermit_certbytrainer'),
                'adppermit_certbytrainer_date' => set_value('adppermit_certbytrainer_date'),
                'adppermit_verifybymahb' => set_value('adppermit_verifybymahb'),
                'adppermit_verifybymahb_drivingarea' => set_value('adppermit_verifybymahb_drivingarea'),
                'adppermit_verifybymahb_vehicleclass' => set_value('adppermit_verifybymahb_vehicleclass'),
                'adppermit_course_date' => set_value('adppermit_course_date'),
                'adppermit_competencytest_date' => set_value('adppermit_competencytest_date'),
                'adppermit_attendbriefing' => set_value('adppermit_attendbriefing'),
                'adppermit_attendanceslip' => set_value('adppermit_attendanceslip'),
                'adppermit_examscheduled' => set_value('adppermit_examscheduled'),
                'adppermit_approvedtotakeexam_by' => set_value('adppermit_approvedtotakeexam_by'),
                'adppermit_exampass' => set_value('adppermit_exampass'),
                'adppermit_completed_docs' => set_value('adppermit_completed_docs'),
                'adppermit_approvedby_airside' => set_value('adppermit_approvedby_airside'),
                'adppermit_created_at' => set_value('adppermit_created_at'),
                'adppermit_updated_at' => set_value('adppermit_updated_at'),
                'adppermit_deleted_at' => set_value('adppermit_deleted_at'),
                'adppermit_lastchanged_by' => set_value('adppermit_lastchanged_by'),

            ];
            $this->content = 'adppermit/adppermit_form';
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

            $adpbriefing = $this->adppermit_model->get_all_by_date($date);
            $data = [
                'button' => 'Create',
                'action' => site_url('adppermit/check_action'),
                'adpbriefing' => $adpbriefing,
                'course_date' =>$date,

            ];
            $this->content = 'adppermit/adppermit_briefing';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }
    
    public function briefingattend2($date,$loc,$cat)
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            //coding asal
            //$adpbriefing = $this->adppermit_model->get_all_by_date($date);
            //first modification
            //$evdpbriefing = $this->evdppermit_model->get_all_by_date2($date);
            //second modification
            $adpbriefing = $this->adppermit_model->get_all_by_date3($date,$loc,$cat);
            $data = [
                'button' => 'Create',
                'action' => site_url('adppermit/check_action'),
                'adpbriefing' => $adpbriefing,
                'course_date' =>$date,
                'course_location' =>$loc,
                'course_category' =>$cat,

            ];
            $this->content = 'adppermit/adppermit_briefing';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function examattend($date)
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $adpbriefing = $this->adppermit_model->get_all_by_examdate($date);
            $data = [
                'button' => 'Create',
                'action' => site_url('adppermit/check_action'),
                'adpbriefing' => $adpbriefing,
                'course_date' =>$date,

            ];
            $this->content = 'adppermit/adppermit_examattend';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }
    
    public function examattend2($date,$loc,$cat)
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            //$adpbriefing = $this->adppermit_model->get_all_by_examdate($date);
            $adpbriefing = $this->adppermit_model->get_all_by_examdate3($date, $loc, $cat);
            $data = [
                'button' => 'Create',
                'action' => site_url('adppermit/check_action'),
                'adpbriefing' => $adpbriefing,
                'course_date' =>$date,
                'course_location' =>$loc,
                'course_category' =>$cat,

            ];
            $this->content = 'adppermit/adppermit_examattend';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

        public function check_action()
        {

                if ($this->permission->cp_update == true) {

                $selected_adppermit = $this->input->post("adppermit_id");
                $nowdatetime   = date('Y-m-d H:i:s');
                //$permitid = $this->input->post("permit_id", true);
                
                //if($selected_adppermit != null)
                //{
                foreach ($selected_adppermit as $adppermit) {
                        $permit_ = explode("|", $adppermit);
                        $adppermitid = $permit_[0]; // piece1
                        $permitid = $permit_[1]; // piece2

                                $data = [
                                        'adppermit_attendbriefing' => 'y',
                                        'adppermit_certbytrainer' => $this->input->post('adppermit_certbytrainer', true),
                                        'adppermit_certbytrainer_date' => $this->input->post('adppermit_certbytrainer_date', true),
                                        'adppermit_updated_at' => $nowdatetime,
                                        'adppermit_lastchanged_by' => $this->session->userdata('id'),
                                ];
                                $this->adppermit_model->update($adppermitid, $data);
                                /* $this->logQueries($this->config->item('dblog')); */

                                $data_permit = [
                                    'permit_status' => 'exampending',
                                    'permit_officialstatus' => 'inprogress',
                                    'permit_updated_at' => $nowdatetime,
                                    'permit_lastchanged_by' => $this->session->userdata('id'),
                                ];

                                $this->permit_model->update($permitid, $data_permit);
                                /* $this->logQueries($this->config->item('dblog')); */

                                                $data_timeline = [
                                                        'permit_timeline_permitid' => $permitid,
                                                        'permit_timeline_userid' => $this->session->userdata('id'),
                                                        'permit_timeline_name' => ATTEND_BRIEFING_ADP,
                                                        'permit_timeline_desc' => ATTEND_BRIEFING_ADP_DESC,
                                                        'permit_timeline_status' => 'exampending',
                                                        'permit_timeline_officialstatus' => 2,
                                                        'permit_timeline_created_at' => $nowdatetime,
                                                        'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                                                ];

                                                $this->permittimeline_model->insert($data_timeline);
                                                /* $this->logQueries($this->config->item('dblog')); */
                }


                                $this->session->set_flashdata('message', 'Update Record Success');
                                redirect(site_url('adppermit/attendance'));
                                //redirect('/');


                } else {
                        redirect('/');
                }
                //}

        }

    public function create_action()
    {

        if ($this->permission->cp_create == true) {

            $this->_rules();

            if ($this->form_validation->run() == false) {
                $this->create();
            } else {
                $data = [
                    'adppermit_permit_id' => $this->input->post('adppermit_permit_id', true),
                    'adppermit_driver_id' => $this->input->post('adppermit_driver_id', true),
                    'adppermit_driveracknowledgement' => $this->input->post('adppermit_driveracknowledgement', true),
                    'adppermit_verifybyemployer' => $this->input->post('adppermit_verifybyemployer', true),
                    'adppermit_certbytrainer' => $this->input->post('adppermit_certbytrainer', true),
                    'adppermit_certbytrainer_date' => $this->input->post('adppermit_certbytrainer_date', true),
                    'adppermit_verifybymahb' => $this->input->post('adppermit_verifybymahb', true),
                    'adppermit_verifybymahb_drivingarea' => $this->input->post('adppermit_verifybymahb_drivingarea', true),
                    'adppermit_verifybymahb_vehicleclass' => $this->input->post('adppermit_verifybymahb_vehicleclass', true),
                    'adppermit_course_date' => $this->input->post('adppermit_course_date', true),
                    'adppermit_competencytest_date' => $this->input->post('adppermit_competencytest_date', true),
                    'adppermit_attendbriefing' => $this->input->post('adppermit_attendbriefing', true),
                    'adppermit_attendanceslip' => $this->input->post('adppermit_attendanceslip', true),
                    'adppermit_examscheduled' => $this->input->post('adppermit_examscheduled', true),
                    'adppermit_approvedtotakeexam_by' => $this->input->post('adppermit_approvedtotakeexam_by', true),
                    'adppermit_exampass' => $this->input->post('adppermit_exampass', true),
                    'adppermit_completed_docs' => $this->input->post('adppermit_completed_docs', true),
                    'adppermit_approvedby_airside' => $this->input->post('adppermit_approvedby_airside', true),
                    'adppermit_created_at' => $this->input->post('adppermit_created_at', true),
                    'adppermit_updated_at' => $this->input->post('adppermit_updated_at', true),
                    'adppermit_deleted_at' => $this->input->post('adppermit_deleted_at', true),
                    'adppermit_lastchanged_by' => $this->input->post('adppermit_lastchanged_by', true),
                    'adppermit_created_at' => date('Y-m-d H:i:s'),
                    'adppermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->adppermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('adppermit'));
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
            $row = $this->adppermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('adppermit/update_action'),
                    'id' => $id,
                    'adppermit_permit_id' => set_value('adppermit_permit_id', $row->adppermit_permit_id),
                    'adppermit_driver_id' => set_value('adppermit_driver_id', $row->adppermit_driver_id),
                    'adppermit_driveracknowledgement' => set_value('adppermit_driveracknowledgement', $row->adppermit_driveracknowledgement),
                    'adppermit_verifybyemployer' => set_value('adppermit_verifybyemployer', $row->adppermit_verifybyemployer),
                    'adppermit_certbytrainer' => set_value('adppermit_certbytrainer', $row->adppermit_certbytrainer),
                    'adppermit_certbytrainer_date' => set_value('adppermit_certbytrainer_date', $row->adppermit_certbytrainer_date),
                    'adppermit_verifybymahb' => set_value('adppermit_verifybymahb', $row->adppermit_verifybymahb),
                    'adppermit_verifybymahb_drivingarea' => set_value('adppermit_verifybymahb_drivingarea', $row->adppermit_verifybymahb_drivingarea),
                    'adppermit_verifybymahb_vehicleclass' => set_value('adppermit_verifybymahb_vehicleclass', $row->adppermit_verifybymahb_vehicleclass),
                    'adppermit_course_date' => set_value('adppermit_course_date', $row->adppermit_course_date),
                    'adppermit_competencytest_date' => set_value('adppermit_competencytest_date', $row->adppermit_competencytest_date),
                    'adppermit_attendbriefing' => set_value('adppermit_attendbriefing', $row->adppermit_attendbriefing),
                    'adppermit_attendanceslip' => set_value('adppermit_attendanceslip', $row->adppermit_attendanceslip),
                    'adppermit_examscheduled' => set_value('adppermit_examscheduled', $row->adppermit_examscheduled),
                    'adppermit_approvedtotakeexam_by' => set_value('adppermit_approvedtotakeexam_by', $row->adppermit_approvedtotakeexam_by),
                    'adppermit_exampass' => set_value('adppermit_exampass', $row->adppermit_exampass),
                    'adppermit_completed_docs' => set_value('adppermit_completed_docs', $row->adppermit_completed_docs),
                    'adppermit_approvedby_airside' => set_value('adppermit_approvedby_airside', $row->adppermit_approvedby_airside),
                    'adppermit_created_at' => set_value('adppermit_created_at', $row->adppermit_created_at),
                    'adppermit_updated_at' => set_value('adppermit_updated_at', $row->adppermit_updated_at),
                    'adppermit_deleted_at' => set_value('adppermit_deleted_at', $row->adppermit_deleted_at),
                    'adppermit_lastchanged_by' => set_value('adppermit_lastchanged_by', $row->adppermit_lastchanged_by),

                ];
                $this->content = 'adppermit/adppermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adppermit'));
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
                $this->update($this->input->post('adppermit_id', true));
            } else {
                $data = [
                    'adppermit_permit_id' => $this->input->post('adppermit_permit_id', true),
                    'adppermit_driver_id' => $this->input->post('adppermit_driver_id', true),
                    'adppermit_driveracknowledgement' => $this->input->post('adppermit_driveracknowledgement', true),
                    'adppermit_verifybyemployer' => $this->input->post('adppermit_verifybyemployer', true),
                    'adppermit_certbytrainer' => $this->input->post('adppermit_certbytrainer', true),
                    'adppermit_certbytrainer_date' => $this->input->post('adppermit_certbytrainer_date', true),
                    'adppermit_verifybymahb' => $this->input->post('adppermit_verifybymahb', true),
                    'adppermit_verifybymahb_drivingarea' => $this->input->post('adppermit_verifybymahb_drivingarea', true),
                    'adppermit_verifybymahb_vehicleclass' => $this->input->post('adppermit_verifybymahb_vehicleclass', true),
                    'adppermit_course_date' => $this->input->post('adppermit_course_date', true),
                    'adppermit_competencytest_date' => $this->input->post('adppermit_competencytest_date', true),
                    'adppermit_attendbriefing' => $this->input->post('adppermit_attendbriefing', true),
                    'adppermit_attendanceslip' => $this->input->post('adppermit_attendanceslip', true),
                    'adppermit_examscheduled' => $this->input->post('adppermit_examscheduled', true),
                    'adppermit_approvedtotakeexam_by' => $this->input->post('adppermit_approvedtotakeexam_by', true),
                    'adppermit_exampass' => $this->input->post('adppermit_exampass', true),
                    'adppermit_completed_docs' => $this->input->post('adppermit_completed_docs', true),
                    'adppermit_approvedby_airside' => $this->input->post('adppermit_approvedby_airside', true),
                    'adppermit_created_at' => $this->input->post('adppermit_created_at', true),
                    'adppermit_updated_at' => $this->input->post('adppermit_updated_at', true),
                    'adppermit_deleted_at' => $this->input->post('adppermit_deleted_at', true),
                    'adppermit_lastchanged_by' => $this->input->post('adppermit_lastchanged_by', true),
                    'adppermit_updated_at' => date('Y-m-d H:i:s'),
                    'adppermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->adppermit_model->update(fixzy_decoder($this->input->post('adppermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('adppermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->adppermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->adppermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('adppermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adppermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->adppermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'adppermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->adppermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('adppermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adppermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('adppermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('adppermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('adppermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_verifybyemployer', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_certbytrainer', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_verifybymahb', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('adppermit_verifybymahb_drivingarea', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_verifybymahb_vehicleclass', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_competencytest_date', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_attendbriefing', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_attendanceslip', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_examscheduled', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_approvedtotakeexam_by', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('adppermit_exampass', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('adppermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('adppermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('adppermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'adppermit_id',
            'adppermit_permit_id',
            'adppermit_driver_id',
            'adppermit_driveracknowledgement',
            'adppermit_verifybyemployer',
            'adppermit_certbytrainer',
            'adppermit_certbytrainer_date',
            'adppermit_verifybymahb',
            'adppermit_verifybymahb_drivingarea',
            'adppermit_verifybymahb_vehicleclass',
            'adppermit_course_date',
            'adppermit_competencytest_date',
            'adppermit_attendbriefing',
            'adppermit_attendanceslip',
            'adppermit_examscheduled',
            'adppermit_approvedtotakeexam_by',
            'adppermit_exampass',
            'adppermit_completed_docs',
            'adppermit_approvedby_airside',
            'adppermit_created_at',
            'adppermit_updated_at',
            'adppermit_deleted_at',
            'adppermit_lastchanged_by',

        ];
        $results = $this->adppermit_model->listajax(
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
                $rud .= anchor(site_url('adppermit/read/' . fixzy_encoder($r['adppermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('adppermit/update/' . fixzy_encoder($r['adppermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('adppermit/delete/' . fixzy_encoder($r['adppermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['adppermit_permit_id'],
                $r['adppermit_driver_id'],
                $r['adppermit_driveracknowledgement'],
                $r['adppermit_verifybyemployer'],
                $r['adppermit_certbytrainer'],
                $r['adppermit_certbytrainer_date'],
                $r['adppermit_verifybymahb'],
                $r['adppermit_verifybymahb_drivingarea'],
                $r['adppermit_verifybymahb_vehicleclass'],
                $r['adppermit_course_date'],
                $r['adppermit_competencytest_date'],
                $r['adppermit_attendbriefing'],
                $r['adppermit_attendanceslip'],
                $r['adppermit_examscheduled'],
                $r['adppermit_approvedtotakeexam_by'],
                $r['adppermit_exampass'],
                $r['adppermit_completed_docs'],
                $r['adppermit_approvedby_airside'],
                $r['adppermit_created_at'],
                $r['adppermit_updated_at'],
                $r['adppermit_deleted_at'],
                $r['adppermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->adppermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->adppermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Adppermit.php */
/* Location: ./application/controllers/Adppermit.php */
