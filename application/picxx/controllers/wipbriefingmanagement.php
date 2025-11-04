<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wipbriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wipbriefingmanagement_model');
        $this->lang->load('wipbriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$wipbriefingmanagement = $this->wipbriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
               // 'wipbriefingmanagement_data' => $wipbriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'wipbriefingmanagement/wipbriefingmanagement_list';
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
            $row = $this->wipbriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'wipbriefingmanagement_date' => $row->wipbriefingmanagement_date,
                    'wipbriefingmanagement_slot' => $row->wipbriefingmanagement_slot,
                    'wipbriefingmanagement_slottaken' => $row->wipbriefingmanagement_slottaken,
                    'wipbriefingmanagement_location' => $row->wipbriefingmanagement_location,
                    'wipbriefingmanagement_officer_pic' => $row->wipbriefingmanagement_officer_pic,
                    'wipbriefingmanagement_remark' => $row->wipbriefingmanagement_remark,
                    'wipbriefingmanagement_created_at' => $row->wipbriefingmanagement_created_at,
                    'wipbriefingmanagement_updated_at' => $row->wipbriefingmanagement_updated_at,
                    'wipbriefingmanagement_deleted_at' => $row->wipbriefingmanagement_deleted_at,
                    'wipbriefingmanagement_lastchanged_by' => $row->wipbriefingmanagement_lastchanged_by,

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

                    $this->content = 'wipbriefingmanagement/wipbriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('wipbriefingmanagement/wipbriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingmanagement'));
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
                'action' => site_url('wipbriefingmanagement/create_action'),
                'wipbriefingmanagement_date' => set_value('wipbriefingmanagement_date'),
                'wipbriefingmanagement_slot' => set_value('wipbriefingmanagement_slot'),
                'wipbriefingmanagement_slottaken' => set_value('wipbriefingmanagement_slottaken'),
                'wipbriefingmanagement_location' => set_value('wipbriefingmanagement_location'),
                'wipbriefingmanagement_officer_pic' => set_value('wipbriefingmanagement_officer_pic'),
                'wipbriefingmanagement_remark' => set_value('wipbriefingmanagement_remark'),
                'wipbriefingmanagement_created_at' => set_value('wipbriefingmanagement_created_at'),
                'wipbriefingmanagement_updated_at' => set_value('wipbriefingmanagement_updated_at'),
                'wipbriefingmanagement_deleted_at' => set_value('wipbriefingmanagement_deleted_at'),
                'wipbriefingmanagement_lastchanged_by' => set_value('wipbriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'wipbriefingmanagement/wipbriefingmanagement_form';
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
                    'wipbriefingmanagement_date' => $this->input->post('wipbriefingmanagement_date', true),
                    'wipbriefingmanagement_slot' => $this->input->post('wipbriefingmanagement_slot', true),
                    'wipbriefingmanagement_slottaken' => $this->input->post('wipbriefingmanagement_slottaken', true),
                    'wipbriefingmanagement_location' => $this->input->post('wipbriefingmanagement_location', true),
                    'wipbriefingmanagement_officer_pic' => $this->input->post('wipbriefingmanagement_officer_pic', true),
                    'wipbriefingmanagement_remark' => $this->input->post('wipbriefingmanagement_remark', true),
                    'wipbriefingmanagement_created_at' => $this->input->post('wipbriefingmanagement_created_at', true),
                    'wipbriefingmanagement_updated_at' => $this->input->post('wipbriefingmanagement_updated_at', true),
                    'wipbriefingmanagement_deleted_at' => $this->input->post('wipbriefingmanagement_deleted_at', true),
                    'wipbriefingmanagement_lastchanged_by' => $this->input->post('wipbriefingmanagement_lastchanged_by', true),
                    'wipbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'wipbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->wipbriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('wipbriefingmanagement'));
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
            $row = $this->wipbriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('wipbriefingmanagement/update_action'),
                    'id' => $id,
                    'wipbriefingmanagement_date' => set_value('wipbriefingmanagement_date', $row->wipbriefingmanagement_date),
                    'wipbriefingmanagement_slot' => set_value('wipbriefingmanagement_slot', $row->wipbriefingmanagement_slot),
                    'wipbriefingmanagement_slottaken' => set_value('wipbriefingmanagement_slottaken', $row->wipbriefingmanagement_slottaken),
                    'wipbriefingmanagement_location' => set_value('wipbriefingmanagement_location', $row->wipbriefingmanagement_location),
                    'wipbriefingmanagement_officer_pic' => set_value('wipbriefingmanagement_officer_pic', $row->wipbriefingmanagement_officer_pic),
                    'wipbriefingmanagement_remark' => set_value('wipbriefingmanagement_remark', $row->wipbriefingmanagement_remark),
                    'wipbriefingmanagement_created_at' => set_value('wipbriefingmanagement_created_at', $row->wipbriefingmanagement_created_at),
                    'wipbriefingmanagement_updated_at' => set_value('wipbriefingmanagement_updated_at', $row->wipbriefingmanagement_updated_at),
                    'wipbriefingmanagement_deleted_at' => set_value('wipbriefingmanagement_deleted_at', $row->wipbriefingmanagement_deleted_at),
                    'wipbriefingmanagement_lastchanged_by' => set_value('wipbriefingmanagement_lastchanged_by', $row->wipbriefingmanagement_lastchanged_by),

                ];
                $this->content = 'wipbriefingmanagement/wipbriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingmanagement'));
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
                $this->update($this->input->post('wipbriefingmanagement_id', true));
            } else {
                $data = [
                    'wipbriefingmanagement_date' => $this->input->post('wipbriefingmanagement_date', true),
                    'wipbriefingmanagement_slot' => $this->input->post('wipbriefingmanagement_slot', true),
                    'wipbriefingmanagement_slottaken' => $this->input->post('wipbriefingmanagement_slottaken', true),
                    'wipbriefingmanagement_location' => $this->input->post('wipbriefingmanagement_location', true),
                    'wipbriefingmanagement_officer_pic' => $this->input->post('wipbriefingmanagement_officer_pic', true),
                    'wipbriefingmanagement_remark' => $this->input->post('wipbriefingmanagement_remark', true),
                    'wipbriefingmanagement_created_at' => $this->input->post('wipbriefingmanagement_created_at', true),
                    'wipbriefingmanagement_updated_at' => $this->input->post('wipbriefingmanagement_updated_at', true),
                    'wipbriefingmanagement_deleted_at' => $this->input->post('wipbriefingmanagement_deleted_at', true),
                    'wipbriefingmanagement_lastchanged_by' => $this->input->post('wipbriefingmanagement_lastchanged_by', true),
                    'wipbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'wipbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->wipbriefingmanagement_model->update(fixzy_decoder($this->input->post('wipbriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('wipbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->wipbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->wipbriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('wipbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->wipbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'wipbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->wipbriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('wipbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('wipbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('wipbriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('wipbriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('wipbriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('wipbriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('wipbriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('wipbriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'wipbriefingmanagement_id',
            'wipbriefingmanagement_date',
            'wipbriefingmanagement_slot',
            'wipbriefingmanagement_slottaken',
            'wipbriefingmanagement_location',
            'wipbriefingmanagement_officer_pic',
            'wipbriefingmanagement_remark',
            'wipbriefingmanagement_created_at',
            'wipbriefingmanagement_updated_at',
            'wipbriefingmanagement_deleted_at',
            'wipbriefingmanagement_lastchanged_by',

        ];
        $results = $this->wipbriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('wipbriefingmanagement/read/' . fixzy_encoder($r['wipbriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('wipbriefingmanagement/update/' . fixzy_encoder($r['wipbriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('wipbriefingmanagement/delete/' . fixzy_encoder($r['wipbriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['wipbriefingmanagement_date'],
                $r['wipbriefingmanagement_slot'],
                $r['wipbriefingmanagement_slottaken'],
                $r['wipbriefingmanagement_location'],
                $r['wipbriefingmanagement_officer_pic'],
                $r['wipbriefingmanagement_remark'],
                $r['wipbriefingmanagement_created_at'],
                $r['wipbriefingmanagement_updated_at'],
                $r['wipbriefingmanagement_deleted_at'],
                $r['wipbriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->wipbriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->wipbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->wipbriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->wipbriefingmanagement_slot - (int) $value->wipbriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->wipbriefingmanagement_id,
                "title" => "Slots: " . $available,
                "start" => $value->wipbriefingmanagement_date,
                "end" => $value->wipbriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Wipbriefingmanagement.php */
/* Location: ./application/controllers/Wipbriefingmanagement.php */
