<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Service_charges_model extends CI_Model
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

    public function pdf_read($id)
    {
        $this->db->select('servicecharges.*, charges_types.name as charges_types_name, (servicecharges.servicecharges_qty*charges_types.price) as total_charges');
        $this->db->where('servicecharges.active', '1');
        $this->db->where('servicecharges.servicecharges_id', $id);
        $this->db->join('charges_types','servicecharges.servicecharges_ct_id = charges_types.ct_id','left');
        $this->db->from('servicecharges');
        return $query = $this->db->get()->row();
    }

    public function get_user_type($type)
    {
        $this->db->select('*');
        $this->db->where('user_isactive', '1');
        $this->db->where('user_groupid',$type);
        $this->db->from('userlist');
        return $query = $this->db->get()->result();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('servicecharges_id', $id);
        $this->db->from('servicecharges');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('*', false);
        $this->db->where('servicecharges_id', $id);
        $this->db->from('servicecharges');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('servicecharges', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('servicecharges_id', $id);
        $this->db->update('servicecharges', $data);
    }

// delete data
    public function remove($id)
    {
        $this->db->where('servicecharges_id', $id);
        $this->db->update('servicecharges', array(
            "deleted_at"=>date('Y-m-d H:i:s'),
            "deleted_by"=>$this->session->id,
            "active"=>0,
        ));
    }

    function category_charges_price_per_date($date,$category,$paymentMethod = 1,$shift = 4)
    {
        if(empty($date) || $date == '1970-01-01' || $date == '0000-00-00')
        {
            return 0;
        }

        if(!in_array($paymentMethod, array('0','1','2','3','4')))
        {
            return 0;
        }

        /*----------  DATE selection  ----------*/
        $selected_date = date('Y-m-d',strtotime($date));
        $next_date = date('Y-m-d',strtotime($date.'+1 days'));

        switch ($shift) {
            case 1:
                $between_sql = "BETWEEN '".$selected_date." 15:00:00.000' AND '".$selected_date." 20:59:59.997' ";
                break;
            case 2:
                $between_sql = "BETWEEN '".$selected_date." 21:00:00.000' AND '".$next_date." 07:59:59.997' ";
                break;
            case 3:
                $between_sql = "BETWEEN '".$next_date." 08:00:00.000' AND '".$next_date." 14:59:59.997' ";
                break;
            case 4:
                $between_sql = "BETWEEN '".$selected_date." 15:00:00.000' AND '".$next_date." 15:00:00.000' ";
                break;
            default:
                $between_sql = "BETWEEN '".$selected_date." 15:00:00.000' AND '".$next_date." 15:00:00.000' ";
                break;
        }

        $this->db->select('servicecharges.servicecharges_id, SUM(servicecharges.servicecharges_qty) as total_qty');
        $this->db->join('charges_types','servicecharges.servicecharges_ct_id = charges_types.ct_id','left');
        $this->db->where('servicecharges.active', '1');
        // $this->db->where('CAST(servicecharges.created_at as DATE) =', date('Y-m-d',strtotime($date)));
        $this->db->where('servicecharges.created_at '.$between_sql );
        $this->db->where('servicecharges.servicecharges_ct_id', $category);
        if($paymentMethod > 0)
        {
            $this->db->where('servicecharges.servicecharges_paymentMethod', $paymentMethod);
        }
        $this->db->from('servicecharges');
        $this->db->group_by('servicecharges.servicecharges_id');
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if(isset($query->total_qty) && $paymentMethod != 4)
        {
            return $query->total_qty;
        }
        else
        {
            return 0;
        }
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
