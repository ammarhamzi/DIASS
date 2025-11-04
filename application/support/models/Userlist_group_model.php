<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Userlist_group_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($user_id)
    {
        $this->db->select('*', false);
        $this->db->where('user_id',$user_id);
        $this->db->order_by('group_id', 'DESC');
        $this->db->from('userlist_group');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function insert_all($user_id,$groupID_arr)
    {
        $data = array();
        foreach($groupID_arr as $r)
        {
            $data[] = array(
                "user_id"=>$user_id,
                "group_id"=>$r,
            );
        }
       
        if(count($data) > 0)
        {
            $this->db->insert_batch('userlist_group', $data);
        }
    }

    public function delete_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('userlist_group');
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('userlist.user_id', $id);
        $this->db->where('user_deleted_at');
        $this->db->from('userlist');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_read($id)
    {
        $this->db->select('
    userlist.*, usergroup.usergroup_name AS usergroup_name_user_groupid', false);
        $this->db->where('userlist.user_id', $id);
        $this->db->where('user_deleted_at');
        $this->db->from('userlist');
        $this->db->join('usergroup',
            'usergroup.usergroup_id = userlist.user_groupid', 'left');

        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_group_id_name($groupid_txt)
    {
        $groupid_arr = explode(',', $groupid_txt);
        $this->db->select('*', false);
        $this->db->where_in('usergroup_id', $groupid_arr);
        $this->db->from('usergroup');

        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('userlist', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('userlist', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('userlist');
    }

    
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
