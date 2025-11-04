<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Offendlist_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('offendlist.*, offendlist_category.off_cat_name');
        $this->db->where('offendlist.offendlist_deleted_at IS NULL');
        $this->db->join('offendlist_category','offendlist_category.off_cat_ref = offendlist.offendlist_offendtype','left');
        $this->db->from('offendlist');
        return $query = $this->db->get()->result();
    }

    function category_sort_inarray()
    {
        $q = $this->get_all();
        $output = array();
        foreach($q as $r)
        {
            $output[$r->offendlist_offendtype]["type"]=$r->off_cat_name;
            $output[$r->offendlist_offendtype]["child"][]=$r;
        }

        return $output;
    }

    /**
     * Group offences by severity (for 2025) or fall back to category grouping (for 2019/2020)
     * 
     * @param string $revision The offence catalog revision year
     * @return array Grouped offences with 'type' and 'child' keys
     */
    function severity_sort_inarray($revision = '2025')
    {
        if ($revision === '2025') {
            $q = $this->get_offence_list_by_revision('2025');
            $output = array();
            
            // Define severity order: Low first, Critical last
            $severity_order = [
                'Low Offence' => 1,
                'Moderate Offence' => 2,
                'High Offence' => 3,
                'Critical Offence' => 4
            ];
            
            foreach($q as $r) {
                $severity = $r['offence_severity'];
                $output[$severity]["type"] = $severity;
                $output[$severity]["order"] = $severity_order[$severity] ?? 999;
                
                // Convert array to object for view compatibility
                $obj = (object) $r;
                $output[$severity]["child"][] = $obj;
            }
            
            // Sort by severity order
            uasort($output, function($a, $b) {
                return $a['order'] <=> $b['order'];
            });
            
            return $output;
        } else {
            // Fall back to category grouping for 2019/2020
            return $this->category_sort_inarray();
        }
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('offendlist_id', $id);
        $this->db->from('offendlist');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('offendlist_id', $id);
        $this->db->from('offendlist');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('offendlist', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('offendlist_id', $id);
        $this->db->update('offendlist', $data);
    }

// delete data
    public function remove($id)
    {
        // $this->db->where('offendlist_id', $id);
        // $this->db->update('offendlist', array(
        //     "deleted_at"=>$this->session->id,
        //     "deleted_by"=>date('Y-m-d H:i:s'),
        //     "active"=>0,
        // ));
    }

    /**
     * Get offence list by revision (2019/2020/2025)
     * Returns data with consistent field aliases for backward compatibility
     */
    public function get_offence_list_by_revision($revision = '2025')
    {
        if ($revision === '2025') {
            // New 2025 catalog with severity in table
            $this->db->select("
                offence_id AS offendlist_id,
                number AS offendlist_violationNo,
                violation AS offendlist_regNo,
                description AS offendlist_natureViolation,
                offence_severity AS off_cat_name,
                demerit_point AS offendlist_offenddemeritpoint,
                monetary_penalty,
                adp_suspension_text,
                avp_suspension_text,
                adp_suspension_text AS offendlist_period,
                offence_severity
            ");
            $this->db->from('offendlist_2025');
            $this->db->where('is_active', 1);
            $this->db->order_by('number', 'ASC');
        } elseif ($revision === '2020') {
            // 2020 catalog with category join
            $this->db->select("
                offendlist_2020.offendlist_id,
                offendlist_2020.offendlist_violationNo,
                offendlist_2020.offendlist_regNo,
                offendlist_2020.offendlist_natureViolation,
                offend_category.off_cat_name,
                offendlist_2020.offendlist_offenddemeritpoint,
                '' AS monetary_penalty,
                '' AS adp_suspension_text,
                '' AS avp_suspension_text,
                offend_category.off_cat_name AS offence_severity
            ");
            $this->db->from('offendlist_2020');
            $this->db->join('offend_category', 'offendlist_2020.offendlist_offendcategoryid = offend_category.off_cat_id', 'left');
            $this->db->order_by('offendlist_2020.offendlist_violationNo', 'ASC');
        } else {
            // 2019 catalog (default)
            $this->db->select("
                offendlist.offendlist_id,
                offendlist.offendlist_violationNo,
                offendlist.offendlist_regNo,
                offendlist.offendlist_natureViolation,
                offend_category.off_cat_name,
                offendlist.offendlist_offenddemeritpoint,
                '' AS monetary_penalty,
                '' AS adp_suspension_text,
                '' AS avp_suspension_text,
                offend_category.off_cat_name AS offence_severity
            ");
            $this->db->from('offendlist');
            $this->db->join('offend_category', 'offendlist.offendlist_offendcategoryid = offend_category.off_cat_id', 'left');
            $this->db->order_by('offendlist.offendlist_violationNo', 'ASC');
        }
        
        return $this->db->get()->result_array();
    }

    /**
     * Get specific offences by IDs with revision awareness
     * Critical for controller usage when fetching session offences
     */
    public function get_offences_by_ids($ids, $revision = '2025')
    {
        if (empty($ids) || !is_array($ids)) {
            return [];
        }
        
        if ($revision === '2025') {
            // New 2025 catalog
            $this->db->select("
                offence_id AS offendlist_id,
                number AS offendlist_violationNo,
                violation AS offendlist_regNo,
                description AS offendlist_natureViolation,
                offence_severity AS off_cat_name,
                demerit_point AS offendlist_offenddemeritpoint,
                monetary_penalty,
                adp_suspension_text,
                avp_suspension_text,
                offence_severity
            ");
            $this->db->from('offendlist_2025');
            $this->db->where_in('offence_id', $ids);
            $this->db->where('is_active', 1);
        } elseif ($revision === '2020') {
            // 2020 catalog
            $this->db->select("
                offendlist_2020.offendlist_id,
                offendlist_2020.offendlist_violationNo,
                offendlist_2020.offendlist_regNo,
                offendlist_2020.offendlist_natureViolation,
                offend_category.off_cat_name,
                offendlist_2020.offendlist_offenddemeritpoint,
                '' AS monetary_penalty,
                '' AS adp_suspension_text,
                '' AS avp_suspension_text,
                offend_category.off_cat_name AS offence_severity
            ");
            $this->db->from('offendlist_2020');
            $this->db->join('offend_category', 'offendlist_2020.offendlist_offendcategoryid = offend_category.off_cat_id', 'left');
            $this->db->where_in('offendlist_2020.offendlist_id', $ids);
        } else {
            // 2019 catalog
            $this->db->select("
                offendlist.offendlist_id,
                offendlist.offendlist_violationNo,
                offendlist.offendlist_regNo,
                offendlist.offendlist_natureViolation,
                offend_category.off_cat_name,
                offendlist.offendlist_offenddemeritpoint,
                '' AS monetary_penalty,
                '' AS adp_suspension_text,
                '' AS avp_suspension_text,
                offend_category.off_cat_name AS offence_severity
            ");
            $this->db->from('offendlist');
            $this->db->join('offend_category', 'offendlist.offendlist_offendcategoryid = offend_category.off_cat_id', 'left');
            $this->db->where_in('offendlist.offendlist_id', $ids);
        }
        
        return $this->db->get()->result_array();
    }

    /**
     * Get offences grouped by severity (for 2025 catalog UI grouping)
     */
    public function get_offences_grouped_by_severity($revision = '2025')
    {
        $offences = $this->get_offence_list_by_revision($revision);
        
        $grouped = [
            'Low Offence' => [],
            'Moderate Offence' => [],
            'High Offence' => [],
            'Critical Offence' => []
        ];
        
        foreach ($offences as $offence) {
            $severity = $offence['offence_severity'];
            if (isset($grouped[$severity])) {
                $grouped[$severity][] = $offence;
            }
        }
        
        // Remove empty groups
        return array_filter($grouped, function($group) {
            return !empty($group);
        });
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
