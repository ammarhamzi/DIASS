<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examtaker extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('examtaker_model');
        $this->lang->load('examtaker_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $examtaker = $this->examtaker_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'examtaker_data' => $examtaker,
                'permission' => $this->permission,
            ];

            $this->content = 'examtaker/examtaker_list';
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
            $row = $this->examtaker_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examtaker_driverid' => $row->examtaker_driverid,
                    'examtaker_exammanagement_id' => $row->examtaker_exammanagement_id,
                    'examtaker_exambank_id' => $row->examtaker_exambank_id,
                    'examtaker_examno' => $row->examtaker_examno,
                    'examtaker_date' => $row->examtaker_date,
                    'examtaker_startdatetime' => $row->examtaker_startdatetime,
                    'examtaker_enddatetime' => $row->examtaker_enddatetime,
                    'examtaker_exact_enddatetime' => $row->examtaker_exact_enddatetime,
                    'examtaker_totalmark' => $row->examtaker_totalmark,
                    'examtaker_pass' => $row->examtaker_pass,
                    'examtaker_remark' => $row->examtaker_remark,
                    'examtaker_created_at' => $row->examtaker_created_at,
                    'examtaker_updated_at' => $row->examtaker_updated_at,
                    'examtaker_deleted_at' => $row->examtaker_deleted_at,
                    'examtaker_lastchanged_by' => $row->examtaker_lastchanged_by,

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

                    $this->content = 'examtaker/examtaker_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('examtaker/examtaker_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtaker'));
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
                'action' => site_url('examtaker/create_action'),
                'examtaker_driverid' => set_value('examtaker_driverid'),
                'examtaker_exammanagement_id' => set_value('examtaker_exammanagement_id'),
                'examtaker_exambank_id' => set_value('examtaker_exambank_id'),
                'examtaker_examno' => set_value('examtaker_examno'),
                'examtaker_date' => set_value('examtaker_date'),
                'examtaker_startdatetime' => set_value('examtaker_startdatetime'),
                'examtaker_enddatetime' => set_value('examtaker_enddatetime'),
                'examtaker_exact_enddatetime' => set_value('examtaker_exact_enddatetime'),
                'examtaker_totalmark' => set_value('examtaker_totalmark'),
                'examtaker_pass' => set_value('examtaker_pass'),
                'examtaker_remark' => set_value('examtaker_remark'),
                'examtaker_created_at' => set_value('examtaker_created_at'),
                'examtaker_updated_at' => set_value('examtaker_updated_at'),
                'examtaker_deleted_at' => set_value('examtaker_deleted_at'),
                'examtaker_lastchanged_by' => set_value('examtaker_lastchanged_by'),

            ];
            $this->content = 'examtaker/examtaker_form';
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
                    'examtaker_driverid' => $this->input->post('examtaker_driverid', true),
                    'examtaker_exammanagement_id' => $this->input->post('examtaker_exammanagement_id', true),
                    'examtaker_exambank_id' => $this->input->post('examtaker_exambank_id', true),
                    'examtaker_examno' => $this->input->post('examtaker_examno', true),
                    'examtaker_date' => $this->input->post('examtaker_date', true),
                    'examtaker_startdatetime' => $this->input->post('examtaker_startdatetime', true),
                    'examtaker_enddatetime' => $this->input->post('examtaker_enddatetime', true),
                    'examtaker_exact_enddatetime' => $this->input->post('examtaker_exact_enddatetime', true),
                    'examtaker_totalmark' => $this->input->post('examtaker_totalmark', true),
                    'examtaker_pass' => $this->input->post('examtaker_pass', true),
                    'examtaker_remark' => $this->input->post('examtaker_remark', true),
                    'examtaker_created_at' => $this->input->post('examtaker_created_at', true),
                    'examtaker_updated_at' => $this->input->post('examtaker_updated_at', true),
                    'examtaker_deleted_at' => $this->input->post('examtaker_deleted_at', true),
                    'examtaker_lastchanged_by' => $this->input->post('examtaker_lastchanged_by', true),
                    'examtaker_created_at' => date('Y-m-d H:i:s'),
                    'examtaker_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->examtaker_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('examtaker'));
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
            $row = $this->examtaker_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('examtaker/update_action'),
                    'id' => $id,
                    'examtaker_driverid' => set_value('examtaker_driverid', $row->examtaker_driverid),
                    'examtaker_exammanagement_id' => set_value('examtaker_exammanagement_id', $row->examtaker_exammanagement_id),
                    'examtaker_exambank_id' => set_value('examtaker_exambank_id', $row->examtaker_exambank_id),
                    'examtaker_examno' => set_value('examtaker_examno', $row->examtaker_examno),
                    'examtaker_date' => set_value('examtaker_date', $row->examtaker_date),
                    'examtaker_startdatetime' => set_value('examtaker_startdatetime', $row->examtaker_startdatetime),
                    'examtaker_enddatetime' => set_value('examtaker_enddatetime', $row->examtaker_enddatetime),
                    'examtaker_exact_enddatetime' => set_value('examtaker_exact_enddatetime', $row->examtaker_exact_enddatetime),
                    'examtaker_totalmark' => set_value('examtaker_totalmark', $row->examtaker_totalmark),
                    'examtaker_pass' => set_value('examtaker_pass', $row->examtaker_pass),
                    'examtaker_remark' => set_value('examtaker_remark', $row->examtaker_remark),
                    'examtaker_created_at' => set_value('examtaker_created_at', $row->examtaker_created_at),
                    'examtaker_updated_at' => set_value('examtaker_updated_at', $row->examtaker_updated_at),
                    'examtaker_deleted_at' => set_value('examtaker_deleted_at', $row->examtaker_deleted_at),
                    'examtaker_lastchanged_by' => set_value('examtaker_lastchanged_by', $row->examtaker_lastchanged_by),

                ];
                $this->content = 'examtaker/examtaker_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtaker'));
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
                $this->update($this->input->post('examtaker_id', true));
            } else {
                $data = [
                    'examtaker_driverid' => $this->input->post('examtaker_driverid', true),
                    'examtaker_exammanagement_id' => $this->input->post('examtaker_exammanagement_id', true),
                    'examtaker_exambank_id' => $this->input->post('examtaker_exambank_id', true),
                    'examtaker_examno' => $this->input->post('examtaker_examno', true),
                    'examtaker_date' => $this->input->post('examtaker_date', true),
                    'examtaker_startdatetime' => $this->input->post('examtaker_startdatetime', true),
                    'examtaker_enddatetime' => $this->input->post('examtaker_enddatetime', true),
                    'examtaker_exact_enddatetime' => $this->input->post('examtaker_exact_enddatetime', true),
                    'examtaker_totalmark' => $this->input->post('examtaker_totalmark', true),
                    'examtaker_pass' => $this->input->post('examtaker_pass', true),
                    'examtaker_remark' => $this->input->post('examtaker_remark', true),
                    'examtaker_created_at' => $this->input->post('examtaker_created_at', true),
                    'examtaker_updated_at' => $this->input->post('examtaker_updated_at', true),
                    'examtaker_deleted_at' => $this->input->post('examtaker_deleted_at', true),
                    'examtaker_lastchanged_by' => $this->input->post('examtaker_lastchanged_by', true),
                    'examtaker_updated_at' => date('Y-m-d H:i:s'),
                    'examtaker_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->examtaker_model->update(fixzy_decoder($this->input->post('examtaker_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('examtaker'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examtaker_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->examtaker_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examtaker'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtaker'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->examtaker_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'examtaker_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->examtaker_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('examtaker'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('examtaker'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('examtaker_driverid', ' ', 'trim|integer');
        $this->form_validation->set_rules('examtaker_exammanagement_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('examtaker_exambank_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('examtaker_examno', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_date', ' ', 'trim|required');
        $this->form_validation->set_rules('examtaker_startdatetime', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_enddatetime', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_exact_enddatetime', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_totalmark', ' ', 'trim|integer');
        $this->form_validation->set_rules('examtaker_pass', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_remark', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_created_at', ' ', 'trim|required');
        $this->form_validation->set_rules('examtaker_updated_at', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_deleted_at', ' ', 'trim');
        $this->form_validation->set_rules('examtaker_lastchanged_by', ' ', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'examtaker_id',
            'examtaker_driverid',
            'examtaker_exammanagement_id',
            'examtaker_exambank_id',
            'examtaker_examno',
            'examtaker_date',
            'examtaker_startdatetime',
            'examtaker_enddatetime',
            'examtaker_exact_enddatetime',
            'examtaker_totalmark',
            'examtaker_pass',
            'examtaker_remark',
            'examtaker_created_at',
            'examtaker_updated_at',
            'examtaker_deleted_at',
            'examtaker_lastchanged_by',

        ];
        $results = $this->examtaker_model->listajax(
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
                $rud .= anchor(site_url('examtaker/read/' . fixzy_encoder($r['examtaker_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('examtaker/update/' . fixzy_encoder($r['examtaker_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('examtaker/delete/' . fixzy_encoder($r['examtaker_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['examtaker_driverid'],
                $r['examtaker_exammanagement_id'],
                $r['examtaker_exambank_id'],
                $r['examtaker_examno'],
                $r['examtaker_date'],
                $r['examtaker_startdatetime'],
                $r['examtaker_enddatetime'],
                $r['examtaker_exact_enddatetime'],
                $r['examtaker_totalmark'],
                $r['examtaker_pass'],
                $r['examtaker_remark'],
                $r['examtaker_created_at'],
                $r['examtaker_updated_at'],
                $r['examtaker_deleted_at'],
                $r['examtaker_lastchanged_by'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->examtaker_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->examtaker_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Examtaker.php */
/* Location: ./application/controllers/Examtaker.php */
