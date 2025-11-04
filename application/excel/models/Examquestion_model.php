<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Examquestion_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    examquestion.*,
    examtopic.examtopic_title AS examtopic_title_examquestion_examtopic_id', false);
        $this->db->where('examquestion_deleted_at');
        $this->db->order_by('examquestion.examquestion_id', 'DESC');
        $this->db->from('examquestion');
        $this->db->join('examtopic', 'examtopic.examtopic_id = examquestion.examquestion_examtopic_id', 'left');

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
        $this->db->where('examquestion.examquestion_id', $id);
        $this->db->where('examquestion_deleted_at');
        $this->db->from('examquestion');

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
    examquestion.*,
    examtopic.examtopic_title AS examtopic_title_examquestion_examtopic_id', false);
        $this->db->where('examquestion.examquestion_id', $id);
        $this->db->where('examquestion_deleted_at');
        $this->db->from('examquestion');
        $this->db->join('examtopic', 'examtopic.examtopic_id = examquestion.examquestion_examtopic_id', 'left');

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
        $this->db->insert('examquestion', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('examquestion_id', $id);
        $this->db->update('examquestion', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('examquestion_id', $id);
        $this->db->delete('examquestion');
    }

    public function get_all_examtopic()
    {
        $this->db->select('*');
        $this->db->order_by('examtopic_id', 'ASC');
        $this->db->from('examtopic');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    examquestion.*,
    case examquestion_compulsory
    when \'n\' then \'No\'
    when \'y\' then \'Yes\'
    end as examquestion_compulsory,
    examtopic.examtopic_title AS examtopic_title_examquestion_examtopic_id', false);
        $this->db->where('examquestion_deleted_at');
        $this->db->from('examquestion');
        $this->db->join('examtopic', 'examtopic.examtopic_id = examquestion.examquestion_examtopic_id', 'left');

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
            $this->db->order_by('examquestion.examquestion_id', 'DESC');
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
        $this->db->from('examquestion');

        $this->db->where('examquestion_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('examquestion');

        $this->db->where('examquestion_deleted_at');
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
