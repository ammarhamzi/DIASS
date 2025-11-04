<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Shinschecklist_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist_deleted_at');
	$this->db->order_by('shinschecklist.shinschecklist_id', 'DESC');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    
  }

  function get_all_by_permitid($id) {
    $this->db->select('
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist_deleted_at');
    $this->db->where('shinschecklist_permit_id', $id);
	$this->db->order_by('shinschecklist.shinschecklist_id', 'DESC');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

  function get_selfchecked_by_permitid($id) {
    $this->db->select('
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist_deleted_at');
    $this->db->where('shinschecklist_permit_id', $id);
    $this->db->where('shinschecklist_checked', 'y');
	$this->db->order_by('shinschecklist.shinschecklist_id', 'DESC');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

    function get_mtwchecked_y_by_permitid($id) {
    $this->db->select('
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist_deleted_at');
    $this->db->where('shinschecklist_permit_id', $id);
    $this->db->where('shinschecklist_mtwchecked', 'y');
	$this->db->order_by('shinschecklist.shinschecklist_id', 'DESC');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

    function get_mtwchecked_n_by_permitid($id) {
    $this->db->select('
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist_deleted_at');
    $this->db->where('shinschecklist_permit_id', $id);
    $this->db->where('shinschecklist_mtwchecked', 'n');
	$this->db->order_by('shinschecklist.shinschecklist_id', 'DESC');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

  }

    function get_mtwchecked_na_by_permitid($id) {
    $this->db->select('
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist_deleted_at');
    $this->db->where('shinschecklist_permit_id', $id);
    $this->db->where('shinschecklist_mtwchecked', 'n/a');
	$this->db->order_by('shinschecklist.shinschecklist_id', 'DESC');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');

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
	$this->db->where('shinschecklist.shinschecklist_id', $id);
	$this->db->where('shinschecklist_deleted_at');
	$this->db->from('shinschecklist');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist.shinschecklist_id', $id);
	$this->db->where('shinschecklist_deleted_at');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('shinschecklist', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('shinschecklist_id', $id);
    $this->db->update('shinschecklist', $data);
  }

  function update_mtw_inspection($id, $selected){

    //reset all
    $this->db->where('shinschecklist_permit_id', $id);
    $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => NULL]);
              foreach ($selected as $selectid) {
                $this->db->where('shinschecklist_permit_id', $id);
                $this->db->where('shinschecklist_mtwchecklist_id', $selectid);
                $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => 'y']);
            }
  }

  function update_mtw_inspection_v2($id,$selected_y,$selected_n){
    //reset all
    $this->db->where('shinschecklist_permit_id', $id);
    $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => NULL]);

              foreach ($selected_y as $selectidy) {
                $this->db->where('shinschecklist_permit_id', $id);
                $this->db->where('shinschecklist_mtwchecklist_id', $selectidy);
                $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => 'y']);
            }

              foreach ($selected_n as $selectidn) {
                $this->db->where('shinschecklist_permit_id', $id);
                $this->db->where('shinschecklist_mtwchecklist_id', $selectidn);
                $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => 'n']);
            }
  }

  function update_mtw_inspection_v3($id,$selected_y,$selected_n,$selected_na){
    //reset all
    $this->db->where('shinschecklist_permit_id', $id);
    $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => NULL]);

              foreach ($selected_y as $selectidy) {
                $this->db->where('shinschecklist_permit_id', $id);
                $this->db->where('shinschecklist_mtwchecklist_id', $selectidy);
                $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => 'y']);
            }

              foreach ($selected_n as $selectidn) {
                $this->db->where('shinschecklist_permit_id', $id);
                $this->db->where('shinschecklist_mtwchecklist_id', $selectidn);
                $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => 'n']);
            }

              foreach ($selected_na as $selectidna) {
                $this->db->where('shinschecklist_permit_id', $id);
                $this->db->where('shinschecklist_mtwchecklist_id', $selectidna);
                $this->db->update('shinschecklist', ['shinschecklist_mtwchecked' => 'n/a']);
            }
  }

// delete data
  function delete($id) {
    $this->db->where('shinschecklist_id', $id);
    $this->db->delete('shinschecklist');
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
	shinschecklist.*,
	permit.permit_bookingid AS permit_bookingid_shinschecklist_permit_id,
	mtwchecklist.mtwchecklist_name AS mtwchecklist_name_shinschecklist_mtwchecklist_id', FALSE);
	$this->db->where('shinschecklist_deleted_at');
	$this->db->from('shinschecklist');
	$this->db->join('permit', 'permit.permit_id = shinschecklist.shinschecklist_permit_id', 'left');
	$this->db->join('mtwchecklist', 'mtwchecklist.mtwchecklist_id = shinschecklist.shinschecklist_mtwchecklist_id', 'left');

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
	$this->db->order_by('shinschecklist.shinschecklist_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('shinschecklist');
    
	$this->db->where('shinschecklist_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('shinschecklist');
    
	$this->db->where('shinschecklist_deleted_at');
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