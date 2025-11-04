<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Taskchat extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('taskchat_model');
        $this->lang->load('taskchat_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $taskchat = $this->taskchat_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'taskchat_data' => $taskchat,
                'permission' => $this->permission,
            ];
            $this->content = 'taskchat/taskchat_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function read($id)
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->taskchat_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'task_id' => $row->task_id,
                    'taskchat_memberid' => $row->taskchat_memberid,
                    'taskchat_content' => $row->taskchat_content,
                    'taskchat_date' => $row->taskchat_date,

                ];
                $this->content = 'taskchat/taskchat_read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('taskchat'));
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
                'action' => site_url('taskchat/create_action'),
                'task_id' => set_value('task_id'),
                'taskchat_memberid' => set_value('taskchat_memberid'),
                'taskchat_content' => set_value('taskchat_content'),
                'taskchat_date' => set_value('taskchat_date'),

            ];
            $this->content = 'taskchat/taskchat_form';
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
                    'task_id' => $this->input->post('task_id', true),
                    'taskchat_memberid' => $this->input->post('taskchat_memberid', true),
                    'taskchat_content' => $this->input->post('taskchat_content', true),
                    'taskchat_date' => $this->input->post('taskchat_date', true),
                    'taskchat_created_at' => date('Y-m-d H:i:s'),
                    'taskchat_lastchanged_by' => $this->session->userdata('id'),

                ];
                $this->taskchat_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('taskchat'));
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
            $row = $this->taskchat_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('taskchat/update_action'),
                    'id' => $id,
                    'task_id' => set_value('task_id', $row->task_id),
                    'taskchat_memberid' => set_value('taskchat_memberid', $row->taskchat_memberid),
                    'taskchat_content' => set_value('taskchat_content', $row->taskchat_content),
                    'taskchat_date' => set_value('taskchat_date', $row->taskchat_date),

                ];
                $this->content = 'taskchat/taskchat_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('taskchat'));
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
                $this->update($this->input->post('taskchat_id', true));
            } else {
                $data = [
                    'task_id' => $this->input->post('task_id', true),
                    'taskchat_memberid' => $this->input->post('taskchat_memberid', true),
                    'taskchat_content' => $this->input->post('taskchat_content', true),
                    'taskchat_date' => $this->input->post('taskchat_date', true),
                    'taskchat_updated_at' => date('Y-m-d H:i:s'),
                    'taskchat_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->taskchat_model->update(fixzy_decoder($this->input->post('taskchat_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('taskchat'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->taskchat_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->taskchat_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('taskchat'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('taskchat'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->taskchat_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'taskchat_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->taskchat_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('taskchat'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('taskchat'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('task_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('taskchat_memberid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('taskchat_content', ' ', 'trim|required');
        $this->form_validation->set_rules('taskchat_date', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'taskchat_id',
            'task_id',
            'taskchat_memberid',
            'taskchat_content',
            'taskchat_date',

        ];
        $results = $this->taskchat_model->listajax(
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
            array_push($data, [
                $i,
                $r['task_id'],
                $r['taskchat_memberid'],
                $r['taskchat_content'],
                $r['taskchat_date'],

                anchor(site_url('taskchat/read/' . fixzy_encoder($r['taskchat_id'])), $this->lang->line('detail')) .
                ' ' .
                anchor(site_url('taskchat/update/' . fixzy_encoder($r['taskchat_id'])), $this->lang->line('edit')) .
                ' ' .
                anchor(site_url('taskchat/delete/' . fixzy_encoder($r['taskchat_id'])), $this->lang->line('delete'), 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->taskchat_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->taskchat_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Taskchat.php */
/* Location: ./application/controllers/Taskchat.php */
