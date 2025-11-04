<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Permittype extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('permittype_model');
    $this->lang->load('permittype_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    $permittype = $this->permittype_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    'permittype_data' => $permittype,
    'permission' => $this->permission,
    );

    $this->content = 'permittype/permittype_list';
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
    $row = $this->permittype_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'permit_type_name' => $row->permit_type_name,
		'permit_type_desc' => $row->permit_type_desc,
		
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

    $this->content = 'permittype/permittype_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('permittype/permittype_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('permittype'));
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
        'action' => site_url('permittype/create_action'),
        'permit_type_name' => set_value('permit_type_name'),
		'permit_type_desc' => set_value('permit_type_desc'),
		
);
    $this->content = 'permittype/permittype_form';
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
        'permit_type_name' => $this->input->post('permit_type_name',TRUE),
		'permit_type_desc' => $this->input->post('permit_type_desc',TRUE),
		'permit_type_created_at' => date('Y-m-d H:i:s'),
		 'permit_type_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->permittype_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('permittype'));
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
    $row = $this->permittype_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('permittype/update_action'),
        'id' => $id,
        'permit_type_name' => set_value('permit_type_name', $row->permit_type_name),
		'permit_type_desc' => set_value('permit_type_desc', $row->permit_type_desc),
		
      );
    $this->content = 'permittype/permittype_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('permittype'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('permit_type_id', TRUE));
    }
    else {
      $data = array(
        'permit_type_name' => $this->input->post('permit_type_name',TRUE),
		'permit_type_desc' => $this->input->post('permit_type_desc',TRUE),
		'permit_type_updated_at' => date('Y-m-d H:i:s'),
		 'permit_type_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->permittype_model->update(fixzy_decoder($this->input->post('permit_type_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('permittype'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->permittype_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->permittype_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('permittype'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('permittype'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->permittype_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'permit_type_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->permittype_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('permittype'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('permittype'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('permit_type_name', ' ', 'trim');
	$this->form_validation->set_rules('permit_type_desc', ' ', 'trim');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'permit_type_id',
		'permit_type_name',
		'permit_type_desc',
		
      );
      $results = $this->permittype_model->listajax(
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
              $rud .=  anchor(site_url('permittype/read/'.fixzy_encoder($r['permit_type_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }*/
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('permittype/update/'.fixzy_encoder($r['permit_type_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
/*                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('permittype/delete_update/'.fixzy_encoder($r['permit_type_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }*/
            array_push($data, array(
                $i,
                $r['permit_type_name'],
				$r['permit_type_desc'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->permittype_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->permittype_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Permittype.php */
/* Location: ./application/controllers/Permittype.php */