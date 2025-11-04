<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Examonlymanagement extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('examonlymanagement_model');
    $this->lang->load('examonlymanagement_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    $examonlymanagement = $this->examonlymanagement_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    'examonlymanagement_data' => $examonlymanagement,
    'permission' => $this->permission,
    );

    $this->content = 'examonlymanagement/examonlymanagement_list';
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
    $row = $this->examonlymanagement_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'examonlymanagement_date' => $row->examonlymanagement_date,
		'examonlymanagement_slot' => $row->examonlymanagement_slot,
		'examonlymanagement_slottaken' => $row->examonlymanagement_slottaken,
		'examonlymanagement_location' => $row->examonlymanagement_location,
		'examonlymanagement_officer_pic' => $row->user_name_examonlymanagement_officer_pic,
		'examonlymanagement_remark' => $row->examonlymanagement_remark,
		'examonlymanagement_session' => $row->examonlymanagement_session,
		'examonlymanagement_classtype' => $row->examonlymanagement_classtype,
		
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

    $this->content = 'examonlymanagement/examonlymanagement_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('examonlymanagement/examonlymanagement_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examonlymanagement'));
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
        'action' => site_url('examonlymanagement/create_action'),
        'examonlymanagement_date' => set_value('examonlymanagement_date'),
		'examonlymanagement_slot' => set_value('examonlymanagement_slot'),
		'examonlymanagement_slottaken' => set_value('examonlymanagement_slottaken'),
		'examonlymanagement_location' => set_value('examonlymanagement_location'),
		'examonlymanagement_officer_pic' => set_value('examonlymanagement_officer_pic'),
		'userlist'=> $this->examonlymanagement_model->get_all_userlist(),
		'examonlymanagement_remark' => set_value('examonlymanagement_remark'),
		'examonlymanagement_session' => set_value('examonlymanagement_session'),
		'dropdown_examonlymanagement_session' =>  array(
(object)array('id'=>'m','value'=>'Morning'),(object)array('id'=>'a','value'=>'Afternoon'),
),
		'examonlymanagement_classtype' => set_value('examonlymanagement_classtype'),
		'dropdown_examonlymanagement_classtype' =>  array(
(object)array('id'=>'A','value'=>'A'),(object)array('id'=>'B1','value'=>'B1'),(object)array('id'=>'B2','value'=>'B2'),(object)array('id'=>'C','value'=>'C'),
),
		
);
    $this->content = 'examonlymanagement/examonlymanagement_form';
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
        'examonlymanagement_date' => $this->input->post('examonlymanagement_date',TRUE),
		'examonlymanagement_slot' => $this->input->post('examonlymanagement_slot',TRUE),
		'examonlymanagement_slottaken' => $this->input->post('examonlymanagement_slottaken',TRUE),
		'examonlymanagement_location' => $this->input->post('examonlymanagement_location',TRUE),
		'examonlymanagement_officer_pic' => $this->input->post('examonlymanagement_officer_pic',TRUE),
		'examonlymanagement_remark' => $this->input->post('examonlymanagement_remark',TRUE),
		'examonlymanagement_session' => $this->input->post('examonlymanagement_session',TRUE),
		'examonlymanagement_classtype' => $this->input->post('examonlymanagement_classtype',TRUE),
		'examonlymanagement_created_at' => date('Y-m-d H:i:s'),
		 'examonlymanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->examonlymanagement_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('examonlymanagement'));
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
    $row = $this->examonlymanagement_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('examonlymanagement/update_action'),
        'id' => $id,
        'examonlymanagement_date' => set_value('examonlymanagement_date', $row->examonlymanagement_date),
		'examonlymanagement_slot' => set_value('examonlymanagement_slot', $row->examonlymanagement_slot),
		'examonlymanagement_slottaken' => set_value('examonlymanagement_slottaken', $row->examonlymanagement_slottaken),
		'examonlymanagement_location' => set_value('examonlymanagement_location', $row->examonlymanagement_location),
		'examonlymanagement_officer_pic' => set_value('examonlymanagement_officer_pic', $row->examonlymanagement_officer_pic),
		'userlist'=> $this->examonlymanagement_model->get_all_userlist(),
		'examonlymanagement_remark' => set_value('examonlymanagement_remark', $row->examonlymanagement_remark),
		'examonlymanagement_session' => set_value('examonlymanagement_session', $row->examonlymanagement_session),
		'dropdown_examonlymanagement_session' =>  array(
(object)array('id'=>'m','value'=>'Morning'),(object)array('id'=>'a','value'=>'Afternoon'),
),
		'examonlymanagement_classtype' => set_value('examonlymanagement_classtype', $row->examonlymanagement_classtype),
		'dropdown_examonlymanagement_classtype' =>  array(
(object)array('id'=>'A','value'=>'A'),(object)array('id'=>'B1','value'=>'B1'),(object)array('id'=>'B2','value'=>'B2'),(object)array('id'=>'C','value'=>'C'),
),
		
      );
    $this->content = 'examonlymanagement/examonlymanagement_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examonlymanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('examonlymanagement_id', TRUE));
    }
    else {
      $data = array(
        'examonlymanagement_date' => $this->input->post('examonlymanagement_date',TRUE),
		'examonlymanagement_slot' => $this->input->post('examonlymanagement_slot',TRUE),
		'examonlymanagement_slottaken' => $this->input->post('examonlymanagement_slottaken',TRUE),
		'examonlymanagement_location' => $this->input->post('examonlymanagement_location',TRUE),
		'examonlymanagement_officer_pic' => $this->input->post('examonlymanagement_officer_pic',TRUE),
		'examonlymanagement_remark' => $this->input->post('examonlymanagement_remark',TRUE),
		'examonlymanagement_session' => $this->input->post('examonlymanagement_session',TRUE),
		'examonlymanagement_classtype' => $this->input->post('examonlymanagement_classtype',TRUE),
		'examonlymanagement_updated_at' => date('Y-m-d H:i:s'),
		 'examonlymanagement_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->examonlymanagement_model->update(fixzy_decoder($this->input->post('examonlymanagement_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('examonlymanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->examonlymanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->examonlymanagement_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('examonlymanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examonlymanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->examonlymanagement_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'examonlymanagement_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->examonlymanagement_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('examonlymanagement'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examonlymanagement'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('examonlymanagement_date', ' ', 'trim');
	$this->form_validation->set_rules('examonlymanagement_slot', ' ', 'trim|integer');
	$this->form_validation->set_rules('examonlymanagement_slottaken', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('examonlymanagement_location', ' ', 'trim');
	$this->form_validation->set_rules('examonlymanagement_officer_pic', ' ', 'trim|integer');
	$this->form_validation->set_rules('examonlymanagement_remark', ' ', 'trim');
	$this->form_validation->set_rules('examonlymanagement_session', ' ', 'trim');
	$this->form_validation->set_rules('examonlymanagement_classtype', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'examonlymanagement_id',
		'examonlymanagement_date',
		'examonlymanagement_slot',
		'examonlymanagement_slottaken',
		'examonlymanagement_location',
		'examonlymanagement_officer_pic',
		'examonlymanagement_remark',
		'examonlymanagement_session',
		'examonlymanagement_classtype',
		
      );
      $results = $this->examonlymanagement_model->listajax(
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
              $rud .=  anchor(site_url('examonlymanagement/read/'.fixzy_encoder($r['examonlymanagement_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('examonlymanagement/update/'.fixzy_encoder($r['examonlymanagement_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('examonlymanagement/delete/'.fixzy_encoder($r['examonlymanagement_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['examonlymanagement_date'],
				$r['examonlymanagement_slot'],
				$r['examonlymanagement_slottaken'],
				$r['examonlymanagement_location'],
				$r['user_name_examonlymanagement_officer_pic'],
				$r['examonlymanagement_remark'],
				$r['examonlymanagement_session'],
				$r['examonlymanagement_classtype'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->examonlymanagement_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->examonlymanagement_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Examonlymanagement.php */
/* Location: ./application/controllers/Examonlymanagement.php */