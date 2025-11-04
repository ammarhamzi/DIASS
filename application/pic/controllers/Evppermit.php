<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Evppermit extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('evppermit_model');
    $this->lang->load('evppermit_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$evppermit = $this->evppermit_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    /*'evppermit_data' => $evppermit, */
    'permission' => $this->permission,
    );

    $this->content = 'evppermit/evppermit_list';
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
    $row = $this->evppermit_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'evppermit_permit_id' => $row->evppermit_permit_id,
		'evppermit_vehicle_id' => $row->evppermit_vehicle_id,
		'evppermit_required_briefing' => $row->evppermit_required_briefing,
		'evppermit_attendbriefing' => $row->evppermit_attendbriefing,
		'evppermit_approved_to_inspect' => $row->evppermit_approved_to_inspect,
		'evppermit_ownerauthorization' => $row->evppermit_ownerauthorization,
		'evppermit_ownerauthorization_date' => $row->evppermit_ownerauthorization_date,
		'evppermit_result' => $row->evppermit_result,
		'evppermit_result_inspector_id' => $row->evppermit_result_inspector_id,
		'evppermit_inspection_date' => $row->evppermit_inspection_date,
		'evppermit_managerverified_id' => $row->evppermit_managerverified_id,
		'evppermit_managerverified_date' => $row->evppermit_managerverified_date,
		'evppermit_recent_evp_serialno' => $row->evppermit_recent_evp_serialno,
		'evppermit_recent_evp_expirydate' => $row->evppermit_recent_evp_expirydate,
		'evppermit_completed_docs' => $row->evppermit_completed_docs,
