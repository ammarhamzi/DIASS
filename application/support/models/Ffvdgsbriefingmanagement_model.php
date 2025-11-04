<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Ffvdgsbriefingmanagement_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*,
	case ffvdgs_briefingmanagement_category
	when "morning" then "morning"
	when "evening" then "evening"
	end as ffvdgs_briefingmanagement_category,
	case ffvdgs_briefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as ffvdgs_briefingmanagement_location', FALSE);
	$this->db->where('ffvdgs_briefingmanagement_deleted_at');
	$this->db->order_by('ffvdgs_briefingmanagement_id', 'DESC');
	$this->db->from('ffvdgs_briefingmanagement');
	
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
	$this->db->where('ffvdgs_briefingmanagement_id', $id);
	$this->db->where('ffvdgs_briefingmanagement_deleted_at');
	$this->db->from('ffvdgs_briefingmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*,
	case ffvdgs_briefingmanagement_category
	when "morning" then "morning"
	when "evening" then "evening"
	end as ffvdgs_briefingmanagement_category,
	case ffvdgs_briefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as ffvdgs_briefingmanagement_location', FALSE);
	$this->db->where('ffvdgs_briefingmanagement_id', $id);
	$this->db->where('ffvdgs_briefingmanagement_deleted_at');
	$this->db->from('ffvdgs_briefingmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('ffvdgs_briefingmanagement', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('ffvdgs_briefingmanagement_id', $id);
    $this->db->update('ffvdgs_briefingmanagement', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('ffvdgs_briefingmanagement_id', $id);
    $this->db->delete('ffvdgs_briefingmanagement');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*,
	case ffvdgs_briefingmanagement_category
	when "morning" then "morning"
	when "evening" then "evening"
	end as ffvdgs_briefingmanagement_category,
	case ffvdgs_briefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as ffvdgs_briefingmanagement_location', FALSE);
	$this->db->where('ffvdgs_briefingmanagement_deleted_at');
	$this->db->from('ffvdgs_briefingmanagement');

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
	$this->db->order_by('ffvdgs_briefingmanagement_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('ffvdgs_briefingmanagement');
    
	$this->db->where('ffvdgs_briefingmanagement_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('ffvdgs_briefingmanagement');
    
	$this->db->where('ffvdgs_briefingmanagement_deleted_at');
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

    public function get_slot($firstdate)
    {
        $this->db->select('*');
        $this->db->where('ffvdgs_briefingmanagement_deleted_at');
        if($firstdate!=''){
        $this->db->where('ffvdgs_briefingmanagement_date >',$firstdate);
        }
        $this->db->from('ffvdgs_briefingmanagement');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_by_date($date)
    {
        $this->db->select('ffvdgs_briefingmanagement_id, ffvdgs_briefingmanagement_slottaken');
        $this->db->where('ffvdgs_briefingmanagement_date', $date);
        $this->db->where('ffvdgs_briefingmanagement_deleted_at');
        $this->db->from('ffvdgs_briefingmanagement');

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