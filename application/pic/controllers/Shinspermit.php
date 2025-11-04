<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Shinspermit extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('shinspermit_model');
    $this->lang->load('shinspermit_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$shinspermit = $this->shinspermit_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'shinspermit_data' => $shinspermit,
    'permission' => $this->permission,
    );

    $this->content = 'shinspermit/shinspermit_list';
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
    $row = $this->shinspermit_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'shinspermit_permit_id' => $row->shinspermit_permit_id,
		'shinspermit_vehicle_id' => $row->shinspermit_vehicle_id,
		'shinspermit_required_briefing' => $row->shinspermit_required_briefing,
		'shinspermit_attendbriefing' => $row->shinspermit_attendbriefing,
		'shinspermit_approved_to_inspect' => $row->shinspermit_approved_to_inspect,
		'shinspermit_ownchecked_by' => $row->shinspermit_ownchecked_by,
		'shinspermit_ownchecked_date' => $row->shinspermit_ownchecked_date,
		'shinspermit_ownverified_by' => $row->shinspermit_ownverified_by,
		'shinspermit_ownverified_date' => $row->shinspermit_ownverified_date,
		'shinspermit_result' => $row->shinspermit_result,
		'shinspermit_result_inspector_id' => $row->shinspermit_result_inspector_id,
		'shinspermit_inspection_date' => $row->shinspermit_inspection_date,
		'shinspermit_retest_result' => $row->shinspermit_retest_result,
		'shinspermit_retest_result_inspector_id' => $row->shinspermit_retest_result_inspector_id,
		'shinspermit_retest_inspection_date' => $row->shinspermit_retest_inspection_date,
		'shinspermit_managerverified_id' => $row->shinspermit_managerverified_id,
		'shinspermit_managerverified_date' => $row->shinspermit_managerverified_date,
		'shinspermit_recent_shins_serialno' => $row->shinspermit_recent_shins_serialno,
		'shinspermit_recent_shins_expirydate' => $row->shinspermit_recent_shins_expirydate,
		'shinspermit_recent_shins_typecolor' => $row->shinspermit_recent_shins_typecolor,
		'shinspermit_completed_docs' => $row->shinspermit_completed_docs,
		'shinspermit_inspectionscheduled' => $row->shinspermit_inspectionscheduled,
		'shinspermit_inspectionapproval' => $row->shinspermit_inspectionapproval,
		
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

    $this->content = 'shinspermit/shinspermit_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('shinspermit/shinspermit_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinspermit'));
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
        'action' => site_url('shinspermit/create_action'),
        'shinspermit_permit_id' => set_value('shinspermit_permit_id'),
		'shinspermit_vehicle_id' => set_value('shinspermit_vehicle_id'),
		'shinspermit_required_briefing' => set_value('shinspermit_required_briefing'),
		'shinspermit_attendbriefing' => set_value('shinspermit_attendbriefing'),
		'shinspermit_approved_to_inspect' => set_value('shinspermit_approved_to_inspect'),
		'shinspermit_ownchecked_by' => set_value('shinspermit_ownchecked_by'),
		'shinspermit_ownchecked_date' => set_value('shinspermit_ownchecked_date'),
		'shinspermit_ownverified_by' => set_value('shinspermit_ownverified_by'),
		'shinspermit_ownverified_date' => set_value('shinspermit_ownverified_date'),
		'shinspermit_result' => set_value('shinspermit_result'),
		'shinspermit_result_inspector_id' => set_value('shinspermit_result_inspector_id'),
		'shinspermit_inspection_date' => set_value('shinspermit_inspection_date'),
		'shinspermit_retest_result' => set_value('shinspermit_retest_result'),
		'shinspermit_retest_result_inspector_id' => set_value('shinspermit_retest_result_inspector_id'),
		'shinspermit_retest_inspection_date' => set_value('shinspermit_retest_inspection_date'),
		'shinspermit_managerverified_id' => set_value('shinspermit_managerverified_id'),
		'shinspermit_managerverified_date' => set_value('shinspermit_managerverified_date'),
		'shinspermit_recent_shins_serialno' => set_value('shinspermit_recent_shins_serialno'),
		'shinspermit_recent_shins_expirydate' => set_value('shinspermit_recent_shins_expirydate'),
		'shinspermit_recent_shins_typecolor' => set_value('shinspermit_recent_shins_typecolor'),
		'shinspermit_completed_docs' => set_value('shinspermit_completed_docs'),
		'shinspermit_inspectionscheduled' => set_value('shinspermit_inspectionscheduled'),
		'shinspermit_inspectionapproval' => set_value('shinspermit_inspectionapproval'),
		
);
    $this->content = 'shinspermit/shinspermit_form';
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
        'shinspermit_permit_id' => $this->input->post('shinspermit_permit_id',TRUE),
		'shinspermit_vehicle_id' => $this->input->post('shinspermit_vehicle_id',TRUE),
		'shinspermit_required_briefing' => $this->input->post('shinspermit_required_briefing',TRUE),
		'shinspermit_attendbriefing' => $this->input->post('shinspermit_attendbriefing',TRUE),
		'shinspermit_approved_to_inspect' => $this->input->post('shinspermit_approved_to_inspect',TRUE),
		'shinspermit_ownchecked_by' => $this->input->post('shinspermit_ownchecked_by',TRUE),
		'shinspermit_ownchecked_date' => $this->input->post('shinspermit_ownchecked_date',TRUE),
		'shinspermit_ownverified_by' => $this->input->post('shinspermit_ownverified_by',TRUE),
		'shinspermit_ownverified_date' => $this->input->post('shinspermit_ownverified_date',TRUE),
		'shinspermit_result' => $this->input->post('shinspermit_result',TRUE),
		'shinspermit_result_inspector_id' => $this->input->post('shinspermit_result_inspector_id',TRUE),
		'shinspermit_inspection_date' => $this->input->post('shinspermit_inspection_date',TRUE),
		'shinspermit_retest_result' => $this->input->post('shinspermit_retest_result',TRUE),
		'shinspermit_retest_result_inspector_id' => $this->input->post('shinspermit_retest_result_inspector_id',TRUE),
		'shinspermit_retest_inspection_date' => $this->input->post('shinspermit_retest_inspection_date',TRUE),
		'shinspermit_managerverified_id' => $this->input->post('shinspermit_managerverified_id',TRUE),
		'shinspermit_managerverified_date' => $this->input->post('shinspermit_managerverified_date',TRUE),
		'shinspermit_recent_shins_serialno' => $this->input->post('shinspermit_recent_shins_serialno',TRUE),
		'shinspermit_recent_shins_expirydate' => $this->input->post('shinspermit_recent_shins_expirydate',TRUE),
		'shinspermit_recent_shins_typecolor' => $this->input->post('shinspermit_recent_shins_typecolor',TRUE),
		'shinspermit_completed_docs' => $this->input->post('shinspermit_completed_docs',TRUE),
		'shinspermit_inspectionscheduled' => $this->input->post('shinspermit_inspectionscheduled',TRUE),
		'shinspermit_inspectionapproval' => $this->input->post('shinspermit_inspectionapproval',TRUE),
		'shinspermit_created_at' => date('Y-m-d H:i:s'),
		 'shinspermit_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->shinspermit_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('shinspermit'));
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
    $row = $this->shinspermit_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('shinspermit/update_action'),
        'id' => $id,
        'shinspermit_permit_id' => set_value('shinspermit_permit_id', $row->shinspermit_permit_id),
		'shinspermit_vehicle_id' => set_value('shinspermit_vehicle_id', $row->shinspermit_vehicle_id),
		'shinspermit_required_briefing' => set_value('shinspermit_required_briefing', $row->shinspermit_required_briefing),
		'shinspermit_attendbriefing' => set_value('shinspermit_attendbriefing', $row->shinspermit_attendbriefing),
		'shinspermit_approved_to_inspect' => set_value('shinspermit_approved_to_inspect', $row->shinspermit_approved_to_inspect),
		'shinspermit_ownchecked_by' => set_value('shinspermit_ownchecked_by', $row->shinspermit_ownchecked_by),
		'shinspermit_ownchecked_date' => set_value('shinspermit_ownchecked_date', $row->shinspermit_ownchecked_date),
		'shinspermit_ownverified_by' => set_value('shinspermit_ownverified_by', $row->shinspermit_ownverified_by),
		'shinspermit_ownverified_date' => set_value('shinspermit_ownverified_date', $row->shinspermit_ownverified_date),
		'shinspermit_result' => set_value('shinspermit_result', $row->shinspermit_result),
		'shinspermit_result_inspector_id' => set_value('shinspermit_result_inspector_id', $row->shinspermit_result_inspector_id),
		'shinspermit_inspection_date' => set_value('shinspermit_inspection_date', $row->shinspermit_inspection_date),
		'shinspermit_retest_result' => set_value('shinspermit_retest_result', $row->shinspermit_retest_result),
		'shinspermit_retest_result_inspector_id' => set_value('shinspermit_retest_result_inspector_id', $row->shinspermit_retest_result_inspector_id),
		'shinspermit_retest_inspection_date' => set_value('shinspermit_retest_inspection_date', $row->shinspermit_retest_inspection_date),
		'shinspermit_managerverified_id' => set_value('shinspermit_managerverified_id', $row->shinspermit_managerverified_id),
		'shinspermit_managerverified_date' => set_value('shinspermit_managerverified_date', $row->shinspermit_managerverified_date),
		'shinspermit_recent_shins_serialno' => set_value('shinspermit_recent_shins_serialno', $row->shinspermit_recent_shins_serialno),
		'shinspermit_recent_shins_expirydate' => set_value('shinspermit_recent_shins_expirydate', $row->shinspermit_recent_shins_expirydate),
		'shinspermit_recent_shins_typecolor' => set_value('shinspermit_recent_shins_typecolor', $row->shinspermit_recent_shins_typecolor),
		'shinspermit_completed_docs' => set_value('shinspermit_completed_docs', $row->shinspermit_completed_docs),
		'shinspermit_inspectionscheduled' => set_value('shinspermit_inspectionscheduled', $row->shinspermit_inspectionscheduled),
		'shinspermit_inspectionapproval' => set_value('shinspermit_inspectionapproval', $row->shinspermit_inspectionapproval),
		
      );
    $this->content = 'shinspermit/shinspermit_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinspermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('shinspermit_id', TRUE));
    }
    else {
      $data = array(
        'shinspermit_permit_id' => $this->input->post('shinspermit_permit_id',TRUE),
		'shinspermit_vehicle_id' => $this->input->post('shinspermit_vehicle_id',TRUE),
		'shinspermit_required_briefing' => $this->input->post('shinspermit_required_briefing',TRUE),
		'shinspermit_attendbriefing' => $this->input->post('shinspermit_attendbriefing',TRUE),
		'shinspermit_approved_to_inspect' => $this->input->post('shinspermit_approved_to_inspect',TRUE),
		'shinspermit_ownchecked_by' => $this->input->post('shinspermit_ownchecked_by',TRUE),
		'shinspermit_ownchecked_date' => $this->input->post('shinspermit_ownchecked_date',TRUE),
		'shinspermit_ownverified_by' => $this->input->post('shinspermit_ownverified_by',TRUE),
		'shinspermit_ownverified_date' => $this->input->post('shinspermit_ownverified_date',TRUE),
		'shinspermit_result' => $this->input->post('shinspermit_result',TRUE),
		'shinspermit_result_inspector_id' => $this->input->post('shinspermit_result_inspector_id',TRUE),
		'shinspermit_inspection_date' => $this->input->post('shinspermit_inspection_date',TRUE),
		'shinspermit_retest_result' => $this->input->post('shinspermit_retest_result',TRUE),
		'shinspermit_retest_result_inspector_id' => $this->input->post('shinspermit_retest_result_inspector_id',TRUE),
		'shinspermit_retest_inspection_date' => $this->input->post('shinspermit_retest_inspection_date',TRUE),
		'shinspermit_managerverified_id' => $this->input->post('shinspermit_managerverified_id',TRUE),
		'shinspermit_managerverified_date' => $this->input->post('shinspermit_managerverified_date',TRUE),
		'shinspermit_recent_shins_serialno' => $this->input->post('shinspermit_recent_shins_serialno',TRUE),
		'shinspermit_recent_shins_expirydate' => $this->input->post('shinspermit_recent_shins_expirydate',TRUE),
		'shinspermit_recent_shins_typecolor' => $this->input->post('shinspermit_recent_shins_typecolor',TRUE),
		'shinspermit_completed_docs' => $this->input->post('shinspermit_completed_docs',TRUE),
		'shinspermit_inspectionscheduled' => $this->input->post('shinspermit_inspectionscheduled',TRUE),
		'shinspermit_inspectionapproval' => $this->input->post('shinspermit_inspectionapproval',TRUE),
		'shinspermit_updated_at' => date('Y-m-d H:i:s'),
		 'shinspermit_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->shinspermit_model->update(fixzy_decoder($this->input->post('shinspermit_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('shinspermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->shinspermit_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->shinspermit_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('shinspermit'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinspermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->shinspermit_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'shinspermit_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->shinspermit_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('shinspermit'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinspermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('shinspermit_permit_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('shinspermit_vehicle_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('shinspermit_required_briefing', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_attendbriefing', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_approved_to_inspect', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('shinspermit_ownchecked_by', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_ownchecked_date', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_ownverified_by', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_ownverified_date', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_result', ' ', 'trim|required');
	$this->form_validation->set_rules('shinspermit_result_inspector_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('shinspermit_inspection_date', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_retest_result', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_retest_result_inspector_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('shinspermit_retest_inspection_date', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_managerverified_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('shinspermit_managerverified_date', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_recent_shins_serialno', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_recent_shins_expirydate', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_recent_shins_typecolor', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_completed_docs', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_inspectionscheduled', ' ', 'trim');
	$this->form_validation->set_rules('shinspermit_inspectionapproval', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'shinspermit_id',
		'shinspermit_permit_id',
		'shinspermit_vehicle_id',
		'shinspermit_required_briefing',
		'shinspermit_attendbriefing',
		'shinspermit_approved_to_inspect',
		'shinspermit_ownchecked_by',
		'shinspermit_ownchecked_date',
		'shinspermit_ownverified_by',
		'shinspermit_ownverified_date',
		'shinspermit_result',
		'shinspermit_result_inspector_id',
		'shinspermit_inspection_date',
		'shinspermit_retest_result',
		'shinspermit_retest_result_inspector_id',
		'shinspermit_retest_inspection_date',
		'shinspermit_managerverified_id',
		'shinspermit_managerverified_date',
		'shinspermit_recent_shins_serialno',
		'shinspermit_recent_shins_expirydate',
		'shinspermit_recent_shins_typecolor',
		'shinspermit_completed_docs',
		'shinspermit_inspectionscheduled',
		'shinspermit_inspectionapproval',
		
      );
      $results = $this->shinspermit_model->listajax(
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
              $rud .=  anchor(site_url('shinspermit/read/'.fixzy_encoder($r['shinspermit_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('shinspermit/update/'.fixzy_encoder($r['shinspermit_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('shinspermit/delete/'.fixzy_encoder($r['shinspermit_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['shinspermit_permit_id'],
				$r['shinspermit_vehicle_id'],
				$r['shinspermit_required_briefing'],
				$r['shinspermit_attendbriefing'],
				$r['shinspermit_approved_to_inspect'],
				$r['shinspermit_ownchecked_by'],
				$r['shinspermit_ownchecked_date'],
				$r['shinspermit_ownverified_by'],
				$r['shinspermit_ownverified_date'],
				$r['shinspermit_result'],
				$r['shinspermit_result_inspector_id'],
				$r['shinspermit_inspection_date'],
				$r['shinspermit_retest_result'],
				$r['shinspermit_retest_result_inspector_id'],
				$r['shinspermit_retest_inspection_date'],
				$r['shinspermit_managerverified_id'],
				$r['shinspermit_managerverified_date'],
				$r['shinspermit_recent_shins_serialno'],
				$r['shinspermit_recent_shins_expirydate'],
				$r['shinspermit_recent_shins_typecolor'],
				$r['shinspermit_completed_docs'],
				$r['shinspermit_inspectionscheduled'],
				$r['shinspermit_inspectionapproval'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->shinspermit_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->shinspermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Shinspermit.php */
/* Location: ./application/controllers/Shinspermit.php */