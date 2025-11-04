<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Ffgpubriefingmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('ffgpubriefingmanagement_model');
    $this->lang->load('ffgpubriefingmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$ffgpubriefingmanagement = $this->ffgpubriefingmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'ffgpubriefingmanagement_data' => $ffgpubriefingmanagement,
    'permission' => $this->permission,
    );

    $this->content = 'ffgpubriefingmanagement/ffgpubriefingmanagement_list';
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
    $row = $this->ffgpubriefingmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffgpu_briefingmanagement_date' => $row->ffgpu_briefingmanagement_date,
		'ffgpu_briefingmanagement_category' => $row->ffgpu_briefingmanagement_category,
		'ffgpu_briefingmanagement_location' => $row->ffgpu_briefingmanagement_location,
		'ffgpu_briefingmanagement_slot' => $row->ffgpu_briefingmanagement_slot,
		'ffgpu_briefingmanagement_remark' => $row->ffgpu_briefingmanagement_remark,
		
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

    $this->content = 'ffgpubriefingmanagement/ffgpubriefingmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('ffgpubriefingmanagement/ffgpubriefingmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffgpubriefingmanagement'));
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
        'action' => site_url('ffgpubriefingmanagement/create_action'),
        'ffgpu_briefingmanagement_date' => set_value('ffgpu_briefingmanagement_date'),
		'ffgpu_briefingmanagement_category' => set_value('ffgpu_briefingmanagement_category'),
		'dropdown_ffgpu_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffgpu_briefingmanagement_location' => set_value('ffgpu_briefingmanagement_location'),
		'dropdown_ffgpu_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffgpu_briefingmanagement_slot' => set_value('ffgpu_briefingmanagement_slot'),
		'ffgpu_briefingmanagement_remark' => set_value('ffgpu_briefingmanagement_remark'),
		
);
    $this->content = 'ffgpubriefingmanagement/ffgpubriefingmanagement_form';
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
        'ffgpu_briefingmanagement_date' => $this->input->post('ffgpu_briefingmanagement_date',TRUE),
		'ffgpu_briefingmanagement_category' => $this->input->post('ffgpu_briefingmanagement_category',TRUE),
		'ffgpu_briefingmanagement_location' => $this->input->post('ffgpu_briefingmanagement_location',TRUE),
		'ffgpu_briefingmanagement_slot' => $this->input->post('ffgpu_briefingmanagement_slot',TRUE),
		'ffgpu_briefingmanagement_remark' => $this->input->post('ffgpu_briefingmanagement_remark',TRUE),
		'ffgpu_briefingmanagement_created_at' => date('Y-m-d H:i:s'),
		 'ffgpu_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffgpubriefingmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('ffgpubriefingmanagement'));
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
    $row = $this->ffgpubriefingmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('ffgpubriefingmanagement/update_action'),
        'id' => $id,
        'ffgpu_briefingmanagement_date' => set_value('ffgpu_briefingmanagement_date', $row->ffgpu_briefingmanagement_date),
		'ffgpu_briefingmanagement_category' => set_value('ffgpu_briefingmanagement_category', $row->ffgpu_briefingmanagement_category),
		'dropdown_ffgpu_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffgpu_briefingmanagement_location' => set_value('ffgpu_briefingmanagement_location', $row->ffgpu_briefingmanagement_location),
		'dropdown_ffgpu_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffgpu_briefingmanagement_slot' => set_value('ffgpu_briefingmanagement_slot', $row->ffgpu_briefingmanagement_slot),
		'ffgpu_briefingmanagement_remark' => set_value('ffgpu_briefingmanagement_remark', $row->ffgpu_briefingmanagement_remark),
		
      );
    $this->content = 'ffgpubriefingmanagement/ffgpubriefingmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffgpubriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('ffgpu_briefingmanagement_id', TRUE));
    }
    else {
      $data = array(
        'ffgpu_briefingmanagement_date' => $this->input->post('ffgpu_briefingmanagement_date',TRUE),
		'ffgpu_briefingmanagement_category' => $this->input->post('ffgpu_briefingmanagement_category',TRUE),
		'ffgpu_briefingmanagement_location' => $this->input->post('ffgpu_briefingmanagement_location',TRUE),
		'ffgpu_briefingmanagement_slot' => $this->input->post('ffgpu_briefingmanagement_slot',TRUE),
		'ffgpu_briefingmanagement_remark' => $this->input->post('ffgpu_briefingmanagement_remark',TRUE),
		'ffgpu_briefingmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'ffgpu_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffgpubriefingmanagement_model->update(fixzy_decoder($this->input->post('ffgpu_briefingmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('ffgpubriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffgpubriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->ffgpubriefingmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffgpubriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffgpubriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffgpubriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffgpu_briefingmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->ffgpubriefingmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffgpubriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffgpubriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('ffgpu_briefingmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('ffgpu_briefingmanagement_category', ' ', 'trim|required');
	$this->form_validation->set_rules('ffgpu_briefingmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('ffgpu_briefingmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('ffgpu_briefingmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'ffgpu_briefingmanagement_id',
		'ffgpu_briefingmanagement_date',
		'ffgpu_briefingmanagement_category',
		'ffgpu_briefingmanagement_location',
		'ffgpu_briefingmanagement_slot',
		'ffgpu_briefingmanagement_remark',
		
      );
      $results = $this->ffgpubriefingmanagement_model->listajax(
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
              $rud .=  anchor(site_url('ffgpubriefingmanagement/read/'.fixzy_encoder($r['ffgpu_briefingmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('ffgpubriefingmanagement/update/'.fixzy_encoder($r['ffgpu_briefingmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('ffgpubriefingmanagement/delete/'.fixzy_encoder($r['ffgpu_briefingmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['ffgpu_briefingmanagement_date'],
				$r['ffgpu_briefingmanagement_category'],
				$r['ffgpu_briefingmanagement_location'],
				$r['ffgpu_briefingmanagement_slot'],
				/*$r['ffgpu_briefingmanagement_remark'], */
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->ffgpubriefingmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->ffgpubriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
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

        $row = $this->ffgpubriefingmanagement_model->get_slot($firstdate);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
/*            $available  = (int) $value->ffgpu_briefingmanagement_slot - (int) $value->ffgpu_briefingmanagement_slottaken;
            $title = $value->ffgpu_briefingmanagement_location.'(' .$value->ffgpu_briefingmanagement_category. ')-'.$available.'/'. $value->ffgpu_briefingmanagement_slot;*/
$title = $value->ffgpu_briefingmanagement_location.'-(' .$value->ffgpu_briefingmanagement_category. ')-'.(!empty($value->ffgpu_briefingmanagement_slottaken)?$value->ffgpu_briefingmanagement_slottaken:'0').'/'. $value->ffgpu_briefingmanagement_slot;

if($value->ffgpu_briefingmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->ffgpu_briefingmanagement_location == 'KLIA2'){
$color = '#6C3483';
}
            $calendar[] = [
                "id" => $value->ffgpu_briefingmanagement_id,
                "title" => $title,
                "start" => $value->ffgpu_briefingmanagement_date,
                "end" => $value->ffgpu_briefingmanagement_date,
                "color"  => $color,
                "className" => $value->ffgpu_briefingmanagement_category,
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Ffgpubriefingmanagement.php */
/* Location: ./application/controllers/Ffgpubriefingmanagement.php */