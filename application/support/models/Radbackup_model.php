<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Radbackup_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all($controller)
    {
        $this->db->select('*', false);
        $this->db->where('radbackup_controller', $controller);
        $this->db->order_by('radbackup_id', 'DESC');
        $this->db->from('radbackup');
        return $query = $this->db->get()->result();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('radbackup_id', $id);
        $this->db->from('radbackup');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('radbackup_id', $id);
        $this->db->from('radbackup');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('radbackup', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('radbackup_id', $id);
        $this->db->update('radbackup', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('radbackup_id', $id);
        $this->db->delete('radbackup');
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "",
        $sorttype = "") {
        $i = 0;
        $this->db->select('*', false);
        $this->db->from('radbackup');

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
            $this->db->order_by('radbackup_id', 'DESC');
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
        $this->db->from('radbackup');

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('radbackup');

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
