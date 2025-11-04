<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Avppermit extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('avppermit_model');
    $this->load->model('avpbriefingmanagement_model');
    $this->lang->load('avppermit_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

      $setting = array(
        'method'=>'newpage',
        'patern'=>'list',
        );
      $avppermit = $this->avppermit_model->get_all();
      /* $this->logQueries($this->config->item('dblog')); */
      $data = array(
        'avppermit_data' => $avppermit,
        'permission' => $this->permission,
        );

      $this->content = 'avppermit/avppermit_list';
    ##--slave_combine_to_list--##
      $this->layout($data, $setting);

    }else{
      redirect('/');
    }

  }

  public function inspectioncalendar()
  {

    if ($this->permission->showlist == true) {
      $setting = [
      'method' => 'newpage',
      'patern' => 'list',
      ];

      $data = [
        'permission' => $this->permission,
      ];

      $this->content = 'avppermit/avppermit_inspectioncalendar';
      ##--slave_combine_to_list--##
      $this->layout($data, $setting);

    } else {
      redirect('/');
    }
  }
  
  public function avpevpinspectioncalendar()
  {
    if ($this->permission->showlist == true) {
      $setting = [
      'method' => 'newpage',
      'patern' => 'list',
      ];

      $data = [
        'permission' => $this->permission,
      ];

      $this->content = 'avppermit/avpevppermit_inspectioncalendar';
      ##--slave_combine_to_list--##
      $this->layout($data, $setting);

    } else {
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
    $row = $this->avppermit_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'avppermit_permit_id' => $row->avppermit_permit_id,
        'avppermit_vehicle_id' => $row->avppermit_vehicle_id,
        'avppermit_required_briefing' => $row->avppermit_required_briefing,
        'avppermit_attendbriefing' => $row->avppermit_attendbriefing,
        'avppermit_approved_to_inspect' => $row->avppermit_approved_to_inspect,
        'avppermit_ownchecked_by' => $row->avppermit_ownchecked_by,
        'avppermit_ownchecked_date' => $row->avppermit_ownchecked_date,
        'avppermit_ownverified_by' => $row->avppermit_ownverified_by,
        'avppermit_ownverified_date' => $row->avppermit_ownverified_date,
        'avppermit_result' => $row->avppermit_result,
        'avppermit_result_inspector_id' => $row->avppermit_result_inspector_id,
        'avppermit_inspection_date' => $row->avppermit_inspection_date,
        'avppermit_retest_result' => $row->avppermit_retest_result,
        'avppermit_retest_result_inspector_id' => $row->avppermit_retest_result_inspector_id,
        'avppermit_retest_inspection_date' => $row->avppermit_retest_inspection_date,
        'avppermit_managerverified_id' => $row->avppermit_managerverified_id,
        'avppermit_managerverified_date' => $row->avppermit_managerverified_date,
        'avppermit_recent_avp_serialno' => $row->avppermit_recent_avp_serialno,
        'avppermit_recent_avp_expirydate' => $row->avppermit_recent_avp_expirydate,
        'avppermit_recent_avp_typecolor' => $row->avppermit_recent_avp_typecolor,
        'avppermit_completed_docs' => $row->avppermit_completed_docs,
        'avppermit_inspectionscheduled' => $row->avppermit_inspectionscheduled,
        'avppermit_inspectionapproval' => $row->avppermit_inspectionapproval,

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

  $this->content = 'avppermit/avppermit_read';
    ##--slave_combine_to_read--##
  $this->layout($data, $setting);
}else{
  echo $this->load->view('avppermit/avppermit_read_raw', $data, TRUE);
}

}
else {
  $this->session->set_flashdata('message', 'Record Not Found');
  redirect(site_url('avppermit'));
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
    'action' => site_url('avppermit/create_action'),
    'avppermit_permit_id' => set_value('avppermit_permit_id'),
    'avppermit_vehicle_id' => set_value('avppermit_vehicle_id'),
    'avppermit_required_briefing' => set_value('avppermit_required_briefing'),
    'avppermit_attendbriefing' => set_value('avppermit_attendbriefing'),
    'avppermit_approved_to_inspect' => set_value('avppermit_approved_to_inspect'),
    'avppermit_ownchecked_by' => set_value('avppermit_ownchecked_by'),
    'avppermit_ownchecked_date' => set_value('avppermit_ownchecked_date'),
    'avppermit_ownverified_by' => set_value('avppermit_ownverified_by'),
    'avppermit_ownverified_date' => set_value('avppermit_ownverified_date'),
    'avppermit_result' => set_value('avppermit_result'),
    'avppermit_result_inspector_id' => set_value('avppermit_result_inspector_id'),
    'avppermit_inspection_date' => set_value('avppermit_inspection_date'),
    'avppermit_retest_result' => set_value('avppermit_retest_result'),
    'avppermit_retest_result_inspector_id' => set_value('avppermit_retest_result_inspector_id'),
    'avppermit_retest_inspection_date' => set_value('avppermit_retest_inspection_date'),
    'avppermit_managerverified_id' => set_value('avppermit_managerverified_id'),
    'avppermit_managerverified_date' => set_value('avppermit_managerverified_date'),
    'avppermit_recent_avp_serialno' => set_value('avppermit_recent_avp_serialno'),
    'avppermit_recent_avp_expirydate' => set_value('avppermit_recent_avp_expirydate'),
    'avppermit_recent_avp_typecolor' => set_value('avppermit_recent_avp_typecolor'),
    'avppermit_completed_docs' => set_value('avppermit_completed_docs'),
    'avppermit_inspectionscheduled' => set_value('avppermit_inspectionscheduled'),
    'avppermit_inspectionapproval' => set_value('avppermit_inspectionapproval'),

    );
