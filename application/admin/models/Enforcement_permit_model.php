<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Enforcement_permit_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*=================================
    =            DATATABLE            =
    =================================*/

    var $dt_primary_key = 'permit_id';
    var $dt_table = 'permit'; //nama tabel dari database
    var $column_order = array('company.company_name','permit.permit_issuance_serialno','permit_type.permit_type_desc','permit.permit_created_at',null); //field yang ada di table user
    var $column_search = array('company.company_name','permit.permit_issuance_serialno','permit_type.permit_type_desc'); //field yang diizin untuk pencarian 
    var $order = array('UPPER(company.company_name)' => 'asc'); // default order 

    private function _get_datatables_query()
    {
        // $filter_type = $this->input->post('filter_type');
        // $filter_name = $this->input->post('filter_name');
        // $filter_email = $this->input->post('filter_email');
        // $filter_status = $this->input->post('filter_status');
        // if(!empty($filter_type))
        // {
        //     $this->db->where($this->dt_table.'.types',$filter_type);
        // }

        // if(!empty($filter_name))
        // {
        //     $this->db->like($this->dt_table.'.staff_name',$filter_name);
        // }

        // if(!empty($filter_email))
        // {
        //     $this->db->like($this->dt_table.'.staff_email',$filter_email);
        // }

        // if(!empty($filter_status))
        // {
        //     // $filter_status = $filter_status == '1' ? '1' : '2' ;
        //     $this->db->where($this->dt_table.'.active',$filter_status);
        // }

        $this->db->select('permit.*,
                            permit_type.permit_type_name AS permit_type_name_permit_typeid,
                            permit_type.permit_type_desc AS permit_type_desc,
                            company.company_name AS company_name_permit_companyid');

        $this->db->from($this->dt_table);
        // $this->db->where_in($this->dt_table.'.types',array(3,5));
        $this->db->where($this->dt_table.'.permit_deleted_at');
        $this->db->where($this->dt_table.'.permit_status', 'suspended');
        $this->db->where('( '.$this->dt_table.'.permit_issuance_serialno IS NOT NULL )'); //OR '.$this->dt_table.'.permit_issuance_serialno != ""
        // if($location!="all"){
        //  $this->db->like('permit_location', $location, 'before');
        // }
        $this->db->join('permit_type', 'permit_type.permit_type_id = '.$this->dt_table.'.permit_typeid', 'left');
        $this->db->join('company', 'company.company_id = '.$this->dt_table.'.permit_companyid', 'left');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->dt_table);
        // $this->db->where_in($this->dt_table.'.types',array(3,5));
        $this->db->where($this->dt_table.'.permit_deleted_at');
        $this->db->where($this->dt_table.'.permit_status', 'suspended');
        $this->db->where('( '.$this->dt_table.'.permit_issuance_serialno IS NOT NULL )'); //OR '.$this->dt_table.'.permit_issuance_serialno != ""
        // if($location!="all"){
        //  $this->db->like('permit_location', $location, 'before');
        // }
        $this->db->join('permit_type', 'permit_type.permit_type_id = '.$this->dt_table.'.permit_typeid', 'left');
        $this->db->join('company', 'company.company_id = '.$this->dt_table.'.permit_companyid', 'left');

        $c = $this->db->count_all_results();

        //echo $this->db->last_query();

        return $c;
    }
    
    /*=====  End of DATATABLE  ======*/

    function count_suspend_permit()
    {
        $this->db->select('COUNT(permit.permit_id) as count_permit');

        $this->db->from($this->dt_table);
        // $this->db->where_in($this->dt_table.'.types',array(3,5));
        $this->db->where($this->dt_table.'.permit_deleted_at');
        $this->db->where($this->dt_table.'.permit_status', 'suspended');
        $this->db->where('( '.$this->dt_table.'.permit_issuance_serialno IS NOT NULL )'); //OR '.$this->dt_table.'.permit_issuance_serialno != ""
        // if($location!="all"){
        //  $this->db->like('permit_location', $location, 'before');
        // }
        $this->db->join('permit_type', 'permit_type.permit_type_id = '.$this->dt_table.'.permit_typeid', 'left');
        $this->db->join('company', 'company.company_id = '.$this->dt_table.'.permit_companyid', 'left');
        $this->db->limit(1);
        $query = $this->db->get()->row();

        $res = 0;
        if(isset($query->count_permit) && $query->count_permit > 0)
        {
            $res = $query->count_permit;
        }

        return $res;
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
