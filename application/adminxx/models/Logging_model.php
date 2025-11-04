<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Logging_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    logging.*,
    userlist.user_username AS user_username_user_id', false);
        $this->db->order_by('logging.id', 'DESC');
        $this->db->from('logging');
        $this->db->join('userlist', 'userlist.user_id = logging.user_id', 'left');
        return $query = $this->db->get()->result();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('logging.id', $id);
        $this->db->from('logging');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('
    logging.*,
    userlist.user_username AS user_username_user_id', false);
        $this->db->where('logging.id', $id);
        $this->db->from('logging');
        $this->db->join('userlist', 'userlist.user_id = logging.user_id', 'left');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('logging', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('logging', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('logging');
    }

    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->order_by('user_id', 'ASC');
        $this->db->from('userlist');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "",
        $sorttype = "") {
        $i = 0;
        $this->db->select('
    logging.*,
    userlist.user_username AS user_username_user_id', false);
        $this->db->from('logging');
        $this->db->join('userlist', 'userlist.user_id = logging.user_id', 'left');

        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("logging.$column like", "%$filter%");
            } else {
                $this->db->or_where("logging.$column like", "%$filter%");
            }

            $i++;
        }
        if ($sort != "") {
            $this->db->order_by('logging.datetime_query', $sorttype);
        } else {
            $this->db->order_by('logging.datetime_query', 'DESC');
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
        $this->db->from('logging');

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('logging');

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
