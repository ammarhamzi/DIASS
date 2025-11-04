<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Evdpbriefingmanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('evdpbriefingmanagement_model');
    $this->lang->load('evdpbriefingmanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    $evdpbriefingmanagement = $this->evdpbriefingmanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    'evdpbriefingmanagement_data' => $evdpbriefingmanagement,
    'permission' => $this->permission,
    );

    $this->content = 'evdpbriefingmanagement/evdpbriefingmanagement_list';
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
    $row = $this->evdpbriefingmanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'evdpbriefingmanagement_date' => $row->evdpbriefingmanagement_date,
		'evdpbriefingmanagement_category' => $row->evdpbriefingmanagement_category,
		'evdpbriefingmanagement_location' => $row->evdpbriefingmanagement_location,
		'evdpbriefingmanagement_slot' => $row->evdpbriefingmanagement_slot,
		'evdpbriefingmanagement_remark' => $row->evdpbriefingmanagement_remark,
		
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

    $this->content = 'evdpbriefingmanagement/evdpbriefingmanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('evdpbriefingmanagement/evdpbriefingmanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evdpbriefingmanagement'));
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
        'action' => site_url('evdpbriefingmanagement/create_action'),
        'evdpbriefingmanagement_date' => set_value('evdpbriefingmanagement_date'),
		'evdpbriefingmanagement_category' => set_value('evdpbriefingmanagement_category'),
		'dropdown_evdpbriefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'evdpbriefingmanagement_location' => set_value('evdpbriefingmanagement_location'),
		'dropdown_evdpbriefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'evdpbriefingmanagement_slot' => set_value('evdpbriefingmanagement_slot'),
		'evdpbriefingmanagement_remark' => set_value('evdpbriefingmanagement_remark'),
		
);
    $this->content = 'evdpbriefingmanagement/evdpbriefingmanagement_form';
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
        'evdpbriefingmanagement_date' => $this->input->post('evdpbriefingmanagement_date',TRUE),
		'evdpbriefingmanagement_category' => $this->input->post('evdpbriefingmanagement_category',TRUE),
		'evdpbriefingmanagement_location' => $this->input->post('evdpbriefingmanagement_location',TRUE),
		'evdpbriefingmanagement_slot' => $this->input->post('evdpbriefingmanagement_slot',TRUE),
		'evdpbriefingmanagement_remark' => $this->input->post('evdpbriefingmanagement_remark',TRUE),
		'evdpbriefingmanagement_created_at' => date('Y-m-d H:i:s'),
		 'evdpbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->evdpbriefingmanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('evdpbriefingmanagement'));
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
    $row = $this->evdpbriefingmanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('evdpbriefingmanagement/update_action'),
        'id' => $id,
        'evdpbriefingmanagement_date' => set_value('evdpbriefingmanagement_date', $row->evdpbriefingmanagement_date),
		'evdpbriefingmanagement_category' => set_value('evdpbriefingmanagement_category', $row->evdpbriefingmanagement_category),
		'dropdown_evdpbriefingmanagement_category' =>  array(
(object)array('id'=>'morning','value'=>'morning'),(object)array('id'=>'evening','value'=>'evening'),
),
		'evdpbriefingmanagement_location' => set_value('evdpbriefingmanagement_location', $row->evdpbriefingmanagement_location),
		'dropdown_evdpbriefingmanagement_location' =>  array(
(object)array('id'=>'KLIA','value'=>'KLIA'),(object)array('id'=>'KLIA2','value'=>'KLIA2'),
),
		'evdpbriefingmanagement_slot' => set_value('evdpbriefingmanagement_slot', $row->evdpbriefingmanagement_slot),
		'evdpbriefingmanagement_remark' => set_value('evdpbriefingmanagement_remark', $row->evdpbriefingmanagement_remark),
		
      );
    $this->content = 'evdpbriefingmanagement/evdpbriefingmanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evdpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('evdpbriefingmanagement_id', TRUE));
    }
    else {
      $data = array(
        'evdpbriefingmanagement_date' => $this->input->post('evdpbriefingmanagement_date',TRUE),
		'evdpbriefingmanagement_category' => $this->input->post('evdpbriefingmanagement_category',TRUE),
		'evdpbriefingmanagement_location' => $this->input->post('evdpbriefingmanagement_location',TRUE),
		'evdpbriefingmanagement_slot' => $this->input->post('evdpbriefingmanagement_slot',TRUE),
		'evdpbriefingmanagement_remark' => $this->input->post('evdpbriefingmanagement_remark',TRUE),
		'evdpbriefingmanagement_updated_at' => date('Y-m-d H:i:s'),
		 'evdpbriefingmanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->evdpbriefingmanagement_model->update(fixzy_decoder($this->input->post('evdpbriefingmanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('evdpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->evdpbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->evdpbriefingmanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('evdpbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evdpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->evdpbriefingmanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'evdpbriefingmanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->evdpbriefingmanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('evdpbriefingmanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evdpbriefingmanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('evdpbriefingmanagement_date', ' ', 'trim|required');
	$this->form_validation->set_rules('evdpbriefingmanagement_category', ' ', 'trim|required');
	$this->form_validation->set_rules('evdpbriefingmanagement_location', ' ', 'trim|required');
	$this->form_validation->set_rules('evdpbriefingmanagement_slot', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('evdpbriefingmanagement_remark', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'evdpbriefingmanagement_id',
		'evdpbriefingmanagement_date',
		'evdpbriefingmanagement_category',
		'evdpbriefingmanagement_location',
		'evdpbriefingmanagement_slot',
		'evdpbriefingmanagement_remark',
		
      );
      $results = $this->evdpbriefingmanagement_model->listajax(
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
              $rud .=  anchor(site_url('evdpbriefingmanagement/read/'.fixzy_encoder($r['evdpbriefingmanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }*/
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('evdpbriefingmanagement/update/'.fixzy_encoder($r['evdpbriefingmanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('evdpbriefingmanagement/delete/'.fixzy_encoder($r['evdpbriefingmanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['evdpbriefingmanagement_date'],
				$r['evdpbriefingmanagement_category'],
				$r['evdpbriefingmanagement_location'],
				$r['evdpbriefingmanagement_slot'],
				$r['evdpbriefingmanagement_remark'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->evdpbriefingmanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->evdpbriefingmanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }
    public function get_availableslot()
    {
        $row = $this->evdpbriefingmanagement_model->get_slot();
/*    var_dump($row);
exit;*/
        foreach ($row as $value) {
        $count_slottaken = $this->evdpbriefingmanagement_model->get_slottaken($value->evdpbriefingmanagement_date,$value->evdpbriefingmanagement_location,$value->evdpbriefingmanagement_category);
/*            $available  = (int) $value->evdpbriefingmanagement_slot - (int) $value->evdpbriefingmanagement_slottaken;
            $title = $value->evdpbriefingmanagement_location.'(' .$value->evdpbriefingmanagement_category. ')-'.$available.'/'. $value->evdpbriefingmanagement_slot;*/
$title = $value->evdpbriefingmanagement_location.'-(' .$value->evdpbriefingmanagement_category. ')-'.$count_slottaken.'/'. $value->evdpbriefingmanagement_slot;
if($value->evdpbriefingmanagement_location == 'KLIA'){
$color = '#C0392B';
}elseif($value->evdpbriefingmanagement_location == 'KLIA2'){
$color = '#6C3483';
}
            $calendar[] = [
                "id" => $value->evdpbriefingmanagement_id,
                "title" => $title,
                "start" => $value->evdpbriefingmanagement_date,
                "end" => $value->evdpbriefingmanagement_date,
                "color"  => $color,
                "className" => $value->evdpbriefingmanagement_category,
                "location" => $value->evdpbriefingmanagement_location,
            ];
        }

        echo json_encode($calendar);
    }
}
;
/* End of file Evdpbriefingmanagement.php */
/* Location: ./application/controllers/Evdpbriefingmanagement.php */