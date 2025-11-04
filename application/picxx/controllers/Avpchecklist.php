<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Avpchecklist extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('avpchecklist_model');
    $this->lang->load('avpchecklist_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$avpchecklist = $this->avpchecklist_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    /*'avpchecklist_data' => $avpchecklist,*/
    'permission' => $this->permission,
    );

    $this->content = 'avpchecklist/avpchecklist_list';
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
    $row = $this->avpchecklist_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'avpchecklist_group' => $row->avpchecklist_group,
		'avpchecklist_name' => $row->avpchecklist_name,
		'avpchecklist_desc' => $row->avpchecklist_desc,
		'avpchecklist_required' => $row->avpchecklist_required,
		'avpchecklist_checked' => $row->avpchecklist_checked,
		'avpchecklist_mtwchecked' => $row->avpchecklist_mtwchecked,
		'avpchecklist_permit_id' => $row->permit_bookingid_avpchecklist_permit_id,
		'avpchecklist_mtwchecklist_id' => $row->mtwchecklist_name_avpchecklist_mtwchecklist_id,
		
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

    $this->content = 'avpchecklist/avpchecklist_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('avpchecklist/avpchecklist_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpchecklist'));
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
        'action' => site_url('avpchecklist/create_action'),
        'avpchecklist_group' => set_value('avpchecklist_group'),
		'dropdown_avpchecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'avpchecklist_name' => set_value('avpchecklist_name'),
		'avpchecklist_desc' => set_value('avpchecklist_desc'),
		'avpchecklist_required' => set_value('avpchecklist_required'),
		'dropdown_avpchecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'avpchecklist_checked' => set_value('avpchecklist_checked'),
		'dropdown_avpchecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'avpchecklist_mtwchecked' => set_value('avpchecklist_mtwchecked'),
		'dropdown_avpchecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'avpchecklist_permit_id' => set_value('avpchecklist_permit_id'),
		'permit'=> $this->avpchecklist_model->get_all_permit(),
		'avpchecklist_mtwchecklist_id' => set_value('avpchecklist_mtwchecklist_id'),
		'mtwchecklist'=> $this->avpchecklist_model->get_all_mtwchecklist(),
		
);
    $this->content = 'avpchecklist/avpchecklist_form';
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
        'avpchecklist_group' => $this->input->post('avpchecklist_group',TRUE),
		'avpchecklist_name' => $this->input->post('avpchecklist_name',TRUE),
		'avpchecklist_desc' => $this->input->post('avpchecklist_desc',TRUE),
		'avpchecklist_required' => $this->input->post('avpchecklist_required',TRUE),
		'avpchecklist_checked' => $this->input->post('avpchecklist_checked',TRUE),
		'avpchecklist_mtwchecked' => $this->input->post('avpchecklist_mtwchecked',TRUE),
		'avpchecklist_permit_id' => $this->input->post('avpchecklist_permit_id',TRUE),
		'avpchecklist_mtwchecklist_id' => $this->input->post('avpchecklist_mtwchecklist_id',TRUE),
		'avpchecklist_created_at' => date('Y-m-d H:i:s'),
		 'avpchecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->avpchecklist_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('avpchecklist'));
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
    $row = $this->avpchecklist_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('avpchecklist/update_action'),
        'id' => $id,
        'avpchecklist_group' => set_value('avpchecklist_group', $row->avpchecklist_group),
		'dropdown_avpchecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'avpchecklist_name' => set_value('avpchecklist_name', $row->avpchecklist_name),
		'avpchecklist_desc' => set_value('avpchecklist_desc', $row->avpchecklist_desc),
		'avpchecklist_required' => set_value('avpchecklist_required', $row->avpchecklist_required),
		'dropdown_avpchecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'avpchecklist_checked' => set_value('avpchecklist_checked', $row->avpchecklist_checked),
		'dropdown_avpchecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'avpchecklist_mtwchecked' => set_value('avpchecklist_mtwchecked', $row->avpchecklist_mtwchecked),
		'dropdown_avpchecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'avpchecklist_permit_id' => set_value('avpchecklist_permit_id', $row->avpchecklist_permit_id),
		'permit'=> $this->avpchecklist_model->get_all_permit(),
		'avpchecklist_mtwchecklist_id' => set_value('avpchecklist_mtwchecklist_id', $row->avpchecklist_mtwchecklist_id),
		'mtwchecklist'=> $this->avpchecklist_model->get_all_mtwchecklist(),
		
      );
    $this->content = 'avpchecklist/avpchecklist_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('avpchecklist_id', TRUE));
    }
    else {
      $data = array(
        'avpchecklist_group' => $this->input->post('avpchecklist_group',TRUE),
		'avpchecklist_name' => $this->input->post('avpchecklist_name',TRUE),
		'avpchecklist_desc' => $this->input->post('avpchecklist_desc',TRUE),
		'avpchecklist_required' => $this->input->post('avpchecklist_required',TRUE),
		'avpchecklist_checked' => $this->input->post('avpchecklist_checked',TRUE),
		'avpchecklist_mtwchecked' => $this->input->post('avpchecklist_mtwchecked',TRUE),
		'avpchecklist_permit_id' => $this->input->post('avpchecklist_permit_id',TRUE),
		'avpchecklist_mtwchecklist_id' => $this->input->post('avpchecklist_mtwchecklist_id',TRUE),
		'avpchecklist_updated_at' => date('Y-m-d H:i:s'),
		 'avpchecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->avpchecklist_model->update(fixzy_decoder($this->input->post('avpchecklist_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('avpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->avpchecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->avpchecklist_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('avpchecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->avpchecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'avpchecklist_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->avpchecklist_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('avpchecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('avpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('avpchecklist_group', ' ', 'trim');
	$this->form_validation->set_rules('avpchecklist_name', ' ', 'trim|required');
	$this->form_validation->set_rules('avpchecklist_desc', ' ', 'trim');
	$this->form_validation->set_rules('avpchecklist_required', ' ', 'trim|required');
	$this->form_validation->set_rules('avpchecklist_checked', ' ', 'trim');
	$this->form_validation->set_rules('avpchecklist_mtwchecked', ' ', 'trim');
	$this->form_validation->set_rules('avpchecklist_permit_id', ' ', 'trim|integer');
	$this->form_validation->set_rules('avpchecklist_mtwchecklist_id', ' ', 'trim|integer');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'avpchecklist_id',
		'avpchecklist_group',
		'avpchecklist_name',
		'avpchecklist_desc',
		'avpchecklist_required',
		'avpchecklist_checked',
		'avpchecklist_mtwchecked',
		'avpchecklist_permit_id',
		'avpchecklist_mtwchecklist_id',
		
      );
      $results = $this->avpchecklist_model->listajax(
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
              $rud .=  anchor(site_url('avpchecklist/read/'.fixzy_encoder($r['avpchecklist_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('avpchecklist/update/'.fixzy_encoder($r['avpchecklist_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('avpchecklist/delete/'.fixzy_encoder($r['avpchecklist_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['avpchecklist_group'],
				$r['avpchecklist_name'],
				$r['avpchecklist_desc'],
				$r['avpchecklist_required'],
				$r['avpchecklist_checked'],
				$r['avpchecklist_mtwchecked'],
				$r['permit_bookingid_avpchecklist_permit_id'],
				$r['mtwchecklist_name_avpchecklist_mtwchecklist_id'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->avpchecklist_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->avpchecklist_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Avpchecklist.php */
/* Location: ./application/controllers/Avpchecklist.php */