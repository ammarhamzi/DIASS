<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Password_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->from('userlist');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('user_id', $id);
        $this->db->from('userlist');
        return $query = $this->db->get()->row();
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('userlist', $data);
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
