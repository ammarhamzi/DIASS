<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Gpubriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('gpubriefingmanagement_model');
        $this->lang->load('gpubriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
           // $gpubriefingmanagement = $this->gpubriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'gpubriefingmanagement_data' => $gpubriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'gpubriefingmanagement/gpubriefingmanagement_list';
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
            $row = $this->gpubriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'gpubriefingmanagement_date' => $row->gpubriefingmanagement_date,
                    'gpubriefingmanagement_slot' => $row->gpubriefingmanagement_slot,
                    'gpubriefingmanagement_slottaken' => $row->gpubriefingmanagement_slottaken,
                    'gpubriefingmanagement_location' => $row->gpubriefingmanagement_location,
                    'gpubriefingmanagement_officer_pic' => $row->gpubriefingmanagement_officer_pic,
                    'gpubriefingmanagement_remark' => $row->gpubriefingmanagement_remark,
                    'gpubriefingmanagement_created_at' => $row->gpubriefingmanagement_created_at,
                    'gpubriefingmanagement_updated_at' => $row->gpubriefingmanagement_updated_at,
                    'gpubriefingmanagement_deleted_at' => $row->gpubriefingmanagement_deleted_at,
                    'gpubriefingmanagement_lastchanged_by' => $row->gpubriefingmanagement_lastchanged_by,

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

                    $this->content = 'gpubriefingmanagement/gpubriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('gpubriefingmanagement/gpubriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpubriefingmanagement'));
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
                'action' => site_url('gpubriefingmanagement/create_action'),
                'gpubriefingmanagement_date' => set_value('gpubriefingmanagement_date'),
                'gpubriefingmanagement_slot' => set_value('gpubriefingmanagement_slot'),
                'gpubriefingmanagement_slottaken' => set_value('gpubriefingmanagement_slottaken'),
                'gpubriefingmanagement_location' => set_value('gpubriefingmanagement_location'),
                'gpubriefingmanagement_officer_pic' => set_value('gpubriefingmanagement_officer_pic'),
                'gpubriefingmanagement_remark' => set_value('gpubriefingmanagement_remark'),
                'gpubriefingmanagement_created_at' => set_value('gpubriefingmanagement_created_at'),
                'gpubriefingmanagement_updated_at' => set_value('gpubriefingmanagement_updated_at'),
                'gpubriefingmanagement_deleted_at' => set_value('gpubriefingmanagement_deleted_at'),
                'gpubriefingmanagement_lastchanged_by' => set_value('gpubriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'gpubriefingmanagement/gpubriefingmanagement_form';
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
                    'gpubriefingmanagement_date' => $this->input->post('gpubriefingmanagement_date', true),
                    'gpubriefingmanagement_slot' => $this->input->post('gpubriefingmanagement_slot', true),
                    'gpubriefingmanagement_slottaken' => $this->input->post('gpubriefingmanagement_slottaken', true),
                    'gpubriefingmanagement_location' => $this->input->post('gpubriefingmanagement_location', true),
                    'gpubriefingmanagement_officer_pic' => $this->input->post('gpubriefingmanagement_officer_pic', true),
                    'gpubriefingmanagement_remark' => $this->input->post('gpubriefingmanagement_remark', true),
                    'gpubriefingmanagement_created_at' => $this->input->post('gpubriefingmanagement_created_at', true),
                    'gpubriefingmanagement_updated_at' => $this->input->post('gpubriefingmanagement_updated_at', true),
                    'gpubriefingmanagement_deleted_at' => $this->input->post('gpubriefingmanagement_deleted_at', true),
                    'gpubriefingmanagement_lastchanged_by' => $this->input->post('gpubriefingmanagement_lastchanged_by', true),
                    'gpubriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'gpubriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->gpubriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('gpubriefingmanagement'));
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
            $row = $this->gpubriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('gpubriefingmanagement/update_action'),
                    'id' => $id,
                    'gpubriefingmanagement_date' => set_value('gpubriefingmanagement_date', $row->gpubriefingmanagement_date),
                    'gpubriefingmanagement_slot' => set_value('gpubriefingmanagement_slot', $row->gpubriefingmanagement_slot),
                    'gpubriefingmanagement_slottaken' => set_value('gpubriefingmanagement_slottaken', $row->gpubriefingmanagement_slottaken),
                    'gpubriefingmanagement_location' => set_value('gpubriefingmanagement_location', $row->gpubriefingmanagement_location),
                    'gpubriefingmanagement_officer_pic' => set_value('gpubriefingmanagement_officer_pic', $row->gpubriefingmanagement_officer_pic),
                    'gpubriefingmanagement_remark' => set_value('gpubriefingmanagement_remark', $row->gpubriefingmanagement_remark),
                    'gpubriefingmanagement_created_at' => set_value('gpubriefingmanagement_created_at', $row->gpubriefingmanagement_created_at),
                    'gpubriefingmanagement_updated_at' => set_value('gpubriefingmanagement_updated_at', $row->gpubriefingmanagement_updated_at),
                    'gpubriefingmanagement_deleted_at' => set_value('gpubriefingmanagement_deleted_at', $row->gpubriefingmanagement_deleted_at),
                    'gpubriefingmanagement_lastchanged_by' => set_value('gpubriefingmanagement_lastchanged_by', $row->gpubriefingmanagement_lastchanged_by),

                ];
                $this->content = 'gpubriefingmanagement/gpubriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpubriefingmanagement'));
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
                $this->update($this->input->post('gpubriefingmanagement_id', true));
            } else {
                $data = [
                    'gpubriefingmanagement_date' => $this->input->post('gpubriefingmanagement_date', true),
                    'gpubriefingmanagement_slot' => $this->input->post('gpubriefingmanagement_slot', true),
                    'gpubriefingmanagement_slottaken' => $this->input->post('gpubriefingmanagement_slottaken', true),
                    'gpubriefingmanagement_location' => $this->input->post('gpubriefingmanagement_location', true),
                    'gpubriefingmanagement_officer_pic' => $this->input->post('gpubriefingmanagement_officer_pic', true),
                    'gpubriefingmanagement_remark' => $this->input->post('gpubriefingmanagement_remark', true),
                    'gpubriefingmanagement_created_at' => $this->input->post('gpubriefingmanagement_created_at', true),
                    'gpubriefingmanagement_updated_at' => $this->input->post('gpubriefingmanagement_updated_at', true),
                    'gpubriefingmanagement_deleted_at' => $this->input->post('gpubriefingmanagement_deleted_at', true),
                    'gpubriefingmanagement_lastchanged_by' => $this->input->post('gpubriefingmanagement_lastchanged_by', true),
                    'gpubriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'gpubriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->gpubriefingmanagement_model->update(fixzy_decoder($this->input->post('gpubriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('gpubriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->gpubriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->gpubriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('gpubriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpubriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->gpubriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'gpubriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->gpubriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('gpubriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('gpubriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('gpubriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('gpubriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('gpubriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('gpubriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('gpubriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('gpubriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('gpubriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('gpubriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('gpubriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('gpubriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'gpubriefingmanagement_id',
            'gpubriefingmanagement_date',
            'gpubriefingmanagement_slot',
            'gpubriefingmanagement_slottaken',
            'gpubriefingmanagement_location',
            'gpubriefingmanagement_officer_pic',
            'gpubriefingmanagement_remark',
            'gpubriefingmanagement_created_at',
            'gpubriefingmanagement_updated_at',
            'gpubriefingmanagement_deleted_at',
            'gpubriefingmanagement_lastchanged_by',

        ];
        $results = $this->gpubriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('gpubriefingmanagement/read/' . fixzy_encoder($r['gpubriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('gpubriefingmanagement/update/' . fixzy_encoder($r['gpubriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('gpubriefingmanagement/delete/' . fixzy_encoder($r['gpubriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['gpubriefingmanagement_date'],
                $r['gpubriefingmanagement_slot'],
                $r['gpubriefingmanagement_slottaken'],
                $r['gpubriefingmanagement_location'],
                $r['gpubriefingmanagement_officer_pic'],
                $r['gpubriefingmanagement_remark'],
                $r['gpubriefingmanagement_created_at'],
                $r['gpubriefingmanagement_updated_at'],
                $r['gpubriefingmanagement_deleted_at'],
                $r['gpubriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->gpubriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->gpubriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->gpubriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->gpubriefingmanagement_slot - (int) $value->gpubriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->gpubriefingmanagement_id,
                "title" => "Slots: " . $available,
                "start" => $value->gpubriefingmanagement_date,
                "end" => $value->gpubriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Gpubriefingmanagement.php */
/* Location: ./application/controllers/Gpubriefingmanagement.php */
