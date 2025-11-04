<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitpendingpayment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitpendingpayment_model');
        $this->load->model('permitall_model');
        $this->load->model('adppermit_model');
        $this->load->model('evdppermit_model');
        $this->load->model('driver_model');
        $this->load->model('permittimelinedom_model');
        $this->load->model('uploadfiles_model');
        $this->load->model('exambank_model');
        $this->load->model('examtaker_model');
        $this->load->model('examresult_model');
        $this->load->model('avppermit_model');
        $this->load->model('vehicle_model');
        $this->load->model('avpchecklist_model');
        $this->load->model('evppermit_model');
        $this->load->model('evpchecklist_model');
        $this->lang->load('permitpendingpayment_lang', $this->session->userdata('language'));
        $this->lang->load('adppermit_lang', $this->session->userdata('language'));
        $this->lang->load('evdppermit_lang', $this->session->userdata('language'));
        $this->lang->load('driver_lang', $this->session->userdata('language'));
        $this->lang->load('permittimeline_lang', $this->session->userdata('language'));
        $this->lang->load('uploadfiles_lang', $this->session->userdata('language'));
        $this->lang->load('vehicle_lang', $this->session->userdata('language'));
        $this->lang->load('avpchecklist_lang', $this->session->userdata('language'));
        $this->load->model('pbbpermit_model');
        $this->lang->load('pbbpermit_lang', $this->session->userdata('language'));
        $this->load->model('shpermit_model');
        $this->lang->load('shpermit_lang', $this->session->userdata('language'));
        $this->load->model('vdgspermit_model');
        $this->lang->load('vdgspermit_lang', $this->session->userdata('language'));
        $this->load->model('cspermit_model');
        $this->lang->load('cspermit_lang', $this->session->userdata('language'));
        $this->load->model('gpupermit_model');
        $this->lang->load('gpupermit_lang', $this->session->userdata('language'));
        $this->load->model('pcapermit_model');
        $this->lang->load('pcapermit_lang', $this->session->userdata('language'));
        $this->load->model('wippermit_model');
        $this->load->model('wipchecklist_model');
        $this->lang->load('wipchecklist_lang', $this->session->userdata('language'));
        $this->load->model('shinspermit_model');
        $this->load->model('shinschecklist_model');
        $this->lang->load('shinschecklist_lang', $this->session->userdata('language'));
        $this->load->model('wipbriefingpermit_model');
        $this->lang->load('wipbriefingpermit_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $data = [
                'permission' => $this->permission,
                'controller' => 'Permitpendingpayment',
                'pagetitle' => 'Payment Pending Permits',
            ];

            $this->content = 'permitall/permitall_list_process';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function adp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data = $this->adp_detail($id);

        $this->infopage = 'permitall/permitall_adp';
        $this->content  = 'permitpendingpayment/permitpendingpayment_adp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function evdp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->evdp_detail($id);

        $this->infopage = 'permitall/permitall_evdp';
        $this->content  = 'permitpendingpayment/permitpendingpayment_evdp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function avp($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->avp_detail($id);

        /*====
        =            MAL edit            =
        ====*/

        $data['capacity_name_txt']  = '';
        $data['capacity_price_txt'] = '0.00';
        $capacity_ID                = $data['vehicle_engine_capacity_id'];
        if (!empty($capacity_ID) && $capacity_ID > 0) {
            $q_find_price = $this->db;
            $q_find_price->where('isactive', '1');
            $q_find_price->where('category', 'vehicle');
            $q_find_price->where('ref_id', $capacity_ID);
            $q_find_price->from('charges_types');
            $r_price_det = $q_find_price->get()->row();

            if (isset($r_price_det->price)) {
                $data['capacity_name_txt']  = $r_price_det->name;
                $data['capacity_price_txt'] = $r_price_det->price;
            }
        }

        /*=====  End of MAL edit  ======*/

        $this->infopage = 'permitall/permitall_avp';
        $this->content  = 'permitpendingpayment/permitpendingpayment_avp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function evp($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->evp_detail($id);

        /*====
        =            MAL edit            =
        ====*/

        $data['capacity_name_txt']  = '';
        $data['capacity_price_txt'] = '24.00';
        // $capacity_ID = $data['vehicle_engine_capacity'];
        // if(!empty($capacity_ID) && $capacity_ID > 0)
        // {
        //     $q_find_price = $this->db;
        //     $q_find_price->where('isactive', '1');
        //     $q_find_price->where('category', 'vehicle');
        //     $q_find_price->where('ref_id',$capacity_ID);
        //     $q_find_price->from('charges_types');
        //     $r_price_det = $q_find_price->get()->row();

        //     if(isset($r_price_det->price))
        //     {
        //         $data['capacity_name_txt'] = $r_price_det->name;
        //         $data['capacity_price_txt'] = $r_price_det->price;
        //     }
        // }

        /*=====  End of MAL edit  ======*/

        $this->infopage = 'permitall/permitall_evp';
        $this->content  = 'permitpendingpayment/permitpendingpayment_evp_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function adp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_adprules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->adp($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('adp');
         $countpermit = $countpermit + 5;*/