$this->content = 'avppermit/avppermit_form';
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
      'avppermit_permit_id' => $this->input->post('avppermit_permit_id',TRUE),
      'avppermit_vehicle_id' => $this->input->post('avppermit_vehicle_id',TRUE),
      'avppermit_required_briefing' => $this->input->post('avppermit_required_briefing',TRUE),
      'avppermit_attendbriefing' => $this->input->post('avppermit_attendbriefing',TRUE),
      'avppermit_approved_to_inspect' => $this->input->post('avppermit_approved_to_inspect',TRUE),
      'avppermit_ownchecked_by' => $this->input->post('avppermit_ownchecked_by',TRUE),
      'avppermit_ownchecked_date' => $this->input->post('avppermit_ownchecked_date',TRUE),
      'avppermit_ownverified_by' => $this->input->post('avppermit_ownverified_by',TRUE),
      'avppermit_ownverified_date' => $this->input->post('avppermit_ownverified_date',TRUE),
      'avppermit_result' => $this->input->post('avppermit_result',TRUE),
      'avppermit_result_inspector_id' => $this->input->post('avppermit_result_inspector_id',TRUE),
      'avppermit_inspection_date' => $this->input->post('avppermit_inspection_date',TRUE),
      'avppermit_retest_result' => $this->input->post('avppermit_retest_result',TRUE),
      'avppermit_retest_result_inspector_id' => $this->input->post('avppermit_retest_result_inspector_id',TRUE),
      'avppermit_retest_inspection_date' => $this->input->post('avppermit_retest_inspection_date',TRUE),
      'avppermit_managerverified_id' => $this->input->post('avppermit_managerverified_id',TRUE),
      'avppermit_managerverified_date' => $this->input->post('avppermit_managerverified_date',TRUE),
      'avppermit_recent_avp_serialno' => $this->input->post('avppermit_recent_avp_serialno',TRUE),
      'avppermit_recent_avp_expirydate' => $this->input->post('avppermit_recent_avp_expirydate',TRUE),
      'avppermit_recent_avp_typecolor' => $this->input->post('avppermit_recent_avp_typecolor',TRUE),
      'avppermit_completed_docs' => $this->input->post('avppermit_completed_docs',TRUE),
      'avppermit_inspectionscheduled' => $this->input->post('avppermit_inspectionscheduled',TRUE),
      'avppermit_inspectionapproval' => $this->input->post('avppermit_inspectionapproval',TRUE),
      'avppermit_created_at' => date('Y-m-d H:i:s'),
      'avppermit_lastchanged_by' => $this->session->userdata('id'),
      );
