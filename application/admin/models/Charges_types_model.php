<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Charges_types_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($category = 'serviceChages')
    {
        $this->db->select('*');
        $this->db->where('isactive', '1');

        if (!empty($category)) {
            $this->db->where('category', $category);
        }

        $this->db->from('charges_types');
        return $query = $this->db->get()->result();
    }

    public function charge_type_all($category = '')
    {
        $this->db->select('*');
        $this->db->where('isactive', '1');

        if (!empty($category)) {
            $this->db->where('category', $category);
        }

        $this->db->from('charges_types');
        $this->db->order_by('sorting', 'asc');
        return $query = $this->db->get()->result_array();
    }

    public function get_user_type($type)
    {
        $this->db->select('*');
        $this->db->where('user_isactive', '1');
        $this->db->where('user_groupid', $type);
        $this->db->from('userlist');
        return $query = $this->db->get()->result();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('ct_id', $id);
        $this->db->from('charges_types');
        return $query = $this->db->get()->row();
    }
    
    public function get_charges_types($id)
    {
		$curMonth = date('n');
		$curYear = date('Y');
		// $curMonth = 6;
		// $curYear = 2026;
		if($curYear == 2024)
		{
			if($curMonth >= 6)
			{	
				$this->db->select('*');
				$this->db->where('charges_types.ref_id', $id);
				$this->db->where('isactive', '1');
				$this->db->where('category', 'vehicle2024');
				$this->db->from('charges_types');
				$query = $this->db->get();
			}
			else
			{
				$this->db->select('*');
				$this->db->where('charges_types.ref_id', $id);
				$this->db->where('isactive', '1');
				$this->db->where('category', 'vehicle');
				$this->db->from('charges_types');
				$query = $this->db->get();
			}
		}
		else if($curYear == 2025)
		{
			$this->db->select('*');
			$this->db->where('charges_types.ref_id', $id);
			$this->db->where('isactive', '1');
			$this->db->where('category', 'vehicle2025');
			$this->db->from('charges_types');
			$query = $this->db->get();
		}
		else if($curYear == 2026)
		{
			$this->db->select('*');
			$this->db->where('charges_types.ref_id', $id);
			$this->db->where('isactive', '1');
			$this->db->where('category', 'vehicle2026');
			$this->db->from('charges_types');
			$query = $this->db->get();
		}
        //$this->db->select('*');
        //$this->db->where('charges_types.ref_id', $id);
        //$this->db->where('isactive', '1');
        //$this->db->where('category', 'vehicle');
        //$this->db->from('charges_types');
        //$query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }
    
    public function get_charges_types_driverpermit()
    {
		$curMonth = date('n');
		$curYear = date('Y');
		// $curMonth = 6;
		// $curYear = 2026;
		if($curYear == 2024)
		{
			if($curMonth >= 6)
			{	
				$this->db->select('*');
				$this->db->where('ct_id', 65);
				$this->db->where('isactive', '1');
				$this->db->from('charges_types');
				$query = $this->db->get();
			}
			else
			{
				$this->db->select('*');
				$this->db->where('ct_id', 16);
				$this->db->where('isactive', '1');
				$this->db->from('charges_types');
				$query = $this->db->get();
			}
		}
		else if($curYear == 2025)
		{
			$this->db->select('*');
			$this->db->where('ct_id', 66);
			$this->db->where('isactive', '1');
			$this->db->from('charges_types');
			$query = $this->db->get();
		}
		else if($curYear == 2026)
		{
			$this->db->select('*');
			$this->db->where('ct_id', 67);
			$this->db->where('isactive', '1');
			$this->db->from('charges_types');
			$query = $this->db->get();
		}			
        //$this->db->select('*');
        //$this->db->where('ct_id', 16);
        //$this->db->where('isactive', '1');
        //$this->db->from('charges_types');
        //$query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }
    
    public function get_charges_types_evp()
    {
        $this->db->select('*');
        $this->db->where('ct_id', 19);
        $this->db->where('isactive', '1');
        $this->db->from('charges_types');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }

    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('ct_id', $id);
        $this->db->from('charges_types');
        return $query = $this->db->get()->row();
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('ct_id', $id);
        $this->db->update('charges_types', $data);
    }

    public function total_avp_price_per_date($date, $kod = '', $paymentMethod = 1, $shift = 4, $paymentLocation = '')
    {
        if (empty($date) || $date == '1970-01-01' || $date == '1900-01-01' || $date == '0000-00-00') {
            return 0;
        }

        /*----------  starting query  ----------*/
        // $this->db->select('SUM(permit.permit_payment_new) as total_payment');
        $this->db->select("SUM(
                            CASE
                                WHEN permit.permit_payment_method != '4'
                                THEN permit.permit_payment_new
                                ELSE 0
                            END) as total_payment");
        $this->db->from('permit');

        $this->db->join('avppermit', 'permit.permit_id = avppermit.avppermit_permit_id', 'left');
        $this->db->join('vehicle', 'avppermit.avppermit_vehicle_id = vehicle.vehicle_id', 'left');
        $this->db->join('enginecapacity', 'vehicle.vehicle_engine_capacity = enginecapacity.enginecapacity_id', 'left');
        $this->db->join('charges_types', 'enginecapacity.enginecapacity_id = charges_types.ref_id', 'left');

        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        // $this->db->where('permit.permit_officialstatus', 'paid');
        $this->db->where('permit.permit_typeid', '4');

        if (!empty($kod)) {
            $this->db->where('charges_types.kod', $kod);
        }
        if (!empty($paymentMethod) && $paymentMethod > 0 && $paymentMethod > 0 && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }

        $this->db->group_by('permit.permit_typeid');
        $this->db->group_by('charges_types.kod');
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if (isset($query->total_payment) && $paymentMethod != 4) {
            return $query->total_payment;
        } else {
            return 0;
        }
    }

    public function total_avp_qty_price_per_date($date, $kod = '', $paymentMethod = 1, $shift = 4, $paymentLocation = '')
    {
        if (empty($date) || $date == '1970-01-01' || $date == '1900-01-01' || $date == '0000-00-00') {
            return 0;
        }

        /*----------  starting query  ----------*/
        // $this->db->select('SUM(permit.permit_payment_new) as total_payment');
        $this->db->select("COUNT(permit.permit_id) as total_payment");
        $this->db->from('permit');

        $this->db->join('avppermit', 'permit.permit_id = avppermit.avppermit_permit_id', 'left');
        $this->db->join('vehicle', 'avppermit.avppermit_vehicle_id = vehicle.vehicle_id', 'left');
        $this->db->join('enginecapacity', 'vehicle.vehicle_engine_capacity = enginecapacity.enginecapacity_id', 'left');
        $this->db->join('charges_types', 'enginecapacity.enginecapacity_id = charges_types.ref_id', 'left');

        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        // $this->db->where('permit.permit_officialstatus', 'paid');
        $this->db->where('permit.permit_typeid', '4');

        if (!empty($kod)) {
            $this->db->where('charges_types.kod', $kod);
        }
        if (!empty($paymentMethod) && $paymentMethod > 0 && $paymentMethod > 0 && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }

        $this->db->group_by('permit.permit_typeid');
        $this->db->group_by('charges_types.kod');
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if (isset($query->total_payment) && $paymentMethod != 4) {
            return $query->total_payment;
        } else {
            return 0;
        }
    }

    public function total_payment_by_type_per_date($date, $permit_type_array, $paymentMethod = 1, $shift = 4, $paymentLocation = '')
    {
        if (empty($date) || $date == '1970-01-01' || $date == '1900-01-01' || $date == '0000-00-00') {
            return 0;
        }

        /*----------  starting query  ----------*/
        // $this->db->select('SUM(permit.permit_payment_new) as total_payment');
        $this->db->select("SUM(
                            CASE
                                WHEN permit.permit_payment_method != '4'
                                THEN permit.permit_payment_new
                                ELSE 0
                            END) as total_payment");
        $this->db->from('permit');

        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        // $this->db->where('permit.permit_officialstatus', 'paid');

        if (!empty($permit_type_array)) {
            $this->db->where_in('permit.permit_typeid', $permit_type_array);
        }
        if (!empty($paymentMethod) && $paymentMethod > 0 && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }

        // $this->db->group_by('permit.permit_typeid');
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if (isset($query->total_payment)) {
            return $query->total_payment;
        } else {
            return 0;
        }
    }

    public function total_qty_by_type_per_date($date, $permit_type_array, $paymentMethod = 1, $shift = 4, $paymentLocation = '')
    {
        if (empty($date) || $date == '1970-01-01' || $date == '1900-01-01' || $date == '0000-00-00') {
            return 0;
        }

        /*----------  starting query  ----------*/
        // $this->db->select('SUM(permit.permit_payment_new) as total_payment');
        $this->db->select("COUNT(permit.permit_id) as total_payment");
        $this->db->from('permit');

        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        // $this->db->where('permit.permit_officialstatus', 'paid');

        if (!empty($permit_type_array)) {
            $this->db->where_in('permit.permit_typeid', $permit_type_array);
        }
        if (!empty($paymentMethod) && $paymentMethod > 0 && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }

        // $this->db->group_by('permit.permit_typeid');
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if (isset($query->total_payment)) {
            return $query->total_payment;
        } else {
            return 0;
        }
    }

    public function total_payment_by_type1_per_date($date, $permit_type_id, $paymentMethod = 1, $shift = 4, $pro_rated = 0, $paymentLocation = '')
    {
        if (empty($date) || $date == '1970-01-01' || $date == '1900-01-01' || $date == '0000-00-00') {
            return 0;
        }

        /*----------  starting query  ----------*/
        // $this->db->select('SUM(permit.permit_payment_new) as total_payment');
        $this->db->select("SUM(
                            CASE
                                WHEN permit.permit_payment_method != '4'
                                THEN permit.permit_payment_new
                                ELSE 0
                            END) as total_payment");
        $this->db->from('permit');

        /*----------  DATE selection  ----------*/
        // $selected_date = date('Y-m-d',strtotime($date));
        // $next_date = date('Y-m-d',strtotime($date.'+1 days'));

        // switch ($shift) {
        //     case 1:
        //         $between_sql = "BETWEEN '".$selected_date." 15:00:00.000' AND '".$selected_date." 20:59:59.997' ";
        //         break;
        //     case 2:
        //         $between_sql = "BETWEEN '".$selected_date." 21:00:00.000' AND '".$next_date." 07:59:59.997' ";
        //         break;
        //     case 3:
        //         $between_sql = "BETWEEN '".$next_date." 08:00:00.000' AND '".$next_date." 14:59:59.997' ";
        //         break;
        //     case 4:
        //         $between_sql = "BETWEEN '".$selected_date." 15:00:00.000' AND '".$next_date." 15:00:00.000' ";
        //         break;
        //     default:
        //         $between_sql = "BETWEEN '".$selected_date." 15:00:00.000' AND '".$next_date." 15:00:00.000' ";
        //         break;
        // }
        // $this->db->where('permit.permit_payment_statusPaidDate '.$between_sql );

        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        // $this->db->where('permit.permit_officialstatus', 'paid');

        if (!empty($permit_type_id)) {
            $this->db->where('permit.permit_typeid', $permit_type_id);
        }
        if (!empty($pro_rated) && $pro_rated == 1) {
            $this->db->where('permit.permit_payment_isOneYear', '2');
        }
        if (!empty($paymentMethod) && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }

        $this->db->group_by('permit.permit_typeid');
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if (isset($query->total_payment) && $paymentMethod != 4) {
            return $query->total_payment;
        } else {
            return 0;
        }
    }

    public function get_all_transaction_by_date($date, $paymentMethod = 1, $paymentLocation = '')
    {
        if (empty($date) || $date == '1970-01-01' || $date == '1900-01-01' || $date == '0000-00-00') {
            return array();
        }

        /*----------  starting query  ----------*/
        $this->db->select('permit.*');
        $this->db->from('permit');
        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        // $this->db->where('permit.permit_officialstatus', 'paid');

        if (!empty($paymentMethod) && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }

        // $this->db->group_by('permit.permit_typeid');
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
    }

    public function get_receipt_no_list($date, $paymentMethod = 1, $paymentLocation = '')
    {

        /*----------  starting query  ----------*/
        $this->db->select('permit_payment_invoiceno');
        $this->db->from('permit');
        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        if (!empty($paymentMethod) && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }
        $this->db->order_by('permit_payment_invoiceno', 'asc');
        $q = $this->db->get()->result();

        $res = array();
        if (isset($q) && count($q) > 0) {
            foreach ($q as $r) {
                $res[] = $r->permit_payment_invoiceno;
            }
        }

        $first = '';
        $last = '';
        if (!empty($res)) {
            $first = reset($res);
            $last = end($res);
        }

        return array('first' => $first, 'last' => $last);
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
