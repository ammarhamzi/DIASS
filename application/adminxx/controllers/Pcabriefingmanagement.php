<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pcabriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pcabriefingmanagement_model');
        $this->lang->load('pcabriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $pcabriefingmanagement = $this->pcabriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'pcabriefingmanagement_data' => $pcabriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'pcabriefingmanagement/pcabriefingmanagement_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function scheduler()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $pcabriefingmanagement = $this->pcabriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'pcabriefingmanagement_data' => $pcabriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'pcabriefingmanagement/pcabriefingmanagement_schedule';
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
            $row = $this->pcabriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pcabriefingmanagement_date' => $row->pcabriefingmanagement_date,
                    'pcabriefingmanagement_slot' => $row->pcabriefingmanagement_slot,
                    'pcabriefingmanagement_slottaken' => $row->pcabriefingmanagement_slottaken,
                    'pcabriefingmanagement_location' => $row->pcabriefingmanagement_location,
                    'pcabriefingmanagement_officer_pic' => $row->pcabriefingmanagement_officer_pic,
                    'pcabriefingmanagement_remark' => $row->pcabriefingmanagement_remark,
                    'pcabriefingmanagement_created_at' => $row->pcabriefingmanagement_created_at,
                    'pcabriefingmanagement_updated_at' => $row->pcabriefingmanagement_updated_at,
                    'pcabriefingmanagement_deleted_at' => $row->pcabriefingmanagement_deleted_at,
                    'pcabriefingmanagement_lastchanged_by' => $row->pcabriefingmanagement_lastchanged_by,

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

                    $this->content = 'pcabriefingmanagement/pcabriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('pcabriefingmanagement/pcabriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcabriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function create($date='')
    {
		if($date){
			$pcabriefingmanagement_date = $date;
		} else {
			$pcabriefingmanagement_date = set_value('pcabriefingmanagement_date');
		}	
        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',
                'action' => site_url('pcabriefingmanagement/create_action'),
                'pcabriefingmanagement_date' => $pcabriefingmanagement_date,
                'pcabriefingmanagement_slot' => set_value('pcabriefingmanagement_slot'),
                'pcabriefingmanagement_slottaken' => set_value('pcabriefingmanagement_slottaken'),
                'pcabriefingmanagement_location' => set_value('pcabriefingmanagement_location'),
                'pcabriefingmanagement_officer_pic' => set_value('pcabriefingmanagement_officer_pic'),
                'pcabriefingmanagement_remark' => set_value('pcabriefingmanagement_remark'),
                'pcabriefingmanagement_created_at' => set_value('pcabriefingmanagement_created_at'),
                'pcabriefingmanagement_updated_at' => set_value('pcabriefingmanagement_updated_at'),
                'pcabriefingmanagement_deleted_at' => set_value('pcabriefingmanagement_deleted_at'),
                'pcabriefingmanagement_lastchanged_by' => set_value('pcabriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'pcabriefingmanagement/pcabriefingmanagement_form';
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
                    'pcabriefingmanagement_date' => $this->input->post('pcabriefingmanagement_date', true),
                    'pcabriefingmanagement_slot' => $this->input->post('pcabriefingmanagement_slot', true),
                    'pcabriefingmanagement_slottaken' => $this->input->post('pcabriefingmanagement_slottaken', true),
                    'pcabriefingmanagement_location' => $this->input->post('pcabriefingmanagement_location', true),
                    'pcabriefingmanagement_officer_pic' => $this->input->post('pcabriefingmanagement_officer_pic', true),
                    'pcabriefingmanagement_remark' => $this->input->post('pcabriefingmanagement_remark', true),
                    'pcabriefingmanagement_created_at' => $this->input->post('pcabriefingmanagement_created_at', true),
                    'pcabriefingmanagement_updated_at' => $this->input->post('pcabriefingmanagement_updated_at', true),
                    'pcabriefingmanagement_deleted_at' => $this->input->post('pcabriefingmanagement_deleted_at', true),
                    'pcabriefingmanagement_lastchanged_by' => $this->input->post('pcabriefingmanagement_lastchanged_by', true),
                    'pcabriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'pcabriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pcabriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pcabriefingmanagement'));
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
            $row = $this->pcabriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('pcabriefingmanagement/update_action'),
                    'id' => $id,
                    'pcabriefingmanagement_date' => set_value('pcabriefingmanagement_date', $row->pcabriefingmanagement_date),
                    'pcabriefingmanagement_slot' => set_value('pcabriefingmanagement_slot', $row->pcabriefingmanagement_slot),
                    'pcabriefingmanagement_slottaken' => set_value('pcabriefingmanagement_slottaken', $row->pcabriefingmanagement_slottaken),
                    'pcabriefingmanagement_location' => set_value('pcabriefingmanagement_location', $row->pcabriefingmanagement_location),
                    'pcabriefingmanagement_officer_pic' => set_value('pcabriefingmanagement_officer_pic', $row->pcabriefingmanagement_officer_pic),
                    'pcabriefingmanagement_remark' => set_value('pcabriefingmanagement_remark', $row->pcabriefingmanagement_remark),
                    'pcabriefingmanagement_created_at' => set_value('pcabriefingmanagement_created_at', $row->pcabriefingmanagement_created_at),
                    'pcabriefingmanagement_updated_at' => set_value('pcabriefingmanagement_updated_at', $row->pcabriefingmanagement_updated_at),
                    'pcabriefingmanagement_deleted_at' => set_value('pcabriefingmanagement_deleted_at', $row->pcabriefingmanagement_deleted_at),
                    'pcabriefingmanagement_lastchanged_by' => set_value('pcabriefingmanagement_lastchanged_by', $row->pcabriefingmanagement_lastchanged_by),

                ];
                $this->content = 'pcabriefingmanagement/pcabriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcabriefingmanagement'));
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
                $this->update($this->input->post('pcabriefingmanagement_id', true));
            } else {
                $data = [
                    'pcabriefingmanagement_date' => $this->input->post('pcabriefingmanagement_date', true),
                    'pcabriefingmanagement_slot' => $this->input->post('pcabriefingmanagement_slot', true),
                    'pcabriefingmanagement_slottaken' => $this->input->post('pcabriefingmanagement_slottaken', true),
                    'pcabriefingmanagement_location' => $this->input->post('pcabriefingmanagement_location', true),
                    'pcabriefingmanagement_officer_pic' => $this->input->post('pcabriefingmanagement_officer_pic', true),
                    'pcabriefingmanagement_remark' => $this->input->post('pcabriefingmanagement_remark', true),
                    'pcabriefingmanagement_created_at' => $this->input->post('pcabriefingmanagement_created_at', true),
                    'pcabriefingmanagement_updated_at' => $this->input->post('pcabriefingmanagement_updated_at', true),
                    'pcabriefingmanagement_deleted_at' => $this->input->post('pcabriefingmanagement_deleted_at', true),
                    'pcabriefingmanagement_lastchanged_by' => $this->input->post('pcabriefingmanagement_lastchanged_by', true),
                    'pcabriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'pcabriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pcabriefingmanagement_model->update(fixzy_decoder($this->input->post('pcabriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('pcabriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pcabriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->pcabriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pcabriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcabriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pcabriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pcabriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->pcabriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pcabriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pcabriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('pcabriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('pcabriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('pcabriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pcabriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('pcabriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('pcabriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('pcabriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('pcabriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('pcabriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('pcabriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'pcabriefingmanagement_id',
            'pcabriefingmanagement_date',
            'pcabriefingmanagement_slot',
            'pcabriefingmanagement_slottaken',
            'pcabriefingmanagement_location',
            'pcabriefingmanagement_officer_pic',
            'pcabriefingmanagement_remark',
            'pcabriefingmanagement_created_at',
            'pcabriefingmanagement_updated_at',
            'pcabriefingmanagement_deleted_at',
            'pcabriefingmanagement_lastchanged_by',

        ];
        $results = $this->pcabriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('pcabriefingmanagement/read/' . fixzy_encoder($r['pcabriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('pcabriefingmanagement/update/' . fixzy_encoder($r['pcabriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('pcabriefingmanagement/delete/' . fixzy_encoder($r['pcabriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['pcabriefingmanagement_date'],
                $r['pcabriefingmanagement_slot'],
                $r['pcabriefingmanagement_slottaken'],
                $r['pcabriefingmanagement_location'],
                $r['pcabriefingmanagement_officer_pic'],
                $r['pcabriefingmanagement_remark'],
                $r['pcabriefingmanagement_created_at'],
                $r['pcabriefingmanagement_updated_at'],
                $r['pcabriefingmanagement_deleted_at'],
                $r['pcabriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->pcabriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->pcabriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->pcabriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->pcabriefingmanagement_slot - (int) $value->pcabriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->pcabriefingmanagement_id,
                "title" => $value->pcabriefingmanagement_slottaken."/".$value->pcabriefingmanagement_slot." Driver(s)",
                "start" => $value->pcabriefingmanagement_date,
                "end" => $value->pcabriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Pcabriefingmanagement.php */
/* Location: ./application/controllers/Pcabriefingmanagement.php */