$this->avppermit_model->insert($data);
$primary_id = $this->db->insert_id();
/* $this->logQueries($this->config->item('dblog')); */

$this->session->set_flashdata('message', 'Create Record Success');
redirect(site_url('avppermit'));
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
  $row = $this->avppermit_model->get_by_id(fixzy_decoder($id));
  /* $this->logQueries($this->config->item('dblog')); */
  if ($row) {
    $data = array(
      'button' => $this->lang->line('edit'),
      'action' => site_url('avppermit/update_action'),
      'id' => $id,
      'avppermit_permit_id' => set_value('avppermit_permit_id', $row->avppermit_permit_id),
      'avppermit_vehicle_id' => set_value('avppermit_vehicle_id', $row->avppermit_vehicle_id),
      'avppermit_required_briefing' => set_value('avppermit_required_briefing', $row->avppermit_required_briefing),
      'avppermit_attendbriefing' => set_value('avppermit_attendbriefing', $row->avppermit_attendbriefing),
      'avppermit_approved_to_inspect' => set_value('avppermit_approved_to_inspect', $row->avppermit_approved_to_inspect),
      'avppermit_ownchecked_by' => set_value('avppermit_ownchecked_by', $row->avppermit_ownchecked_by),
      'avppermit_ownchecked_date' => set_value('avppermit_ownchecked_date', $row->avppermit_ownchecked_date),
      'avppermit_ownverified_by' => set_value('avppermit_ownverified_by', $row->avppermit_ownverified_by),
      'avppermit_ownverified_date' => set_value('avppermit_ownverified_date', $row->avppermit_ownverified_date),
      'avppermit_result' => set_value('avppermit_result', $row->avppermit_result),
      'avppermit_result_inspector_id' => set_value('avppermit_result_inspector_id', $row->avppermit_result_inspector_id),
      'avppermit_inspection_date' => set_value('avppermit_inspection_date', $row->avppermit_inspection_date),
      'avppermit_retest_result' => set_value('avppermit_retest_result', $row->avppermit_retest_result),
      'avppermit_retest_result_inspector_id' => set_value('avppermit_retest_result_inspector_id', $row->avppermit_retest_result_inspector_id),
      'avppermit_retest_inspection_date' => set_value('avppermit_retest_inspection_date', $row->avppermit_retest_inspection_date),
      'avppermit_managerverified_id' => set_value('avppermit_managerverified_id', $row->avppermit_managerverified_id),
      'avppermit_managerverified_date' => set_value('avppermit_managerverified_date', $row->avppermit_managerverified_date),
      'avppermit_recent_avp_serialno' => set_value('avppermit_recent_avp_serialno', $row->avppermit_recent_avp_serialno),
      'avppermit_recent_avp_expirydate' => set_value('avppermit_recent_avp_expirydate', $row->avppermit_recent_avp_expirydate),
      'avppermit_recent_avp_typecolor' => set_value('avppermit_recent_avp_typecolor', $row->avppermit_recent_avp_typecolor),
      'avppermit_completed_docs' => set_value('avppermit_completed_docs', $row->avppermit_completed_docs),
      'avppermit_inspectionscheduled' => set_value('avppermit_inspectionscheduled', $row->avppermit_inspectionscheduled),
      'avppermit_inspectionapproval' => set_value('avppermit_inspectionapproval', $row->avppermit_inspectionapproval),

      );
$this->content = 'avppermit/avppermit_form';
    ##--slave_combine_to_update--##
$this->layout($data, $setting);
}
else {
  $this->session->set_flashdata('message', 'Record Not Found');
  redirect(site_url('avppermit'));
}

}else{
 redirect('/');
}

}

