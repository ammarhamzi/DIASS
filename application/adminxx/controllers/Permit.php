<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permit_model');
        $this->lang->load('permit_lang', $this->session->userdata('language'));

    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $permit = $this->permit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permit_data' => $permit,
                'permission' => $this->permission,
            ];

            $this->content = 'permit/permit_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function adp_completed()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $permit = $this->permit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permit_data' => $permit,
                'permission' => $this->permission,
            ];

            $this->content = 'permit/permit_adplist';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function evdp_completed()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $permit = $this->permit_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permit_data' => $permit,
                'permission' => $this->permission,
            ];

            $this->content = 'permit/permit_evdplist';
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
            $row = $this->permit_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'permit_groupid' => $row->permit_group_name_permit_groupid,
                    'permit_typeid' => $row->permit_type_name_permit_typeid,
                    'permit_condition' => $row->permit_condition_name_permit_condition,
                    'permit_bookingid' => $row->permit_bookingid,
                    'permit_picid' => $row->pic_fullname_permit_picid,
                    'permit_issuance_serialno' => $row->permit_issuance_serialno,
                    'permit_issuance_date' => $row->permit_issuance_date,
                    'permit_issuance_startdate' => $row->permit_issuance_startdate,
                    'permit_issuance_expirydate' => $row->permit_issuance_expirydate,
                    'permit_issuance_processedby' => $row->user_name_permit_issuance_processedby,
                    'permit_payment_invoiceno' => $row->permit_payment_invoiceno,
                    'permit_payment_trainingfee' => $row->permit_payment_trainingfee,
                    'permit_payment_new' => $row->permit_payment_new,
                    'permit_payment_renew_oneyear' => $row->permit_payment_renew_oneyear,
                    'permit_payment_renew_prorated' => $row->permit_payment_renew_prorated,
                    'permit_payment_sst' => $row->permit_payment_sst,
                    'permit_payment_total' => $row->permit_payment_total,
                    'permit_payment_processedby' => $row->user_name_permit_payment_processedby,
                    'permit_status' => $row->permit_status_desc_permit_status,
                    'permit_remark' => $row->permit_remark,

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

                    $this->content = 'permit/permit_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('permit/permit_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permit'));
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
                'action' => site_url('permit/create_action'),
                'permit_groupid' => set_value('permit_groupid'),
                'permit_group' => $this->permit_model->get_all_permit_group(),
                'permit_typeid' => set_value('permit_typeid'),
                'permit_type' => $this->permit_model->get_all_permit_type(),
                'permit_condition' => set_value('permit_condition'),
                'permit_condition' => $this->permit_model->get_all_permit_condition(),
                'permit_bookingid' => set_value('permit_bookingid'),
                'permit_picid' => set_value('permit_picid'),
                'pic' => $this->permit_model->get_all_pic(),
                'permit_issuance_serialno' => set_value('permit_issuance_serialno'),
                'permit_issuance_date' => set_value('permit_issuance_date'),
                'permit_issuance_startdate' => set_value('permit_issuance_startdate'),
                'permit_issuance_expirydate' => set_value('permit_issuance_expirydate'),
                'permit_issuance_processedby' => set_value('permit_issuance_processedby'),
                'user' => $this->permit_model->get_all_user(),
                'permit_payment_invoiceno' => set_value('permit_payment_invoiceno'),
                'permit_payment_trainingfee' => set_value('permit_payment_trainingfee'),
                'permit_payment_new' => set_value('permit_payment_new'),
                'permit_payment_renew_oneyear' => set_value('permit_payment_renew_oneyear'),
                'permit_payment_renew_prorated' => set_value('permit_payment_renew_prorated'),
                'permit_payment_sst' => set_value('permit_payment_sst'),
                'permit_payment_total' => set_value('permit_payment_total'),
                'permit_payment_processedby' => set_value('permit_payment_processedby'),
                'permit_status' => set_value('permit_status'),
                'permit_status' => $this->permit_model->get_all_permit_status(),
                'permit_remark' => set_value('permit_remark'),

            ];
            $this->content = 'permit/permit_form';
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
                    'permit_groupid' => $this->input->post('permit_groupid', true),
                    'permit_typeid' => $this->input->post('permit_typeid', true),
                    'permit_condition' => $this->input->post('permit_condition', true),
                    'permit_bookingid' => $this->input->post('permit_bookingid', true),
                    'permit_picid' => $this->input->post('permit_picid', true),
                    'permit_issuance_serialno' => $this->input->post('permit_issuance_serialno', true),
                    'permit_issuance_date' => $this->input->post('permit_issuance_date', true),
                    'permit_issuance_startdate' => $this->input->post('permit_issuance_startdate', true),
                    'permit_issuance_expirydate' => $this->input->post('permit_issuance_expirydate', true),
                    'permit_issuance_processedby' => $this->input->post('permit_issuance_processedby', true),
                    'permit_payment_invoiceno' => $this->input->post('permit_payment_invoiceno', true),
                    'permit_payment_trainingfee' => $this->input->post('permit_payment_trainingfee', true),
                    'permit_payment_new' => $this->input->post('permit_payment_new', true),
                    'permit_payment_renew_oneyear' => $this->input->post('permit_payment_renew_oneyear', true),
                    'permit_payment_renew_prorated' => $this->input->post('permit_payment_renew_prorated', true),
                    'permit_payment_sst' => $this->input->post('permit_payment_sst', true),
                    'permit_payment_total' => $this->input->post('permit_payment_total', true),
                    'permit_payment_processedby' => $this->input->post('permit_payment_processedby', true),
                    'permit_status' => $this->input->post('permit_status', true),
                    'permit_remark' => $this->input->post('permit_remark', true),
                    'permit_created_at' => date('Y-m-d H:i:s'),
                    'permit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->permit_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('permit'));
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
            $row = $this->permit_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('permit/update_action'),
                    'id' => $id,
                    'permit_groupid' => set_value('permit_groupid', $row->permit_groupid),
                    'permit_group' => $this->permit_model->get_all_permit_group(),
                    'permit_typeid' => set_value('permit_typeid', $row->permit_typeid),
                    'permit_type' => $this->permit_model->get_all_permit_type(),
                    'permit_conditionid' => set_value('permit_condition', $row->permit_condition),
                    'permit_condition' => $this->permit_model->get_all_permit_condition(),
                    'permit_bookingid' => set_value('permit_bookingid', $row->permit_bookingid),
                    'permit_picid' => set_value('permit_picid', $row->permit_picid),
                    'pic' => $this->permit_model->get_all_pic(),
                    'permit_issuance_serialno' => set_value('permit_issuance_serialno', $row->permit_issuance_serialno),
                    'permit_issuance_date' => set_value('permit_issuance_date', $row->permit_issuance_date),
                    'permit_issuance_startdate' => set_value('permit_issuance_startdate', $row->permit_issuance_startdate),
                    'permit_issuance_expirydate' => set_value('permit_issuance_expirydate', $row->permit_issuance_expirydate),
                    'permit_issuance_processedby' => set_value('permit_issuance_processedby', $row->permit_issuance_processedby),
                    'user' => $this->permit_model->get_all_user(),
                    'permit_payment_invoiceno' => set_value('permit_payment_invoiceno', $row->permit_payment_invoiceno),
                    'permit_payment_trainingfee' => set_value('permit_payment_trainingfee', $row->permit_payment_trainingfee),
                    'permit_payment_new' => set_value('permit_payment_new', $row->permit_payment_new),
                    'permit_payment_renew_oneyear' => set_value('permit_payment_renew_oneyear', $row->permit_payment_renew_oneyear),
                    'permit_payment_renew_prorated' => set_value('permit_payment_renew_prorated', $row->permit_payment_renew_prorated),
                    'permit_payment_sst' => set_value('permit_payment_sst', $row->permit_payment_sst),
                    'permit_payment_total' => set_value('permit_payment_total', $row->permit_payment_total),
                    'permit_payment_processedby' => set_value('permit_payment_processedby', $row->permit_payment_processedby),
                    'permit_status' => set_value('permit_status', $row->permit_status),
                    'permit_status' => $this->permit_model->get_all_permit_status(),
                    'permit_remark' => set_value('permit_remark', $row->permit_remark),

                ];
                $this->content = 'permit/permit_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permit'));
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
                $this->update($this->input->post('permit_id', true));
            } else {
                $data = [
                    'permit_bookingid' => $this->input->post('permit_bookingid', true),
                    'permit_picid' => $this->input->post('permit_picid', true),
                    'permit_issuance_serialno' => $this->input->post('permit_issuance_serialno', true),
                    'permit_issuance_date' => $this->input->post('permit_issuance_date', true),
                    'permit_issuance_startdate' => $this->input->post('permit_issuance_startdate', true),
                    'permit_issuance_expirydate' => $this->input->post('permit_issuance_expirydate', true),
                    'permit_issuance_processedby' => $this->input->post('permit_issuance_processedby', true),
                    'permit_payment_invoiceno' => $this->input->post('permit_payment_invoiceno', true),
                    'permit_payment_trainingfee' => $this->input->post('permit_payment_trainingfee', true),
                    'permit_payment_new' => $this->input->post('permit_payment_new', true),
                    'permit_payment_renew_oneyear' => $this->input->post('permit_payment_renew_oneyear', true),
                    'permit_payment_renew_prorated' => $this->input->post('permit_payment_renew_prorated', true),
                    'permit_payment_sst' => $this->input->post('permit_payment_sst', true),
                    'permit_payment_total' => $this->input->post('permit_payment_total', true),
                    'permit_payment_processedby' => $this->input->post('permit_payment_processedby', true),
                    'permit_status' => $this->input->post('permit_status', true),
                    'permit_remark' => $this->input->post('permit_remark', true),
                    'permit_updated_at' => date('Y-m-d H:i:s'),
                    'permit_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->permit_model->update(fixzy_decoder($this->input->post('permit_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->permit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->permit_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('permit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permit'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->permit_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'permit_deleted_at' => date('Y-m-d H:i:s')
                ];
                $this->permit_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('permit'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permit'));
            }

        } else {
            redirect('/');
        }

    }

    public function _rules()
    {
        $this->form_validation->set_rules('permit_groupid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_typeid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_condition', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_bookingid', ' ', 'trim|required');
        $this->form_validation->set_rules('permit_picid', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('permit_issuance_serialno', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_date', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_startdate', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_expirydate', ' ', 'trim');
        $this->form_validation->set_rules('permit_issuance_processedby', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_payment_invoiceno', ' ', 'trim');
        $this->form_validation->set_rules('permit_payment_trainingfee', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_new', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_renew_oneyear', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_renew_prorated', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_sst', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_total', ' ', 'trim|numeric');
        $this->form_validation->set_rules('permit_payment_processedby', ' ', 'trim|integer');
        $this->form_validation->set_rules('permit_status', ' ', 'trim|required');
        $this->form_validation->set_rules('permit_remark', ' ', 'trim');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }
/* --- All Permit ---- */
    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'permit_id',
            'permit_groupid',
            'permit_typeid',
            'permit_condition',
            'permit_bookingid',
            'permit_picid',
            'permit_issuance_serialno',
            'permit_issuance_date',
            'permit_issuance_startdate',
            'permit_issuance_expirydate',
            'permit_issuance_processedby',
            'permit_payment_invoiceno',
            'permit_payment_trainingfee',
            'permit_payment_new',
            'permit_payment_renew_oneyear',
            'permit_payment_renew_prorated',
            'permit_payment_sst',
            'permit_payment_total',
            'permit_payment_processedby',
            'permit_status',
            'permit_remark',

        ];
        $results = $this->permit_model->listajax(
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
                $rud .= anchor(site_url('permit/read/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('permit/update/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('permit/delete/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
                $r['permit_group_name_permit_groupid'],
                $r['permit_type_name_permit_typeid'],
/*              $r['permit_condition_name_permit_condition'],*/
                $r['permit_bookingid'],
/*              $r['pic_fullname_permit_picid'],*/
                $r['permit_issuance_serialno'],
/*              $r['permit_issuance_date'],*/
                $r['permit_issuance_startdate'],
                $r['permit_issuance_expirydate'],
/*              $r['user_name_permit_issuance_processedby'],
$r['permit_payment_invoiceno'],
$r['permit_payment_trainingfee'],
$r['permit_payment_new'],
$r['permit_payment_renew_oneyear'],
$r['permit_payment_renew_prorated'],
$r['permit_payment_sst'],
$r['permit_payment_total'],
$r['user_name_permit_payment_processedby'],*/
                $r['permit_status_desc_permit_status'],
/*              $r['permit_remark'],*/

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permit_model->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->permit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

/* ---- ADP permit --- */
    public function get_json_adp()
    {

        $i       = $this->input->get('start');
        $columns = [
            'permit_id',
            'permit_groupid',
            'permit_typeid',
            'permit_condition',
            'permit_bookingid',
            'permit_picid',
            'permit_issuance_serialno',
            'permit_issuance_date',
            'permit_issuance_startdate',
            'permit_issuance_expirydate',
            'permit_issuance_processedby',
            'permit_payment_invoiceno',
            'permit_payment_trainingfee',
            'permit_payment_new',
            'permit_payment_renew_oneyear',
            'permit_payment_renew_prorated',
            'permit_payment_sst',
            'permit_payment_total',
            'permit_payment_processedby',
            'permit_status',
            'permit_remark',

        ];
        $results = $this->permit_model->listajax_adp(
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
                $rud .= anchor(site_url('permit/read/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('permit/update/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('permit/delete/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
/*                $r['permit_group_name_permit_groupid'],
                $r['permit_type_name_permit_typeid'],*/
/*              $r['permit_condition_name_permit_condition'],*/
                $r['permit_bookingid'],
/*              $r['pic_fullname_permit_picid'],*/
                $r['permit_issuance_serialno'],
/*              $r['permit_issuance_date'],*/
                $r['permit_issuance_startdate'],
                $r['permit_issuance_expirydate'],
/*              $r['user_name_permit_issuance_processedby'],
$r['permit_payment_invoiceno'],
$r['permit_payment_trainingfee'],
$r['permit_payment_new'],
$r['permit_payment_renew_oneyear'],
$r['permit_payment_renew_prorated'],
$r['permit_payment_sst'],
$r['permit_payment_total'],
$r['user_name_permit_payment_processedby'],*/
/*                $r['permit_status_desc_permit_status'],*/
/*              $r['permit_remark'],*/

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permit_model->recordsTotal_adp()->recordstotal,
                "recordsFiltered" => $this->permit_model->recordsFiltered_adp($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

/* --- EVDP permit */

    public function get_json_evdp()
    {

        $i       = $this->input->get('start');
        $columns = [
            'permit_id',
            'permit_groupid',
            'permit_typeid',
            'permit_condition',
            'permit_bookingid',
            'permit_picid',
            'permit_issuance_serialno',
            'permit_issuance_date',
            'permit_issuance_startdate',
            'permit_issuance_expirydate',
            'permit_issuance_processedby',
            'permit_payment_invoiceno',
            'permit_payment_trainingfee',
            'permit_payment_new',
            'permit_payment_renew_oneyear',
            'permit_payment_renew_prorated',
            'permit_payment_sst',
            'permit_payment_total',
            'permit_payment_processedby',
            'permit_status',
            'permit_remark',

        ];
        $results = $this->permit_model->listajax_evdp(
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
                $rud .= anchor(site_url('permit/read/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('permit/update/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true) {
                $rud .= anchor(site_url('permit/delete/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,
/*                $r['permit_group_name_permit_groupid'],
                $r['permit_type_name_permit_typeid'],*/
/*              $r['permit_condition_name_permit_condition'],*/
                $r['permit_bookingid'],
/*              $r['pic_fullname_permit_picid'],*/
                $r['permit_issuance_serialno'],
/*              $r['permit_issuance_date'],*/
                $r['permit_issuance_startdate'],
                $r['permit_issuance_expirydate'],
/*              $r['user_name_permit_issuance_processedby'],
$r['permit_payment_invoiceno'],
$r['permit_payment_trainingfee'],
$r['permit_payment_new'],
$r['permit_payment_renew_oneyear'],
$r['permit_payment_renew_prorated'],
$r['permit_payment_sst'],
$r['permit_payment_total'],
$r['user_name_permit_payment_processedby'],*/
/*                $r['permit_status_desc_permit_status'], */
/*              $r['permit_remark'],*/

                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permit_model->recordsTotal_evdp()->recordstotal,
                "recordsFiltered" => $this->permit_model->recordsFiltered_evdp($columns, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
}
;
/* End of file Permit.php */
/* Location: ./application/controllers/Permit.php */
