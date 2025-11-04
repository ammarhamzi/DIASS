<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permit_model extends CI_Model
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
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_deleted_at');
        $this->db->order_by('permit.permit_id', 'DESC');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
    
    // get data by id
    public function get_latest_bookingid($id)
    {
        $this->db->select('*');
        $this->db->where('permit_subject_identity', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->order_by('permit_created_at', 'DESC');
        $this->db->limit(1, 0);

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    // this function added on 25 June 2021 to substitute function get_latest_bookingid  
    // get data by id and type
    public function get_latest_bookingtypeid($id,$type)
    {
        $this->db->select('*');
        $this->db->where('permit_subject_identity', $id);
        $this->db->where('permit_typeid', $type);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->order_by('permit_created_at', 'DESC');
        $this->db->limit(1, 0);

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_by_companyid($id)
    {
        $this->db->select('*');
        $this->db->where('permit.permit_companyid', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function getfull_by_companyid($id,$limit='')
    {
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_type.permit_type_desc AS permit_type_desc,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name', false);
    $this->db->distinct();
        $this->db->where('permit.permit_companyid', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');
        if($limit != ''){
         $this->db->limit($limit);
        }
        $this->db->order_by('permit.permit_created_at, permit.permit_updated_at', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_read($id)
    {
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i  = 0;
        $id = $this->session->userdata('companyid');
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit.permit_companyid', $id);
        $this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

        $this->db->group_start();
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }

            $i++;
        }
        $this->db->group_end();
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

        $this->db->where('permit_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');

        $this->db->where('permit_deleted_at');
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }
            $i++;
        }
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function get_count_allpermit_bycompany($id)
    {
        $this->db->select('*');
        $this->db->where('permit.permit_companyid', $id);
        $this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');

        $query = $this->db->get();
        return $query->num_rows();

    }

    public function get_verifydriver($permittype, $subjectid){

        if($permittype == '1'){
        $permit = 'adppermit';

        }elseif($permittype == '2'){
        $permit = 'evdppermit';
        }elseif($permittype == '5'){
        $permit = 'pbbpermit';
        }elseif($permittype == '6'){
        $permit = 'vdgspermit';
        }elseif($permittype == '7'){
        $permit = 'pcapermit';
        }elseif($permittype == '8'){
        $permit = 'gpupermit';
        }

           //check permit_exist
            $this->db->select('*');
            $this->db->where($permit.'.' .$permit. '_driver_id', $subjectid);
            $this->db->where($permit.'_deleted_at');
            $this->db->from($permit);
            $this->db->order_by($permit.'.' .$permit. '_id', 'DESC');
            $this->db->limit(1, 0);
            $query = $this->db->get();
            $exist = $query->num_rows();

        if($exist == 0){
        return 1;
        }else{
         // check status of existed permit
         $column_permit_id = $permit.'_permit_id';
         $permitid = $query->row()->{$column_permit_id};

        $this->db->select('*');
        $this->db->where('permit.permit_id', $permitid);
        $this->db->where('permit.permit_typeid', $permittype);
        //$this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
            $this->db->order_by('permit.permit_id', 'DESC');
            $this->db->limit(1, 0);
        $query = $this->db->get();
        $queryResult = $query->row();
        $expirydate = $queryResult->permit_issuance_expirydate;
        $officialstatus = $queryResult->permit_officialstatus;
        $detailstatus = $queryResult->permit_status;

        if($officialstatus== 'pending'){
            if($detailstatus == 'permitterminationpending')
                return -1; //terminate
            else
                return 5;
        }elseif($officialstatus == 'inprogress'){
          return 5;
        }elseif($officialstatus == 'pendingpayment'){
          return 5;
        }elseif($officialstatus == 'paid'){
          return 5;
        }elseif($officialstatus == 'completed'){
            return $this->permit_model->check_for_renewal($permitid, $permittype,$expirydate);
          //return 6;
        }elseif($officialstatus == 'expired'){
         return 4;
        }elseif($officialstatus == 'rejected'){
          return 9;
        }elseif($officialstatus == 'suspended'){
          return 3;
        }elseif($officialstatus == 'canceled'){
          return 8;
        }elseif($officialstatus == 'terminated'){
          return 10;
        }elseif($officialstatus == 'failed'){
          return 1;
        }elseif($officialstatus == 'replaced'){
          return 5;
        }
        }

    }
    
    public function get_verifyvehicle($permittype, $subjectid){
        if($permittype == '3'){
        $permit = 'evppermit';

        }elseif($permittype == '4'){
        $permit = 'avppermit';
        }elseif($permittype == '9'){
        $permit = 'wippermit';
        }elseif($permittype == '10'){
        $permit = 'cspermit';
        }elseif($permittype == '11'){
        $permit = 'shpermit';
        }elseif($permittype == '12'){
        $permit = 'wipbriefingpermit';
        }elseif($permittype == '13'){
        $permit = 'shinspermit';
        }

           //check permit_exist
            $this->db->select('*');
            $this->db->where($permit.'.' .$permit. '_vehicle_id', $subjectid);
            $this->db->where($permit.'_deleted_at');
            $this->db->from($permit);
            $this->db->order_by($permit.'.' .$permit. '_id', 'DESC');
            $this->db->limit(1, 0);
            $query = $this->db->get();
            $exist = $query->num_rows();

        if($exist == 0){
        return 1;
        }else{
         // check status of existed permit
         $column_permit_id = $permit.'_permit_id';
         $permitid = $query->row()->{$column_permit_id};

        $this->db->select('*');
        $this->db->where('permit.permit_id', $permitid);
        $this->db->where('permit.permit_typeid', $permittype);
        //$this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
            $this->db->order_by('permit.permit_id', 'DESC');
            $this->db->limit(1, 0);
        $query = $this->db->get();
        $queryResult = $query->row();
        $officialstatus = $queryResult->permit_officialstatus;
$expirydate = $queryResult->permit_issuance_expirydate;
        if($officialstatus== 'pending'){
          return 5;
        }elseif($officialstatus == 'inprogress'){
          return 5;
        }elseif($officialstatus == 'pendingpayment'){
          return 5;
        }elseif($officialstatus == 'paid'){
          return 5;
        }elseif($officialstatus == 'completed'){
          //return 6;
            return $this->permit_model->check_for_renewal($permitid, $permittype,$expirydate);
        }elseif($officialstatus == 'expired'){
         return 4;
        }elseif($officialstatus == 'rejected'){
          return 9;
        }elseif($officialstatus == 'suspended'){
          return 3;
        }elseif($officialstatus == 'canceled'){
          return 8;
        }elseif($officialstatus == 'terminated'){
          return 10;
        }elseif($officialstatus == 'failed'){
          return 1;
        }elseif($officialstatus == 'replaced'){
          return 5;
        }
        }
    }
    
    public function check_for_renewal($permitid, $permittype, $permitexpiry){
        //check permit_exist
        $this->db->select('*');
        $this->db->where('permit.permit_id', $permitid);
        $this->db->where('permit.permit_typeid', $permittype);
        //$this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
            $this->db->order_by('permit.permit_id', 'DESC');
            $this->db->limit(1, 0);
        $query = $this->db->get();
        $queryResult = $query->row();
        
    //$expirydate = $queryResult->permit_issuance_expirydate;
    $expirydateend = date('Y-m-d', strtotime($permitexpiry));    
    $expirydatestart = date('Y-m-d', strtotime('-1 month', strtotime($permitexpiry)));
    $now = date('Y-m-d');
    if (($now >= $expirydatestart) && ($now <= $expirydateend)){
        return 7;
    }else{
        return 6;  
    }
    }
    
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
