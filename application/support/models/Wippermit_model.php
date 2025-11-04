<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Wippermit_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*', FALSE);
	$this->db->where('wippermit_deleted_at');
	$this->db->order_by('wippermit_id', 'DESC');
	$this->db->from('wippermit');
	
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
	$this->db->where('wippermit_id', $id);
	$this->db->where('wippermit_deleted_at');
	$this->db->from('wippermit');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*', FALSE);
	$this->db->where('wippermit_id', $id);
	$this->db->where('wippermit_deleted_at');
	$this->db->from('wippermit');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

    public function get_read_by_permitid($id)
    {
        $this->db->select('wippermit.*,a.user_name AS inspector_name,b.user_name AS engineer_name', false);
        $this->db->distinct();
        $this->db->where('wippermit_permit_id', $id);
        $this->db->where('wippermit_deleted_at');
        $this->db->join('userlist a', 'a.user_id = wippermit.wippermit_result_inspector_id', 'left');
        $this->db->join('userlist b', 'b.user_id = wippermit.wippermit_managerverified_id', 'left');
        $this->db->from('wippermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

// insert data
  function insert($data) {
    $this->db->insert('wippermit', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('wippermit_id', $id);
    $this->db->update('wippermit', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('wippermit_id', $id);
    $this->db->delete('wippermit');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*', FALSE);
	$this->db->where('wippermit_deleted_at');
	$this->db->from('wippermit');

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
	$this->db->order_by('wippermit_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('wippermit');
    
	$this->db->where('wippermit_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('wippermit');
    
	$this->db->where('wippermit_deleted_at');
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