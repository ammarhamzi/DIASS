<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usertype extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usertype_model');
        $this->lang->load('usertype_lang', $this->session->userdata('language'));
    }

    public function index($id = "")
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'single',
                'patern' => 'list',
            ];
            $usertype = $this->usertype_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            if (empty($id)) {
                $data = [
                    'button' => 'Create',
                    'action' => site_url('usertype/create_action'),
                    'usertype_name' => set_value('usertype_name'),
                    'usertype_desc' => set_value('usertype_desc'),
                    'usertype_updateby' => set_value('usertype_updateby'),
                    'usertype_lastupdate' => set_value('usertype_lastupdate'),
                    'usertype_data' => $usertype,
                    'permission' => $this->permission,
                ];
            } else {
                $row = $this->usertype_model->get_by_id(fixzy_decoder($id));
                /* $this->logQueries($this->config->item('dblog')); */
                if ($row) {
                    $data = [
                        'button' => $this->lang->line('edit'),
                        'action' => site_url('usertype/update_action'),
                        'id' => $id,
                        'usertype_name' => set_value('usertype_name',
                            $row->usertype_name),
                        'usertype_desc' => set_value('usertype_desc',
                            $row->usertype_desc),
                        'usertype_updateby' => set_value('usertype_updateby',
                            $row->usertype_updateby),
                        'usertype_lastupdate' => set_value('usertype_lastupdate',
                            $row->usertype_lastupdate),
                        'usertype_data' => $usertype,
                        'permission' => $this->permission,
                    ];
                } else {
                    $this->session->set_flashdata('message', 'Record Not Found');
                    redirect(site_url('usertype'));
                }
            }
            $this->content = 'usertype/usertype_list';
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
                    'usertype_name' => $this->input->post('usertype_name', true),
                    'usertype_desc' => $this->input->post('usertype_desc', true),
                    'usertype_updateby' => $this->input->post('usertype_updateby',
                        true),
                    'usertype_lastupdate' => $this->input->post('usertype_lastupdate',
                        true),
                    'usertype_created_at' => date('Y-m-d H:i:s'),
                    'usertype_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->usertype_model->insert($data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('usertype'));
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
                $this->update($this->input->post('usertype_id', true));
            } else {
                $data = [
                    'usertype_name' => $this->input->post('usertype_name', true),
                    'usertype_desc' => $this->input->post('usertype_desc', true),
                    'usertype_updateby' => $this->input->post('usertype_updateby',
                        true),
                    'usertype_lastupdate' => $this->input->post('usertype_lastupdate',
                        true),
                    'usertype_updated_at' => date('Y-m-d H:i:s'),
                    'usertype_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->usertype_model->update(fixzy_decoder($this->input->post('usertype_id')),
                    $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('usertype'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->usertype_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->usertype_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('usertype'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('usertype'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->usertype_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'usertype_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->usertype_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('usertype'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('usertype'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('usertype_name', ' ', 'trim|required');
        $this->form_validation->set_rules('usertype_desc', ' ', 'trim|required');
        $this->form_validation->set_rules('usertype_updateby', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('usertype_lastupdate', ' ',
            'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'usertype_id',
            'usertype_name',
            'usertype_desc',
            'usertype_updateby',
            'usertype_lastupdate',
        ];
        $results = $this->usertype_model->listajax(
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
                    $r['usertype_name'],
                    $r['usertype_desc'],
                    anchor(site_url('usertype/read/' . fixzy_encoder($r['usertype_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('usertype/update/' . fixzy_encoder($r['usertype_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('usertype/delete/' . fixzy_encoder($r['usertype_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->usertype_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->usertype_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Usertype.php */
/* Location: ./application/controllers/Usertype.php */
