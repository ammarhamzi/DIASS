<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Examadpmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('examadpmanagement_model');
    $this->lang->load('examadpmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    $examadpmanagement = $this->examadpmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    /*'examadpmanagement_data' => $examadpmanagement,*/
    'permission' => $this->permission,
    );

    $this->content = 'examadpmanagement/examadpmanagement_list';
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
    $row = $this->examadpmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'exammanagement_date' => $row->exammanagement_date,
		'exammanagement_category' => $row->exammanagement_category,
		'exammanagement_location' => $row->exammanagement_location,
		'exammanagement_slot' => $row->exammanagement_slot,
		'exammanagement_remark' => $row->exammanagement_remark,
		
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

    $this->content = 'examadpmanagement/examadpmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('examadpmanagement/examadpmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examadpmanagement'));
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
        'action' => site_url('examadpmanagement/create_action'),
        'exammanagement_date' => set_value('exammanagement_date'),
		'exammanagement_category' => set_value('exammanagement_category'),
		'dropdown_exammanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'exammanagement_location' => set_value('exammanagement_location'),
		'dropdown_exammanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'exammanagement_slot' => set_value('exammanagement_slot'),
		'exammanagement_remark' => set_value('exammanagement_remark'),
		
);
    $this->content = 'examadpmanagement/examadpmanagement_form';
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
        'exammanagement_date' => $this->input->post('exammanagement_date',TRUE),
		'exammanagement_category' => $this->input->post('exammanagement_category',TRUE),
		'exammanagement_location' => $this->input->post('exammanagement_location',TRUE),
		'exammanagement_slot' => $this->input->post('exammanagement_slot',TRUE),
		'exammanagement_remark' => $this->input->post('exammanagement_remark',TRUE),
		'exammanagement_created_at' => date('Y-m-d H:i:s'),
		 'exammanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->examadpmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('examadpmanagement'));
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
    $row = $this->examadpmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('examadpmanagement/update_action'),
        'id' => $id,
        'exammanagement_date' => set_value('exammanagement_date', $row->exammanagement_date),
		'exammanagement_category' => set_value('exammanagement_category', $row->exammanagement_category),
		'dropdown_exammanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'exammanagement_location' => set_value('exammanagement_location', $row->exammanagement_location),
		'dropdown_exammanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'exammanagement_slot' => set_value('exammanagement_slot', $row->exammanagement_slot),
		'exammanagement_remark' => set_value('exammanagement_remark', $row->exammanagement_remark),
		
      );
    $this->content = 'examadpmanagement/examadpmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examadpmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('exammanagement_id', TRUE));
    }
    else {
      $data = array(
        'exammanagement_date' => $this->input->post('exammanagement_date',TRUE),
		'exammanagement_category' => $this->input->post('exammanagement_category',TRUE),
		'exammanagement_location' => $this->input->post('exammanagement_location',TRUE),
		'exammanagement_slot' => $this->input->post('exammanagement_slot',TRUE),
		'exammanagement_remark' => $this->input->post('exammanagement_remark',TRUE),
		'exammanagement_updated_at' => date('Y-m-d H:i:s'),
		 'exammanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->examadpmanagement_model->update(fixzy_decoder($this->input->post('exammanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('examadpmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->examadpmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->examadpmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('examadpmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examadpmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->examadpmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'exammanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->examadpmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('examadpmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examadpmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('exammanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('exammanagement_category', ' ', 'trim|required');
	$this->form_validation->set_rules('exammanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('exammanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('exammanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'exammanagement_id',
		'exammanagement_date',
		'exammanagement_category',
		'exammanagement_location',
		'exammanagement_slot',
		'exammanagement_remark',
		
      );
      $results = $this->examadpmanagement_model->listajax(
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
              $rud .=  anchor(site_url('examadpmanagement/read/'.fixzy_encoder($r['exammanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }*/
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('examadpmanagement/update/'.fixzy_encoder($r['exammanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('examadpmanagement/delete/'.fixzy_encoder($r['exammanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['exammanagement_date'],
				$r['exammanagement_category'],
				$r['exammanagement_location'],
				$r['exammanagement_slot'],
				$r['exammanagement_remark'], 
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->examadpmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->examadpmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

    public function get_availableslot($condition='',$drivingclass='')
    {
        $row = $this->examadpmanagement_model->get_slot($condition,$drivingclass);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
/*            $available  = (int) $value->exammanagement_slot - (int) $value->exammanagement_slottaken;
            $title = $value->exammanagement_location.'-'.$available.'/'. $value->exammanagement_slot;*/
$title = $value->exammanagement_location.'-(' .$value->exammanagement_category. ')-'.(!empty($value->exammanagement_slottaken)?$value->exammanagement_slottaken:'0').'/'. $value->exammanagement_slot;

if($value->exammanagement_category == 'morning'){
$color = '#C0392B';
}elseif($value->exammanagement_category == 'evening'){
$color = '#6C3483';
}
            $calendar[] = [
                "id" => $value->exammanagement_id,
                "title" => $title,
                "start" => $value->exammanagement_date,
                "end" => $value->exammanagement_date,
                "color"  => $color,
                "category" => $value->exammanagement_category,
                "location" => $value->exammanagement_location,
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Examadpmanagement.php */
/* Location: ./application/controllers/Examadpmanagement.php */