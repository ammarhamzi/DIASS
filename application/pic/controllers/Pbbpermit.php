<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pbbpermit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pbbpermit_model');
        $this->lang->load('pbbpermit_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$pbbpermit = $this->pbbpermit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'pbbpermit_data' => $pbbpermit,
                'permission' => $this->permission,
            ];

            $this->content = 'pbbpermit/pbbpermit_list';
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
            $row = $this->pbbpermit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pbbpermit_permit_id' => $row->pbbpermit_permit_id,
                    'pbbpermit_driver_id' => $row->pbbpermit_driver_id,
                    'pbbpermit_recent_permitno' => $row->pbbpermit_recent_permitno,
                    'pbbpermit_recent_expirydate' => $row->pbbpermit_recent_expirydate,
                    'pbbpermit_driveracknowledgement' => $row->pbbpermit_driveracknowledgement,
                    'pbbpermit_driveracknowledgement_date' => $row->pbbpermit_driveracknowledgement_date,
                    'pbbpermit_certbyemployer' => $row->pbbpermit_certbyemployer,
                    'pbbpermit_certbyemployer_date' => $row->pbbpermit_certbyemployer_date,
                    'pbbpermit_certbytrainer' => $row->pbbpermit_certbytrainer,
                    'pbbpermit_certbytrainer_date' => $row->pbbpermit_certbytrainer_date,
                    'pbbpermit_course_date' => $row->pbbpermit_course_date,
                    'pbbpermit_pbbbriefingscheduled' => $row->pbbpermit_pbbbriefingscheduled,
                    'pbbpermit_pbbbriefingapproval' => $row->pbbpermit_pbbbriefingapproval,
                    'pbbpermit_attendpbbbriefing' => $row->pbbpermit_attendpbbbriefing,
                    'pbbpermit_completed_docs' => $row->pbbpermit_completed_docs,
                    'pbbpermit_approvedby_airside' => $row->pbbpermit_approvedby_airside,
                    'pbbpermit_created_at' => $row->pbbpermit_created_at,
                    'pbbpermit_updated_at' => $row->pbbpermit_updated_at,
                    'pbbpermit_deleted_at' => $row->pbbpermit_deleted_at,
                    'pbbpermit_lastchanged_by' => $row->pbbpermit_lastchanged_by,

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

                    $this->content = 'pbbpermit/pbbpermit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('pbbpermit/pbbpermit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbpermit'));
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
                'action' => site_url('pbbpermit/create_action'),
                'pbbpermit_permit_id' => set_value('pbbpermit_permit_id'),
                'pbbpermit_driver_id' => set_value('pbbpermit_driver_id'),
                'pbbpermit_recent_permitno' => set_value('pbbpermit_recent_permitno'),
                'pbbpermit_recent_expirydate' => set_value('pbbpermit_recent_expirydate'),
                'pbbpermit_driveracknowledgement' => set_value('pbbpermit_driveracknowledgement'),
                'pbbpermit_driveracknowledgement_date' => set_value('pbbpermit_driveracknowledgement_date'),
                'pbbpermit_certbyemployer' => set_value('pbbpermit_certbyemployer'),
                'pbbpermit_certbyemployer_date' => set_value('pbbpermit_certbyemployer_date'),
                'pbbpermit_certbytrainer' => set_value('pbbpermit_certbytrainer'),
                'pbbpermit_certbytrainer_date' => set_value('pbbpermit_certbytrainer_date'),
                'pbbpermit_course_date' => set_value('pbbpermit_course_date'),
                'pbbpermit_pbbbriefingscheduled' => set_value('pbbpermit_pbbbriefingscheduled'),
                'pbbpermit_pbbbriefingapproval' => set_value('pbbpermit_pbbbriefingapproval'),
                'pbbpermit_attendpbbbriefing' => set_value('pbbpermit_attendpbbbriefing'),
                'pbbpermit_completed_docs' => set_value('pbbpermit_completed_docs'),
                'pbbpermit_approvedby_airside' => set_value('pbbpermit_approvedby_airside'),
                'pbbpermit_created_at' => set_value('pbbpermit_created_at'),
                'pbbpermit_updated_at' => set_value('pbbpermit_updated_at'),
                'pbbpermit_deleted_at' => set_value('pbbpermit_deleted_at'),
                'pbbpermit_lastchanged_by' => set_value('pbbpermit_lastchanged_by'),

            ];
            $this->content = 'pbbpermit/pbbpermit_form';
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
                    'pbbpermit_permit_id' => $this->input->post('pbbpermit_permit_id', true),
                    'pbbpermit_driver_id' => $this->input->post('pbbpermit_driver_id', true),
                    'pbbpermit_recent_permitno' => $this->input->post('pbbpermit_recent_permitno', true),
                    'pbbpermit_recent_expirydate' => $this->input->post('pbbpermit_recent_expirydate', true),
                    'pbbpermit_driveracknowledgement' => $this->input->post('pbbpermit_driveracknowledgement', true),
                    'pbbpermit_driveracknowledgement_date' => $this->input->post('pbbpermit_driveracknowledgement_date', true),
                    'pbbpermit_certbyemployer' => $this->input->post('pbbpermit_certbyemployer', true),
                    'pbbpermit_certbyemployer_date' => $this->input->post('pbbpermit_certbyemployer_date', true),
                    'pbbpermit_certbytrainer' => $this->input->post('pbbpermit_certbytrainer', true),
                    'pbbpermit_certbytrainer_date' => $this->input->post('pbbpermit_certbytrainer_date', true),
                    'pbbpermit_course_date' => $this->input->post('pbbpermit_course_date', true),
                    'pbbpermit_pbbbriefingscheduled' => $this->input->post('pbbpermit_pbbbriefingscheduled', true),
                    'pbbpermit_pbbbriefingapproval' => $this->input->post('pbbpermit_pbbbriefingapproval', true),
                    'pbbpermit_attendpbbbriefing' => $this->input->post('pbbpermit_attendpbbbriefing', true),
                    'pbbpermit_completed_docs' => $this->input->post('pbbpermit_completed_docs', true),
                    'pbbpermit_approvedby_airside' => $this->input->post('pbbpermit_approvedby_airside', true),
                    'pbbpermit_created_at' => $this->input->post('pbbpermit_created_at', true),
                    'pbbpermit_updated_at' => $this->input->post('pbbpermit_updated_at', true),
                    'pbbpermit_deleted_at' => $this->input->post('pbbpermit_deleted_at', true),
                    'pbbpermit_lastchanged_by' => $this->input->post('pbbpermit_lastchanged_by', true),
                    'pbbpermit_created_at' => date('Y-m-d H:i:s'),
                    'pbbpermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pbbpermit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pbbpermit'));
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
            $row = $this->pbbpermit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('pbbpermit/update_action'),
                    'id' => $id,
                    'pbbpermit_permit_id' => set_value('pbbpermit_permit_id', $row->pbbpermit_permit_id),
                    'pbbpermit_driver_id' => set_value('pbbpermit_driver_id', $row->pbbpermit_driver_id),
                    'pbbpermit_recent_permitno' => set_value('pbbpermit_recent_permitno', $row->pbbpermit_recent_permitno),
                    'pbbpermit_recent_expirydate' => set_value('pbbpermit_recent_expirydate', $row->pbbpermit_recent_expirydate),
                    'pbbpermit_driveracknowledgement' => set_value('pbbpermit_driveracknowledgement', $row->pbbpermit_driveracknowledgement),
                    'pbbpermit_driveracknowledgement_date' => set_value('pbbpermit_driveracknowledgement_date', $row->pbbpermit_driveracknowledgement_date),
                    'pbbpermit_certbyemployer' => set_value('pbbpermit_certbyemployer', $row->pbbpermit_certbyemployer),
                    'pbbpermit_certbyemployer_date' => set_value('pbbpermit_certbyemployer_date', $row->pbbpermit_certbyemployer_date),
                    'pbbpermit_certbytrainer' => set_value('pbbpermit_certbytrainer', $row->pbbpermit_certbytrainer),
                    'pbbpermit_certbytrainer_date' => set_value('pbbpermit_certbytrainer_date', $row->pbbpermit_certbytrainer_date),
                    'pbbpermit_course_date' => set_value('pbbpermit_course_date', $row->pbbpermit_course_date),
                    'pbbpermit_pbbbriefingscheduled' => set_value('pbbpermit_pbbbriefingscheduled', $row->pbbpermit_pbbbriefingscheduled),
                    'pbbpermit_pbbbriefingapproval' => set_value('pbbpermit_pbbbriefingapproval', $row->pbbpermit_pbbbriefingapproval),
                    'pbbpermit_attendpbbbriefing' => set_value('pbbpermit_attendpbbbriefing', $row->pbbpermit_attendpbbbriefing),
                    'pbbpermit_completed_docs' => set_value('pbbpermit_completed_docs', $row->pbbpermit_completed_docs),
                    'pbbpermit_approvedby_airside' => set_value('pbbpermit_approvedby_airside', $row->pbbpermit_approvedby_airside),
                    'pbbpermit_created_at' => set_value('pbbpermit_created_at', $row->pbbpermit_created_at),
                    'pbbpermit_updated_at' => set_value('pbbpermit_updated_at', $row->pbbpermit_updated_at),
                    'pbbpermit_deleted_at' => set_value('pbbpermit_deleted_at', $row->pbbpermit_deleted_at),
                    'pbbpermit_lastchanged_by' => set_value('pbbpermit_lastchanged_by', $row->pbbpermit_lastchanged_by),

                ];
                $this->content = 'pbbpermit/pbbpermit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbpermit'));
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
                $this->update($this->input->post('pbbpermit_id', true));
            } else {
                $data = [
                    'pbbpermit_permit_id' => $this->input->post('pbbpermit_permit_id', true),
                    'pbbpermit_driver_id' => $this->input->post('pbbpermit_driver_id', true),
                    'pbbpermit_recent_permitno' => $this->input->post('pbbpermit_recent_permitno', true),
                    'pbbpermit_recent_expirydate' => $this->input->post('pbbpermit_recent_expirydate', true),
                    'pbbpermit_driveracknowledgement' => $this->input->post('pbbpermit_driveracknowledgement', true),
                    'pbbpermit_driveracknowledgement_date' => $this->input->post('pbbpermit_driveracknowledgement_date', true),
                    'pbbpermit_certbyemployer' => $this->input->post('pbbpermit_certbyemployer', true),
                    'pbbpermit_certbyemployer_date' => $this->input->post('pbbpermit_certbyemployer_date', true),
                    'pbbpermit_certbytrainer' => $this->input->post('pbbpermit_certbytrainer', true),
                    'pbbpermit_certbytrainer_date' => $this->input->post('pbbpermit_certbytrainer_date', true),
                    'pbbpermit_course_date' => $this->input->post('pbbpermit_course_date', true),
                    'pbbpermit_pbbbriefingscheduled' => $this->input->post('pbbpermit_pbbbriefingscheduled', true),
                    'pbbpermit_pbbbriefingapproval' => $this->input->post('pbbpermit_pbbbriefingapproval', true),
                    'pbbpermit_attendpbbbriefing' => $this->input->post('pbbpermit_attendpbbbriefing', true),
                    'pbbpermit_completed_docs' => $this->input->post('pbbpermit_completed_docs', true),
                    'pbbpermit_approvedby_airside' => $this->input->post('pbbpermit_approvedby_airside', true),
                    'pbbpermit_created_at' => $this->input->post('pbbpermit_created_at', true),
                    'pbbpermit_updated_at' => $this->input->post('pbbpermit_updated_at', true),
                    'pbbpermit_deleted_at' => $this->input->post('pbbpermit_deleted_at', true),
                    'pbbpermit_lastchanged_by' => $this->input->post('pbbpermit_lastchanged_by', true),
                    'pbbpermit_updated_at' => date('Y-m-d H:i:s'),
                    'pbbpermit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pbbpermit_model->update(fixzy_decoder($this->input->post('pbbpermit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('pbbpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pbbpermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->pbbpermit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pbbpermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pbbpermit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pbbpermit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->pbbpermit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pbbpermit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbpermit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('pbbpermit_permit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pbbpermit_driver_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pbbpermit_recent_permitno', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_recent_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_driveracknowledgement', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_driveracknowledgement_date', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_certbyemployer', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_certbyemployer_date', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_certbytrainer', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pbbpermit_certbytrainer_date', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_course_date', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_pbbbriefingscheduled', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_pbbbriefingapproval', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pbbpermit_attendpbbbriefing', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_completed_docs', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_approvedby_airside', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pbbpermit_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('pbbpermit_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('pbbpermit_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'pbbpermit_id',
            'pbbpermit_permit_id',
            'pbbpermit_driver_id',
            'pbbpermit_recent_permitno',
            'pbbpermit_recent_expirydate',
            'pbbpermit_driveracknowledgement',
            'pbbpermit_driveracknowledgement_date',
            'pbbpermit_certbyemployer',
            'pbbpermit_certbyemployer_date',
            'pbbpermit_certbytrainer',
            'pbbpermit_certbytrainer_date',
            'pbbpermit_course_date',
            'pbbpermit_pbbbriefingscheduled',
            'pbbpermit_pbbbriefingapproval',
            'pbbpermit_attendpbbbriefing',
            'pbbpermit_completed_docs',
            'pbbpermit_approvedby_airside',
            'pbbpermit_created_at',
            'pbbpermit_updated_at',
            'pbbpermit_deleted_at',
            'pbbpermit_lastchanged_by',

        ];
        $results = $this->pbbpermit_model->listajax(
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
                $rud .= anchor(site_url('pbbpermit/read/' . fixzy_encoder($r['pbbpermit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('pbbpermit/update/' . fixzy_encoder($r['pbbpermit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('pbbpermit/delete/' . fixzy_encoder($r['pbbpermit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['pbbpermit_permit_id'],
                $r['pbbpermit_driver_id'],
                $r['pbbpermit_recent_permitno'],
                $r['pbbpermit_recent_expirydate'],
                $r['pbbpermit_driveracknowledgement'],
                $r['pbbpermit_driveracknowledgement_date'],
                $r['pbbpermit_certbyemployer'],
                $r['pbbpermit_certbyemployer_date'],
                $r['pbbpermit_certbytrainer'],
                $r['pbbpermit_certbytrainer_date'],
                $r['pbbpermit_course_date'],
                $r['pbbpermit_pbbbriefingscheduled'],
                $r['pbbpermit_pbbbriefingapproval'],
                $r['pbbpermit_attendpbbbriefing'],
                $r['pbbpermit_completed_docs'],
                $r['pbbpermit_approvedby_airside'],
                $r['pbbpermit_created_at'],
                $r['pbbpermit_updated_at'],
                $r['pbbpermit_deleted_at'],
                $r['pbbpermit_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->pbbpermit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->pbbpermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Pbbpermit.php */
/* Location: ./application/controllers/Pbbpermit.php */
