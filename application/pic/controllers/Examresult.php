<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Examresult extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('examresult_model');
    $this->lang->load('examresult_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$examresult = $this->examresult_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'examresult_data' => $examresult,
    'permission' => $this->permission,
    );

    $this->content = 'examresult/examresult_list';
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
    $row = $this->examresult_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'examresult_adppermit_id' => $row->examresult_adppermit_id,
		'examresult_examtaker_id' => $row->examresult_examtaker_id,
		'examresult_examquestion_id' => $row->examresult_examquestion_id,
		'examresult_result' => $row->examresult_result,
		'examresult_answer' => $row->examresult_answer,
		'examresult_created_at' => $row->examresult_created_at,
		'examresult_updated_at' => $row->examresult_updated_at,
		'examresult_deleted_at' => $row->examresult_deleted_at,
		'examresult_lastchanged_by' => $row->examresult_lastchanged_by,
		
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

    $this->content = 'examresult/examresult_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('examresult/examresult_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examresult'));
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
        'action' => site_url('examresult/create_action'),
        'examresult_adppermit_id' => set_value('examresult_adppermit_id'),
		'examresult_examtaker_id' => set_value('examresult_examtaker_id'),
		'examresult_examquestion_id' => set_value('examresult_examquestion_id'),
		'examresult_result' => set_value('examresult_result'),
		'examresult_answer' => set_value('examresult_answer'),
		'examresult_created_at' => set_value('examresult_created_at'),
		'examresult_updated_at' => set_value('examresult_updated_at'),
		'examresult_deleted_at' => set_value('examresult_deleted_at'),
		'examresult_lastchanged_by' => set_value('examresult_lastchanged_by'),
		
);
    $this->content = 'examresult/examresult_form';
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
        'examresult_adppermit_id' => $this->input->post('examresult_adppermit_id',TRUE),
		'examresult_examtaker_id' => $this->input->post('examresult_examtaker_id',TRUE),
		'examresult_examquestion_id' => $this->input->post('examresult_examquestion_id',TRUE),
		'examresult_result' => $this->input->post('examresult_result',TRUE),
		'examresult_answer' => $this->input->post('examresult_answer',TRUE),
		'examresult_created_at' => $this->input->post('examresult_created_at',TRUE),
		'examresult_updated_at' => $this->input->post('examresult_updated_at',TRUE),
		'examresult_deleted_at' => $this->input->post('examresult_deleted_at',TRUE),
		'examresult_lastchanged_by' => $this->input->post('examresult_lastchanged_by',TRUE),
		'examresult_created_at' => date('Y-m-d H:i:s'),
		 'examresult_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->examresult_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('examresult'));
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
    $row = $this->examresult_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('examresult/update_action'),
        'id' => $id,
        'examresult_adppermit_id' => set_value('examresult_adppermit_id', $row->examresult_adppermit_id),
		'examresult_examtaker_id' => set_value('examresult_examtaker_id', $row->examresult_examtaker_id),
		'examresult_examquestion_id' => set_value('examresult_examquestion_id', $row->examresult_examquestion_id),
		'examresult_result' => set_value('examresult_result', $row->examresult_result),
		'examresult_answer' => set_value('examresult_answer', $row->examresult_answer),
		'examresult_created_at' => set_value('examresult_created_at', $row->examresult_created_at),
		'examresult_updated_at' => set_value('examresult_updated_at', $row->examresult_updated_at),
		'examresult_deleted_at' => set_value('examresult_deleted_at', $row->examresult_deleted_at),
		'examresult_lastchanged_by' => set_value('examresult_lastchanged_by', $row->examresult_lastchanged_by),
		
      );
    $this->content = 'examresult/examresult_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examresult'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('examresult_id', TRUE));
    }
    else {
      $data = array(
        'examresult_adppermit_id' => $this->input->post('examresult_adppermit_id',TRUE),
		'examresult_examtaker_id' => $this->input->post('examresult_examtaker_id',TRUE),
		'examresult_examquestion_id' => $this->input->post('examresult_examquestion_id',TRUE),
		'examresult_result' => $this->input->post('examresult_result',TRUE),
		'examresult_answer' => $this->input->post('examresult_answer',TRUE),
		'examresult_created_at' => $this->input->post('examresult_created_at',TRUE),
		'examresult_updated_at' => $this->input->post('examresult_updated_at',TRUE),
		'examresult_deleted_at' => $this->input->post('examresult_deleted_at',TRUE),
		'examresult_lastchanged_by' => $this->input->post('examresult_lastchanged_by',TRUE),
		'examresult_updated_at' => date('Y-m-d H:i:s'),
		 'examresult_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->examresult_model->update(fixzy_decoder($this->input->post('examresult_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('examresult'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->examresult_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->examresult_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('examresult'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examresult'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->examresult_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'examresult_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->examresult_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('examresult'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('examresult'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('examresult_adppermit_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('examresult_examtaker_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('examresult_examquestion_id', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('examresult_result', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('examresult_answer', ' ', 'trim|required|integer');
	$this->form_validation->set_rules('examresult_created_at', ' ', 'trim|required');
	$this->form_validation->set_rules('examresult_updated_at', ' ', 'trim');
	$this->form_validation->set_rules('examresult_deleted_at', ' ', 'trim');
	$this->form_validation->set_rules('examresult_lastchanged_by', ' ', 'trim|required|integer');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'examresult_id',
		'examresult_adppermit_id',
		'examresult_examtaker_id',
		'examresult_examquestion_id',
		'examresult_result',
		'examresult_answer',
		'examresult_created_at',
		'examresult_updated_at',
		'examresult_deleted_at',
		'examresult_lastchanged_by',
		
      );
      $results = $this->examresult_model->listajax(
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
              $rud .=  anchor(site_url('examresult/read/'.fixzy_encoder($r['examresult_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('examresult/update/'.fixzy_encoder($r['examresult_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('examresult/delete/'.fixzy_encoder($r['examresult_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['examresult_adppermit_id'],
				$r['examresult_examtaker_id'],
				$r['examresult_examquestion_id'],
				$r['examresult_result'],
				$r['examresult_answer'],
				$r['examresult_created_at'],
				$r['examresult_updated_at'],
				$r['examresult_deleted_at'],
				$r['examresult_lastchanged_by'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->examresult_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->examresult_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Examresult.php */
/* Location: ./application/controllers/Examresult.php */