/*		'evppermit_inspectionscheduled' => $row->evppermit_inspectionscheduled,*/
		'evppermit_inspectionapproval' => $row->evppermit_inspectionapproval,
		'evppermit_lastchanged_by' => $row->evppermit_lastchanged_by,
		
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

    $this->content = 'evppermit/evppermit_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('evppermit/evppermit_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evppermit'));
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
        'action' => site_url('evppermit/create_action'),
        'evppermit_permit_id' => set_value('evppermit_permit_id'),
		'evppermit_vehicle_id' => set_value('evppermit_vehicle_id'),
		'evppermit_required_briefing' => set_value('evppermit_required_briefing'),
		'evppermit_attendbriefing' => set_value('evppermit_attendbriefing'),
		'evppermit_approved_to_inspect' => set_value('evppermit_approved_to_inspect'),
		'evppermit_ownerauthorization' => set_value('evppermit_ownerauthorization'),
		'evppermit_ownerauthorization_date' => set_value('evppermit_ownerauthorization_date'),
		'evppermit_result' => set_value('evppermit_result'),
		'evppermit_result_inspector_id' => set_value('evppermit_result_inspector_id'),
		'evppermit_inspection_date' => set_value('evppermit_inspection_date'),
		'evppermit_managerverified_id' => set_value('evppermit_managerverified_id'),
		'evppermit_managerverified_date' => set_value('evppermit_managerverified_date'),
		'evppermit_recent_evp_serialno' => set_value('evppermit_recent_evp_serialno'),
		'evppermit_recent_evp_expirydate' => set_value('evppermit_recent_evp_expirydate'),
		'evppermit_completed_docs' => set_value('evppermit_completed_docs'),
		/*'evppermit_inspectionscheduled' => set_value('evppermit_inspectionscheduled'),*/
		'evppermit_inspectionapproval' => set_value('evppermit_inspectionapproval'),
		'evppermit_lastchanged_by' => set_value('evppermit_lastchanged_by'),
		
);
    $this->content = 'evppermit/evppermit_form';
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
        'evppermit_permit_id' => $this->input->post('evppermit_permit_id',TRUE),
		'evppermit_vehicle_id' => $this->input->post('evppermit_vehicle_id',TRUE),
		'evppermit_required_briefing' => $this->input->post('evppermit_required_briefing',TRUE),
		'evppermit_attendbriefing' => $this->input->post('evppermit_attendbriefing',TRUE),
		'evppermit_approved_to_inspect' => $this->input->post('evppermit_approved_to_inspect',TRUE),
		'evppermit_ownerauthorization' => $this->input->post('evppermit_ownerauthorization',TRUE),
		'evppermit_ownerauthorization_date' => $this->input->post('evppermit_ownerauthorization_date',TRUE),
		'evppermit_result' => $this->input->post('evppermit_result',TRUE),
		'evppermit_result_inspector_id' => $this->input->post('evppermit_result_inspector_id',TRUE),
		'evppermit_inspection_date' => $this->input->post('evppermit_inspection_date',TRUE),
		'evppermit_managerverified_id' => $this->input->post('evppermit_managerverified_id',TRUE),
		'evppermit_managerverified_date' => $this->input->post('evppermit_managerverified_date',TRUE),
		'evppermit_recent_evp_serialno' => $this->input->post('evppermit_recent_evp_serialno',TRUE),
		'evppermit_recent_evp_expirydate' => $this->input->post('evppermit_recent_evp_expirydate',TRUE),
		'evppermit_completed_docs' => $this->input->post('evppermit_completed_docs',TRUE),
		/*'evppermit_inspectionscheduled' => $this->input->post('evppermit_inspectionscheduled',TRUE),*/
		'evppermit_inspectionapproval' => $this->input->post('evppermit_inspectionapproval',TRUE),
		'evppermit_lastchanged_by' => $this->input->post('evppermit_lastchanged_by',TRUE),
		'evppermit_created_at' => date('Y-m-d H:i:s'),
		 'evppermit_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->evppermit_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('evppermit'));
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
    $row = $this->evppermit_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('evppermit/update_action'),
        'id' => $id,
        'evppermit_permit_id' => set_value('evppermit_permit_id', $row->evppermit_permit_id),
		'evppermit_vehicle_id' => set_value('evppermit_vehicle_id', $row->evppermit_vehicle_id),
		'evppermit_required_briefing' => set_value('evppermit_required_briefing', $row->evppermit_required_briefing),
		'evppermit_attendbriefing' => set_value('evppermit_attendbriefing', $row->evppermit_attendbriefing),
		'evppermit_approved_to_inspect' => set_value('evppermit_approved_to_inspect', $row->evppermit_approved_to_inspect),
		'evppermit_ownerauthorization' => set_value('evppermit_ownerauthorization', $row->evppermit_ownerauthorization),
		'evppermit_ownerauthorization_date' => set_value('evppermit_ownerauthorization_date', $row->evppermit_ownerauthorization_date),
		'evppermit_result' => set_value('evppermit_result', $row->evppermit_result),
		'evppermit_result_inspector_id' => set_value('evppermit_result_inspector_id', $row->evppermit_result_inspector_id),
		'evppermit_inspection_date' => set_value('evppermit_inspection_date', $row->evppermit_inspection_date),
		'evppermit_managerverified_id' => set_value('evppermit_managerverified_id', $row->evppermit_managerverified_id),
		'evppermit_managerverified_date' => set_value('evppermit_managerverified_date', $row->evppermit_managerverified_date),
		'evppermit_recent_evp_serialno' => set_value('evppermit_recent_evp_serialno', $row->evppermit_recent_evp_serialno),
		'evppermit_recent_evp_expirydate' => set_value('evppermit_recent_evp_expirydate', $row->evppermit_recent_evp_expirydate),
		'evppermit_completed_docs' => set_value('evppermit_completed_docs', $row->evppermit_completed_docs),
