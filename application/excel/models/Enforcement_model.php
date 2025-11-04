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

    public function get_read_em($id)
    {
        $this->db->select('*', false);
        $this->db->where('enforcements_main_id', $id);
        $this->db->from('enforcement_main');
        return $query = $this->db->get()->row();
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

    function sum_merit_point($from_category = '1',$driverOrVehicleid)
    {
        $this->db->select('coalesce(SUM(enforcements_offendlist_point),0) as merit_point');
        $this->db->where('enforcements_driverOrVehicle', $driverOrVehicleid);
        $this->db->where('enforcements_from_category',$from_category);
        $this->db->from('enforcement_n');
        return $query = $this->db->get()->row()->merit_point;
    }

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
        $this->db->order_by('enforcement_main.enforcements_main_created_at','desc');
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

    function enforcement_main_data($id)
    {
        $this->db->select('*');
        $this->db->where('enforcements_main_id', $id);
        $this->db->from('enforcement_main');
        return $query = $this->db->get()->row();
    }

    function verify_permit_no($permit_no)
    {
        $this->db->select('*');
        $this->db->where('permit_issuance_serialno', $permit_no);
        $this->db->from('permit');
        $query = $this->db->get()->row();

        return isset($query->permit_id) ? $query->permit_id : false ;
    }

    function suspend_permit($permit_no)
    {
        if(empty($permit_no))
        {
            return false;
        }

        $verify_permit_no = $this->verify_permit_no($permit_no);
        if($verify_permit_no === false)
        {
            return false;
        }

        $data = array(
            "permit_status"=>'suspended',
            "permit_officialstatus"=>'suspended',
            "permit_suspended_datetime"=>date('Y-m-d H:i:s'),
        );

        $this->db->where('permit_issuance_serialno', $permit_no);
        $this->db->update('permit', $data); 

        return 1;
    }

    function suspend_driver($driver_id)
    {
        // $total_merit = $this->sum_merit_point(1,$driver_id);
        // if($total_merit >= 12)
        // {
            $data = array(
                "driver_activity_statusid"=>3,
            );
            $this->db->where('driver_id', $driver_id);
            $this->db->update('driver', $data);
        // }

        return 1;
    }

    function suspend_vehicle($vehicle_id)
    {
        // $total_merit = $this->sum_merit_point(2,$vehicle_id);
        // if($total_merit >= 12)
        // {
            $data = array(
                "vehicle_activity_statusid"=>3,
            );
            $this->db->where('vehicle_id', $vehicle_id);
            $this->db->update('vehicle', $data);
        // }

        return 1;
    }

    function clear_suspend_permit($permit_no)
    {
        if(empty($permit_no))
        {
            return false;
        }

        $verify_permit_no = $this->verify_permit_no($permit_no);
        if($verify_permit_no === false)
        {
            return false;
        }

        $data = array(
            "permit_status"=>'completed',
            "permit_officialstatus"=>'completed',
        );

        $this->db->where('permit_issuance_serialno', $permit_no);
        $this->db->update('permit', $data); 

        return 1;
    }

    function clear_suspend_driver($driver_id)
    {
        // $this->db->select('*');
        $this->db->from('enforcement_main');
        $this->db->where('enforcements_main_driverOrVehicle', $driver_id);
        $this->db->where('enforcements_main_from_category', '1');
        $this->db->where('enforcements_main_files', 'Close');
        $this->db->where('enforcements_main_active', '1');
        $this->db->where('enforcements_main_deleted_at IS NULL');
        $count = $this->db->count_all_results();

        $res = 0;
        if(!isset($count) || empty($count))
        {
            $res = 0;
        }
        else
        {
            $res = $count;
        }

        if($res == 0)
        {
            $data = array(
                "driver_activity_statusid"=>1,
            );
            $this->db->where('driver_id', $driver_id);
            $this->db->update('driver', $data);
        }

        return $res;
        // $query = $this->db->get()->result();
    }

    function clear_suspend_vehicle($vehicle_id)
    {
        // $this->db->select('*');
        $this->db->from('enforcement_main');
        $this->db->where('enforcements_main_driverOrVehicle', $vehicle_id);
        $this->db->where('enforcements_main_from_category', '2');
        $this->db->where('enforcements_main_files', 'Close');
        $this->db->where('enforcements_main_active', '1');
        $this->db->where('enforcements_main_deleted_at IS NULL');
        $count = $this->db->count_all_results();

        $res = 0;
        if(!isset($count) || empty($count))
        {
            $res = 0;
        }
        else
        {
            $res = $count;
        }

        if($res == 0)
        {
            $data = array(
                "vehicle_activity_statusid"=>1,
            );
            $this->db->where('vehicle_id', $vehicle_id);
            $this->db->update('vehicle', $data);
        }

        return $res;
        // $query = $this->db->get()->result();
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
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
