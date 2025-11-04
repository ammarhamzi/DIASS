<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Driver_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
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

// get data by id
    public function get_by_id($id)
    {
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

    public function get_raw_by_id($id)
    {
        $this->db->select('
            driver.*,
            company.company_name,
            ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id', false);
        $this->db->where('driver.driver_id', $id);
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');
        $this->db->join('company', 'driver.driver_company_id = company.company_id','left');
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
    public function insert($data)
    {
        $this->db->insert('driver', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('driver_id', $id);
        $this->db->update('driver', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('driver_id', $id);
        $this->db->delete('driver');
    }

    public function get_all_ref_country()
    {
        $this->db->select('*');
        $this->db->order_by('ref_country_id', 'ASC');
        $this->db->from('ref_country');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    driver.*,
    ref_country.ref_country_name AS ref_country_name_driver_nationality_country_id,
    permit_group.permit_group_name AS permit_group_name_driver_permit_typeid,
    activity_status.activity_status_name AS activity_status_name_driver_activity_statusid
    ', false);
        $this->db->where('driver_deleted_at');
        $this->db->where('driver_company_id', $this->session->userdata('companyid'));
        $this->db->from('driver');
        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');
        $this->db->join('permit_group', 'permit_group.permit_group_id = driver.driver_permit_typeid', 'left');
        $this->db->join('activity_status', 'activity_status.activity_status_id = driver.driver_activity_statusid', 'left');

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
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('driver');
        $this->db->where('driver_company_id', $this->session->userdata('companyid'));
        $this->db->where('driver_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('driver');
        $this->db->where('driver_company_id', $this->session->userdata('companyid'));
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
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function get_companydriver($type='')
    {
        $this->db->select('driver_id, driver_name, driver_ic');
        $this->db->where('driver_company_id', $this->session->userdata('companyid'));
        if($type=='adp'){
        $this->db->where('driver_drivertype', 'Driver (for Airside Driving Permit)');
        }elseif($type=='evdp'){
        $this->db->where('driver_drivertype', 'Driver (for Electrical Vehicle Driving Permit)');
        }
        $this->db->from('driver');
        return $query = $this->db->get()->result();
    }

    public function get_verifydriver($id)
    {
        $this->db->select('driver_id, driver_name, driver_activity_statusid');
        $this->db->where('driver_id', $id);
        $this->db->from('driver');
        return $query = $this->db->get()->row();
    }

    public function get_count_alldriver_bycompany($id)
    {
        $this->db->select('*');
        $this->db->where('driver.driver_company_id', $id);
        $this->db->where('driver_deleted_at');
        $this->db->from('driver');

        $query = $this->db->get();
        return $query->num_rows();

    }

    public function notexist_driver($ic)
    {
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
