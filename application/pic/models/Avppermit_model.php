<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Avppermit_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*', FALSE);
	$this->db->where('avppermit_deleted_at');
	$this->db->order_by('avppermit_id', 'DESC');
	$this->db->from('avppermit');
	
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
	$this->db->where('avppermit_id', $id);
	$this->db->where('avppermit_deleted_at');
	$this->db->from('avppermit');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }
  
//  // get data by vehicle id
//  function get_by_vehicle_id($id) {
////    $this->db->select('p.*');
////	$this->db->where('avppermit.avppermit_vehicle_id', $id);
////	$this->db->where('p.permit_deleted_at');
////        $this->db->join('permit p', 'p.permit_id = avppermit.avppermit_permit_id', 'left');
////	$this->db->from('avppermit');
////	
////        $this->db->order_by('p.permit_updated_at', 'DESC');
////        $this->db->limit(1, 0);
////        $query = $this->db->get();
//      $this->db->select('*');
//        $this->db->where('vehicle.vehicle_id', $id);
//        $this->db->where('vehicle_deleted_at');
//        $this->db->from('vehicle');
//
//        $query = $this->db->get();
//
//        if($query->num_rows() >= 1){
//            return $query->row();
//        }else{
//            return false;
//        }
//    
//  }

  function get_read($id) {
    $this->db->select('*', FALSE);
	$this->db->where('avppermit_id', $id);
	$this->db->where('avppermit_deleted_at');
	$this->db->from('avppermit');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

    public function get_read_by_permitid($id)
    {
        $this->db->select('avppermit.*,a.user_name AS inspector_name,b.user_name AS engineer_name', false);
        $this->db->distinct();
        $this->db->where('avppermit_permit_id', $id);
        $this->db->where('avppermit_deleted_at');
        $this->db->join('userlist a', 'a.user_id = avppermit.avppermit_result_inspector_id', 'left');
        $this->db->join('userlist b', 'b.user_id = avppermit.avppermit_managerverified_id', 'left');
        $this->db->from('avppermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

// insert data
  function insert($data) {
    $this->db->insert('avppermit', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('avppermit_id', $id);
    $this->db->update('avppermit', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('avppermit_id', $id);
    $this->db->delete('avppermit');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*', FALSE);
	$this->db->where('avppermit_deleted_at');
	$this->db->from('avppermit');

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
	$this->db->order_by('avppermit_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('avppermit');
    
	$this->db->where('avppermit_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('avppermit');
    
	$this->db->where('avppermit_deleted_at');
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


}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */