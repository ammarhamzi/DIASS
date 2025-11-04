<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Foundation_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('*', false);
        $this->db->where('config_deleted_at');
        $this->db->order_by('config_id', 'ASC');
        $this->db->from('config');
        return $query = $this->db->get()->result();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('config_id', $id);
        $this->db->where('config_deleted_at');
        $this->db->from('config');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('config_id', $id);
        $this->db->where('config_deleted_at');
        $this->db->from('config');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('config', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('config_name', $id);
        $this->db->update('config', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('config_id', $id);
        $this->db->delete('config');
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
