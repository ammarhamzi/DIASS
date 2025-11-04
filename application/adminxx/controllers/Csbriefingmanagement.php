<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Csbriefingmanagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('csbriefingmanagement_model');
        $this->lang->load('csbriefingmanagement_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $csbriefingmanagement = $this->csbriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'csbriefingmanagement_data' => $csbriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'csbriefingmanagement/csbriefingmanagement_list';
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
            $csbriefingmanagement = $this->csbriefingmanagement_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'csbriefingmanagement_data' => $csbriefingmanagement,
                'permission' => $this->permission,
            ];

            $this->content = 'csbriefingmanagement/csbriefingmanagement_schedule';
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
            $row = $this->csbriefingmanagement_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'csbriefingmanagement_date' => $row->csbriefingmanagement_date,
                    'csbriefingmanagement_slot' => $row->csbriefingmanagement_slot,
                    'csbriefingmanagement_slottaken' => $row->csbriefingmanagement_slottaken,
                    'csbriefingmanagement_location' => $row->csbriefingmanagement_location,
                    'csbriefingmanagement_officer_pic' => $row->csbriefingmanagement_officer_pic,
                    'csbriefingmanagement_remark' => $row->csbriefingmanagement_remark,
                    'csbriefingmanagement_created_at' => $row->csbriefingmanagement_created_at,
                    'csbriefingmanagement_updated_at' => $row->csbriefingmanagement_updated_at,
                    'csbriefingmanagement_deleted_at' => $row->csbriefingmanagement_deleted_at,
                    'csbriefingmanagement_lastchanged_by' => $row->csbriefingmanagement_lastchanged_by,

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

                    $this->content = 'csbriefingmanagement/csbriefingmanagement_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('csbriefingmanagement/csbriefingmanagement_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('csbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function create($date='')
    {
		if($date){
			$csbriefingmanagement_date = $date;
		} else {
			$csbriefingmanagement_date = set_value('csbriefingmanagement_date');
		}	
        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',
                'action' => site_url('csbriefingmanagement/create_action'),
                'csbriefingmanagement_date' => $csbriefingmanagement_date,
                'csbriefingmanagement_slot' => set_value('csbriefingmanagement_slot'),
                'csbriefingmanagement_slottaken' => set_value('csbriefingmanagement_slottaken'),
                'csbriefingmanagement_location' => set_value('csbriefingmanagement_location'),
                'csbriefingmanagement_officer_pic' => set_value('csbriefingmanagement_officer_pic'),
                'csbriefingmanagement_remark' => set_value('csbriefingmanagement_remark'),
                'csbriefingmanagement_created_at' => set_value('csbriefingmanagement_created_at'),
                'csbriefingmanagement_updated_at' => set_value('csbriefingmanagement_updated_at'),
                'csbriefingmanagement_deleted_at' => set_value('csbriefingmanagement_deleted_at'),
                'csbriefingmanagement_lastchanged_by' => set_value('csbriefingmanagement_lastchanged_by'),

            ];
            $this->content = 'csbriefingmanagement/csbriefingmanagement_form';
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
                    'csbriefingmanagement_date' => $this->input->post('csbriefingmanagement_date', true),
                    'csbriefingmanagement_slot' => $this->input->post('csbriefingmanagement_slot', true),
                    'csbriefingmanagement_slottaken' => $this->input->post('csbriefingmanagement_slottaken', true),
                    'csbriefingmanagement_location' => $this->input->post('csbriefingmanagement_location', true),
                    'csbriefingmanagement_officer_pic' => $this->input->post('csbriefingmanagement_officer_pic', true),
                    'csbriefingmanagement_remark' => $this->input->post('csbriefingmanagement_remark', true),
                    'csbriefingmanagement_created_at' => $this->input->post('csbriefingmanagement_created_at', true),
                    'csbriefingmanagement_updated_at' => $this->input->post('csbriefingmanagement_updated_at', true),
                    'csbriefingmanagement_deleted_at' => $this->input->post('csbriefingmanagement_deleted_at', true),
                    'csbriefingmanagement_lastchanged_by' => $this->input->post('csbriefingmanagement_lastchanged_by', true),
                    'csbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
                    'csbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->csbriefingmanagement_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('csbriefingmanagement'));
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
            $row = $this->csbriefingmanagement_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('csbriefingmanagement/update_action'),
                    'id' => $id,
                    'csbriefingmanagement_date' => set_value('csbriefingmanagement_date', $row->csbriefingmanagement_date),
                    'csbriefingmanagement_slot' => set_value('csbriefingmanagement_slot', $row->csbriefingmanagement_slot),
                    'csbriefingmanagement_slottaken' => set_value('csbriefingmanagement_slottaken', $row->csbriefingmanagement_slottaken),
                    'csbriefingmanagement_location' => set_value('csbriefingmanagement_location', $row->csbriefingmanagement_location),
                    'csbriefingmanagement_officer_pic' => set_value('csbriefingmanagement_officer_pic', $row->csbriefingmanagement_officer_pic),
                    'csbriefingmanagement_remark' => set_value('csbriefingmanagement_remark', $row->csbriefingmanagement_remark),
                    'csbriefingmanagement_created_at' => set_value('csbriefingmanagement_created_at', $row->csbriefingmanagement_created_at),
                    'csbriefingmanagement_updated_at' => set_value('csbriefingmanagement_updated_at', $row->csbriefingmanagement_updated_at),
                    'csbriefingmanagement_deleted_at' => set_value('csbriefingmanagement_deleted_at', $row->csbriefingmanagement_deleted_at),
                    'csbriefingmanagement_lastchanged_by' => set_value('csbriefingmanagement_lastchanged_by', $row->csbriefingmanagement_lastchanged_by),

                ];
                $this->content = 'csbriefingmanagement/csbriefingmanagement_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('csbriefingmanagement'));
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
                $this->update($this->input->post('csbriefingmanagement_id', true));
            } else {
                $data = [
                    'csbriefingmanagement_date' => $this->input->post('csbriefingmanagement_date', true),
                    'csbriefingmanagement_slot' => $this->input->post('csbriefingmanagement_slot', true),
                    'csbriefingmanagement_slottaken' => $this->input->post('csbriefingmanagement_slottaken', true),
                    'csbriefingmanagement_location' => $this->input->post('csbriefingmanagement_location', true),
                    'csbriefingmanagement_officer_pic' => $this->input->post('csbriefingmanagement_officer_pic', true),
                    'csbriefingmanagement_remark' => $this->input->post('csbriefingmanagement_remark', true),
                    'csbriefingmanagement_created_at' => $this->input->post('csbriefingmanagement_created_at', true),
                    'csbriefingmanagement_updated_at' => $this->input->post('csbriefingmanagement_updated_at', true),
                    'csbriefingmanagement_deleted_at' => $this->input->post('csbriefingmanagement_deleted_at', true),
                    'csbriefingmanagement_lastchanged_by' => $this->input->post('csbriefingmanagement_lastchanged_by', true),
                    'csbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
                    'csbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->csbriefingmanagement_model->update(fixzy_decoder($this->input->post('csbriefingmanagement_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('csbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->csbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->csbriefingmanagement_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('csbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('csbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->csbriefingmanagement_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'csbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->csbriefingmanagement_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('csbriefingmanagement'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('csbriefingmanagement'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('csbriefingmanagement_date', ' ', 'trim');
        $this->form_validation->set_rules('csbriefingmanagement_slot', ' ', 'trim|integer');
        $this->form_validation->set_rules('csbriefingmanagement_slottaken', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('csbriefingmanagement_location', ' ', 'trim');
        $this->form_validation->set_rules('csbriefingmanagement_officer_pic', ' ', 'trim|integer');
        $this->form_validation->set_rules('csbriefingmanagement_remark', ' ', 'trim');
        $this->form_validation->set_rules('csbriefingmanagement_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('csbriefingmanagement_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('csbriefingmanagement_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('csbriefingmanagement_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'csbriefingmanagement_id',
            'csbriefingmanagement_date',
            'csbriefingmanagement_slot',
            'csbriefingmanagement_slottaken',
            'csbriefingmanagement_location',
            'csbriefingmanagement_officer_pic',
            'csbriefingmanagement_remark',
            'csbriefingmanagement_created_at',
            'csbriefingmanagement_updated_at',
            'csbriefingmanagement_deleted_at',
            'csbriefingmanagement_lastchanged_by',

        ];
        $results = $this->csbriefingmanagement_model->listajax(
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
                $rud .= anchor(site_url('csbriefingmanagement/read/' . fixzy_encoder($r['csbriefingmanagement_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('csbriefingmanagement/update/' . fixzy_encoder($r['csbriefingmanagement_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('csbriefingmanagement/delete/' . fixzy_encoder($r['csbriefingmanagement_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['csbriefingmanagement_date'],
                $r['csbriefingmanagement_slot'],
                $r['csbriefingmanagement_slottaken'],
                $r['csbriefingmanagement_location'],
                $r['csbriefingmanagement_officer_pic'],
                $r['csbriefingmanagement_remark'],
                $r['csbriefingmanagement_created_at'],
                $r['csbriefingmanagement_updated_at'],
                $r['csbriefingmanagement_deleted_at'],
                $r['csbriefingmanagement_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->csbriefingmanagement_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->csbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function get_availableslot()
    {
        $row = $this->csbriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
            $available  = (int) $value->csbriefingmanagement_slot - (int) $value->csbriefingmanagement_slottaken;
            $calendar[] = [
                "id" => $value->csbriefingmanagement_id,
                "title" => $value->csbriefingmanagement_slottaken."/".$value->csbriefingmanagement_slot." Driver(s)",
                "start" => $value->csbriefingmanagement_date,
                "end" => $value->csbriefingmanagement_date
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Csbriefingmanagement.php */
/* Location: ./application/controllers/Csbriefingmanagement.php */
