<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Avpevpinspectionmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('avpevpinspectionmanagement_model');
    $this->lang->load('avpevpinspectionmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$avpevpinspectionmanagement = $this->avpevpinspectionmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    /*'avpevpinspectionmanagement_data' => $avpevpinspectionmanagement, */
    'permission' => $this->permission,
    );

    $this->content = 'avpevpinspectionmanagement/avpevpinspectionmanagement_list';
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
    $row = $this->avpevpinspectionmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'avpevpinspectionmanagement_date' => $row->avpevpinspectionmanagement_date,
		'avpevpinspectionmanagement_location' => $row->avpevpinspectionmanagement_location,
		'avpevpinspectionmanagement_slot' => $row->avpevpinspectionmanagement_slot,
		'avpevpinspectionmanagement_remark' => $row->avpevpinspectionmanagement_remark,
		
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

    $this->content = 'avpevpinspectionmanagement/avpevpinspectionmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('avpevpinspectionmanagement/avpevpinspectionmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpevpinspectionmanagement'));
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
        'action' => site_url('avpevpinspectionmanagement/create_action'),
        'avpevpinspectionmanagement_date' => set_value('avpevpinspectionmanagement_date'),
		'avpevpinspectionmanagement_location' => set_value('avpevpinspectionmanagement_location'),
		'dropdown_avpevpinspectionmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'avpevpinspectionmanagement_slot' => set_value('avpevpinspectionmanagement_slot'),
		'avpevpinspectionmanagement_remark' => set_value('avpevpinspectionmanagement_remark'),
		
);
    $this->content = 'avpevpinspectionmanagement/avpevpinspectionmanagement_form';
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
        'avpevpinspectionmanagement_date' => $this->input->post('avpevpinspectionmanagement_date',TRUE),
		'avpevpinspectionmanagement_location' => $this->input->post('avpevpinspectionmanagement_location',TRUE),
		'avpevpinspectionmanagement_slot' => $this->input->post('avpevpinspectionmanagement_slot',TRUE),
		'avpevpinspectionmanagement_remark' => $this->input->post('avpevpinspectionmanagement_remark',TRUE),
		'avpevpinspectionmanagement_created_at' => date('Y-m-d H:i:s'),
		 'avpevpinspectionmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->avpevpinspectionmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('avpevpinspectionmanagement'));
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
    $row = $this->avpevpinspectionmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('avpevpinspectionmanagement/update_action'),
        'id' => $id,
        'avpevpinspectionmanagement_date' => set_value('avpevpinspectionmanagement_date', $row->avpevpinspectionmanagement_date),
		'avpevpinspectionmanagement_location' => set_value('avpevpinspectionmanagement_location', $row->avpevpinspectionmanagement_location),
		'dropdown_avpevpinspectionmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'avpevpinspectionmanagement_slot' => set_value('avpevpinspectionmanagement_slot', $row->avpevpinspectionmanagement_slot),
		'avpevpinspectionmanagement_remark' => set_value('avpevpinspectionmanagement_remark', $row->avpevpinspectionmanagement_remark),
		
      );
    $this->content = 'avpevpinspectionmanagement/avpevpinspectionmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpevpinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('avpevpinspectionmanagement_id', TRUE));
    }
    else {
      $data = array(
        'avpevpinspectionmanagement_date' => $this->input->post('avpevpinspectionmanagement_date',TRUE),
		'avpevpinspectionmanagement_location' => $this->input->post('avpevpinspectionmanagement_location',TRUE),
		'avpevpinspectionmanagement_slot' => $this->input->post('avpevpinspectionmanagement_slot',TRUE),
		'avpevpinspectionmanagement_remark' => $this->input->post('avpevpinspectionmanagement_remark',TRUE),
		'avpevpinspectionmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'avpevpinspectionmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->avpevpinspectionmanagement_model->update(fixzy_decoder($this->input->post('avpevpinspectionmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('avpevpinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->avpevpinspectionmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->avpevpinspectionmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('avpevpinspectionmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpevpinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->avpevpinspectionmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'avpevpinspectionmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->avpevpinspectionmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('avpevpinspectionmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpevpinspectionmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('avpevpinspectionmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('avpevpinspectionmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('avpevpinspectionmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('avpevpinspectionmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'avpevpinspectionmanagement_id',
		'avpevpinspectionmanagement_date',
		'avpevpinspectionmanagement_location',
		'avpevpinspectionmanagement_slot',
		'avpevpinspectionmanagement_remark',
		
      );
      $results = $this->avpevpinspectionmanagement_model->listajax(
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
              $rud .=  anchor(site_url('avpevpinspectionmanagement/read/'.fixzy_encoder($r['avpevpinspectionmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('avpevpinspectionmanagement/update/'.fixzy_encoder($r['avpevpinspectionmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('avpevpinspectionmanagement/delete/'.fixzy_encoder($r['avpevpinspectionmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['avpevpinspectionmanagement_date'],
				$r['avpevpinspectionmanagement_location'],
				$r['avpevpinspectionmanagement_slot'],
				/*$r['avpevpinspectionmanagement_remark'],*/
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->avpevpinspectionmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->avpevpinspectionmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

    public function get_availableslot($type='')
    {

    $date = new DateTime(date('Y-m-d'));
    /*$date->modify('+3 day');*/
    $newdate = $date->format('Y-m-d');
    if($type=='avp'){
     $firstdate = addWorkingDays($newdate,'0')->format('Y-m-d');
    }elseif($type=='evp'){
     $firstdate = addWorkingDays($newdate,'3')->format('Y-m-d');
    }else{
     $firstdate = addWorkingDays($newdate,'0')->format('Y-m-d');
    }

    $lastdate = date('Y-m-d', strtotime('+2 months'));
        $row = $this->avpevpinspectionmanagement_model->get_slot($firstdate, $lastdate);
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {

        $count_slottaken = $this->avpevpinspectionmanagement_model->get_slottaken($value->avpevpinspectionmanagement_date);

$title = $count_slottaken.'/'. $value->avpevpinspectionmanagement_slot;
/*$title = $value->avpevpinspectionmanagement_location.'-'.(!empty($value->avpevpinspectionmanagement_slottaken)?$value->avpevpinspectionmanagement_slottaken:'0').'/'. $value->avpevpinspectionmanagement_slot;
if($value->avpevpinspectionmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->avpevpinspectionmanagement_location == 'KLIA2'){
$color = '#6C3483';
}*/

/*            $calendar[] = [
                "id" => $value->avpevpinspectionmanagement_id,
                "title" => $title,
                "start" => $value->avpevpinspectionmanagement_date,
                "end" => $value->avpevpinspectionmanagement_date,
                "color"  => $color
            ];*/

            $calendar[] = [
                "id" => $value->avpevpinspectionmanagement_id,
                "title" => $title,
                "start" => $value->avpevpinspectionmanagement_date,
                "end" => $value->avpevpinspectionmanagement_date,
                "available"  => $value->avpevpinspectionmanagement_slot,
                "taken"  => $count_slottaken
            ];
        }

        echo json_encode($calendar);
    }

}
;
/* End of file Avpevpinspectionmanagement.php */
/* Location: ./application/controllers/Avpevpinspectionmanagement.php */