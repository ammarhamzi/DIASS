<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Regcontroller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('regcontroller_model');
        $this->lang->load('regcontroller_lang',
            $this->session->userdata('language'));
    }

    public function index($id = "")
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'single',
                'patern' => 'list',
            ];
            $regcontroller = $this->regcontroller_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            if (empty($id)) {
                $data = [
                    'button' => 'Create',
                    'action' => site_url('regcontroller/create_action'),
                    'control_name' => set_value('control_name'),
                    'control_desc' => set_value('control_desc'),
                    'regcontroller_data' => $regcontroller,
                    'permission' => $this->permission,
                ];
            } else {
                $row = $this->regcontroller_model->get_by_id(fixzy_decoder($id));
                /* $this->logQueries($this->config->item('dblog')); */
                if ($row) {
                    $data = [
                        'button' => $this->lang->line('edit'),
                        'action' => site_url('regcontroller/update_action'),
                        'id' => $id,
                        'control_name' => set_value('control_name',
                            $row->control_name),
                        'control_desc' => set_value('control_desc',
                            $row->control_desc),
                        'regcontroller_data' => $regcontroller,
                        'permission' => $this->permission,
                    ];
                } else {
                    $this->session->set_flashdata('message', 'Record Not Found');
                    redirect(site_url('regcontroller'));
                }
            }
            $this->content = 'regcontroller/regcontroller_list';
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
                    'control_name' => $this->input->post('control_name', true),
                    'control_desc' => $this->input->post('control_desc', true),
                    'control_created_at' => date('Y-m-d H:i:s'),
                    'control_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->regcontroller_model->insert($data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('regcontroller'));
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
                $this->update($this->input->post('control_id', true));
            } else {
                $data = [
                    'control_name' => $this->input->post('control_name', true),
                    'control_desc' => $this->input->post('control_desc', true),
                    'control_updated_at' => date('Y-m-d H:i:s'),
                    'control_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->regcontroller_model->update(fixzy_decoder($this->input->post('control_id')),
                    $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('regcontroller'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->regcontroller_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->regcontroller_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('regcontroller'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('regcontroller'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->regcontroller_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'control_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->regcontroller_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('regcontroller'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('regcontroller'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('control_name', ' ', 'trim|required');
        $this->form_validation->set_rules('control_desc', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'control_id',
            'control_name',
            'control_desc',
        ];
        $results = $this->regcontroller_model->listajax(
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
                    $r['control_name'],
                    $r['control_desc'],
                    anchor(site_url('regcontroller/read/' . fixzy_encoder($r['control_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('regcontroller/update/' . fixzy_encoder($r['control_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('regcontroller/delete/' . fixzy_encoder($r['control_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->regcontroller_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->regcontroller_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Regcontroller.php */
/* Location: ./application/controllers/Regcontroller.php */
