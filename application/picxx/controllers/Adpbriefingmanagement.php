<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Adpbriefingmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('adpbriefingmanagement_model');
    $this->lang->load('adpbriefingmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$adpbriefingmanagement = $this->adpbriefingmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    /*'adpbriefingmanagement_data' => $adpbriefingmanagement,*/
    'permission' => $this->permission,
    );

    $this->content = 'adpbriefingmanagement/adpbriefingmanagement_list';
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
    $row = $this->adpbriefingmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'adpbriefingmanagement_date' => $row->adpbriefingmanagement_date,
		'adpbriefingmanagement_category' => $row->adpbriefingmanagement_category,
		'adpbriefingmanagement_condition' => $row->adpbriefingmanagement_condition,
		'adpbriefingmanagement_location' => $row->adpbriefingmanagement_location,
		'adpbriefingmanagement_slot' => $row->adpbriefingmanagement_slot,
		'adpbriefingmanagement_remark' => $row->adpbriefingmanagement_remark,
		
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

    $this->content = 'adpbriefingmanagement/adpbriefingmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('adpbriefingmanagement/adpbriefingmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('adpbriefingmanagement'));
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
        'action' => site_url('adpbriefingmanagement/create_action'),
        'adpbriefingmanagement_date' => set_value('adpbriefingmanagement_date'),
		'adpbriefingmanagement_category' => set_value('adpbriefingmanagement_category'),
		'dropdown_adpbriefingmanagement_category' =>  array(
(object)array('id'=>'A','value'=>'A'),(object)array('id'=>'B1','value'=>'B1'),(object)array('id'=>'B2','value'=>'B2'),(object)array('id'=>'C','value'=>'C'),
),
		'adpbriefingmanagement_condition' => set_value('adpbriefingmanagement_condition'),
		'dropdown_adpbriefingmanagement_condition' =>  array(
(object)array('id'=>'New','value'=>'New'),(object)array('id'=>'Renewal','value'=>'Renewal'),
),
		'adpbriefingmanagement_location' => set_value('adpbriefingmanagement_location'),
		'dropdown_adpbriefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'adpbriefingmanagement_slot' => set_value('adpbriefingmanagement_slot'),
		'adpbriefingmanagement_remark' => set_value('adpbriefingmanagement_remark'),
		
);
    $this->content = 'adpbriefingmanagement/adpbriefingmanagement_form';
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
        'adpbriefingmanagement_date' => $this->input->post('adpbriefingmanagement_date',TRUE),
		'adpbriefingmanagement_category' => $this->input->post('adpbriefingmanagement_category',TRUE),
		'adpbriefingmanagement_condition' => $this->input->post('adpbriefingmanagement_condition',TRUE),
		'adpbriefingmanagement_location' => $this->input->post('adpbriefingmanagement_location',TRUE),
		'adpbriefingmanagement_slot' => $this->input->post('adpbriefingmanagement_slot',TRUE),
		'adpbriefingmanagement_remark' => $this->input->post('adpbriefingmanagement_remark',TRUE),
		'adpbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
		 'adpbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->adpbriefingmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('adpbriefingmanagement'));
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
    $row = $this->adpbriefingmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('adpbriefingmanagement/update_action'),
        'id' => $id,
        'adpbriefingmanagement_date' => set_value('adpbriefingmanagement_date', $row->adpbriefingmanagement_date),
		'adpbriefingmanagement_category' => set_value('adpbriefingmanagement_category', $row->adpbriefingmanagement_category),
		'dropdown_adpbriefingmanagement_category' =>  array(
(object)array('id'=>'A','value'=>'A'),(object)array('id'=>'B1','value'=>'B1'),(object)array('id'=>'B2','value'=>'B2'),(object)array('id'=>'C','value'=>'C'),
),
		'adpbriefingmanagement_condition' => set_value('adpbriefingmanagement_condition', $row->adpbriefingmanagement_condition),
		'dropdown_adpbriefingmanagement_condition' =>  array(
(object)array('id'=>'New','value'=>'New'),(object)array('id'=>'Renewal','value'=>'Renewal'),
),
		'adpbriefingmanagement_location' => set_value('adpbriefingmanagement_location', $row->adpbriefingmanagement_location),
		'dropdown_adpbriefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'adpbriefingmanagement_slot' => set_value('adpbriefingmanagement_slot', $row->adpbriefingmanagement_slot),
		'adpbriefingmanagement_remark' => set_value('adpbriefingmanagement_remark', $row->adpbriefingmanagement_remark),
		
      );
    $this->content = 'adpbriefingmanagement/adpbriefingmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('adpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('adpbriefingmanagement_id', TRUE));
    }
    else {
      $data = array(
        'adpbriefingmanagement_date' => $this->input->post('adpbriefingmanagement_date',TRUE),
		'adpbriefingmanagement_category' => $this->input->post('adpbriefingmanagement_category',TRUE),
		'adpbriefingmanagement_condition' => $this->input->post('adpbriefingmanagement_condition',TRUE),
		'adpbriefingmanagement_location' => $this->input->post('adpbriefingmanagement_location',TRUE),
		'adpbriefingmanagement_slot' => $this->input->post('adpbriefingmanagement_slot',TRUE),
		'adpbriefingmanagement_remark' => $this->input->post('adpbriefingmanagement_remark',TRUE),
		'adpbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'adpbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->adpbriefingmanagement_model->update(fixzy_decoder($this->input->post('adpbriefingmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('adpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->adpbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->adpbriefingmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('adpbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('adpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->adpbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'adpbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->adpbriefingmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('adpbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('adpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('adpbriefingmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('adpbriefingmanagement_category', ' ', 'trim|required');
	$this->form_validation->set_rules('adpbriefingmanagement_condition', ' ', 'trim|required');
	$this->form_validation->set_rules('adpbriefingmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('adpbriefingmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('adpbriefingmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'adpbriefingmanagement_id',
		'adpbriefingmanagement_date',
		'adpbriefingmanagement_category',
		'adpbriefingmanagement_condition',
		'adpbriefingmanagement_location',
		'adpbriefingmanagement_slot',
		'adpbriefingmanagement_remark',
		
      );
      $results = $this->adpbriefingmanagement_model->listajax(
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
              $rud .=  anchor(site_url('adpbriefingmanagement/read/'.fixzy_encoder($r['adpbriefingmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('adpbriefingmanagement/update/'.fixzy_encoder($r['adpbriefingmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('adpbriefingmanagement/delete/'.fixzy_encoder($r['adpbriefingmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['adpbriefingmanagement_date'],
				$r['adpbriefingmanagement_category'],
				$r['adpbriefingmanagement_condition'],
				$r['adpbriefingmanagement_location'],
				$r['adpbriefingmanagement_slot'],
				/*$r['adpbriefingmanagement_remark'],*/
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->adpbriefingmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->adpbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

    public function get_availableslot($condition,$drivingclass)
    {

    $date = new DateTime(date('Y-m-d'));
    /*$date->modify('+3 day');*/
    $newdate = $date->format('Y-m-d');
    $firstdate = addWorkingDays($newdate,'3')->format('Y-m-d');
    if($condition=="renew"){
        $condition = 'Renewal';
        $condition_id = 2;
    }else{
        $condition_id = 1;
    }

        $row = $this->adpbriefingmanagement_model->get_slot($newdate,$condition,$drivingclass);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {

        $count_slottaken = $this->adpbriefingmanagement_model->get_slottaken($value->adpbriefingmanagement_date,$value->adpbriefingmanagement_location,$condition_id,$drivingclass);
/*            $available  = (int) $value->adpbriefingmanagement_slot - (int) $value->adpbriefingmanagement_slottaken;
            $title = $value->adpbriefingmanagement_location.'-'.$available.'/'. $value->adpbriefingmanagement_slot;*/
$title = $value->adpbriefingmanagement_location.'-'.$count_slottaken.'/'. $value->adpbriefingmanagement_slot;
if($value->adpbriefingmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->adpbriefingmanagement_location == 'KLIA2'){
$color = '#6C3483';
}
            $calendar[] = [
                "id" => $value->adpbriefingmanagement_id,
                "title" => $title,
                "start" => $value->adpbriefingmanagement_date,
                "end" => $value->adpbriefingmanagement_date,
                "color"  => $color,
                "available"  => $value->adpbriefingmanagement_slot,
                "taken"  => $count_slottaken
            ];
        }

        echo json_encode($calendar);
    }
}
;
/* End of file Adpbriefingmanagement.php */
/* Location: ./application/controllers/Adpbriefingmanagement.php */