<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controllerpermission_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    controller_permission.*,
    reg_controller.control_name AS control_name_cp_controller_id,
    usergroup.usergroup_name AS usergroup_name_cp_usergroup,
    case showlist
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as showlist,
    case cp_create
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_create,
    case cp_update
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_update,
    case cp_delete
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_delete,
    case cp_read
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_read,
    case printlist
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as printlist', false);
        $this->db->where('cp_deleted_at');
        $this->db->order_by('controller_permission.cp_usergroup', 'ASC');
        $this->db->from('controller_permission');
        $this->db->join('reg_controller',
            'reg_controller.control_id = controller_permission.cp_controller_id',
            'left');
        $this->db->join('usergroup',
            'usergroup.usergroup_id = controller_permission.cp_usergroup',
            'left');

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
        $this->db->where('controller_permission.cp_id', $id);
        $this->db->where('cp_deleted_at');
        $this->db->from('controller_permission');

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
    controller_permission.*,
    reg_controller.control_name AS control_name_cp_controller_id,
    usergroup.usergroup_name AS usergroup_name_cp_usergroup,
    case showlist
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as showlist,
    case cp_create
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_create,
    case cp_update
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_update,
    case cp_delete
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_delete,
    case cp_read
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_read,
    case printlist
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as printlist,', false);
        $this->db->where('controller_permission.cp_id', $id);
        $this->db->where('cp_deleted_at');
        $this->db->from('controller_permission');
        $this->db->join('reg_controller',
            'reg_controller.control_id = controller_permission.cp_controller_id',
            'left');
        $this->db->join('usergroup',
            'usergroup.usergroup_id = controller_permission.cp_usergroup',
            'left');

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
        $this->db->insert('controller_permission', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('cp_id', $id);
        $this->db->update('controller_permission', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('cp_id', $id);
        $this->db->delete('controller_permission');
    }

    public function get_all_reg_controller()
    {
        $this->db->select('*');
        $this->db->order_by('control_id', 'ASC');
        $this->db->from('reg_controller');
        return $query = $this->db->get()->result();
    }

    public function get_all_usergroup()
    {
        $this->db->select('*');
        $this->db->order_by('usergroup_id', 'ASC');
        $this->db->from('usergroup');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "",
        $sorttype = "") {
        $i = 0;
        $this->db->select('
    controller_permission.*,
    reg_controller.control_name AS control_name_cp_controller_id,
    usergroup.usergroup_name AS usergroup_name_cp_usergroup,
    case showlist
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as showlist,
    case showlist
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as showlist,
    case cp_create
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_create,
    case cp_create
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as cp_create,
    case cp_update
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_update,
    case cp_update
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as cp_update,
    case cp_delete
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_delete,
    case cp_delete
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as cp_delete,
    case cp_read
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as cp_read,
    case cp_read
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as cp_read,
    case printlist
    when \'1\' then \'Show\'
    when \'0\' then \'Hidden\'
    end as printlist,
    case printlist
    when \'0\' then \'FALSE\'
    when \'1\' then \'TRUE\'
    end as printlist', false);
        $this->db->where('cp_deleted_at');
        $this->db->from('controller_permission');
        $this->db->join('reg_controller',
            'reg_controller.control_id = controller_permission.cp_controller_id',
            'left');
        $this->db->join('usergroup',
            'usergroup.usergroup_id = controller_permission.cp_usergroup',
            'left');

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
            $this->db->order_by('controller_permission.cp_usergroup', 'ASC');
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
        $this->db->from('controller_permission');

        $this->db->where('cp_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('controller_permission');

        $this->db->where('cp_deleted_at');
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
