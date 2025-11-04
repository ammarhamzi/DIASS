<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authentication_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->where('user_isactive', '1');
        $this->db->where('user_deleted_at');
        $this->db->from('userlist');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_login($username, $password, $role)
    {
        $this->db->select('userlist.*,userlist_group.group_id as userlist_group_id');
        $this->db->where('userlist.user_isactive', '1');
        $this->db->where('userlist.user_deleted_at');
        $this->db->where('userlist.user_username', $username);
        $this->db->where('userlist.user_password', $password);
        $this->db->where('userlist_group.group_id', $role);
        $this->db->join('userlist_group','userlist_group.user_id = userlist.user_id','left');
        $this->db->from('userlist');
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_login_basic($username, $password)
    {
        $this->db->select('userlist.*,userlist_group.group_id as userlist_group_id');
        $this->db->where('userlist.user_isactive', '1');
        $this->db->where('userlist.user_deleted_at');
        $this->db->where('userlist.user_username', $username);
        $this->db->where('userlist.user_password', $password);
        $this->db->join('userlist_group','userlist_group.user_id = userlist.user_id','left');
        $this->db->from('userlist');
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_verify($id)
    {

        $this->db->select('*');
        $this->db->where('user_isactive', '0');
        $this->db->where('user_id', $id);
        $this->db->from('userlist');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_exist($id)
    {

        $this->db->select('*');
        $this->db->where('user_isactive', '1');
        $this->db->where('user_id', $id);
        $this->db->from('userlist');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('userlist', $data);
    }

    public function get_by_email($email, $username)
    {
        $this->db->select('*');
        $this->db->where('user_email', $email);
        $this->db->where('user_username', $username);
        $this->db->from('userlist');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->user_id;
        } else {
            return false;
        }
    }
}
/* End of file Config_model.php */
/* Location: ./application/models/Config_model.php */
