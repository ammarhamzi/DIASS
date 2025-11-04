<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pcapermit_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('*', false);
        $this->db->order_by('pcapermit_id', 'DESC');
        $this->db->from('pcapermit');

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
        $this->db->where('pcapermit_id', $id);
        $this->db->from('pcapermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function get_all_by_date($date)
    {
        $this->db->select('pcapermit.*, driver.*, company.*');
        $this->db->where('pcapermit_course_date', $date);
        $this->db->join('driver', 'driver.driver_id = pcapermit.pcapermit_driver_id', 'left');
        $this->db->join('company', 'company.company_id = driver.driver_company_id', 'left');
        $this->db->from('pcapermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('pcapermit_id', $id);
        $this->db->from('pcapermit');

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
        $this->db->where('pcapermit_permit_id', $id);
        $this->db->from('pcapermit');

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
        $this->db->insert('pcapermit', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('pcapermit_id', $id);
        $this->db->update('pcapermit', $data);
    }

    public function update_by_permitid($id, $data)
    {
        $this->db->where('pcapermit_permit_id', $id);
        $this->db->update('pcapermit', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('pcapermit_id', $id);
        $this->db->delete('pcapermit');
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('*', false);
        $this->db->from('pcapermit');

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
            $this->db->order_by('pcapermit_id', 'DESC');
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
        $this->db->from('pcapermit');

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('pcapermit');

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
