<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Company extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('company_model');
        $this->lang->load('company_lang', $this->session->userdata('language'));

    }

    public function index()
    {

/*        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $company = $this->company_model->get_all();

            $data = [
                'company_data' => $company,
                'permission' => $this->permission,
            ];

            $this->content = 'company/company_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }*/

        $this->read();

    }

    //type=normal/raw
    public function read($type = "normal")
    {

        if ($this->permission->cp_read == true) {

            $id      = $this->session->userdata('companyid');
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->company_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'company_name' => $row->company_name,
                    'company_address' => $row->company_address,
                    'company_userdepartment' => $row->company_userdepartment,
                    'company_registerednumber' => $row->company_registerednumber,
                    'company_contact_person' => $row->company_contact_person,
                    'company_contact_email' => $row->company_contact_email,
                    'company_contact_phone' => $row->company_contact_phone,
                    'company_contact_fax' => $row->company_contact_fax,

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

                    $this->content = 'company/company_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('company/company_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('company'));
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
                'action' => site_url('company/create_action'),
                'company_name' => set_value('company_name'),
                'company_address' => set_value('company_address'),
                'company_userdepartment' => set_value('company_userdepartment'),
                'company_registerednumber' => set_value('company_registerednumber'),
                'company_contact_person' => set_value('company_contact_person'),
                'company_contact_email' => set_value('company_contact_email'),
                'company_contact_phone' => set_value('company_contact_phone'),
                'company_contact_fax' => set_value('company_contact_fax'),

            ];
            $this->content = 'company/company_form';
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
                    'company_name' => $this->input->post('company_name', true),
                    'company_address' => $this->input->post('company_address', true),
                    'company_userdepartment' => $this->input->post('company_userdepartment', true),
                    'company_registerednumber' => $this->input->post('company_registerednumber', true),
                    'company_contact_person' => $this->input->post('company_contact_person', true),
                    'company_contact_email' => $this->input->post('company_contact_email', true),
                    'company_contact_phone' => $this->input->post('company_contact_phone', true),
                    'company_contact_fax' => $this->input->post('company_contact_fax', true),

                ];
                $this->company_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('company'));
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
            $row = $this->company_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('company/update_action'),
                    'id' => $id,
                    'company_name' => set_value('company_name', $row->company_name),
                    'company_address' => set_value('company_address', $row->company_address),
                    'company_userdepartment' => set_value('company_userdepartment', $row->company_userdepartment),
                    'company_registerednumber' => set_value('company_registerednumber', $row->company_registerednumber),
                    'company_contact_person' => set_value('company_contact_person', $row->company_contact_person),
                    'company_contact_email' => set_value('company_contact_email', $row->company_contact_email),
                    'company_contact_phone' => set_value('company_contact_phone', $row->company_contact_phone),
                    'company_contact_fax' => set_value('company_contact_fax', $row->company_contact_fax),

                ];
                $this->content = 'company/company_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('company'));
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
                $this->update($this->input->post('company_id', true));
            } else {
                $data = [
                    'company_name' => $this->input->post('company_name', true),
                    'company_address' => $this->input->post('company_address', true),
                    'company_userdepartment' => $this->input->post('company_userdepartment', true),
                    'company_registerednumber' => $this->input->post('company_registerednumber', true),
                    'company_contact_person' => $this->input->post('company_contact_person', true),
                    'company_contact_email' => $this->input->post('company_contact_email', true),
                    'company_contact_phone' => $this->input->post('company_contact_phone', true),
                    'company_contact_fax' => $this->input->post('company_contact_fax', true),

                ];
                $this->company_model->update(fixzy_decoder($this->input->post('company_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('company'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->company_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->company_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('company'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('company'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->company_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'company_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->company_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('company'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('company'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('company_name', ' ', 'trim|required');
        $this->form_validation->set_rules('company_address', ' ', 'trim');
        $this->form_validation->set_rules('company_userdepartment', ' ', 'trim');
        $this->form_validation->set_rules('company_registerednumber', ' ', 'trim');
        $this->form_validation->set_rules('company_contact_person', ' ', 'trim');
        $this->form_validation->set_rules('company_contact_email', ' ', 'trim');
        $this->form_validation->set_rules('company_contact_phone', ' ', 'trim');
        $this->form_validation->set_rules('company_contact_fax', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'company_id',
            'company_name',
            'company_address',
            'company_userdepartment',
            'company_registerednumber',
            'company_contact_person',
            'company_contact_email',
            'company_contact_phone',
            'company_contact_fax',

        ];
        $results = $this->company_model->listajax(
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
                $rud .= anchor(site_url('company/read/' . fixzy_encoder($r['company_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('company/update/' . fixzy_encoder($r['company_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('company/delete/' . fixzy_encoder($r['company_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['company_name'],
                $r['company_address'],
                $r['company_userdepartment'],
                $r['company_registerednumber'],
                $r['company_contact_person'],
                $r['company_contact_email'],
                $r['company_contact_phone'],
                $r['company_contact_fax'],

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->company_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->company_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Company.php */
/* Location: ./application/controllers/Company.php */
