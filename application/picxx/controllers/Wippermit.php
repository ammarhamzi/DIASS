<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Wippermit extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('wippermit_model');
    $this->lang->load('wippermit_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$wippermit = $this->wippermit_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'wippermit_data' => $wippermit,
    'permission' => $this->permission,
    );

    $this->content = 'wippermit/wippermit_list';
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
    $row = $this->wippermit_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'wippermit_permit_id' => $row->wippermit_permit_id,
		'wippermit_vehicle_id' => $row->wippermit_vehicle_id,
		'wippermit_required_briefing' => $row->wippermit_required_briefing,
		'wippermit_attendbriefing' => $row->wippermit_attendbriefing,
		'wippermit_approved_to_inspect' => $row->wippermit_approved_to_inspect,
		'wippermit_ownchecked_by' => $row->wippermit_ownchecked_by,
		'wippermit_ownchecked_date' => $row->wippermit_ownchecked_date,
		'wippermit_ownverified_by' => $row->wippermit_ownverified_by,
		'wippermit_ownverified_date' => $row->wippermit_ownverified_date,
		'wippermit_result' => $row->wippermit_result,
		'wippermit_result_inspector_id' => $row->wippermit_result_inspector_id,
		'wippermit_inspection_date' => $row->wippermit_inspection_date,
		'wippermit_retest_result' => $row->wippermit_retest_result,
		'wippermit_retest_result_inspector_id' => $row->wippermit_retest_result_inspector_id,
		'wippermit_retest_inspection_date' => $row->wippermit_retest_inspection_date,
		'wippermit_managerverified_id' => $row->wippermit_managerverified_id,
		'wippermit_managerverified_date' => $row->wippermit_managerverified_date,
		'wippermit_recent_wip_serialno' => $row->wippermit_recent_wip_serialno,
		'wippermit_recent_wip_expirydate' => $row->wippermit_recent_wip_expirydate,
		'wippermit_recent_wip_typecolor' => $row->wippermit_recent_wip_typecolor,
		'wippermit_completed_docs' => $row->wippermit_completed_docs,
		'wippermit_inspectionscheduled' => $row->wippermit_inspectionscheduled,
		'wippermit_inspectionapproval' => $row->wippermit_inspectionapproval,
		
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

    $this->content = 'wippermit/wippermit_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('wippermit/wippermit_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wippermit'));
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
        'action' => site_url('wippermit/create_action'),
        'wippermit_permit_id' => set_value('wippermit_permit_id'),
		'wippermit_vehicle_id' => set_value('wippermit_vehicle_id'),
		'wippermit_required_briefing' => set_value('wippermit_required_briefing'),
		'wippermit_attendbriefing' => set_value('wippermit_attendbriefing'),
		'wippermit_approved_to_inspect' => set_value('wippermit_approved_to_inspect'),
		'wippermit_ownchecked_by' => set_value('wippermit_ownchecked_by'),
		'wippermit_ownchecked_date' => set_value('wippermit_ownchecked_date'),
		'wippermit_ownverified_by' => set_value('wippermit_ownverified_by'),
		'wippermit_ownverified_date' => set_value('wippermit_ownverified_date'),
		'wippermit_result' => set_value('wippermit_result'),
		'wippermit_result_inspector_id' => set_value('wippermit_result_inspector_id'),
		'wippermit_inspection_date' => set_value('wippermit_inspection_date'),
		'wippermit_retest_result' => set_value('wippermit_retest_result'),
		'wippermit_retest_result_inspector_id' => set_value('wippermit_retest_result_inspector_id'),
		'wippermit_retest_inspection_date' => set_value('wippermit_retest_inspection_date'),
		'wippermit_managerverified_id' => set_value('wippermit_managerverified_id'),
		'wippermit_managerverified_date' => set_value('wippermit_managerverified_date'),
		'wippermit_recent_wip_serialno' => set_value('wippermit_recent_wip_serialno'),
		'wippermit_recent_wip_expirydate' => set_value('wippermit_recent_wip_expirydate'),
		'wippermit_recent_wip_typecolor' => set_value('wippermit_recent_wip_typecolor'),
		'wippermit_completed_docs' => set_value('wippermit_completed_docs'),
		'wippermit_inspectionscheduled' => set_value('wippermit_inspectionscheduled'),
		'wippermit_inspectionapproval' => set_value('wippermit_inspectionapproval'),
		
);
    $this->content = 'wippermit/wippermit_form';
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
        'wippermit_permit_id' => $this->input->post('wippermit_permit_id',TRUE),
		'wippermit_vehicle_id' => $this->input->post('wippermit_vehicle_id',TRUE),
		'wippermit_required_briefing' => $this->input->post('wippermit_required_briefing',TRUE),
		'wippermit_attendbriefing' => $this->input->post('wippermit_attendbriefing',TRUE),
		'wippermit_approved_to_inspect' => $this->input->post('wippermit_approved_to_inspect',TRUE),
		'wippermit_ownchecked_by' => $this->input->post('wippermit_ownchecked_by',TRUE),
		'wippermit_ownchecked_date' => $this->input->post('wippermit_ownchecked_date',TRUE),
		'wippermit_ownverified_by' => $this->input->post('wippermit_ownverified_by',TRUE),
		'wippermit_ownverified_date' => $this->input->post('wippermit_ownverified_date',TRUE),
		'wippermit_result' => $this->input->post('wippermit_result',TRUE),
		'wippermit_result_inspector_id' => $this->input->post('wippermit_result_inspector_id',TRUE),
		'wippermit_inspection_date' => $this->input->post('wippermit_inspection_date',TRUE),
		'wippermit_retest_result' => $this->input->post('wippermit_retest_result',TRUE),
		'wippermit_retest_result_inspector_id' => $this->input->post('wippermit_retest_result_inspector_id',TRUE),
		'wippermit_retest_inspection_date' => $this->input->post('wippermit_retest_inspection_date',TRUE),
		'wippermit_managerverified_id' => $this->input->post('wippermit_managerverified_id',TRUE),
		'wippermit_managerverified_date' => $this->input->post('wippermit_managerverified_date',TRUE),
		'wippermit_recent_wip_serialno' => $this->input->post('wippermit_recent_wip_serialno',TRUE),
		'wippermit_recent_wip_expirydate' => $this->input->post('wippermit_recent_wip_expirydate',TRUE),
		'wippermit_recent_wip_typecolor' => $this->input->post('wippermit_recent_wip_typecolor',TRUE),
		'wippermit_completed_docs' => $this->input->post('wippermit_completed_docs',TRUE),
		'wippermit_inspectionscheduled' => $this->input->post('wippermit_inspectionscheduled',TRUE),
		'wippermit_inspectionapproval' => $this->input->post('wippermit_inspectionapproval',TRUE),
		'wippermit_created_at' => date('Y-m-d H:i:s'),
		 'wippermit_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->wippermit_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('wippermit'));
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
    $row = $this->wippermit_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('wippermit/update_action'),
        'id' => $id,
        'wippermit_permit_id' => set_value('wippermit_permit_id', $row->wippermit_permit_id),
		'wippermit_vehicle_id' => set_value('wippermit_vehicle_id', $row->wippermit_vehicle_id),
		'wippermit_required_briefing' => set_value('wippermit_required_briefing', $row->wippermit_required_briefing),
		'wippermit_attendbriefing' => set_value('wippermit_attendbriefing', $row->wippermit_attendbriefing),
		'wippermit_approved_to_inspect' => set_value('wippermit_approved_to_inspect', $row->wippermit_approved_to_inspect),
		'wippermit_ownchecked_by' => set_value('wippermit_ownchecked_by', $row->wippermit_ownchecked_by),
		'wippermit_ownchecked_date' => set_value('wippermit_ownchecked_date', $row->wippermit_ownchecked_date),
		'wippermit_ownverified_by' => set_value('wippermit_ownverified_by', $row->wippermit_ownverified_by),
		'wippermit_ownverified_date' => set_value('wippermit_ownverified_date', $row->wippermit_ownverified_date),
		'wippermit_result' => set_value('wippermit_result', $row->wippermit_result),
		'wippermit_result_inspector_id' => set_value('wippermit_result_inspector_id', $row->wippermit_result_inspector_id),
		'wippermit_inspection_date' => set_value('wippermit_inspection_date', $row->wippermit_inspection_date),
		'wippermit_retest_result' => set_value('wippermit_retest_result', $row->wippermit_retest_result),
		'wippermit_retest_result_inspector_id' => set_value('wippermit_retest_result_inspector_id', $row->wippermit_retest_result_inspector_id),
		'wippermit_retest_inspection_date' => set_value('wippermit_retest_inspection_date', $row->wippermit_retest_inspection_date),
		'wippermit_managerverified_id' => set_value('wippermit_managerverified_id', $row->wippermit_managerverified_id),
		'wippermit_managerverified_date' => set_value('wippermit_managerverified_date', $row->wippermit_managerverified_date),
		'wippermit_recent_wip_serialno' => set_value('wippermit_recent_wip_serialno', $row->wippermit_recent_wip_serialno),
		'wippermit_recent_wip_expirydate' => set_value('wippermit_recent_wip_expirydate', $row->wippermit_recent_wip_expirydate),
		'wippermit_recent_wip_typecolor' => set_value('wippermit_recent_wip_typecolor', $row->wippermit_recent_wip_typecolor),
		'wippermit_completed_docs' => set_value('wippermit_completed_docs', $row->wippermit_completed_docs),
		'wippermit_inspectionscheduled' => set_value('wippermit_inspectionscheduled', $row->wippermit_inspectionscheduled),
		'wippermit_inspectionapproval' => set_value('wippermit_inspectionapproval', $row->wippermit_inspectionapproval),
		
      );
    $this->content = 'wippermit/wippermit_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wippermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('wippermit_id', TRUE));
    }
    else {
      $data = array(
        'wippermit_permit_id' => $this->input->post('wippermit_permit_id',TRUE),
		'wippermit_vehicle_id' => $this->input->post('wippermit_vehicle_id',TRUE),
		'wippermit_required_briefing' => $this->input->post('wippermit_required_briefing',TRUE),
		'wippermit_attendbriefing' => $this->input->post('wippermit_attendbriefing',TRUE),
		'wippermit_approved_to_inspect' => $this->input->post('wippermit_approved_to_inspect',TRUE),
		'wippermit_ownchecked_by' => $this->input->post('wippermit_ownchecked_by',TRUE),
		'wippermit_ownchecked_date' => $this->input->post('wippermit_ownchecked_date',TRUE),
		'wippermit_ownverified_by' => $this->input->post('wippermit_ownverified_by',TRUE),
		'wippermit_ownverified_date' => $this->input->post('wippermit_ownverified_date',TRUE),
		'wippermit_result' => $this->input->post('wippermit_result',TRUE),
		'wippermit_result_inspector_id' => $this->input->post('wippermit_result_inspector_id',TRUE),
		'wippermit_inspection_date' => $this->input->post('wippermit_inspection_date',TRUE),
		'wippermit_retest_result' => $this->input->post('wippermit_retest_result',TRUE),
		'wippermit_retest_result_inspector_id' => $this->input->post('wippermit_retest_result_inspector_id',TRUE),
		'wippermit_retest_inspection_date' => $this->input->post('wippermit_retest_inspection_date',TRUE),
		'wippermit_managerverified_id' => $this->input->post('wippermit_managerverified_id',TRUE),
		'wippermit_managerverified_date' => $this->input->post('wippermit_managerverified_date',TRUE),
		'wippermit_recent_wip_serialno' => $this->input->post('wippermit_recent_wip_serialno',TRUE),
		'wippermit_recent_wip_expirydate' => $this->input->post('wippermit_recent_wip_expirydate',TRUE),
		'wippermit_recent_wip_typecolor' => $this->input->post('wippermit_recent_wip_typecolor',TRUE),
		'wippermit_completed_docs' => $this->input->post('wippermit_completed_docs',TRUE),
		'wippermit_inspectionscheduled' => $this->input->post('wippermit_inspectionscheduled',TRUE),
		'wippermit_inspectionapproval' => $this->input->post('wippermit_inspectionapproval',TRUE),
		'wippermit_updated_at' => date('Y-m-d H:i:s'),
		 'wippermit_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->wippermit_model->update(fixzy_decoder($this->input->post('wippermit_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('wippermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->wippermit_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->wippermit_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('wippermit'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wippermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->wippermit_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'wippermit_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->wippermit_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('wippermit'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wippermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('wippermit_permit_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('wippermit_vehicle_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('wippermit_required_briefing', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_attendbriefing', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_approved_to_inspect', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('wippermit_ownchecked_by', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_ownchecked_date', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_ownverified_by', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_ownverified_date', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_result', ' ', 'trim|required');
	$this->form_validation->set_rules('wippermit_result_inspector_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('wippermit_inspection_date', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_retest_result', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_retest_result_inspector_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('wippermit_retest_inspection_date', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_managerverified_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('wippermit_managerverified_date', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_recent_wip_serialno', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_recent_wip_expirydate', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_recent_wip_typecolor', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_completed_docs', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_inspectionscheduled', ' ', 'trim');
	$this->form_validation->set_rules('wippermit_inspectionapproval', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'wippermit_id',
		'wippermit_permit_id',
		'wippermit_vehicle_id',
		'wippermit_required_briefing',
		'wippermit_attendbriefing',
		'wippermit_approved_to_inspect',
		'wippermit_ownchecked_by',
		'wippermit_ownchecked_date',
		'wippermit_ownverified_by',
		'wippermit_ownverified_date',
		'wippermit_result',
		'wippermit_result_inspector_id',
		'wippermit_inspection_date',
		'wippermit_retest_result',
		'wippermit_retest_result_inspector_id',
		'wippermit_retest_inspection_date',
		'wippermit_managerverified_id',
		'wippermit_managerverified_date',
		'wippermit_recent_wip_serialno',
		'wippermit_recent_wip_expirydate',
		'wippermit_recent_wip_typecolor',
		'wippermit_completed_docs',
		'wippermit_inspectionscheduled',
		'wippermit_inspectionapproval',
		
      );
      $results = $this->wippermit_model->listajax(
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
              $rud .=  anchor(site_url('wippermit/read/'.fixzy_encoder($r['wippermit_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('wippermit/update/'.fixzy_encoder($r['wippermit_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('wippermit/delete/'.fixzy_encoder($r['wippermit_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['wippermit_permit_id'],
				$r['wippermit_vehicle_id'],
				$r['wippermit_required_briefing'],
				$r['wippermit_attendbriefing'],
				$r['wippermit_approved_to_inspect'],
				$r['wippermit_ownchecked_by'],
				$r['wippermit_ownchecked_date'],
				$r['wippermit_ownverified_by'],
				$r['wippermit_ownverified_date'],
				$r['wippermit_result'],
				$r['wippermit_result_inspector_id'],
				$r['wippermit_inspection_date'],
				$r['wippermit_retest_result'],
				$r['wippermit_retest_result_inspector_id'],
				$r['wippermit_retest_inspection_date'],
				$r['wippermit_managerverified_id'],
				$r['wippermit_managerverified_date'],
				$r['wippermit_recent_wip_serialno'],
				$r['wippermit_recent_wip_expirydate'],
				$r['wippermit_recent_wip_typecolor'],
				$r['wippermit_completed_docs'],
				$r['wippermit_inspectionscheduled'],
				$r['wippermit_inspectionapproval'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->wippermit_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->wippermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Wippermit.php */
/* Location: ./application/controllers/Wippermit.php */