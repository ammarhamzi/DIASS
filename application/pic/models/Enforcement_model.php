<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Enforcement_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('servicecharges.*, charges_types.name as charges_types_name');
        $this->db->where('servicecharges.active', '1');
        $this->db->join('charges_types','servicecharges.servicecharges_ct_id = charges_types.ct_id','left');
        $this->db->from('servicecharges');
        return $query = $this->db->get()->result();
    }

    public function get_user_type($type)
    {
        $this->db->select('*');
        $this->db->where('user_isactive', '1');
        $this->db->where('user_groupid',$type);
        $this->db->from('userlist');
        return $query = $this->db->get()->result();
    }

    function search_driver($keyword)
    {
        $this->db->select('driver_id as ids, driver_ic as reg_no, driver_name as display_name');
        $this->db->like('driver_ic',$keyword);
        $this->db->where('driver_deleted_at IS NULL');
        $this->db->from('driver');
        return $query = $this->db->get()->result();
    }

    function search_vehicle($keyword)
    {
        $this->db->select('vehicle.vehicle_id as ids, vehicle.vehicle_registration_no as reg_no,company.company_name as display_name');
        $this->db->join('company','company.company_id = vehicle.vehicle_company_id','left');
        $this->db->like('vehicle.vehicle_registration_no',$keyword);
        $this->db->where('vehicle.vehicle_deleted_at IS NULL');
        $this->db->from('vehicle');
        return $query = $this->db->get()->result();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('enforcements_id', $id);
        $this->db->from('enforcement_n');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('enforcements_id', $id);
        $this->db->from('enforcement_n');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('enforcement_n', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('enforcements_id', $id);
        $this->db->update('enforcement_n', $data);
    }

// delete data
    public function remove($id)
    {
        $this->db->where('enforcements_id', $id);
        $this->db->update('enforcement_n', array(
            "deleted_at"=>$this->session->id,
            "deleted_by"=>date('Y-m-d H:i:s'),
            "active"=>0,
        ));
    }

// insert data
    public function insert_em($data)
    {
        $this->db->insert('enforcement_main', $data);
    }

// update data
    public function update_em($id, $data)
    {
        $this->db->where('enforcements_main_id', $id);
        $this->db->update('enforcement_main', $data);
    }

// delete data
    public function remove_em($id)
    {
        $this->db->where('enforcements_main_id', $id);
        $this->db->update('enforcement_main', array(
            "deleted_at"=>$this->session->id,
            "deleted_by"=>date('Y-m-d H:i:s'),
            "active"=>0,
        ));
    }

    function vehicle_detail($vehicle_id)
    {
        $this->db->select('vehicle.*, company.company_name');
        $this->db->where('vehicle.vehicle_id', $vehicle_id);
        $this->db->from('vehicle');
        $this->db->join('company', 'company.company_id = vehicle.vehicle_company_id', 'left');
        return $query = $this->db->get()->row();
    }

    function driver_detail($driver_id)
    {
        $this->db->select('driver.*, company.company_name');
        $this->db->where('driver.driver_id', $driver_id);
        $this->db->from('driver');
        $this->db->join('company', 'company.company_id = driver.driver_company_id', 'left');
        return $query = $this->db->get()->row();
    }
//using php 8.0.2
    function sum_merit_point($from_category,$driverOrVehicleid)
    {
        $this->db->select('coalesce(SUM(enforcements_offendlist_point),0) as merit_point');
        $this->db->where('enforcements_driverOrVehicle', $driverOrVehicleid);
        $this->db->where('enforcements_from_category',$from_category);
        $this->db->from('enforcement_n');
        return $query = $this->db->get()->row()->merit_point;
    }
//    using < php 8.0.2
//    function sum_merit_point($from_category = '1',$driverOrVehicleid)
//    {
//        $this->db->select('coalesce(SUM(enforcements_offendlist_point),0) as merit_point');
//        $this->db->where('enforcements_driverOrVehicle', $driverOrVehicleid);
//        $this->db->where('enforcements_from_category',$from_category);
//        $this->db->from('enforcement_n');
//        return $query = $this->db->get()->row()->merit_point;
//    }

    function driver_list()
    {
        $this->db->select('driver.driver_id, driver.driver_ic, driver.driver_name, driver.driver_hpno, SUM(enforcement_n.enforcements_offendlist_point) as merit_point');
        // $this->db->where('driver_id', $driver_id);
        $this->db->join('enforcement_n','enforcement_n.enforcements_driverOrVehicle = driver.driver_id');
        $this->db->from('driver');
        $this->db->where('enforcement_n.enforcements_from_category','1');
        $this->db->where('enforcement_n.enforcements_active','1');
        $this->db->group_by('enforcement_n.enforcements_driverOrVehicle, driver.driver_id, driver.driver_ic, driver.driver_name, driver.driver_hpno');
        return $query = $this->db->get()->result();
    }

    function vehicle_list()
    {
        $this->db->select('vehicle.vehicle_id, vehicle.vehicle_registration_no, vehicle.vehicle_type, vehicle.vehicle_year_manufacture, SUM(enforcement_n.enforcements_offendlist_point) as merit_point');
        // $this->db->where('driver_id', $driver_id);
        $this->db->join('enforcement_n','enforcement_n.enforcements_driverOrVehicle = vehicle.vehicle_id');
        $this->db->from('vehicle');
        $this->db->where('enforcement_n.enforcements_from_category','2');
        $this->db->where('enforcement_n.enforcements_active','1');
        $this->db->group_by('enforcement_n.enforcements_driverOrVehicle, vehicle.vehicle_id, vehicle.vehicle_registration_no, vehicle.vehicle_type, vehicle.vehicle_year_manufacture,');
        return $query = $this->db->get()->result();
    }

    public function get_driver_photo($driverid)
    {
        $this->db->select('uploadfiles_filename');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        $this->db->where('uploadfiles_processtype', 'driver_photo');
        $this->db->order_by('uploadfiles_id','desc');
        $this->db->limit(1);
        $query  = $this->db->get()->row();

        return (isset($query->uploadfiles_filename) && !empty($query->uploadfiles_filename) ? $query->uploadfiles_filename : 'DIASS-default-user-photo.png');
    }

    function get_history_driver($driver_id)
    {
        $this->db->select('*,userlist.user_name as userlist_user_name');
        $this->db->from('enforcement_main');
        $this->db->join('userlist','enforcement_main.enforcements_main_created_by = userlist.user_id','left');
        $this->db->where('enforcement_main.enforcements_main_from_category','1');
        $this->db->where('enforcement_main.enforcements_main_active','1');
        $this->db->where('enforcement_main.enforcements_main_driverOrVehicle',$driver_id);
        return $query = $this->db->get()->result();
    }

    function get_history_vehicle($vehicle_id)
    {
        $this->db->select('*,userlist.user_name as userlist_user_name');
        $this->db->from('enforcement_main');
        $this->db->join('userlist','enforcement_main.enforcements_main_created_by = userlist.user_id','left');
        $this->db->where('enforcement_main.enforcements_main_from_category','2');
        $this->db->where('enforcement_main.enforcements_main_active','1');
        $this->db->where('enforcement_main.enforcements_main_driverOrVehicle',$vehicle_id);
        return $query = $this->db->get()->result();
    }

    /**
     * DEPRECATED: Use get_offence_history() instead
     * Legacy method for backward compatibility
     */
    function offence_list_history($enforcements_main_id)
    {
        $this->db->select('enforcement_n.*, offendlist.offendlist_violationNo, offendlist.offendlist_regNo, offendlist_category.off_cat_name');
        $this->db->from('enforcement_n');
        $this->db->join('offendlist','enforcement_n.enforcements_offendlist_id = offendlist.offendlist_id','left');
        $this->db->join('offendlist_category','offendlist.offendlist_offendtype = offendlist_category.off_cat_ref','left');
        $this->db->where('enforcement_n.enforcements_main_id',$enforcements_main_id);
        $this->db->where('enforcement_n.enforcements_active','1');
        return $query = $this->db->get()->result();
    }

    /**
     * Get offence history with revision-aware join (2019/2020/2025)
     * This is the recommended method for displaying enforcement history
     * 
     * @param int $enforcement_id The enforcement main ID
     * @param string $revision Optional revision year, auto-detected if not provided
     * @return array Array of offence records with consistent field names
     */
    function get_offence_history($enforcement_id, $revision = null)
    {
        // Auto-detect revision from header if not provided
        if ($revision === null) {
            $this->db->select('enforcements_main_rev_year');
            $this->db->from('enforcement_main');
            $this->db->where('enforcements_main_id', $enforcement_id);
            $header = $this->db->get()->row();
            
            if ($header && !empty($header->enforcements_main_rev_year)) {
                $revision = $header->enforcements_main_rev_year;
            } else {
                // Fallback to 2019 if no revision found
                $revision = '2019';
            }
        }
        
        // Validate revision
        $supported_revisions = ['2019', '2020', '2025'];
        if (!in_array($revision, $supported_revisions)) {
            $revision = '2019';
        }
        
        // Base query - select enforcement detail fields
        $this->db->select('enforcement_n.*');
        $this->db->from('enforcement_n');
        
        // Revision-aware join
        if ($revision === '2025') {
            // Join with 2025 catalog
            $this->db->select('
                offendlist_2025.offence_id,
                offendlist_2025.number AS offendlist_violationNo,
                offendlist_2025.violation AS offendlist_regNo,
                offendlist_2025.description AS offendlist_natureViolation,
                offendlist_2025.offence_severity AS off_cat_name,
                offendlist_2025.demerit_point AS offendlist_offenddemeritpoint,
                offendlist_2025.monetary_penalty,
                offendlist_2025.adp_suspension_text,
                offendlist_2025.avp_suspension_text,
                offendlist_2025.offence_severity
            ');
            $this->db->join('offendlist_2025', 'enforcement_n.enforcements_offendlist_id = offendlist_2025.offence_id', 'left');
            
        } elseif ($revision === '2020') {
            // Join with 2020 catalog
            $this->db->select('
                offendlist_2020.offendlist_id,
                offendlist_2020.offendlist_violationNo,
                offendlist_2020.offendlist_regNo,
                offendlist_2020.offendlist_natureViolation,
                offendlist_category.off_cat_name,
                offendlist_2020.offendlist_offenddemeritpoint,
                \'\' AS monetary_penalty,
                \'\' AS adp_suspension_text,
                \'\' AS avp_suspension_text,
                offendlist_category.off_cat_name AS offence_severity
            ');
            $this->db->join('offendlist_2020', 'enforcement_n.enforcements_offendlist_id = offendlist_2020.offendlist_id', 'left');
            $this->db->join('offendlist_category', 'offendlist_2020.offendlist_offendtype = offendlist_category.off_cat_ref', 'left');
            
        } else {
            // Join with 2019 catalog (default)
            $this->db->select('
                offendlist.offendlist_id,
                offendlist.offendlist_violationNo,
                offendlist.offendlist_regNo,
                offendlist.offendlist_natureViolation,
                offendlist_category.off_cat_name,
                offendlist.offendlist_offenddemeritpoint,
                \'\' AS monetary_penalty,
                \'\' AS adp_suspension_text,
                \'\' AS avp_suspension_text,
                offendlist_category.off_cat_name AS offence_severity
            ');
            $this->db->join('offendlist', 'enforcement_n.enforcements_offendlist_id = offendlist.offendlist_id', 'left');
            $this->db->join('offendlist_category', 'offendlist.offendlist_offendtype = offendlist_category.off_cat_ref', 'left');
        }
        
        $this->db->where('enforcement_n.enforcements_main_id', $enforcement_id);
        $this->db->where('enforcement_n.enforcements_active', '1');
        $this->db->order_by('enforcement_n.enforcements_id', 'ASC');
        
        $result = $this->db->get()->result();
        
        // Add revision metadata for debugging
        if ($result) {
            foreach ($result as $row) {
                $row->_revision = $revision;
            }
        }
        
        return $result;
    }

    function enforcement_main_data($id)
    {
        $this->db->select('*');
        $this->db->where('enforcements_main_id', $id);
        $this->db->from('enforcement_main');
        return $query = $this->db->get()->row();
    }

    function find_adp_list($driver_id)
    {
        $this->db->select('adppermit.*,permit.*');
        $this->db->from('adppermit');
        $this->db->join('permit','permit.permit_id = adppermit.adppermit_permit_id','left');
        $this->db->join('driver','driver.driver_id = adppermit.adppermit_driver_id','left');
        $this->db->where('adppermit.adppermit_driver_id', $driver_id);
        $this->db->where('adppermit.adppermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_evdp_list($driver_id)
    {
        $this->db->select('evdppermit.*,permit.*');
        $this->db->from('evdppermit');
        $this->db->join('permit','permit.permit_id = evdppermit.evdppermit_permit_id','left');
        $this->db->join('driver','driver.driver_id = evdppermit.evdppermit_driver_id','left');
        $this->db->where('evdppermit.evdppermit_driver_id', $driver_id);
        $this->db->where('evdppermit.evdppermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_avp_list($vehicle_id)
    {
        $this->db->select('avppermit.*,permit.*');
        $this->db->from('avppermit');
        $this->db->join('permit','permit.permit_id = avppermit.avppermit_permit_id','left');
        $this->db->join('vehicle','vehicle.vehicle_id = avppermit.avppermit_vehicle_id','left');
        $this->db->where('avppermit.avppermit_vehicle_id', $vehicle_id);
        $this->db->where('avppermit.avppermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
/*        echo $this->db->last_query();
        die();*/
        return count($query) > 0 ? $query : array() ;
    }

    function find_evp_list($vehicle_id)
    {
        $this->db->select('evppermit.*,permit.*');
        $this->db->from('evppermit');
        $this->db->join('permit','permit.permit_id = evppermit.evppermit_permit_id','left');
        $this->db->join('vehicle','vehicle.vehicle_id = evppermit.evppermit_vehicle_id','left');
        $this->db->where('evppermit.evppermit_vehicle_id', $vehicle_id);
        $this->db->where('evppermit.evppermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_pbb_list($driver_id)
    {
        $this->db->select('pbbpermit.*,permit.*');
        $this->db->from('pbbpermit');
        $this->db->join('permit','permit.permit_id = pbbpermit.pbbpermit_permit_id','left');
        $this->db->join('driver','driver.driver_id = pbbpermit.pbbpermit_driver_id','left');
        $this->db->where('pbbpermit.pbbpermit_driver_id', $driver_id);
        $this->db->where('pbbpermit.pbbpermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_vdgs_list($driver_id)
    {
        $this->db->select('vdgspermit.*,permit.*');
        $this->db->from('vdgspermit');
        $this->db->join('permit','permit.permit_id = vdgspermit.vdgspermit_permit_id','left');
        $this->db->join('driver','driver.driver_id = vdgspermit.vdgspermit_driver_id','left');
        $this->db->where('vdgspermit.vdgspermit_driver_id', $driver_id);
        $this->db->where('vdgspermit.vdgspermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_gpu_list($driver_id)
    {
        $this->db->select('gpupermit.*,permit.*');
        $this->db->from('gpupermit');
        $this->db->join('permit','permit.permit_id = gpupermit.gpupermit_permit_id','left');
        $this->db->join('driver','driver.driver_id = gpupermit.gpupermit_driver_id','left');
        $this->db->where('gpupermit.gpupermit_driver_id', $driver_id);
        $this->db->where('gpupermit.gpupermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_pca_list($driver_id)
    {
        $this->db->select('pcapermit.*,permit.*');
        $this->db->from('pcapermit');
        $this->db->join('permit','permit.permit_id = pcapermit.pcapermit_permit_id','left');
        $this->db->join('driver','driver.driver_id = pcapermit.pcapermit_driver_id','left');
        $this->db->where('pcapermit.pcapermit_driver_id', $driver_id);
        $this->db->where('pcapermit.pcapermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_wip_list($vehicle_id)
    {
        $this->db->select('wippermit.*,permit.*');
        $this->db->from('wippermit');
        $this->db->join('permit','permit.permit_id = wippermit.wippermit_permit_id','left');
        $this->db->join('vehicle','vehicle.vehicle_id = wippermit.wippermit_vehicle_id','left');
        $this->db->where('wippermit.wippermit_vehicle_id', $vehicle_id);
        $this->db->where('wippermit.wippermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_wipbriefing_list($vehicle_id)
    {
        $this->db->select('wipbriefingpermit.*,permit.*');
        $this->db->from('wipbriefingpermit');
        $this->db->join('permit','permit.permit_id = wipbriefingpermit.wipbriefingpermit_permit_id','left');
        $this->db->join('vehicle','vehicle.vehicle_id = wipbriefingpermit.wipbriefingpermit_vehicle_id','left');
        $this->db->where('wipbriefingpermit.wipbriefingpermit_vehicle_id', $vehicle_id);
        $this->db->where('wipbriefingpermit.wipbriefingpermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_shins_list($vehicle_id)
    {
        $this->db->select('shinspermit.*,permit.*');
        $this->db->from('shinspermit');
        $this->db->join('permit','permit.permit_id = shinspermit.shinspermit_permit_id','left');
        $this->db->join('vehicle','vehicle.vehicle_id = shinspermit.shinspermit_vehicle_id','left');
        $this->db->where('shinspermit.shinspermit_vehicle_id', $vehicle_id);
        $this->db->where('shinspermit.shinspermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_sh_list($vehicle_id)
    {
        $this->db->select('shpermit.*,permit.*');
        $this->db->from('shpermit');
        $this->db->join('permit','permit.permit_id = shpermit.shpermit_permit_id','left');
        $this->db->join('vehicle','vehicle.vehicle_id = shpermit.shpermit_vehicle_id','left');
        $this->db->where('shpermit.shpermit_vehicle_id', $vehicle_id);
        $this->db->where('shpermit.shpermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_cs_list($vehicle_id)
    {
        $this->db->select('cspermit.*,permit.*');
        $this->db->from('cspermit');
        $this->db->join('permit','permit.permit_id = cspermit.cspermit_permit_id','left');
        $this->db->join('vehicle','vehicle.vehicle_id = cspermit.cspermit_vehicle_id','left');
        $this->db->where('cspermit.cspermit_vehicle_id', $vehicle_id);
        $this->db->where('cspermit.cspermit_deleted_at IS NULL');
        $this->db->where('permit.permit_deleted_at IS NULL');
        $this->db->where_in('permit.permit_status', array('suspended','applicationrejected','permitterminated','completed','paid'));
        $this->db->order_by('permit.permit_issuance_expirydate','desc');
        $query = $this->db->get()->result();
        return count($query) > 0 ? $query : array() ;
    }

    function find_vehicle_all_permit($vehicle_id)
    {
        if(empty($vehicle_id) && $vehicle_id <= 0)
        {
            return false;
        }

        $sql = "SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM avppermit 
                LEFT JOIN permit ON permit.permit_id = avppermit.avppermit_permit_id 
                LEFT JOIN vehicle ON vehicle.vehicle_id = avppermit.avppermit_vehicle_id 
                WHERE avppermit.avppermit_vehicle_id = '".$vehicle_id."' AND avppermit.avppermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid')

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM evppermit 
                LEFT JOIN permit ON permit.permit_id = evppermit.evppermit_permit_id 
                LEFT JOIN vehicle ON vehicle.vehicle_id = evppermit.evppermit_vehicle_id 
                WHERE evppermit.evppermit_vehicle_id = '".$vehicle_id."' AND evppermit.evppermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM wippermit 
                LEFT JOIN permit ON permit.permit_id = wippermit.wippermit_permit_id 
                LEFT JOIN vehicle ON vehicle.vehicle_id = wippermit.wippermit_vehicle_id 
                WHERE wippermit.wippermit_vehicle_id = '".$vehicle_id."' AND wippermit.wippermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM wipbriefingpermit 
                LEFT JOIN permit ON permit.permit_id = wipbriefingpermit.wipbriefingpermit_permit_id 
                LEFT JOIN vehicle ON vehicle.vehicle_id = wipbriefingpermit.wipbriefingpermit_vehicle_id 
                WHERE wipbriefingpermit.wipbriefingpermit_vehicle_id = '".$vehicle_id."' AND wipbriefingpermit.wipbriefingpermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM shinspermit 
                LEFT JOIN permit ON permit.permit_id = shinspermit.shinspermit_permit_id 
                LEFT JOIN vehicle ON vehicle.vehicle_id = shinspermit.shinspermit_vehicle_id 
                WHERE shinspermit.shinspermit_vehicle_id = '".$vehicle_id."' AND shinspermit.shinspermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM shpermit 
                LEFT JOIN permit ON permit.permit_id = shpermit.shpermit_permit_id 
                LEFT JOIN vehicle ON vehicle.vehicle_id = shpermit.shpermit_vehicle_id 
                WHERE shpermit.shpermit_vehicle_id = '".$vehicle_id."' AND shpermit.shpermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM cspermit 
                LEFT JOIN permit ON permit.permit_id = cspermit.cspermit_permit_id 
                LEFT JOIN vehicle ON vehicle.vehicle_id = cspermit.cspermit_vehicle_id 
                WHERE cspermit.cspermit_vehicle_id = '".$vehicle_id."' AND cspermit.cspermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                ORDER BY permit_permit_issuance_expirydate DESC";

        $query = $this->db->query($sql)->result();

        return !empty($query) ? $query : array() ;
    }

    function find_driver_all_permit($driver_id)
    {
        if(empty($driver_id) && $driver_id <= 0)
        {
            return false;
        }

        $sql = "SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM adppermit 
                LEFT JOIN permit ON permit.permit_id = adppermit.adppermit_permit_id 
                LEFT JOIN driver ON driver.driver_id = adppermit.adppermit_driver_id 
                WHERE adppermit.adppermit_driver_id = '".$driver_id."' AND adppermit.adppermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM evdppermit 
                LEFT JOIN permit ON permit.permit_id = evdppermit.evdppermit_permit_id 
                LEFT JOIN driver ON driver.driver_id = evdppermit.evdppermit_driver_id 
                WHERE evdppermit.evdppermit_driver_id = '".$driver_id."' AND evdppermit.evdppermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM pbbpermit 
                LEFT JOIN permit ON permit.permit_id = pbbpermit.pbbpermit_permit_id 
                LEFT JOIN driver ON driver.driver_id = pbbpermit.pbbpermit_driver_id 
                WHERE pbbpermit.pbbpermit_driver_id = '".$driver_id."' AND pbbpermit.pbbpermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                UNION

                SELECT permit.*, permit.permit_issuance_expirydate as permit_permit_issuance_expirydate
                FROM vdgspermit 
                LEFT JOIN permit ON permit.permit_id = vdgspermit.vdgspermit_permit_id 
                LEFT JOIN driver ON driver.driver_id = vdgspermit.vdgspermit_driver_id 
                WHERE vdgspermit.vdgspermit_driver_id = '".$driver_id."' AND vdgspermit.vdgspermit_deleted_at IS NULL AND permit.permit_deleted_at IS NULL 
                AND permit.permit_status IN('suspended', 'applicationrejected', 'permitterminated', 'completed', 'paid') 

                ORDER BY permit_permit_issuance_expirydate DESC";

        $query = $this->db->query($sql)->result();

        return !empty($query) ? $query : array() ;
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
