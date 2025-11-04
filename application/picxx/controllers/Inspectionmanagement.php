<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inspectionmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('inspectionmanagement_model');
        $this->lang->load('inspectionmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$inspectionmanagement = $this->inspectionmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'inspectionmanagement_data' => $inspectionmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'inspectionmanagement/inspectionmanagement_list';
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
            $row = $this->inspectionmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'inspectionmanagement_date' => $row->inspectionmanagement_date,
                    'inspectionmanagement_slot' => $row->inspectionmanagement_slot,
                    'inspectionmanagement_slottaken' => $row->inspectionmanagement_slottaken,
                    'inspectionmanagement_location' => $row->inspectionmanagement_location,
                    'inspectionmanagement_officer_pic' => $row->user_name_inspectionmanagement_officer_pic,
                    'inspectionmanagement_remark' => $row->inspectionmanagement_remark,
                    'inspectionmanagement_type' => $row->inspectionmanagement_type,

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

                    $this->content = 'inspectionmanagement/inspectionmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('inspectionmanagement/inspectionmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('inspectionmanagement'));
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
                'action' => site_url('inspectionmanagement/create_action'),
                'inspectionmanagement_date' => set_value('inspectionmanagement_date'),
                'inspectionmanagement_slot' => set_value('inspectionmanagement_slot'),
                'inspectionmanagement_slottaken' => set_value('inspectionmanagement_slottaken'),
                'inspectionmanagement_location' => set_value('inspectionmanagement_location'),
                'inspectionmanagement_officer_pic' => set_value('inspectionmanagement_officer_pic'),
                'user' => $this->inspectionmanagement_model->get_all_user(),
                'inspectionmanagement_remark' => set_value('inspectionmanagement_remark'),
                'inspectionmanagement_type' => set_value('inspectionmanagement_type'),
            ];
            $this->content = 'inspectionmanagement/inspectionmanagement_form';
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
                    'inspectionmanagement_date' => $this->input->post('inspectionmanagement_date', true),
                    'inspectionmanagement_slot' => $this->input->post('inspectionmanagement_slot', true),
                    'inspectionmanagement_slottaken' => $this->input->post('inspectionmanagement_slottaken', true),
                    'inspectionmanagement_location' => $this->input->post('inspectionmanagement_location', true),
                    'inspectionmanagement_officer_pic' => $this->input->post('inspectionmanagement_officer_pic', true),
                    'inspectionmanagement_remark' => $this->input->post('inspectionmanagement_remark', true),
                    'inspectionmanagement_type' => $this->input->post('inspectionmanagement_type', true),
                    'inspectionmanagement_created_at' => date('Y-m-d H:i:s'),
                    'inspectionmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->inspectionmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('inspectionmanagement'));
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
            $row = $this->inspectionmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('inspectionmanagement/update_action'),
                    'id' => $id,
                    'inspectionmanagement_date' => set_value('inspectionmanagement_date', $row->inspectionmanagement_date),
                    'inspectionmanagement_slot' => set_value('inspectionmanagement_slot', $row->inspectionmanagement_slot),
                    'inspectionmanagement_slottaken' => set_value('inspectionmanagement_slottaken', $row->inspectionmanagement_slottaken),
                    'inspectionmanagement_location' => set_value('inspectionmanagement_location', $row->inspectionmanagement_location),
                    'inspectionmanagement_officer_pic' => set_value('inspectionmanagement_officer_pic', $row->inspectionmanagement_officer_pic),
                    'user' => $this->inspectionmanagement_model->get_all_user(),
                    'inspectionmanagement_remark' => set_value('inspectionmanagement_remark', $row->inspectionmanagement_remark),
                    'inspectionmanagement_type' => set_value('inspectionmanagement_type', $row->inspectionmanagement_type),

                ];
                $this->content = 'inspectionmanagement/inspectionmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('inspectionmanagement'));
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
                $this->update($this->input->post('inspectionmanagement_id', true));
            } else {
                $data = [
                    'inspectionmanagement_slot' => $this->input->post('inspectionmanagement_slot', true),
                    'inspectionmanagement_location' => $this->input->post('inspectionmanagement_location', true),
                    'inspectionmanagement_officer_pic' => $this->input->post('inspectionmanagement_officer_pic', true),
                    'inspectionmanagement_remark' => $this->input->post('inspectionmanagement_remark', true),
                    'inspectionmanagement_type' => $this->input->post('inspectionmanagement_type', true),
                    'inspectionmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'inspectionmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->inspectionmanagement_model->update(fixzy_decoder($this->input->post('inspectionmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('inspectionmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->inspectionmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->inspectionmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('inspectionmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('inspectionmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->inspectionmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'inspectionmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->inspectionmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('inspectionmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('inspectionmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('inspectionmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('inspectionmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('inspectionmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('inspectionmanagement_location', ' ', 'trim|required');
        $this->form_validation->set_rules('inspectionmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('inspectionmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('inspectionmanagement_type', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'inspectionmanagement_id',
            'inspectionmanagement_date',
            'inspectionmanagement_slot',
            'inspectionmanagement_slottaken',
            'inspectionmanagement_location',
            'inspectionmanagement_officer_pic',
            'inspectionmanagement_remark',
            'inspectionmanagement_type',

        ];
        $results = $this->inspectionmanagement_model->listajax(
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
                $rud .= anchor(site_url('inspectionmanagement/read/' . fixzy_encoder($r['inspectionmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('inspectionmanagement/update/' . fixzy_encoder($r['inspectionmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('inspectionmanagement/delete/' . fixzy_encoder($r['inspectionmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['inspectionmanagement_date'],
                $r['inspectionmanagement_slot'],
                $r['inspectionmanagement_slottaken'],
                $r['inspectionmanagement_location'],
                /*$r['user_name_inspectionmanagement_officer_pic'],
                $r['inspectionmanagement_remark'],*/

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->inspectionmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->inspectionmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot($type)
    {
        $row = $this->inspectionmanagement_model->get_slot($type);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->inspectionmanagement_slot - (int) $value->inspectionmanagement_slottaken;
            $calendar[] = [
                "id" => $value->inspectionmanagement_id,
                "title" => "",
                "start" => $value->inspectionmanagement_date,
                "end" => $value->inspectionmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Inspectionmanagement.php */
/* Location: ./application/controllers/Inspectionmanagement.php */
