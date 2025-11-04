<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitall extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permitall_model');
        $this->load->model('permitvalid_model');
        $this->load->model('permitrenew_model');
        $this->load->model('permitpendingapproval_model');
        $this->load->model('permitpendingpayment_model');
        $this->load->model('permittep_model');
        $this->load->model('permit_model');

        $this->load->model('permittimelinedom_model');
        $this->load->model('adppermit_model');
        $this->load->model('evdppermit_model');
        $this->load->model('avppermit_model');
        $this->load->model('evppermit_model');
        $this->load->model('avpchecklist_model');
        $this->load->model('evpchecklist_model');
        $this->load->model('driver_model');
        $this->load->model('vehicle_model');
        $this->load->model('uploadfiles_model');
        $this->load->model('exambank_model');
        $this->load->model('examtaker_model');
        $this->load->model('examresult_model');
        $this->load->model('charges_types_model');

        $this->lang->load('permitall_lang', $this->session->userdata('language'));
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
                'controller' => 'permitall',
                'pagetitle' => 'My Permits',
            ];

            $this->content = 'permitall/permitall_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function receipt($permit_id){
    $id      = fixzy_decoder($permit_id);

    $companydetail = $this->permitall_model->get_company_by_permitid($id);
    $permitdetail = $this->permitall_model->get_read($id);

        $data           = [
         'companydetail' => $companydetail,
         'permitdetail' => $permitdetail,
        ];

    $vehicletype = [3,4,9,10,11,12,13];
    $drivertype = [1,2,5,6,7,8];

        if(in_array($permitdetail->permit_typeid, $vehicletype)){
        $vehicledetail = $this->vehicle_model->get_by_registrationid($permitdetail->permit_subject_identity);

if($permitdetail->permit_typeid== '3'){
        $chargestypesdetail = $this->charges_types_model->get_charges_types_evp();
}elseif($permitdetail->permit_typeid== '4'){
        $chargestypesdetail = $this->charges_types_model->get_charges_types($vehicledetail->vehicle_engine_capacity);
}else{
        $chargestypesdetail = $this->charges_types_model->get_charges_types_tep();
        //check escort
        $needescort = $this->permitall_model->get_needescort($permitdetail->permit_typeid,$id);
        if($needescort == 'y'){
        $chargesescortdetail = $this->charges_types_model->get_charges_types_escort();
        $data['chargesescortdetail'] = $chargesescortdetail;
        }

}


$data['vehicledetail'] = $vehicledetail;

        }else{
        $driverdetail = $this->driver_model->get_by_ic($permitdetail->permit_subject_identity);

        if($permitdetail->permit_typeid== '1' || $permitdetail->permit_typeid== '2'){
         $chargestypesdetail = $this->charges_types_model->get_charges_types_driverpermit();
        }else{
         $chargestypesdetail = $this->charges_types_model->get_charges_types_ffop();
        }


$data['driverdetail'] = $driverdetail;

        }
