<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined("BASEPATH"))
  exit("No direct script access allowed");

class Avpevpinspectionmanagement_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {

    $this->db->select("*", FALSE);
	$this->db->where("avpevpinspectionmanagement_deleted_at");
	$this->db->order_by("avpevpinspectionmanagement_date", "DESC");
	$this->db->from("avpevpinspectionmanagement");

	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    
  }

// get data by id
  function get_by_id($id) {

    $this->db->select("*");
	$this->db->where("avpevpinspectionmanagement_id", $id);
	$this->db->where("avpevpinspectionmanagement_deleted_at");
	$this->db->from("avpevpinspectionmanagement");

	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {

    $this->db->select("*", FALSE);
	$this->db->where("avpevpinspectionmanagement_id", $id);
	$this->db->where("avpevpinspectionmanagement_deleted_at");
	$this->db->from("avpevpinspectionmanagement");

	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert("avpevpinspectionmanagement", $data);
  }

// update data
  function update($id, $data) {

    $this->db->where("avpevpinspectionmanagement_id", $id);
    $this->db->update("avpevpinspectionmanagement", $data);

  }

// delete data
  function delete($id) {

    $this->db->where("avpevpinspectionmanagement_id", $id);
    $this->db->delete("avpevpinspectionmanagement");

  }

  

  function listajax($columns, $start, $length, $filter='', $sort='', $sorttype=''){
    $i=0;
    $this->db->select("*", FALSE);
	$this->db->where("avpevpinspectionmanagement_deleted_at");
	$this->db->from("avpevpinspectionmanagement");
        //added on 6 Oct 2021
        $this->db->order_by('avpevpinspectionmanagement_date', 'DESC');

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
    if($sort!=''){
        $this->db->order_by($sort, $sorttype);
    }else{

	$this->db->order_by("avpevpinspectionmanagement_id", "DESC");

    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select("count(*) as recordstotal");
    $this->db->from("avpevpinspectionmanagement");

	$this->db->where("avpevpinspectionmanagement_deleted_at");

    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=''){
    $i=0;
    $this->db->select("count(*) as recordsfiltered");
    $this->db->from("avpevpinspectionmanagement");

	$this->db->where("avpevpinspectionmanagement_deleted_at");

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

    public function get_slot($type="")
    {

        $this->db->select("*");
        $this->db->where("avpevpinspectionmanagement_deleted_at");
        if($type!=''){
        $this->db->where("avpevpinspectionmanagement_type", $type);

        }

        $this->db->from("avpevpinspectionmanagement");

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }
    
    public function get_slottaken_avp($date)
    {
        $this->db->select("*");
        $this->db->where("avppermit_inspection_date",$date);
        //$this->db->where("permit_officialstatus !=",'canceled');
        //$this->db->where("permit_officialstatus !=",'rejected');
        $this->db->from("avppermit");
        $this->db->join('permit', 'permit.permit_id = avppermit.avppermit_permit_id');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return 0;
        }

    }
    
    public function get_slottaken_evp($date)
    {
        $this->db->select("*");
        $this->db->where("evppermit_inspection_date",$date);
        //$this->db->where("permit_officialstatus !=",'canceled');
        //$this->db->where("permit_officialstatus !=",'rejected');
        $this->db->from("evppermit");
        $this->db->join('permit', 'permit.permit_id = evppermit.evppermit_permit_id');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return 0;
        }

    }

    public function get_by_date($date,$type='')
    {
        $this->db->select('avpevpinspectionmanagement_id, avpevpinspectionmanagement_slottaken');
        $this->db->where('avpevpinspectionmanagement_date', $date);
        if($type!=''){
         $this->db->where('avpevpinspectionmanagement_type', $type);
        }

        $this->db->where('avpevpinspectionmanagement_deleted_at');
        $this->db->from('avpevpinspectionmanagement');

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