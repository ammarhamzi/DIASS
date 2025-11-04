<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Uploadfiles_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    uploadfiles.*,
    company.company_name AS company_name_uploadfiles_company_id,
    permit.permit_bookingid AS permit_bookingid_uploadfiles_permit_id,
    driver.driver_name AS driver_name_uploadfiles_driver_id,
    vehicle.vehicle_registration_no AS vehicle_registration_no_uploadfiles_vehicle_id', false);
        $this->db->where('uploadfiles_deleted_at');
        $this->db->order_by('uploadfiles.uploadfiles_id', 'DESC');
        $this->db->from('uploadfiles');
        $this->db->join('company', 'company.company_id = uploadfiles.uploadfiles_company_id', 'left');
        $this->db->join('permit', 'permit.permit_id = uploadfiles.uploadfiles_permit_id', 'left');
        $this->db->join('driver', 'driver.driver_id = uploadfiles.uploadfiles_driver_id', 'left');
        $this->db->join('vehicle', 'vehicle.vehicle_id = uploadfiles.uploadfiles_vehicle_id', 'left');

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
        $this->db->where('uploadfiles.uploadfiles_id', $id);
        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function get_photo_by_driverid($id)
    {
        $this->db->select('*');
        $this->db->where('uploadfiles.uploadfiles_driver_id', $id);
        $this->db->where('uploadfiles.uploadfiles_processtype', 'driver_photo');
        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function get_all_by_permitid($id, $processtype = '')
    {
        $this->db->select('
    uploadfiles.*,
    company.company_name AS company_name_uploadfiles_company_id,
    permit.permit_bookingid AS permit_bookingid_uploadfiles_permit_id,
    driver.driver_name AS driver_name_uploadfiles_driver_id,
    vehicle.vehicle_registration_no AS vehicle_registration_no_uploadfiles_vehicle_id', false);
        $this->db->where('uploadfiles.uploadfiles_permit_id', $id);
        if ($processtype != "") {
            $this->db->where('uploadfiles.uploadfiles_processtype', $processtype);
        }
        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');
        $this->db->join('company', 'company.company_id = uploadfiles.uploadfiles_company_id', 'left');
        $this->db->join('permit', 'permit.permit_id = uploadfiles.uploadfiles_permit_id', 'left');
        $this->db->join('driver', 'driver.driver_id = uploadfiles.uploadfiles_driver_id', 'left');
        $this->db->join('vehicle', 'vehicle.vehicle_id = uploadfiles.uploadfiles_vehicle_id', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_allother_by_permitid($id)
    {
        $this->db->select('
    uploadfiles.*,
    company.company_name AS company_name_uploadfiles_company_id,
    permit.permit_bookingid AS permit_bookingid_uploadfiles_permit_id,
    driver.driver_name AS driver_name_uploadfiles_driver_id,
    vehicle.vehicle_registration_no AS vehicle_registration_no_uploadfiles_vehicle_id', false);
        $this->db->where('uploadfiles.uploadfiles_permit_id', $id);

            $this->db->where_in('uploadfiles.uploadfiles_processtype', ['permit_termination','permit_replacement']);

        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');
        $this->db->join('company', 'company.company_id = uploadfiles.uploadfiles_company_id', 'left');
        $this->db->join('permit', 'permit.permit_id = uploadfiles.uploadfiles_permit_id', 'left');
        $this->db->join('driver', 'driver.driver_id = uploadfiles.uploadfiles_driver_id', 'left');
        $this->db->join('vehicle', 'vehicle.vehicle_id = uploadfiles.uploadfiles_vehicle_id', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function get_read($id)
    {
        $this->db->select('
    uploadfiles.*,
    company.company_name AS company_name_uploadfiles_company_id,
    permit.permit_bookingid AS permit_bookingid_uploadfiles_permit_id,
    driver.driver_name AS driver_name_uploadfiles_driver_id,
    vehicle.vehicle_registration_no AS vehicle_registration_no_uploadfiles_vehicle_id', false);
        $this->db->where('uploadfiles.uploadfiles_id', $id);
        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');
        $this->db->join('company', 'company.company_id = uploadfiles.uploadfiles_company_id', 'left');
        $this->db->join('permit', 'permit.permit_id = uploadfiles.uploadfiles_permit_id', 'left');
        $this->db->join('driver', 'driver.driver_id = uploadfiles.uploadfiles_driver_id', 'left');
        $this->db->join('vehicle', 'vehicle.vehicle_id = uploadfiles.uploadfiles_vehicle_id', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

// insert data
    /*
     * Insert file data into the database
     * @param array the data for inserting into the table
     */
    public function insert($data = [])
    {
        $insert = $this->db->insert_batch('uploadfiles', $data);
        return $insert ? true : false;
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('uploadfiles_id', $id);
        $this->db->update('uploadfiles', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('uploadfiles_id', $id);
        $this->db->delete('uploadfiles');
    }

    public function get_all_company()
    {
        $this->db->select('*');
        $this->db->order_by('company_id', 'ASC');
        $this->db->from('company');
        return $query = $this->db->get()->result();
    }

    public function get_all_permit()
    {
        $this->db->select('*');
        $this->db->order_by('permit_id', 'ASC');
        $this->db->from('permit');
        return $query = $this->db->get()->result();
    }

    public function get_all_driver()
    {
        $this->db->select('*');
        $this->db->order_by('driver_id', 'ASC');
        $this->db->from('driver');
        return $query = $this->db->get()->result();
    }

    public function get_all_vehicle()
    {
        $this->db->select('*');
        $this->db->order_by('vehicle_id', 'ASC');
        $this->db->from('vehicle');
        return $query = $this->db->get()->result();
    }

/*    public function get_all_fixedfacilitiespermit()
    {
        $this->db->select('*');
        $this->db->order_by('fixedfacilitiespermit_id', 'ASC');
        $this->db->from('fixedfacilitiespermit');
        return $query = $this->db->get()->result();
    }*/

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {
        $i = 0;
        $this->db->select('
    uploadfiles.*,
    company.company_name AS company_name_uploadfiles_company_id,
    permit.permit_bookingid AS permit_bookingid_uploadfiles_permit_id,
    driver.driver_name AS driver_name_uploadfiles_driver_id,
    vehicle.vehicle_registration_no AS vehicle_registration_no_uploadfiles_vehicle_id', false);
        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');
        $this->db->join('company', 'company.company_id = uploadfiles.uploadfiles_company_id', 'left');
        $this->db->join('permit', 'permit.permit_id = uploadfiles.uploadfiles_permit_id', 'left');
        $this->db->join('driver', 'driver.driver_id = uploadfiles.uploadfiles_driver_id', 'left');
        $this->db->join('vehicle', 'vehicle.vehicle_id = uploadfiles.uploadfiles_vehicle_id', 'left');

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
            $this->db->order_by('uploadfiles.uploadfiles_id', 'DESC');
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
        $this->db->from('uploadfiles');

        $this->db->where('uploadfiles_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('uploadfiles');

        $this->db->where('uploadfiles_deleted_at');
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

    public function get_avp_inspectordoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'avp_inspectordoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_evp_inspectordoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'evp_inspectordoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_wip_inspectordoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'wip_inspectordoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_shins_inspectordoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'shins_inspectordoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
