<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Vehiclegroup_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*', FALSE);
	$this->db->where('vehiclegroup_deleted_at');
	$this->db->order_by('vehiclegroup_id', 'DESC');
	$this->db->from('vehiclegroup');
	
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
	$this->db->where('vehiclegroup_id', $id);
	$this->db->where('vehiclegroup_deleted_at');
	$this->db->from('vehiclegroup');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*', FALSE);
	$this->db->where('vehiclegroup_id', $id);
	$this->db->where('vehiclegroup_deleted_at');
	$this->db->from('vehiclegroup');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('vehiclegroup', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('vehiclegroup_id', $id);
    $this->db->update('vehiclegroup', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('vehiclegroup_id', $id);
    $this->db->delete('vehiclegroup');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*', FALSE);
	$this->db->where('vehiclegroup_deleted_at');
	$this->db->from('vehiclegroup');

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
	$this->db->order_by('vehiclegroup_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('vehiclegroup');
    
	$this->db->where('vehiclegroup_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('vehiclegroup');
    
	$this->db->where('vehiclegroup_deleted_at');
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