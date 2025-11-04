<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Logging extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('logging_model');
        $this->lang->load('logging_lang', $this->session->userdata('language'));
    }

    public function index()
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $logging = $this->logging_model->get_all();
        /* $this->logQueries($this->config->item('dblog')); */
        $data          = ['logging_data' => $logging];
        $this->content = 'logging/logging_list';
        $this->layout($data, $setting);
    }

    public function read($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'read',
        ];
        $row = $this->logging_model->get_read(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'user_id' => $row->user_username_user_id,
                'string_query' => $row->string_query,
                'query_type' => $row->query_type,
                'datetime_query' => $row->datetime_query,
                'executetime' => $row->executetime,
            ];
            $this->content = 'logging/logging_read';
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('logging'));
        }
    }

    public function create()
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'form',
        ];
        $data = [
            'button' => 'Create',
            'action' => site_url('logging/create_action'),
            'user_id' => set_value('user_id'),
            'user' => $this->logging_model->get_all_user(),
            'string_query' => set_value('string_query'),
            'query_type' => set_value('query_type'),
            'datetime_query' => set_value('datetime_query'),
            'executetime' => set_value('executetime'),
        ];
        $this->content = 'logging/logging_form';
        $this->layout($data, $setting);
    }

    public function create_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = [
                'user_id' => $this->input->post('user_id', true),
                'string_query' => $this->input->post('string_query', true),
                'query_type' => $this->input->post('query_type', true),
                'datetime_query' => $this->input->post('datetime_query', true),
                'executetime' => $this->input->post('executetime', true),
            ];
            $this->logging_model->insert($data);
            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('logging'));
        }
    }

    public function update($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'form',
        ];
        $row = $this->logging_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'button' => $this->lang->line('edit'),
                'action' => site_url('logging/update_action'),
                'id' => $id,
                'user_id' => set_value('user_id', $row->user_id),
                'user' => $this->logging_model->get_all_user(),
                'string_query' => set_value('string_query', $row->string_query),
                'query_type' => set_value('query_type', $row->query_type),
                'datetime_query' => set_value('datetime_query',
                    $row->datetime_query),
                'executetime' => set_value('executetime', $row->executetime),
            ];
            $this->content = 'logging/logging_form';
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('logging'));
        }
    }

    public function update_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = [
            ];
            $this->logging_model->update(fixzy_decoder($this->input->post('id')),
                $data);
            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('logging'));
        }
    }

    public function delete($id)
    {
        $row = $this->logging_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $this->logging_model->delete(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('logging'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('logging'));
        }
    }

    public function delete_update($id)
    {
        $row = $this->logging_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'id' => '1'
            ];
            $this->logging_model->update(fixzy_decoder($id), $data);
            /* $this->logQueries($this->config->item('dblog')); */
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('logging'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('logging'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('user_id', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('string_query', ' ', 'trim|required');
        $this->form_validation->set_rules('query_type', ' ', 'trim|required');
        $this->form_validation->set_rules('datetime_query', ' ', 'trim|required');
        $this->form_validation->set_rules('executetime', ' ',
            'trim|required|numeric');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'id',
            'user_id',
            'string_query',
            'query_type',
            'datetime_query',
            'executetime',
        ];
        $results = $this->logging_model->listajax(
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
                    $r['user_username_user_id'],
                    $r['string_query'],
                    $r['query_type'],
                    $r['datetime_query'],
                    $r['executetime'],
                    anchor(site_url('logging/read/' . fixzy_encoder($r['id'])),
                        $this->lang->line('detail'))
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->logging_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->logging_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Logging.php */
/* Location: ./application/controllers/Logging.php */
