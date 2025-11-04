<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitpendingdocscheck_model extends CI_Model
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
permit_type.permit_type_desc AS permit_type_desc,
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
permit_type.permit_type_desc AS permit_type_desc,
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
        $this->db->order_by('permit_status_id', 'ASC');
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

    public function listajax($location, $columns, $columnfilter, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {

    $company = str_replace(['^','$'],['',''],$columnfilter['company']);
    $bookingid = str_replace(['^','$'],['',''],$columnfilter['bookingid']);
    $identity = str_replace(['^','$'],['',''],$columnfilter['identity']);
    $permittype = str_replace(['^','$'],['',''],$columnfilter['permittype']);
    $status = str_replace(['^','$'],['',''],$columnfilter['status']);
    $opdate = str_replace(['^','$'],['',''],$columnfilter['opdate']);
    $appdate = str_replace(['^','$'],['',''],$columnfilter['appdate']);
    $exdate = str_replace(['^','$'],['',''],$columnfilter['exdate']);
    $condition = str_replace(['^','$'],['',''],$columnfilter['condition']);

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
    permit_status.permit_status_desc AS permit_status_desc_permit_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_officialstatus,
CASE permit_typeid
    WHEN 1 THEN (select adppermit_course_date from adppermit where adppermit_permit_id = permit_id)
    WHEN 2 THEN (select evdppermit_course_date from evdppermit where evdppermit_permit_id = permit_id)
    WHEN 6 THEN (select vdgspermit_course_date from vdgspermit where vdgspermit_permit_id = permit_id)
    WHEN 5 THEN (select pbbpermit_course_date from pbbpermit where pbbpermit_permit_id = permit_id)
    WHEN 7 THEN (select pcapermit_course_date from pcapermit where pcapermit_permit_id = permit_id)
    WHEN 8 THEN (select gpupermit_course_date from gpupermit where gpupermit_permit_id = permit_id)
    ELSE NULL
END as permit_course_date,
CASE permit_typeid
    WHEN 1 THEN (select adppermit_competencytest_date from adppermit where adppermit_permit_id = permit_id)
    WHEN 2 THEN NULL
    WHEN 6 THEN NULL
    WHEN 5 THEN NULL
    WHEN 7 THEN NULL
    WHEN 8 THEN NULL
    ELSE NULL
END as permit_competencytest_date
    ', false);
        $this->db->distinct();
        $this->db->where('permit_deleted_at');
        $this->db->where('permit_status', 'docscheckingpending');
        if($location!="all"){
         $this->db->like('permit_location', $location, 'before');
        }
        $this->db->group_start();
        $this->db->where('permit_typeid', '1');
        $this->db->or_where('permit_typeid', '2');
        $this->db->or_where('permit_typeid', '5');
        $this->db->or_where('permit_typeid', '6');
        $this->db->or_where('permit_typeid', '7');
        $this->db->or_where('permit_typeid', '8');
        $this->db->group_end();
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');

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

        /* individual filter */
        if(!empty($bookingid)){
        $this->db->where("permit_bookingid like", "%$bookingid%");
        }
        if(!empty($company)){
        $this->db->where("company.company_name like", "%$company%");
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

        if(!empty($condition)){
        $this->db->where("permit_condition like", "%$condition%");
        }

        if ($sort != "") {
            $this->db->order_by($sort, $sorttype);
        } else {
            $this->db->order_by('permit.permit_created_at', 'DESC');
        }

        if($length != -1) {
            $this->db->limit($length, $start);
        }
        
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal($location)
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_status', 'docscheckingpending');
        if($location!="all"){
         $this->db->like('permit_location', $location, 'before');
        }
        $this->db->group_start();
        $this->db->where('permit_typeid', '1');
        $this->db->or_where('permit_typeid', '2');
        $this->db->or_where('permit_typeid', '5');
        $this->db->or_where('permit_typeid', '6');
        $this->db->or_where('permit_typeid', '7');
        $this->db->or_where('permit_typeid', '8');
        $this->db->group_end();
        $this->db->where('permit_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($location, $columns, $columnfilter, $filter = "")
    {

    $company = str_replace(['^','$'],['',''],$columnfilter['company']);
    $bookingid = str_replace(['^','$'],['',''],$columnfilter['bookingid']);
    $identity = str_replace(['^','$'],['',''],$columnfilter['identity']);
    $permittype = str_replace(['^','$'],['',''],$columnfilter['permittype']);
    $status = str_replace(['^','$'],['',''],$columnfilter['status']);
    $opdate = str_replace(['^','$'],['',''],$columnfilter['opdate']);
    $appdate = str_replace(['^','$'],['',''],$columnfilter['appdate']);
    $exdate = str_replace(['^','$'],['',''],$columnfilter['exdate']);
    $condition = str_replace(['^','$'],['',''],$columnfilter['condition']);

        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');
        $this->db->where('permit_status', 'docscheckingpending');
        if($location!="all"){
         $this->db->like('permit_location', $location, 'before');
        }
        $this->db->group_start();
        $this->db->where('permit_typeid', '1');
        $this->db->or_where('permit_typeid', '2');
        $this->db->or_where('permit_typeid', '5');
        $this->db->or_where('permit_typeid', '6');
        $this->db->or_where('permit_typeid', '7');
        $this->db->or_where('permit_typeid', '8');
        $this->db->group_end();
        $this->db->where('permit_deleted_at');
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

        /* individual filter */
        if(!empty($bookingid)){
        $this->db->where("permit_bookingid like", "%$bookingid%");
        }
        if(!empty($company)){
        $this->db->where("company.company_name like", "%$company%");
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

        if(!empty($condition)){
        $this->db->where("permit_condition like", "%$condition%");
        }

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
