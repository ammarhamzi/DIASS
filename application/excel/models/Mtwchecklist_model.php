<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Mtwchecklist_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all($permittype) {
    $this->db->select('*', FALSE);
	$this->db->where('mtwchecklist_deleted_at');
    $this->db->where('mtwchecklist_type', $permittype);
	$this->db->order_by('mtwchecklist_id', 'DESC');
	$this->db->from('mtwchecklist');
	
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
	$this->db->where('mtwchecklist_id', $id);
	$this->db->where('mtwchecklist_deleted_at');
	$this->db->from('mtwchecklist');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*', FALSE);
	$this->db->where('mtwchecklist_id', $id);
	$this->db->where('mtwchecklist_deleted_at');
	$this->db->from('mtwchecklist');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('mtwchecklist', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('mtwchecklist_id', $id);
    $this->db->update('mtwchecklist', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('mtwchecklist_id', $id);
    $this->db->delete('mtwchecklist');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*', FALSE);
	$this->db->where('mtwchecklist_deleted_at');
	$this->db->from('mtwchecklist');

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
	$this->db->order_by('mtwchecklist_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('mtwchecklist');
    
	$this->db->where('mtwchecklist_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('mtwchecklist');
    
	$this->db->where('mtwchecklist_deleted_at');
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