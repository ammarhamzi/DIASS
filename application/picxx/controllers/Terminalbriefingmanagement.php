<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Terminalbriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('terminalbriefingmanagement_model');
        $this->lang->load('terminalbriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$terminalbriefingmanagement = $this->terminalbriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
               // 'terminalbriefingmanagement_data' => $terminalbriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'terminalbriefingmanagement/terminalbriefingmanagement_list';
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
            $row = $this->terminalbriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'terminalbriefingmanagement_date' => $row->terminalbriefingmanagement_date,
                    'terminalbriefingmanagement_slot' => $row->terminalbriefingmanagement_slot,
                    'terminalbriefingmanagement_slottaken' => $row->terminalbriefingmanagement_slottaken,
                    'terminalbriefingmanagement_location' => $row->terminalbriefingmanagement_location,
                    'terminalbriefingmanagement_officer_pic' => $row->terminalbriefingmanagement_officer_pic,
                    'terminalbriefingmanagement_remark' => $row->terminalbriefingmanagement_remark,
                    'terminalbriefingmanagement_created_at' => $row->terminalbriefingmanagement_created_at,
                    'terminalbriefingmanagement_updated_at' => $row->terminalbriefingmanagement_updated_at,
                    'terminalbriefingmanagement_deleted_at' => $row->terminalbriefingmanagement_deleted_at,
                    'terminalbriefingmanagement_lastchanged_by' => $row->terminalbriefingmanagement_lastchanged_by,

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

                    $this->content = 'terminalbriefingmanagement/terminalbriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('terminalbriefingmanagement/terminalbriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('terminalbriefingmanagement'));
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
                'action' => site_url('terminalbriefingmanagement/create_action'),
                'terminalbriefingmanagement_date' => set_value('terminalbriefingmanagement_date'),
                'terminalbriefingmanagement_slot' => set_value('terminalbriefingmanagement_slot'),
                'terminalbriefingmanagement_slottaken' => set_value('terminalbriefingmanagement_slottaken'),
                'terminalbriefingmanagement_location' => set_value('terminalbriefingmanagement_location'),
                'terminalbriefingmanagement_officer_pic' => set_value('terminalbriefingmanagement_officer_pic'),
                'terminalbriefingmanagement_remark' => set_value('terminalbriefingmanagement_remark'),
                'terminalbriefingmanagement_created_at' => set_value('terminalbriefingmanagement_created_at'),
                'terminalbriefingmanagement_updated_at' => set_value('terminalbriefingmanagement_updated_at'),
                'terminalbriefingmanagement_deleted_at' => set_value('terminalbriefingmanagement_deleted_at'),
                'terminalbriefingmanagement_lastchanged_by' => set_value('terminalbriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'terminalbriefingmanagement/terminalbriefingmanagement_form';
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
                    'terminalbriefingmanagement_date' => $this->input->post('terminalbriefingmanagement_date', true),
                    'terminalbriefingmanagement_slot' => $this->input->post('terminalbriefingmanagement_slot', true),
                    'terminalbriefingmanagement_slottaken' => $this->input->post('terminalbriefingmanagement_slottaken', true),
                    'terminalbriefingmanagement_location' => $this->input->post('terminalbriefingmanagement_location', true),
                    'terminalbriefingmanagement_officer_pic' => $this->input->post('terminalbriefingmanagement_officer_pic', true),
                    'terminalbriefingmanagement_remark' => $this->input->post('terminalbriefingmanagement_remark', true),
                    'terminalbriefingmanagement_created_at' => $this->input->post('terminalbriefingmanagement_created_at', true),
                    'terminalbriefingmanagement_updated_at' => $this->input->post('terminalbriefingmanagement_updated_at', true),
                    'terminalbriefingmanagement_deleted_at' => $this->input->post('terminalbriefingmanagement_deleted_at', true),
                    'terminalbriefingmanagement_lastchanged_by' => $this->input->post('terminalbriefingmanagement_lastchanged_by', true),
                    'terminalbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'terminalbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->terminalbriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('terminalbriefingmanagement'));
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
            $row = $this->terminalbriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('terminalbriefingmanagement/update_action'),
                    'id' => $id,
                    'terminalbriefingmanagement_date' => set_value('terminalbriefingmanagement_date', $row->terminalbriefingmanagement_date),
                    'terminalbriefingmanagement_slot' => set_value('terminalbriefingmanagement_slot', $row->terminalbriefingmanagement_slot),
                    'terminalbriefingmanagement_slottaken' => set_value('terminalbriefingmanagement_slottaken', $row->terminalbriefingmanagement_slottaken),
                    'terminalbriefingmanagement_location' => set_value('terminalbriefingmanagement_location', $row->terminalbriefingmanagement_location),
                    'terminalbriefingmanagement_officer_pic' => set_value('terminalbriefingmanagement_officer_pic', $row->terminalbriefingmanagement_officer_pic),
                    'terminalbriefingmanagement_remark' => set_value('terminalbriefingmanagement_remark', $row->terminalbriefingmanagement_remark),
                    'terminalbriefingmanagement_created_at' => set_value('terminalbriefingmanagement_created_at', $row->terminalbriefingmanagement_created_at),
                    'terminalbriefingmanagement_updated_at' => set_value('terminalbriefingmanagement_updated_at', $row->terminalbriefingmanagement_updated_at),
                    'terminalbriefingmanagement_deleted_at' => set_value('terminalbriefingmanagement_deleted_at', $row->terminalbriefingmanagement_deleted_at),
                    'terminalbriefingmanagement_lastchanged_by' => set_value('terminalbriefingmanagement_lastchanged_by', $row->terminalbriefingmanagement_lastchanged_by),

                ];
                $this->content = 'terminalbriefingmanagement/terminalbriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('terminalbriefingmanagement'));
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
                $this->update($this->input->post('terminalbriefingmanagement_id', true));
            } else {
                $data = [
                    'terminalbriefingmanagement_date' => $this->input->post('terminalbriefingmanagement_date', true),
                    'terminalbriefingmanagement_slot' => $this->input->post('terminalbriefingmanagement_slot', true),
                    'terminalbriefingmanagement_slottaken' => $this->input->post('terminalbriefingmanagement_slottaken', true),
                    'terminalbriefingmanagement_location' => $this->input->post('terminalbriefingmanagement_location', true),
                    'terminalbriefingmanagement_officer_pic' => $this->input->post('terminalbriefingmanagement_officer_pic', true),
                    'terminalbriefingmanagement_remark' => $this->input->post('terminalbriefingmanagement_remark', true),
                    'terminalbriefingmanagement_created_at' => $this->input->post('terminalbriefingmanagement_created_at', true),
                    'terminalbriefingmanagement_updated_at' => $this->input->post('terminalbriefingmanagement_updated_at', true),
                    'terminalbriefingmanagement_deleted_at' => $this->input->post('terminalbriefingmanagement_deleted_at', true),
                    'terminalbriefingmanagement_lastchanged_by' => $this->input->post('terminalbriefingmanagement_lastchanged_by', true),
                    'terminalbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'terminalbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->terminalbriefingmanagement_model->update(fixzy_decoder($this->input->post('terminalbriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('terminalbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->terminalbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->terminalbriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('terminalbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('terminalbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->terminalbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'terminalbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->terminalbriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('terminalbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('terminalbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('terminalbriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('terminalbriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('terminalbriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('terminalbriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('terminalbriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('terminalbriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('terminalbriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('terminalbriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('terminalbriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('terminalbriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'terminalbriefingmanagement_id',
            'terminalbriefingmanagement_date',
            'terminalbriefingmanagement_slot',
            'terminalbriefingmanagement_slottaken',
            'terminalbriefingmanagement_location',
            'terminalbriefingmanagement_officer_pic',
            'terminalbriefingmanagement_remark',
            'terminalbriefingmanagement_created_at',
            'terminalbriefingmanagement_updated_at',
            'terminalbriefingmanagement_deleted_at',
            'terminalbriefingmanagement_lastchanged_by',

        ];
        $results = $this->terminalbriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('terminalbriefingmanagement/read/' . fixzy_encoder($r['terminalbriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('terminalbriefingmanagement/update/' . fixzy_encoder($r['terminalbriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('terminalbriefingmanagement/delete/' . fixzy_encoder($r['terminalbriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['terminalbriefingmanagement_date'],
                $r['terminalbriefingmanagement_slot'],
                $r['terminalbriefingmanagement_slottaken'],
                $r['terminalbriefingmanagement_location'],
                $r['terminalbriefingmanagement_officer_pic'],
                $r['terminalbriefingmanagement_remark'],
                $r['terminalbriefingmanagement_created_at'],
                $r['terminalbriefingmanagement_updated_at'],
                $r['terminalbriefingmanagement_deleted_at'],
                $r['terminalbriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->terminalbriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->terminalbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->terminalbriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->terminalbriefingmanagement_slot - (int) $value->terminalbriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->terminalbriefingmanagement_id,
                "title" => "Slots: " . $available,
                "start" => $value->terminalbriefingmanagement_date,
                "end" => $value->terminalbriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Terminalbriefingmanagement.php */
/* Location: ./application/controllers/Terminalbriefingmanagement.php */
