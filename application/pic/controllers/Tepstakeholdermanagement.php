<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Tepstakeholdermanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('tepstakeholdermanagement_model');
    $this->lang->load('tepstakeholdermanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$tepstakeholdermanagement = $this->tepstakeholdermanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'tepstakeholdermanagement_data' => $tepstakeholdermanagement,
    'permission' => $this->permission,
    );

    $this->content = 'tepstakeholdermanagement/tepstakeholdermanagement_list';
    ##--slave_combine_to_list--##
    $this->layout($data, $setting);

	 }else{
      redirect('/');
     }

  }

  //type=normal/raw
  public function read($id, $type="normal") {

   if($this->permission->cp_read == true){

    $id = fixzy_decoder($id);
    $setting = array(
    'method'=>'newpage',
    'patern'=>'read',
    );
    $row = $this->tepstakeholdermanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'tepstakeholdermanagement_date' => $row->tepstakeholdermanagement_date,
		'tepstakeholdermanagement_location' => $row->tepstakeholdermanagement_location,
		'tepstakeholdermanagement_slot' => $row->tepstakeholdermanagement_slot,
		'tepstakeholdermanagement_remark' => $row->tepstakeholdermanagement_remark,
		
      );

if($type==='normal'){
//check if parentchild exist
$parent_id = $this->my_model->get_value2('tabslave', 'tabslave_id',
    "tabslave_controller = '".strtolower($this->router->fetch_class())."' and tabslave_parent_id = 0");

if (!empty($parent_id)) {
    $data_parentchild = array(
        'parentchildmenu' => $this->my_model->get_data('tabslave', '*',
            "tabslave_parent_id = $parent_id"),
        'currentcontroller' => strtolower($this->router->fetch_class()),
        'parentid' => fixzy_encoder($id),
    );

    $this->parentchildmenu = $this->load->view('foundation/parentchildmenu',
        $data_parentchild, true);
}

    $this->content = 'tepstakeholdermanagement/tepstakeholdermanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('tepstakeholdermanagement/tepstakeholdermanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepstakeholdermanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function create() {

   if($this->permission->cp_create == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'form',
    );
    $data = array(
        'button' => 'Create',
        'action' => site_url('tepstakeholdermanagement/create_action'),
        'tepstakeholdermanagement_date' => set_value('tepstakeholdermanagement_date'),
		'tepstakeholdermanagement_location' => set_value('tepstakeholdermanagement_location'),
		'dropdown_tepstakeholdermanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'tepstakeholdermanagement_slot' => set_value('tepstakeholdermanagement_slot'),
		'tepstakeholdermanagement_remark' => set_value('tepstakeholdermanagement_remark'),
		
);
    $this->content = 'tepstakeholdermanagement/tepstakeholdermanagement_form';
    $this->layout($data, $setting);

   }else{
     redirect('/');
   }

  }

  public function create_action() {

   if($this->permission->cp_create == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->create();
    }
    else {
      $data = array(
        'tepstakeholdermanagement_date' => $this->input->post('tepstakeholdermanagement_date',TRUE),
		'tepstakeholdermanagement_location' => $this->input->post('tepstakeholdermanagement_location',TRUE),
		'tepstakeholdermanagement_slot' => $this->input->post('tepstakeholdermanagement_slot',TRUE),
		'tepstakeholdermanagement_remark' => $this->input->post('tepstakeholdermanagement_remark',TRUE),
		'tepstakeholdermanagement_created_at' => date('Y-m-d H:i:s'),
		 'tepstakeholdermanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->tepstakeholdermanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('tepstakeholdermanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update($id) {


   if($this->permission->cp_update == true){

      $setting = array(
    'method'=>'newpage',
    'patern'=>'form',
    );
    $row = $this->tepstakeholdermanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('tepstakeholdermanagement/update_action'),
        'id' => $id,
        'tepstakeholdermanagement_date' => set_value('tepstakeholdermanagement_date', $row->tepstakeholdermanagement_date),
		'tepstakeholdermanagement_location' => set_value('tepstakeholdermanagement_location', $row->tepstakeholdermanagement_location),
		'dropdown_tepstakeholdermanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'tepstakeholdermanagement_slot' => set_value('tepstakeholdermanagement_slot', $row->tepstakeholdermanagement_slot),
		'tepstakeholdermanagement_remark' => set_value('tepstakeholdermanagement_remark', $row->tepstakeholdermanagement_remark),
		
      );
    $this->content = 'tepstakeholdermanagement/tepstakeholdermanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepstakeholdermanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('tepstakeholdermanagement_id', TRUE));
    }
    else {
      $data = array(
        'tepstakeholdermanagement_date' => $this->input->post('tepstakeholdermanagement_date',TRUE),
		'tepstakeholdermanagement_location' => $this->input->post('tepstakeholdermanagement_location',TRUE),
		'tepstakeholdermanagement_slot' => $this->input->post('tepstakeholdermanagement_slot',TRUE),
		'tepstakeholdermanagement_remark' => $this->input->post('tepstakeholdermanagement_remark',TRUE),
		'tepstakeholdermanagement_updated_at' => date('Y-m-d H:i:s'),
		 'tepstakeholdermanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->tepstakeholdermanagement_model->update(fixzy_decoder($this->input->post('tepstakeholdermanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('tepstakeholdermanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->tepstakeholdermanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->tepstakeholdermanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('tepstakeholdermanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepstakeholdermanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->tepstakeholdermanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'tepstakeholdermanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->tepstakeholdermanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('tepstakeholdermanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepstakeholdermanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('tepstakeholdermanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('tepstakeholdermanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('tepstakeholdermanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('tepstakeholdermanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'tepstakeholdermanagement_id',
		'tepstakeholdermanagement_date',
		'tepstakeholdermanagement_location',
		'tepstakeholdermanagement_slot',
		'tepstakeholdermanagement_remark',
		
      );
      $results = $this->tepstakeholdermanagement_model->listajax(
        $columns,
        $this->input->get('start'),
        $this->input->get('length'),
        $this->input->get('search')['value'],
        $columns[$this->input->get('order')[0]['column']],
        $this->input->get('order')[0]['dir']
      );
        $data = array();
        foreach ($results  as $r) {
          $i++;
      $rud = "";
                      if($this->permission->cp_read == true){
              $rud .=  anchor(site_url('tepstakeholdermanagement/read/'.fixzy_encoder($r['tepstakeholdermanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('tepstakeholdermanagement/update/'.fixzy_encoder($r['tepstakeholdermanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('tepstakeholdermanagement/delete/'.fixzy_encoder($r['tepstakeholdermanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['tepstakeholdermanagement_date'],
				$r['tepstakeholdermanagement_location'],
				$r['tepstakeholdermanagement_slot'],
				/*$r['tepstakeholdermanagement_remark'],*/
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->tepstakeholdermanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->tepstakeholdermanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

    public function get_availableslot($type='')
    {

    $date = new DateTime(date('Y-m-d'));
    /*$date->modify('+3 day');*/
    $newdate = $date->format('Y-m-d');
    $firstdate = addWorkingDays($newdate,'3')->format('Y-m-d');

        $row = $this->tepstakeholdermanagement_model->get_slot($firstdate,$type);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
/*            $available  = (int) $value->tepstakeholdermanagement_slot - (int) $value->tepstakeholdermanagement_slottaken;

            $title = $value->tepstakeholdermanagement_location.'-'.$available.'/'. $value->tepstakeholdermanagement_slot;*/
$title = $value->tepstakeholdermanagement_location.'-'.(!empty($value->tepstakeholdermanagement_slottaken)?$value->tepstakeholdermanagement_slottaken:'0').'/'. $value->tepstakeholdermanagement_slot;

if($value->tepstakeholdermanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->tepstakeholdermanagement_location == 'KLIA2'){
$color = '#6C3483';
}

            $calendar[] = [
                "id" => $value->tepstakeholdermanagement_id,
                "title" => $title,
                "start" => $value->tepstakeholdermanagement_date,
                "end" => $value->tepstakeholdermanagement_date,
                "color"  => $color
            ];
        }

        echo json_encode($calendar);
    }
}
;
/* End of file Tepstakeholdermanagement.php */
/* Location: ./application/controllers/Tepstakeholdermanagement.php */