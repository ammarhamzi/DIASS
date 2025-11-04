<?php

/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Driver_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// get all
    public function get_all() {
        $this->db->select('
    driver.*,
    ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id', false);
        $this->db->where('driver_deleted_at');
        $this->db->order_by('driver.driver_id', 'DESC');
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_all_companyhistory($id) {
//        $this->db->select('
//    drivercompanyhistory.*,driver.*,company.*,userlist.*', false);
        $this->db->select('company.company_name,userlist.user_username as user_username,drivercompanyhistory.drivercompanyhistory_created_at as vehiclecompanyhistory_created_at', false); 
        $this->db->where('drivercompanyhistory_driver_id', $id);
        $this->db->order_by('drivercompanyhistory.drivercompanyhistory_id', 'DESC');
        $this->db->from('drivercompanyhistory');
        $this->db->join('driver', 'driver.driver_id = drivercompanyhistory.drivercompanyhistory_driver_id');
        $this->db->join('company', 'company.company_id = drivercompanyhistory.drivercompanyhistory_company_id');
        $this->db->join('userlist', 'userlist.user_id = drivercompanyhistory.drivercompanyhistory_lastchanged_by');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

// get data by id
    public function get_by_id($id) {
        $this->db->select('
    driver.*,
    ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id', false);
        $this->db->where('driver.driver_id', $id);
        $this->db->where('driver_deleted_at');
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    // get data by adp driver id
    function get_by_adpdriver_id($id) {
//        if ($type == 1) { //ADP
            $this->db->select('p.*,ps.permit_status_desc', false);
            $this->db->where('a.adppermit_driver_id', $id);
            $this->db->where('p.permit_typeid', 1);
            $this->db->from('adppermit a');
            //$this->db->where('p.permit_deleted_at');
            $this->db->join('permit p', 'p.permit_id = a.adppermit_permit_id');
            $this->db->join('permit_status ps', 'p.permit_status = ps.permit_status_name');
            $this->db->order_by('p.permit_created_at', 'DESC');
            $this->db->limit(1, 0);
            //$query = $this->db->get();
//        } else { //EVDP
//            $this->db->select('p.*,ps.permit_status_desc', false);
//            $this->db->where('a.evdppermit_driver_id', $id);
//            $this->db->where('p.permit_typeid', 2);
//            $this->db->from('evdppermit a');
//            //$this->db->where('p.permit_deleted_at');
//            $this->db->join('permit p', 'p.permit_id = a.evdppermit_permit_id');
//            $this->db->join('permit_status ps', 'p.permit_status = ps.permit_status_name');
//            $this->db->order_by('p.permit_created_at', 'DESC');
//            $this->db->limit(1, 0);
//            $query2 = $this->db->get();
//        }
        
        
        //$this->db->limit(1, 0);
        $query = $this->db->get();
//$combine = array_merge($query->result(),$query2->result());
        //if (count($combine) >= 1) {
            if ($query->num_rows() >= 1) {
            return $query->result();
            //$newcombine = array_multisort( array_column($combine, "permit_created_at"), SORT_DESC, $combine );
            //$columns = array_column($combine, 'permit_created_at');
            //$newcombine = array_multisort($columns, SORT_DESC, $combine);
            //return $combine;
        } else {
            return false;
        }
    }
    
    // get data by adp driver id
    function get_by_evdpdriver_id($id) {
//        if ($type == 1) { //ADP
//            $this->db->select('p.*,ps.permit_status_desc', false);
//            $this->db->where('a.adppermit_driver_id', $id);
//            $this->db->where('p.permit_typeid', 1);
//            $this->db->from('adppermit a');
//            //$this->db->where('p.permit_deleted_at');
//            $this->db->join('permit p', 'p.permit_id = a.adppermit_permit_id');
//            $this->db->join('permit_status ps', 'p.permit_status = ps.permit_status_name');
//            $this->db->order_by('p.permit_created_at', 'DESC');
//            $this->db->limit(1, 0);
            //$query = $this->db->get();
//        } else { //EVDP
            $this->db->select('p.*,ps.permit_status_desc', false);
            $this->db->where('a.evdppermit_driver_id', $id);
            $this->db->where('p.permit_typeid', 2);
            $this->db->from('evdppermit a');
            //$this->db->where('p.permit_deleted_at');
            $this->db->join('permit p', 'p.permit_id = a.evdppermit_permit_id');
            $this->db->join('permit_status ps', 'p.permit_status = ps.permit_status_name');
            $this->db->order_by('p.permit_created_at', 'DESC');
            $this->db->limit(1, 0);
//            $query2 = $this->db->get();
//        }
        
        
        //$this->db->limit(1, 0);
        $query = $this->db->get();
//$combine = array_merge($query->result(),$query2->result());
        //if (count($combine) >= 1) {
            if ($query->num_rows() >= 1) {
            return $query->result();
            //$newcombine = array_multisort( array_column($combine, "permit_created_at"), SORT_DESC, $combine );
            //$columns = array_column($combine, 'permit_created_at');
            //$newcombine = array_multisort($columns, SORT_DESC, $combine);
            //return $combine;
        } else {
            return false;
        }
    }

    public function get_by_ic($id) {
        $this->db->select('
    driver.*,
    ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id', false);
        $this->db->where('driver.driver_ic', $id);
        $this->db->where('driver_deleted_at');
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_raw_by_id($id) {
        $this->db->select('
            driver.*,
            company.company_name,
            ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id', false);
        $this->db->where('driver.driver_id', $id);
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');
        $this->db->join('company', 'driver.driver_company_id = company.company_id', 'left');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_read($id) {
        $this->db->select('
    driver.*,
    ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id', false);
        $this->db->where('driver.driver_id', $id);
        $this->db->where('driver_deleted_at');
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

// insert data
    public function insert($data) {
        $this->db->insert('driver', $data);
    }

    public function createhistory($data) {
        $this->db->insert('drivercompanyhistory', $data);
    }

// update data
    public function update($id, $data) {
        $this->db->where('driver_id', $id);
        $this->db->update('driver', $data);
    }

// delete data
    public function delete($id) {
        $this->db->where('driver_id', $id);
        $this->db->delete('driver');
    }

    public function get_all_ref_country() {
        $this->db->select('*');
        $this->db->order_by('ref_country_id', 'ASC');
        $this->db->from('ref_country');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "") {
        $i = 0;
        $this->db->select('
    driver.*,company.*,
    ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id,
    permit_group.permit_group_name AS permit_group_name_driver_permit_typeid,
    activity_status.activity_status_name AS activity_status_name_driver_activity_statusid
    ', false);
        $this->db->where('driver_deleted_at');
        //$this->db->where('driver_company_id', $this->session->userdata('companyid'));
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id');
        $this->db->join('permit_group', 'permit_group.permit_group_id = driver.driver_permit_typeid', 'left');
        $this->db->join('activity_status', 'activity_status.activity_status_id = driver.driver_activity_statusid');
        $this->db->join('company', 'company.company_id = driver.driver_company_id');
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
            $this->db->order_by('driver.driver_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal() {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('driver');
        //$this->db->where('driver_company_id', $this->session->userdata('companyid'));
        $this->db->where('driver_deleted_at');
        $query = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "") {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('driver');
        //$this->db->where('driver_company_id', $this->session->userdata('companyid'));
        $this->db->where('driver_deleted_at');
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
        $query = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function get_companydriver($type = '') {
        $this->db->select('driver_id, driver_name, driver_ic');
        $this->db->where('driver_company_id', $this->session->userdata('companyid'));
        if ($type == 'adp') {
            $this->db->where('driver_drivertype', 'Driver (for Airside Driving Permit)');
        } elseif ($type == 'evdp') {
            $this->db->where('driver_drivertype', 'Driver (for Electrical Vehicle Driving Permit)');
        }
        $this->db->from('driver');
        return $query = $this->db->get()->result();
    }

    public function get_verifydriver($id) {
        $this->db->select('driver_id, driver_name, driver_activity_statusid');
        $this->db->where('driver_id', $id);
        $this->db->from('driver');
        return $query = $this->db->get()->row();
    }

    public function get_count_alldriver_bycompany($id) {
        $this->db->select('*');
        $this->db->where('driver.driver_company_id', $id);
        $this->db->where('driver_deleted_at');
        $this->db->from('driver');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function notexist_driver($ic) {
        $this->db->select('*');
        $this->db->where('driver.driver_ic', $ic);
        $this->db->where('driver_deleted_at');
        $this->db->from('driver');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}

/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
