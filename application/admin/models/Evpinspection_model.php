<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Evpinspection_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// get all
    public function get_all() {

        $this->db->select('p.permit_bookingid booking_id');
        $this->db->select('v.vehicle_registration_no vehicle_regno');
        $this->db->select('vc.vehiclegroup_name vehicle_type');
        $this->db->select('v.vehicle_year_manufacture');
        $this->db->select('c.company_name company_name');
        $this->db->select('v.vehicle_type vehicle_category');
        $this->db->select('p.permit_status vehicle_status');
        $this->db->from('evppermit a');
        $this->db->join('permit p', 'a.evppermit_permit_id = p.permit_id', 'inner' );
        $this->db->join('vehicle v', 'a.evppermit_vehicle_id = v.vehicle_id', 'inner' );
        $this->db->join('vehiclegroup vc', 'v.vehicle_group = vc.vehiclegroup_id', 'inner' );
        $this->db->join('company c', 'v.vehicle_company_id = c.company_id', 'inner' );

        $query = $this->db->get();

        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }

    }

    public function get_by_id($id) {
        $this->db->select('a.evppermit_id evppermit_id');
        $this->db->select('a.evppermit_inspectionapproval inspectionapproval');
        $this->db->select('a.evppermit_inspectionapproval_verification inspectionapproval_verification');
        $this->db->select('a.evppermit_inspection_remark inspection_remark');
        $this->db->select('a.evppermit_inspection_verification_remark inspection_verification_remark');
        $this->db->select('u.user_name inspector');
        $this->db->select('u2.user_name manager');        
        $this->db->select('a.evppermit_managerverified_date managerverified_date');
        $this->db->select('a.evppermit_inspection_date inspection_date');
        $this->db->select('p.permit_bookingid booking_id');
        $this->db->select('v.vehicle_registration_no vehicle_regno');
        $this->db->select('vc.vehiclegroup_name vehicle_type');
        $this->db->select('v.vehicle_year_manufacture');
        $this->db->select('c.company_name company_name');
        $this->db->select('v.vehicle_type vehicle_category');
        $this->db->select('p.permit_status vehicle_status');
        $this->db->from('evppermit a');
        $this->db->join('permit p', 'a.evppermit_permit_id = p.permit_id', 'inner' );
        $this->db->join('vehicle v', 'a.evppermit_vehicle_id = v.vehicle_id', 'inner' );
        $this->db->join('vehiclegroup vc', 'v.vehicle_group = vc.vehiclegroup_id', 'inner' );
        $this->db->join('company c', 'v.vehicle_company_id = c.company_id', 'inner' );
        $this->db->join('userlist u', 'u.user_id = a.evppermit_result_inspector_id', 'left' );
        $this->db->join('userlist u2', 'u2.user_id = a.evppermit_managerverified_id', 'left' );
        
        
        $this->db->where('p.permit_id', $id);

        return $this->db->get()->row();
    }

    // get data by id
    public function get_evpchecklist_by_id($id) {
        $this->db->select('*');
        $this->db->from('evpchecklist');
        $this->db->where('evpchecklist_permit_id', $id);
        $this->db->where('evpchecklist_deleted_at');
            
        return $this->db->get()->result();    
    }


    public function listajax($columns, $start, $length, $filter="", $sort="", $sorttype=""){
        $i=0;

        $this->db->select('p.permit_id');
        $this->db->select('p.permit_bookingid booking_id');
        $this->db->select('v.vehicle_registration_no vehicle_regno');
        $this->db->select('vc.vehiclegroup_name vehicle_type');
        $this->db->select('v.vehicle_year_manufacture');
        $this->db->select('c.company_name company_name');
        $this->db->select('v.vehicle_type vehicle_category');
        $this->db->select('p.permit_status vehicle_status');
        $this->db->from('evppermit a');
        $this->db->join('permit p', 'a.evppermit_permit_id = p.permit_id', 'inner' );
        $this->db->join('vehicle v', 'a.evppermit_vehicle_id = v.vehicle_id', 'inner' );
        $this->db->join('vehiclegroup vc', 'v.vehicle_group = vc.vehiclegroup_id', 'inner' );
        $this->db->join('company c', 'v.vehicle_company_id = c.company_id', 'inner' );

        $this->db->group_start();
        foreach ($columns as $column) {
            if($i==0){
                $this->db->where("$column like", "%$filter%");
            }else{
                $this->db->or_where("$column like", "%$filter%");
            }

            $i++;
        }
        $this->db->group_end();
        if($sort!=""){
            $this->db->order_by($sort, $sorttype);
        }else{
        $this->db->order_by('evppermit_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal(){
        $i=0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('evppermit a');
        $this->db->join('permit p', 'a.evppermit_permit_id = p.permit_id', 'inner' );
        $this->db->join('vehicle v', 'a.evppermit_vehicle_id = v.vehicle_id', 'inner' );
        $this->db->join('vehiclegroup vc', 'v.vehicle_group = vc.vehiclegroup_id', 'inner' );
        $this->db->join('company c', 'v.vehicle_company_id = c.company_id', 'inner' );
        
        $this->db->where('evppermit_deleted_at');
        $query = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter=""){
        $i=0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('evppermit a');
        $this->db->join('permit p', 'a.evppermit_permit_id = p.permit_id', 'inner' );
        $this->db->join('vehicle v', 'a.evppermit_vehicle_id = v.vehicle_id', 'inner' );
        $this->db->join('vehiclegroup vc', 'v.vehicle_group = vc.vehiclegroup_id', 'inner' );
        $this->db->join('company c', 'v.vehicle_company_id = c.company_id', 'inner' );
        
        $this->db->where('evppermit_deleted_at');
        foreach ($columns as $column) {
        if($i==0){
            $this->db->where("$column like", "%$filter%");
            }else{
            $this->db->or_where("$column like", "%$filter%");
        }
            $i++;
        }
        $query = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function update_checklist($data, $id) {
        $this->db->update_batch('evpchecklist', $data, 'evpchecklist_id');
        return $this->get_evpchecklist_by_id($id);
    }

    public function update_inspection_result($data_id, $data_evppermit, $data_permit, $data_permit_timeline) {
        $data_id = (object) $data_id;

        $this->db->where('evppermit_id', $data_id->evppermit_id);
        $this->db->update('evppermit', $data_evppermit);

        $this->db->where('permit_id', $data_id->permit_id);
        $this->db->update('permit', $data_permit); 

        $this->db->insert('permit_timeline', $data_permit_timeline);
    }

}