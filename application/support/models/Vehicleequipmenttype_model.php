<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Vehicleequipmenttype_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*', FALSE);
	$this->db->where('vehicleequipmenttype_deleted_at');
	$this->db->order_by('vehicleequipmenttype_id', 'DESC');
	$this->db->from('vehicleequipmenttype');
	
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
	$this->db->where('vehicleequipmenttype_id', $id);
	$this->db->where('vehicleequipmenttype_deleted_at');
	$this->db->from('vehicleequipmenttype');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*', FALSE);
	$this->db->where('vehicleequipmenttype_id', $id);
	$this->db->where('vehicleequipmenttype_deleted_at');
	$this->db->from('vehicleequipmenttype');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('vehicleequipmenttype', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('vehicleequipmenttype_id', $id);
    $this->db->update('vehicleequipmenttype', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('vehicleequipmenttype_id', $id);
    $this->db->delete('vehicleequipmenttype');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*', FALSE);
	$this->db->where('vehicleequipmenttype_deleted_at');
	$this->db->from('vehicleequipmenttype');

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
	$this->db->order_by('vehicleequipmenttype_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('vehicleequipmenttype');
    
	$this->db->where('vehicleequipmenttype_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('vehicleequipmenttype');
    
	$this->db->where('vehicleequipmenttype_deleted_at');
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