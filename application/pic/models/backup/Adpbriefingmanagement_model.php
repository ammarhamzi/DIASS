<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Adpbriefingmanagement_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*,
	case adpbriefingmanagement_category
	when "A" then "A"
	when "B1" then "B1"
	when "B2" then "B2"
	when "C" then "C"
	end as adpbriefingmanagement_category,
	case adpbriefingmanagement_condition
	when "New" then "New"
	when "Renewal" then "Renewal"
	end as adpbriefingmanagement_condition,
	case adpbriefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as adpbriefingmanagement_location', FALSE);
	$this->db->where('adpbriefingmanagement_deleted_at');
	$this->db->order_by('adpbriefingmanagement_id', 'DESC');
	$this->db->from('adpbriefingmanagement');
	
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
	$this->db->where('adpbriefingmanagement_id', $id);
	$this->db->where('adpbriefingmanagement_deleted_at');
	$this->db->from('adpbriefingmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*,
	case adpbriefingmanagement_category
	when "A" then "A"
	when "B1" then "B1"
	when "B2" then "B2"
	when "C" then "C"
	end as adpbriefingmanagement_category,
	case adpbriefingmanagement_condition
	when "New" then "New"
	when "Renewal" then "Renewal"
	end as adpbriefingmanagement_condition,
	case adpbriefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as adpbriefingmanagement_location', FALSE);
	$this->db->where('adpbriefingmanagement_id', $id);
	$this->db->where('adpbriefingmanagement_deleted_at');
	$this->db->from('adpbriefingmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('adpbriefingmanagement', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('adpbriefingmanagement_id', $id);
    $this->db->update('adpbriefingmanagement', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('adpbriefingmanagement_id', $id);
    $this->db->delete('adpbriefingmanagement');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*,
	case adpbriefingmanagement_category
	when "A" then "A"
	when "B1" then "B1"
	when "B2" then "B2"
	when "C" then "C"
	end as adpbriefingmanagement_category,
	case adpbriefingmanagement_condition
	when "New" then "New"
	when "Renewal" then "Renewal"
	end as adpbriefingmanagement_condition,
	case adpbriefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as adpbriefingmanagement_location', FALSE);
	$this->db->where('adpbriefingmanagement_deleted_at');
	$this->db->from('adpbriefingmanagement');

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
	$this->db->order_by('adpbriefingmanagement_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('adpbriefingmanagement');
    
	$this->db->where('adpbriefingmanagement_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('adpbriefingmanagement');
    
	$this->db->where('adpbriefingmanagement_deleted_at');
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

    public function get_slot($firstdate,$condition,$drivingclass)
    {
        $this->db->select('*');
        $this->db->where('adpbriefingmanagement_deleted_at');
        $this->db->where('adpbriefingmanagement_condition',$condition);
        $this->db->where('adpbriefingmanagement_category',$drivingclass);
        if($firstdate!=''){
        $this->db->where('adpbriefingmanagement_date >',$firstdate);
        }
        $this->db->from('adpbriefingmanagement');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_by_date($date, $location, $condition, $category)
    {
        $this->db->select('adpbriefingmanagement_id, adpbriefingmanagement_slottaken');
        $this->db->where('adpbriefingmanagement_date', $date);
        $this->db->where('adpbriefingmanagement_location', $location);
        $this->db->where('adpbriefingmanagement_condition', $condition);
        $this->db->where('adpbriefingmanagement_category', $category);
        $this->db->where('adpbriefingmanagement_deleted_at');
        $this->db->from('adpbriefingmanagement');

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