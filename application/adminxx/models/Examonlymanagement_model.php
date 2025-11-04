<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Examonlymanagement_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('
	examonlymanagement.*,
	userlist.user_name AS user_name_examonlymanagement_officer_pic,
	case examonlymanagement_session
	when "m" then "Morning"
	when "a" then "Afternoon"
	end as examonlymanagement_session,
	case examonlymanagement_classtype
	when "A" then "A"
	when "B1" then "B1"
	when "B2" then "B2"
	when "C" then "C"
	end as examonlymanagement_classtype', FALSE);
	$this->db->where('examonlymanagement_deleted_at');
	$this->db->order_by('examonlymanagement.examonlymanagement_id', 'DESC');
	$this->db->from('examonlymanagement');
	$this->db->join('userlist', 'userlist.user_id = examonlymanagement.examonlymanagement_officer_pic', 'left');
	
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
	$this->db->where('examonlymanagement.examonlymanagement_id', $id);
	$this->db->where('examonlymanagement_deleted_at');
	$this->db->from('examonlymanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('
	examonlymanagement.*,
	userlist.user_name AS user_name_examonlymanagement_officer_pic,
	case examonlymanagement_session
	when "m" then "Morning"
	when "a" then "Afternoon"
	end as examonlymanagement_session,
	case examonlymanagement_classtype
	when "A" then "A"
	when "B1" then "B1"
	when "B2" then "B2"
	when "C" then "C"
	end as examonlymanagement_classtype', FALSE);
	$this->db->where('examonlymanagement.examonlymanagement_id', $id);
	$this->db->where('examonlymanagement_deleted_at');
	$this->db->from('examonlymanagement');
	$this->db->join('userlist', 'userlist.user_id = examonlymanagement.examonlymanagement_officer_pic', 'left');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('examonlymanagement', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('examonlymanagement_id', $id);
    $this->db->update('examonlymanagement', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('examonlymanagement_id', $id);
    $this->db->delete('examonlymanagement');
  }

  function get_all_userlist()
    {
        $this->db->select('*');
	$this->db->order_by('user_id', 'ASC');
	$this->db->from('userlist');
	return $query = $this->db->get()->result();
    }

    

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('
	examonlymanagement.*,
	userlist.user_name AS user_name_examonlymanagement_officer_pic,
	case examonlymanagement_session
	when "m" then "Morning"
	when "a" then "Afternoon"
	end as examonlymanagement_session,
	case examonlymanagement_classtype
	when "A" then "A"
	when "B1" then "B1"
	when "B2" then "B2"
	when "C" then "C"
	end as examonlymanagement_classtype', FALSE);
	$this->db->where('examonlymanagement_deleted_at');
	$this->db->from('examonlymanagement');
	$this->db->join('userlist', 'userlist.user_id = examonlymanagement.examonlymanagement_officer_pic', 'left');

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
	$this->db->order_by('examonlymanagement.examonlymanagement_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('examonlymanagement');
    
	$this->db->where('examonlymanagement_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('examonlymanagement');
    
	$this->db->where('examonlymanagement_deleted_at');
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