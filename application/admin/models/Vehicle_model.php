<?php

/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vehicle_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// get all
    public function get_all() {
        $this->db->select('
    vehicle.*,
    company.company_name AS company_name_vehicle_company_id,
    case vehicle_type
    when \'AV\' then \'Airside Vehicle\'
    when \'EV\' then \'Electrical Vehicle\'
    end as vehicle_type,
    vehicleequipmenttype.vehicleequipmenttype_name AS vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
    enginetype.enginetype_name AS enginetype_name_vehicle_enginetype_id,
    activity_status.activity_status_name AS activity_status_name_vehicle_activity_statusid', false);
        //$this->db->where('vehicle_deleted_at');
        $this->db->order_by('vehicle.vehicle_id', 'DESC');
        $this->db->from('vehicle');
        $this->db->join('company', 'company.company_id = vehicle.vehicle_company_id', 'left');
        $this->db->join('vehicleequipmenttype', 'vehicleequipmenttype.vehicleequipmenttype_id = vehicle.vehicle_vehicleequipmenttype_id', 'left');
        /*        $this->db->join('parkingarea', 'parkingarea.parkingarea_id = vehicle.vehicle_parkingarea_id', 'left'); */
        $this->db->join('enginetype', 'enginetype.enginetype_id = vehicle.vehicle_enginetype_id', 'left');
        $this->db->join('activity_status', 'activity_status.activity_status_id = vehicle.vehicle_activity_statusid', 'left');
        
        // Add limit to prevent memory issues
        $this->db->limit(100);
        
        $query = $this->db->get();
        
        // Debug: Check if query failed
        if ($query === false) {
            $error = $this->db->error();
            die('Database Error Code: ' . $error['code'] . '<br>Message: ' . $error['message'] . '<br>Query: ' . $this->db->last_query());
        }

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_all_companyhistory($id) {
        $this->db->select('company.company_name,userlist.user_username,vehiclecompanyhistory.vehiclecompanyhistory_created_at', false);
        $this->db->where('vehiclecompanyhistory_vehicle_id', $id);
        $this->db->order_by('vehiclecompanyhistory.vehiclecompanyhistory_id', 'DESC');
        $this->db->from('vehiclecompanyhistory');
        $this->db->join('vehicle', 'vehicle.vehicle_id = vehiclecompanyhistory.vehiclecompanyhistory_vehicle_id');
        $this->db->join('company', 'company.company_id = vehiclecompanyhistory.vehiclecompanyhistory_company_id');
        $this->db->join('userlist', 'userlist.user_id = vehiclecompanyhistory.vehiclecompanyhistory_lastchanged_by');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

// get data by id
    public function get_by_id($id) {
        $this->db->select('*');
        $this->db->where('vehicle.vehicle_id', $id);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    // get data by vehicle id
    function get_by_vehicle_id($id, $type) {
        if ($type == "AV") {
            $this->db->select('p.*,ps.permit_status_desc', false);
            $this->db->where('a.avppermit_vehicle_id', $id);
            $this->db->from('avppermit a');
            //$this->db->where('p.permit_deleted_at');
            $this->db->join('permit p', 'p.permit_id = a.avppermit_permit_id');
            $this->db->join('permit_status ps', 'p.permit_status = ps.permit_status_name');
            $this->db->order_by('p.permit_created_at', 'DESC');
        } else {
            $this->db->select('p.*,ps.permit_status_desc', false);
            $this->db->where('a.evppermit_vehicle_id', $id);
            $this->db->from('evppermit a');
            //$this->db->where('p.permit_deleted_at');
            $this->db->join('permit p', 'p.permit_id = a.evppermit_permit_id');
            $this->db->join('permit_status ps', 'p.permit_status = ps.permit_status_name');
            $this->db->order_by('p.permit_created_at', 'DESC');
        }
        $this->db->limit(1, 0);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_by_registrationid($id) {
        $this->db->select('*');
        $this->db->where('vehicle.vehicle_registration_no', $id);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_read($id) {
        $this->db->select('
    vehicle.*,
    company.company_name AS company_name_vehicle_company_id,
    case vehicle_type
    when \'AV\' then \'Airside Vehicle\'
    when \'EV\' then \'Electrical Vehicle\'
    end as vehicle_type,
    vehicleequipmenttype.vehicleequipmenttype_name AS vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
vehiclegroup.vehiclegroup_name as vehicle_vehiclegroup_name,
    enginetype.enginetype_name AS enginetype_name_vehicle_enginetype_id,
    enginecapacity.enginecapacity_name AS vehicle_enginecapacity_name,
    activity_status.activity_status_name AS activity_status_name_vehicle_activity_statusid', false);
        $this->db->where('vehicle.vehicle_id', $id);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');
        $this->db->join('company', 'company.company_id = vehicle.vehicle_company_id', 'left');
        $this->db->join('vehicleequipmenttype', 'vehicleequipmenttype.vehicleequipmenttype_id = vehicle.vehicle_vehicleequipmenttype_id', 'left');
        $this->db->join('vehiclegroup', 'vehiclegroup.vehiclegroup_id = vehicle.vehicle_group', 'left');
        $this->db->join('enginetype', 'enginetype.enginetype_id = vehicle.vehicle_enginetype_id', 'left');
        $this->db->join('enginecapacity', 'enginecapacity.enginecapacity_id = vehicle.vehicle_engine_capacity', 'left');
        $this->db->join('activity_status', 'activity_status.activity_status_id = vehicle.vehicle_activity_statusid', 'left');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

// insert data
    public function insert($data) {
        $this->db->insert('vehicle', $data);
    }

    public function createhistory($data) {
        $this->db->insert('vehiclecompanyhistory', $data);
    }

// update data
    public function update($id, $data) {
        $this->db->where('vehicle_id', $id);
        $this->db->update('vehicle', $data);
    }

// delete data
    public function delete($id) {
        $this->db->where('vehicle_id', $id);
        $this->db->delete('vehicle');
    }

    public function get_all_vehiclegroup() {
        $this->db->select('*');
        $this->db->order_by('vehiclegroup_id', 'ASC');
        $this->db->from('vehiclegroup');
        return $query = $this->db->get()->result();
    }

    public function get_all_enginecapacity() {
        $this->db->select('*');
        $this->db->order_by('enginecapacity_id', 'ASC');
        $this->db->from('enginecapacity');
        return $query = $this->db->get()->result();
    }

    public function get_all_company() {
        $this->db->select('*');
        $this->db->order_by('company_name', 'ASC');
        $this->db->from('company');
        return $query = $this->db->get()->result();
    }

    public function get_all_vehicleequipmenttype() {
        $this->db->select('*');
        $this->db->order_by('vehicleequipmenttype_id', 'ASC');
        $this->db->from('vehicleequipmenttype');
        return $query = $this->db->get()->result();
    }

    /*    public function get_all_parkingarea()
      {
      $this->db->select('*');
      $this->db->order_by('parkingarea_id', 'ASC');
      $this->db->from('parkingarea');
      return $query = $this->db->get()->result();
      } */

    public function get_all_enginetype() {
        $this->db->select('*');
        $this->db->order_by('enginetype_id', 'ASC');
        $this->db->from('enginetype');
        return $query = $this->db->get()->result();
    }

    public function get_all_activity_status() {
        $this->db->select('*');
        $this->db->order_by('activity_status_id', 'ASC');
        $this->db->from('activity_status');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "", $sorttype = "") {
        $i = 0;
        $this->db->select('
    vehicle.*,
    company.company_name AS company_name_vehicle_company_id,
    company.company_id AS company_id,
    case vehicle_type
    when \'AV\' then \'Airside\'
    when \'EV\' then \'Terminal\'
    end as vehicle_type,
    vehicleequipmenttype.vehicleequipmenttype_name AS vehicleequipmenttype_name_vehicle_vehicleequipmenttype_id,
    enginetype.enginetype_name AS enginetype_name_vehicle_enginetype_id,
    activity_status.activity_status_name AS activity_status_name_vehicle_activity_statusid,
    vehiclegroup.vehiclegroup_name AS vehicle_name
    ', false);
        // $this->db->where('vehicle_company_id', $this->session->userdata('companyid'));
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');
        $this->db->join('company', 'company.company_id = vehicle.vehicle_company_id', 'left');
        $this->db->join('vehicleequipmenttype', 'vehicleequipmenttype.vehicleequipmenttype_id = vehicle.vehicle_vehicleequipmenttype_id', 'left');
        /*        $this->db->join('parkingarea', 'parkingarea.parkingarea_id = vehicle.vehicle_parkingarea_id', 'left'); */
        $this->db->join('enginetype', 'enginetype.enginetype_id = vehicle.vehicle_enginetype_id', 'left');
        $this->db->join('vehiclegroup', 'vehiclegroup.vehiclegroup_id = vehicle.vehicle_group', 'left');
        $this->db->join('activity_status', 'activity_status.activity_status_id = vehicle.vehicle_activity_statusid', 'left');

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
            $this->db->order_by('vehicle.vehicle_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal() {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('vehicle');
        //$this->db->where('vehicle_company_id', $this->session->userdata('companyid'));
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $query = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "") {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('vehicle');
        // $this->db->where('vehicle_company_id', $this->session->userdata('companyid'));
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
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

    public function get_count_allvehicle_bycompany($id) {
        $this->db->select('*');
        $this->db->where('vehicle.vehicle_company_id', $id);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_verifyvehicle($id) {
        $this->db->select('vehicle_id, vehicle_registration_no, vehicle_activity_statusid');
        $this->db->where('vehicle_id', $id);
        $this->db->from('vehicle');
        return $query = $this->db->get()->row();
    }

    public function get_companyvehicle($type = '') {
        $this->db->select('vehicle_id, vehicle_registration_no, vehicle_year_manufacture, vehiclegroup_name');
        $this->db->where('vehicle_company_id', $this->session->userdata('companyid'));
        if ($type != '') {
            $this->db->where('vehicle_type', $type);
        }

        $this->db->from('vehicle');
        $this->db->join('vehiclegroup', 'vehiclegroup.vehiclegroup_id = vehicle.vehicle_group', 'left');
        return $query = $this->db->get()->result();
    }

    public function notexist_vehicle($regno) {
        $this->db->select('*');
        $this->db->where('vehicle.vehicle_registration_no', $regno);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function notexist_chasisno($chasisno) {
        $this->db->select('*');
        $this->db->where('vehicle.vehicle_chasis_no', $chasisno);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function notexist_engineno($engineno) {
        $this->db->select('*');
        $this->db->where('vehicle.vehicle_engine_no', $engineno);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL', null, false);
        $this->db->from('vehicle');

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
