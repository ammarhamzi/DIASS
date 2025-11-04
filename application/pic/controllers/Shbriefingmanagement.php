<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shbriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('shbriefingmanagement_model');
        $this->lang->load('shbriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$shbriefingmanagement = $this->shbriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
               // 'shbriefingmanagement_data' => $shbriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'shbriefingmanagement/shbriefingmanagement_list';
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
            $row = $this->shbriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'shbriefingmanagement_date' => $row->shbriefingmanagement_date,
                    'shbriefingmanagement_slot' => $row->shbriefingmanagement_slot,
                    'shbriefingmanagement_slottaken' => $row->shbriefingmanagement_slottaken,
                    'shbriefingmanagement_location' => $row->shbriefingmanagement_location,
                    'shbriefingmanagement_officer_pic' => $row->shbriefingmanagement_officer_pic,
                    'shbriefingmanagement_remark' => $row->shbriefingmanagement_remark,
                    'shbriefingmanagement_created_at' => $row->shbriefingmanagement_created_at,
                    'shbriefingmanagement_updated_at' => $row->shbriefingmanagement_updated_at,
                    'shbriefingmanagement_deleted_at' => $row->shbriefingmanagement_deleted_at,
                    'shbriefingmanagement_lastchanged_by' => $row->shbriefingmanagement_lastchanged_by,

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

                    $this->content = 'shbriefingmanagement/shbriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('shbriefingmanagement/shbriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shbriefingmanagement'));
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
                'action' => site_url('shbriefingmanagement/create_action'),
                'shbriefingmanagement_date' => set_value('shbriefingmanagement_date'),
                'shbriefingmanagement_slot' => set_value('shbriefingmanagement_slot'),
                'shbriefingmanagement_slottaken' => set_value('shbriefingmanagement_slottaken'),
                'shbriefingmanagement_location' => set_value('shbriefingmanagement_location'),
                'shbriefingmanagement_officer_pic' => set_value('shbriefingmanagement_officer_pic'),
                'shbriefingmanagement_remark' => set_value('shbriefingmanagement_remark'),
                'shbriefingmanagement_created_at' => set_value('shbriefingmanagement_created_at'),
                'shbriefingmanagement_updated_at' => set_value('shbriefingmanagement_updated_at'),
                'shbriefingmanagement_deleted_at' => set_value('shbriefingmanagement_deleted_at'),
                'shbriefingmanagement_lastchanged_by' => set_value('shbriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'shbriefingmanagement/shbriefingmanagement_form';
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
                    'shbriefingmanagement_date' => $this->input->post('shbriefingmanagement_date', true),
                    'shbriefingmanagement_slot' => $this->input->post('shbriefingmanagement_slot', true),
                    'shbriefingmanagement_slottaken' => $this->input->post('shbriefingmanagement_slottaken', true),
                    'shbriefingmanagement_location' => $this->input->post('shbriefingmanagement_location', true),
                    'shbriefingmanagement_officer_pic' => $this->input->post('shbriefingmanagement_officer_pic', true),
                    'shbriefingmanagement_remark' => $this->input->post('shbriefingmanagement_remark', true),
                    'shbriefingmanagement_created_at' => $this->input->post('shbriefingmanagement_created_at', true),
                    'shbriefingmanagement_updated_at' => $this->input->post('shbriefingmanagement_updated_at', true),
                    'shbriefingmanagement_deleted_at' => $this->input->post('shbriefingmanagement_deleted_at', true),
                    'shbriefingmanagement_lastchanged_by' => $this->input->post('shbriefingmanagement_lastchanged_by', true),
                    'shbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'shbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->shbriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('shbriefingmanagement'));
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
            $row = $this->shbriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('shbriefingmanagement/update_action'),
                    'id' => $id,
                    'shbriefingmanagement_date' => set_value('shbriefingmanagement_date', $row->shbriefingmanagement_date),
                    'shbriefingmanagement_slot' => set_value('shbriefingmanagement_slot', $row->shbriefingmanagement_slot),
                    'shbriefingmanagement_slottaken' => set_value('shbriefingmanagement_slottaken', $row->shbriefingmanagement_slottaken),
                    'shbriefingmanagement_location' => set_value('shbriefingmanagement_location', $row->shbriefingmanagement_location),
                    'shbriefingmanagement_officer_pic' => set_value('shbriefingmanagement_officer_pic', $row->shbriefingmanagement_officer_pic),
                    'shbriefingmanagement_remark' => set_value('shbriefingmanagement_remark', $row->shbriefingmanagement_remark),
                    'shbriefingmanagement_created_at' => set_value('shbriefingmanagement_created_at', $row->shbriefingmanagement_created_at),
                    'shbriefingmanagement_updated_at' => set_value('shbriefingmanagement_updated_at', $row->shbriefingmanagement_updated_at),
                    'shbriefingmanagement_deleted_at' => set_value('shbriefingmanagement_deleted_at', $row->shbriefingmanagement_deleted_at),
                    'shbriefingmanagement_lastchanged_by' => set_value('shbriefingmanagement_lastchanged_by', $row->shbriefingmanagement_lastchanged_by),

                ];
                $this->content = 'shbriefingmanagement/shbriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shbriefingmanagement'));
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
                $this->update($this->input->post('shbriefingmanagement_id', true));
            } else {
                $data = [
                    'shbriefingmanagement_date' => $this->input->post('shbriefingmanagement_date', true),
                    'shbriefingmanagement_slot' => $this->input->post('shbriefingmanagement_slot', true),
                    'shbriefingmanagement_slottaken' => $this->input->post('shbriefingmanagement_slottaken', true),
                    'shbriefingmanagement_location' => $this->input->post('shbriefingmanagement_location', true),
                    'shbriefingmanagement_officer_pic' => $this->input->post('shbriefingmanagement_officer_pic', true),
                    'shbriefingmanagement_remark' => $this->input->post('shbriefingmanagement_remark', true),
                    'shbriefingmanagement_created_at' => $this->input->post('shbriefingmanagement_created_at', true),
                    'shbriefingmanagement_updated_at' => $this->input->post('shbriefingmanagement_updated_at', true),
                    'shbriefingmanagement_deleted_at' => $this->input->post('shbriefingmanagement_deleted_at', true),
                    'shbriefingmanagement_lastchanged_by' => $this->input->post('shbriefingmanagement_lastchanged_by', true),
                    'shbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'shbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->shbriefingmanagement_model->update(fixzy_decoder($this->input->post('shbriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('shbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->shbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->shbriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('shbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->shbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'shbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->shbriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('shbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('shbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('shbriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('shbriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('shbriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('shbriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('shbriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('shbriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('shbriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('shbriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('shbriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('shbriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'shbriefingmanagement_id',
            'shbriefingmanagement_date',
            'shbriefingmanagement_slot',
            'shbriefingmanagement_slottaken',
            'shbriefingmanagement_location',
            'shbriefingmanagement_officer_pic',
            'shbriefingmanagement_remark',
            'shbriefingmanagement_created_at',
            'shbriefingmanagement_updated_at',
            'shbriefingmanagement_deleted_at',
            'shbriefingmanagement_lastchanged_by',

        ];
        $results = $this->shbriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('shbriefingmanagement/read/' . fixzy_encoder($r['shbriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('shbriefingmanagement/update/' . fixzy_encoder($r['shbriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('shbriefingmanagement/delete/' . fixzy_encoder($r['shbriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['shbriefingmanagement_date'],
                $r['shbriefingmanagement_slot'],
                $r['shbriefingmanagement_slottaken'],
                $r['shbriefingmanagement_location'],
                $r['shbriefingmanagement_officer_pic'],
                $r['shbriefingmanagement_remark'],
                $r['shbriefingmanagement_created_at'],
                $r['shbriefingmanagement_updated_at'],
                $r['shbriefingmanagement_deleted_at'],
                $r['shbriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->shbriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->shbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->shbriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->shbriefingmanagement_slot - (int) $value->shbriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->shbriefingmanagement_id,
                "title" => "Slots: " . $available,
                "start" => $value->shbriefingmanagement_date,
                "end" => $value->shbriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Shbriefingmanagement.php */
/* Location: ./application/controllers/Shbriefingmanagement.php */
