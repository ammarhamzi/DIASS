<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examanswerlist_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('*,
    case examanswerlist_correctanswer
    when \'n\' then \'No\'
    when \'y\' then \'Yes\'
    end as examanswerlist_correctanswer', false);
        $this->db->where('examanswerlist_deleted_at');
        $this->db->order_by('examanswerlist_id', 'DESC');
        $this->db->from('examanswerlist');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

// get all filter by foreign id
    public function get_all_filter_fk($id)
    {
        $this->db->select('*,
    case examanswerlist_correctanswer
    when \'n\' then \'No\'
    when \'y\' then \'Yes\'
    end as examanswerlist_correctanswer', false);
        $this->db->where('examanswerlist_deleted_at');
        $this->db->where('examanswerlist_examquestion_id', $id);
        $this->db->order_by('examanswerlist_id', 'DESC');
        $this->db->from('examanswerlist');

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
        $this->db->where('examanswerlist_id', $id);
        $this->db->where('examanswerlist_deleted_at');
        $this->db->from('examanswerlist');

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
    case examanswerlist_correctanswer
    when \'n\' then \'No\'
    when \'y\' then \'Yes\'
    end as examanswerlist_correctanswer', false);
        $this->db->where('examanswerlist_id', $id);
        $this->db->where('examanswerlist_deleted_at');
        $this->db->from('examanswerlist');

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
        $this->db->insert('examanswerlist', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('examanswerlist_id', $id);
        $this->db->update('examanswerlist', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('examanswerlist_id', $id);
        $this->db->delete('examanswerlist');
    }

    public function listajax($id, $columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('*,
    case examanswerlist_correctanswer
    when \'n\' then \'No\'
    when \'y\' then \'Yes\'
    end as examanswerlist_correctanswer', false);
        $this->db->where('examanswerlist_deleted_at');
        $this->db->where('examanswerlist_examquestion_id', $id);
        $this->db->from('examanswerlist');
        $this->db->group_start();
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }

            $i++;
        }
        $this->db->group_end();
        if ($sort != "") {
            $this->db->order_by($sort, $sorttype);
        } else {
            $this->db->order_by('examanswerlist_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal($id)
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('examanswerlist');

        $this->db->where('examanswerlist_deleted_at');
        $this->db->where('examanswerlist_examquestion_id', $id);
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($id, $columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('examanswerlist');

        $this->db->where('examanswerlist_deleted_at');
        $this->db->where('examanswerlist_examquestion_id', $id);
        $this->db->group_start();
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }
            $i++;
        }
        $this->db->group_end();
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
