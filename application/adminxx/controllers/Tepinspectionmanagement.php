<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Tepinspectionmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('tepinspectionmanagement_model');
    $this->lang->load('tepinspectionmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    $tepinspectionmanagement = $this->tepinspectionmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    'tepinspectionmanagement_data' => $tepinspectionmanagement,
    'permission' => $this->permission,
    );

    $this->content = 'tepinspectionmanagement/tepinspectionmanagement_list';
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
    $row = $this->tepinspectionmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'tepinspectionmanagement_date' => $row->tepinspectionmanagement_date,
		'tepinspectionmanagement_location' => $row->tepinspectionmanagement_location,
		'tepinspectionmanagement_slot' => $row->tepinspectionmanagement_slot,
		'tepinspectionmanagement_remark' => $row->tepinspectionmanagement_remark,
		
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

    $this->content = 'tepinspectionmanagement/tepinspectionmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('tepinspectionmanagement/tepinspectionmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepinspectionmanagement'));
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
        'action' => site_url('tepinspectionmanagement/create_action'),
        'tepinspectionmanagement_date' => set_value('tepinspectionmanagement_date'),
		'tepinspectionmanagement_location' => set_value('tepinspectionmanagement_location'),
		'dropdown_tepinspectionmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'tepinspectionmanagement_slot' => set_value('tepinspectionmanagement_slot'),
		'tepinspectionmanagement_remark' => set_value('tepinspectionmanagement_remark'),
		
);
    $this->content = 'tepinspectionmanagement/tepinspectionmanagement_form';
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
        'tepinspectionmanagement_date' => $this->input->post('tepinspectionmanagement_date',TRUE),
		'tepinspectionmanagement_location' => $this->input->post('tepinspectionmanagement_location',TRUE),
		'tepinspectionmanagement_slot' => $this->input->post('tepinspectionmanagement_slot',TRUE),
		'tepinspectionmanagement_remark' => $this->input->post('tepinspectionmanagement_remark',TRUE),
		'tepinspectionmanagement_created_at' => date('Y-m-d H:i:s'),
		 'tepinspectionmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->tepinspectionmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('tepinspectionmanagement'));
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
    $row = $this->tepinspectionmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('tepinspectionmanagement/update_action'),
        'id' => $id,
        'tepinspectionmanagement_date' => set_value('tepinspectionmanagement_date', $row->tepinspectionmanagement_date),
		'tepinspectionmanagement_location' => set_value('tepinspectionmanagement_location', $row->tepinspectionmanagement_location),
		'dropdown_tepinspectionmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'tepinspectionmanagement_slot' => set_value('tepinspectionmanagement_slot', $row->tepinspectionmanagement_slot),
		'tepinspectionmanagement_remark' => set_value('tepinspectionmanagement_remark', $row->tepinspectionmanagement_remark),
		
      );
    $this->content = 'tepinspectionmanagement/tepinspectionmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('tepinspectionmanagement_id', TRUE));
    }
    else {
      $data = array(
        'tepinspectionmanagement_date' => $this->input->post('tepinspectionmanagement_date',TRUE),
		'tepinspectionmanagement_location' => $this->input->post('tepinspectionmanagement_location',TRUE),
		'tepinspectionmanagement_slot' => $this->input->post('tepinspectionmanagement_slot',TRUE),
		'tepinspectionmanagement_remark' => $this->input->post('tepinspectionmanagement_remark',TRUE),
		'tepinspectionmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'tepinspectionmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->tepinspectionmanagement_model->update(fixzy_decoder($this->input->post('tepinspectionmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('tepinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->tepinspectionmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->tepinspectionmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('tepinspectionmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->tepinspectionmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'tepinspectionmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->tepinspectionmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('tepinspectionmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('tepinspectionmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('tepinspectionmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('tepinspectionmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('tepinspectionmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'tepinspectionmanagement_id',
		'tepinspectionmanagement_date',
		'tepinspectionmanagement_location',
		'tepinspectionmanagement_slot',
		'tepinspectionmanagement_remark',
		
      );
      $results = $this->tepinspectionmanagement_model->listajax(
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
/*                      if($this->permission->cp_read == true){
              $rud .=  anchor(site_url('tepinspectionmanagement/read/'.fixzy_encoder($r['tepinspectionmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }*/
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('tepinspectionmanagement/update/'.fixzy_encoder($r['tepinspectionmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('tepinspectionmanagement/delete/'.fixzy_encoder($r['tepinspectionmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['tepinspectionmanagement_date'],
				$r['tepinspectionmanagement_location'],
				$r['tepinspectionmanagement_slot'],
				$r['tepinspectionmanagement_remark'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->tepinspectionmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->tepinspectionmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

    public function get_availableslot($type='')
    {
        $row = $this->tepinspectionmanagement_model->get_slot($type);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
/*            $available  = (int) $value->tepinspectionmanagement_slot - (int) $value->tepinspectionmanagement_slottaken;

            $title = $value->tepinspectionmanagement_location.'-'.$available.'/'. $value->tepinspectionmanagement_slot;*/
$title = $value->tepinspectionmanagement_location.'- Booked '.(!empty($value->tepinspectionmanagement_slottaken)?$value->tepinspectionmanagement_slottaken:'0').'/'. $value->tepinspectionmanagement_slot;

if($value->tepinspectionmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->tepinspectionmanagement_location == 'KLIA2'){
$color = '#6C3483';
}

            $calendar[] = [
                "id" => $value->tepinspectionmanagement_id,
                "title" => $title,
                "start" => $value->tepinspectionmanagement_date,
                "end" => $value->tepinspectionmanagement_date,
                "color"  => $color
            ];
        }

        echo json_encode($calendar);
    }
}
;
/* End of file Tepinspectionmanagement.php */
/* Location: ./application/controllers/Tepinspectionmanagement.php */