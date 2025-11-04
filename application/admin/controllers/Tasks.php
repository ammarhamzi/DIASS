<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tasks extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tasks_model');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->lang->load('tasks_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            if ($this->session->userdata('id') == 1) {
                $superadmin = 1;
            } else {
                $superadmin = 0;
            }

            $tasks = $this->tasks_model->get_all($this->input->post('startdate'),
                $this->input->post('enddate'));
            $tasks_own = $this->tasks_model->get_yourall($this->session->userdata('id'),
                $this->input->post('startdate'), $this->input->post('enddate'));

            $task_stat = $this->tasks_model->task_stat($this->session->userdata('id'));

            $data = [
                'tasks_data' => $tasks,
                'tasks_data_own' => $tasks_own,
                'alltask' => $task_stat->alltask,
                'completed' => $task_stat->completed,
                'ongoing' => $task_stat->ongoing,
                'pending' => $task_stat->pending,
                'stafflist' => $this->tasks_model->get_all_user(),
                'is_superadmin' => $superadmin,
                'startdate' => set_value('startdate'),
                'enddate' => set_value('enddate'),
                'workinghour' => $this->tasks_model->workinghour($this->session->userdata('id'),
                    $this->input->post('startdate'),
                    $this->input->post('enddate')),
            ];

            //$this->load->view('tasks/tasks_list_s', $data);
            $setting = [
                'method' => 'modalpage',
                'patern' => 'list',
            ];

            $this->content = 'tasks/tasks_list';
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

    public function read($id)
    {

        if ($this->permission->cp_read == true) {
            $setting = [
                'method' => 'modalpage',
                'patern' => 'read',
            ];
            $row = $this->tasks_model->get_read($id);
            if ($row) {
                $data = [
                    'task_name' => $row->task_name,
                    'task_desc' => $row->task_desc,
                    'task_weight' => $row->task_weight,
                    'task_priority' => $row->task_priority,
                    'task_to' => $row->username_task_to,
                    'task_from' => $row->username_task_from,
                    'task_date' => $row->task_date,
                    'task_duedate' => $row->task_duedate,
                    'task_status' => $row->task_status,
                    'task_progress' => $row->task_progress,
                    'task_image' => $row->task_image,
                    'task_remark' => $row->task_remark,
                    'task_current' => $row->task_current,
                    'chatlist' => $this->tasks_model->getchat($id),
                    'action' => site_url('tasks/createchat_action'),
                    'task_id' => $id,
                    'task_hour' => $row->task_hour,
                    'task_related' => $row->task_related,
                ];
                $this->content = 'tasks/tasks_read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting, 0);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tasks'));
            }
        } else {
            redirect('/');
        }
    }

    public function create($as_superadmin = 0)
    {
        //$this->get_menu();

        if ($this->permission->cp_create == true) {
            $setting = [
                'method' => 'modalpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',
                'action' => site_url('tasks/create_action'),
                'task_name' => set_value('task_name'),
                'task_desc' => set_value('task_desc'),
                'task_weight' => set_value('task_weight'),
                'dropdown_task_weight' => [
                    (object) ['id' => '1', 'value' => 'Easy'], (object) [
                        'id' => '2', 'value' => 'Normal'], (object) ['id' => '3',
                        'value' => 'Hard'],
                ],
                'task_priority' => set_value('task_priority'),
                'dropdown_task_priority' => [
                    (object) ['id' => '1', 'value' => ' Normal'], (object) [
                        'id' => '2', 'value' => ' Medium'], (object) ['id' => '3',
                        'value' => ' High'], (object) ['id' => '4', 'value' => ' Highest'],
                ],
                'task_to' => set_value('task_to'),
                'wf_admin' => $this->tasks_model->get_all_user(),
                'task_from' => set_value('task_from'),
                'task_date' => set_value('task_date'),
                'task_duedate' => set_value('task_duedate'),
                'task_status' => set_value('task_status'),
                'dropdown_task_status' => [
                    (object) ['id' => '1', 'value' => 'On Going'], (object) [
                        'id' => '2', 'value' => ' Pending'], (object) ['id' => '3',
                        'value' => ' Completed'],
                ],
                'task_progress' => set_value('task_progress', '0'),
                'task_remark' => set_value('task_remark'),
                'task_current' => set_value('task_current'),
                'task_image' => set_value('task_image'),
                'task_id' => set_value('task_id'),
                'task_hour' => set_value('task_hour'),
                'task_related' => set_value('task_related'),
                'all_task' => $this->tasks_model->get_all(),
            ];

            if ($as_superadmin == 1) {
                $this->content = 'tasks/tasks_form_s';
                $this->layout($data, $setting, 0);
            } else {
                $this->content = 'tasks/tasks_form';
                $this->layout($data, $setting, 0);
            }
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
                $duedate = ($this->input->post('task_duedate', true) == "" ? "00/00/0000"
                    : $this->input->post('task_duedate', true));
                $data = [
                    'task_name' => $this->input->post('task_name', true),
                    'task_desc' => $this->input->post('task_desc', true),
                    'task_weight' => $this->input->post('task_weight', true),
                    'task_priority' => $this->input->post('task_priority', true),
                    'task_to' => $this->input->post('task_to', true),
                    'task_from' => $this->input->post('task_from', true),
                    'task_date' => date_format(date_create_from_format('d/m/Y',
                        $this->input->post('task_date', true)), 'Y-m-d'),
                    'task_duedate' => date_format(date_create_from_format('d/m/Y',
                        $duedate), 'Y-m-d'),
                    'task_status' => $this->input->post('task_status', true),
                    'task_progress' => $this->input->post('task_progress', true),
                    'task_remark' => $this->input->post('task_remark', true),
                    'task_current' => ($this->input->post('task_current', true) != ""
                        ? 1 : 0),
                    'task_image' => $this->input->post('task_image', true),
                    'task_hour' => $this->input->post('task_hour', true),
                    'task_related' => $this->input->post('task_related', true),
                    'task_created_at' => date('Y-m-d H:i:s'),
                    'task_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->tasks_model->insert($data);

                /* if($this->session->userdata('admin_permissions')=='SUP_MAN'){
                $this->email->initialize(array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.sendgrid.net',
                'smtp_user' => 'bagustore',
                'smtp_pass' => '@XS38044',
                'smtp_port' => 587,
                'crlf' => "\r\n",
                'newline' => "\r\n"
                ));

                $this->email->from('task@bagustore.com', $this->session->userdata('username'));
                $this->email->to('someone@example.com');
                $this->email->cc('another@another-example.com');
                $this->email->bcc('them@their-example.com');
                $this->email->subject('Email Test');
                $this->email->message('Testing the email class.');
                $this->email->send();

                echo $this->email->print_debugger();
                } */
                $this->session->set_flashdata('message', 'Create Record Success');
                js_redirect_parent();
            }
        } else {
            redirect('/');
        }
    }

    public function createchat_action()
    {

        $this->_ruleschat();

        if ($this->form_validation->run() == false) {
            $this->read($this->input->post('task_id', true));
        } else {
            $data = [
                'task_id' => $this->input->post('task_id', true),
                'taskchat_memberid' => $this->input->post('taskchat_memberid',
                    true),
                'taskchat_content' => $this->input->post('taskchat_content',
                    true),
                'taskchat_date' => $this->input->post('taskchat_date', true),
                'taskchat_created_at' => date('Y-m-d H:i:s'),
                'taskchat_lastchanged_by' => $this->session->userdata('id'),
            ];
            $this->tasks_model->insertchat($data);

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tasks/read/' . $this->input->post('task_id', true)));
        }
    }

    public function _ruleschat()
    {
        $this->form_validation->set_rules('taskchat_memberid', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('taskchat_content', ' ',
            'trim|required');
        $this->form_validation->set_rules('taskchat_date', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function update($id, $as_superadmin = 0)
    {
//$this->output->enable_profiler(TRUE);
        if ($this->permission->cp_update == true) {
            $setting = [
                'method' => 'modalpage',
                'patern' => 'form',
            ];
            $row = $this->tasks_model->get_by_id($id);
            if ($row) {
                //$this->get_menu();
                $data = [
                    'button' => 'Update',
                    'action' => site_url('tasks/update_action'),
                    'id' => $id,
                    'task_name' => set_value('task_name', $row->task_name),
                    'task_desc' => set_value('task_desc', $row->task_desc),
                    'task_weight' => set_value('task_weight', $row->task_weight),
                    'dropdown_task_weight' => [
                        (object) ['id' => '1', 'value' => 'Easy'], (object) [
                            'id' => '2', 'value' => 'Normal'], (object) ['id' => '3',
                            'value' => 'Hard'],
                    ],
                    'task_priority' => set_value('task_priority',
                        $row->task_priority),
                    'dropdown_task_priority' => [
                        (object) ['id' => '1', 'value' => ' Normal'], (object) [
                            'id' => '2', 'value' => ' Medium'], (object) ['id' => '3',
                            'value' => ' High'], (object) ['id' => '4', 'value' => ' Highest'],
                    ],
                    'task_to' => set_value('task_to', $row->task_to),
                    'wf_admin' => $this->tasks_model->get_all_user(),
                    'task_from' => set_value('task_from', $row->task_from),
                    'task_date' => set_value('task_date', $row->task_date),
                    'task_duedate' => set_value('task_duedate',
                        $row->task_duedate),
                    'task_status' => set_value('task_status', $row->task_status),
                    'dropdown_task_status' => [
                        (object) ['id' => '1', 'value' => 'On Going'], (object) [
                            'id' => '2', 'value' => ' Pending'], (object) [
                            'id' => '3', 'value' => ' Completed'],
                    ],
                    'task_progress' => set_value('task_progress',
                        $row->task_progress),
                    'task_remark' => set_value('task_remark', $row->task_remark),
                    'task_current' => set_value('task_current',
                        $row->task_current),
                    'task_image' => set_value('task_image', $row->task_image),
                    'task_id' => set_value('task_id', $row->task_id),
                    'task_hour' => set_value('task_hour', $row->task_hour),
                    'task_related' => set_value('task_related',
                        $row->task_related),
                    'all_task' => $this->tasks_model->get_all(),
                ];
                if ($as_superadmin == 1) {
                    $this->content = 'tasks/tasks_form_s';
                    $this->layout($data, $setting, 0);
                } else {
                    $this->content = 'tasks/tasks_form';
                    $this->layout($data, $setting, 0);
                }
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tasks'));
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
                $this->update($this->input->post('task_id', true));
            } else {

                if ($this->input->post('task_status', true) === "3") {
                    $input_task_status   = "3";
                    $input_task_progress = "100";
                } else {
                    $input_task_status = $this->input->post('task_status',
                        true);
                    $input_task_progress = $this->input->post('task_progress',
                        true);
                }

                if ($this->input->post('task_progress', true) === "100") {
                    $input_task_status   = "3";
                    $input_task_progress = "100";
                } else {
                    $input_task_status = $this->input->post('task_status',
                        true);
                    $input_task_progress = $this->input->post('task_progress',
                        true);
                }

                $data = [
                    'task_name' => $this->input->post('task_name', true),
                    'task_desc' => $this->input->post('task_desc', true),
                    'task_weight' => $this->input->post('task_weight', true),
                    'task_priority' => $this->input->post('task_priority', true),
                    'task_to' => $this->input->post('task_to', true),
                    'task_from' => $this->input->post('task_from', true),
                    'task_date' => date_format(date_create_from_format('d/m/Y',
                        $this->input->post('task_date', true)), 'Y-m-d'),
                    'task_duedate' => date_format(date_create_from_format('d/m/Y',
                        $this->input->post('task_duedate', true)), 'Y-m-d'),
                    'task_status' => $input_task_status,
                    'task_progress' => $input_task_progress,
                    'task_remark' => $this->input->post('task_remark', true),
                    'task_current' => ($this->input->post('task_current', true) != ""
                        ? 1 : 0),
                    'task_image' => $this->input->post('task_image', true),
                    'task_hour' => $this->input->post('task_hour', true),
                    'task_related' => $this->input->post('task_related', true),
                    'taskchat_updated_at' => date('Y-m-d H:i:s'),
                    'taskchat_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->tasks_model->update($this->input->post('task_id', true),
                    $data);

                $this->session->set_flashdata('message', 'Update Record Success');
                js_redirect_parent();
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($permission->cp_delete == true) {

            $row = $this->tasks_model->get_by_id($id);
            if ($row) {
                $this->tasks_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('tasks'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tasks'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        if ($permission->cp_delete == true) {

            $row = $this->tasks_model->get_by_id($id);
            if ($row) {
                $data = [
                    'task_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->tasks_model->update($id, $data);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('tasks'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tasks'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('task_name', ' ', 'trim|required');
        $this->form_validation->set_rules('task_desc', ' ', 'trim');
        $this->form_validation->set_rules('task_weight', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('task_priority', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('task_to', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('task_from', ' ', 'trim|integer');
        $this->form_validation->set_rules('task_date', ' ', 'trim|required');
        $this->form_validation->set_rules('task_duedate', ' ', 'trim');
        $this->form_validation->set_rules('task_status', ' ',
            'trim|required|integer');
        $this->form_validation->set_rules('task_progress', ' ',
            'trim|required|numeric');
        $this->form_validation->set_rules('task_remark', ' ', 'trim');
        $this->form_validation->set_rules('task_current', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    /*    public function get_json() {
    $i = $this->input->get('start')*$this->input->get('length');
    $columns = array(
    'task_name',
    'task_desc',
    'task_to',
    'task_from',
    'task_date',
    'task_duedate',
    'task_status',
    'task_progress',
    'task_remark',

    );
    $results = $this->mastertable_model->listajax(
    $columns,
    $this->input->get('start'),
    $this->input->get('length'),
    $this->input->get('search')['value'],
    $columns[$this->input->get('order')[0]['column']],
    $this->input->get('order')[0]['dir']
    );
    $data = array();
    foreach ($results  as $r) {
    $i++;
    array_push($data, array(
    $i,
    $r['task_name'],
    $r['task_desc'],
    $r['username_task_to'],
    $r['username_task_from'],
    $r['task_date'],
    $r['task_duedate'],
    $r['task_status'],
    $r['task_progress'],
    $r['task_remark'],

    anchor(site_url('tasks/read/'.$r['task_id']),'Read').
    ' '.
    anchor(site_url('tasks/update/'.$r['task_id']),'Update').
    ' '.
    anchor(site_url('tasks/delete/'.$r['task_id']),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"')
    ));
    }

    echo json_encode(
    array(
    "draw"=>intval( $this->input->get('draw') ),
    "recordsTotal"=> $this->mastertable_model->recordsTotal()->recordstotal,
    "recordsFiltered" => $this->mastertable_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
    'data' => $data
    )
    );
    } */

    public function ajaxStat()
    {
        $id        = $this->input->post('id');
        $task_stat = $this->tasks_model->task_stat($id);

        $data = [
            'alltask' => $task_stat->alltask,
            'completed' => $task_stat->completed,
            'ongoing' => $task_stat->ongoing,
            'pending' => $task_stat->pending,
        ];

        $this->load->view('tasks/stat', $data);
    }
}
;
/* End of file Tasks.php */
/* Location: ./application/controllers/Tasks.php */
