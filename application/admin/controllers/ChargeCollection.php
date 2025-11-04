<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ChargeCollection extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Userlist_group_model');
        $this->load->model('Charges_types_model');
        $this->load->model('Service_charges_model');
        $this->lang->load('charge_collection_lang', $this->session->userdata('language'));
    }

    public function index()
    {
        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            //$data = $this->Service_charges_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */

            $single_date_get = $this->input->get('single_date');
            $single_date_txt = '';
            if (!empty($single_date_get)) {
                $single_date_txt = date('d-m-Y', strtotime($single_date_get));
            }

            $working_session = $this->input->get('shift');
            $payment_method_get = $this->input->get('payment_method');
            $payment_location_get = $this->input->get('payment_location');

            //shift session txt
            switch ($working_session) {
                case 1:
                    $working_session_txt = 'Evening (3pm-9pm)';
                    break;
                case 2:
                    $working_session_txt = 'Night (9pm-8am)';
                    break;
                case 3:
                    $working_session_txt = 'Morning (8am-3pm)';
                    break;
                case 4:
                    $working_session_txt = 'Overall Shift (3pm-3pm)';
                    break;
                default:
                    $working_session_txt = 'None';
                    break;
            }

            //payment location txt
            switch ($payment_location_get) {
                case 'KLIA':
                    $payment_location_txt = 'KLIA';
                    break;
                case 'KLIA2':
                    $payment_location_txt = 'KLIA2';
                    break;
                default:
                    $payment_location_txt = 'All';
                    break;
            }

            //payment_method txt
            switch ($payment_method_get) {
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
                    $payment_method_txt = 'Free of Charge';
                    break;
                default:
                    $payment_method_txt = 'All';
                    break;
            }

            /*----------  charge type list  ----------*/
            $charge_type_list = array();
            $charge_type_output = array();
            if (!empty($single_date_get)) {
                $charge_type_list = $this->Charges_types_model->charge_type_all();
                $adp_count = 0;
                $adp_evdp_count = 0;
                $ff_count = 0;
                $evp_count = 0;
                foreach ($charge_type_list as $ctl) {
                    $kod = $ctl['kod'];
                    switch ($kod) {
                        case '5301':
                        case '5302':
                        case '5303':
                        case '5304':
                        case '5305':
                        case '5306':
                        case '5307':
                        case '5308':
                        case '5309':
                        case '5310':
                        case '5311':
                        case '5312':
                        case '5313':
                            //for AVP
                            $payment = $this->Charges_types_model->total_avp_price_per_date($single_date_get, $kod, $payment_method_get, $working_session, $payment_location_get);
                            $avp_count = $this->Charges_types_model->total_avp_qty_price_per_date($single_date_get, $kod, $payment_method_get, $working_session, $payment_location_get);
                            if ($payment > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $avp_count,
                                        "total_price" => $payment,
                                    )
                                );
                            }

                            break;
                        case '5314':
                            //TEP
                            // $charge_type_output[] = array_merge(
                            //             $ctl,
                            //             array(
                            //                 "total_qty"=>'1',
                            //                 "total_price"=>'00',
                            //             )
                            //         );
                            break;
                        case '5315':
                            // not sure
                            // $charge_type_output[] = array_merge(
                            //             $ctl,
                            //             array(
                            //                 "total_qty"=>'1',
                            //                 "total_price"=>'00',
                            //             )
                            //         );
                            break;
                        case '5351':
                            //ADP & EVDP
                            $payment = $this->Charges_types_model->total_payment_by_type_per_date($single_date_get, array(1, 2), $payment_method_get, $working_session, $payment_location_get);
                            $adp_evdp_count = $this->Charges_types_model->total_qty_by_type_per_date($single_date_get, array(1, 2), $payment_method_get, $working_session, $payment_location_get);
                            if ($payment > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $adp_evdp_count,
                                        "total_price" => $payment,
                                    )
                                );
                            }
                            break;
                        case '5352':
                            //TEP
                            // $payment = $this->Charges_types_model->total_payment_by_type_per_date($single_date_get,array(9,10,11,12,13),$payment_method_get,$working_session,$payment_location_get);
                            $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get, 17, $payment_method_get, $working_session, $payment_location_get);
                            if ($qty > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $qty,
                                        "total_price" => $qty * 25,
                                    )
                                );
                            }
                            break;
                        case '5354':
                            //fixed facilities (PBB, VDGS, PCA, PWS & 400Hz GPU)
                            $payment = $this->Charges_types_model->total_payment_by_type_per_date($single_date_get, array(5, 6, 7, 8), $payment_method_get, $working_session, $payment_location_get);
                            $ff_count = $this->Charges_types_model->total_qty_by_type_per_date($single_date_get, array(5, 6, 7, 8), $payment_method_get, $working_session, $payment_location_get);
                            if ($payment > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $ff_count,
                                        "total_price" => $payment,
                                    )
                                );
                            }
                            break;
                        case '5357':
                            //EVP
                            $payment = $this->Charges_types_model->total_payment_by_type_per_date($single_date_get, array(3), $payment_method_get, $working_session, $payment_location_get);
                            $evp_count = $this->Charges_types_model->total_qty_by_type_per_date($single_date_get, array(3), $payment_method_get, $working_session, $payment_location_get);
                            if ($payment > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $evp_count,
                                        "total_price" => $payment,
                                    )
                                );
                            }
                            break;
                        case '5358':
                            //ADP (pro-rated)
                            $payment = $this->Charges_types_model->total_payment_by_type1_per_date($single_date_get, 1, $payment_method_get, $working_session, 1, $payment_location_get);
                            if ($payment > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => '1',
                                        "total_price" => $payment,
                                    )
                                );
                            }
                            break;
                        case '5359':
                            //ALL
                            // $charge_type_output[] = array_merge(
                            //             $ctl,
                            //             array(
                            //                 "total_qty"=>'1',
                            //                 "total_price"=>'00',
                            //             )
                            //         );
                            break;
                        case '5253':
                            //airside service charges
                            $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get, 22, $payment_method_get, $working_session, $payment_location_get);
                            $real_qty = $this->Service_charges_model->category_qty_per_date($single_date_get, 22, $payment_method_get, $working_session, $payment_location_get);
                            if ($real_qty > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $real_qty,
                                        "total_price" => $qty * 700,
                                    )
                                );
                            }
                            break;
                        case '5367':
                            //airside service charges
                            $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get, 23, $payment_method_get, $working_session, $payment_location_get);
                            $real_qty = $this->Service_charges_model->category_qty_per_date($single_date_get, 23, $payment_method_get, $working_session, $payment_location_get);
                            if ($real_qty > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $real_qty,
                                        "total_price" => $qty * 400,
                                    )
                                );
                            }
                            break;
                        case '7510':
                            //airside service charges
                            $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get, 24, $payment_method_get, $working_session, $payment_location_get);
                            $real_qty = $this->Service_charges_model->category_qty_per_date($single_date_get, 24, $payment_method_get, $working_session, $payment_location_get);
                            if ($real_qty > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $real_qty,
                                        "total_price" => $qty * 125,
                                    )
                                );
                            }
                            break;
                        case '5410':
                            //airside service charges
                            $qty = $this->Service_charges_model->category_charges_price_per_date($single_date_get, 25, $payment_method_get, $working_session, $payment_location_get);
                            $real_qty = $this->Service_charges_model->category_qty_per_date($single_date_get, 25, $payment_method_get, $working_session, $payment_location_get);
                            if ($real_qty > 0) {
                                $charge_type_output[] = array_merge(
                                    $ctl,
                                    array(
                                        "total_qty" => $real_qty,
                                        "total_price" => $qty * 1000,
                                    )
                                );
                            }
                            break;
                        default:
                            break;
                    }
                }
            }

            // printr($charge_type_output);
            // die();

            // $qty_filming = $this->Service_charges_model->category_charges_price_per_date($single_date_get,3,$payment_method_get,$working_session);
            // $qty_shuttlebasservice = $this->Service_charges_model->category_charges_price_per_date($single_date_get,4,$payment_method_get,$working_session);
            // $qty_runawaysweeper = $this->Service_charges_model->category_charges_price_per_date($single_date_get,2,$payment_method_get,$working_session);
            // $qty_airsidefollowme = $this->Service_charges_model->category_charges_price_per_date($single_date_get,1,$payment_method_get,$working_session);

            $data = [
                //'serviceCharges_data' => $data,
                'submit' => $this->input->get('submit'),
                'permission' => $this->permission,
                'single_date_txt' => $single_date_txt,
                'payment_method_txt' => $payment_method_txt,
                'working_session_txt' => $working_session_txt,
                'payment_method_id' => $payment_method_get,
                'payment_location' => $payment_location_get,
                'payment_location_txt' => $payment_location_txt,
                'working_session' => $working_session,
                // 'qty_filming'=> $qty_filming,
                // 'total_filming' => $qty_filming*700,
                // 'qty_shuttlebasservice'=> $qty_shuttlebasservice,
                // 'total_shuttlebasservice' => $qty_shuttlebasservice*400,
                // 'qty_runawaysweeper'=> $qty_runawaysweeper,
                // 'total_runawaysweeper' => $qty_runawaysweeper*125,
                // 'qty_airsidefollowme'=> $qty_airsidefollowme,
                // 'total_airsidefollowme' => $qty_airsidefollowme*1000,
                'charge_type_list' => $charge_type_list,
                'charge_type_output' => $charge_type_output,
            ];
            $this->content = 'chargeCollection/list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);
        } else {
            redirect('/');
        }

    }

    public function read($id)
    {

        if ($this->permission->cp_read == true) {

            $id = fixzy_decoder($id);
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
                if (!empty($raw_datetime)) {
                    $txt_date = date('d/m/Y', strtotime($raw_datetime));
                    $txt_time = date('H:i:s', strtotime($raw_datetime));
                }

                //current file list name
                $file_list_raw = $row->servicecharges_files;
                $file_list_arr = explode(',', $file_list_raw);
                $file_arr = array();
                if (!empty($file_list_raw) && count($file_list_arr) > 0) {
                    foreach ($file_list_arr as $fla) {
                        $file_arr[] = '<a href="' . base_url('resources/shared_file/' . $fla) . '" target="_blank">' . $fla . '</a>';
                    }
                }
                $file_list_html = '';
                if (count($file_arr) > 0) {
                    $file_list_html = '<ol>
                                        <li>' . implode('</li><li>', $file_arr) . '</li>
                                    </ol>';
                }

                $data = [
                    'id' => $id,
                    'ct_ids' => set_value('ct_ids', $row->servicecharges_ct_id),
                    'qty' => set_value('qty', $row->servicecharges_qty),
                    'flight_number' => set_value('flight_number', $row->servicecharges_flightNumber),
                    'reason' => set_value('reason', $row->servicecharges_reason),
                    'notes' => set_value('notes', $row->servicecharges_note),
                    'uploads' => set_value('uploads'),
                    'file_list_html' => $file_list_html,
                    'approval_choice' => set_value('approval_choice'),
                    'remarks_approval' => set_value('remarks_approval'),
                    'pic_id' => set_value('pic_id'),
                    'pic_name' => set_value('pic_name', $row->servicecharges_picname),
                    'requestor_txt' => set_value('requestor_txt', $row->servicecharges_requestor),
                    'req_phoneNo' => set_value('req_phoneNo', $row->servicecharges_requestorphone),
                    'req_email' => set_value('req_email', $row->servicecharges_requestoremail),
                    'date_field' => set_value('date_field', $txt_date),
                    'time_field' => set_value('time_field', $txt_time),
                    'pic_address' => set_value('pic_address', $row->servicecharges_picadrs),
                    'pic_phoneNo' => set_value('pic_phoneNo', $row->servicecharges_picphone),
                    'pic_email' => set_value('pic_email', $row->servicecharges_picemail),

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
                'date_field' => set_value('date_field'),
                'time_field' => set_value('time_field'),
                'pic_address' => set_value('pic_address'),
                'pic_phoneNo' => set_value('pic_phoneNo'),
                'pic_email' => set_value('pic_email'),

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
                $req_datetime = date('Y-m-d H:i:s', strtotime($req_date . ' ' . $req_time));

                //upload file list
                $txt_file = '';
                $file_json = $this->input->post('file_arr');
                if (isset($file_json) && !empty($file_json)) {
                    $txt_arr = array();
                    $file_arr = json_decode($file_json, true);
                    if (count($file_arr) > 1) {
                        foreach ($file_arr as $fa) {
                            $txt_arr[] = $fa['file_name'];
                        }
                    }

                    echo $txt_file = implode(',', $txt_arr);
                }

                $data = [
                    'servicecharges_ct_id' => $this->input->post('ct_ids', true),
                    'servicecharges_qty' => ($this->input->post('qty', true)),
                    'servicecharges_flightNumber' => $this->input->post('flight_number', true),
                    'servicecharges_reason' => $this->input->post('reason', true),
                    'servicecharges_note' => $this->input->post('notes', true),
                    'servicecharges_requestor' => $this->input->post('requestor_txt', true),
                    'servicecharges_requestordatetime' => $req_datetime,
                    'servicecharges_requestorphone' => $this->input->post('req_phoneNo', true),
                    'servicecharges_requestoremail' => $this->input->post('req_email', true),
                    'servicecharges_picname' => $this->input->post('pic_name', true),
                    'servicecharges_picadrs' => $this->input->post('pic_address', true),
                    'servicecharges_picphone' => $this->input->post('pic_phoneNo', true),
                    'servicecharges_picemail' => $this->input->post('pic_email', true),
                    'servicecharges_files' => $txt_file,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->id,
                    'active' => 1,
                ];
                $this->Service_charges_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('ServiceCharges'));
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
                if (!empty($raw_datetime)) {
                    $txt_date = date('d/m/Y', strtotime($raw_datetime));
                    $txt_time = date('H:i:s', strtotime($raw_datetime));
                }

                //current file list name
                $file_list_raw = $row->servicecharges_files;
                $file_list_arr = explode(',', $file_list_raw);
                $file_arr = array();
                if (!empty($file_list_raw) && count($file_list_arr) > 0) {
                    foreach ($file_list_arr as $fla) {
                        $file_arr[] = '<a href="' . base_url('resources/shared_file/' . $fla) . '" target="_blank">' . $fla . '</a>';
                    }
                }
                $file_list_html = '';
                if (count($file_arr) > 0) {
                    $file_list_html = '<ol>
                                        <li>' . implode('</li><li>', $file_arr) . '</li>
                                    </ol>';
                }

                $data = [
                    'button' => 'Update',
                    'action' => site_url('ServiceCharges/update_action'),
                    'id' => $id,
                    'ct_ids' => set_value('ct_ids', $row->servicecharges_ct_id),
                    'qty' => set_value('qty', $row->servicecharges_qty),
                    'flight_number' => set_value('flight_number', $row->servicecharges_flightNumber),
                    'reason' => set_value('reason', $row->servicecharges_reason),
                    'notes' => set_value('notes', $row->servicecharges_note),
                    'uploads' => set_value('uploads'),
                    'file_list_html' => $file_list_html,
                    'approval_choice' => set_value('approval_choice'),
                    'remarks_approval' => set_value('remarks_approval'),
                    'pic_id' => set_value('pic_id'),
                    'pic_name' => set_value('pic_name', $row->servicecharges_picname),
                    'requestor_txt' => set_value('requestor_txt', $row->servicecharges_requestor),
                    'req_phoneNo' => set_value('req_phoneNo', $row->servicecharges_requestorphone),
                    'req_email' => set_value('req_email', $row->servicecharges_requestoremail),
                    'date_field' => set_value('date_field', $txt_date),
                    'time_field' => set_value('time_field', $txt_time),
                    'pic_address' => set_value('pic_address', $row->servicecharges_picadrs),
                    'pic_phoneNo' => set_value('pic_phoneNo', $row->servicecharges_picphone),
                    'pic_email' => set_value('pic_email', $row->servicecharges_picemail),

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
                $req_datetime = date('Y-m-d H:i:s', strtotime($req_date . ' ' . $req_time));

                $data = [
                    'servicecharges_ct_id' => $this->input->post('ct_ids', true),
                    'servicecharges_qty' => ($this->input->post('qty', true)),
                    'servicecharges_flightNumber' => $this->input->post('flight_number', true),
                    'servicecharges_reason' => $this->input->post('reason', true),
                    'servicecharges_note' => $this->input->post('notes', true),
                    'servicecharges_requestor' => $this->input->post('requestor_txt', true),
                    'servicecharges_requestordatetime' => $req_datetime,
                    'servicecharges_requestorphone' => $this->input->post('req_phoneNo', true),
                    'servicecharges_requestoremail' => $this->input->post('req_email', true),
                    'servicecharges_picname' => $this->input->post('pic_name', true),
                    'servicecharges_picadrs' => $this->input->post('pic_address', true),
                    'servicecharges_picphone' => $this->input->post('pic_phoneNo', true),
                    'servicecharges_picemail' => $this->input->post('pic_email', true),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->id,
                ];

                //upload file list
                $txt_file = '';
                $file_json = $this->input->post('file_arr');
                if (isset($file_json) && !empty($file_json)) {
                    $txt_arr = array();
                    $file_arr = json_decode($file_json, true);
                    if (count($file_arr) > 1) {
                        $txt_arr[] = $file_arr['file_name'];
                    }

                    $txt_file = implode(',', $txt_arr);
                }

                if (!empty($txt_file)) {
                    $data['servicecharges_files'] = $txt_file;
                }

                $this->Service_charges_model->update(fixzy_decoder($this->input->post('sc_id')), $data);
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

            $id = fixzy_decoder($id);
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
        $this->form_validation->set_rules('notes', ' ', 'trim|required');
        $this->form_validation->set_rules('requestor_txt', ' ', 'trim|required');
        $this->form_validation->set_rules('req_phoneNo', ' ', 'trim|required');
        $this->form_validation->set_rules('req_email', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_name', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_address', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_phoneNo', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_email', ' ', 'trim|required');

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
}
;
/* End of file User.php */
/* Location: ./application/controllers/User.php */
