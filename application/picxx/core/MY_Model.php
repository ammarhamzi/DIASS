<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_tables()
    {
        return $this->db->list_tables();
    }

    function get_columns($table)
    {
        return $this->db->list_fields($table);
    }

    function get_columnscheme($table){
      $query = $this->db->query("SHOW FULL COLUMNS FROM $table");

      if($query->num_rows() >= 1){
      			return $query->result();
      		}else{
      			return false;
      		}

    }

    function get_columnscheme_datefilter($table){
      $query = $this->db->query("SHOW FULL COLUMNS FROM $table where type like 'date%'");

      if($query->num_rows() >= 1){
      			return $query->result();
      		}else{
      			return false;
      		}

    }

function get_all($table, $fields = "*", $orderby = ""){
if($orderby === ""){
$sql = "select $fields from $table";
}else{
$sql = "select $fields from $table order by $orderby";
}

 $query = $this->db->query($sql);

		if($query->num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
}

function get_data($table, $fields, $condition = "1=1", $orderby = ""){
if($orderby === ""){
$sql = "select $fields from $table where $condition";
}else{
$sql = "select $fields from $table where $condition  order by $orderby";
}

 $query = $this->db->query($sql);
		if($query->num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}

}

function get_value($table, $get_field, $condition){
 $sql = "select $get_field from $table where $condition";
 $query = $this->db->query($sql);
		if($query->num_rows() >= 1){
			return $query->row();
		}else{
			return false;
		}
}

function get_value2($table, $get_field, $condition){
 $sql = "select $get_field from $table where $condition";
 $query = $this->db->query($sql);

  if ($query->num_rows() > 0)
  {
 return $query->row()->$get_field;
  }else{
  return false;
  }
}

// insert data
  function insert($table, $data=array()) {
    $this->db->insert($table, $data);
  }

  function delete($table, $primaryfield, $id){
    $this->db->where($primaryfield, $id);
    $this->db->delete($table);
  }
  
  function countrow($table, $condition){
	$sql = "select count(*) from $table where $condition";
    return $sql->num_rows();	
  }

function required_done($table,$field,$id,$requiredfields){

    foreach($requiredfields as $requiredfield){
     $query_add[] = " and $requiredfield > '' ";
    }
 $sql = "select * from $table where $field = $id".implode("",$query_add);
 $query = $this->db->query($sql);

 if($query->num_rows() == 1){
    return true;
}else{
 	return false;
 }
}




}

/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */