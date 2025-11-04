<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Exammanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('exammanagement_model');
        $this->lang->load('exammanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$exammanagement = $this->exammanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'exammanagement_data' => $exammanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'exammanagement/exammanagement_list';
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
            $row = $this->exammanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'exammanagement_date' => $row->exammanagement_date,
                    'exammanagement_slot' => $row->exammanagement_slot,
                    'exammanagement_slottaken' => $row->exammanagement_slottaken,
                    'exammanagement_location' => $row->exammanagement_location,
                    'exammanagement_officer_pic' => $row->user_name_exammanagement_officer_pic,
                    'exammanagement_remark' => $row->exammanagement_remark,

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

                    $this->content = 'exammanagement/exammanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('exammanagement/exammanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exammanagement'));
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
                'action' => site_url('exammanagement/create_action'),
                'exammanagement_date' => set_value('exammanagement_date'),
                'exammanagement_slot' => set_value('exammanagement_slot'),
                'exammanagement_slottaken' => set_value('exammanagement_slottaken'),
                'exammanagement_location' => set_value('exammanagement_location'),
                'exammanagement_officer_pic' => set_value('exammanagement_officer_pic'),
                'user' => $this->exammanagement_model->get_all_user(),
                'exammanagement_remark' => set_value('exammanagement_remark'),

            ];
            $this->content = 'exammanagement/exammanagement_form';
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
                    'exammanagement_date' => $this->input->post('exammanagement_date', true),
                    'exammanagement_slot' => $this->input->post('exammanagement_slot', true),
                    'exammanagement_slottaken' => $this->input->post('exammanagement_slottaken', true),
                    'exammanagement_location' => $this->input->post('exammanagement_location', true),
                    'exammanagement_officer_pic' => $this->input->post('exammanagement_officer_pic', true),
                    'exammanagement_remark' => $this->input->post('exammanagement_remark', true),
                    'exammanagement_created_at' => date('Y-m-d H:i:s'),
                    'exammanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->exammanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('exammanagement'));
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
            $row = $this->exammanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('exammanagement/update_action'),
                    'id' => $id,
                    'exammanagement_date' => set_value('exammanagement_date', $row->exammanagement_date),
                    'exammanagement_slot' => set_value('exammanagement_slot', $row->exammanagement_slot),
                    'exammanagement_slottaken' => set_value('exammanagement_slottaken', $row->exammanagement_slottaken),
                    'exammanagement_location' => set_value('exammanagement_location', $row->exammanagement_location),
                    'exammanagement_officer_pic' => set_value('exammanagement_officer_pic', $row->exammanagement_officer_pic),
                    'user' => $this->exammanagement_model->get_all_user(),
                    'exammanagement_remark' => set_value('exammanagement_remark', $row->exammanagement_remark),

                ];
                $this->content = 'exammanagement/exammanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exammanagement'));
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
                $this->update($this->input->post('exammanagement_id', true));
            } else {
                $data = [
                    'exammanagement_slot' => $this->input->post('exammanagement_slot', true),
                    'exammanagement_location' => $this->input->post('exammanagement_location', true),
                    'exammanagement_officer_pic' => $this->input->post('exammanagement_officer_pic', true),
                    'exammanagement_remark' => $this->input->post('exammanagement_remark', true),
                    'exammanagement_updated_at' => date('Y-m-d H:i:s'),
                    'exammanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->exammanagement_model->update(fixzy_decoder($this->input->post('exammanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('exammanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->exammanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->exammanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('exammanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exammanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->exammanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'exammanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->exammanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('exammanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('exammanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('exammanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('exammanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('exammanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('exammanagement_location', ' ', 'trim|required');
        $this->form_validation->set_rules('exammanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('exammanagement_remark', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'exammanagement_id',
            'exammanagement_date',
            'exammanagement_slot',
            'exammanagement_slottaken',
            'exammanagement_location',
            'exammanagement_officer_pic',
            'exammanagement_remark',

        ];
        $results = $this->exammanagement_model->listajax(
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
                $rud .= anchor(site_url('exammanagement/read/' . fixzy_encoder($r['exammanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('exammanagement/update/' . fixzy_encoder($r['exammanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('exammanagement/delete/' . fixzy_encoder($r['exammanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['exammanagement_date'],
                $r['exammanagement_slot'],
                $r['exammanagement_slottaken'],
                $r['exammanagement_location'],
                /*$r['user_name_exammanagement_officer_pic'],
                $r['exammanagement_remark'],*/

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->exammanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->exammanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->exammanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->exammanagement_slot - (int) $value->exammanagement_slottaken;
            $calendar[] = [
                "id" => $value->exammanagement_id,
                "title" => "",
                "start" => $value->exammanagement_date,
                "end" => $value->exammanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Exammanagement.php */
/* Location: ./application/controllers/Exammanagement.php */
