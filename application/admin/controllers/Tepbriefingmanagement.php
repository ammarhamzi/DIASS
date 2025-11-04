<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Tepbriefingmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('tepbriefingmanagement_model');
    $this->lang->load('tepbriefingmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    $tepbriefingmanagement = $this->tepbriefingmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    'tepbriefingmanagement_data' => $tepbriefingmanagement,
    'permission' => $this->permission,
    );

    $this->content = 'tepbriefingmanagement/tepbriefingmanagement_list';
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
    $row = $this->tepbriefingmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'tepbriefingmanagement_date' => $row->tepbriefingmanagement_date,
		'tepbriefingmanagement_location' => $row->tepbriefingmanagement_location,
		'tepbriefingmanagement_slot' => $row->tepbriefingmanagement_slot,
		'tepbriefingmanagement_remark' => $row->tepbriefingmanagement_remark,
		
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

    $this->content = 'tepbriefingmanagement/tepbriefingmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('tepbriefingmanagement/tepbriefingmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepbriefingmanagement'));
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
        'action' => site_url('tepbriefingmanagement/create_action'),
        'tepbriefingmanagement_date' => set_value('tepbriefingmanagement_date'),
		'tepbriefingmanagement_location' => set_value('tepbriefingmanagement_location'),
		'dropdown_tepbriefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'tepbriefingmanagement_slot' => set_value('tepbriefingmanagement_slot'),
		'tepbriefingmanagement_remark' => set_value('tepbriefingmanagement_remark'),
		
);
    $this->content = 'tepbriefingmanagement/tepbriefingmanagement_form';
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
        'tepbriefingmanagement_date' => $this->input->post('tepbriefingmanagement_date',TRUE),
		'tepbriefingmanagement_location' => $this->input->post('tepbriefingmanagement_location',TRUE),
		'tepbriefingmanagement_slot' => $this->input->post('tepbriefingmanagement_slot',TRUE),
		'tepbriefingmanagement_remark' => $this->input->post('tepbriefingmanagement_remark',TRUE),
		'tepbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
		 'tepbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->tepbriefingmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('tepbriefingmanagement'));
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
    $row = $this->tepbriefingmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('tepbriefingmanagement/update_action'),
        'id' => $id,
        'tepbriefingmanagement_date' => set_value('tepbriefingmanagement_date', $row->tepbriefingmanagement_date),
		'tepbriefingmanagement_location' => set_value('tepbriefingmanagement_location', $row->tepbriefingmanagement_location),
		'dropdown_tepbriefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'tepbriefingmanagement_slot' => set_value('tepbriefingmanagement_slot', $row->tepbriefingmanagement_slot),
		'tepbriefingmanagement_remark' => set_value('tepbriefingmanagement_remark', $row->tepbriefingmanagement_remark),
		
      );
    $this->content = 'tepbriefingmanagement/tepbriefingmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('tepbriefingmanagement_id', TRUE));
    }
    else {
      $data = array(
        'tepbriefingmanagement_date' => $this->input->post('tepbriefingmanagement_date',TRUE),
		'tepbriefingmanagement_location' => $this->input->post('tepbriefingmanagement_location',TRUE),
		'tepbriefingmanagement_slot' => $this->input->post('tepbriefingmanagement_slot',TRUE),
		'tepbriefingmanagement_remark' => $this->input->post('tepbriefingmanagement_remark',TRUE),
		'tepbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'tepbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->tepbriefingmanagement_model->update(fixzy_decoder($this->input->post('tepbriefingmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('tepbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->tepbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->tepbriefingmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('tepbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->tepbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'tepbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->tepbriefingmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('tepbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('tepbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('tepbriefingmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('tepbriefingmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('tepbriefingmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('tepbriefingmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'tepbriefingmanagement_id',
		'tepbriefingmanagement_date',
		'tepbriefingmanagement_location',
		'tepbriefingmanagement_slot',
		'tepbriefingmanagement_remark',
		
      );
      $results = $this->tepbriefingmanagement_model->listajax(
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
              $rud .=  anchor(site_url('tepbriefingmanagement/read/'.fixzy_encoder($r['tepbriefingmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('tepbriefingmanagement/update/'.fixzy_encoder($r['tepbriefingmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('tepbriefingmanagement/delete/'.fixzy_encoder($r['tepbriefingmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['tepbriefingmanagement_date'],
				$r['tepbriefingmanagement_location'],
				$r['tepbriefingmanagement_slot'],
			   /*	$r['tepbriefingmanagement_remark'],*/
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->tepbriefingmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->tepbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

    public function get_availableslot($type='')
    {

    $date = new DateTime(date('Y-m-d'));
    $date->modify('+3 day');
    $firstdate = $date->format('Y-m-d');

        $row = $this->tepbriefingmanagement_model->get_slot($firstdate, $type);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
/*            $available  = (int) $value->tepbriefingmanagement_slot - (int) $value->tepbriefingmanagement_slottaken;

            $title = $value->tepbriefingmanagement_location.'-'.$available.'/'. $value->tepbriefingmanagement_slot;*/
$title = $value->tepbriefingmanagement_location.'-'.(!empty($value->tepbriefingmanagement_slottaken)?$value->tepbriefingmanagement_slottaken:'0').'/'. $value->tepbriefingmanagement_slot;

if($value->tepbriefingmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->tepbriefingmanagement_location == 'KLIA2'){
$color = '#6C3483';
}

            $calendar[] = [
                "id" => $value->tepbriefingmanagement_id,
                "title" => $title,
                "start" => $value->tepbriefingmanagement_date,
                "end" => $value->tepbriefingmanagement_date,
                "color"  => $color
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Tepbriefingmanagement.php */
/* Location: ./application/controllers/Tepbriefingmanagement.php */