<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Parkingarea extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('parkingarea_model');
    $this->lang->load('parkingarea_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    $parkingarea = $this->parkingarea_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    'parkingarea_data' => $parkingarea,
    'permission' => $this->permission,
    );

    $this->content = 'parkingarea/parkingarea_list';
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
    $row = $this->parkingarea_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'parkingarea_name' => $row->parkingarea_name,
		'parkingarea_desc' => $row->parkingarea_desc,
		'parkingarea_maps' => $row->parkingarea_maps,
		
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

    $this->content = 'parkingarea/parkingarea_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('parkingarea/parkingarea_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('parkingarea'));
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
        'action' => site_url('parkingarea/create_action'),
        'parkingarea_name' => set_value('parkingarea_name'),
		'parkingarea_desc' => set_value('parkingarea_desc'),
		'parkingarea_maps' => set_value('parkingarea_maps'),
		
);
    $this->content = 'parkingarea/parkingarea_form';
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
        'parkingarea_name' => $this->input->post('parkingarea_name',TRUE),
		'parkingarea_desc' => $this->input->post('parkingarea_desc',TRUE),
		'parkingarea_maps' => $this->input->post('parkingarea_maps',TRUE),
		'parkingarea_created_at' => date('Y-m-d H:i:s'),
		 'parkingarea_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->parkingarea_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('parkingarea'));
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
    $row = $this->parkingarea_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('parkingarea/update_action'),
        'id' => $id,
        'parkingarea_name' => set_value('parkingarea_name', $row->parkingarea_name),
		'parkingarea_desc' => set_value('parkingarea_desc', $row->parkingarea_desc),
		'parkingarea_maps' => set_value('parkingarea_maps', $row->parkingarea_maps),
		
      );
    $this->content = 'parkingarea/parkingarea_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('parkingarea'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('parkingarea_id', TRUE));
    }
    else {
      $data = array(
        'parkingarea_name' => $this->input->post('parkingarea_name',TRUE),
		'parkingarea_desc' => $this->input->post('parkingarea_desc',TRUE),
		'parkingarea_maps' => $this->input->post('parkingarea_maps',TRUE),
		'parkingarea_updated_at' => date('Y-m-d H:i:s'),
		 'parkingarea_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->parkingarea_model->update(fixzy_decoder($this->input->post('parkingarea_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('parkingarea'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->parkingarea_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->parkingarea_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('parkingarea'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('parkingarea'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->parkingarea_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'parkingarea_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->parkingarea_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('parkingarea'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('parkingarea'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('parkingarea_name', ' ', 'trim|required');
	$this->form_validation->set_rules('parkingarea_desc', ' ', 'trim');
	$this->form_validation->set_rules('parkingarea_maps', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'parkingarea_id',
		'parkingarea_name',
		'parkingarea_desc',
		'parkingarea_maps',
		
      );
      $results = $this->parkingarea_model->listajax(
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
              $rud .=  anchor(site_url('parkingarea/read/'.fixzy_encoder($r['parkingarea_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('parkingarea/update/'.fixzy_encoder($r['parkingarea_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('parkingarea/delete_update/'.fixzy_encoder($r['parkingarea_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['parkingarea_name'],
				$r['parkingarea_desc'],
				$r['parkingarea_maps'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->parkingarea_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->parkingarea_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Parkingarea.php */
/* Location: ./application/controllers/Parkingarea.php */