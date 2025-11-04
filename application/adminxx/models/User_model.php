<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('userlist.*', false);
        $this->db->where('user_deleted_at');
        $this->db->order_by('userlist.user_id', 'DESC');
        $this->db->from('userlist');
        // $this->db->join('usergroup','usergroup.usergroup_id = userlist.user_groupid', 'left'); ,usergroup.usergroup_name AS usergroup_name_user_groupid

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_all_staff()
    {
        $this->db->select('userlist.*', false);
        $this->db->where('user_deleted_at');
        $this->db->group_start();
        $this->db->where('user_customid');
        $this->db->or_where('user_customid','');
        $this->db->group_end();
        $this->db->order_by('userlist.user_id', 'DESC');
        $this->db->from('userlist');
        // $this->db->join('usergroup','usergroup.usergroup_id = userlist.user_groupid', 'left'); ,usergroup.usergroup_name AS usergroup_name_user_groupid

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
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

    public function notexist_user($username)
    {
        $this->db->select('*');
        $this->db->where('userlist.user_username', $username);
        $this->db->where('user_deleted_at');
        $this->db->from('userlist');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_read($id)
    {
        $this->db->select('userlist.*', false);
        $this->db->where('userlist.user_id', $id);
        $this->db->where('user_deleted_at');
        $this->db->from('userlist');
        // $this->db->join('usergroup','usergroup.usergroup_id = userlist.user_groupid', 'left'); , usergroup.usergroup_name AS usergroup_name_user_groupid

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

    public function update_customid($id, $data)
    {
        $this->db->where('user_customid', $id);
        $this->db->update('userlist', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('userlist');
    }

    public function get_all_usergroup_staff()
    {
        $this->db->select('*');
        $this->db->order_by('usergroup_id', 'ASC');
        $this->db->where('usergroup_deleted_at');
        $this->db->where('usergroup_isactive',1);
        $this->db->where('usergroup_type',1);
        $this->db->from('usergroup');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "",
        $sorttype = "") {
        $i = 0;
        $this->db->select('
    userlist.*,
    usergroup.usergroup_name AS usergroup_name_user_groupid', false);
        $this->db->where('user_deleted_at');
        $this->db->from('userlist');
        $this->db->join('usergroup',
            'usergroup.usergroup_id = userlist.user_groupid', 'left');

        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }

            $i++;
        }
        if ($sort != "") {
            $this->db->order_by($sort, $sorttype);
        } else {
            $this->db->order_by('userlist.user_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('userlist');

        $this->db->where('user_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('userlist');

        $this->db->where('user_deleted_at');
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }
            $i++;
        }
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function get_pic($companyid)
    {
        $this->db->select('
    pic.*', false);
        $this->db->where('pic_deleted_at');
        $this->db->where('pic_company_id',$companyid);
        $this->db->from('pic');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
