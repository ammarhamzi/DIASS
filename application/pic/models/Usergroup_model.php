<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usergroup_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    usergroup.*,
    usertype.usertype_name AS usertype_name_usergroup_type', false);
        $this->db->where('usergroup_deleted_at');
        $this->db->order_by('usergroup.usergroup_id', 'DESC');
        $this->db->from('usergroup');
        $this->db->join('usertype',
            'usertype.usertype_id = usergroup.usergroup_type', 'left');

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
        $this->db->where('usergroup.usergroup_id', $id);
        $this->db->where('usergroup_deleted_at');
        $this->db->from('usergroup');

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
    usergroup.*,
    usertype.usertype_name AS usertype_name_usergroup_type', false);
        $this->db->where('usergroup.usergroup_id', $id);
        $this->db->where('usergroup_deleted_at');
        $this->db->from('usergroup');
        $this->db->join('usertype',
            'usertype.usertype_id = usergroup.usergroup_type', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('usergroup', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('usergroup_id', $id);
        $this->db->update('usergroup', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('usergroup_id', $id);
        $this->db->delete('usergroup');
    }

    public function get_all_usertype()
    {
        $this->db->select('*');
        $this->db->order_by('usertype_id', 'ASC');
        $this->db->from('usertype');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "",
        $sorttype = "") {
        $i = 0;
        $this->db->select('
    usergroup.*,
    usertype.usertype_name AS usertype_name_usergroup_type', false);
        $this->db->where('usergroup_deleted_at');
        $this->db->from('usergroup');
        $this->db->join('usertype',
            'usertype.usertype_id = usergroup.usergroup_type', 'left');

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
            $this->db->order_by('usergroup.usergroup_id', 'DESC');
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
        $this->db->from('usergroup');

        $this->db->where('usergroup_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('usergroup');

        $this->db->where('usergroup_deleted_at');
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
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