$data['chargestypesdetail'] = $chargestypesdetail;
        $this->load->view('permitall/receipt', $data);
    }

    public function adp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->adp_detail($id);
        $this->content = 'permitall/permitall_adp';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function evdp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->evdp_detail($id);
        $this->content = 'permitall/permitall_evdp';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function avp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->avp_detail($id);
        $this->content = 'permitall/permitall_avp';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function evp($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->evp_detail($id);
        $this->content = 'permitall/permitall_evp';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pbb($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->pbb_detail($id);
        $this->content = 'permitall/permitall_pbb';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function sh($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->sh_detail($id);
        $this->content = 'permitall/permitall_sh';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function vdgs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->vdgs_detail($id);
        $this->content = 'permitall/permitall_vdgs';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function cs($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->cs_detail($id);

        //print_r($data);exit;
        $this->content = 'permitall/permitall_cs';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function gpu($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->gpu_detail($id);
        $this->content = 'permitall/permitall_gpu';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function pca($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->pca_detail($id);
        $this->content = 'permitall/permitall_pca';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function wip($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data          = $this->wip_detail($id);
        $this->content = 'permitall/permitall_wip';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

     public function shins($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->shins_detail($id);
        $this->content = 'permitall/permitall_shins';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }

    public function cancellation($id)
    {

        if ($this->permission->showlist == true) {
            $permit_id = fixzy_decoder($id);
            $setting   = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $permit = $this->permitall_model->get_read($permit_id);
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permission' => $this->permission,
                'permit_id' => $id,
                'permit_bookingid' => $permit->permit_bookingid,
                'permit_type_name_permit_typeid' => $permit->permit_type_name_permit_typeid,
                'permit_condition_name_permit_condition' => $permit->permit_condition_name_permit_condition,
            ];

            $this->content = 'permitall/permitall_cancellation';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function cancellation_action()
    {

/*        if ($this->permission->cp_update == true) {*/

        $this->_cancellationrules();

        if ($this->form_validation->run() == false) {
            $this->cancellation($this->input->post('permit_id', true));
        } else {
            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $data        = [
                'permit_remark' => $this->input->post('remark', true),
                'permit_status' => 'permitcancellation',
                'permit_officialstatus' => 'canceled',
                'permit_updated_at' => $nowdatetime,
                'permit_lastchanged_by' => $userid,
            ];
            $data_timeline = [
                'permit_timeline_permitid' => $permitid,
                'permit_timeline_userid' => $userid,
                'permit_timeline_name' => CANCEL_PERMIT,
                'permit_timeline_desc' => CANCEL_PERMIT_DESC,
                'permit_timeline_status' => 'permitcancellation',
                'permit_timeline_officialstatus' => 'canceled',
                'permit_timeline_created_at' => $nowdatetime,
                'permit_timeline_lastchanged_by' => $userid,
            ];

//get permittype
$permittype = $this->permitall_model->get_permittype_by_id($permitid);
//get driver/vehicle id
$driver_vehicle_id = $this->permitall_model->get_driverorvehicle_id($permittype,$permitid);


            $this->db->trans_start();
            $this->permitall_model->update($permitid, $data);
            /* $this->logQueries($this->config->item('dblog')); */
            $this->permittimelinedom_model->insert($data_timeline);
            /* $this->logQueries($this->config->item('dblog')); */
//update driver/vehicle status
$this->permitall_model->update_driver_vehicle_status($permittype,$driver_vehicle_id, 8);
            $this->db->trans_complete();
            $subject = 'DIASS - Permit Cancellation (Booking ID ' . $bookingId . ')';
            $body    = '
Good day ' . $this->session->userdata('name') . ',
<br><br>
Your request for permit cancellation has been submitted and approved. Thank you.
<br><br>
Regards,<br>
-DIASS Administrator

 ';

            $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
            $this->email->to($this->session->userdata('email'));
            $this->email->subject($subject);
            $this->email->message($body);
            $this->email->send();
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitall'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function termination($id)
    {

        if ($this->permission->showlist == true) {
            $permit_id = fixzy_decoder($id);
            $setting   = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $permit = $this->permitall_model->get_read($permit_id);
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permission' => $this->permission,
                'permit_id' => $id,
                'permit_bookingid' => $permit->permit_bookingid,
                'permit_issuance_serialno' => $permit->permit_issuance_serialno,
                'permit_type_name_permit_typeid' => $permit->permit_type_name_permit_typeid,
                'permit_condition_name_permit_condition' => $permit->permit_condition_name_permit_condition,
            ];

            $this->content = 'permitall/permitall_termination';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function termination_action()
    {

/*        if ($this->permission->cp_update == true) {*/

        $this->_terminationrules();

        if ($this->form_validation->run() == false) {
            $this->termination($this->input->post('permit_id', true));
        } else {
            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $docs         = $this->input->post('permit_termination', true);

            $all_doc = explode(",", $docs);

            $data = [
                'permit_remark' => $this->input->post('remark', true),
                'permit_status' => 'permitterminationpending',
                'permit_officialstatus' => 'pending',
                'permit_updated_at' => $nowdatetime,
                'permit_lastchanged_by' => $userid,
            ];
            $data_timeline = [
                'permit_timeline_permitid' => $permitid,
                'permit_timeline_userid' => $userid,
                'permit_timeline_name' => TERMINATE_PERMIT,
                'permit_timeline_desc' => TERMINATE_PERMIT_DESC,
                'permit_timeline_status' => 'permitterminationpending',
                'permit_timeline_officialstatus' => 'pending',
                'permit_timeline_created_at' => $nowdatetime,
                'permit_timeline_lastchanged_by' => $userid,
            ];

            $this->db->trans_start();
            $this->permitall_model->update($permitid, $data);
            /* $this->logQueries($this->config->item('dblog')); */
            foreach ($all_doc as $doc) {
             $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $permitid]);
            }

            /* $this->logQueries($this->config->item('dblog')); */
            $this->permittimelinedom_model->insert($data_timeline);
            /* $this->logQueries($this->config->item('dblog')); */
            $this->db->trans_complete();
            $subject = 'DIASS - Permit Termination (Booking ID ' . $bookingId . ')';
            $body    = '
Good day ' . $this->session->userdata('name') . ',
<br><br>
Your request for permit termination has been submitted and pending for acceptance. Here are the detail:
<br><br>
Booking ID: ' . $bookingId . '
<br><br>
You will be notified within 3 working days. Thank you.
<br><br>
Regards,<br>
-DIASS Administrator


                ';

            $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
            $this->email->to($this->session->userdata('email'));
            $this->email->subject($subject);
            $this->email->message($body);
            //$this->email->send();
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitall'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function replacement($id)
    {

        if ($this->permission->showlist == true) {
            $permit_id = fixzy_decoder($id);
            $setting   = [
                'method' => 'newpage',
                'patern' => 'list',
            ];

            $permit = $this->permitall_model->get_read($permit_id);
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'permission' => $this->permission,
                'permit_id' => $id,
                'permit_bookingid' => $permit->permit_bookingid,
                'permit_issuance_serialno' => $permit->permit_issuance_serialno,
                'permit_type_name_permit_typeid' => $permit->permit_type_name_permit_typeid,
                'permit_condition_name_permit_condition' => $permit->permit_condition_name_permit_condition,
            ];

            $this->content = 'permitall/permitall_replacement';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function replacement_action()
    {

/*        if ($this->permission->cp_update == true) {*/

        $this->_replacementrules();

        if ($this->form_validation->run() == false) {
            $this->replacement($this->input->post('permit_id', true));
        } else {
            $permitid    = fixzy_decoder($this->input->post('permit_id', true));
            $nowdatetime = date('Y-m-d H:i:s');
            $userid      = $this->session->userdata('id');
            $docs         = $this->input->post('permit_replacement', true);

            $all_doc = explode(",", $docs);


            $data = [
                'permit_remark' => $this->input->post('remark', true),
                'permit_status' => 'permitreplacementpending',
                'permit_officialstatus' => 'pending',
                'permit_updated_at' => $nowdatetime,
                'permit_lastchanged_by' => $userid,
            ];
            $data_timeline = [
                'permit_timeline_permitid' => $permitid,
                'permit_timeline_userid' => $userid,
                'permit_timeline_name' => REPLACE_PERMIT,
                'permit_timeline_desc' => REPLACE_PERMIT_DESC,
                'permit_timeline_status' => 'permitreplacementpending',
                'permit_timeline_officialstatus' => 'pending',
                'permit_timeline_created_at' => $nowdatetime,
                'permit_timeline_lastchanged_by' => $userid,
            ];

            $this->db->trans_start();
            $this->permitall_model->update($permitid, $data);
            /* $this->logQueries($this->config->item('dblog')); */
            foreach ($all_doc as $doc) {
             $this->uploadfiles_model->update($doc, ['uploadfiles_permit_id' => $permitid]);
            }

            /* $this->logQueries($this->config->item('dblog')); */
            $this->permittimelinedom_model->insert($data_timeline);
            /* $this->logQueries($this->config->item('dblog')); */
            $this->db->trans_complete();

            $subject = 'DIASS - Permit Replacement (Booking ID ' . $bookingId . ')';
            $body    = '
Good day ' . $this->session->userdata('name') . ',
<br><br>
Your request for permit replacement has been submitted and pending for acceptance. Here are the detail:
<br><br>
Booking ID: ' . $bookingId . '
<br><br>
You will be notified within 3 working days. Thank you.
<br><br>
Regards,<br>
-DIASS Administrator


                ';

            $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
            $this->email->to($this->session->userdata('email'));
            $this->email->subject($subject);
            $this->email->message($body);
            $this->email->send();

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permitall'));
        }

/*        } else {
redirect('/');
}*/

    }

    public function _cancellationrules()
    {
        $this->form_validation->set_rules('remark', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the box', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _terminationrules()
    {
        $this->form_validation->set_rules('remark', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the box', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');
        $this->form_validation->set_rules('permit_termination', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function _replacementrules()
    {
        $this->form_validation->set_rules('remark', ' ', 'trim|required');
        $this->form_validation->set_rules('agree', 'Please tick the box', 'trim|required');
        $this->form_validation->set_rules('permit_id', ' ', 'trim|required');
        $this->form_validation->set_rules('permit_replacement', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json($controller)
    {
/*        echo '<pre>';
        print_r($this->input->get());
        echo '</pre>';
        echo $this->input->get('columns')[3]['search']['value'].'<----xxx';
        exit;*/
        $model   = $controller . '_model';
        $i       = $this->input->get('start');
        $columns = [
            'permit_id',
            'permit_groupid',
            'permit_type.permit_type_desc',
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
            'permit_remark',
            'permit_recent_permitid',
            'permit_created_at',
            'permit_location',
            'permit_subject_name',

        ];

        $columnfilter = [
          'bookingid' => $this->input->get('columns')[0]['search']['value'],
          'serialno' => $this->input->get('columns')[1]['search']['value'],
          'identity' => $this->input->get('columns')[2]['search']['value'],
          'permittype' => $this->input->get('columns')[3]['search']['value'],
          'status' => $this->input->get('columns')[4]['search']['value'],
          'appdate' => $this->input->get('columns')[5]['search']['value'],
          'opdate' => $this->input->get('columns')[6]['search']['value'],
          'exdate' => $this->input->get('columns')[7]['search']['value'],
          'location' => $this->input->get('columns')[9]['search']['value'],
          'identityname' => $this->input->get('columns')[8]['search']['value'],
        ];
        $results = $this->{$model}->listajax(
            $columns,
            $columnfilter,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value'],
            $columns[$this->input->get('order')[0]['column']],
            $this->input->get('order')[0]['dir']
        );
        $data = [];
        //var_dump($results);
        foreach ($results as $r) {
            $i++;
            $rud = "";
            $newcompany_id='';
    $vehicle_id='';
    $driver_id='';
    $reference_no='';
    $latestbooking_id='';
    //replaced function get_latest_bookingid to get_latest_bookingtypeid on 25 June 2021
    //due to terminate button not appear pic screen
    //$row = $this->permit_model->get_latest_bookingid($r['permit_subject_identity']);
    $row = $this->permit_model->get_latest_bookingtypeid($r['permit_subject_identity'],$r['permit_typeid']);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
        $latestbooking_id = $row->permit_bookingid;
    } 
            if ($this->permission->cp_read == true) {
if ($r['permit_type_name_permit_typeid'] == "AVP" || $r['permit_type_name_permit_typeid'] == "EVP" || $r['permit_type_name_permit_typeid'] == "ADP" || $r['permit_type_name_permit_typeid'] == "EVDP") {

    
    if ($r['permit_type_name_permit_typeid'] == "AVP" || $r['permit_type_name_permit_typeid'] == "EVP")
    {
        if ($r['permit_type_name_permit_typeid'] == "AVP"){
            $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
            $newcompany_id = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_company_id;
        }else if ($r['permit_type_name_permit_typeid'] == "EVP"){
            $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
            $newcompany_id = $this->vehicle_model->get_by_id($vehicle_id)->vehicle_company_id;
        }

        if ($r['permit_officialstatus_name_permit_officialstatus'] == "completed") 
        {
            if($r['permit_companyid'] == $newcompany_id)
            {
                $now = date('Y-m-d H:i:s');
                if($now < ($r['permit_issuance_expirydate']))
                {
                    if($latestbooking_id == $r['permit_bookingid'] || $latestbooking_id == '')
                    {
                    $rud .= anchor(site_url('permitall/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary"') . ' ' . anchor(site_url('permitall/replacement/' . fixzy_encoder($r['permit_id'])), 'Replace', 'class="btn btn-primary"') .
                ' ' . anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                    }
                    else{
                        $rud .= anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                    }
                }
                else{
                    $rud .= anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                }
            }
            else {
                $rud .= anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
            }
        } 
        else if ($r['permit_officialstatus_name_permit_officialstatus'] == "terminated")
        {

        }
        else if ($r['permit_officialstatus_name_permit_officialstatus'] == "rejected") {
            if($r['permit_companyid'] == $newcompany_id)
            {
                if($latestbooking_id == $r['permit_bookingid'] || $latestbooking_id == '')
                {
                $rud .= anchor(site_url('permitall/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary"');
                }
            }
        }
        else {
            if ($r['permit_officialstatus_name_permit_officialstatus'] != "canceled" && $r['permit_officialstatus_name_permit_officialstatus'] != "paid" && $r['permit_status'] != "permitterminationpending" && $r['permit_status'] != "permitreplacementpending" && $r['permit_status'] != "applicationrejected" && $r['permit_officialstatus_name_permit_officialstatus'] != "failed" && $r['permit_officialstatus_name_permit_officialstatus'] != "expired" && $r['permit_officialstatus_name_permit_officialstatus'] != "suspended") {
                $rud .= anchor(site_url('permitall/cancellation/' . fixzy_encoder($r['permit_id'])), 'Cancel', 'class="btn btn-primary"') .' ';
            }

        }
    }
    else  //ADP n EVDP
    {
        if ($r['permit_type_name_permit_typeid'] == "ADP"){
            //$driver_id = $this->adppermit_model->get_read_by_permitid_check($r['permit_id'])->adppermit_driver_id;
            $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
            $newcompany_id = $this->driver_model->get_verifydriver($driver_id)->driver_company_id;
        }else if ($r['permit_type_name_permit_typeid'] == "EVDP"){
            //$driver_id = $this->evdppermit_model->get_read_by_permitid_check($r['permit_id'])->evdppermit_driver_id;
            $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
            $newcompany_id = $this->driver_model->get_verifydriver($driver_id)->driver_company_id;
        }
        
        if ($r['permit_officialstatus_name_permit_officialstatus'] == "completed") 
        {
            if($r['permit_companyid'] == $newcompany_id)
            {
                $now = date('Y-m-d H:i:s');
                if($now < ($r['permit_issuance_expirydate']))
                {
                    if($latestbooking_id == $r['permit_bookingid'] || $latestbooking_id == '')
                    {
                    $rud .= anchor(site_url('permitall/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary"') . ' ' . anchor(site_url('permitall/replacement/' . fixzy_encoder($r['permit_id'])), 'Replace', 'class="btn btn-primary"') .
                ' ' . anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                    }
                    else{
                        $rud .= anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                    }
                }
                else{
                    $rud .= anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                }
            }
            else {
                $rud .= anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
            }
        } 
        else if ($r['permit_officialstatus_name_permit_officialstatus'] == "terminated")
        {

        }
        else if ($r['permit_officialstatus_name_permit_officialstatus'] == "rejected") {
            if($r['permit_companyid'] == $newcompany_id)
            {
                if($latestbooking_id == $r['permit_bookingid'] || $latestbooking_id == '')
                {
                $rud .= anchor(site_url('permitall/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary"');
                }
            }
        }
        else {
            if ($r['permit_officialstatus_name_permit_officialstatus'] != "canceled" && $r['permit_officialstatus_name_permit_officialstatus'] != "paid" && $r['permit_status'] != "permitterminationpending" && $r['permit_status'] != "permitreplacementpending" && $r['permit_status'] != "applicationrejected" && $r['permit_officialstatus_name_permit_officialstatus'] != "failed" && $r['permit_officialstatus_name_permit_officialstatus'] != "expired" && $r['permit_officialstatus_name_permit_officialstatus'] != "suspended") {
                $rud .= anchor(site_url('permitall/cancellation/' . fixzy_encoder($r['permit_id'])), 'Cancel', 'class="btn btn-primary"') .' ';
            }

        }
    }
}
else{
    if ($r['permit_officialstatus_name_permit_officialstatus'] == "completed") {
                    $rud .= anchor(site_url('permitall/termination/' . fixzy_encoder($r['permit_id'])), 'Terminate', 'class="btn btn-primary"') . ' ' . anchor(site_url('permitall/replacement/' . fixzy_encoder($r['permit_id'])), 'Replace', 'class="btn btn-primary"') .
' ' . anchor(site_url('permitall/receipt/' . fixzy_encoder($r['permit_id'])), 'Receipt', 'class="btn btn-default" target="_blank"');
                } 
                else {
                    if ($r['permit_officialstatus_name_permit_officialstatus'] != "canceled" && $r['permit_officialstatus_name_permit_officialstatus'] != "paid" && $r['permit_status'] != "permitterminationpending" && $r['permit_status'] != "permitreplacementpending" && $r['permit_status'] != "applicationrejected" && $r['permit_officialstatus_name_permit_officialstatus'] != "failed" && $r['permit_officialstatus_name_permit_officialstatus'] != "expired" && $r['permit_officialstatus_name_permit_officialstatus'] != "suspended") {
                        $rud .= anchor(site_url('permitall/cancellation/' . fixzy_encoder($r['permit_id'])), 'Cancel', 'class="btn btn-primary"') .
                            ' ';
                    }

                }
}
                

            }
            if ($r['permit_type_name_permit_typeid'] == "ADP") {
                $driver_id = $this->adppermit_model->get_read_by_permitid($r['permit_id'])->adppermit_driver_id;
                $val       = '<a href="/Driver/show/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "EVDP") {
                $driver_id = $this->evdppermit_model->get_read_by_permitid($r['permit_id'])->evdppermit_driver_id;
                $val       = '<a href="/Driver/show/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "AVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->avppermit_model->get_read_by_permitid($r['permit_id'])->avppermit_vehicle_id;
                $val        = '<a href="/Vehicle/show/' . fixzy_encoder($vehicle_id) . '">' . $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "EVP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->evppermit_model->get_read_by_permitid($r['permit_id'])->evppermit_vehicle_id;
                $val        = '<a href="/Vehicle/show/' . fixzy_encoder($vehicle_id) . '">' . $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "PBB") {
                $driver_id = $this->pbbpermit_model->get_read_by_permitid($r['permit_id'])->pbbpermit_driver_id;
                $val       = '<a href="/Driver/show/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "VDGS") {
                $driver_id = $this->vdgspermit_model->get_read_by_permitid($r['permit_id'])->vdgspermit_driver_id;
                $val       = '<a href="/Driver/show/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "CS") {
                $vehicle_id = $this->cspermit_model->get_read_by_permitid($r['permit_id'])->cspermit_vehicle_id;
                $val        = '<a href="/Vehicle/show/' . fixzy_encoder($vehicle_id) . '">' . $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "GPU") {
                $driver_id = $this->gpupermit_model->get_read_by_permitid($r['permit_id'])->gpupermit_driver_id;
                $val       = '<a href="/Driver/show/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "PCA") {
                $driver_id = $this->pcapermit_model->get_read_by_permitid($r['permit_id'])->pcapermit_driver_id;
                $val       = '<a href="/Driver/show/' . fixzy_encoder($driver_id) . '">' . $this->driver_model->get_by_id($driver_id)->driver_ic . '</a>';
            } elseif ($r['permit_type_name_permit_typeid'] == "WIP") {
                /*$val = 'NA';*/
                $vehicle_id = $this->wippermit_model->get_read_by_permitid($r['permit_id'])->wippermit_vehicle_id;
                $val        = '<a href="/Vehicle/show/' . fixzy_encoder($vehicle_id) . '">' . $this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no . '</a>';
            } elseif($r['permit_type_name_permit_typeid']=="SH"){
    /*$val = 'NA';*/
    $vehicle_id = $this->shpermit_model->get_read_by_permitid($r['permit_id'])->shpermit_vehicle_id;
    $val = '<a href="/Vehicle/show/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
} elseif($r['permit_type_name_permit_typeid']=="SHINS"){
    /*$val = 'NA';*/
    $vehicle_id = $this->shinspermit_model->get_read_by_permitid($r['permit_id'])->shinspermit_vehicle_id;
    $val = '<a href="/Vehicle/show/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
} elseif($r['permit_type_name_permit_typeid'] == "WIPBRIEFING"){
    $vehicle_id = $this->wipbriefingpermit_model->get_read_by_permitid($r['permit_id'])->wipbriefingpermit_vehicle_id;
    $val = '<a href="/Vehicle/show/' .fixzy_encoder($vehicle_id). '">'.$this->vehicle_model->get_by_id($vehicle_id)->vehicle_registration_no.'</a>';
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
                '<a href="/permitall/' . strtolower($r['permit_type_name_permit_typeid']) . '/' . fixzy_encoder($r['permit_id']) . '">' . $r['permit_bookingid'] . '</a>',
$r['permit_issuance_serialno'],
                $val,
                $r['permit_type_desc'],
                $officialstatus,
                datelocal($appdate[0]),
                datelocal($r['permit_course_date']),
                (!empty($r['permit_issuance_expirydate'])?datelocal($r['permit_issuance_expirydate']):''),
                $r['permit_subject_name'],
                $r['permit_location'],
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->{$model}->recordsTotal()->recordstotal,
                "recordsFiltered" => $this->{$model}->recordsFiltered($columns, $columnfilter, $this->input->get('search')['value'])->recordsfiltered,
                'data' => $data
            ]
        );
    }
    public function wipbriefing($id)
    {
        $setting = [
            'method' => 'newpage',
            'patern' => 'list',
        ];
        $data           = $this->wipbriefing_detail($id);
        $this->content = 'permitall/permitall_wipbriefing';

        ##--slave_combine_to_read--##
        $this->layout($data, $setting);

    }
}
;
/* End of file Permitall.php */
/* Location: ./application/controllers/Permitall.php */
