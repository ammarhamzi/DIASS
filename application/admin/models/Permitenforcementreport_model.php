<?php
/* \resources\gen_template\master\crud-newpage\models */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permitenforcementreport_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    function driver_list()
    {   //SUM(enforcement_n.enforcements_offendlist_point) as merit_point,
//        $this->db->select("driver.driver_id, driver.driver_ic, driver.driver_name, driver.driver_hpno,
//                        SUM(CASE WHEN enforcement_main.enforcements_main_status = 'Open' THEN enforcement_n.enforcements_offendlist_point
//                            ELSE 0
//                            END) AS merit_point
//                        ");
$this->db->select("driver.driver_id, driver.driver_ic, driver.driver_name, driver.driver_hpno,
                        SUM(CASE WHEN enforcement_main.enforcements_main_status = 'Open' OR enforcement_main.enforcements_main_status = 'Close' THEN enforcement_n.enforcements_offendlist_point
                            ELSE 0
                            END) AS merit_point
                        ");        
// $this->db->where('driver_id', $driver_id);
        $this->db->join('enforcement_n','enforcement_n.enforcements_driverOrVehicle = driver.driver_id');
        $this->db->from('driver');
        $this->db->where('enforcement_n.enforcements_from_category','1');
        $this->db->where('enforcement_n.enforcements_active','1');
        $this->db->group_by('enforcement_n.enforcements_driverOrVehicle, driver.driver_id, driver.driver_ic, driver.driver_name, driver.driver_hpno');

        //check notice status is open
        $this->db->join('enforcement_main', 'enforcement_main.enforcements_main_id = enforcement_n.enforcements_main_id', 'left');
        // $this->db->where('enforcement_main.enforcements_main_status','Open');

        return $query = $this->db->get()->result();
    }
    
    function vehicle_list()
    {   //SUM(enforcement_n.enforcements_offendlist_point) as merit_point,
        $this->db->select("vehicle.vehicle_id, vehicle.vehicle_registration_no, vehicle.vehicle_type, vehicle.vehicle_year_manufacture, 
                            SUM(CASE WHEN enforcement_main.enforcements_main_status = 'Open' THEN enforcement_n.enforcements_offendlist_point
                            ELSE 0
                            END) AS merit_point");
        // $this->db->where('driver_id', $driver_id);
        $this->db->join('enforcement_n','enforcement_n.enforcements_driverOrVehicle = vehicle.vehicle_id');
        $this->db->from('vehicle');
        $this->db->where('enforcement_n.enforcements_from_category','2');
        $this->db->where('enforcement_n.enforcements_active','1');
        $this->db->group_by('enforcement_n.enforcements_driverOrVehicle, vehicle.vehicle_id, vehicle.vehicle_registration_no, vehicle.vehicle_type, vehicle.vehicle_year_manufacture,');

        //check notice status is open
        $this->db->join('enforcement_main', 'enforcement_main.enforcements_main_id = enforcement_n.enforcements_main_id', 'left');
        // $this->db->where('enforcement_main.enforcements_main_status','Open');

        return $query = $this->db->get()->result();
    }

// get all
    public function get_all()
    {
        $this->db->select('
    permit.*,
    permit_group.permit_group_name AS permit_group_name,
    permit_type.permit_type_name AS permit_type_name,
permit_type.permit_type_desc AS permit_type_desc,
    permit_condition.permit_condition_name AS permit_condition_name,
    pic.pic_fullname AS pic_fullname,
    company.company_name AS company_name,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name', false);
        $this->db->where('permit_deleted_at');
        $this->db->order_by('permit.permit_id', 'DESC');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');

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
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at');
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
    permit_group.permit_group_name AS permit_group_name,
    permit_type.permit_type_name AS permit_type_name,
permit_type.permit_type_desc AS permit_type_desc,
    permit_condition.permit_condition_name AS permit_condition_name,
    pic.pic_fullname AS pic_fullname,
    company.company_name AS company_name,
    userlist.user_name AS user_name_permit_issuance_processedby,
    (SELECT user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
    permit_status.permit_status_desc AS permit_status_desc,
    permit_officialstatus.permit_officialstatus_name AS permit_officialstatus_name', false);
        $this->db->where('permit.permit_id', $id);
        $this->db->where('permit_deleted_at');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');

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

// delete data
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

    public function get_all_company()
    {
        $this->db->select('*');
        $this->db->order_by('company_id', 'ASC');
        $this->db->from('company');
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
        $this->db->order_by('permit_status_id', 'ASC');
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

    public function listajax($columnfilter, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {

        $i = 0;
        //$this->db->select('DISTINCT permit_bookingid');
//        $this->db->select('
//    permit.*,
//    permit_group.*,
//    permit_type.*,
//    permit_condition.*,
//    pic.*,
//    company.*,
//    driver.*,
//    vehicle.*,
//    ref_country.ref_country_printable_name,
//    vehiclegroup.vehiclegroup_name,
//    enginecapacity.enginecapacity_name,
//    (SELECT TOP 1 user_name FROM userlist WHERE user_id = permit.permit_issuance_processedby) AS user_name_permit_issuance_processedby,
//    (SELECT TOP 1 user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
//(SELECT TOP 1 examsession_pass FROM examsession WHERE examsession_examtaker_id = examtaker_id AND examsession_count = 1) AS first_exam_result,
//(SELECT TOP 1 examsession_pass FROM examsession WHERE examsession_examtaker_id = examtaker_id AND examsession_count = 2) AS second_exam_result,
//    permit_status.*,
//    permit_officialstatus.*', false);
        $this->db->select("driver.driver_id, driver.driver_ic, driver.driver_name, driver.driver_hpno, company.company_name, offendlist_2020.offendlist_regno, offendlist_2020.offendlist_period, enforcement_n.enforcements_date, enforcement_n.enforcements_time,enforcement_main.enforcements_main_status,enforcement_main.enforcements_main_cancel_date,
                        SUM(CASE WHEN enforcement_main.enforcements_main_status = 'Open' OR enforcement_main.enforcements_main_status = 'Close' THEN enforcement_n.enforcements_offendlist_point
                            ELSE 0
                            END) AS merit_point
                        ");        
// $this->db->where('driver_id', $driver_id);
        $this->db->join('enforcement_n','enforcement_n.enforcements_driverOrVehicle = driver.driver_id');
        $this->db->join('company','company.company_id = driver.driver_company_id');
        $this->db->join('offendlist_2020','offendlist_2020.offendlist_id = enforcement_n.enforcements_offendlist_id');
        $this->db->from('driver');
        $this->db->where('enforcement_n.enforcements_from_category','1');
        $this->db->where('enforcement_n.enforcements_active','1');
        $this->db->group_by('enforcement_n.enforcements_driverOrVehicle, driver.driver_id, driver.driver_ic, driver.driver_name, driver.driver_hpno,company.company_name, offendlist_2020.offendlist_regno, offendlist_2020.offendlist_period, enforcement_n.enforcements_date, enforcement_n.enforcements_time,enforcement_main.enforcements_main_status,enforcement_main.enforcements_main_cancel_date');

        //check notice status is open
        $this->db->join('enforcement_main', 'enforcement_main.enforcements_main_id = enforcement_n.enforcements_main_id', 'left');
        // $this->db->where('enforcement_main.enforcements_main_status','Open');

        $this->db->distinct();

        //$this->db->where('permit_deleted_at');
/*        $this->db->where('permit_status', 'approvalairsidepending');
$this->db->where('permit_officialstatus', 'inprogress');*/
/*        if($location!="all"){
$this->db->like('permit_location', $location, 'before');
}*/
//        $this->db->from('permit');
//        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
//        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
//        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
//
//        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
//        $this->db->join('userlist', 'userlist.user_id = permit.permit_picid', 'left');
//        $this->db->join('pic', 'pic.pic_id = userlist.user_customid', 'left');
//        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
//        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');
//        $this->db->join('driver', 'driver.driver_ic = permit.permit_subject_identity AND driver.driver_name = permit.permit_subject_name AND driver.driver_company_id = permit.permit_companyid', 'left');
//        $this->db->join('vehicle', 'vehicle.vehicle_registration_no = permit.permit_subject_identity', 'left');
//        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');
//        $this->db->join('vehiclegroup', 'vehiclegroup.vehiclegroup_id = vehicle.vehicle_group', 'left');
//        $this->db->join('enginecapacity', 'enginecapacity.enginecapacity_id = vehicle.vehicle_engine_capacity', 'left');
//
//        $this->db->join('examtaker', 'examtaker.examtaker_permit_id = permit.permit_id', 'left');
//$this->db->join('examsession', 'examsession.examsession_examtaker_id = examtaker.examtaker_id', 'left');
//        if(!empty($columnfilter)){
//        //$this->db->group_start();
        foreach ($columnfilter as $key => $value) {
        if(!empty($value)){
//
//        if($key != "permit_created_at_from" && $key != "permit_created_at_to"  && $key != "permit_issuance_startdate" && $key != "permit_issuance_expirydate" ){
//            $this->db->where("$key  LIKE", "%$value%");
//        }else{
          if($key == "permit_created_at_from"){
            $this->db->where("CONVERT(VARCHAR, enforcements_date , 120) >=", "$value");
          }
            if($key == "permit_created_at_to"){
                $this->db->where("CONVERT(VARCHAR, enforcements_date , 120) <=", "$value");
            }
//
//            if($key == "permit_issuance_startdate"){
//                $this->db->where("CONVERT(VARCHAR, permit_issuance_startdate , 120) =", "$value");
//            }
//
//            if($key == "permit_issuance_expirydate"){
//                $this->db->where("CONVERT(VARCHAR, permit_issuance_expirydate , 120) =", "$value");
//            }
//        }
                    if($key == "offence_status"){
                          $this->db->where("enforcements_main_status =", "$value");
                      }
            
                      if($key == "company_name"){
                          $this->db->where("$key  LIKE", "%$value%");
                      }
                      
                      if($key == "driver_ic"){
                          $this->db->where("$key  LIKE", "%$value%");
                      }
            //$this->db->where("CONVERT(VARCHAR, permit_created_at , 120) >=", "$value");
            $i++;
        }
//
        }
        //$this->db->group_end();
//        }

        /* individual filter */
/*        if(!empty($bookingid)){
$this->db->where("permit_bookingid like", "%$bookingid%");
}
if(!empty($company)){
$this->db->where("company.company_name like", "%$company%");
}
if(!empty($identity)){
$this->db->where("permit_subject_identity like", "%$identity%");
}
if(!empty($permittype)){
$this->db->where("permit_type.permit_type_desc =", "$permittype");
}
if(!empty($status)){
$this->db->where("permit_officialstatus =", "$status");
}

if(!empty($appdate)){
$appdate_server = dateserver($appdate);
$this->db->where("CONVERT(VARCHAR, permit_created_at , 120) like", "%$appdate_server%");
}
if(!empty($exdate)){
$exdate_server = dateserver($exdate);
$this->db->where("CONVERT(VARCHAR, permit_issuance_expirydate , 120) like", "%$exdate_server%");
}

if(!empty($condition)){
$this->db->where("permit_condition like", "%$condition%");
}*/

//        if ($sort != "") {
//            $this->db->order_by($sort, $sorttype);
//        } else {
//            //$this->db->order_by('permit.permit_updated_at', 'DESC');
//            $this->db->order_by('permit.permit_bookingid', 'DESC');
//        }
//
//        if ($length != -1) {
//            $this->db->limit($length, $start);
//        }
        //$this->db->group_by('permit_bookingid');
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }
    
    public function listajax2($columnfilter, $start, $length, $filter = "", $sort = "", $sorttype = "")
    {

        $i = 0;
        //$this->db->select('DISTINCT permit_bookingid');
//        $this->db->select('
//    permit.*,
//    permit_group.*,
//    permit_type.*,
//    permit_condition.*,
//    pic.*,
//    company.*,
//    driver.*,
//    vehicle.*,
//    ref_country.ref_country_printable_name,
//    vehiclegroup.vehiclegroup_name,
//    enginecapacity.enginecapacity_name,
//    (SELECT TOP 1 user_name FROM userlist WHERE user_id = permit.permit_issuance_processedby) AS user_name_permit_issuance_processedby,
//    (SELECT TOP 1 user_name FROM userlist WHERE user_id = permit.permit_payment_processedby) AS user_name_permit_payment_processedby,
//(SELECT TOP 1 examsession_pass FROM examsession WHERE examsession_examtaker_id = examtaker_id AND examsession_count = 1) AS first_exam_result,
//(SELECT TOP 1 examsession_pass FROM examsession WHERE examsession_examtaker_id = examtaker_id AND examsession_count = 2) AS second_exam_result,
//    permit_status.*,
//    permit_officialstatus.*', false);
        $this->db->select("vehicle.vehicle_id, vehicle.vehicle_registration_no, vehicle.vehicle_type, vehicle.vehicle_year_manufacture, company.company_name, offendlist_2020.offendlist_regno, offendlist_2020.offendlist_period, enforcement_n.enforcements_date, enforcement_n.enforcements_time,enforcement_main.enforcements_main_status,
                            SUM(CASE WHEN enforcement_main.enforcements_main_status = 'Open' THEN enforcement_n.enforcements_offendlist_point
                            ELSE 0
                            END) AS merit_point");
        // $this->db->where('driver_id', $driver_id);
        $this->db->join('enforcement_n','enforcement_n.enforcements_driverOrVehicle = vehicle.vehicle_id');
        $this->db->join('company','company.company_id = vehicle.vehicle_company_id');
        $this->db->join('offendlist_2020','offendlist_2020.offendlist_id = enforcement_n.enforcements_offendlist_id');
        $this->db->from('vehicle');
        $this->db->where('enforcement_n.enforcements_from_category','2');
        $this->db->where('enforcement_n.enforcements_active','1');
        $this->db->group_by('enforcement_n.enforcements_driverOrVehicle, vehicle.vehicle_id, vehicle.vehicle_registration_no, vehicle.vehicle_type, vehicle.vehicle_year_manufacture, company.company_name, offendlist_2020.offendlist_regno, offendlist_2020.offendlist_period, enforcement_n.enforcements_date, enforcement_n.enforcements_time,enforcement_main.enforcements_main_status');

        
        //check notice status is open
        $this->db->join('enforcement_main', 'enforcement_main.enforcements_main_id = enforcement_n.enforcements_main_id', 'left');
        // $this->db->where('enforcement_main.enforcements_main_status','Open');

        $this->db->distinct();

        //$this->db->where('permit_deleted_at');
/*        $this->db->where('permit_status', 'approvalairsidepending');
$this->db->where('permit_officialstatus', 'inprogress');*/
/*        if($location!="all"){
$this->db->like('permit_location', $location, 'before');
}*/
//        $this->db->from('permit');
//        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
//        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
//        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
//
//        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
//        $this->db->join('userlist', 'userlist.user_id = permit.permit_picid', 'left');
//        $this->db->join('pic', 'pic.pic_id = userlist.user_customid', 'left');
//        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
//        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');
//        $this->db->join('driver', 'driver.driver_ic = permit.permit_subject_identity AND driver.driver_name = permit.permit_subject_name AND driver.driver_company_id = permit.permit_companyid', 'left');
//        $this->db->join('vehicle', 'vehicle.vehicle_registration_no = permit.permit_subject_identity', 'left');
//        $this->db->join('ref_country', 'ref_country.ref_country_id = driver.driver_nationality_country_id', 'left');
//        $this->db->join('vehiclegroup', 'vehiclegroup.vehiclegroup_id = vehicle.vehicle_group', 'left');
//        $this->db->join('enginecapacity', 'enginecapacity.enginecapacity_id = vehicle.vehicle_engine_capacity', 'left');
//
//        $this->db->join('examtaker', 'examtaker.examtaker_permit_id = permit.permit_id', 'left');
//$this->db->join('examsession', 'examsession.examsession_examtaker_id = examtaker.examtaker_id', 'left');
//        if(!empty($columnfilter)){
//        //$this->db->group_start();
        foreach ($columnfilter as $key => $value) {
        if(!empty($value)){
//
//        if($key != "permit_created_at_from" && $key != "permit_created_at_to"  && $key != "permit_issuance_startdate" && $key != "permit_issuance_expirydate" ){
//            $this->db->where("$key  LIKE", "%$value%");
//        }else{
if($key == "permit_created_at_from"){
            $this->db->where("CONVERT(VARCHAR, enforcements_date , 120) >=", "$value");
          }
            if($key == "permit_created_at_to"){
                $this->db->where("CONVERT(VARCHAR, enforcements_date , 120) <=", "$value");
            }
//
//            if($key == "permit_issuance_startdate"){
//                $this->db->where("CONVERT(VARCHAR, permit_issuance_startdate , 120) =", "$value");
//            }
//
//            if($key == "permit_issuance_expirydate"){
//                $this->db->where("CONVERT(VARCHAR, permit_issuance_expirydate , 120) =", "$value");
//            }
//        }
            if($key == "offence_status"){
                          $this->db->where("enforcements_main_status  LIKE", "%$value%");
                      }
                      
                      if($key == "company_name"){
                          $this->db->where("$key  LIKE", "%$value%");
                      }
                      
                      if($key == "vehicle_registration_no"){
                          $this->db->where("$key  LIKE", "%$value%");
                      }
            //$this->db->where("CONVERT(VARCHAR, permit_created_at , 120) >=", "$value");
            $i++;
        }
//
        }
        //$this->db->group_end();
//        }

        /* individual filter */
/*        if(!empty($bookingid)){
$this->db->where("permit_bookingid like", "%$bookingid%");
}
if(!empty($company)){
$this->db->where("company.company_name like", "%$company%");
}
if(!empty($identity)){
$this->db->where("permit_subject_identity like", "%$identity%");
}
if(!empty($permittype)){
$this->db->where("permit_type.permit_type_desc =", "$permittype");
}
if(!empty($status)){
$this->db->where("permit_officialstatus =", "$status");
}

if(!empty($appdate)){
$appdate_server = dateserver($appdate);
$this->db->where("CONVERT(VARCHAR, permit_created_at , 120) like", "%$appdate_server%");
}
if(!empty($exdate)){
$exdate_server = dateserver($exdate);
$this->db->where("CONVERT(VARCHAR, permit_issuance_expirydate , 120) like", "%$exdate_server%");
}

if(!empty($condition)){
$this->db->where("permit_condition like", "%$condition%");
}*/

//        if ($sort != "") {
//            $this->db->order_by($sort, $sorttype);
//        } else {
//            //$this->db->order_by('permit.permit_updated_at', 'DESC');
//            $this->db->order_by('permit.permit_bookingid', 'DESC');
//        }
//
//        if ($length != -1) {
//            $this->db->limit($length, $start);
//        }
        //$this->db->group_by('permit_bookingid');
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('permit');
/*        $this->db->where('permit_status', 'approvalairsidepending');
$this->db->where('permit_officialstatus', 'inprogress');*/
/*        if($location!="all"){
$this->db->like('permit_location', $location, 'before');
}*/
        $this->db->where('permit_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $columnfilter, $filter = "")
    {

        $company    = str_replace(['^', '$'], ['', ''], $columnfilter['company']);
        $bookingid  = str_replace(['^', '$'], ['', ''], $columnfilter['bookingid']);
        $identity   = str_replace(['^', '$'], ['', ''], $columnfilter['identity']);
        $permittype = str_replace(['^', '$'], ['', ''], $columnfilter['permittype']);
        $status     = str_replace(['^', '$'], ['', ''], $columnfilter['status']);
        $appdate    = str_replace(['^', '$'], ['', ''], $columnfilter['appdate']);
        $exdate     = str_replace(['^', '$'], ['', ''], $columnfilter['exdate']);
        $condition  = str_replace(['^', '$'], ['', ''], $columnfilter['condition']);

        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('permit');
        $this->db->join('permit_group', 'permit_group.permit_group_id = permit.permit_groupid', 'left');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'left');
        $this->db->join('permit_condition', 'permit_condition.permit_condition_id = permit.permit_condition', 'left');
        $this->db->join('pic', 'pic.pic_id = permit.permit_picid', 'left');
        $this->db->join('company', 'company.company_id = permit.permit_companyid', 'left');
        $this->db->join('userlist', 'userlist.user_id = permit.permit_issuance_processedby', 'left');
        $this->db->join('permit_status', 'permit_status.permit_status_name = permit.permit_status', 'left');
        $this->db->join('permit_officialstatus', 'permit_officialstatus.permit_officialstatus_name = permit.permit_officialstatus', 'left');
/*        $this->db->where('permit_status', 'approvalairsidepending');
$this->db->where('permit_officialstatus', 'inprogress');*/
/*        if($location!="all"){
$this->db->like('permit_location', $location, 'before');
}*/
        $this->db->where('permit_deleted_at');
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

        /* individual filter */
        if (!empty($bookingid)) {
            $this->db->where("permit_bookingid like", "%$bookingid%");
        }
        if (!empty($company)) {
            $this->db->where("company.company_name like", "%$company%");
        }
        if (!empty($identity)) {
            $this->db->where("permit_subject_identity like", "%$identity%");
        }
        if (!empty($permittype)) {
            $this->db->where("permit_type.permit_type_desc =", "$permittype");
        }
        if (!empty($status)) {
            $this->db->where("permit_officialstatus =", "$status");
        }

        if (!empty($appdate)) {
            $appdate_server = dateserver($appdate);
            $this->db->where("CONVERT(VARCHAR, permit_created_at , 120) like", "%$appdate_server%");
        }
        if (!empty($exdate)) {
            $exdate_server = dateserver($exdate);
            $this->db->where("CONVERT(VARCHAR, permit_issuance_expirydate , 120) like", "%$exdate_server%");
        }

        if (!empty($condition)) {
            $this->db->where("permit_condition like", "%$condition%");
        }

        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
