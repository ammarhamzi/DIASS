<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usergroup extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usergroup_model');
        $this->lang->load('usergroup_lang', $this->session->userdata('language'));
    }

    public function index($id = "")
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'single',
                'patern' => 'list',
            ];
            $usergroup = $this->usergroup_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            if (empty($id)) {
                $data = [
                    'button' => 'Create',
                    'action' => site_url('usergroup/create_action'),
                    'usergroup_type' => set_value('usergroup_type'),
                    'usertype' => $this->usergroup_model->get_all_usertype(),
                    'usergroup_name' => set_value('usergroup_name'),
                    'usergroup_desc' => set_value('usergroup_desc'),
                    'usergroup_data' => $usergroup,
                    'permission' => $this->permission,
                ];
            } else {
                $row = $this->usergroup_model->get_by_id(fixzy_decoder($id));
                /* $this->logQueries($this->config->item('dblog')); */
                if ($row) {
                    $data = [
                        'button' => $this->lang->line('edit'),
                        'action' => site_url('usergroup/update_action'),
                        'id' => $id,
                        'usergroup_type' => set_value('usergroup_type',
                            $row->usergroup_type),
                        'usertype' => $this->usergroup_model->get_all_usertype(),
                        'usergroup_name' => set_value('usergroup_name',
                            $row->usergroup_name),
                        'usergroup_desc' => set_value('usergroup_desc',
                            $row->usergroup_desc),
                        'usergroup_data' => $usergroup,
                        'permission' => $this->permission,
                    ];
                } else {
                    $this->session->set_flashdata('message', 'Record Not Found');
                    redirect(site_url('usergroup'));
                }
            }
            $this->content = 'usergroup/usergroup_list';
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
                $this->index();
            } else {
                $data = [
                    'usergroup_type' => $this->input->post('usergroup_type',
                        true),
                    'usergroup_name' => $this->input->post('usergroup_name',
                        true),
                    'usergroup_desc' => $this->input->post('usergroup_desc',
                        true),
                    'usergroup_created_at' => date('Y-m-d H:i:s'),
                    'usergroup_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->usergroup_model->insert($data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('usergroup'));
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
                $this->index($this->input->post('usergroup_id', true));
            } else {
                $data = [
                    'usergroup_type' => $this->input->post('usergroup_type',
                        true),
                    'usergroup_name' => $this->input->post('usergroup_name',
                        true),
                    'usergroup_desc' => $this->input->post('usergroup_desc',
                        true),
                    'usergroup_updated_at' => date('Y-m-d H:i:s'),
                    'usergroup_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->usergroup_model->update(fixzy_decoder($this->input->post('usergroup_id')),
                    $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('usergroup'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->usergroup_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->usergroup_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('usergroup'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('usergroup'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->usergroup_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'usergroup_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->usergroup_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('usergroup'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('usergroup'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('usergroup_type', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('usergroup_name', ' ', 'trim|required');
        $this->form_validation->set_rules('usergroup_desc', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'usergroup_id',
            'usergroup_type',
            'usergroup_name',
            'usergroup_desc',
        ];
        $results = $this->usergroup_model->listajax(
            $columns, $this->input->get('start'), $this->input->get('length'),
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            array_push($data,
                [
                    $i,
                    $r['usertype_name_usergroup_type'],
                    $r['usergroup_name'],
                    $r['usergroup_desc'],
                    anchor(site_url('usergroup/read/' . fixzy_encoder($r['usergroup_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('usergroup/update/' . fixzy_encoder($r['usergroup_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('usergroup/delete/' . fixzy_encoder($r['usergroup_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->usergroup_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->usergroup_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Usergroup.php */
/* Location: ./application/controllers/Usergroup.php */
