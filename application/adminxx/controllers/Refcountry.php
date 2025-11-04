<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Refcountry extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('refcountry_model');
        $this->lang->load('refcountry_lang',
            $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {
            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $refcountry = $this->refcountry_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'refcountry_data' => $refcountry,
                'permission' => $this->permission,
            ];
            $this->content = 'refcountry/refcountry_list';
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
            $row = $this->refcountry_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'ref_country_iso' => $row->ref_country_iso,
                    'ref_country_name' => $row->ref_country_name,
                    'ref_country_printable_name' => $row->ref_country_printable_name,
                    'ref_country_iso3' => $row->ref_country_iso3,
                    'ref_country_numcode' => $row->ref_country_numcode,
                ];
                $this->content = 'refcountry/refcountry_read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('refcountry'));
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
                'action' => site_url('refcountry/create_action'),
                'ref_country_iso' => set_value('ref_country_iso'),
                'ref_country_name' => set_value('ref_country_name'),
                'ref_country_printable_name' => set_value('ref_country_printable_name'),
                'ref_country_iso3' => set_value('ref_country_iso3'),
                'ref_country_numcode' => set_value('ref_country_numcode'),
            ];
            $this->content = 'refcountry/refcountry_form';
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
                    'ref_country_iso' => $this->input->post('ref_country_iso',
                        true),
                    'ref_country_name' => $this->input->post('ref_country_name',
                        true),
                    'ref_country_printable_name' => $this->input->post('ref_country_printable_name',
                        true),
                    'ref_country_iso3' => $this->input->post('ref_country_iso3',
                        true),
                    'ref_country_numcode' => $this->input->post('ref_country_numcode',
                        true),
                    'ref_country_created_at' => date('Y-m-d H:i:s'),
                    'ref_country_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->refcountry_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('refcountry'));
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
            $row = $this->refcountry_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('refcountry/update_action'),
                    'id' => $id,
                    'ref_country_iso' => set_value('ref_country_iso',
                        $row->ref_country_iso),
                    'ref_country_name' => set_value('ref_country_name',
                        $row->ref_country_name),
                    'ref_country_printable_name' => set_value('ref_country_printable_name',
                        $row->ref_country_printable_name),
                    'ref_country_iso3' => set_value('ref_country_iso3',
                        $row->ref_country_iso3),
                    'ref_country_numcode' => set_value('ref_country_numcode',
                        $row->ref_country_numcode),
                ];
                $this->content = 'refcountry/refcountry_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('refcountry'));
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
                $this->update($this->input->post('ref_country_id', true));
            } else {
                $data = [
                    'ref_country_iso' => $this->input->post('ref_country_iso',
                        true),
                    'ref_country_name' => $this->input->post('ref_country_name',
                        true),
                    'ref_country_printable_name' => $this->input->post('ref_country_printable_name',
                        true),
                    'ref_country_iso3' => $this->input->post('ref_country_iso3',
                        true),
                    'ref_country_numcode' => $this->input->post('ref_country_numcode',
                        true),
                    'ref_country_updated_at' => date('Y-m-d H:i:s'),
                    'ref_country_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->refcountry_model->update(fixzy_decoder($this->input->post('ref_country_id')),
                    $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('refcountry'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {
            $id  = fixzy_decoder($id);
            $row = $this->refcountry_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->refcountry_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('refcountry'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('refcountry'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {
        if ($this->permission->cp_delete == true) {
            $id  = fixzy_decoder($id);
            $row = $this->refcountry_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'ref_country_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->refcountry_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('refcountry'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('refcountry'));
            }
        } else {
            redirect('/');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('ref_country_iso', ' ',
            'trim|required');
        $this->form_validation->set_rules('ref_country_name', ' ',
            'trim|required');
        $this->form_validation->set_rules('ref_country_printable_name', ' ',
            'trim|required');
        $this->form_validation->set_rules('ref_country_iso3', ' ', 'trim');
        $this->form_validation->set_rules('ref_country_numcode', ' ',
            'trim|integer');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {
        if ($this->permission->showlist == true) {
            $i       = $this->input->get('start');
            $columns = [
                'ref_country_id',
                'ref_country_iso',
                'ref_country_name',
                'ref_country_printable_name',
                'ref_country_iso3',
                'ref_country_numcode',
            ];
            $results = $this->refcountry_model->listajax(
                $columns, $this->input->get('start'),
                $this->input->get('length'),
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
                        $r['ref_country_iso'],
                        $r['ref_country_name'],
                        $r['ref_country_printable_name'],
                        $r['ref_country_iso3'],
                        $r['ref_country_numcode'],
                        anchor(site_url('refcountry/update/' . fixzy_encoder($r['ref_country_id'])),
                            $this->lang->line('edit')),
                    ]);
            }

            echo json_encode(
                [
                    "draw" => intval($this->input->get('draw')),
                    "recordsTotal" => $this->refcountry_model->recordsTotal()->recordstotal,
                    "recordsFiltered" => $this->refcountry_model->recordsFiltered($columns,
                        $this->input->get('search')['value'])->recordsfiltered,
                    'data' => $data
                ]
            );
        } else {
            redirect('/');
        }
    }
}
;
/* End of file Refcountry.php */
/* Location: ./application/controllers/Refcountry.php */
