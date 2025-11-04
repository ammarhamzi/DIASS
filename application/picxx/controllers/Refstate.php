<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Refstate extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('refstate_model');
        $this->lang->load('refstate_lang', $this->session->userdata('language'));
    }

    public function index($id = "")
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'single',
                'patern' => 'list',
            ];
            $refstate = $this->refstate_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            if (empty($id)) {
                $data = [
                    'button' => 'Create',
                    'action' => site_url('refstate/create_action'),
                    'ref_state_code' => set_value('ref_state_code'),
                    'ref_state_name' => set_value('ref_state_name'),
                    'ref_state_capital' => set_value('ref_state_capital'),
                    'ref_state_plate' => set_value('ref_state_plate'),
                    'refstate_data' => $refstate,
                    'permission' => $this->permission,
                ];
            } else {
                $row = $this->refstate_model->get_by_id(fixzy_decoder($id));
                /* $this->logQueries($this->config->item('dblog')); */
                if ($row) {
                    $data = [
                        'button' => $this->lang->line('edit'),
                        'action' => site_url('refstate/update_action'),
                        'id' => $id,
                        'ref_state_code' => set_value('ref_state_code',
                            $row->ref_state_code),
                        'ref_state_name' => set_value('ref_state_name',
                            $row->ref_state_name),
                        'ref_state_capital' => set_value('ref_state_capital',
                            $row->ref_state_capital),
                        'ref_state_plate' => set_value('ref_state_plate',
                            $row->ref_state_plate),
                        'refstate_data' => $refstate,
                        'permission' => $this->permission,
                    ];
                } else {
                    $this->session->set_flashdata('message', 'Record Not Found');
                    redirect(site_url('refstate'));
                }
            }
            $this->content = 'refstate/refstate_list';
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
                    'ref_state_code' => $this->input->post('ref_state_code',
                        true),
                    'ref_state_name' => $this->input->post('ref_state_name',
                        true),
                    'ref_state_capital' => $this->input->post('ref_state_capital',
                        true),
                    'ref_state_plate' => $this->input->post('ref_state_plate',
                        true),
                    'ref_state_created_at' => date('Y-m-d H:i:s'),
                    'ref_state_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->refstate_model->insert($data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('refstate'));
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
                $this->update($this->input->post('ref_state_id', true));
            } else {
                $data = [
                    'ref_state_code' => $this->input->post('ref_state_code',
                        true),
                    'ref_state_name' => $this->input->post('ref_state_name',
                        true),
                    'ref_state_capital' => $this->input->post('ref_state_capital',
                        true),
                    'ref_state_plate' => $this->input->post('ref_state_plate',
                        true),
                    'ref_state_updated_at' => date('Y-m-d H:i:s'),
                    'ref_state_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->refstate_model->update(fixzy_decoder($this->input->post('ref_state_id')),
                    $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('refstate'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $row = $this->refstate_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->refstate_model->delete(fixzy_decoder($id));
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('refstate'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('refstate'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $row = $this->refstate_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'ref_state_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->refstate_model->update(fixzy_decoder($id), $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('refstate'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('refstate'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('ref_state_code', ' ', 'trim|required');
        $this->form_validation->set_rules('ref_state_name', ' ', 'trim|required');
        $this->form_validation->set_rules('ref_state_capital', ' ',
            'trim|required');
        $this->form_validation->set_rules('ref_state_plate', ' ',
            'trim|required');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'ref_state_id',
            'ref_state_code',
            'ref_state_name',
            'ref_state_capital',
            'ref_state_plate',
        ];
        $results = $this->refstate_model->listajax(
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
                    $r['ref_state_code'],
                    $r['ref_state_name'],
                    $r['ref_state_capital'],
                    $r['ref_state_plate'],
                    anchor(site_url('refstate/read/' . fixzy_encoder($r['ref_state_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('refstate/update/' . fixzy_encoder($r['ref_state_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('refstate/delete/' . fixzy_encoder($r['ref_state_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->refstate_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->refstate_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Refstate.php */
/* Location: ./application/controllers/Refstate.php */
