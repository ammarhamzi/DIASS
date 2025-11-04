<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adppermit_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('*', false);
        $this->db->order_by('adppermit_id', 'DESC');
        $this->db->from('adppermit');

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
        $this->db->where('adppermit_id', $id);
        $this->db->from('adppermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('adppermit_id', $id);
        $this->db->from('adppermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function get_read_by_permitid($id)
    {
        $this->db->select('*', false);
        $this->db->where('adppermit_permit_id', $id);
        $this->db->from('adppermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }
    
    public function get_exam_results($id)
    {
        $this->db->select('
            examsession.examsession_totalmark totalmark,
            examsession.examsession_question_count question_count
        ');
        $this->db->from('examtaker');
        $this->db->join('examsession', 'examtaker.examtaker_id = examsession.examsession_examtaker_id', 'left');
        $this->db->where('examtaker.examtaker_permit_id', $id);
        $this->db->order_by('examsession.examsession_id', 'DESC');        

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
        $this->db->insert('adppermit', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('adppermit_id', $id);
        $this->db->update('adppermit', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('adppermit_id', $id);
        $this->db->delete('adppermit');
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('*', false);
        $this->db->from('adppermit');

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
            $this->db->order_by('adppermit_id', 'DESC');
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
        $this->db->from('adppermit');

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('adppermit');

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
