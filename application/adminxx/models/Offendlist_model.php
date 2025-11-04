<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Offendlist_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        /*$this->db->select('offendlist.*, offendlist_category.off_cat_name');
        $this->db->where('offendlist.offendlist_deleted_at IS NULL');
        $this->db->join('offendlist_category','offendlist_category.off_cat_ref = offendlist.offendlist_offendtype','left');
        $this->db->from('offendlist');*/
        $this->db->select('offendlist_2020.*, offendlist_category.off_cat_name');
        $this->db->where('offendlist_2020.offendlist_deleted_at IS NULL');
        $this->db->join('offendlist_category','offendlist_category.off_cat_ref = offendlist_2020.offendlist_offendtype','left');
        $this->db->from('offendlist_2020');
        return $query = $this->db->get()->result();
    }

    function category_sort_inarray()
    {
        $q = $this->get_all();
        $output = array();
        foreach($q as $r)
        {
            $output[$r->offendlist_offendtype]["type"]=$r->off_cat_name;
            $output[$r->offendlist_offendtype]["child"][]=$r;
        }

        return $output;
    }

// get data by id
    public function get_by_id($id)
    {
        /*$this->db->select('*');
        $this->db->where('offendlist_id', $id);
        $this->db->from('offendlist');*/
        $this->db->select('*');
        $this->db->where('offendlist_id', $id);
        $this->db->from('offendlist_2020');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        /*$this->db->select('*', false);
        $this->db->where('offendlist_id', $id);
        $this->db->from('offendlist');*/
        $this->db->select('*', false);
        $this->db->where('offendlist_id', $id);
        $this->db->from('offendlist_2020');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('offendlist', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('offendlist_id', $id);
        $this->db->update('offendlist', $data);
    }

// delete data
    public function remove($id)
    {
        // $this->db->where('offendlist_id', $id);
        // $this->db->update('offendlist', array(
        //     "deleted_at"=>$this->session->id,
        //     "deleted_by"=>date('Y-m-d H:i:s'),
        //     "active"=>0,
        // ));
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
