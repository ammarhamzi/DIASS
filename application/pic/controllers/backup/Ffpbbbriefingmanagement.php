<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Ffpbbbriefingmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('ffpbbbriefingmanagement_model');
    $this->lang->load('ffpbbbriefingmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$ffpbbbriefingmanagement = $this->ffpbbbriefingmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'ffpbbbriefingmanagement_data' => $ffpbbbriefingmanagement,
    'permission' => $this->permission,
    );

    $this->content = 'ffpbbbriefingmanagement/ffpbbbriefingmanagement_list';
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
    $row = $this->ffpbbbriefingmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffpbb_briefingmanagement_date' => $row->ffpbb_briefingmanagement_date,
		'ffpbb_briefingmanagement_category' => $row->ffpbb_briefingmanagement_category,
		'ffpbb_briefingmanagement_location' => $row->ffpbb_briefingmanagement_location,
		'ffpbb_briefingmanagement_slot' => $row->ffpbb_briefingmanagement_slot,
		'ffpbb_briefingmanagement_remark' => $row->ffpbb_briefingmanagement_remark,
		
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

    $this->content = 'ffpbbbriefingmanagement/ffpbbbriefingmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('ffpbbbriefingmanagement/ffpbbbriefingmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpbbbriefingmanagement'));
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
        'action' => site_url('ffpbbbriefingmanagement/create_action'),
        'ffpbb_briefingmanagement_date' => set_value('ffpbb_briefingmanagement_date'),
		'ffpbb_briefingmanagement_category' => set_value('ffpbb_briefingmanagement_category'),
		'dropdown_ffpbb_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffpbb_briefingmanagement_location' => set_value('ffpbb_briefingmanagement_location'),
		'dropdown_ffpbb_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffpbb_briefingmanagement_slot' => set_value('ffpbb_briefingmanagement_slot'),
		'ffpbb_briefingmanagement_remark' => set_value('ffpbb_briefingmanagement_remark'),
		
);
    $this->content = 'ffpbbbriefingmanagement/ffpbbbriefingmanagement_form';
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
        'ffpbb_briefingmanagement_date' => $this->input->post('ffpbb_briefingmanagement_date',TRUE),
		'ffpbb_briefingmanagement_category' => $this->input->post('ffpbb_briefingmanagement_category',TRUE),
		'ffpbb_briefingmanagement_location' => $this->input->post('ffpbb_briefingmanagement_location',TRUE),
		'ffpbb_briefingmanagement_slot' => $this->input->post('ffpbb_briefingmanagement_slot',TRUE),
		'ffpbb_briefingmanagement_remark' => $this->input->post('ffpbb_briefingmanagement_remark',TRUE),
		'ffpbb_briefingmanagement_created_at' => date('Y-m-d H:i:s'),
		 'ffpbb_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffpbbbriefingmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('ffpbbbriefingmanagement'));
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
    $row = $this->ffpbbbriefingmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('ffpbbbriefingmanagement/update_action'),
        'id' => $id,
        'ffpbb_briefingmanagement_date' => set_value('ffpbb_briefingmanagement_date', $row->ffpbb_briefingmanagement_date),
		'ffpbb_briefingmanagement_category' => set_value('ffpbb_briefingmanagement_category', $row->ffpbb_briefingmanagement_category),
		'dropdown_ffpbb_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffpbb_briefingmanagement_location' => set_value('ffpbb_briefingmanagement_location', $row->ffpbb_briefingmanagement_location),
		'dropdown_ffpbb_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffpbb_briefingmanagement_slot' => set_value('ffpbb_briefingmanagement_slot', $row->ffpbb_briefingmanagement_slot),
		'ffpbb_briefingmanagement_remark' => set_value('ffpbb_briefingmanagement_remark', $row->ffpbb_briefingmanagement_remark),
		
      );
    $this->content = 'ffpbbbriefingmanagement/ffpbbbriefingmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpbbbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('ffpbb_briefingmanagement_id', TRUE));
    }
    else {
      $data = array(
        'ffpbb_briefingmanagement_date' => $this->input->post('ffpbb_briefingmanagement_date',TRUE),
		'ffpbb_briefingmanagement_category' => $this->input->post('ffpbb_briefingmanagement_category',TRUE),
		'ffpbb_briefingmanagement_location' => $this->input->post('ffpbb_briefingmanagement_location',TRUE),
		'ffpbb_briefingmanagement_slot' => $this->input->post('ffpbb_briefingmanagement_slot',TRUE),
		'ffpbb_briefingmanagement_remark' => $this->input->post('ffpbb_briefingmanagement_remark',TRUE),
		'ffpbb_briefingmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'ffpbb_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffpbbbriefingmanagement_model->update(fixzy_decoder($this->input->post('ffpbb_briefingmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('ffpbbbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffpbbbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->ffpbbbriefingmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffpbbbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpbbbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffpbbbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffpbb_briefingmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->ffpbbbriefingmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffpbbbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpbbbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('ffpbb_briefingmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('ffpbb_briefingmanagement_category', ' ', 'trim|required');
	$this->form_validation->set_rules('ffpbb_briefingmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('ffpbb_briefingmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('ffpbb_briefingmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'ffpbb_briefingmanagement_id',
		'ffpbb_briefingmanagement_date',
		'ffpbb_briefingmanagement_category',
		'ffpbb_briefingmanagement_location',
		'ffpbb_briefingmanagement_slot',
		'ffpbb_briefingmanagement_remark',
		
      );
      $results = $this->ffpbbbriefingmanagement_model->listajax(
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
              $rud .=  anchor(site_url('ffpbbbriefingmanagement/read/'.fixzy_encoder($r['ffpbb_briefingmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('ffpbbbriefingmanagement/update/'.fixzy_encoder($r['ffpbb_briefingmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('ffpbbbriefingmanagement/delete/'.fixzy_encoder($r['ffpbb_briefingmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['ffpbb_briefingmanagement_date'],
				$r['ffpbb_briefingmanagement_category'],
				$r['ffpbb_briefingmanagement_location'],
				$r['ffpbb_briefingmanagement_slot'],
			   /*	$r['ffpbb_briefingmanagement_remark'], */
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->ffpbbbriefingmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->ffpbbbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

    public function get_availableslot()
    {

    $date = new DateTime(date('Y-m-d'));
    /*$date->modify('+3 day');*/
    $newdate = $date->format('Y-m-d');
    $firstdate = addWorkingDays($newdate,'3')->format('Y-m-d');

        $row = $this->ffpbbbriefingmanagement_model->get_slot($firstdate);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
/*            $available  = (int) $value->ffpbb_briefingmanagement_slot - (int) $value->ffpbb_briefingmanagement_slottaken;
            $title = $value->ffpbb_briefingmanagement_location.'(' .$value->ffpbb_briefingmanagement_category. ')-'.$available.'/'. $value->ffpbb_briefingmanagement_slot;*/
$title = $value->ffpbb_briefingmanagement_location.'-(' .$value->ffpbb_briefingmanagement_category. ')-'.(!empty($value->ffpbb_briefingmanagement_slottaken)?$value->ffpbb_briefingmanagement_slottaken:'0').'/'. $value->ffpbb_briefingmanagement_slot;
if($value->ffpbb_briefingmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->ffpbb_briefingmanagement_location == 'KLIA2'){
$color = '#6C3483';
}
            $calendar[] = [
                "id" => $value->ffpbb_briefingmanagement_id,
                "title" => $title,
                "start" => $value->ffpbb_briefingmanagement_date,
                "end" => $value->ffpbb_briefingmanagement_date,
                "color"  => $color,
                "className" => $value->ffpbb_briefingmanagement_category,
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Ffpbbbriefingmanagement.php */
/* Location: ./application/controllers/Ffpbbbriefingmanagement.php */