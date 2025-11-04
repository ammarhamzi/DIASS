<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cspermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cspermit_model');
        $this->lang->load('cspermit_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$cspermit = $this->cspermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                /*'cspermit_data' => $cspermit,*/
                'permission' => $this->permission,
            ];

            $this->content = 'cspermit/cspermit_list';
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
            $row = $this->cspermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'cspermit_permit_id' => $row->cspermit_permit_id,
                    'cspermit_driver_id' => $row->cspermit_driver_id,
                    'cspermit_recent_permitno' => $row->cspermit_recent_permitno,
                    'cspermit_recent_expirydate' => $row->cspermit_recent_expirydate,
                    'cspermit_driveracknowledgement' => $row->cspermit_driveracknowledgement,
                    'cspermit_driveracknowledgement_date' => $row->cspermit_driveracknowledgement_date,
                    'cspermit_certbyemployer' => $row->cspermit_certbyemployer,
                    'cspermit_certbyemployer_date' => $row->cspermit_certbyemployer_date,
                    'cspermit_certbytrainer' => $row->cspermit_certbytrainer,
                    'cspermit_certbytrainer_date' => $row->cspermit_certbytrainer_date,
                    'cspermit_course_date' => $row->cspermit_course_date,
                    'cspermit_csbriefingscheduled' => $row->cspermit_csbriefingscheduled,
                    'cspermit_csbriefingapproval' => $row->cspermit_csbriefingapproval,
                    'cspermit_attendcsbriefing' => $row->cspermit_attendcsbriefing,
                    'cspermit_completed_docs' => $row->cspermit_completed_docs,
                    'cspermit_approvedby_airside' => $row->cspermit_approvedby_airside,
                    'cspermit_created_at' => $row->cspermit_created_at,
                    'cspermit_updated_at' => $row->cspermit_updated_at,
                    'cspermit_deleted_at' => $row->cspermit_deleted_at,
                    'cspermit_lastchanged_by' => $row->cspermit_lastchanged_by,

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

                    $this->content = 'cspermit/cspermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('cspermit/cspermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('cspermit'));
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
                'action' => site_url('cspermit/create_action'),
                'cspermit_permit_id' => set_value('cspermit_permit_id'),
                'cspermit_driver_id' => set_value('cspermit_driver_id'),
                'cspermit_recent_permitno' => set_value('cspermit_recent_permitno'),
                'cspermit_recent_expirydate' => set_value('cspermit_recent_expirydate'),
                'cspermit_driveracknowledgement' => set_value('cspermit_driveracknowledgement'),
                'cspermit_driveracknowledgement_date' => set_value('cspermit_driveracknowledgement_date'),
                'cspermit_certbyemployer' => set_value('cspermit_certbyemployer'),
                'cspermit_certbyemployer_date' => set_value('cspermit_certbyemployer_date'),
                'cspermit_certbytrainer' => set_value('cspermit_certbytrainer'),
                'cspermit_certbytrainer_date' => set_value('cspermit_certbytrainer_date'),
                'cspermit_course_date' => set_value('cspermit_course_date'),
                'cspermit_csbriefingscheduled' => set_value('cspermit_csbriefingscheduled'),
                'cspermit_csbriefingapproval' => set_value('cspermit_csbriefingapproval'),
                'cspermit_attendcsbriefing' => set_value('cspermit_attendcsbriefing'),
                'cspermit_completed_docs' => set_value('cspermit_completed_docs'),
                'cspermit_approvedby_airside' => set_value('cspermit_approvedby_airside'),
                'cspermit_created_at' => set_value('cspermit_created_at'),
                'cspermit_updated_at' => set_value('cspermit_updated_at'),
                'cspermit_deleted_at' => set_value('cspermit_deleted_at'),
                'cspermit_lastchanged_by' => set_value('cspermit_lastchanged_by'),

            ];
            $this->content = 'cspermit/cspermit_form';
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
                    'cspermit_permit_id' => $this->input->post('cspermit_permit_id', true),
                    'cspermit_driver_id' => $this->input->post('cspermit_driver_id', true),
                    'cspermit_recent_permitno' => $this->input->post('cspermit_recent_permitno', true),
                    'cspermit_recent_expirydate' => $this->input->post('cspermit_recent_expirydate', true),
                    'cspermit_driveracknowledgement' => $this->input->post('cspermit_driveracknowledgement', true),
                    'cspermit_driveracknowledgement_date' => $this->input->post('cspermit_driveracknowledgement_date', true),
                    'cspermit_certbyemployer' => $this->input->post('cspermit_certbyemployer', true),
                    'cspermit_certbyemployer_date' => $this->input->post('cspermit_certbyemployer_date', true),
                    'cspermit_certbytrainer' => $this->input->post('cspermit_certbytrainer', true),
                    'cspermit_certbytrainer_date' => $this->input->post('cspermit_certbytrainer_date', true),
                    'cspermit_course_date' => $this->input->post('cspermit_course_date', true),
                    'cspermit_csbriefingscheduled' => $this->input->post('cspermit_csbriefingscheduled', true),
                    'cspermit_csbriefingapproval' => $this->input->post('cspermit_csbriefingapproval', true),
                    'cspermit_attendcsbriefing' => $this->input->post('cspermit_attendcsbriefing', true),
                    'cspermit_completed_docs' => $this->input->post('cspermit_completed_docs', true),
                    'cspermit_approvedby_airside' => $this->input->post('cspermit_approvedby_airside', true),
                    'cspermit_created_at' => $this->input->post('cspermit_created_at', true),
                    'cspermit_updated_at' => $this->input->post('cspermit_updated_at', true),
                    'cspermit_deleted_at' => $this->input->post('cspermit_deleted_at', true),
                    'cspermit_lastchanged_by' => $this->input->post('cspermit_lastchanged_by', true),
                    'cspermit_created_at' => date('Y-m-d H:i:s'),
                    'cspermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->cspermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('cspermit'));
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
            $row = $this->cspermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('cspermit/update_action'),
                    'id' => $id,
                    'cspermit_permit_id' => set_value('cspermit_permit_id', $row->cspermit_permit_id),
                    'cspermit_driver_id' => set_value('cspermit_driver_id', $row->cspermit_driver_id),
                    'cspermit_recent_permitno' => set_value('cspermit_recent_permitno', $row->cspermit_recent_permitno),
                    'cspermit_recent_expirydate' => set_value('cspermit_recent_expirydate', $row->cspermit_recent_expirydate),
                    'cspermit_driveracknowledgement' => set_value('cspermit_driveracknowledgement', $row->cspermit_driveracknowledgement),
                    'cspermit_driveracknowledgement_date' => set_value('cspermit_driveracknowledgement_date', $row->cspermit_driveracknowledgement_date),
                    'cspermit_certbyemployer' => set_value('cspermit_certbyemployer', $row->cspermit_certbyemployer),
                    'cspermit_certbyemployer_date' => set_value('cspermit_certbyemployer_date', $row->cspermit_certbyemployer_date),
                    'cspermit_certbytrainer' => set_value('cspermit_certbytrainer', $row->cspermit_certbytrainer),
                    'cspermit_certbytrainer_date' => set_value('cspermit_certbytrainer_date', $row->cspermit_certbytrainer_date),
                    'cspermit_course_date' => set_value('cspermit_course_date', $row->cspermit_course_date),
                    'cspermit_csbriefingscheduled' => set_value('cspermit_csbriefingscheduled', $row->cspermit_csbriefingscheduled),
                    'cspermit_csbriefingapproval' => set_value('cspermit_csbriefingapproval', $row->cspermit_csbriefingapproval),
                    'cspermit_attendcsbriefing' => set_value('cspermit_attendcsbriefing', $row->cspermit_attendcsbriefing),
                    'cspermit_completed_docs' => set_value('cspermit_completed_docs', $row->cspermit_completed_docs),
                    'cspermit_approvedby_airside' => set_value('cspermit_approvedby_airside', $row->cspermit_approvedby_airside),
                    'cspermit_created_at' => set_value('cspermit_created_at', $row->cspermit_created_at),
                    'cspermit_updated_at' => set_value('cspermit_updated_at', $row->cspermit_updated_at),
                    'cspermit_deleted_at' => set_value('cspermit_deleted_at', $row->cspermit_deleted_at),
                    'cspermit_lastchanged_by' => set_value('cspermit_lastchanged_by', $row->cspermit_lastchanged_by),

                ];
                $this->content = 'cspermit/cspermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('cspermit'));
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
                $this->update($this->input->post('cspermit_id', true));
            } else {
                $data = [
                    'cspermit_permit_id' => $this->input->post('cspermit_permit_id', true),
                    'cspermit_driver_id' => $this->input->post('cspermit_driver_id', true),
                    'cspermit_recent_permitno' => $this->input->post('cspermit_recent_permitno', true),
                    'cspermit_recent_expirydate' => $this->input->post('cspermit_recent_expirydate', true),
                    'cspermit_driveracknowledgement' => $this->input->post('cspermit_driveracknowledgement', true),
                    'cspermit_driveracknowledgement_date' => $this->input->post('cspermit_driveracknowledgement_date', true),
                    'cspermit_certbyemployer' => $this->input->post('cspermit_certbyemployer', true),
                    'cspermit_certbyemployer_date' => $this->input->post('cspermit_certbyemployer_date', true),
                    'cspermit_certbytrainer' => $this->input->post('cspermit_certbytrainer', true),
                    'cspermit_certbytrainer_date' => $this->input->post('cspermit_certbytrainer_date', true),
                    'cspermit_course_date' => $this->input->post('cspermit_course_date', true),
                    'cspermit_csbriefingscheduled' => $this->input->post('cspermit_csbriefingscheduled', true),
                    'cspermit_csbriefingapproval' => $this->input->post('cspermit_csbriefingapproval', true),
                    'cspermit_attendcsbriefing' => $this->input->post('cspermit_attendcsbriefing', true),
                    'cspermit_completed_docs' => $this->input->post('cspermit_completed_docs', true),
                    'cspermit_approvedby_airside' => $this->input->post('cspermit_approvedby_airside', true),
                    'cspermit_created_at' => $this->input->post('cspermit_created_at', true),
                    'cspermit_updated_at' => $this->input->post('cspermit_updated_at', true),
                    'cspermit_deleted_at' => $this->input->post('cspermit_deleted_at', true),
                    'cspermit_lastchanged_by' => $this->input->post('cspermit_lastchanged_by', true),
                    'cspermit_updated_at' => date('Y-m-d H:i:s'),
                    'cspermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->cspermit_model->update(fixzy_decoder($this->input->post('cspermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('cspermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->cspermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->cspermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('cspermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('cspermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->cspermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'cspermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->cspermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('cspermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('cspermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('cspermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('cspermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('cspermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('cspermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_csbriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_csbriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('cspermit_attendcsbriefing', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('cspermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('cspermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('cspermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'cspermit_id',
            'cspermit_permit_id',
            'cspermit_driver_id',
            'cspermit_recent_permitno',
            'cspermit_recent_expirydate',
            'cspermit_driveracknowledgement',
            'cspermit_driveracknowledgement_date',
            'cspermit_certbyemployer',
            'cspermit_certbyemployer_date',
            'cspermit_certbytrainer',
            'cspermit_certbytrainer_date',
            'cspermit_course_date',
            'cspermit_csbriefingscheduled',
            'cspermit_csbriefingapproval',
            'cspermit_attendcsbriefing',
            'cspermit_completed_docs',
            'cspermit_approvedby_airside',
            'cspermit_created_at',
            'cspermit_updated_at',
            'cspermit_deleted_at',
            'cspermit_lastchanged_by',

        ];
        $results = $this->cspermit_model->listajax(
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
                $rud .= anchor(site_url('cspermit/read/' . fixzy_encoder($r['cspermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('cspermit/update/' . fixzy_encoder($r['cspermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('cspermit/delete/' . fixzy_encoder($r['cspermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['cspermit_permit_id'],
                $r['cspermit_driver_id'],
                $r['cspermit_recent_permitno'],
                $r['cspermit_recent_expirydate'],
                $r['cspermit_driveracknowledgement'],
                $r['cspermit_driveracknowledgement_date'],
                $r['cspermit_certbyemployer'],
                $r['cspermit_certbyemployer_date'],
                $r['cspermit_certbytrainer'],
                $r['cspermit_certbytrainer_date'],
                $r['cspermit_course_date'],
                $r['cspermit_csbriefingscheduled'],
                $r['cspermit_csbriefingapproval'],
                $r['cspermit_attendcsbriefing'],
                $r['cspermit_completed_docs'],
                $r['cspermit_approvedby_airside'],
                $r['cspermit_created_at'],
                $r['cspermit_updated_at'],
                $r['cspermit_deleted_at'],
                $r['cspermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->cspermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->cspermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Cspermit.php */
/* Location: ./application/controllers/Cspermit.php */