public function update_action() {

 if($this->permission->cp_update == true){


  $this->_rules();

  if ($this->form_validation->run() == FALSE) {
    $this->update($this->input->post('avppermit_id', TRUE));
  }
  else {
    $data = array(
      'avppermit_permit_id' => $this->input->post('avppermit_permit_id',TRUE),
      'avppermit_vehicle_id' => $this->input->post('avppermit_vehicle_id',TRUE),
      'avppermit_required_briefing' => $this->input->post('avppermit_required_briefing',TRUE),
      'avppermit_attendbriefing' => $this->input->post('avppermit_attendbriefing',TRUE),
      'avppermit_approved_to_inspect' => $this->input->post('avppermit_approved_to_inspect',TRUE),
      'avppermit_ownchecked_by' => $this->input->post('avppermit_ownchecked_by',TRUE),
      'avppermit_ownchecked_date' => $this->input->post('avppermit_ownchecked_date',TRUE),
      'avppermit_ownverified_by' => $this->input->post('avppermit_ownverified_by',TRUE),
      'avppermit_ownverified_date' => $this->input->post('avppermit_ownverified_date',TRUE),
      'avppermit_result' => $this->input->post('avppermit_result',TRUE),
      'avppermit_result_inspector_id' => $this->input->post('avppermit_result_inspector_id',TRUE),
      'avppermit_inspection_date' => $this->input->post('avppermit_inspection_date',TRUE),
      'avppermit_retest_result' => $this->input->post('avppermit_retest_result',TRUE),
      'avppermit_retest_result_inspector_id' => $this->input->post('avppermit_retest_result_inspector_id',TRUE),
      'avppermit_retest_inspection_date' => $this->input->post('avppermit_retest_inspection_date',TRUE),
      'avppermit_managerverified_id' => $this->input->post('avppermit_managerverified_id',TRUE),
      'avppermit_managerverified_date' => $this->input->post('avppermit_managerverified_date',TRUE),
      'avppermit_recent_avp_serialno' => $this->input->post('avppermit_recent_avp_serialno',TRUE),
      'avppermit_recent_avp_expirydate' => $this->input->post('avppermit_recent_avp_expirydate',TRUE),
      'avppermit_recent_avp_typecolor' => $this->input->post('avppermit_recent_avp_typecolor',TRUE),
      'avppermit_completed_docs' => $this->input->post('avppermit_completed_docs',TRUE),
      'avppermit_inspectionscheduled' => $this->input->post('avppermit_inspectionscheduled',TRUE),
      'avppermit_inspectionapproval' => $this->input->post('avppermit_inspectionapproval',TRUE),
      'avppermit_updated_at' => date('Y-m-d H:i:s'),
      'avppermit_lastchanged_by' => $this->session->userdata('id'),
      );
$this->avppermit_model->update(fixzy_decoder($this->input->post('avppermit_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */

$this->session->set_flashdata('message', 'Update Record Success');
redirect(site_url('avppermit'));
}

}else{
 redirect('/');
}

}

public function delete($id) {

 if($this->permission->cp_delete == true){

  $id = fixzy_decoder($id);
  $row = $this->avppermit_model->get_by_id($id);
  /* $this->logQueries($this->config->item('dblog')); */
  if ($row) {
    $this->avppermit_model->delete($id);
    /* $this->logQueries($this->config->item('dblog')); */
    $this->session->set_flashdata('message', 'Delete Record Success');
    redirect(site_url('avppermit'));
  }
  else {
    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('avppermit'));
  }

}else{
 redirect('/');
}

}

public function delete_update($id) {

 if($this->permission->cp_delete == true){

  $id = fixzy_decoder($id);
  $row = $this->avppermit_model->get_by_id($id);
  /* $this->logQueries($this->config->item('dblog')); */
  if ($row) {
    $data = array(
      'avppermit_deleted_at' => date('Y-m-d H:i:s')
      );
    $this->avppermit_model->update($id, $data);
    /* $this->logQueries($this->config->item('dblog')); */
    $this->session->set_flashdata('message', 'Delete Record Success');
    redirect(site_url('avppermit'));
  }
  else {
    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('avppermit'));
  }

}else{
 redirect('/');
}

}

public function _rules() {
  $this->form_validation->set_rules('avppermit_permit_id', ' ', 'trim|required|integer');
  $this->form_validation->set_rules('avppermit_vehicle_id', ' ', 'trim|required|integer');
  $this->form_validation->set_rules('avppermit_required_briefing', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_attendbriefing', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_approved_to_inspect', ' ', 'trim|required|integer');
  $this->form_validation->set_rules('avppermit_ownchecked_by', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_ownchecked_date', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_ownverified_by', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_ownverified_date', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_result', ' ', 'trim|required');
  $this->form_validation->set_rules('avppermit_result_inspector_id', ' ', 'trim|required|integer');
  $this->form_validation->set_rules('avppermit_inspection_date', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_retest_result', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_retest_result_inspector_id', ' ', 'trim|required|integer');
  $this->form_validation->set_rules('avppermit_retest_inspection_date', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_managerverified_id', ' ', 'trim|required|integer');
  $this->form_validation->set_rules('avppermit_managerverified_date', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_recent_avp_serialno', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_recent_avp_expirydate', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_recent_avp_typecolor', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_completed_docs', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_inspectionscheduled', ' ', 'trim');
  $this->form_validation->set_rules('avppermit_inspectionapproval', ' ', 'trim');

  $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
}



public function get_json() {

  $i = $this->input->get('start');
  $columns = array(
    'avppermit_id',
    'avppermit_permit_id',
    'avppermit_vehicle_id',
    'avppermit_required_briefing',
    'avppermit_attendbriefing',
    'avppermit_approved_to_inspect',
    'avppermit_ownchecked_by',
    'avppermit_ownchecked_date',
    'avppermit_ownverified_by',
    'avppermit_ownverified_date',
    'avppermit_result',
    'avppermit_result_inspector_id',
    'avppermit_inspection_date',
    'avppermit_retest_result',
    'avppermit_retest_result_inspector_id',
    'avppermit_retest_inspection_date',
    'avppermit_managerverified_id',
    'avppermit_managerverified_date',
    'avppermit_recent_avp_serialno',
    'avppermit_recent_avp_expirydate',
    'avppermit_recent_avp_typecolor',
    'avppermit_completed_docs',
    'avppermit_inspectionscheduled',
    'avppermit_inspectionapproval',

    );
  $results = $this->avppermit_model->listajax(
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
      $rud .=  anchor(site_url('avppermit/read/'.fixzy_encoder($r['avppermit_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
      ' ';
    }
    if($this->permission->cp_update == true){
      $rud .=    anchor(site_url('avppermit/update/'.fixzy_encoder($r['avppermit_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
      ' ';
    }
    if($this->permission->cp_delete == true){
      $rud .= anchor(site_url('avppermit/delete/'.fixzy_encoder($r['avppermit_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
    }
    array_push($data, array(
      $i,
      $r['avppermit_permit_id'],
      $r['avppermit_vehicle_id'],
      $r['avppermit_required_briefing'],
      $r['avppermit_attendbriefing'],
      $r['avppermit_approved_to_inspect'],
      $r['avppermit_ownchecked_by'],
      $r['avppermit_ownchecked_date'],
      $r['avppermit_ownverified_by'],
      $r['avppermit_ownverified_date'],
      $r['avppermit_result'],
      $r['avppermit_result_inspector_id'],
      $r['avppermit_inspection_date'],
      $r['avppermit_retest_result'],
      $r['avppermit_retest_result_inspector_id'],
      $r['avppermit_retest_inspection_date'],
      $r['avppermit_managerverified_id'],
      $r['avppermit_managerverified_date'],
      $r['avppermit_recent_avp_serialno'],
      $r['avppermit_recent_avp_expirydate'],
      $r['avppermit_recent_avp_typecolor'],
      $r['avppermit_completed_docs'],
      $r['avppermit_inspectionscheduled'],
      $r['avppermit_inspectionapproval'],

      $rud



      ));
  }

  echo json_encode(
    array(
      "draw"=>intval( $this->input->get('draw') ),
      "recordsTotal"=> $this->avppermit_model->recordsTotal()->recordstotal,
      "recordsFiltered" => $this->avppermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
      'data' => $data
      )
    );
}

}
;
/* End of file Avppermit.php */
/* Location: ./application/controllers/Avppermit.php */