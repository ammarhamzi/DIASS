<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitrenew_model extends CI_Model
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
    company.company_name AS company_name_permit_companyid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_officialstatus', false);
        $this->db->where('permit_deleted_at');
        $this->db->order_by('permit.permit_id', 'DESC');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
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

    public function get_read($id)
    {
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    company.company_name AS company_name_permit_companyid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_officialstatus', false);
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
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
$next_twomonth = date('Y-m-d', strtotime("+2 months", strtotime("NOW")));

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
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_issuance_expirydate <',$next_twomonth);
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
$next_twomonth = date('Y-m-d', strtotime("+2 months", strtotime("NOW")));

        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->distinct();
        /*$this->db->where('permit_officialstatus', '1');*/
        $this->db->where('permit_companyid', $this->session->userdata('companyid'));
        $this->db->where('permit_deleted_at');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_issuance_expirydate <',$next_twomonth);
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $columnfilter, $filter = "")
    {
$next_twomonth = date('Y-m-d', strtotime("+2 months", strtotime("NOW")));

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
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_issuance_expirydate <',$next_twomonth);
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
    $next_twomonth = date('Y-m-d', strtotime("+2 months", strtotime("NOW")));
        $this->db->select('*');
        $this->db->where('permit.permit_companyid', $id);
        $this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->where('permit_deleted_at');
        $this->db->where('permit_issuance_expirydate <',$next_twomonth);
        $this->db->from('permit');

        $query = $this->db->get();
        return $query->num_rows();

    }

}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
