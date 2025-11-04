<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payment_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all_payment_permit($date, $paymentMethod = 1, $paymentLocation = '')
    {
        if (empty($date) || $date == '1970-01-01' || $date == '0000-00-00') {
            return false;
        }

        /*----------  permit payment  ----------*/
        $this->db->select("'1' as kod, '' as jenis, permit.permit_id as ids, permit_issuance_serialno as rujukan, permit_type.permit_type_desc as keterangan, permit.permit_payment_statusPaidDate as paidDate, permit.permit_payment_location as lokasi, permit.permit_payment_method as paymentMethod,
            CASE
                WHEN permit.permit_payment_method = '4'
                THEN  0
                ELSE permit.permit_payment_new
            END as paymentTotal", false);
        $this->db->from('permit');
        $this->db->join('permit_type', 'permit_type.permit_type_id = permit.permit_typeid', 'LEFT');
        $this->db->where('CAST(permit.permit_payment_statusPaidDate as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('permit.permit_deleted_at IS NULL');
        // $this->db->order_by('permit.permit_payment_statusPaidDate', 'ASC');

        if (!empty($paymentMethod) && $paymentMethod > 0 && $paymentMethod > 0 && $paymentMethod > 0) {
            $this->db->where('permit.permit_payment_method', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('permit.permit_payment_location', $paymentLocation);
        }
        $query1_sql = $this->db->get_compiled_select();

        /*----------  service charge payment  ----------*/
        $this->db->select("charges_types.kod as kod, charges_types.name as jenis, servicecharges.servicecharges_id as ids, servicecharges.servicecharges_requestorcompanyname as rujukan, charges_types.name as keterangan, servicecharges.servicecharges_paymentDatetime as paidDate, servicecharges.servicecharges_paymentLocation as lokasi, servicecharges.servicecharges_paymentMethod as paymentMethod,
            (CASE
                WHEN servicecharges.servicecharges_paymentMethod = '4'
                THEN  0
                ELSE servicecharges.servicecharges_qty
            END * CONVERT(DECIMAL(16, 2), charges_types.price)) as paymentTotal", false);
        $this->db->from('servicecharges');
        $this->db->join('charges_types', 'charges_types.ct_id = servicecharges.servicecharges_ct_id', 'LEFT');
        $this->db->where('CAST(servicecharges.servicecharges_paymentDatetime as DATE) =', date('Y-m-d', strtotime($date)));
        $this->db->where('servicecharges.deleted_at IS NULL');
        $this->db->order_by('paidDate', 'ASC');

        if (!empty($paymentMethod) && $paymentMethod > 0 && $paymentMethod > 0 && $paymentMethod > 0) {
            $this->db->where('servicecharges.servicecharges_paymentMethod', $paymentMethod);
        }
        if (!empty($paymentLocation)) {
            $this->db->where('servicecharges.servicecharges_paymentLocation', $paymentLocation);
        }
        $query2_sql = $this->db->get_compiled_select();

        /*----------  final result query  ----------*/
        $final_q = $this->db->query("$query1_sql UNION ALL $query2_sql");

        return $final_q->result();
    }
}
/* End of file Payment_model.php */
/* Location: ./application/models/Payment_model.php */