/*		'evppermit_inspectionscheduled' => set_value('evppermit_inspectionscheduled', $row->evppermit_inspectionscheduled),*/
		'evppermit_inspectionapproval' => set_value('evppermit_inspectionapproval', $row->evppermit_inspectionapproval),
		'evppermit_lastchanged_by' => set_value('evppermit_lastchanged_by', $row->evppermit_lastchanged_by),
		
      );
    $this->content = 'evppermit/evppermit_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evppermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('evppermit_id', TRUE));
    }
    else {
      $data = array(
        'evppermit_permit_id' => $this->input->post('evppermit_permit_id',TRUE),
		'evppermit_vehicle_id' => $this->input->post('evppermit_vehicle_id',TRUE),
		'evppermit_required_briefing' => $this->input->post('evppermit_required_briefing',TRUE),
		'evppermit_attendbriefing' => $this->input->post('evppermit_attendbriefing',TRUE),
		'evppermit_approved_to_inspect' => $this->input->post('evppermit_approved_to_inspect',TRUE),
		'evppermit_ownerauthorization' => $this->input->post('evppermit_ownerauthorization',TRUE),
		'evppermit_ownerauthorization_date' => $this->input->post('evppermit_ownerauthorization_date',TRUE),
		'evppermit_result' => $this->input->post('evppermit_result',TRUE),
		'evppermit_result_inspector_id' => $this->input->post('evppermit_result_inspector_id',TRUE),
		'evppermit_inspection_date' => $this->input->post('evppermit_inspection_date',TRUE),
		'evppermit_managerverified_id' => $this->input->post('evppermit_managerverified_id',TRUE),
		'evppermit_managerverified_date' => $this->input->post('evppermit_managerverified_date',TRUE),
		'evppermit_recent_evp_serialno' => $this->input->post('evppermit_recent_evp_serialno',TRUE),
		'evppermit_recent_evp_expirydate' => $this->input->post('evppermit_recent_evp_expirydate',TRUE),
		'evppermit_completed_docs' => $this->input->post('evppermit_completed_docs',TRUE),
		/*'evppermit_inspectionscheduled' => $this->input->post('evppermit_inspectionscheduled',TRUE),*/
		'evppermit_inspectionapproval' => $this->input->post('evppermit_inspectionapproval',TRUE),
		'evppermit_lastchanged_by' => $this->input->post('evppermit_lastchanged_by',TRUE),
		'evppermit_updated_at' => date('Y-m-d H:i:s'),
		 'evppermit_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->evppermit_model->update(fixzy_decoder($this->input->post('evppermit_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('evppermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->evppermit_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->evppermit_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('evppermit'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evppermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->evppermit_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'evppermit_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->evppermit_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('evppermit'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evppermit'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('evppermit_permit_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('evppermit_vehicle_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('evppermit_required_briefing', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_attendbriefing', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_approved_to_inspect', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('evppermit_ownerauthorization', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_ownerauthorization_date', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_result', ' ', 'trim|required');
	$this->form_validation->set_rules('evppermit_result_inspector_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('evppermit_inspection_date', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_managerverified_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('evppermit_managerverified_date', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_recent_evp_serialno', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_recent_evp_expirydate', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_completed_docs', ' ', 'trim');
	/*$this->form_validation->set_rules('evppermit_inspectionscheduled', ' ', 'trim');*/
	$this->form_validation->set_rules('evppermit_inspectionapproval', ' ', 'trim');
	$this->form_validation->set_rules('evppermit_lastchanged_by', ' ', 'trim|required|integer');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'evppermit_id',
		'evppermit_permit_id',
		'evppermit_vehicle_id',
		'evppermit_required_briefing',
		'evppermit_attendbriefing',
		'evppermit_approved_to_inspect',
		'evppermit_ownerauthorization',
		'evppermit_ownerauthorization_date',
		'evppermit_result',
		'evppermit_result_inspector_id',
		'evppermit_inspection_date',
		'evppermit_managerverified_id',
		'evppermit_managerverified_date',
		'evppermit_recent_evp_serialno',
		'evppermit_recent_evp_expirydate',
		'evppermit_completed_docs',
		/*'evppermit_inspectionscheduled',*/
		'evppermit_inspectionapproval',
		'evppermit_lastchanged_by',
		
      );
      $results = $this->evppermit_model->listajax(
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
              $rud .=  anchor(site_url('evppermit/read/'.fixzy_encoder($r['evppermit_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('evppermit/update/'.fixzy_encoder($r['evppermit_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('evppermit/delete/'.fixzy_encoder($r['evppermit_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['evppermit_permit_id'],
				$r['evppermit_vehicle_id'],
				$r['evppermit_required_briefing'],
				$r['evppermit_attendbriefing'],
				$r['evppermit_approved_to_inspect'],
				$r['evppermit_ownerauthorization'],
				$r['evppermit_ownerauthorization_date'],
				$r['evppermit_result'],
				$r['evppermit_result_inspector_id'],
				$r['evppermit_inspection_date'],
				$r['evppermit_managerverified_id'],
				$r['evppermit_managerverified_date'],
				$r['evppermit_recent_evp_serialno'],
				$r['evppermit_recent_evp_expirydate'],
				$r['evppermit_completed_docs'],
				/*$r['evppermit_inspectionscheduled'],*/
				$r['evppermit_inspectionapproval'],
				$r['evppermit_lastchanged_by'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->evppermit_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->evppermit_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Evppermit.php */
/* Location: ./application/controllers/Evppermit.php */