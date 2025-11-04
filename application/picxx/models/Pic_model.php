<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pic_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    pic.*,
    company.company_name AS company_name_pic_company_id', false);
        $this->db->where('pic_deleted_at');
        $this->db->order_by('pic.pic_id', 'DESC');
        $this->db->from('pic');
        $this->db->join('company', 'company.company_id = pic.pic_company_id', 'left');

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
        $this->db->where('pic.pic_id', $id);
        $this->db->where('pic_deleted_at');
        $this->db->from('pic');

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
    pic.*,
    company.company_name AS company_name_pic_company_id', false);
        $this->db->where('pic.pic_id', $id);
        $this->db->where('pic_deleted_at');
        $this->db->from('pic');
        $this->db->join('company', 'company.company_id = pic.pic_company_id', 'left');

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
        $this->db->insert('pic', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('pic_id', $id);
        $this->db->update('pic', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('pic_id', $id);
        $this->db->delete('pic');
    }

    public function get_all_company()
    {
        $this->db->select('*');
        $this->db->order_by('company_id', 'ASC');
        $this->db->from('company');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    pic.*,
    company.company_name AS company_name_pic_company_id', false);
        $this->db->where('pic_deleted_at');
        $this->db->from('pic');
        $this->db->join('company', 'company.company_id = pic.pic_company_id', 'left');

        $this->db->group_start();
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->where("$column like", "%$filter%");
            }

            $i++;
        }
        $this->db->group_end();
        if ($sort != "") {
            $this->db->order_by($sort, $sorttype);
        } else {
            $this->db->order_by('pic.pic_id', 'DESC');
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
        $this->db->from('pic');
        $this->db->join('company', 'company.company_id = pic.pic_company_id', 'left');
        $this->db->where('pic_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('pic');
        $this->db->join('company', 'company.company_id = pic.pic_company_id', 'left');
        $this->db->where('pic_deleted_at');
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->where("$column like", "%$filter%");
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
