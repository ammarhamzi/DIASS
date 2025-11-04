<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Service_charges_datatable_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*=================================
    =            DATATABLE            =
    =================================*/

    var $dt_primary_key = 'servicecharges_id';
    var $dt_table = 'servicecharges'; //nama tabel dari database
    var $column_order = array(null,'charges_types_name','servicecharges.servicecharges_flightNumber','servicecharges.servicecharges_requestor','servicecharges.servicecharges_requestordatetime','servicecharges.servicecharges_status',null); //field yang ada di table user
    var $column_search = array('charges_types.name','servicecharges.servicecharges_flightNumber','servicecharges.servicecharges_requestor','servicecharges.servicecharges_requestordatetime','servicecharges.servicecharges_status'); //field yang diizin untuk pencarian 
    var $order = array('UPPER(servicecharges.created_at)' => 'desc'); // default order 

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

        $this->db->select('servicecharges.*, charges_types.name as charges_types_name');
        $this->db->from($this->dt_table);
        $this->db->where($this->dt_table.'.active', '1');
        $this->db->join('charges_types','servicecharges.servicecharges_ct_id = charges_types.ct_id','left');
 
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
        $this->db->where($this->dt_table.'.active', '1');
        $this->db->join('charges_types','servicecharges.servicecharges_ct_id = charges_types.ct_id','left');

        $c = $this->db->count_all_results();
        //echo $this->db->last_query();

        return $c;
    }
    
    /*=====  End of DATATABLE  ======*/
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
