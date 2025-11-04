<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vdgsbriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('vdgsbriefingmanagement_model');
        $this->lang->load('vdgsbriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$vdgsbriefingmanagement = $this->vdgsbriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'vdgsbriefingmanagement_data' => $vdgsbriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'vdgsbriefingmanagement/vdgsbriefingmanagement_list';
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
            $row = $this->vdgsbriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'vdgsbriefingmanagement_date' => $row->vdgsbriefingmanagement_date,
                    'vdgsbriefingmanagement_slot' => $row->vdgsbriefingmanagement_slot,
                    'vdgsbriefingmanagement_slottaken' => $row->vdgsbriefingmanagement_slottaken,
                    'vdgsbriefingmanagement_location' => $row->vdgsbriefingmanagement_location,
                    'vdgsbriefingmanagement_officer_pic' => $row->vdgsbriefingmanagement_officer_pic,
                    'vdgsbriefingmanagement_remark' => $row->vdgsbriefingmanagement_remark,
                    'vdgsbriefingmanagement_created_at' => $row->vdgsbriefingmanagement_created_at,
                    'vdgsbriefingmanagement_updated_at' => $row->vdgsbriefingmanagement_updated_at,
                    'vdgsbriefingmanagement_deleted_at' => $row->vdgsbriefingmanagement_deleted_at,
                    'vdgsbriefingmanagement_lastchanged_by' => $row->vdgsbriefingmanagement_lastchanged_by,

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

                    $this->content = 'vdgsbriefingmanagement/vdgsbriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('vdgsbriefingmanagement/vdgsbriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgsbriefingmanagement'));
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
                'action' => site_url('vdgsbriefingmanagement/create_action'),
                'vdgsbriefingmanagement_date' => set_value('vdgsbriefingmanagement_date'),
                'vdgsbriefingmanagement_slot' => set_value('vdgsbriefingmanagement_slot'),
                'vdgsbriefingmanagement_slottaken' => set_value('vdgsbriefingmanagement_slottaken'),
                'vdgsbriefingmanagement_location' => set_value('vdgsbriefingmanagement_location'),
                'vdgsbriefingmanagement_officer_pic' => set_value('vdgsbriefingmanagement_officer_pic'),
                'vdgsbriefingmanagement_remark' => set_value('vdgsbriefingmanagement_remark'),
                'vdgsbriefingmanagement_created_at' => set_value('vdgsbriefingmanagement_created_at'),
                'vdgsbriefingmanagement_updated_at' => set_value('vdgsbriefingmanagement_updated_at'),
                'vdgsbriefingmanagement_deleted_at' => set_value('vdgsbriefingmanagement_deleted_at'),
                'vdgsbriefingmanagement_lastchanged_by' => set_value('vdgsbriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'vdgsbriefingmanagement/vdgsbriefingmanagement_form';
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
                    'vdgsbriefingmanagement_date' => $this->input->post('vdgsbriefingmanagement_date', true),
                    'vdgsbriefingmanagement_slot' => $this->input->post('vdgsbriefingmanagement_slot', true),
                    'vdgsbriefingmanagement_slottaken' => $this->input->post('vdgsbriefingmanagement_slottaken', true),
                    'vdgsbriefingmanagement_location' => $this->input->post('vdgsbriefingmanagement_location', true),
                    'vdgsbriefingmanagement_officer_pic' => $this->input->post('vdgsbriefingmanagement_officer_pic', true),
                    'vdgsbriefingmanagement_remark' => $this->input->post('vdgsbriefingmanagement_remark', true),
                    'vdgsbriefingmanagement_created_at' => $this->input->post('vdgsbriefingmanagement_created_at', true),
                    'vdgsbriefingmanagement_updated_at' => $this->input->post('vdgsbriefingmanagement_updated_at', true),
                    'vdgsbriefingmanagement_deleted_at' => $this->input->post('vdgsbriefingmanagement_deleted_at', true),
                    'vdgsbriefingmanagement_lastchanged_by' => $this->input->post('vdgsbriefingmanagement_lastchanged_by', true),
                    'vdgsbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'vdgsbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->vdgsbriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('vdgsbriefingmanagement'));
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
            $row = $this->vdgsbriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('vdgsbriefingmanagement/update_action'),
                    'id' => $id,
                    'vdgsbriefingmanagement_date' => set_value('vdgsbriefingmanagement_date', $row->vdgsbriefingmanagement_date),
                    'vdgsbriefingmanagement_slot' => set_value('vdgsbriefingmanagement_slot', $row->vdgsbriefingmanagement_slot),
                    'vdgsbriefingmanagement_slottaken' => set_value('vdgsbriefingmanagement_slottaken', $row->vdgsbriefingmanagement_slottaken),
                    'vdgsbriefingmanagement_location' => set_value('vdgsbriefingmanagement_location', $row->vdgsbriefingmanagement_location),
                    'vdgsbriefingmanagement_officer_pic' => set_value('vdgsbriefingmanagement_officer_pic', $row->vdgsbriefingmanagement_officer_pic),
                    'vdgsbriefingmanagement_remark' => set_value('vdgsbriefingmanagement_remark', $row->vdgsbriefingmanagement_remark),
                    'vdgsbriefingmanagement_created_at' => set_value('vdgsbriefingmanagement_created_at', $row->vdgsbriefingmanagement_created_at),
                    'vdgsbriefingmanagement_updated_at' => set_value('vdgsbriefingmanagement_updated_at', $row->vdgsbriefingmanagement_updated_at),
                    'vdgsbriefingmanagement_deleted_at' => set_value('vdgsbriefingmanagement_deleted_at', $row->vdgsbriefingmanagement_deleted_at),
                    'vdgsbriefingmanagement_lastchanged_by' => set_value('vdgsbriefingmanagement_lastchanged_by', $row->vdgsbriefingmanagement_lastchanged_by),

                ];
                $this->content = 'vdgsbriefingmanagement/vdgsbriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgsbriefingmanagement'));
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
                $this->update($this->input->post('vdgsbriefingmanagement_id', true));
            } else {
                $data = [
                    'vdgsbriefingmanagement_date' => $this->input->post('vdgsbriefingmanagement_date', true),
                    'vdgsbriefingmanagement_slot' => $this->input->post('vdgsbriefingmanagement_slot', true),
                    'vdgsbriefingmanagement_slottaken' => $this->input->post('vdgsbriefingmanagement_slottaken', true),
                    'vdgsbriefingmanagement_location' => $this->input->post('vdgsbriefingmanagement_location', true),
                    'vdgsbriefingmanagement_officer_pic' => $this->input->post('vdgsbriefingmanagement_officer_pic', true),
                    'vdgsbriefingmanagement_remark' => $this->input->post('vdgsbriefingmanagement_remark', true),
                    'vdgsbriefingmanagement_created_at' => $this->input->post('vdgsbriefingmanagement_created_at', true),
                    'vdgsbriefingmanagement_updated_at' => $this->input->post('vdgsbriefingmanagement_updated_at', true),
                    'vdgsbriefingmanagement_deleted_at' => $this->input->post('vdgsbriefingmanagement_deleted_at', true),
                    'vdgsbriefingmanagement_lastchanged_by' => $this->input->post('vdgsbriefingmanagement_lastchanged_by', true),
                    'vdgsbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'vdgsbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->vdgsbriefingmanagement_model->update(fixzy_decoder($this->input->post('vdgsbriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('vdgsbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->vdgsbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->vdgsbriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('vdgsbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgsbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->vdgsbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'vdgsbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->vdgsbriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('vdgsbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('vdgsbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('vdgsbriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('vdgsbriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('vdgsbriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('vdgsbriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('vdgsbriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('vdgsbriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('vdgsbriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('vdgsbriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('vdgsbriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('vdgsbriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'vdgsbriefingmanagement_id',
            'vdgsbriefingmanagement_date',
            'vdgsbriefingmanagement_slot',
            'vdgsbriefingmanagement_slottaken',
            'vdgsbriefingmanagement_location',
            'vdgsbriefingmanagement_officer_pic',
            'vdgsbriefingmanagement_remark',
            'vdgsbriefingmanagement_created_at',
            'vdgsbriefingmanagement_updated_at',
            'vdgsbriefingmanagement_deleted_at',
            'vdgsbriefingmanagement_lastchanged_by',

        ];
        $results = $this->vdgsbriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('vdgsbriefingmanagement/read/' . fixzy_encoder($r['vdgsbriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('vdgsbriefingmanagement/update/' . fixzy_encoder($r['vdgsbriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('vdgsbriefingmanagement/delete/' . fixzy_encoder($r['vdgsbriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['vdgsbriefingmanagement_date'],
                $r['vdgsbriefingmanagement_slot'],
                $r['vdgsbriefingmanagement_slottaken'],
                $r['vdgsbriefingmanagement_location'],
                $r['vdgsbriefingmanagement_officer_pic'],
                $r['vdgsbriefingmanagement_remark'],
                $r['vdgsbriefingmanagement_created_at'],
                $r['vdgsbriefingmanagement_updated_at'],
                $r['vdgsbriefingmanagement_deleted_at'],
                $r['vdgsbriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->vdgsbriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->vdgsbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->vdgsbriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $count_slottaken = $this->vdgsbriefingmanagement_model->get_slottaken($value->adpbriefingmanagement_date,$value->adpbriefingmanagement_location,$condition_id,$drivingclass);
            $available  = (int) $value->vdgsbriefingmanagement_slot - (int) $value->vdgsbriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->vdgsbriefingmanagement_id,
                "title" => "Slots: " . $available,
                "start" => $value->vdgsbriefingmanagement_date,
                "end" => $value->vdgsbriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Vdgsbriefingmanagement.php */
/* Location: ./application/controllers/Vdgsbriefingmanagement.php */
