<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Evpchecklist extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('evpchecklist_model');
    $this->lang->load('evpchecklist_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$evpchecklist = $this->evpchecklist_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    /*'evpchecklist_data' => $evpchecklist,*/
    'permission' => $this->permission,
    );

    $this->content = 'evpchecklist/evpchecklist_list';
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
    $row = $this->evpchecklist_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'evpchecklist_group' => $row->evpchecklist_group,
		'evpchecklist_name' => $row->evpchecklist_name,
		'evpchecklist_desc' => $row->evpchecklist_desc,
		'evpchecklist_required' => $row->evpchecklist_required,
		'evpchecklist_checked' => $row->evpchecklist_checked,
		'evpchecklist_mtwchecked' => $row->evpchecklist_mtwchecked,
		'evpchecklist_permit_id' => $row->permit_bookingid_evpchecklist_permit_id,
		'evpchecklist_mtwchecklist_id' => $row->mtwchecklist_name_evpchecklist_mtwchecklist_id,
		
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

    $this->content = 'evpchecklist/evpchecklist_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('evpchecklist/evpchecklist_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evpchecklist'));
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
        'action' => site_url('evpchecklist/create_action'),
        'evpchecklist_group' => set_value('evpchecklist_group'),
		'dropdown_evpchecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'evpchecklist_name' => set_value('evpchecklist_name'),
		'evpchecklist_desc' => set_value('evpchecklist_desc'),
		'evpchecklist_required' => set_value('evpchecklist_required'),
		'dropdown_evpchecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'evpchecklist_checked' => set_value('evpchecklist_checked'),
		'dropdown_evpchecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'evpchecklist_mtwchecked' => set_value('evpchecklist_mtwchecked'),
		'dropdown_evpchecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'evpchecklist_permit_id' => set_value('evpchecklist_permit_id'),
		'permit'=> $this->evpchecklist_model->get_all_permit(),
		'evpchecklist_mtwchecklist_id' => set_value('evpchecklist_mtwchecklist_id'),
		'mtwchecklist'=> $this->evpchecklist_model->get_all_mtwchecklist(),
		
);
    $this->content = 'evpchecklist/evpchecklist_form';
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
        'evpchecklist_group' => $this->input->post('evpchecklist_group',TRUE),
		'evpchecklist_name' => $this->input->post('evpchecklist_name',TRUE),
		'evpchecklist_desc' => $this->input->post('evpchecklist_desc',TRUE),
		'evpchecklist_required' => $this->input->post('evpchecklist_required',TRUE),
		'evpchecklist_checked' => $this->input->post('evpchecklist_checked',TRUE),
		'evpchecklist_mtwchecked' => $this->input->post('evpchecklist_mtwchecked',TRUE),
		'evpchecklist_permit_id' => $this->input->post('evpchecklist_permit_id',TRUE),
		'evpchecklist_mtwchecklist_id' => $this->input->post('evpchecklist_mtwchecklist_id',TRUE),
		'evpchecklist_created_at' => date('Y-m-d H:i:s'),
		 'evpchecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->evpchecklist_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('evpchecklist'));
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
    $row = $this->evpchecklist_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('evpchecklist/update_action'),
        'id' => $id,
        'evpchecklist_group' => set_value('evpchecklist_group', $row->evpchecklist_group),
		'dropdown_evpchecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'evpchecklist_name' => set_value('evpchecklist_name', $row->evpchecklist_name),
		'evpchecklist_desc' => set_value('evpchecklist_desc', $row->evpchecklist_desc),
		'evpchecklist_required' => set_value('evpchecklist_required', $row->evpchecklist_required),
		'dropdown_evpchecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'evpchecklist_checked' => set_value('evpchecklist_checked', $row->evpchecklist_checked),
		'dropdown_evpchecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'evpchecklist_mtwchecked' => set_value('evpchecklist_mtwchecked', $row->evpchecklist_mtwchecked),
		'dropdown_evpchecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'evpchecklist_permit_id' => set_value('evpchecklist_permit_id', $row->evpchecklist_permit_id),
		'permit'=> $this->evpchecklist_model->get_all_permit(),
		'evpchecklist_mtwchecklist_id' => set_value('evpchecklist_mtwchecklist_id', $row->evpchecklist_mtwchecklist_id),
		'mtwchecklist'=> $this->evpchecklist_model->get_all_mtwchecklist(),
		
      );
    $this->content = 'evpchecklist/evpchecklist_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('evpchecklist_id', TRUE));
    }
    else {
      $data = array(
        'evpchecklist_group' => $this->input->post('evpchecklist_group',TRUE),
		'evpchecklist_name' => $this->input->post('evpchecklist_name',TRUE),
		'evpchecklist_desc' => $this->input->post('evpchecklist_desc',TRUE),
		'evpchecklist_required' => $this->input->post('evpchecklist_required',TRUE),
		'evpchecklist_checked' => $this->input->post('evpchecklist_checked',TRUE),
		'evpchecklist_mtwchecked' => $this->input->post('evpchecklist_mtwchecked',TRUE),
		'evpchecklist_permit_id' => $this->input->post('evpchecklist_permit_id',TRUE),
		'evpchecklist_mtwchecklist_id' => $this->input->post('evpchecklist_mtwchecklist_id',TRUE),
		'evpchecklist_updated_at' => date('Y-m-d H:i:s'),
		 'evpchecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->evpchecklist_model->update(fixzy_decoder($this->input->post('evpchecklist_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('evpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->evpchecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->evpchecklist_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('evpchecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->evpchecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'evpchecklist_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->evpchecklist_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('evpchecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('evpchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('evpchecklist_group', ' ', 'trim');
	$this->form_validation->set_rules('evpchecklist_name', ' ', 'trim|required');
	$this->form_validation->set_rules('evpchecklist_desc', ' ', 'trim');
	$this->form_validation->set_rules('evpchecklist_required', ' ', 'trim|required');
	$this->form_validation->set_rules('evpchecklist_checked', ' ', 'trim');
	$this->form_validation->set_rules('evpchecklist_mtwchecked', ' ', 'trim');
	$this->form_validation->set_rules('evpchecklist_permit_id', ' ', 'trim|integer');
	$this->form_validation->set_rules('evpchecklist_mtwchecklist_id', ' ', 'trim|integer');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'evpchecklist_id',
		'evpchecklist_group',
		'evpchecklist_name',
		'evpchecklist_desc',
		'evpchecklist_required',
		'evpchecklist_checked',
		'evpchecklist_mtwchecked',
		'evpchecklist_permit_id',
		'evpchecklist_mtwchecklist_id',
		
      );
      $results = $this->evpchecklist_model->listajax(
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
              $rud .=  anchor(site_url('evpchecklist/read/'.fixzy_encoder($r['evpchecklist_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('evpchecklist/update/'.fixzy_encoder($r['evpchecklist_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('evpchecklist/delete/'.fixzy_encoder($r['evpchecklist_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['evpchecklist_group'],
				$r['evpchecklist_name'],
				$r['evpchecklist_desc'],
				$r['evpchecklist_required'],
				$r['evpchecklist_checked'],
				$r['evpchecklist_mtwchecked'],
				$r['permit_bookingid_evpchecklist_permit_id'],
				$r['mtwchecklist_name_evpchecklist_mtwchecklist_id'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->evpchecklist_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->evpchecklist_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Evpchecklist.php */
/* Location: ./application/controllers/Evpchecklist.php */