<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permit_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->order_by('permit.permit_id', 'DESC');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function permit_summary()
    {
        $this->db->select('permit_typeid, permit_type_desc, permit_type_name, count(permit_typeid) as total');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->group_by('permit_typeid, permit_type_desc, permit_type_name, permit_typeid');
        $this->db->order_by('permit_typeid', 'asc');
        $this->db->from('permit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function adppermit_summary(){
        $this->db->select('adppermit_verifybymahb_drivingarea, count(adppermit_id) as total');
        $this->db->join('permit', 'permit.permit_id = adppermit.adppermit_permit_id', 'left');
        $this->db->where('permit.permit_typeid', 1);
        $this->db->where('permit.permit_deleted_at');
        $this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->group_by('adppermit_verifybymahb_drivingarea','adppermit_id');
        $this->db->order_by('adppermit_verifybymahb_drivingarea', 'asc');
        $this->db->from('adppermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function avppermit_summary(){
        $this->db->select('avppermit_avpcategory, count(avppermit_id) as total');
        $this->db->join('permit', 'permit.permit_id = avppermit.avppermit_permit_id', 'left');
        $this->db->where('permit.permit_typeid', 4);
        $this->db->where('permit.permit_deleted_at');
        $this->db->where('permit.permit_officialstatus', 'completed');
        $this->db->group_by('avppermit_avpcategory','avppermit_id');
        $this->db->order_by('avppermit_avpcategory', 'asc');
        $this->db->from('avppermit');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function permit_pending_checkdoc()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_officialstatus', 'pending');
        $this->db->group_start();
        $this->db->where('permit_typeid', '1');
        $this->db->or_where('permit_typeid', '2');
        $this->db->or_where('permit_typeid', '5');
        $this->db->or_where('permit_typeid', '6');
        $this->db->or_where('permit_typeid', '7');
        $this->db->or_where('permit_typeid', '8');
        $this->db->group_end();
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_pending_checkdocvehicle()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_officialstatus', 'pending');
        $this->db->group_start();
        $this->db->where('permit_typeid', '3');
        $this->db->or_where('permit_typeid', '4');
        $this->db->or_where('permit_typeid', '9');
        $this->db->or_where('permit_typeid', '10');
        $this->db->or_where('permit_typeid', '11');
        $this->db->or_where('permit_typeid', '12');
        $this->db->or_where('permit_typeid', '13');
        $this->db->group_end();
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_pending_approval()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_status', 'approvalairsidepending');
        $this->db->where('permit.permit_officialstatus', 'inprogress');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_expired()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_status', 'permitexpired');
        $this->db->where('permit.permit_officialstatus', 'expired');
        $this->db->where('permit.permit_deleted_at IS NULL', NULL, FALSE);
        $this->db->from('permit');

        $query = $this->db->get();
        
        if ($query === FALSE) {
            log_message('error', 'permit_expired query failed: ' . $this->db->last_query());
            return 0;
        }
        
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_replace_terminate()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->group_start();
        $this->db->where('permit.permit_status', 'permitterminationpending');
        $this->db->or_where('permit.permit_status', 'permitreplacementpending');
        $this->db->group_end();
        $this->db->where('permit.permit_officialstatus', 'pending');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_terminate()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_status', 'permitterminationpending');
        $this->db->where('permit.permit_officialstatus', 'pending');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_cancel()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_status', 'permitcancellation');
        $this->db->where('permit.permit_officialstatus', 'canceled');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_replace()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_status', 'permitreplacementpending');
        $this->db->where('permit.permit_officialstatus', 'pending');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_pending_payment()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_status', 'paymentpending');
        $this->db->where('permit.permit_officialstatus', 'pendingpayment');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

    public function permit_uncollected()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('permit.permit_status', 'paid');
        $this->db->where('permit.permit_officialstatus', 'paid');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

        $query = $this->db->get();
        if ($query === FALSE) {
            return 0;
        }
        $row = $query->row();
        return $row ? (int)$row->count : 0;

    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');

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
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
        $this->db->insert('permit', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('permit_id', $id);
        $this->db->update('permit', $data);
    }

    public function update_only_inprogress($id, $data)
    {
        $this->db->where('permit_id', $id);
        $this->db->where('permit_officialstatus', 'inprogress');
        $this->db->update('permit', $data);
    }

    public function update_to_expired(){
    $now = date('Y-m-d H:i:s');
$data = array(
        'permit_officialstatus' => 'expired',
        'permit_status' => 'permitexpired',
        'permit_updated_at' => $now,
);

$this->db->where('permit_issuance_expirydate <', $now);
/*$this->db->where('permit_status <> ', 'permitterminationpending');
$this->db->where('permit_status <> ', 'permitterminated');
$this->db->where('permit_status <> ', 'permitexpired');*/
$this->db->where('permit_status', 'completed');
$this->db->update('permit', $data);
    }

// delete datav permitterminationpending
    public function delete($id)
    {
        $this->db->where('permit_id', $id);
        $this->db->delete('permit');
    }

    public function get_all_permit_group()
    {
        $this->db->select('*');
        $this->db->order_by('permit_group_id', 'ASC');
        $this->db->from('permit_group');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_type()
    {
        $this->db->select('*');
        $this->db->order_by('permit_type_id', 'ASC');
        $this->db->from('permit_type');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit_condition()
    {
        $this->db->select('*');
        $this->db->order_by('permit_condition_id', 'ASC');
        $this->db->from('permit_condition');
        return $query = $this->db->get()->result();
    }

    public function get_all_pic()
    {
        $this->db->select('*');
        $this->db->order_by('pic_id', 'ASC');
        $this->db->from('pic');
        return $query = $this->db->get()->result();
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
        $this->db->order_by('permit_officialstatus_name', 'ASC');
        $this->db->from('permit_officialstatus');
        return $query = $this->db->get()->result();
    }

/* --------- TOTAL PERMIT ---------------- */
    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
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
        $this->db->from('permit');

        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');

        $this->db->where('permit_deleted_at IS NULL');
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

/* ----- ADP PERMIT--------- */

    public function listajax_adp($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '1');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_adp()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '1');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_adp($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '1');
        $this->db->where('permit_deleted_at IS NULL');
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

/* ----- EVDP PERMIT ---------- */

    public function listajax_evdp($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '2');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_evdp()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '2');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_evdp($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '2');
        $this->db->where('permit_deleted_at IS NULL');
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

    public function listajax_pbb($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '5');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_pbb()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '5');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_pbb($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '5');
        $this->db->where('permit_deleted_at IS NULL');
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

    public function listajax_sh($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '11');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_sh()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '11');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_sh($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '11');
        $this->db->where('permit_deleted_at IS NULL');
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

    public function listajax_vdgs($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '6');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_vdgs()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '6');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_vdgs($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '6');
        $this->db->where('permit_deleted_at IS NULL');
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

    public function listajax_cs($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '10');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_cs()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '10');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_cs($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '10');
        $this->db->where('permit_deleted_at IS NULL');
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

    public function listajax_gpu($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '8');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_gpu()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '8');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_gpu($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '8');
        $this->db->where('permit_deleted_at IS NULL');
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

    public function listajax_pca($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '7');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_pca()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '7');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_pca($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '7');
        $this->db->where('permit_deleted_at IS NULL');
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

/* ----- WIPBRIEFING PERMIT ---------- */

    public function listajax_wipbriefing($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name_permit_groupid,
    permit_type.permit_type_name AS permit_type_name_permit_typeid,
    permit_condition.permit_condition_name AS permit_condition_name_permit_condition,
    pic.pic_fullname AS pic_fullname_permit_picid,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc_permit_status', false);
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '12');
        $this->db->where('permit_deleted_at IS NULL');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');

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
            $this->db->order_by('permit.permit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal_wipbriefing()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '12');
        $this->db->where('permit_deleted_at IS NULL');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered_wipbriefing($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->where('permit_officialstatus', 'completed');
        $this->db->where('permit_typeid', '12');
        $this->db->where('permit_deleted_at IS NULL');
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
