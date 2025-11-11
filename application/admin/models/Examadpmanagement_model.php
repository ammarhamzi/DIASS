<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Examadpmanagement_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select("*,
	case exammanagement_category
	when 'morning' then 'morning'
	when 'evening' then 'evening'
	end as exammanagement_category,
	case exammanagement_location
	when 'KLIA' then 'KLIA'
	when 'KLIA2' then 'KLIA2'
	end as exammanagement_location", FALSE);
	$this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
	$this->db->order_by('exammanagement_date', 'DESC');
	$this->db->from('exammanagement');
	
        $query = $this->db->get();

        if($query && $query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    
  }

// get data by id
  function get_by_id($id) {
    $this->db->select('*');
	$this->db->where('exammanagement_id', $id);
	$this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
	$this->db->from('exammanagement');
	
        $query = $this->db->get();

        if($query && $query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*,
	case exammanagement_category
	when "morning" then "morning"
	when "evening" then "evening"
	end as exammanagement_category,
	case exammanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as exammanagement_location', FALSE);
	$this->db->where('exammanagement_id', $id);
	$this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
	$this->db->from('exammanagement');
	
        $query = $this->db->get();

        if($query && $query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('exammanagement', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('exammanagement_id', $id);
    $this->db->update('exammanagement', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('exammanagement_id', $id);
    $this->db->delete('exammanagement');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
//    $this->db->select("*,
//	case exammanagement_category
//	when 'morning' then 'morning'
//	when 'evening' then 'evening'
//	end as exammanagement_category,
//	case exammanagement_location
//	when 'KLIA' then 'KLIA'
//	when 'KLIA2' then 'KLIA2'
//	end as exammanagement_location", FALSE);
    $this->db->select("*", FALSE);
	$this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
	$this->db->from('exammanagement');
        //added on 6 Oct 2021
        $this->db->order_by('exammanagement_date', 'DESC');

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
	$this->db->order_by('exammanagement_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('exammanagement');
    
	$this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('exammanagement');
    
	$this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
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

    public function get_slot($condition,$drivingclass)
    {
        $this->db->select('*');
        $this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
        if($condition!=""){
        $this->db->where('exammanagement_condition',$condition);
        }
        if($drivingclass!=""){
        $this->db->where('exammanagement_category',$drivingclass);
        }

        $this->db->from('exammanagement');

        $query = $this->db->get();

        if ($query && $query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_by_date($date,$session)
    {
        $this->db->select('exammanagement_id, exammanagement_slottaken');
        $this->db->where('exammanagement_date', $date);
        $this->db->where('exammanagement_category', $session);
        $this->db->where('exammanagement_deleted_at IS NULL', NULL, FALSE);
        $this->db->from('exammanagement');

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