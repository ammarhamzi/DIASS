<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mtwchecklist_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all($permittype)
    {
        if($permittype == 'wip' || $permittype == 'shins'){
          $permittype = 'tep';
        }
        $this->db->select('*', false);
        $this->db->where('mtwchecklist_deleted_at');
        $this->db->where('mtwchecklist_type', $permittype);
        $this->db->order_by('mtwchecklist_id', 'DESC');
        $this->db->from('mtwchecklist');

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
        $this->db->where('mtwchecklist_id', $id);
        $this->db->where('mtwchecklist_deleted_at');
        $this->db->from('mtwchecklist');

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
        $this->db->where('mtwchecklist_id', $id);
        $this->db->where('mtwchecklist_deleted_at');
        $this->db->from('mtwchecklist');

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
        $this->db->insert('mtwchecklist', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('mtwchecklist_id', $id);
        $this->db->update('mtwchecklist', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('mtwchecklist_id', $id);
        $this->db->delete('mtwchecklist');
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('*', false);
        $this->db->where('mtwchecklist_deleted_at');
        $this->db->from('mtwchecklist');

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
            $this->db->order_by('mtwchecklist_id', 'DESC');
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
        $this->db->from('mtwchecklist');

        $this->db->where('mtwchecklist_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('mtwchecklist');

        $this->db->where('mtwchecklist_deleted_at');
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

    public function copy_checklist($permitid, $type, $selected)
    {

        if ($type == 'avp') {
            $query = $this->db->select('mtwchecklist_group AS avpchecklist_group, mtwchecklist_name AS avpchecklist_name, mtwchecklist_desc AS avpchecklist_desc, mtwchecklist_required AS avpchecklist_required, mtwchecklist_id AS avpchecklist_mtwchecklist_id, \'' . $permitid . '\' AS avpchecklist_permit_id, \'' . date('Y-m-d H:i:s') . '\' AS avpchecklist_created_at, \'' . $this->session->userdata('id') . '\' AS avpchecklist_lastchanged_by', false)->where('mtwchecklist_type', $type)->get('mtwchecklist');
            foreach ($query->result() as $row) {
                $this->db->insert('avpchecklist', $row);
            }

            foreach ($selected as $id) {
                $this->db->where('avpchecklist_permit_id', $permitid);
                $this->db->where('avpchecklist_mtwchecklist_id', $id);
                $this->db->update('avpchecklist', ['avpchecklist_checked' => 'y']);
            }
        } elseif ($type == 'evp') {
            $query = $this->db->select('mtwchecklist_group AS evpchecklist_group, mtwchecklist_name AS evpchecklist_name, mtwchecklist_desc AS evpchecklist_desc, mtwchecklist_required AS evpchecklist_required, mtwchecklist_id AS evpchecklist_mtwchecklist_id, \'' . $permitid . '\' AS evpchecklist_permit_id, \'' . date('Y-m-d H:i:s') . '\' AS evpchecklist_created_at, \'' . $this->session->userdata('id') . '\' AS evpchecklist_lastchanged_by', false)->where('mtwchecklist_type', $type)->get('mtwchecklist');
            foreach ($query->result() as $row) {
                $this->db->insert('evpchecklist', $row);
            }
            foreach ($selected as $id) {
                $this->db->where('evpchecklist_permit_id', $permitid);
                $this->db->where('evpchecklist_mtwchecklist_id', $id);
                $this->db->update('evpchecklist', ['evpchecklist_checked' => 'y']);
            }
        } elseif ($type == 'wip') {
            $query = $this->db->select('mtwchecklist_group AS wipchecklist_group, mtwchecklist_name AS wipchecklist_name, mtwchecklist_desc AS wipchecklist_desc, mtwchecklist_required AS wipchecklist_required, mtwchecklist_id AS wipchecklist_mtwchecklist_id, \'' . $permitid . '\' AS wipchecklist_permit_id, \'' . date('Y-m-d H:i:s') . '\' AS wipchecklist_created_at, \'' . $this->session->userdata('id') . '\' AS wipchecklist_lastchanged_by', false)->where('mtwchecklist_type', 'tep')->get('mtwchecklist');
            foreach ($query->result() as $row) {
                $this->db->insert('wipchecklist', $row);
            }
            foreach ($selected as $id) {
                $this->db->where('wipchecklist_permit_id', $permitid);
                $this->db->where('wipchecklist_mtwchecklist_id', $id);
                $this->db->update('wipchecklist', ['wipchecklist_checked' => 'y']);
            }
        } elseif ($type == 'shins') {
            $query = $this->db->select('mtwchecklist_group AS shinschecklist_group, mtwchecklist_name AS shinschecklist_name, mtwchecklist_desc AS shinschecklist_desc, mtwchecklist_required AS shinschecklist_required, mtwchecklist_id AS shinschecklist_mtwchecklist_id, \'' .$permitid. '\' AS shinschecklist_permit_id, \'' .date('Y-m-d H:i:s'). '\' AS shinschecklist_created_at, \'' .$this->session->userdata('id'). '\' AS shinschecklist_lastchanged_by', false)->where('mtwchecklist_type', 'tep')->get('mtwchecklist');
            foreach ($query->result() as $row) {
                $this->db->insert('shinschecklist', $row);
            }
            foreach ($selected as $id) {
                $this->db->where('shinschecklist_permit_id', $permitid);
                $this->db->where('shinschecklist_mtwchecklist_id', $id);
                $this->db->update('shinschecklist', ['shinschecklist_checked' => 'y']);
            }
        }

    }

}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
