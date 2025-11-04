<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permittimelinedom extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permittimelinedom_model');
        $this->lang->load('permittimelinedom_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $permittimelinedom = $this->permittimelinedom_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permittimelinedom_data' => $permittimelinedom,
                'permission' => $this->permission,
            ];

            $this->content = 'permittimelinedom/permittimelinedom_list';
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
            $row = $this->permittimelinedom_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'permit_timeline_permitid' => $row->permit_timeline_permitid,
                    'permit_timeline_userid' => $row->user_name_permit_timeline_userid,
                    'permit_timeline_name' => $row->permit_timeline_name,
                    'permit_timeline_desc' => $row->permit_timeline_desc,
                    'permit_timeline_status' => $row->permit_status_desc_permit_timeline_status,
                    'permit_timeline_officialstatus' => $row->permit_officialstatus_name_permit_timeline_officialstatus,
                    'permit_timeline_created_at' => $row->permit_timeline_created_at,
                    'permit_timeline_lastchanged_by' => $row->permit_timeline_lastchanged_by,

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

                    $this->content = 'permittimelinedom/permittimelinedom_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('permittimelinedom/permittimelinedom_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permittimelinedom'));
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
                'action' => site_url('permittimelinedom/create_action'),
                'permit_timeline_permitid' => set_value('permit_timeline_permitid'),
                'permit_timeline_userid' => set_value('permit_timeline_userid'),
                'user' => $this->permittimelinedom_model->get_all_user(),
                'permit_timeline_name' => set_value('permit_timeline_name'),
                'permit_timeline_desc' => set_value('permit_timeline_desc'),
                'permit_timeline_status' => set_value('permit_timeline_status'),
                'permit_status' => $this->permittimelinedom_model->get_all_permit_status(),
                'permit_timeline_officialstatus' => set_value('permit_timeline_officialstatus'),
                'permit_officialstatus' => $this->permittimelinedom_model->get_all_permit_officialstatus(),
                'permit_timeline_created_at' => set_value('permit_timeline_created_at'),
                'permit_timeline_lastchanged_by' => set_value('permit_timeline_lastchanged_by'),

            ];
            $this->content = 'permittimelinedom/permittimelinedom_form';
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
                    'permit_timeline_permitid' => $this->input->post('permit_timeline_permitid', true),
                    'permit_timeline_userid' => $this->input->post('permit_timeline_userid', true),
                    'permit_timeline_name' => $this->input->post('permit_timeline_name', true),
                    'permit_timeline_desc' => $this->input->post('permit_timeline_desc', true),
                    'permit_timeline_status' => $this->input->post('permit_timeline_status', true),
                    'permit_timeline_officialstatus' => $this->input->post('permit_timeline_officialstatus', true),
                    'permit_timeline_created_at' => $this->input->post('permit_timeline_created_at', true),
                    'permit_timeline_lastchanged_by' => $this->input->post('permit_timeline_lastchanged_by', true),
                    'permit_timeline_created_at' => date('Y-m-d H:i:s'),
                    'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->permittimelinedom_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('permittimelinedom'));
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
            $row = $this->permittimelinedom_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('permittimelinedom/update_action'),
                    'id' => $id,
                    'permit_timeline_permitid' => set_value('permit_timeline_permitid', $row->permit_timeline_permitid),
                    'permit_timeline_userid' => set_value('permit_timeline_userid', $row->permit_timeline_userid),
                    'user' => $this->permittimelinedom_model->get_all_user(),
                    'permit_timeline_name' => set_value('permit_timeline_name', $row->permit_timeline_name),
                    'permit_timeline_desc' => set_value('permit_timeline_desc', $row->permit_timeline_desc),
                    'permit_timeline_status' => set_value('permit_timeline_status', $row->permit_timeline_status),
                    'permit_status' => $this->permittimelinedom_model->get_all_permit_status(),
                    'permit_timeline_officialstatus' => set_value('permit_timeline_officialstatus', $row->permit_timeline_officialstatus),
                    'permit_officialstatus' => $this->permittimelinedom_model->get_all_permit_officialstatus(),
                    'permit_timeline_created_at' => set_value('permit_timeline_created_at', $row->permit_timeline_created_at),
                    'permit_timeline_lastchanged_by' => set_value('permit_timeline_lastchanged_by', $row->permit_timeline_lastchanged_by),

                ];
                $this->content = 'permittimelinedom/permittimelinedom_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permittimelinedom'));
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
                $this->update($this->input->post('permit_timeline_id', true));
            } else {
                $data = [
                    'permit_timeline_permitid' => $this->input->post('permit_timeline_permitid', true),
                    'permit_timeline_userid' => $this->input->post('permit_timeline_userid', true),
                    'permit_timeline_name' => $this->input->post('permit_timeline_name', true),
                    'permit_timeline_desc' => $this->input->post('permit_timeline_desc', true),
                    'permit_timeline_status' => $this->input->post('permit_timeline_status', true),
                    'permit_timeline_officialstatus' => $this->input->post('permit_timeline_officialstatus', true),
                    'permit_timeline_created_at' => $this->input->post('permit_timeline_created_at', true),
                    'permit_timeline_lastchanged_by' => $this->input->post('permit_timeline_lastchanged_by', true),
                    'permit_timeline_updated_at' => date('Y-m-d H:i:s'),
                    'permit_timeline_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->permittimelinedom_model->update(fixzy_decoder($this->input->post('permit_timeline_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permittimelinedom'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->permittimelinedom_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->permittimelinedom_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('permittimelinedom'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permittimelinedom'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->permittimelinedom_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'permit_timeline_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->permittimelinedom_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('permittimelinedom'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permittimelinedom'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('permit_timeline_permitid', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_timeline_userid', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_timeline_name', ' ', 'trim');
        $this->form_validation->set_rules('permit_timeline_desc', ' ', 'trim');
        $this->form_validation->set_rules('permit_timeline_status', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_timeline_officialstatus', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_timeline_created_at', ' ', 'trim');
        $this->form_validation->set_rules('permit_timeline_lastchanged_by', ' ', 'trim|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'permit_timeline_id',
            'permit_timeline_permitid',
            'permit_timeline_userid',
            'permit_timeline_name',
            'permit_timeline_desc',
            'permit_timeline_status',
            'permit_timeline_officialstatus',
            'permit_timeline_created_at',
            'permit_timeline_lastchanged_by',

        ];
        $results = $this->permittimelinedom_model->listajax(
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
                $rud .= anchor(site_url('permittimelinedom/read/' . fixzy_encoder($r['permit_timeline_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('permittimelinedom/update/' . fixzy_encoder($r['permit_timeline_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('permittimelinedom/delete/' . fixzy_encoder($r['permit_timeline_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['permit_timeline_permitid'],
                $r['user_name_permit_timeline_userid'],
                $r['permit_timeline_name'],
                $r['permit_timeline_desc'],
                $r['permit_status_desc_permit_timeline_status'],
                $r['permit_officialstatus_name_permit_timeline_officialstatus'],
                $r['permit_timeline_created_at'],
                $r['permit_timeline_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permittimelinedom_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->permittimelinedom_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Permittimelinedom.php */
/* Location: ./application/controllers/Permittimelinedom.php */
