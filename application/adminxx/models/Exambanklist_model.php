<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Exambanklist_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    exambanklist.*,
    examquestion.examquestion_content AS examquestion_content_exambanklist_examquestion_id', false);
        $this->db->where('exambanklist_deleted_at');
        $this->db->order_by('exambanklist.exambanklist_id', 'DESC');
        $this->db->from('exambanklist');
        $this->db->join('examquestion', 'examquestion.examquestion_id = exambanklist.exambanklist_examquestion_id', 'left');

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
        $this->db->select('
    exambanklist.*,
    examquestion.examquestion_content AS examquestion_content_exambanklist_examquestion_id', false);
        $this->db->where('exambanklist_deleted_at');
        $this->db->where('exambanklist_exambank_id', $id);
        $this->db->order_by('exambanklist.exambanklist_id', 'DESC');
        $this->db->from('exambanklist');
        $this->db->join('examquestion', 'examquestion.examquestion_id = exambanklist.exambanklist_examquestion_id', 'left');

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
        $this->db->where('exambanklist.exambanklist_id', $id);
        $this->db->where('exambanklist_deleted_at');
        $this->db->from('exambanklist');

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
    exambanklist.*,
    examquestion.examquestion_content AS examquestion_content_exambanklist_examquestion_id', false);
        $this->db->where('exambanklist.exambanklist_id', $id);
        $this->db->where('exambanklist_deleted_at');
        $this->db->from('exambanklist');
        $this->db->join('examquestion', 'examquestion.examquestion_id = exambanklist.exambanklist_examquestion_id', 'left');

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
        $this->db->insert('exambanklist', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('exambanklist_id', $id);
        $this->db->update('exambanklist', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('exambanklist_exambank_id', $id);
        $this->db->delete('exambanklist');
    }

    public function delete_batch($id, $arrayid)
    {
        $this->db->where('exambanklist_exambank_id', $id);
        $this->db->where_in('exambanklist_examquestion_id', $arrayid);
        $this->db->delete('exambanklist');
    }

    public function get_all_examquestion()
    {
        $this->db->select('*');
        $this->db->where('examquestion_compulsory', 'n');
        $this->db->order_by('examquestion_id', 'ASC');
        $this->db->from('examquestion');
        return $query = $this->db->get()->result();
    }

    public function get_selected_examquestion($id)
    {
        $this->db->select('exambanklist_examquestion_id');
        $this->db->where('exambanklist_exambank_id', $id);
        $this->db->order_by('exambanklist_id', 'ASC');
        $this->db->from('exambanklist');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    examquestion.*,
    examquestion.examquestion_content AS examquestion_content_exambanklist_examquestion_id', false);
        $this->db->where('examquestion_deleted_at');
        $this->db->where('examquestion_compulsory', 'y');
        $this->db->from('examquestion');
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
            $this->db->order_by('examquestion.examquestion_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function listajax_general($id, $columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    exambanklist.*,
    examquestion.examquestion_content AS examquestion_content_exambanklist_examquestion_id', false);
        $this->db->where('exambanklist_deleted_at');
        $this->db->where('exambanklist_exambank_id', $id);
        $this->db->where('examquestion_compulsory', 'n');
        $this->db->from('exambanklist');
        $this->db->join('examquestion', 'examquestion.examquestion_id = exambanklist.exambanklist_examquestion_id', 'left');
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
            $this->db->order_by('exambanklist.exambanklist_id', 'DESC');
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
        $this->db->where('examquestion_compulsory', 'y');
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
        $this->db->where('examquestion_compulsory', 'y');
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

    public function recordsTotal_general($id)
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('exambanklist');

        $this->db->where('exambanklist_deleted_at');
        $this->db->where('exambanklist_exambank_id', $id);
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_general($id, $columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('exambanklist');

        $this->db->where('exambanklist_deleted_at');
        $this->db->where('exambanklist_exambank_id', $id);
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
