<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Radbackup extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('radbackup_model');
        $this->load->model('my_model');
        $this->lang->load('radbackup_lang', $this->session->userdata('language'));
        $this->load->helper('file');
    }

    public function rollback($id)
    {
        //$this->output->enable_profiler(TRUE);
        $id = fixzy_decoder($id);

        $backup_info = $this->my_model->get_value("radbackup", "*",
            "radbackup_id = $id");
        printr($backup_info);
//exit();
        $info = $this->my_model->get_value("radcode", "*",
            "radcode_controller = '" . $backup_info->radbackup_controller . "'");

        ###--- do backup ---###

        $now            = date('Ymdhis');
        $now_sql_format = date('Y-m-d h:i:s');
        $directory      = APPPATH . "views/" . strtolower($info->radcode_controller);

        $data = [
            'radbackup_controller' => $info->radcode_controller,
            'radbackup_datetime' => $now_sql_format,
            'radbackup_initialname' => $now,
        ];
        $this->my_model->insert("radbackup", $data);

        if (is_dir($directory)) {
            //backup
            rename(APPPATH . "controllers/" . $info->radcode_controller . ".php",
                FCPATH . "resources/backup/" . $info->radcode_controller . $now . ".php");

            rename(APPPATH . "models/" . $info->radcode_model . ".php",
                FCPATH . "resources/backup/" . $info->radcode_model . $now . ".php");

            rename(APPPATH . "language/english/" . strtolower($info->radcode_controller) . "_lang.php",
                FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $now . "_lang.php");

            rename(APPPATH . "views/" . strtolower($info->radcode_controller) . '/' . strtolower($info->radcode_controller) . "_list.php",
                FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $now . "_list.php");
            rename(APPPATH . "views/" . strtolower($info->radcode_controller) . '/' . strtolower($info->radcode_controller) . "_form.php",
                FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $now . "_form.php");
            rename(APPPATH . "views/" . strtolower($info->radcode_controller) . '/' . strtolower($info->radcode_controller) . "_read.php",
                FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $now . "_read.php");
        }

        ##--- rollback ---##
        copy(FCPATH . "resources/backup/" . $info->radcode_controller . $backup_info->radbackup_initialname . ".php",
            APPPATH . "controllers/" . $info->radcode_controller . ".php");

        copy(FCPATH . "resources/backup/" . $info->radcode_model . $backup_info->radbackup_initialname . ".php",
            APPPATH . "models/" . $info->radcode_model . ".php");

        copy(FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $backup_info->radbackup_initialname . "_lang.php",
            APPPATH . "language/english/" . strtolower($info->radcode_controller) . "_lang.php");

        copy(FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $backup_info->radbackup_initialname . "_list.php",
            APPPATH . "views/" . strtolower($info->radcode_controller) . '/' . strtolower($info->radcode_controller) . "_list.php");
        copy(FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $backup_info->radbackup_initialname . "_form.php",
            APPPATH . "views/" . strtolower($info->radcode_controller) . '/' . strtolower($info->radcode_controller) . "_form.php");
        copy(FCPATH . "resources/backup/" . strtolower($info->radcode_controller) . $backup_info->radbackup_initialname . "_read.php",
            APPPATH . "views/" . strtolower($info->radcode_controller) . '/' . strtolower($info->radcode_controller) . "_read.php");

        js_redirect_parent();
    }

    public function index($controller)
    {
        $setting = [
            'method' => 'modalpage',
            'patern' => 'list',
        ];
        $radbackup = $this->radbackup_model->get_all($controller);
        /* $this->logQueries($this->config->item('dblog')); */
        $data          = ['radbackup_data' => $radbackup];
        $this->content = 'radbackup/radbackup_list';
        ##--slave_combine_to_list--##
        $this->layout($data, $setting, 0);
    }

    public function read($id)
    {
        $id      = fixzy_decoder($id);
        $setting = [
            'method' => 'newpage',
            'patern' => 'read',
        ];
        $row = $this->radbackup_model->get_read($id);
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'radbackup_datetime' => $row->radbackup_datetime,
            ];
            $this->content = 'radbackup/radbackup_read';
            ##--slave_combine_to_read--##
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('radbackup'));
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
            'action' => site_url('radbackup/create_action'),
            'radbackup_datetime' => set_value('radbackup_datetime'),
        ];
        $this->content = 'radbackup/radbackup_form';
        $this->layout($data, $setting);
    }

    public function create_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = [
                'radbackup_datetime' => $this->input->post('radbackup_datetime',
                    true),
                'radbackup_created_at' => date('Y-m-d H:i:s'),
                'radbackup_lastchanged_by' => $this->session->userdata('id'),
            ];
            $this->radbackup_model->insert($data);
            $primary_id = $this->db->insert_id();
            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('radbackup'));
        }
    }

    public function update($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'form',
        ];
        $row = $this->radbackup_model->get_by_id(fixzy_decoder($id));
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'button' => $this->lang->line('edit'),
                'action' => site_url('radbackup/update_action'),
                'id' => $id,
                'radbackup_datetime' => set_value('radbackup_datetime',
                    $row->radbackup_datetime),
            ];
            $this->content = 'radbackup/radbackup_form';
            ##--slave_combine_to_update--##
            $this->layout($data, $setting);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('radbackup'));
        }
    }

    public function update_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('radbackup_id', true));
        } else {
            $data = [
                'radbackup_datetime' => $this->input->post('radbackup_datetime',
                    true),
                'radbackup_updated_at' => date('Y-m-d H:i:s'),
                'radbackup_lastchanged_by' => $this->session->userdata('id'),
            ];
            $this->radbackup_model->update(fixzy_decoder($this->input->post('radbackup_id')),
                $data);
            /* $this->logQueries($this->config->item('dblog')); */

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('radbackup'));
        }
    }

    public function delete($id)
    {
        $id  = fixzy_decoder($id);
        $row = $this->radbackup_model->get_by_id($id);
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $this->radbackup_model->delete($id);
            /* $this->logQueries($this->config->item('dblog')); */
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('radbackup'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('radbackup'));
        }
    }

    public function delete_update($id)
    {
        $id  = fixzy_decoder($id);
        $row = $this->radbackup_model->get_by_id($id);
        /* $this->logQueries($this->config->item('dblog')); */
        if ($row) {
            $data = [
                'radbackup_deleted_at' => date('Y-m-d H:i:s')
            ];
            $this->radbackup_model->update($id, $data);
            /* $this->logQueries($this->config->item('dblog')); */
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('radbackup'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('radbackup'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('radbackup_datetime', ' ',
            'trim|required');

        $this->form_validation->set_error_delimiters('<div class="text-danger">',
            '</div>');
    }

    public function get_json()
    {
        $i       = $this->input->get('start');
        $columns = [
            'radbackup_id',
            'radbackup_datetime',
        ];
        $results = $this->radbackup_model->listajax(
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
                    $r['radbackup_datetime'],
                    anchor(site_url('radbackup/read/' . fixzy_encoder($r['radbackup_id'])),
                        $this->lang->line('detail')) .
                    ' ' .
                    anchor(site_url('radbackup/update/' . fixzy_encoder($r['radbackup_id'])),
                        $this->lang->line('edit')) .
                    ' ' .
                    anchor(site_url('radbackup/delete/' . fixzy_encoder($r['radbackup_id'])),
                        $this->lang->line('delete'),
                        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
                ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->radbackup_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->radbackup_model->recordsFiltered($columns,
                    $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Radbackup.php */
/* Location: ./application/controllers/Radbackup.php */
