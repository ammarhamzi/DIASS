<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ServiceCharges extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Userlist_group_model');
        $this->load->model('Charges_types_model');
        $this->load->model('Service_charges_model');
        $this->load->model('Service_charges_datatable_model');
        $this->lang->load('service_charge_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $data = $this->Service_charges_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'serviceCharges_data' => $data,
                'permission' => $this->permission,
            ];
            $this->content = 'serviceCharges/list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }
    }

    function ajaxList()
    {
        $list = $this->Service_charges_datatable_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) 
        {
            $raw_datetime = $field->servicecharges_requestordatetime;
            $txt_datetime = 'None';
            if(!empty($raw_datetime))
            {
              $txt_datetime = date('d-m-Y',strtotime($raw_datetime));
              $txt_time = date('h:i A',strtotime($raw_datetime));
            }

            switch ($field->servicecharges_status) {
              case '0':
                $status_txt = 'Open';
                $label_color = 'label bg-orange-active';
                $btn_upload_display = '';
                break;
              case '1':
                $status_txt = 'Close';
                $label_color = 'label label-danger';
                $btn_upload_display = 'display:none;';
                break;
              default:
                $status_txt = 'None';
                $label_color = '';
                $btn_upload_display = '';
                break;
            }

            $id = fixzy_encoder($field->servicecharges_id);

            $action_btn = '<button type="button" class="btn bg-maroon btn_upload" enc="'.$id.'" style="'.$btn_upload_display.'" data-toggle="tooltip" title="Upload Document"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></button>'.
            anchor(site_url('PdfOutput/airside_service_print/' . $id),
                                                '<button type="button" class="btn btn-info" data-toggle="tooltip" title="Print"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>','target="_blank"');

            if ($this->permission->cp_update == true) {

                $action_btn .= anchor(site_url('ServiceCharges/update/' . $id),
                    '<button type="button" class="btn btn-default" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');
            }
            if ($this->permission->cp_delete == true) {

                $action_btn .= anchor(site_url('ServiceCharges/delete/' . $id),
                    '<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                    'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.site_url('ServiceCharges/show/'.fixzy_encoder($field->servicecharges_id)).'">'.$field->charges_types_name.'</a>';
            $row[] = $field->servicecharges_flightNumber;
            $row[] = $field->servicecharges_requestor;
            $row[] = $txt_datetime.'<br />'.$txt_time;
            $row[] = '<span class="'.$label_color.'">'.$status_txt.'</span>';
            $row[] = $action_btn;
            
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Service_charges_datatable_model->count_all(),
            "recordsFiltered" => $this->Service_charges_datatable_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function read($id)
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->Service_charges_model->get_read($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {

                /*----------  Requestor Date & Time split  ----------*/
                $raw_datetime = $row->servicecharges_requestordatetime;
                $txt_date = $txt_time = '';
                if(!empty($raw_datetime))
                {
                    $txt_date = date('d/m/Y',strtotime($raw_datetime));
                    $txt_time = date('H:i:s',strtotime($raw_datetime));
                }

                //current file list name
                $file_list_raw = $row->servicecharges_files;
                $file_list_arr = explode(',', $file_list_raw);
                $file_arr = array();
                if(!empty($file_list_raw) && count($file_list_arr) > 0)
                {
                    foreach($file_list_arr as $fla)
                    {
                        $file_arr[] = '<a href="'.base_url('resources/shared_file/'.$fla).'" target="_blank">'.$fla.'</a>';
                    }
                }
                $file_list_html = '';
                if(count($file_arr) > 0)
                {
                    $file_list_html = '<ol>
                                        <li>'.implode('</li><li>',$file_arr).'</li>
                                    </ol>';
                }

                $data = [
                    'id' => $id,
                    'ct_ids' => set_value('ct_ids',$row->servicecharges_ct_id),
                    'qty' => set_value('qty',$row->servicecharges_qty),
                    'flight_number' => set_value('flight_number',$row->servicecharges_flightNumber),
                    'reason' => set_value('reason',$row->servicecharges_reason),
                    'notes' => set_value('notes',$row->servicecharges_note),
                    'uploads' => set_value('uploads'),
                    'file_list_html' => $file_list_html,
                    'approval_choice' => set_value('approval_choice'),
                    'remarks_approval' => set_value('remarks_approval'),
                    'pic_id' => set_value('pic_id'),
                    'pic_name' => set_value('pic_name',$row->servicecharges_picname),
                    'requestor_txt' => set_value('requestor_txt',$row->servicecharges_requestor),
                    'req_phoneNo' => set_value('req_phoneNo',$row->servicecharges_requestorphone),
                    'req_email' => set_value('req_email',$row->servicecharges_requestoremail),
                    'date_field' => set_value('date_field',$txt_date),
                    'time_field' => set_value('time_field',$txt_time),
                    'pic_address' => set_value('pic_address',$row->servicecharges_picadrs),
                    'pic_phoneNo' => set_value('pic_phoneNo',$row->servicecharges_picphone),
                    'pic_email' => set_value('pic_email',$row->servicecharges_picemail),

                    'charges_types_list' => $this->Charges_types_model->get_all(),
                    // 'pic_list'=>$this->Charges_types_model->get_user_type('2'),
                ];
                $this->content = 'serviceCharges/read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ServiceCharges'));
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
                'action' => site_url('ServiceCharges/create_action'),
                'ct_ids' => set_value('ct_ids'),
                'qty' => set_value('qty'),
                'flight_number' => set_value('flight_number'),
                'reason' => set_value('reason'),
                'notes' => set_value('notes'),
                'uploads' => set_value('uploads'),
                'file_list_html' => '',
                'approval_choice' => set_value('approval_choice'),
                'remarks_approval' => set_value('remarks_approval'),
                'pic_id' => set_value('pic_id'),
                'pic_name' => set_value('pic_name'),
                'requestor_txt' => set_value('requestor_txt'),
                'req_phoneNo' => set_value('req_phoneNo'),
                'req_email' => set_value('req_email'),
                'designation_field' => set_value('designation_field'),
                'req_company_name' => set_value('req_company_name'),
                'date_field' => set_value('date_field'),
                'time_field' => set_value('time_field'),
                'pic_address' => set_value('pic_address'),
                'pic_phoneNo' => set_value('pic_phoneNo'),
                'pic_email' => set_value('pic_email'),
                'paymentMethod' => set_value('paymentMethod'),
                'paymentLocation' => set_value('paymentLocation'),
                'payment_date_field'=>set_value('payment_date_field'),
                'payment_time_field'=>set_value('payment_time_field'),

                'charges_types_list' => $this->Charges_types_model->get_all(),
                // 'pic_list'=>$this->Charges_types_model->get_user_type('2'),
            ];
            $this->content = 'serviceCharges/form';
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

                //date time field from requestor
                $req_date = $this->input->post('date_field');
                $req_time = $this->input->post('time_field');
                $req_datetime = date('Y-m-d H:i:s',strtotime($req_date.' '.$req_time));

                //upload file list
                $txt_file = '';
                $file_json = $this->input->post('file_arr');
                if(isset($file_json) && !empty($file_json))
                {
                    $txt_arr = array();
                    $file_arr = json_decode($file_json,true);
                    if(count($file_arr) > 1)
                    {
                        foreach($file_arr as $fa)
                        {
                            $txt_arr[] = $fa['file_name'];
                        }
                    }

                    echo $txt_file = implode(',',$txt_arr);
                }

                //paymentdatetime field
                $payment_df = $this->input->post('payment_date_field');
                $payment_tf = $this->input->post('payment_time_field');
                $servicecharges_paymentDatetime = '';
                if(!empty($payment_df))
                {
                    if(!empty($payment_tf))
                    {
                        $payment_tf = date('H:i:s',strtotime($payment_tf));
                    }
                    else
                    {
                        $payment_tf = date('H:i:00');
                    }
                    $servicecharges_paymentDatetime = date('Y-m-d H:i:s',strtotime($payment_df.' '.$payment_tf));
                }

                $data = [
                    'servicecharges_ct_id' => $this->input->post('ct_ids', true),
                    'servicecharges_qty' => ($this->input->post('qty',true)),
                    'servicecharges_flightNumber' => $this->input->post('flight_number', true),
                    'servicecharges_reason' => $this->input->post('reason', true),
                    'servicecharges_note' => $this->input->post('notes', true),
                    'servicecharges_requestor' => $this->input->post('requestor_txt', true),
                    'servicecharges_requestordatetime' => $req_datetime,
                    'servicecharges_requestorphone' => $this->input->post('req_phoneNo', true),
                    'servicecharges_requestoremail' => $this->input->post('req_email', true),
                    'servicecharges_requestordesignation' => $this->input->post('designation_field', true),
                    'servicecharges_requestorcompanyname' => $this->input->post('req_company_name', true),
                    'servicecharges_picname' => $this->input->post('pic_name', true),
                    'servicecharges_picadrs' => $this->input->post('pic_address', true),
                    'servicecharges_picphone' => $this->input->post('pic_phoneNo', true),
                    'servicecharges_picemail' => $this->input->post('pic_email', true),
                    'servicecharges_files' => $txt_file,
                    'servicecharges_paymentMethod'=>$this->input->post('paymentMethod',true),
                    'servicecharges_paymentLocation'=>$this->input->post('paymentLocation',true),
                    'servicecharges_status' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->id, 
                    'active' => 1,
                ];

                if(!empty($servicecharges_paymentDatetime))
                {
                    $data['servicecharges_paymentDatetime'] = $servicecharges_paymentDatetime;
                }

                $this->Service_charges_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message_show', '
                        <h4><i class="icon fa fa-check"></i> Create Record Success!</h4>
                        Do you want to print? &nbsp;&nbsp;<a href="'.site_url('PdfOutput/airside_service_print/'.fixzy_encoder($primary_id)).'" target="_blank"><button type="button" class="btn btn-sm btn-info" >&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-print"></i> Print&nbsp;&nbsp;&nbsp;</button></a> &nbsp;&nbsp; <button type="button" class="btn btn-sm btn-default" data-dismiss="alert" aria-hidden="true">Close</button>
                    ');
                redirect(site_url('ServiceCharges/create'));
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
            $row = $this->Service_charges_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {

                /*----------  Requestor Date & Time split  ----------*/
                $raw_datetime = $row->servicecharges_requestordatetime;
                $txt_date = $txt_time = '';
                if(!empty($raw_datetime))
                {
                    $txt_date = date('d-m-Y',strtotime($raw_datetime));
                    $txt_time = date('H:i:s',strtotime($raw_datetime));
                }

                //current file list name
                $file_list_raw = $row->servicecharges_files;
                $file_list_arr = explode(',', $file_list_raw);
                $file_arr = array();
                if(!empty($file_list_raw) && count($file_list_arr) > 0)
                {
                    foreach($file_list_arr as $fla)
                    {
                        $file_arr[] = '<a href="'.base_url('resources/shared_file/'.$fla).'" target="_blank">'.$fla.'</a>';
                    }
                }
                $file_list_html = '';
                if(count($file_arr) > 0)
                {
                    $file_list_html = '<ol>
                                        <li>'.implode('</li><li>',$file_arr).'</li>
                                    </ol>';
                }

                /*----------  payment date time  ----------*/
                $raw_payment_datetime = $row->servicecharges_paymentDatetime;
                $payment_date_field = $payment_time_field = '';
                if(!empty($raw_payment_datetime))
                {
                    $payment_date_field = date('d-m-Y',strtotime($raw_payment_datetime));
                    $payment_time_field = date('H:i:00',strtotime($raw_payment_datetime));
                }

                $data = [
                    'button' => 'Update',
                    'action' => site_url('ServiceCharges/update_action'),
                    'id' => $id,
                    'ct_ids' => set_value('ct_ids',$row->servicecharges_ct_id),
                    'qty' => set_value('qty',$row->servicecharges_qty),
                    'flight_number' => set_value('flight_number',$row->servicecharges_flightNumber),
                    'reason' => set_value('reason',$row->servicecharges_reason),
                    'notes' => set_value('notes',$row->servicecharges_note),
                    'uploads' => set_value('uploads'),
                    'file_list_html' => $file_list_html,
                    'approval_choice' => set_value('approval_choice'),
                    'remarks_approval' => set_value('remarks_approval'),
                    'pic_id' => set_value('pic_id'),
                    'pic_name' => set_value('pic_name',$row->servicecharges_picname),
                    'requestor_txt' => set_value('requestor_txt',$row->servicecharges_requestor),
                    'req_phoneNo' => set_value('req_phoneNo',$row->servicecharges_requestorphone),
                    'req_email' => set_value('req_email',$row->servicecharges_requestoremail),
                    'designation_field' => set_value('designation_field',$row->servicecharges_requestordesignation),
                    'req_company_name' => set_value('req_company_name',$row->servicecharges_requestorcompanyname),
                    'date_field' => set_value('date_field',$txt_date),
                    'time_field' => set_value('time_field',$txt_time),
                    'pic_address' => set_value('pic_address',$row->servicecharges_picadrs),
                    'pic_phoneNo' => set_value('pic_phoneNo',$row->servicecharges_picphone),
                    'pic_email' => set_value('pic_email',$row->servicecharges_picemail),
                    'paymentMethod' => set_value('paymentMethod',$row->servicecharges_paymentMethod),
                    'paymentLocation' => set_value('paymentLocation',$row->servicecharges_paymentLocation),
                    'payment_date_field'=>set_value('payment_date_field',$payment_date_field),
                    'payment_time_field'=>set_value('payment_time_field',$payment_time_field),

                    'charges_types_list' => $this->Charges_types_model->get_all(),
                    // 'pic_list'=>$this->Charges_types_model->get_user_type('2'),
                ];
                $this->content = 'serviceCharges/form';

                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record NOT FOUND');
                redirect(site_url('ServiceCharges'));
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
                $this->update($this->input->post('sc_id', true));
            } else {

                //requestor date time field
                $req_date = $this->input->post('date_field');
                $req_time = $this->input->post('time_field');
                $req_datetime = date('Y-m-d H:i:s',strtotime($req_date.' '.$req_time));

                $data = [
                    'servicecharges_ct_id' => $this->input->post('ct_ids', true),
                    'servicecharges_qty' => ($this->input->post('qty',true)),
                    'servicecharges_flightNumber' => $this->input->post('flight_number', true),
                    'servicecharges_reason' => $this->input->post('reason', true),
                    'servicecharges_note' => $this->input->post('notes', true),
                    'servicecharges_requestor' => $this->input->post('requestor_txt', true),
                    'servicecharges_requestordatetime' => $req_datetime,
                    'servicecharges_requestorphone' => $this->input->post('req_phoneNo', true),
                    'servicecharges_requestoremail' => $this->input->post('req_email', true),
                    'servicecharges_requestordesignation' => $this->input->post('designation_field', true),
                    'servicecharges_requestorcompanyname' => $this->input->post('req_company_name', true),
                    'servicecharges_picname' => $this->input->post('pic_name', true),
                    'servicecharges_picadrs' => $this->input->post('pic_address', true),
                    'servicecharges_picphone' => $this->input->post('pic_phoneNo', true),
                    'servicecharges_picemail' => $this->input->post('pic_email', true),
                    'servicecharges_paymentMethod'=>$this->input->post('paymentMethod',true),
                    'servicecharges_paymentLocation'=>$this->input->post('paymentLocation',true),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->id, 
                ];

                //paymentdatetime field
                $payment_df = $this->input->post('payment_date_field');
                $payment_tf = $this->input->post('payment_time_field');
                $servicecharges_paymentDatetime = '';
                if(!empty($payment_df))
                {
                    if(!empty($payment_tf))
                    {
                        $payment_tf = date('H:i:s',strtotime($payment_tf));
                    }
                    else
                    {
                        $payment_tf = date('H:i:00');
                    }
                    $servicecharges_paymentDatetime = date('Y-m-d H:i:s',strtotime($payment_df.' '.$payment_tf));
                    $data['servicecharges_paymentDatetime'] = $servicecharges_paymentDatetime;
                }

                //upload file list
                $txt_file = '';
                $file_json = $this->input->post('file_arr');
                if(isset($file_json) && !empty($file_json))
                {
                    $txt_arr = array();
                    $file_arr = json_decode($file_json,true);
                    if(count($file_arr) > 1)
                    {
                        $txt_arr[] = $file_arr['file_name'];
                    }

                    $txt_file = implode(',',$txt_arr);
                }

                if(!empty($txt_file))
                {
                    $data['servicecharges_files'] = $txt_file;
                }

                $this->Service_charges_model->update(fixzy_decoder($this->input->post('sc_id')),$data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('ServiceCharges'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->Service_charges_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->Service_charges_model->remove($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('ServiceCharges'));
            } else {
                $this->session->set_flashdata('message', 'Record NOT FOUND');
                redirect(site_url('ServiceCharges'));
            }
        } else {
            redirect('/');
        }
    }

    public function delete_update($id)
    {

        // if ($this->permission->cp_delete == true) {

        //     $id  = fixzy_decoder($id);
        //     $row = $this->user_model->get_by_id($id);
        //     /* $this->logQueries($this->config->item('dblog')); */
        //     if ($row) {
        //         $data = [
        //             'user_deleted_at' => date('Y-m-d H:i:s')
        //         ];
        //         $this->user_model->update($id, $data);
        //         /* $this->logQueries($this->config->item('dblog')); */
        //         $this->session->set_flashdata('message', 'Delete Record Success');
        //         redirect(site_url('user'));
        //     } else {
        //         $this->session->set_flashdata('message', 'Record Not Found');
        //         redirect(site_url('user'));
        //     }
        // } else {
        //     redirect('/');
        // }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('ct_ids', ' ', 'trim|required');
        $this->form_validation->set_rules('qty', ' ', 'trim|required');
        $this->form_validation->set_rules('flight_number', ' ', 'trim|required');
        $this->form_validation->set_rules('reason', ' ', 'trim|required');
        // $this->form_validation->set_rules('notes', ' ', 'trim|required');
        $this->form_validation->set_rules('requestor_txt', ' ', 'trim|required');
        $this->form_validation->set_rules('req_phoneNo', ' ', 'trim|required');
        $this->form_validation->set_rules('req_email', ' ', 'trim|required');
        // $this->form_validation->set_rules('pic_name', ' ', 'trim|required');
        // $this->form_validation->set_rules('pic_address', ' ', 'trim|required');
        // $this->form_validation->set_rules('pic_phoneNo', ' ', 'trim|required');
        // $this->form_validation->set_rules('pic_email', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _rules_nopassword()
    {
        $this->form_validation->set_rules('user_username', ' ', 'trim|required');
        $this->form_validation->set_rules('user_name', ' ', 'trim|required');
        $this->form_validation->set_rules('user_email', ' ', 'trim|required');
        $this->form_validation->set_rules('user_photo', ' ', 'trim');
        $this->form_validation->set_rules('user_groupid[]', ' ', 'required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {
        // $i       = $this->input->get('start');
        // $columns = [
        //     'user_id',
        //     'user_username',
        //     'user_password',
        //     'user_name',
        //     'user_email',
        //     'user_photo',
        //     'user_groupid',
        // ];
        // $results = $this->user_model->listajax(
        //     $columns, $this->input->get('start'), $this->input->get('length'),
        //     $this->input->get('search')['value'],
        //     $columns[$this->input->get('order')[0]['column']],
        //     $this->input->get('order')[0]['dir']
        // );
        // $data = [];
        // foreach ($results as $r) {
        //     $i++;
        //     array_push($data,
        //         [
        //             $i,
        //             $r['user_username'],
        //             $r['user_password'],
        //             $r['user_name'],
        //             $r['user_email'],
        //             $r['user_photo'],
        //             $r['usergroup_name_user_groupid'],
        //             anchor(site_url('user/read/' . fixzy_encoder($r['user_id'])),
        //                 $this->lang->line('detail')) .
        //             ' ' .
        //             anchor(site_url('user/update/' . fixzy_encoder($r['user_id'])),
        //                 $this->lang->line('edit')) .
        //             ' ' .
        //             anchor(site_url('user/delete/' . fixzy_encoder($r['user_id'])),
        //                 $this->lang->line('delete'),
        //                 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"')
        //         ]);
        // }

        // echo json_encode(
        //     [
        //         "draw" => intval($this->input->get('draw')),
        //         "recordsTotal" => $this->user_model->recordsTotal()->recordstotal,
        //         "recordsFiltered" => $this->user_model->recordsFiltered($columns,
        //             $this->input->get('search')['value'])->recordsfiltered,
        //         'data' => $data
        //     ]
        // );
    }

    public function get_charge_type_info()
    {
        $ct_id = $this->input->post('ct');

        $ct_det = $this->Charges_types_model->get_by_id($ct_id);

        echo json_encode($ct_det);
    }

    function change_status($id)
    {
        if(empty($id))
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $id = fixzy_decoder($id);

        if($id <= 0)
        {
            echo json_encode(array('res'=>0,));
            die();
        }

        $data = array(
            'servicecharges_status'=>1,
            'servicecharges_statusDate'=>date('Y-m-d H:i:s'),
            'servicecharges_files'=>$this->input->post('file_name'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->id, 
        );

        $this->Service_charges_model->update($id,$data);

        echo json_encode(array('res'=>1,));
        die();
    }

    public function show($id)
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->Service_charges_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {

                /*----------  Requestor Date & Time split  ----------*/
                $raw_datetime = $row->servicecharges_requestordatetime;
                $txt_date = $txt_time = '';
                if(!empty($raw_datetime))
                {
                    $txt_date = date('d-m-Y',strtotime($raw_datetime));
                    $txt_time = date('h:i A',strtotime($raw_datetime));
                }

                //current file list name
                $file_list_raw = $row->servicecharges_files;
                $file_list_arr = explode(',', $file_list_raw);
                $file_arr = array();
                if(!empty($file_list_raw) && count($file_list_arr) > 0)
                {
                    foreach($file_list_arr as $fla)
                    {
                        $file_arr[] = '<a href="'.base_url('../resources/shared_file/'.$fla).'" target="_blank">'.$fla.'</a>';
                    }
                }
                $file_list_html = '';
                if(count($file_arr) > 0)
                {
                    $file_list_html = ''.implode('</li><li>',$file_arr).'';
                }

                switch ($row->servicecharges_paymentMethod) {
                    case 1:
                        $payment_method_txt = 'Cash';
                        break;
                    case 2:
                        $payment_method_txt = 'Cheque';
                        break;
                    case 3:
                        $payment_method_txt = 'Credit Facilities';
                        break;
                    case 4:
                        $payment_method_txt = 'Free of Charges';
                        break;
                    default:
                        $payment_method_txt = 'All';
                        break;
                }

                switch ($row->servicecharges_status) {
                    case '0':
                        $status_txt = '<span class="label bg-orange-active">Open</span>';
                        $label_color = 'label bg-orange-active';
                        break;
                    case '1':
                        $status_txt = '<span class="label label-danger">Close</span> '.date('d-m-Y / h:i A',strtotime($row->servicecharges_statusDate));
                        $label_color = 'label label-danger';
                        break;
                    default:
                        $status_txt = 'None';
                        $label_color = '';
                        break;
                }

                $data = [
                    'id' => $id,
                    'status_txt'=>$status_txt,
                    'ct_ids' => set_value('ct_ids',$row->servicecharges_ct_id),
                    'charges_types_name' => $row->charges_types_name,
                    'qty' => set_value('qty',$row->servicecharges_qty),
                    'flight_number' => set_value('flight_number',$row->servicecharges_flightNumber),
                    'reason' => set_value('reason',$row->servicecharges_reason),
                    'notes' => set_value('notes',$row->servicecharges_note),
                    'payment_method_txt'=>$payment_method_txt,
                    'uploads' => set_value('uploads'),
                    'file_list_html' => $file_list_html,
                    'approval_choice' => set_value('approval_choice'),
                    'remarks_approval' => set_value('remarks_approval'),
                    'pic_id' => set_value('pic_id'),
                    'pic_name' => set_value('pic_name',$row->servicecharges_picname),
                    'requestor_txt' => set_value('requestor_txt',$row->servicecharges_requestor),
                    'req_phoneNo' => set_value('req_phoneNo',$row->servicecharges_requestorphone),
                    'req_email' => set_value('req_email',$row->servicecharges_requestoremail),
                    'designation_field' => set_value('designation_field',$row->servicecharges_requestordesignation),
                    'req_company_name' => set_value('req_company_name',$row->servicecharges_requestorcompanyname),
                    'date_field' => set_value('date_field',$txt_date),
                    'time_field' => set_value('time_field',$txt_time),
                    'pic_address' => set_value('pic_address',$row->servicecharges_picadrs),
                    'pic_phoneNo' => set_value('pic_phoneNo',$row->servicecharges_picphone),
                    'pic_email' => set_value('pic_email',$row->servicecharges_picemail),
                    'paymentMethod' => set_value('paymentMethod',$row->servicecharges_paymentMethod),

                    'charges_types_list' => $this->Charges_types_model->get_all(),
                    // 'pic_list'=>$this->Charges_types_model->get_user_type('2'),
                ];
                $this->content = 'serviceCharges/read';
                ##--slave_combine_to_read--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ServiceCharges'));
            }
        } else {
            redirect('/');
        }
    }
}
;
/* End of file User.php */
/* Location: ./application/controllers/User.php */
