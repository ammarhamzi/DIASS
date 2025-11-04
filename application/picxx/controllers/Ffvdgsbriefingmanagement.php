<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Ffvdgsbriefingmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('ffvdgsbriefingmanagement_model');
    $this->lang->load('ffvdgsbriefingmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$ffvdgsbriefingmanagement = $this->ffvdgsbriefingmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'ffvdgsbriefingmanagement_data' => $ffvdgsbriefingmanagement,
    'permission' => $this->permission,
    );

    $this->content = 'ffvdgsbriefingmanagement/ffvdgsbriefingmanagement_list';
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
    $row = $this->ffvdgsbriefingmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffvdgs_briefingmanagement_date' => $row->ffvdgs_briefingmanagement_date,
		'ffvdgs_briefingmanagement_category' => $row->ffvdgs_briefingmanagement_category,
		'ffvdgs_briefingmanagement_location' => $row->ffvdgs_briefingmanagement_location,
		'ffvdgs_briefingmanagement_slot' => $row->ffvdgs_briefingmanagement_slot,
		'ffvdgs_briefingmanagement_remark' => $row->ffvdgs_briefingmanagement_remark,
		
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

    $this->content = 'ffvdgsbriefingmanagement/ffvdgsbriefingmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('ffvdgsbriefingmanagement/ffvdgsbriefingmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffvdgsbriefingmanagement'));
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
        'action' => site_url('ffvdgsbriefingmanagement/create_action'),
        'ffvdgs_briefingmanagement_date' => set_value('ffvdgs_briefingmanagement_date'),
		'ffvdgs_briefingmanagement_category' => set_value('ffvdgs_briefingmanagement_category'),
		'dropdown_ffvdgs_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffvdgs_briefingmanagement_location' => set_value('ffvdgs_briefingmanagement_location'),
		'dropdown_ffvdgs_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffvdgs_briefingmanagement_slot' => set_value('ffvdgs_briefingmanagement_slot'),
		'ffvdgs_briefingmanagement_remark' => set_value('ffvdgs_briefingmanagement_remark'),
		
);
    $this->content = 'ffvdgsbriefingmanagement/ffvdgsbriefingmanagement_form';
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
        'ffvdgs_briefingmanagement_date' => $this->input->post('ffvdgs_briefingmanagement_date',TRUE),
		'ffvdgs_briefingmanagement_category' => $this->input->post('ffvdgs_briefingmanagement_category',TRUE),
		'ffvdgs_briefingmanagement_location' => $this->input->post('ffvdgs_briefingmanagement_location',TRUE),
		'ffvdgs_briefingmanagement_slot' => $this->input->post('ffvdgs_briefingmanagement_slot',TRUE),
		'ffvdgs_briefingmanagement_remark' => $this->input->post('ffvdgs_briefingmanagement_remark',TRUE),
		'ffvdgs_briefingmanagement_created_at' => date('Y-m-d H:i:s'),
		 'ffvdgs_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffvdgsbriefingmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('ffvdgsbriefingmanagement'));
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
    $row = $this->ffvdgsbriefingmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('ffvdgsbriefingmanagement/update_action'),
        'id' => $id,
        'ffvdgs_briefingmanagement_date' => set_value('ffvdgs_briefingmanagement_date', $row->ffvdgs_briefingmanagement_date),
		'ffvdgs_briefingmanagement_category' => set_value('ffvdgs_briefingmanagement_category', $row->ffvdgs_briefingmanagement_category),
		'dropdown_ffvdgs_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffvdgs_briefingmanagement_location' => set_value('ffvdgs_briefingmanagement_location', $row->ffvdgs_briefingmanagement_location),
		'dropdown_ffvdgs_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffvdgs_briefingmanagement_slot' => set_value('ffvdgs_briefingmanagement_slot', $row->ffvdgs_briefingmanagement_slot),
		'ffvdgs_briefingmanagement_remark' => set_value('ffvdgs_briefingmanagement_remark', $row->ffvdgs_briefingmanagement_remark),
		
      );
    $this->content = 'ffvdgsbriefingmanagement/ffvdgsbriefingmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffvdgsbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('ffvdgs_briefingmanagement_id', TRUE));
    }
    else {
      $data = array(
        'ffvdgs_briefingmanagement_date' => $this->input->post('ffvdgs_briefingmanagement_date',TRUE),
		'ffvdgs_briefingmanagement_category' => $this->input->post('ffvdgs_briefingmanagement_category',TRUE),
		'ffvdgs_briefingmanagement_location' => $this->input->post('ffvdgs_briefingmanagement_location',TRUE),
		'ffvdgs_briefingmanagement_slot' => $this->input->post('ffvdgs_briefingmanagement_slot',TRUE),
		'ffvdgs_briefingmanagement_remark' => $this->input->post('ffvdgs_briefingmanagement_remark',TRUE),
		'ffvdgs_briefingmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'ffvdgs_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffvdgsbriefingmanagement_model->update(fixzy_decoder($this->input->post('ffvdgs_briefingmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('ffvdgsbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffvdgsbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->ffvdgsbriefingmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffvdgsbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffvdgsbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffvdgsbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffvdgs_briefingmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->ffvdgsbriefingmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffvdgsbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffvdgsbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('ffvdgs_briefingmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('ffvdgs_briefingmanagement_category', ' ', 'trim|required');
	$this->form_validation->set_rules('ffvdgs_briefingmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('ffvdgs_briefingmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('ffvdgs_briefingmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'ffvdgs_briefingmanagement_id',
		'ffvdgs_briefingmanagement_date',
		'ffvdgs_briefingmanagement_category',
		'ffvdgs_briefingmanagement_location',
		'ffvdgs_briefingmanagement_slot',
		'ffvdgs_briefingmanagement_remark',
		
      );
      $results = $this->ffvdgsbriefingmanagement_model->listajax(
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
              $rud .=  anchor(site_url('ffvdgsbriefingmanagement/read/'.fixzy_encoder($r['ffvdgs_briefingmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('ffvdgsbriefingmanagement/update/'.fixzy_encoder($r['ffvdgs_briefingmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('ffvdgsbriefingmanagement/delete/'.fixzy_encoder($r['ffvdgs_briefingmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['ffvdgs_briefingmanagement_date'],
				$r['ffvdgs_briefingmanagement_category'],
				$r['ffvdgs_briefingmanagement_location'],
				$r['ffvdgs_briefingmanagement_slot'],
				/*$r['ffvdgs_briefingmanagement_remark'], */
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->ffvdgsbriefingmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->ffvdgsbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
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

        $row = $this->ffvdgsbriefingmanagement_model->get_slot($firstdate);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
        $count_slottaken = $this->ffvdgsbriefingmanagement_model->get_slottaken($value->ffvdgs_briefingmanagement_date,$value->ffvdgs_briefingmanagement_location,$value->ffvdgs_briefingmanagement_category);
/*            $available  = (int) $value->ffvdgs_briefingmanagement_slot - (int) $value->ffvdgs_briefingmanagement_slottaken;
            $title = $value->ffvdgs_briefingmanagement_location.'(' .$value->ffvdgs_briefingmanagement_category. ')-'.$available.'/'. $value->ffvdgs_briefingmanagement_slot;*/
$title = $value->ffvdgs_briefingmanagement_location.'-(' .$value->ffvdgs_briefingmanagement_category. ')-'.$count_slottaken.'/'. $value->ffvdgs_briefingmanagement_slot;

if($value->ffvdgs_briefingmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->ffvdgs_briefingmanagement_location == 'KLIA2'){
$color = '#6C3483';
}
            $calendar[] = [
                "id" => $value->ffvdgs_briefingmanagement_id,
                "title" => $title,
                "start" => $value->ffvdgs_briefingmanagement_date,
                "end" => $value->ffvdgs_briefingmanagement_date,
                "color"  => $color,
                "className" => $value->ffvdgs_briefingmanagement_category,
                "available"  => $value->ffvdgs_briefingmanagement_slot,
                "taken"  => $count_slottaken
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Ffvdgsbriefingmanagement.php */
/* Location: ./application/controllers/Ffvdgsbriefingmanagement.php */