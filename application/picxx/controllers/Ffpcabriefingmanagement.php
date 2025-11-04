<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Ffpcabriefingmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('ffpcabriefingmanagement_model');
    $this->lang->load('ffpcabriefingmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$ffpcabriefingmanagement = $this->ffpcabriefingmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'ffpcabriefingmanagement_data' => $ffpcabriefingmanagement,
    'permission' => $this->permission,
    );

    $this->content = 'ffpcabriefingmanagement/ffpcabriefingmanagement_list';
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
    $row = $this->ffpcabriefingmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffpca_briefingmanagement_date' => $row->ffpca_briefingmanagement_date,
		'ffpca_briefingmanagement_category' => $row->ffpca_briefingmanagement_category,
		'ffpca_briefingmanagement_location' => $row->ffpca_briefingmanagement_location,
		'ffpca_briefingmanagement_slot' => $row->ffpca_briefingmanagement_slot,
		'ffpca_briefingmanagement_remark' => $row->ffpca_briefingmanagement_remark,
		
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

    $this->content = 'ffpcabriefingmanagement/ffpcabriefingmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('ffpcabriefingmanagement/ffpcabriefingmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpcabriefingmanagement'));
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
        'action' => site_url('ffpcabriefingmanagement/create_action'),
        'ffpca_briefingmanagement_date' => set_value('ffpca_briefingmanagement_date'),
		'ffpca_briefingmanagement_category' => set_value('ffpca_briefingmanagement_category'),
		'dropdown_ffpca_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffpca_briefingmanagement_location' => set_value('ffpca_briefingmanagement_location'),
		'dropdown_ffpca_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffpca_briefingmanagement_slot' => set_value('ffpca_briefingmanagement_slot'),
		'ffpca_briefingmanagement_remark' => set_value('ffpca_briefingmanagement_remark'),
		
);
    $this->content = 'ffpcabriefingmanagement/ffpcabriefingmanagement_form';
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
        'ffpca_briefingmanagement_date' => $this->input->post('ffpca_briefingmanagement_date',TRUE),
		'ffpca_briefingmanagement_category' => $this->input->post('ffpca_briefingmanagement_category',TRUE),
		'ffpca_briefingmanagement_location' => $this->input->post('ffpca_briefingmanagement_location',TRUE),
		'ffpca_briefingmanagement_slot' => $this->input->post('ffpca_briefingmanagement_slot',TRUE),
		'ffpca_briefingmanagement_remark' => $this->input->post('ffpca_briefingmanagement_remark',TRUE),
		'ffpca_briefingmanagement_created_at' => date('Y-m-d H:i:s'),
		 'ffpca_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffpcabriefingmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('ffpcabriefingmanagement'));
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
    $row = $this->ffpcabriefingmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('ffpcabriefingmanagement/update_action'),
        'id' => $id,
        'ffpca_briefingmanagement_date' => set_value('ffpca_briefingmanagement_date', $row->ffpca_briefingmanagement_date),
		'ffpca_briefingmanagement_category' => set_value('ffpca_briefingmanagement_category', $row->ffpca_briefingmanagement_category),
		'dropdown_ffpca_briefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'ffpca_briefingmanagement_location' => set_value('ffpca_briefingmanagement_location', $row->ffpca_briefingmanagement_location),
		'dropdown_ffpca_briefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'ffpca_briefingmanagement_slot' => set_value('ffpca_briefingmanagement_slot', $row->ffpca_briefingmanagement_slot),
		'ffpca_briefingmanagement_remark' => set_value('ffpca_briefingmanagement_remark', $row->ffpca_briefingmanagement_remark),
		
      );
    $this->content = 'ffpcabriefingmanagement/ffpcabriefingmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpcabriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('ffpca_briefingmanagement_id', TRUE));
    }
    else {
      $data = array(
        'ffpca_briefingmanagement_date' => $this->input->post('ffpca_briefingmanagement_date',TRUE),
		'ffpca_briefingmanagement_category' => $this->input->post('ffpca_briefingmanagement_category',TRUE),
		'ffpca_briefingmanagement_location' => $this->input->post('ffpca_briefingmanagement_location',TRUE),
		'ffpca_briefingmanagement_slot' => $this->input->post('ffpca_briefingmanagement_slot',TRUE),
		'ffpca_briefingmanagement_remark' => $this->input->post('ffpca_briefingmanagement_remark',TRUE),
		'ffpca_briefingmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'ffpca_briefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->ffpcabriefingmanagement_model->update(fixzy_decoder($this->input->post('ffpca_briefingmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('ffpcabriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffpcabriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->ffpcabriefingmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffpcabriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpcabriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->ffpcabriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'ffpca_briefingmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->ffpcabriefingmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('ffpcabriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('ffpcabriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('ffpca_briefingmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('ffpca_briefingmanagement_category', ' ', 'trim|required');
	$this->form_validation->set_rules('ffpca_briefingmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('ffpca_briefingmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('ffpca_briefingmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'ffpca_briefingmanagement_id',
		'ffpca_briefingmanagement_date',
		'ffpca_briefingmanagement_category',
		'ffpca_briefingmanagement_location',
		'ffpca_briefingmanagement_slot',
		'ffpca_briefingmanagement_remark',
		
      );
      $results = $this->ffpcabriefingmanagement_model->listajax(
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
              $rud .=  anchor(site_url('ffpcabriefingmanagement/read/'.fixzy_encoder($r['ffpca_briefingmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('ffpcabriefingmanagement/update/'.fixzy_encoder($r['ffpca_briefingmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('ffpcabriefingmanagement/delete/'.fixzy_encoder($r['ffpca_briefingmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['ffpca_briefingmanagement_date'],
				$r['ffpca_briefingmanagement_category'],
				$r['ffpca_briefingmanagement_location'],
				$r['ffpca_briefingmanagement_slot'],
				/*$r['ffpca_briefingmanagement_remark'], */
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->ffpcabriefingmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->ffpcabriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
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

        $row = $this->ffpcabriefingmanagement_model->get_slot($firstdate);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
/*            $available  = (int) $value->ffpca_briefingmanagement_slot - (int) $value->ffpca_briefingmanagement_slottaken;
            $title = $value->ffpca_briefingmanagement_location.'(' .$value->ffpca_briefingmanagement_category. ')-'.$available.'/'. $value->ffpca_briefingmanagement_slot;*/
$title = $value->ffpca_briefingmanagement_location.'-(' .$value->ffpca_briefingmanagement_category. ')-'.(!empty($value->ffpca_briefingmanagement_slottaken)?$value->ffpca_briefingmanagement_slottaken:'0').'/'. $value->ffpca_briefingmanagement_slot;

if($value->ffpca_briefingmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->ffpca_briefingmanagement_location == 'KLIA2'){
$color = '#6C3483';
}
            $calendar[] = [
                "id" => $value->ffpca_briefingmanagement_id,
                "title" => $title,
                "start" => $value->ffpca_briefingmanagement_date,
                "end" => $value->ffpca_briefingmanagement_date,
                "color"  => $color,
                "className" => $value->ffpca_briefingmanagement_category,
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Ffpcabriefingmanagement.php */
/* Location: ./application/controllers/Ffpcabriefingmanagement.php */