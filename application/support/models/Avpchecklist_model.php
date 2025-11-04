<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Avpchecklist_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist_deleted_at');
	$this->db->order_by('avpchecklist.avpchecklist_id', 'DESC');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

  function get_all_by_permitid($id) {
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist_deleted_at');
    $this->db->where('avpchecklist_permit_id', $id);
	$this->db->order_by('avpchecklist.avpchecklist_id', 'DESC');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

  function get_selfchecked_by_permitid($id) {
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist_deleted_at');
    $this->db->where('avpchecklist_permit_id', $id);
    $this->db->where('avpchecklist_checked', 'y');
	$this->db->order_by('avpchecklist.avpchecklist_id', 'DESC');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

    function get_mtwchecked_y_by_permitid($id) {
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist_deleted_at');
    $this->db->where('avpchecklist_permit_id', $id);
    $this->db->where('avpchecklist_mtwchecked', 'y');
	$this->db->order_by('avpchecklist.avpchecklist_id', 'DESC');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

    function get_mtwchecked_n_by_permitid($id) {
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist_deleted_at');
    $this->db->where('avpchecklist_permit_id', $id);
    $this->db->where('avpchecklist_mtwchecked', 'n');
	$this->db->order_by('avpchecklist.avpchecklist_id', 'DESC');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

    function get_mtwchecked_na_by_permitid($id) {
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist_deleted_at');
    $this->db->where('avpchecklist_permit_id', $id);
    $this->db->where('avpchecklist_mtwchecked', 'n/a');
	$this->db->order_by('avpchecklist.avpchecklist_id', 'DESC');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');

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
	$this->db->where('avpchecklist.avpchecklist_id', $id);
	$this->db->where('avpchecklist_deleted_at');
	$this->db->from('avpchecklist');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist.avpchecklist_id', $id);
	$this->db->where('avpchecklist_deleted_at');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('avpchecklist', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('avpchecklist_id', $id);
    $this->db->update('avpchecklist', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('avpchecklist_id', $id);
    $this->db->delete('avpchecklist');
  }

  function get_all_permit()
    {
        $this->db->select('*');
	$this->db->order_by('permit_id', 'ASC');
	$this->db->from('permit');
	return $query = $this->db->get()->result();
    }

    function get_all_mtwchecklist()
    {
        $this->db->select('*');
	$this->db->order_by('mtwchecklist_id', 'ASC');
	$this->db->from('mtwchecklist');
	return $query = $this->db->get()->result();
    }

    

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('
	avpchecklist.*,
	permit.permit_bookingid AS permit_bookingid_avpchecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_avpchecklist_mtwchecklist_id', FALSE);
	$this->db->where('avpchecklist_deleted_at');
	$this->db->from('avpchecklist');
	$this->db->join('permit', 'permit.permit_id = avpchecklist.avpchecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = avpchecklist.avpchecklist_mtwchecklist_id', 'left');

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
	$this->db->order_by('avpchecklist.avpchecklist_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('avpchecklist');
    
	$this->db->where('avpchecklist_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('avpchecklist');
    
	$this->db->where('avpchecklist_deleted_at');
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