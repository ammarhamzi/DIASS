<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Fullcalendar_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('calendar_id as id, calendar_title as title, calendar_start as start, calendar_end as end',
            false);
        $this->db->order_by('calendar_id', 'DESC');
        $this->db->from('calendar');

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
        $this->db->where('field_m_primary', $id);
        $this->db->from('master_table');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_read($id)
    {
        $this->db->select('*,
    case field_m_boolean
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as field_m_boolean', false);
        $this->db->where('field_m_primary', $id);
        $this->db->from('master_table');

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
        $this->db->insert('calendar', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('calendar_id', $id);
        $this->db->update('calendar', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('calendar_id', $id);
        $this->db->delete('calendar');
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "",
        $sorttype = "") {
        $i = 0;
        $this->db->select('*,
    case field_m_boolean
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as field_m_boolean', false);
        $this->db->from('master_table');

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
            $this->db->order_by('field_m_primary', 'DESC');
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
        $this->db->from('master_table');

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('master_table');

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