/*
 * SEMENTARA KERANA NAK MASUKKAN ADP...161
*/
//check jika ADP000161 wujud. Jika Xwujud, jadikan serial no 161.
$adp161_exist = $this->permitall_model->adp161();
if($adp161_exist){
        $current_serialno = $this->permitall_model->get_lastserialno('adp');
        $countpermit = extractNumber($current_serialno);

        $issuance_serial_no = 'ADP' . sprintf('%06d', $countpermit + 1);

        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $receiptno = sprintf('%06d', $countreceiptno + 1);
}else{
    $issuance_serial_no = "ADP000161";
    $receiptno = "000233";
}



                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),
                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),
                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $payment_type                            = $this->input->post('payment_type');
                $data_permit['permit_payment_isOneYear'] = !empty($payment_type) ? $payment_type : '1';

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_adppermit = [
                    'adppermit_verifybymahb' => 'y',
/*                    'adppermit_verifybymahb_drivingarea' => $this->input->post('drivingarea', true),
'adppermit_verifybymahb_vehicleclass' => $this->input->post('vehicleclass', true),*/
                    'adppermit_approvedby_airside' => 'y',
                    'adppermit_updated_at' => $nowdatetime,
                    'adppermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_ADP,
                    'permit_timeline_desc' => READY_COLLECT_ADP,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->adppermit_model->update_by_permitid($permitid, $data_adppermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/adp/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function evdp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_evdprules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->evdp($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('evdp');
         $countpermit = $countpermit + 10;*/
        $current_serialno = $this->permitall_model->get_lastserialno('evdp');
        $countpermit = extractNumber($current_serialno);
        $issuance_serial_no = 'EVDP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),
                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),
                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_evdppermit = [
                    'evdppermit_approvedby_airside' => 'y',
                    'evdppermit_updated_at' => $nowdatetime,
                    'evdppermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_EVDP,
                    'permit_timeline_desc' => READY_COLLECT_EVDP,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->evdppermit_model->update_by_permitid($permitid, $data_evdppermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/evdp/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function avp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_avprules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->avp($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('avp');
         $countpermit = $countpermit + 10;*/

        $current_serialno = $this->permitall_model->get_lastserialno('avp');
        $countpermit = extractNumber($current_serialno);
        $issuance_serial_no = 'AVP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),
                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),
                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_AVP,
                    'permit_timeline_desc' => READY_COLLECT_AVP,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/avp/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function evp_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_evprules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->evp($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('evp');
         $countpermit = $countpermit + 10;*/

        $current_serialno = $this->permitall_model->get_lastserialno('evp');
        $countpermit = extractNumber($current_serialno);
        $issuance_serial_no = 'EVP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_EVP,
                    'permit_timeline_desc' => READY_COLLECT_EVP,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/evp/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _adprules($condition = 'new')
    {
/*        $this->form_validation->set_rules('drivingarea', ' ', 'trim|required');
$this->form_validation->set_rules('vehicleclass', ' ', 'trim|required');*/
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _evdprules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _avprules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            // $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _evprules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json($location='all')
    {

                $columnfilter = [
                    'company' => $this->input->get('columns')[0]['search']['value'],
                    'bookingid' => $this->input->get('columns')[1]['search']['value'],
                    'identity' => $this->input->get('columns')[2]['search']['value'],
                    'permittype' => $this->input->get('columns')[3]['search']['value'],
                    'status' => $this->input->get('columns')[4]['search']['value'],
                    'appdate' => $this->input->get('columns')[5]['search']['value'],
                    'exdate' => $this->input->get('columns')[6]['search']['value'],
                    'condition' => $this->input->get('columns')[8]['search']['value'],
                ];

        $i       = $this->input->get('start');
        $columns = [
            'permit_id',
            'permit_groupid',
            'permit_typeid',
            'permit_condition',
            'permit_bookingid',
            'permit_picid',
            'permit_companyid',
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
            'permit_officialstatus',
            'permit_payment_remark',
            'permit_recent_permitid',
            'permit_created_at',

        ];
        $results = $this->permitpendingpayment_model->listajax(
        $location,
            $columns,
            $columnfilter,
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
                $rud .= anchor(site_url('permitpendingpayment/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></button>') .
                ' ' /*. anchor_popup(site_url('permitprintout/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>') .
                ' '*/;
            }

            if ($r['permit_type_name_permit_typeid'] == "ADP") {
                $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVDP") {
                $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "AVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "EVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "PBB") {
                $driver_id = $this->pbbpermit_model->get_read_by_permitid($r['permit_id'])->pbbpermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "SH") {
                $vehicle_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "VDGS") {
                $driver_id = $this->vdgspermit_model->get_read_by_permitid($r['permit_id'])->vdgspermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "CS") {
                $vehicle_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "GPU") {
                $driver_id = $this->gpupermit_model->get_read_by_permitid($r['permit_id'])->gpupermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "PCA") {
                $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
                $val       = $this->driver_model->get_by_id($driver_id)->driver_ic;
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            } elseif ($r['permit_type_name_permit_typeid'] == "SHINS") {
                /*$val = 'NA';*/
                $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
                $val        = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no;
            }

            $appdate = explode(" ", $r['permit_created_at']);

            if ($r['permit_officialstatus_name_permit_officialstatus'] == 'completed') {
                $officialstatus = '<span class="label label-success">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'inprogress') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'pending') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'failed') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'pendingpayment') {
                $officialstatus = '<span class="label label-warning">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'rejected') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'suspended') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'canceled') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'terminated') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'expired') {
                $officialstatus = '<span class="label label-danger">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            } elseif ($r['permit_officialstatus_name_permit_officialstatus'] == 'paid') {
                $officialstatus = '<span class="label label-primary">' . $r['permit_officialstatus_name_permit_officialstatus'] . '</span>';
            }

            array_push($data, [
/*                $i, */
                $r['company_name_permit_companyid'],
                $r['permit_bookingid'],
                $val,
                $r['permit_type_desc'],
                $officialstatus,
                datelocal($appdate[0]),
                datelocal($r['permit_issuance_expirydate']),
                // Hidden column start [6]
                $r['permit_group_name_permit_groupid'], // Permit Type 7
                $r['permit_condition_name_permit_condition'], // Permit Condition 8
                $r['pic_fullname_permit_picid'], // PIC 9
                $r['user_name_permit_issuance_processedby'], // Processed By 10
                $r['permit_status_desc_permit_status'], // Current Step   11
                // Hidden column end
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->permitpendingpayment_model->recordsTotal($location)->recordstotal,
                "recordsFiltered" => $this->permitpendingpayment_model->recordsFiltered($location,$columns,$columnfilter, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }

    public function pbb($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->pbb_detail($id);

        $this->infopage = 'permitall/permitall_pbb';
        $this->content  = 'permitpendingpayment/permitpendingpayment_pbb_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pbb_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_pbbrules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->pbb($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('pbb');
        $countpermit = $countpermit + 10;*/
        $current_serialno = $this->permitall_model->get_lastserialno('pbb');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }
        $issuance_serial_no = 'FF' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_pbbpermit = [
                    'pbbpermit_approvedby_airside' => 'y',
                    'pbbpermit_updated_at' => $nowdatetime,
                    'pbbpermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_PBB,
                    'permit_timeline_desc' => READY_COLLECT_PBB,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->pbbpermit_model->update_by_permitid($permitid, $data_pbbpermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/pbb/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _pbbrules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function pca($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->pca_detail($id);

        $this->infopage = 'permitall/permitall_pca';
        $this->content  = 'permitpendingpayment/permitpendingpayment_pca_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pca_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_pcarules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->pca($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('pca');
         $countpermit = $countpermit + 10;*/
        $current_serialno = $this->permitall_model->get_lastserialno('pca');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }

        $issuance_serial_no = 'FF' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_pcapermit = [
                    'pcapermit_approvedby_airside' => 'y',
                    'pcapermit_updated_at' => $nowdatetime,
                    'pcapermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_PCA,
                    'permit_timeline_desc' => READY_COLLECT_PCA,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->pcapermit_model->update_by_permitid($permitid, $data_pcapermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/pca/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _pcarules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function gpu($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->gpu_detail($id);

        $this->infopage = 'permitall/permitall_gpu';
        $this->content  = 'permitpendingpayment/permitpendingpayment_gpu_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function gpu_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_gpurules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->gpu($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('gpu');
         $countpermit = $countpermit + 10;*/

        $current_serialno = $this->permitall_model->get_lastserialno('gpu');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }

        $issuance_serial_no = 'FF' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_gpupermit = [
                    'gpupermit_approvedby_airside' => 'y',
                    'gpupermit_updated_at' => $nowdatetime,
                    'gpupermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_GPU,
                    'permit_timeline_desc' => READY_COLLECT_GPU,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->gpupermit_model->update_by_permitid($permitid, $data_gpupermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/gpu/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _gpurules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function cs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->cs_detail($id);

        $this->infopage = 'permitall/permitall_cs';
        $this->content  = 'permitpendingpayment/permitpendingpayment_cs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function cs_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_csrules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->cs($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('cs');
         $countpermit = $countpermit + 10;*/

        $current_serialno = $this->permitall_model->get_lastserialno('cs');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }

        $issuance_serial_no = 'TEP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*=====  MAL EDIT  ======*/

                $selected_payment_method                = $this->input->post('payment_method');
                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_method']   = !empty($selected_payment_method) ? $selected_payment_method : '0';
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;
                $data_permit['permit_payment_needescort'] = $this->input->post('needescort_value', true);

                /*=====  End of MAL EDIT  ======*/

                $data_cspermit = [
                    'cspermit_approvedby_airside' => 'y',
                    'cspermit_updated_at' => $nowdatetime,
                    'cspermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_CS,
                    'permit_timeline_desc' => READY_COLLECT_CS,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->cspermit_model->update_by_permitid($permitid, $data_cspermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/cs/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _csrules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function vdgs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->vdgs_detail($id);

        $this->infopage = 'permitall/permitall_vdgs';
        $this->content  = 'permitpendingpayment/permitpendingpayment_vdgs_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function vdgs_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_vdgsrules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->vdgs($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('vdgs');
         $countpermit = $countpermit + 10;*/

        $current_serialno = $this->permitall_model->get_lastserialno('vdgs');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }

        $issuance_serial_no = 'FF' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_vdgspermit = [
                    'vdgspermit_approvedby_airside' => 'y',
                    'vdgspermit_updated_at' => $nowdatetime,
                    'vdgspermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_VDGS,
                    'permit_timeline_desc' => READY_COLLECT_VDGS,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->vdgspermit_model->update_by_permitid($permitid, $data_vdgspermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/vdgs/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _vdgsrules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function sh($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->sh_detail($id);

        $this->infopage = 'permitall/permitall_sh';
        $this->content  = 'permitpendingpayment/permitpendingpayment_sh_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function sh_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_shrules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->sh($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('sh');
         $countpermit = $countpermit + 10;*/
        $current_serialno = $this->permitall_model->get_lastserialno('sh');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }
        $dissuance_serial_no = 'TEP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $dissuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*=====  MAL EDIT  ======*/

                $selected_payment_method                = $this->input->post('payment_method');
                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_method']   = !empty($selected_payment_method) ? $selected_payment_method : '0';
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;
                $data_permit['permit_payment_needescort'] = $this->input->post('needescort_value', true);

                /*=====  End of MAL EDIT  ======*/

                $data_shpermit = [
                    'shpermit_approvedby_airside' => 'y',
                    'shpermit_updated_at' => $nowdatetime,
                    'shpermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_SH,
                    'permit_timeline_desc' => READY_COLLECT_SH,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->shpermit_model->update_by_permitid($permitid, $data_shpermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/sh/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _shrules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function wip($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->wip_detail($id);

        $this->infopage = 'permitall/permitall_wip';
        $this->content  = 'permitpendingpayment/permitpendingpayment_wip_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function wip_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_wiprules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->wip($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('wip');
         $countpermit = $countpermit + 10;*/
        $current_serialno = $this->permitall_model->get_lastserialno('wip');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }
        $issuance_serial_no = 'TEP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*=====  MAL EDIT  ======*/

                $selected_payment_method                = $this->input->post('payment_method');
                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_method']   = !empty($selected_payment_method) ? $selected_payment_method : '0';
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;
                $data_permit['permit_payment_needescort'] = $this->input->post('needescort_value', true);

                /*=====  End of MAL EDIT  ======*/

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_WIP,
                    'permit_timeline_desc' => READY_COLLECT_WIP,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/wip/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _wiprules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function shins($id)
    {

        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->shins_detail($id);

        $this->infopage = 'permitall/permitall_shins';
        $this->content  = 'permitpendingpayment/permitpendingpayment_shins_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);
    }

    public function shins_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_shinsrules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->shins($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('shins');
         $countpermit = $countpermit + 10;*/
        $current_serialno = $this->permitall_model->get_lastserialno('shins');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }

        $issuance_serial_no = 'TEP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*====
                =            MAL EDIT            =
                ====*/

                $selected_payment_method              = $this->input->post('payment_method');
                $data_permit['permit_payment_method'] = !empty($selected_payment_method) ? $selected_payment_method : '0';

                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;

                /*=====  End of MAL EDIT  ======*/

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_SHINS,
                    'permit_timeline_desc' => READY_COLLECT_SHINS,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/shins/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _shinsrules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function wipbriefing($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data                       = $this->wipbriefing_detail($id);

        $this->infopage = 'permitall/permitall_wipbriefing';
        $this->content  = 'permitpendingpayment/permitpendingpayment_wipbriefing_raw';
        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wipbriefing_submit()
    {

        if ($this->permission->cp_update == true) {

            $this->_wipbriefingrules($this->input->post('permit_condition', true));

            if ($this->form_validation->run() == false) {
                $this->wipbriefing($this->input->post('permit_id', true));
            } else {

                $permitid    = fixzy_decoder($this->input->post('permit_id', true));
                $nowdatetime = date('Y-m-d H:i:s');
                $userid      = $this->session->userdata('id');

/*        $countpermit                = $this->permitall_model->get_count_permit('wipbriefing');
         $countpermit = $countpermit + 10;*/
        $current_serialno = $this->permitall_model->get_lastserialno('wipbriefing');

        if(empty($current_serialno)){
        $countpermit = 10;
        }else{
        $countpermit = extractNumber($current_serialno);
        }

        $issuance_serial_no = 'TEP' . sprintf('%06d', $countpermit + 1);

        //$countreceiptno = $this->permitall_model->get_count_receiptno();
        $current_receiptno = $this->permitall_model->get_lastinvoiceno();
        $countreceiptno = extractNumber($current_receiptno);
        $receiptno = sprintf('%06d', $countreceiptno + 1);

                $data_permit = [
                    'permit_status' => 'paid',
                    'permit_officialstatus' => 'paid',
                    'permit_issuance_serialno' => $issuance_serial_no,
                    'permit_issuance_date' => $this->input->post('approvaldate', true),

                    'permit_issuance_startdate' => dateserver($this->input->post('startdate', true)),
                    'permit_issuance_expirydate' => dateserver($this->input->post('expirydate', true)),

                    'permit_issuance_processedby' => $userid,
                    'permit_payment_invoiceno' => $receiptno,
                    'permit_payment_trainingfee' => $this->input->post('fee_training', true),
                    'permit_payment_new' => $this->input->post('fee_new', true),
                    'permit_payment_statusPaidDate' => $nowdatetime,
                    'permit_payment_location' => $this->input->post('payment_location', true),
/*                        'permit_payment_renew_oneyear' => $this->input->post('fee_renew', true),
'permit_payment_renew_prorated' => $this->input->post('fee_renew', true),*/
                    'permit_payment_sst' => $this->input->post('inclusive_sst', true),
                    'permit_payment_total' => $this->input->post('fee_new', true),
                    'permit_payment_processedby' => $userid,
                    'permit_payment_remark' => $this->input->post('remark', true),
                    'permit_updated_at' => $nowdatetime,
                    'permit_lastchanged_by' => $userid,
                    'permit_company_permit' => $this->input->post('companyname_permit', true),
                    'permit_company_receipt' => $this->input->post('companyname_receipt', true),
                ];

                /*=====  MAL EDIT  ======*/

                $selected_payment_method                = $this->input->post('payment_method');
                $ref_cheque_no                          = $this->input->post('ref_cheque_no');
                $data_permit['permit_payment_method']   = !empty($selected_payment_method) ? $selected_payment_method : '0';
                $data_permit['permit_payment_ref_cheque'] = $ref_cheque_no;
                $data_permit['permit_payment_needescort'] = $this->input->post('needescort_value', true);

                /*=====  End of MAL EDIT  ======*/

                $data_wipbriefingpermit = [
                    'wipbriefingpermit_approvedby_airside' => 'y',
                    'wipbriefingpermit_updated_at' => $nowdatetime,
                    'wipbriefingpermit_lastchanged_by' => $userid,
                ];

                $data_timeline = [
                    'permit_timeline_permitid' => $permitid,
                    'permit_timeline_userid' => $userid,
                    'permit_timeline_name' => PAID_IN_FULL_WIPBRIEFING,
                    'permit_timeline_desc' => READY_COLLECT_WIPBRIEFING,
                    'permit_timeline_status' => 'paid',
                    'permit_timeline_officialstatus' => 'paid',
                    'permit_timeline_created_at' => $nowdatetime,
                    'permit_timeline_lastchanged_by' => $userid,
                    'permit_timeline_remark' => $this->input->post('remark', true)
                ];

                $this->db->trans_start();
                $this->permitpendingpayment_model->update($permitid, $data_permit);
                $this->wipbriefingpermit_model->update_by_permitid($permitid, $data_wipbriefingpermit);
                $this->permittimelinedom_model->insert($data_timeline);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    // generate an error... or use the log_message() function to log your error
                    echo 'error';
                } else {
                    /* $this->logQueries($this->config->item('dblog')); */

                    //$this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('permitcollect/wipbriefing/' . $this->input->post('permit_id', true)));
                }

            }

        } else {
            redirect('/');
        }

    }

    public function _wipbriefingrules($condition = 'new')
    {
        /* $this->form_validation->set_rules('serialno', ' ', 'trim|required'); */
        $this->form_validation->set_rules('startdate', ' ', 'trim|required');
        $this->form_validation->set_rules('expirydate', ' ', 'trim|required');
        /* $this->form_validation->set_rules('receiptno', ' ', 'trim|required'); */
        if ($condition == 'new') {
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        } else if ($condition == 'renew') {
            // $this->form_validation->set_rules('fee_renew', ' ', 'trim|required');
            $this->form_validation->set_rules('fee_new', ' ', 'trim|required');
        }
        $this->form_validation->set_rules('approvaldate', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick agree checkbox', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_rules('companyname_permit', ' ', 'trim|required');
        $this->form_validation->set_rules('companyname_receipt', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }
}
;
/* End of file Permitpendingpayment.php */
/* Location: ./application/controllers/Permitpendingpayment.php */
