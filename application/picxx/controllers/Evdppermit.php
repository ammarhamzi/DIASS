<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Evdppermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('evdppermit_model');
        $this->lang->load('evdppermit_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$evdppermit = $this->evdppermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                /*'evdppermit_data' => $evdppermit,*/
                'permission' => $this->permission,
            ];

            $this->content = 'evdppermit/evdppermit_list';
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
            $row = $this->evdppermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'evdppermit_permit_id' => $row->evdppermit_permit_id,
                    'evdppermit_driver_id' => $row->evdppermit_driver_id,
                    'evdppermit_recent_permitno' => $row->evdppermit_recent_permitno,
                    'evdppermit_recent_expirydate' => $row->evdppermit_recent_expirydate,
                    'evdppermit_driveracknowledgement' => $row->evdppermit_driveracknowledgement,
                    'evdppermit_driveracknowledgement_date' => $row->evdppermit_driveracknowledgement_date,
                    'evdppermit_certbyemployer' => $row->evdppermit_certbyemployer,
                    'evdppermit_certbyemployer_date' => $row->evdppermit_certbyemployer_date,
                    'evdppermit_certbytrainer' => $row->evdppermit_certbytrainer,
                    'evdppermit_certbytrainer_date' => $row->evdppermit_certbytrainer_date,
                    'evdppermit_course_date' => $row->evdppermit_course_date,
                    'evdppermit_terminalbriefingscheduled' => $row->evdppermit_terminalbriefingscheduled,
                    'evdppermit_terminalbriefingapproval' => $row->evdppermit_terminalbriefingapproval,
                    'evdppermit_attendterminalbriefing' => $row->evdppermit_attendterminalbriefing,
                    'evdppermit_completed_docs' => $row->evdppermit_completed_docs,
                    'evdppermit_approvedby_airside' => $row->evdppermit_approvedby_airside,
                    'evdppermit_created_at' => $row->evdppermit_created_at,
                    'evdppermit_updated_at' => $row->evdppermit_updated_at,
                    'evdppermit_deleted_at' => $row->evdppermit_deleted_at,
                    'evdppermit_lastchanged_by' => $row->evdppermit_lastchanged_by,

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

                    $this->content = 'evdppermit/evdppermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('evdppermit/evdppermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('evdppermit'));
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
                'action' => site_url('evdppermit/create_action'),
                'evdppermit_permit_id' => set_value('evdppermit_permit_id'),
                'evdppermit_driver_id' => set_value('evdppermit_driver_id'),
                'evdppermit_recent_permitno' => set_value('evdppermit_recent_permitno'),
                'evdppermit_recent_expirydate' => set_value('evdppermit_recent_expirydate'),
                'evdppermit_driveracknowledgement' => set_value('evdppermit_driveracknowledgement'),
                'evdppermit_driveracknowledgement_date' => set_value('evdppermit_driveracknowledgement_date'),
                'evdppermit_certbyemployer' => set_value('evdppermit_certbyemployer'),
                'evdppermit_certbyemployer_date' => set_value('evdppermit_certbyemployer_date'),
                'evdppermit_certbytrainer' => set_value('evdppermit_certbytrainer'),
                'evdppermit_certbytrainer_date' => set_value('evdppermit_certbytrainer_date'),
                'evdppermit_course_date' => set_value('evdppermit_course_date'),
                'evdppermit_terminalbriefingscheduled' => set_value('evdppermit_terminalbriefingscheduled'),
                'evdppermit_terminalbriefingapproval' => set_value('evdppermit_terminalbriefingapproval'),
                'evdppermit_attendterminalbriefing' => set_value('evdppermit_attendterminalbriefing'),
                'evdppermit_completed_docs' => set_value('evdppermit_completed_docs'),
                'evdppermit_approvedby_airside' => set_value('evdppermit_approvedby_airside'),
                'evdppermit_created_at' => set_value('evdppermit_created_at'),
                'evdppermit_updated_at' => set_value('evdppermit_updated_at'),
                'evdppermit_deleted_at' => set_value('evdppermit_deleted_at'),
                'evdppermit_lastchanged_by' => set_value('evdppermit_lastchanged_by'),

            ];
            $this->content = 'evdppermit/evdppermit_form';
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
                    'evdppermit_permit_id' => $this->input->post('evdppermit_permit_id', true),
                    'evdppermit_driver_id' => $this->input->post('evdppermit_driver_id', true),
                    'evdppermit_recent_permitno' => $this->input->post('evdppermit_recent_permitno', true),
                    'evdppermit_recent_expirydate' => $this->input->post('evdppermit_recent_expirydate', true),
                    'evdppermit_driveracknowledgement' => $this->input->post('evdppermit_driveracknowledgement', true),
                    'evdppermit_driveracknowledgement_date' => $this->input->post('evdppermit_driveracknowledgement_date', true),
                    'evdppermit_certbyemployer' => $this->input->post('evdppermit_certbyemployer', true),
                    'evdppermit_certbyemployer_date' => $this->input->post('evdppermit_certbyemployer_date', true),
                    'evdppermit_certbytrainer' => $this->input->post('evdppermit_certbytrainer', true),
                    'evdppermit_certbytrainer_date' => $this->input->post('evdppermit_certbytrainer_date', true),
                    'evdppermit_course_date' => $this->input->post('evdppermit_course_date', true),
                    'evdppermit_terminalbriefingscheduled' => $this->input->post('evdppermit_terminalbriefingscheduled', true),
                    'evdppermit_terminalbriefingapproval' => $this->input->post('evdppermit_terminalbriefingapproval', true),
                    'evdppermit_attendterminalbriefing' => $this->input->post('evdppermit_attendterminalbriefing', true),
                    'evdppermit_completed_docs' => $this->input->post('evdppermit_completed_docs', true),
                    'evdppermit_approvedby_airside' => $this->input->post('evdppermit_approvedby_airside', true),
                    'evdppermit_created_at' => $this->input->post('evdppermit_created_at', true),
                    'evdppermit_updated_at' => $this->input->post('evdppermit_updated_at', true),
                    'evdppermit_deleted_at' => $this->input->post('evdppermit_deleted_at', true),
                    'evdppermit_lastchanged_by' => $this->input->post('evdppermit_lastchanged_by', true),
                    'evdppermit_created_at' => date('Y-m-d H:i:s'),
                    'evdppermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->evdppermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('evdppermit'));
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
            $row = $this->evdppermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('evdppermit/update_action'),
                    'id' => $id,
                    'evdppermit_permit_id' => set_value('evdppermit_permit_id', $row->evdppermit_permit_id),
                    'evdppermit_driver_id' => set_value('evdppermit_driver_id', $row->evdppermit_driver_id),
                    'evdppermit_recent_permitno' => set_value('evdppermit_recent_permitno', $row->evdppermit_recent_permitno),
                    'evdppermit_recent_expirydate' => set_value('evdppermit_recent_expirydate', $row->evdppermit_recent_expirydate),
                    'evdppermit_driveracknowledgement' => set_value('evdppermit_driveracknowledgement', $row->evdppermit_driveracknowledgement),
                    'evdppermit_driveracknowledgement_date' => set_value('evdppermit_driveracknowledgement_date', $row->evdppermit_driveracknowledgement_date),
                    'evdppermit_certbyemployer' => set_value('evdppermit_certbyemployer', $row->evdppermit_certbyemployer),
                    'evdppermit_certbyemployer_date' => set_value('evdppermit_certbyemployer_date', $row->evdppermit_certbyemployer_date),
                    'evdppermit_certbytrainer' => set_value('evdppermit_certbytrainer', $row->evdppermit_certbytrainer),
                    'evdppermit_certbytrainer_date' => set_value('evdppermit_certbytrainer_date', $row->evdppermit_certbytrainer_date),
                    'evdppermit_course_date' => set_value('evdppermit_course_date', $row->evdppermit_course_date),
                    'evdppermit_terminalbriefingscheduled' => set_value('evdppermit_terminalbriefingscheduled', $row->evdppermit_terminalbriefingscheduled),
                    'evdppermit_terminalbriefingapproval' => set_value('evdppermit_terminalbriefingapproval', $row->evdppermit_terminalbriefingapproval),
                    'evdppermit_attendterminalbriefing' => set_value('evdppermit_attendterminalbriefing', $row->evdppermit_attendterminalbriefing),
                    'evdppermit_completed_docs' => set_value('evdppermit_completed_docs', $row->evdppermit_completed_docs),
                    'evdppermit_approvedby_airside' => set_value('evdppermit_approvedby_airside', $row->evdppermit_approvedby_airside),
                    'evdppermit_created_at' => set_value('evdppermit_created_at', $row->evdppermit_created_at),
                    'evdppermit_updated_at' => set_value('evdppermit_updated_at', $row->evdppermit_updated_at),
                    'evdppermit_deleted_at' => set_value('evdppermit_deleted_at', $row->evdppermit_deleted_at),
                    'evdppermit_lastchanged_by' => set_value('evdppermit_lastchanged_by', $row->evdppermit_lastchanged_by),

                ];
                $this->content = 'evdppermit/evdppermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('evdppermit'));
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
                $this->update($this->input->post('evdppermit_id', true));
            } else {
                $data = [
                    'evdppermit_permit_id' => $this->input->post('evdppermit_permit_id', true),
                    'evdppermit_driver_id' => $this->input->post('evdppermit_driver_id', true),
                    'evdppermit_recent_permitno' => $this->input->post('evdppermit_recent_permitno', true),
                    'evdppermit_recent_expirydate' => $this->input->post('evdppermit_recent_expirydate', true),
                    'evdppermit_driveracknowledgement' => $this->input->post('evdppermit_driveracknowledgement', true),
                    'evdppermit_driveracknowledgement_date' => $this->input->post('evdppermit_driveracknowledgement_date', true),
                    'evdppermit_certbyemployer' => $this->input->post('evdppermit_certbyemployer', true),
                    'evdppermit_certbyemployer_date' => $this->input->post('evdppermit_certbyemployer_date', true),
                    'evdppermit_certbytrainer' => $this->input->post('evdppermit_certbytrainer', true),
                    'evdppermit_certbytrainer_date' => $this->input->post('evdppermit_certbytrainer_date', true),
                    'evdppermit_course_date' => $this->input->post('evdppermit_course_date', true),
                    'evdppermit_terminalbriefingscheduled' => $this->input->post('evdppermit_terminalbriefingscheduled', true),
                    'evdppermit_terminalbriefingapproval' => $this->input->post('evdppermit_terminalbriefingapproval', true),
                    'evdppermit_attendterminalbriefing' => $this->input->post('evdppermit_attendterminalbriefing', true),
                    'evdppermit_completed_docs' => $this->input->post('evdppermit_completed_docs', true),
                    'evdppermit_approvedby_airside' => $this->input->post('evdppermit_approvedby_airside', true),
                    'evdppermit_created_at' => $this->input->post('evdppermit_created_at', true),
                    'evdppermit_updated_at' => $this->input->post('evdppermit_updated_at', true),
                    'evdppermit_deleted_at' => $this->input->post('evdppermit_deleted_at', true),
                    'evdppermit_lastchanged_by' => $this->input->post('evdppermit_lastchanged_by', true),
                    'evdppermit_updated_at' => date('Y-m-d H:i:s'),
                    'evdppermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->evdppermit_model->update(fixzy_decoder($this->input->post('evdppermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('evdppermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->evdppermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->evdppermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('evdppermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('evdppermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->evdppermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'evdppermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->evdppermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('evdppermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('evdppermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('evdppermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('evdppermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('evdppermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('evdppermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_terminalbriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_terminalbriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('evdppermit_attendterminalbriefing', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('evdppermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('evdppermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('evdppermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'evdppermit_id',
            'evdppermit_permit_id',
            'evdppermit_driver_id',
            'evdppermit_recent_permitno',
            'evdppermit_recent_expirydate',
            'evdppermit_driveracknowledgement',
            'evdppermit_driveracknowledgement_date',
            'evdppermit_certbyemployer',
            'evdppermit_certbyemployer_date',
            'evdppermit_certbytrainer',
            'evdppermit_certbytrainer_date',
            'evdppermit_course_date',
            'evdppermit_terminalbriefingscheduled',
            'evdppermit_terminalbriefingapproval',
            'evdppermit_attendterminalbriefing',
            'evdppermit_completed_docs',
            'evdppermit_approvedby_airside',
            'evdppermit_created_at',
            'evdppermit_updated_at',
            'evdppermit_deleted_at',
            'evdppermit_lastchanged_by',

        ];
        $results = $this->evdppermit_model->listajax(
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
                $rud .= anchor(site_url('evdppermit/read/' . fixzy_encoder($r['evdppermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('evdppermit/update/' . fixzy_encoder($r['evdppermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('evdppermit/delete/' . fixzy_encoder($r['evdppermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['evdppermit_permit_id'],
                $r['evdppermit_driver_id'],
                $r['evdppermit_recent_permitno'],
                $r['evdppermit_recent_expirydate'],
                $r['evdppermit_driveracknowledgement'],
                $r['evdppermit_driveracknowledgement_date'],
                $r['evdppermit_certbyemployer'],
                $r['evdppermit_certbyemployer_date'],
                $r['evdppermit_certbytrainer'],
                $r['evdppermit_certbytrainer_date'],
                $r['evdppermit_course_date'],
                $r['evdppermit_terminalbriefingscheduled'],
                $r['evdppermit_terminalbriefingapproval'],
                $r['evdppermit_attendterminalbriefing'],
                $r['evdppermit_completed_docs'],
                $r['evdppermit_approvedby_airside'],
                $r['evdppermit_created_at'],
                $r['evdppermit_updated_at'],
                $r['evdppermit_deleted_at'],
                $r['evdppermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->evdppermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->evdppermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Evdppermit.php */
/* Location: ./application/controllers/Evdppermit.php */
