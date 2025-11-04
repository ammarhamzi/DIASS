<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pic extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pic_model');
        $this->lang->load('pic_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$pic = $this->pic_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                //'pic_data' => $pic,
                'permission' => $this->permission,
            ];

            $this->content = 'pic/pic_list';
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
            $row = $this->pic_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pic_company_id' => $row->company_name_pic_company_id,
                    'pic_fullname' => $row->pic_fullname,
                    'pic_ic' => $row->pic_ic,
                    'pic_phoneoffice' => $row->pic_phoneoffice,
                    'pic_handphone' => $row->pic_handphone,
                    'pic_email' => $row->pic_email,

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

                    $this->content = 'pic/pic_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('pic/pic_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
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
                'action' => site_url('pic/create_action'),
                'pic_company_id' => set_value('pic_company_id'),
                'company' => $this->pic_model->get_all_company(),
                'pic_fullname' => set_value('pic_fullname'),
                'pic_ic' => set_value('pic_ic'),
                'pic_phoneoffice' => set_value('pic_phoneoffice'),
                'pic_handphone' => set_value('pic_handphone'),
                'pic_email' => set_value('pic_email'),

            ];
            $this->content = 'pic/pic_form';
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
                    'pic_company_id' => $this->input->post('pic_company_id', true),
                    'pic_fullname' => $this->input->post('pic_fullname', true),
                    'pic_ic' => $this->input->post('pic_ic', true),
                    'pic_phoneoffice' => $this->input->post('pic_phoneoffice', true),
                    'pic_handphone' => $this->input->post('pic_handphone', true),
                    'pic_email' => $this->input->post('pic_email', true),
                    'pic_created_at' => date('Y-m-d H:i:s'),
                    'pic_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pic_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pic'));
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
            $row = $this->pic_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('pic/update_action'),
                    'id' => $id,
                    'pic_company_id' => set_value('pic_company_id', $row->pic_company_id),
                    'company' => $this->pic_model->get_all_company(),
                    'pic_fullname' => set_value('pic_fullname', $row->pic_fullname),
                    'pic_ic' => set_value('pic_ic', $row->pic_ic),
                    'pic_phoneoffice' => set_value('pic_phoneoffice', $row->pic_phoneoffice),
                    'pic_handphone' => set_value('pic_handphone', $row->pic_handphone),
                    'pic_email' => set_value('pic_email', $row->pic_email),

                ];
                $this->content = 'pic/pic_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
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
                $this->update($this->input->post('pic_id', true));
            } else {
                $data = [
                    'pic_company_id' => $this->input->post('pic_company_id', true),
                    'pic_fullname' => $this->input->post('pic_fullname', true),
                    'pic_ic' => $this->input->post('pic_ic', true),
                    'pic_phoneoffice' => $this->input->post('pic_phoneoffice', true),
                    'pic_handphone' => $this->input->post('pic_handphone', true),
                    'pic_email' => $this->input->post('pic_email', true),
                    'pic_updated_at' => date('Y-m-d H:i:s'),
                    'pic_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pic_model->update(fixzy_decoder($this->input->post('pic_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pic_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->pic_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pic'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pic_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pic_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->pic_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pic'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('pic_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pic_fullname', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_ic', ' ', 'trim');
        $this->form_validation->set_rules('pic_phoneoffice', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_handphone', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_email', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'pic_id',
            'company_name',
            'pic_fullname',
            'pic_ic',
            'pic_phoneoffice',
            'pic_handphone',
            'pic_email',

        ];
        $results = $this->pic_model->listajax(
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
                $rud .= anchor(site_url('pic/read/' . fixzy_encoder($r['pic_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('pic/update/' . fixzy_encoder($r['pic_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('pic/delete/' . fixzy_encoder($r['pic_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['company_name_pic_company_id'],
                $r['pic_fullname'],
                $r['pic_ic'],
                $r['pic_phoneoffice'],
                $r['pic_handphone'],
                $r['pic_email'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->pic_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->pic_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Pic.php */
/* Location: ./application/controllers/Pic.php */
