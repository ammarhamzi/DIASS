<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Evdpbriefingmanagement_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

// get all
  function get_all() {
    $this->db->select('*,
	case evdpbriefingmanagement_category
	when "morning" then "morning"
	when "evening" then "evening"
	end as evdpbriefingmanagement_category,
	case evdpbriefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as evdpbriefingmanagement_location', FALSE);
	$this->db->where('evdpbriefingmanagement_deleted_at');
	$this->db->order_by('evdpbriefingmanagement_id', 'DESC');
	$this->db->from('evdpbriefingmanagement');
	
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
	$this->db->where('evdpbriefingmanagement_id', $id);
	$this->db->where('evdpbriefingmanagement_deleted_at');
	$this->db->from('evdpbriefingmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

  function get_read($id) {
    $this->db->select('*,
	case evdpbriefingmanagement_category
	when "morning" then "morning"
	when "evening" then "evening"
	end as evdpbriefingmanagement_category,
	case evdpbriefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as evdpbriefingmanagement_location', FALSE);
	$this->db->where('evdpbriefingmanagement_id', $id);
	$this->db->where('evdpbriefingmanagement_deleted_at');
	$this->db->from('evdpbriefingmanagement');
	
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
    
  }

// insert data
  function insert($data) {
    $this->db->insert('evdpbriefingmanagement', $data);
  }

// update data
  function update($id, $data) {
    $this->db->where('evdpbriefingmanagement_id', $id);
    $this->db->update('evdpbriefingmanagement', $data);
  }

// delete data
  function delete($id) {
    $this->db->where('evdpbriefingmanagement_id', $id);
    $this->db->delete('evdpbriefingmanagement');
  }

  

  function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
    $i=0;
    $this->db->select('*,
	case evdpbriefingmanagement_category
	when "morning" then "morning"
	when "evening" then "evening"
	end as evdpbriefingmanagement_category,
	case evdpbriefingmanagement_location
	when "KLIA" then "KLIA"
	when "KLIA2" then "KLIA2"
	end as evdpbriefingmanagement_location', FALSE);
	$this->db->where('evdpbriefingmanagement_deleted_at');
	$this->db->from('evdpbriefingmanagement');

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
	$this->db->order_by('evdpbriefingmanagement_id', 'DESC');
    }

    $this->db->limit($length, $start);
    $query = $this->db->get();
    $queryResult = $query->result_array();
    return $queryResult;
  }

  function recordsTotal(){
    $i=0;
    $this->db->select('count(*) as recordstotal');
    $this->db->from('evdpbriefingmanagement');
    
	$this->db->where('evdpbriefingmanagement_deleted_at');
    $query = $this->db->get();
    $queryResult = $query->row();
    return $queryResult;
}

  function recordsFiltered($columns, $filter=""){
    $i=0;
    $this->db->select('count(*) as recordsfiltered');
    $this->db->from('evdpbriefingmanagement');
    
	$this->db->where('evdpbriefingmanagement_deleted_at');
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

    public function get_slot($firstdate = '')
    {
        $this->db->select('*');
        $this->db->where('evdpbriefingmanagement_deleted_at');
        if($firstdate!=''){
        $this->db->where('evdpbriefingmanagement_date >',$firstdate);
        }
        $this->db->from('evdpbriefingmanagement');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_slottaken($date,$location,$session)
    {
        $this->db->select("*");
        $this->db->where("evdppermit_course_date",$date);
        $this->db->where("evdppermit_course_session",$session);
        $this->db->where("evdppermit_course_location",$location);
        $this->db->where("permit_officialstatus !=",'canceled');
        $this->db->where("permit_officialstatus !=",'rejected');
        $this->db->from("evdppermit");
        $this->db->join('permit', 'permit.permit_id = evdppermit.evdppermit_permit_id');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return 0;
        }

    }

    public function get_by_date($date, $location, $session)
    {
        $this->db->select('evdpbriefingmanagement_id, evdpbriefingmanagement_slottaken');
        $this->db->where('evdpbriefingmanagement_date', $date);
        $this->db->where('evdpbriefingmanagement_location', $location);
        $this->db->where('evdpbriefingmanagement_category', $session);
        $this->db->where('evdpbriefingmanagement_deleted_at');
        $this->db->from('evdpbriefingmanagement');

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