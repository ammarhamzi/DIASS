<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Tepinspectionmanagement_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*,
	case tepinspectionmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as tepinspectionmanagement_location', FALSE);
	$this->db->where('tepinspectionmanagement_deleted_at');
	$this->db->order_by('tepinspectionmanagement_id', 'DESC');
	$this->db->from('tepinspectionmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    
  }

// get data by id
  function get_by_id($id) {
    $this->db->select('*');
	$this->db->where('tepinspectionmanagement_id', $id);
	$this->db->where('tepinspectionmanagement_deleted_at');
	$this->db->from('tepinspectionmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*,
	case tepinspectionmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as tepinspectionmanagement_location', FALSE);
	$this->db->where('tepinspectionmanagement_id', $id);
	$this->db->where('tepinspectionmanagement_deleted_at');
	$this->db->from('tepinspectionmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('tepinspectionmanagement', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('tepinspectionmanagement_id', $id);
    $this->db->update('tepinspectionmanagement', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('tepinspectionmanagement_id', $id);
    $this->db->delete('tepinspectionmanagement');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*,
	case tepinspectionmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as tepinspectionmanagement_location', FALSE);
	$this->db->where('tepinspectionmanagement_deleted_at');
	$this->db->from('tepinspectionmanagement');

	$this->db->group_start();
	foreach ($columns as $column) {
		if($i==0){
			$this->db->where("$column like", "%$filter%");
		}else{
			$this->db->or_where("$column like", "%$filter%");
		}

	$i++;
}
	$this->db->group_end();
    if($sort!=""){
        $this->db->order_by($sort, $sorttype);
    }else{
	$this->db->order_by('tepinspectionmanagement_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('tepinspectionmanagement');
    
	$this->db->where('tepinspectionmanagement_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('tepinspectionmanagement');
    
	$this->db->where('tepinspectionmanagement_deleted_at');
    foreach ($columns as $column) {
      if($i==0){
        $this->db->where("$column like", "%$filter%");
        }else{
        $this->db->or_where("$column like", "%$filter%");
      }
        $i++;
    }
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

    public function get_slot($firstdate = '',$lastdate = '',$type = '')
    {
        $this->db->select('*');
        $this->db->where('tepinspectionmanagement_deleted_at');
        if($type!=''){
        $this->db->where('tepinspectionmanagement_type', $type);
        }
        if($firstdate!=''){
        $this->db->where('tepinspectionmanagement_date >',$firstdate);
        }
        if($lastdate!=''){
        $this->db->where('tepinspectionmanagement_date <',$lastdate);
        }
        $this->db->from('tepinspectionmanagement');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_slottaken($date,$location)
    {
        $this->db->select("*");
        $this->db->where("wippermit_course_date",$date);
        $this->db->where("wippermit_course_location",$location);
        $this->db->where("permit_officialstatus !=",'canceled');
        $this->db->where("permit_officialstatus !=",'rejected');
        $this->db->from("wippermit");
        $this->db->join('permit', 'permit.permit_id = wippermit.wippermit_permit_id');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return 0;
        }

    }

    public function get_by_date($date,$type='')
    {
        $this->db->select('tepinspectionmanagement_id, tepinspectionmanagement_slottaken');
        $this->db->where('tepinspectionmanagement_date', $date);
        if($type!=''){
         $this->db->where('tepinspectionmanagement_type', $type);
        }

        $this->db->where('tepinspectionmanagement_deleted_at');
        $this->db->from('tepinspectionmanagement');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */