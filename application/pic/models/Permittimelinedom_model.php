<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permittimelinedom_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    permit_timeline.*,
    userlist.user_name AS user_name_permit_timeline_userid,
    permit_status.permit_status_desc AS permit_status_desc_permit_timeline_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_timeline_officialstatus', false);
        $this->db->where('permit_timeline_deleted_at');
        $this->db->order_by('permit_timeline.permit_timeline_id', 'DESC');
        $this->db->from('permit_timeline');
        $this->db->join('userlist', 'userlist.user_id = permit_timeline.permit_timeline_userid', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit_timeline.permit_timeline_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit_timeline.permit_timeline_officialstatus', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_all_by_permitid($id)
    {
        $this->db->select('
    permit_timeline.*,
    userlist.user_name AS user_name_permit_timeline_userid,
    permit_status.permit_status_desc AS permit_status_desc_permit_timeline_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_timeline_officialstatus', false);
        $this->db->distinct();
        $this->db->where('permit_timeline_permitid', $id);
        $this->db->where('permit_timeline_deleted_at');
        $this->db->order_by('permit_timeline.permit_timeline_id', 'DESC');
        $this->db->from('permit_timeline');
        $this->db->join('userlist', 'userlist.user_id = permit_timeline.permit_timeline_userid', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit_timeline.permit_timeline_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit_timeline.permit_timeline_officialstatus', 'left');

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
        $this->db->where('permit_timeline.permit_timeline_id', $id);
        $this->db->where('permit_timeline_deleted_at');
        $this->db->from('permit_timeline');

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
    permit_timeline.*,
    userlist.user_name AS user_name_permit_timeline_userid,
    permit_status.permit_status_desc AS permit_status_desc_permit_timeline_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_timeline_officialstatus', false);
        $this->db->where('permit_timeline.permit_timeline_id', $id);
        $this->db->where('permit_timeline_deleted_at');
        $this->db->from('permit_timeline');
        $this->db->join('userlist', 'userlist.user_id = permit_timeline.permit_timeline_userid', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit_timeline.permit_timeline_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit_timeline.permit_timeline_officialstatus', 'left');

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
        $this->db->insert('permit_timeline', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('permit_timeline_id', $id);
        $this->db->update('permit_timeline', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('permit_timeline_id', $id);
        $this->db->delete('permit_timeline');
    }

    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->order_by('user_id', 'ASC');
        $this->db->from('userlist');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_status()
    {
        $this->db->select('*');
        $this->db->order_by('permit_status_name', 'ASC');
        $this->db->from('permit_status');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_officialstatus()
    {
        $this->db->select('*');
        $this->db->order_by('permit_officialstatus_id', 'ASC');
        $this->db->from('permit_officialstatus');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit_timeline.*,
    userlist.user_name AS user_name_permit_timeline_userid,
    permit_status.permit_status_desc AS permit_status_desc_permit_timeline_status,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name_permit_timeline_officialstatus', false);
        $this->db->where('permit_timeline_deleted_at');
        $this->db->from('permit_timeline');
        $this->db->join('userlist', 'userlist.user_id = permit_timeline.permit_timeline_userid', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit_timeline.permit_timeline_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit_timeline.permit_timeline_officialstatus', 'left');

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
            $this->db->order_by('permit_timeline.permit_timeline_id', 'DESC');
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
        $this->db->from('permit_timeline');

        $this->db->where('permit_timeline_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit_timeline');

        $this->db->where('permit_timeline_deleted_at');
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
