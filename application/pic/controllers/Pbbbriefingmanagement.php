<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pbbbriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pbbbriefingmanagement_model');
        $this->lang->load('pbbbriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$pbbbriefingmanagement = $this->pbbbriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'pbbbriefingmanagement_data' => $pbbbriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'pbbbriefingmanagement/pbbbriefingmanagement_list';
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
            $row = $this->pbbbriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pbbbriefingmanagement_date' => $row->pbbbriefingmanagement_date,
                    'pbbbriefingmanagement_slot' => $row->pbbbriefingmanagement_slot,
                    'pbbbriefingmanagement_slottaken' => $row->pbbbriefingmanagement_slottaken,
                    'pbbbriefingmanagement_location' => $row->pbbbriefingmanagement_location,
                    'pbbbriefingmanagement_officer_pic' => $row->pbbbriefingmanagement_officer_pic,
                    'pbbbriefingmanagement_remark' => $row->pbbbriefingmanagement_remark,
                    'pbbbriefingmanagement_created_at' => $row->pbbbriefingmanagement_created_at,
                    'pbbbriefingmanagement_updated_at' => $row->pbbbriefingmanagement_updated_at,
                    'pbbbriefingmanagement_deleted_at' => $row->pbbbriefingmanagement_deleted_at,
                    'pbbbriefingmanagement_lastchanged_by' => $row->pbbbriefingmanagement_lastchanged_by,

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

                    $this->content = 'pbbbriefingmanagement/pbbbriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('pbbbriefingmanagement/pbbbriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbbriefingmanagement'));
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
                'action' => site_url('pbbbriefingmanagement/create_action'),
                'pbbbriefingmanagement_date' => set_value('pbbbriefingmanagement_date'),
                'pbbbriefingmanagement_slot' => set_value('pbbbriefingmanagement_slot'),
                'pbbbriefingmanagement_slottaken' => set_value('pbbbriefingmanagement_slottaken'),
                'pbbbriefingmanagement_location' => set_value('pbbbriefingmanagement_location'),
                'pbbbriefingmanagement_officer_pic' => set_value('pbbbriefingmanagement_officer_pic'),
                'pbbbriefingmanagement_remark' => set_value('pbbbriefingmanagement_remark'),
                'pbbbriefingmanagement_created_at' => set_value('pbbbriefingmanagement_created_at'),
                'pbbbriefingmanagement_updated_at' => set_value('pbbbriefingmanagement_updated_at'),
                'pbbbriefingmanagement_deleted_at' => set_value('pbbbriefingmanagement_deleted_at'),
                'pbbbriefingmanagement_lastchanged_by' => set_value('pbbbriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'pbbbriefingmanagement/pbbbriefingmanagement_form';
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
                    'pbbbriefingmanagement_date' => $this->input->post('pbbbriefingmanagement_date', true),
                    'pbbbriefingmanagement_slot' => $this->input->post('pbbbriefingmanagement_slot', true),
                    'pbbbriefingmanagement_slottaken' => $this->input->post('pbbbriefingmanagement_slottaken', true),
                    'pbbbriefingmanagement_location' => $this->input->post('pbbbriefingmanagement_location', true),
                    'pbbbriefingmanagement_officer_pic' => $this->input->post('pbbbriefingmanagement_officer_pic', true),
                    'pbbbriefingmanagement_remark' => $this->input->post('pbbbriefingmanagement_remark', true),
                    'pbbbriefingmanagement_created_at' => $this->input->post('pbbbriefingmanagement_created_at', true),
                    'pbbbriefingmanagement_updated_at' => $this->input->post('pbbbriefingmanagement_updated_at', true),
                    'pbbbriefingmanagement_deleted_at' => $this->input->post('pbbbriefingmanagement_deleted_at', true),
                    'pbbbriefingmanagement_lastchanged_by' => $this->input->post('pbbbriefingmanagement_lastchanged_by', true),
                    'pbbbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'pbbbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pbbbriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pbbbriefingmanagement'));
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
            $row = $this->pbbbriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('pbbbriefingmanagement/update_action'),
                    'id' => $id,
                    'pbbbriefingmanagement_date' => set_value('pbbbriefingmanagement_date', $row->pbbbriefingmanagement_date),
                    'pbbbriefingmanagement_slot' => set_value('pbbbriefingmanagement_slot', $row->pbbbriefingmanagement_slot),
                    'pbbbriefingmanagement_slottaken' => set_value('pbbbriefingmanagement_slottaken', $row->pbbbriefingmanagement_slottaken),
                    'pbbbriefingmanagement_location' => set_value('pbbbriefingmanagement_location', $row->pbbbriefingmanagement_location),
                    'pbbbriefingmanagement_officer_pic' => set_value('pbbbriefingmanagement_officer_pic', $row->pbbbriefingmanagement_officer_pic),
                    'pbbbriefingmanagement_remark' => set_value('pbbbriefingmanagement_remark', $row->pbbbriefingmanagement_remark),
                    'pbbbriefingmanagement_created_at' => set_value('pbbbriefingmanagement_created_at', $row->pbbbriefingmanagement_created_at),
                    'pbbbriefingmanagement_updated_at' => set_value('pbbbriefingmanagement_updated_at', $row->pbbbriefingmanagement_updated_at),
                    'pbbbriefingmanagement_deleted_at' => set_value('pbbbriefingmanagement_deleted_at', $row->pbbbriefingmanagement_deleted_at),
                    'pbbbriefingmanagement_lastchanged_by' => set_value('pbbbriefingmanagement_lastchanged_by', $row->pbbbriefingmanagement_lastchanged_by),

                ];
                $this->content = 'pbbbriefingmanagement/pbbbriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbbriefingmanagement'));
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
                $this->update($this->input->post('pbbbriefingmanagement_id', true));
            } else {
                $data = [
                    'pbbbriefingmanagement_date' => $this->input->post('pbbbriefingmanagement_date', true),
                    'pbbbriefingmanagement_slot' => $this->input->post('pbbbriefingmanagement_slot', true),
                    'pbbbriefingmanagement_slottaken' => $this->input->post('pbbbriefingmanagement_slottaken', true),
                    'pbbbriefingmanagement_location' => $this->input->post('pbbbriefingmanagement_location', true),
                    'pbbbriefingmanagement_officer_pic' => $this->input->post('pbbbriefingmanagement_officer_pic', true),
                    'pbbbriefingmanagement_remark' => $this->input->post('pbbbriefingmanagement_remark', true),
                    'pbbbriefingmanagement_created_at' => $this->input->post('pbbbriefingmanagement_created_at', true),
                    'pbbbriefingmanagement_updated_at' => $this->input->post('pbbbriefingmanagement_updated_at', true),
                    'pbbbriefingmanagement_deleted_at' => $this->input->post('pbbbriefingmanagement_deleted_at', true),
                    'pbbbriefingmanagement_lastchanged_by' => $this->input->post('pbbbriefingmanagement_lastchanged_by', true),
                    'pbbbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'pbbbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pbbbriefingmanagement_model->update(fixzy_decoder($this->input->post('pbbbriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('pbbbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pbbbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->pbbbriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pbbbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pbbbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pbbbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->pbbbriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pbbbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pbbbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('pbbbriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('pbbbriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('pbbbriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pbbbriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('pbbbriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('pbbbriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('pbbbriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('pbbbriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('pbbbriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('pbbbriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'pbbbriefingmanagement_id',
            'pbbbriefingmanagement_date',
            'pbbbriefingmanagement_slot',
            'pbbbriefingmanagement_slottaken',
            'pbbbriefingmanagement_location',
            'pbbbriefingmanagement_officer_pic',
            'pbbbriefingmanagement_remark',
            'pbbbriefingmanagement_created_at',
            'pbbbriefingmanagement_updated_at',
            'pbbbriefingmanagement_deleted_at',
            'pbbbriefingmanagement_lastchanged_by',

        ];
        $results = $this->pbbbriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('pbbbriefingmanagement/read/' . fixzy_encoder($r['pbbbriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('pbbbriefingmanagement/update/' . fixzy_encoder($r['pbbbriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('pbbbriefingmanagement/delete/' . fixzy_encoder($r['pbbbriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['pbbbriefingmanagement_date'],
                $r['pbbbriefingmanagement_slot'],
                $r['pbbbriefingmanagement_slottaken'],
                $r['pbbbriefingmanagement_location'],
                $r['pbbbriefingmanagement_officer_pic'],
                $r['pbbbriefingmanagement_remark'],
                $r['pbbbriefingmanagement_created_at'],
                $r['pbbbriefingmanagement_updated_at'],
                $r['pbbbriefingmanagement_deleted_at'],
                $r['pbbbriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->pbbbriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->pbbbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->pbbbriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->pbbbriefingmanagement_slot - (int) $value->pbbbriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->pbbbriefingmanagement_id,
                "title" => "Slots: " . $available,
                "start" => $value->pbbbriefingmanagement_date,
                "end" => $value->pbbbriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Pbbbriefingmanagement.php */
/* Location: ./application/controllers/Pbbbriefingmanagement.php */
