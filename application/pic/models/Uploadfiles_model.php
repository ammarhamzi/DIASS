<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
#[\AllowDynamicProperties]
class Uploadfiles_model extends CI_Model
{
    public function __construct()
    {
        $this->tableName = 'uploadfiles';
    }

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

    public function get_photo_by_driverid($id)
    {
        $this->db->select('*');
        $this->db->where('uploadfiles.uploadfiles_driver_id', $id);
        $this->db->where('uploadfiles.uploadfiles_processtype', 'driver_photo');
        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');
        $this->db->order_by('uploadfiles_id', 'DESC');
        $this->db->limit(1, 0);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function get_driverinfo_by_driverid($id)
    {
        $this->db->select('*');
        $this->db->where('uploadfiles.uploadfiles_driver_id', $id);
        $this->db->where('uploadfiles.uploadfiles_processtype', 'driver_info');
        $this->db->where('uploadfiles_deleted_at');
        $this->db->from('uploadfiles');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    /*
     * Fetch files data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        if ($id) {
            $this->db->where('uploadfiles_id', $id);
            $query  = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('uploadfiles_created_at', 'desc');
            $query  = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result) ? $result : false;
    }

    public function get_adp_requireddoc($driverid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'adp_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_adp_trainercert($driverid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'adp_trainercert');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_driver_photo($driverid)
    {

        $this->db->select('*');
        $this->db->from('uploadfiles');
        if($driverid == NULL){
        $this->db->where('uploadfiles_company_id', $this->session->userdata('companyid'));
        $this->db->where('uploadfiles_lastchanged_by', $this->session->userdata('id'));
        $this->db->where('uploadfiles_driver_id');
        }else{
        $this->db->where('uploadfiles_driver_id', $driverid);
        }
        $this->db->where('uploadfiles_processtype', 'driver_photo');
        $this->db->order_by('uploadfiles_id',"desc")->limit(1);
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_evdp_requireddoc($driverid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'evdp_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_driver_info($driverid)
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        if($driverid == NULL){
        $this->db->where('uploadfiles_company_id', $this->session->userdata('companyid'));
        $this->db->where('uploadfiles_lastchanged_by', $this->session->userdata('id'));
        $this->db->where('uploadfiles_driver_id');
        }else{
        $this->db->where('uploadfiles_driver_id', $driverid);
        }
        $this->db->where('uploadfiles_processtype', 'driver_info');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_avp_requireddoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'avp_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_avp_insurancedoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'avp_insurancedoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_evp_insurancedoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'evp_insurancedoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_evp_requireddoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'evp_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_permit_termination($permitid)
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_permit_id', $permitid);
        $this->db->where('uploadfiles_processtype', 'permit_termination');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_permit_replacement($permitid)
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_permit_id', $permitid);
        $this->db->where('uploadfiles_processtype', 'permit_replacement');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    /*
     * Insert file data into the database
     * @param array the data for inserting into the table
     */
    public function insert($data = [])
    {
        $insert = $this->db->insert_batch('uploadfiles', $data);
        return $insert ? true : false;
    }

    public function update($id, $data)
    {
        $this->db->where('uploadfiles_id', $id);
        $this->db->update('uploadfiles', $data);
    }

    public function delete($id)
    {
        $this->db->where('uploadfiles_id', $id);
        $this->db->delete('uploadfiles');
    }

    public function delete_unusedfiles()
    {
        $this->db->where('uploadfiles_processtype != ', 'driver_photo');
        $this->db->where('uploadfiles_processtype != ', 'driver_info');
        $this->db->where('uploadfiles_company_id', $this->session->userdata('companyid'));
        $this->db->where('uploadfiles_lastchanged_by', $this->session->userdata('id'));
        $this->db->where('uploadfiles_permit_id');
        $this->db->delete('uploadfiles');
    }

    public function delete_unusedfiles_driver()
    {
        $this->db->where('uploadfiles_processtype LIKE ', "driver%");
        $this->db->where('uploadfiles_company_id', $this->session->userdata('companyid'));
        $this->db->where('uploadfiles_lastchanged_by', $this->session->userdata('id'));
        $this->db->where('uploadfiles_driver_id');
        $this->db->delete('uploadfiles');
    }

    public function get_pbb_requireddoc($driverid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'pbb_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_sh_requireddoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'sh_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_sh_insurancedoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'sh_insurancedoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_vdgs_requireddoc($driverid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'vdgs_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_cs_requireddoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'cs_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_cs_insurancedoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'cs_insurancedoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_gpu_requireddoc($driverid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'gpu_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_pca_requireddoc($driverid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_driver_id', $driverid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'pca_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_wip_requireddoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'wip_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_wip_insurancedoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'wip_insurancedoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_shins_requireddoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'shins_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_shins_insurancedoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'shins_insurancedoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_wipbriefing_requireddoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'wipbriefing_requireddoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    public function get_wipbriefing_insurancedoc($vehicleid, $permitid = '')
    {
        $this->db->select('*');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_vehicle_id', $vehicleid);
        if ($permitid != '') {
            $this->db->where('uploadfiles_permit_id', $permitid);
        } else {
            $this->db->where('uploadfiles_permit_id');
        }
        $this->db->where('uploadfiles_processtype', 'wipbriefing_insurancedoc');
        $query  = $this->db->get();
        $result = $query->result_array();

        return !empty($result) ? $result : false;
    }

    function check_existing_file($processtype = '',$id_column = '',$id = '',$docname = '')
    {
        $this->db->select('uploadfiles_id');
        $this->db->from('uploadfiles');
        $this->db->where('uploadfiles_processtype', $processtype);
        $this->db->where($id_column, $id);
        $this->db->where('uploadfiles_docname', $docname);
        $this->db->limit(1);
        $query  = $this->db->get()->row();

        return 0;//isset($query->uploadfiles_id) ? $query->uploadfiles_id : 0 ;
    }

}
