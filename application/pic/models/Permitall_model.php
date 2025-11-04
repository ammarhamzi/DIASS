<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitall_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    (SELECT pic_fullname FROM pic WHERE pic_id = userlist.user_customid) AS pic_fullname_permit_picid,
    company.company_name AS company_name_permit_companyid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_name AS permit_status_desc_permit_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_officialstatus', false);
        $this->db->where('permit_deleted_at');
        $this->db->order_by('permit.permit_id', 'DESC');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        //$this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        //$this->db->join('pic', 'pic.pic_id = userlist.user_customid');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }
/* get permittype_id */
    public function get_permittype_by_id($permitid)
    {
        $this->db->select('permit.permit_typeid');
        $this->db->where('permit.permit_id', $permitid);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');

        $query = $this->db->get();
        $permit = $query->row();
        return $permit->permit_typeid;


    }
/* get driver/vehicle id */
    public function get_driverorvehicle_id($permittype, $permitid)
    {
if($permittype=="1"){
        $this->db->select('*');
        $this->db->where('adppermit.adppermit_permit_id', $permitid);
        $this->db->where('adppermit_deleted_at');
        $this->db->from('adppermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->adppermit_driver_id;

}elseif($permittype=="2"){
        $this->db->select('*');
        $this->db->where('evdppermit.evdppermit_permit_id', $permitid);
        $this->db->where('evdppermit_deleted_at');
        $this->db->from('evdppermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->evdppermit_driver_id;
}elseif($permittype=="3"){
        $this->db->select('*');
        $this->db->where('evppermit.evppermit_permit_id', $permitid);
        $this->db->where('evppermit_deleted_at');
        $this->db->from('evppermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->evppermit_vehicle_id;
}elseif($permittype=="4"){
        $this->db->select('*');
        $this->db->where('avppermit.avppermit_permit_id', $permitid);
        $this->db->where('avppermit_deleted_at');
        $this->db->from('avppermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->avppermit_vehicle_id;
}elseif($permittype=="5"){
        $this->db->select('*');
        $this->db->where('pbbpermit.pbbpermit_permit_id', $permitid);
        $this->db->where('pbbpermit_deleted_at');
        $this->db->from('pbbpermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->pbbpermit_driver_id;
}elseif($permittype=="6"){
        $this->db->select('*');
        $this->db->where('vdgspermit.vdgspermit_permit_id', $permitid);
        $this->db->where('vdgspermit_deleted_at');
        $this->db->from('vdgspermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->vdgspermit_driver_id;
}elseif($permittype=="7"){
        $this->db->select('*');
        $this->db->where('pcapermit.pcapermit_permit_id', $permitid);
        $this->db->where('pcapermit_deleted_at');
        $this->db->from('pcapermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->pcapermit_driver_id;
}elseif($permittype=="8"){
        $this->db->select('*');
        $this->db->where('gpupermit.gpupermit_permit_id', $permitid);
        $this->db->where('gpupermit_deleted_at');
        $this->db->from('gpupermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->gpupermit_driver_id;
}elseif($permittype=="9"){
        $this->db->select('*');
        $this->db->where('wippermit.wippermit_permit_id', $permitid);
        $this->db->where('wippermit_deleted_at');
        $this->db->from('wippermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->wippermit_vehicle_id;
}elseif($permittype=="10"){
        $this->db->select('*');
        $this->db->where('cspermit.cspermit_permit_id', $permitid);
        $this->db->where('cspermit_deleted_at');
        $this->db->from('cspermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->cspermit_vehicle_id;
}elseif($permittype=="11"){
        $this->db->select('*');
        $this->db->where('shpermit.shpermit_permit_id', $permitid);
        $this->db->where('shpermit_deleted_at');
        $this->db->from('shpermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->shpermit_vehicle_id;
}elseif($permittype=="12"){
        $this->db->select('*');
        $this->db->where('wipbriefpermit.wipbriefpermit_permit_id', $permitid);
        $this->db->where('wipbriefpermit_deleted_at');
        $this->db->from('wipbriefpermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->wipbriefpermit_vehicle_id;
}elseif($permittype=="13"){
        $this->db->select('*');
        $this->db->where('shinspermit.shinspermit_permit_id', $permitid);
        $this->db->where('shinspermit_deleted_at');
        $this->db->from('shinspermit');
        $query = $this->db->get();
        $permit = $query->row();
        return $permit->shinspermit_vehicle_id;
}

}

/* update driver or vehicle status */
    public function update_driver_vehicle_status($permittype, $driver_vehicle_id, $newstatus)
    {
    if($permittype == '1' || $permittype == '2' || $permittype == '5' || $permittype == '6' || $permittype == '7' || $permittype == '8'){
        $this->db->where('driver_id', $driver_vehicle_id);
        $this->db->update('driver', ['driver_activity_statusid' => $newstatus,'driver_lastchanged_by'=>$this->session->userdata('id'), 'driver_updated_at' =>date('Y-m-d H:i:s')]);
    }elseif($permittype == '3' || $permittype == '4' || $permittype == '9' || $permittype == '10' || $permittype == '11' || $permittype == '12' || $permittype == '13'){
        $this->db->where('vehicle_id', $driver_vehicle_id);
        $this->db->update('vehicle', ['vehicle_activity_statusid' => $newstatus,'vehicle_lastchanged_by'=>$this->session->userdata('id'), 'vehicle_updated_at' =>date('Y-m-d H:i:s')]);
    }

    }

    public function get_read($id)
    {
        $this->db->select("
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_type.permit_type_desc AS permit_type_desc,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_picid) AS pic_fullname_permit_picid,
    company.company_name AS company_name_permit_companyid,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_issuance_processedby) AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_name AS permit_status_desc_permit_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_officialstatus,
CASE permit_payment_method
    WHEN 1 THEN 'Cash'
    WHEN 2 THEN 'Cheque'
    WHEN 3 THEN 'Credit Facilities'
    WHEN 4 THEN 'Free of Charges'
    ELSE NULL
END as permit_paymentmethod
", false);
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        //$this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        //$this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

// insert data
    public function insert($data)
    {
        $this->db->insert('permit', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('permit_id', $id);
        $this->db->update('permit', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('permit_id', $id);
        $this->db->delete('permit');
    }

    public function get_all_permit_group()
    {
        $this->db->select('*');
        $this->db->order_by('permit_group_id', 'ASC');
        $this->db->from('permit_group');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_type()
    {
        $this->db->select('*');
        $this->db->order_by('permit_type_id', 'ASC');
        $this->db->from('permit_type');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_condition()
    {
        $this->db->select('*');
        $this->db->order_by('permit_condition_id', 'ASC');
        $this->db->from('permit_condition');
        return $query = $this->db->get()->result();
    }

    public function get_all_pic()
    {
        $this->db->select('*');
        $this->db->order_by('pic_id', 'ASC');
        $this->db->from('pic');
        return $query = $this->db->get()->result();
    }

    public function get_all_company()
    {
        $this->db->select('*');
        $this->db->order_by('company_id', 'ASC');
        $this->db->from('company');
        return $query = $this->db->get()->result();
    }

    public function get_company_by_permitid($id)
    {
        $this->db->select('company.*');
        $this->db->distinct();
        $this->db->from('company');
        $this->db->join('permit', 'permit.permit_companyid = company.company_id');
        $this->db->where('permit.permit_id', $id);
        return $query = $this->db->get()->row();
    }

    public function get_needescort($type, $permitid){

        if($type=='9'){
        $this->db->select('*');
        $this->db->where('wippermit_permit_id', $permitid);
        $this->db->where('wippermit_deleted_at');
        $this->db->from('wippermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->wippermit_needescort;
        } else {
            return false;
        }
    }elseif($type=='10'){
        $this->db->select('*');
        $this->db->where('cspermit_permit_id', $permitid);
        $this->db->where('cspermit_deleted_at');
        $this->db->from('cspermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->cspermit_needescort;
        } else {
            return false;
        }
    }elseif($type=='11'){
        $this->db->select('*');
        $this->db->where('shpermit_permit_id', $permitid);
        $this->db->where('shpermit_deleted_at');
        $this->db->from('shpermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->shpermit_needescort;
        } else {
            return false;
        }
    }elseif($type=='12'){
        $this->db->select('*');
        $this->db->where('wipbriefingpermit_permit_id', $permitid);
        $this->db->where('wipbriefingpermit_deleted_at');
        $this->db->from('wipbriefingpermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->wipbriefingpermit_needescort;
        } else {
            return false;
        }
    }elseif($type=='13'){
        $this->db->select('*');
        $this->db->where('shinspermit_permit_id', $permitid);
        $this->db->where('shinspermit_deleted_at');
        $this->db->from('shinspermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->shinspermit_needescort;
        } else {
            return false;
        }
    }


    }

    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->order_by('user_id', 'ASC');
        $this->db->from('userlist');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_status()
    {
        $this->db->select('*');
        $this->db->order_by('permit_status_name', 'ASC');
        $this->db->from('permit_status');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_officialstatus()
    {
        $this->db->select('*');
        $this->db->order_by('permit_officialstatus_id', 'ASC');
        $this->db->from('permit_officialstatus');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $columnfilter, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {

   //var_dump ($columnfilter);exit;
   //echo $columnfilter['bookingid'];exit;
/*     foreach ($columnfilter as $columnf) {
        echo $columnf['bookingid'];
     }; exit;*/
     $bookingid = str_replace(['^','$'],['',''],$columnfilter['bookingid']);
     $serialno = str_replace(['^','$'],['',''],$columnfilter['serialno']);
     $identity = str_replace(['^','$'],['',''],$columnfilter['identity']);
     $permittype = str_replace(['^','$'],['',''],$columnfilter['permittype']);
     $status = str_replace(['^','$'],['',''],$columnfilter['status']);
     $appdate = str_replace(['^','$'],['',''],$columnfilter['appdate']);
     $opdate = str_replace(['^','$'],['',''],$columnfilter['opdate']);
     $exdate = str_replace(['^','$'],['',''],$columnfilter['exdate']);
     $location = str_replace(['^','$'],['',''],$columnfilter['location']);
     $identityname = str_replace(['^','$'],['',''],$columnfilter['identityname']);

        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_type.permit_type_desc AS permit_type_desc,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    company.company_name AS company_name_permit_companyid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_name AS permit_status_desc_permit_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_officialstatus,
CASE permit_typeid
    WHEN 1 THEN (select adppermit_course_date from adppermit where adppermit_permit_id = permit_id)
    WHEN 2 THEN (select evdppermit_course_date from evdppermit where evdppermit_permit_id = permit_id)
    WHEN 6 THEN (select vdgspermit_course_date from vdgspermit where vdgspermit_permit_id = permit_id)
    WHEN 5 THEN (select pbbpermit_course_date from pbbpermit where pbbpermit_permit_id = permit_id)
    WHEN 7 THEN (select pcapermit_course_date from pcapermit where pcapermit_permit_id = permit_id)
    WHEN 8 THEN (select gpupermit_course_date from gpupermit where gpupermit_permit_id = permit_id)
    WHEN 4 THEN (select avppermit_inspection_date from avppermit where avppermit_permit_id = permit_id)
    WHEN 3 THEN (select evppermit_inspection_date from evppermit where evppermit_permit_id = permit_id)
    WHEN 9 THEN (select wippermit_inspection_date from wippermit where wippermit_permit_id = permit_id)
    ELSE NULL
END as permit_course_date
    ', false);
        $this->db->distinct();
        $this->db->where('permit_deleted_at');
        /*$this->db->where('permit_officialstatus', '1');*/
        $this->db->where('permit_companyid', $this->session->userdata('companyid'));
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left'); 
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');
         $this->db->order_by('permit.permit_created_at, permit.permit_updated_at', 'DESC');
        $this->db->group_start();

        foreach ($columns as $column) {

            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {

                 if($column == 'permit_created_at' || $column == 'permit_issuance_expirydate'){
                 $serverdate = dateserver($filter);
                 $this->db->or_where("CONVERT(VARCHAR, $column , 120) like", "%$serverdate%");
                 }else{
                   $this->db->or_where("$column like", "%$filter%");
                 }


            }

            $i++;
        }

        $this->db->group_end();
        /* individual filter */
        if(!empty($bookingid)){
        $this->db->where("permit_bookingid like", "%$bookingid%");
        }
        if(!empty($serialno)){
        $this->db->where("permit_issuance_serialno like", "%$serialno%");
        }
        if(!empty($identity)){
        $this->db->where("permit_subject_identity like", "%$identity%");
        }
        if(!empty($permittype)){
        $this->db->where("permit_type.permit_type_desc =", "$permittype");
        }
        if(!empty($status)){
        $this->db->where("permit_officialstatus =", "$status");
        }
        if(!empty($opdate)){
        $opdate_server = dateserver($opdate);
        $this->db->where("CONVERT(VARCHAR, permit_op_date , 120) like", "%$opdate_server%");
        }
        if(!empty($appdate)){
        $appdate_server = dateserver($appdate);
        $this->db->where("CONVERT(VARCHAR, permit_created_at , 120) like", "%$appdate_server%");
        }
        if(!empty($exdate)){
        $exdate_server = dateserver($exdate);
        $this->db->where("CONVERT(VARCHAR, permit_issuance_expirydate , 120) like", "%$exdate_server%");
        }
        if(!empty($location)){
        $this->db->where("permit_location like", "%$location");
        }
        if(!empty($identityname)){
        $this->db->where("permit_subject_name like", "%$identityname%");
        }
        //$this->db->where("permit_bookingid like", "%$opdate%");


        if ($sort != "") {
            $this->db->order_by($sort, $sorttype);
        } else {
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->distinct();
        /*$this->db->where('permit_officialstatus', '1');*/
        $this->db->where('permit_companyid', $this->session->userdata('companyid'));
        $this->db->where('permit_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $columnfilter, $filter = "")
    {

    $bookingid = str_replace(['^','$'],['',''],$columnfilter['bookingid']);
    $serialno = str_replace(['^','$'],['',''],$columnfilter['serialno']);
    $identity = str_replace(['^','$'],['',''],$columnfilter['identity']);
    $permittype = str_replace(['^','$'],['',''],$columnfilter['permittype']);
    $status = str_replace(['^','$'],['',''],$columnfilter['status']);
    $appdate = str_replace(['^','$'],['',''],$columnfilter['appdate']);
    $opdate = str_replace(['^','$'],['',''],$columnfilter['opdate']);
    $exdate = str_replace(['^','$'],['',''],$columnfilter['exdate']);
    $location = str_replace(['^','$'],['',''],$columnfilter['location']);
    $identityname = str_replace(['^','$'],['',''],$columnfilter['identityname']);

        $i = 0;
        $this->db->select('count(DISTINCT permit_id) as recordsfiltered', false);
        $this->db->distinct();
        $this->db->where('permit_deleted_at');
        /*$this->db->where('permit_officialstatus', '1');*/
        $this->db->where('permit_companyid', $this->session->userdata('companyid'));
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');
         //$this->db->order_by('permit.permit_created_at, permit.permit_updated_at', 'DESC');
        $this->db->group_start();

        foreach ($columns as $column) {

            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                 if($column == 'permit_created_at' || $column == 'permit_issuance_expirydate'){
                 $serverdate = dateserver($filter);
                 $this->db->or_where("CONVERT(VARCHAR, $column , 120) like", "%$serverdate%");
                 }else{
                   $this->db->or_where("$column like", "%$filter%");
                 }
            }

            $i++;
        }

        $this->db->group_end();

        /* individual filter */
        if(!empty($bookingid)){
        $this->db->where("permit_bookingid like", "%$bookingid%");
        }
        if(!empty($serialno)){
        $this->db->where("permit_issuance_serialno like", "%$serialno%");
        }
        if(!empty($identity)){
        $this->db->where("permit_subject_identity like", "%$identity%");
        }
        if(!empty($permittype)){
        $this->db->where("permit_type.permit_type_desc =", "$permittype");
        }
        if(!empty($status)){
        $this->db->where("permit_officialstatus =", "$status");
        }
        if(!empty($opdate)){
        $opdate_server = dateserver($opdate);
        $this->db->where("CONVERT(VARCHAR, permit_op_date , 120) like", "%$opdate_server%");
        }
        if(!empty($appdate)){
        $appdate_server = dateserver($appdate);
        $this->db->where("CONVERT(VARCHAR, permit_created_at , 120) like", "%$appdate_server%");
        }
        if(!empty($exdate)){
        $exdate_server = dateserver($exdate);
        $this->db->where("CONVERT(VARCHAR, permit_issuance_expirydate , 120) like", "%$exdate_server%");
        }
        if(!empty($location)){
        $this->db->where("permit_location like", "%$location");
        }
        if(!empty($identityname)){
        $this->db->where("permit_subject_name like", "%$identityname%");
        }

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function get_count_allpermit_bycompany($id)
    {
        $this->db->select('*');
        $this->db->where('permit.permit_companyid', $id);
        $this->db->where('permit.permit_officialstatus', 1);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');

        $query = $this->db->get();
        return $query->num_rows();

    }

}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
