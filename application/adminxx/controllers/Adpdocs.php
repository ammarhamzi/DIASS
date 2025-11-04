<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adpdocs extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('adpdocs_model');
        $this->lang->load('adpdocs_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $adpdocs = $this->adpdocs_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'adpdocs_data' => $adpdocs,
                'permission' => $this->permission,
            ];

            $this->content = 'adpdocs/adpdocs_list';
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
            $row = $this->adpdocs_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'adpdocs_adppermit_id' => $row->adppermit_permit_id_adpdocs_adppermit_id,
                    'adpdocs_attendanceslip' => $row->adpdocs_attendanceslip,

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

                    $this->content = 'adpdocs/adpdocs_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('adpdocs/adpdocs_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adpdocs'));
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
                'action' => site_url('adpdocs/create_action'),
                'adpdocs_adppermit_id' => set_value('adpdocs_adppermit_id'),
                'adppermit' => $this->adpdocs_model->get_all_adppermit(),
                'adpdocs_attendanceslip' => set_value('adpdocs_attendanceslip'),

            ];
            $this->content = 'adpdocs/adpdocs_form';
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
                    'adpdocs_adppermit_id' => $this->input->post('adpdocs_adppermit_id', true),
                    'adpdocs_attendanceslip' => $this->input->post('adpdocs_attendanceslip', true),
                    'adpdocs_created_at' => date('Y-m-d H:i:s'),
                    'adpdocs_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->adpdocs_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('adpdocs'));
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
            $row = $this->adpdocs_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('adpdocs/update_action'),
                    'id' => $id,
                    'adpdocs_adppermit_id' => set_value('adpdocs_adppermit_id', $row->adpdocs_adppermit_id),
                    'adppermit' => $this->adpdocs_model->get_all_adppermit(),
                    'adpdocs_attendanceslip' => set_value('adpdocs_attendanceslip', $row->adpdocs_attendanceslip),

                ];
                $this->content = 'adpdocs/adpdocs_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adpdocs'));
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
                $this->update($this->input->post('adpdocs_id', true));
            } else {
                $data = [
                    'adpdocs_adppermit_id' => $this->input->post('adpdocs_adppermit_id', true),
                    'adpdocs_attendanceslip' => $this->input->post('adpdocs_attendanceslip', true),
                    'adpdocs_updated_at' => date('Y-m-d H:i:s'),
                    'adpdocs_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->adpdocs_model->update(fixzy_decoder($this->input->post('adpdocs_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('adpdocs'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->adpdocs_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->adpdocs_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('adpdocs'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adpdocs'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->adpdocs_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'adpdocs_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->adpdocs_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('adpdocs'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('adpdocs'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('adpdocs_adppermit_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('adpdocs_attendanceslip', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'adpdocs_id',
            'adpdocs_adppermit_id',
            'adpdocs_attendanceslip',

        ];
        $results = $this->adpdocs_model->listajax(
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
                $rud .= anchor(site_url('adpdocs/read/' . fixzy_encoder($r['adpdocs_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('adpdocs/update/' . fixzy_encoder($r['adpdocs_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('adpdocs/delete/' . fixzy_encoder($r['adpdocs_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['adppermit_permit_id_adpdocs_adppermit_id'],
                $r['adpdocs_attendanceslip'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->adpdocs_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->adpdocs_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Adpdocs.php */
/* Location: ./application/controllers/Adpdocs.php */
