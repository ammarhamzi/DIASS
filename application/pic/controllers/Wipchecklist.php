<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Wipchecklist extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('wipchecklist_model');
    $this->lang->load('wipchecklist_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$wipchecklist = $this->wipchecklist_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'wipchecklist_data' => $wipchecklist,
    'permission' => $this->permission,
    );

    $this->content = 'wipchecklist/wipchecklist_list';
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
    $row = $this->wipchecklist_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'wipchecklist_group' => $row->wipchecklist_group,
		'wipchecklist_name' => $row->wipchecklist_name,
		'wipchecklist_desc' => $row->wipchecklist_desc,
		'wipchecklist_required' => $row->wipchecklist_required,
		'wipchecklist_checked' => $row->wipchecklist_checked,
		'wipchecklist_mtwchecked' => $row->wipchecklist_mtwchecked,
		'wipchecklist_permit_id' => $row->permit_bookingid_wipchecklist_permit_id,
		'wipchecklist_mtwchecklist_id' => $row->mtwchecklist_name_wipchecklist_mtwchecklist_id,
		
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

    $this->content = 'wipchecklist/wipchecklist_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('wipchecklist/wipchecklist_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wipchecklist'));
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
        'action' => site_url('wipchecklist/create_action'),
        'wipchecklist_group' => set_value('wipchecklist_group'),
		'dropdown_wipchecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'wipchecklist_name' => set_value('wipchecklist_name'),
		'wipchecklist_desc' => set_value('wipchecklist_desc'),
		'wipchecklist_required' => set_value('wipchecklist_required'),
		'dropdown_wipchecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'wipchecklist_checked' => set_value('wipchecklist_checked'),
		'dropdown_wipchecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'wipchecklist_mtwchecked' => set_value('wipchecklist_mtwchecked'),
		'dropdown_wipchecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'wipchecklist_permit_id' => set_value('wipchecklist_permit_id'),
		'permit'=> $this->wipchecklist_model->get_all_permit(),
		'wipchecklist_mtwchecklist_id' => set_value('wipchecklist_mtwchecklist_id'),
		'mtwchecklist'=> $this->wipchecklist_model->get_all_mtwchecklist(),
		
);
    $this->content = 'wipchecklist/wipchecklist_form';
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
        'wipchecklist_group' => $this->input->post('wipchecklist_group',TRUE),
		'wipchecklist_name' => $this->input->post('wipchecklist_name',TRUE),
		'wipchecklist_desc' => $this->input->post('wipchecklist_desc',TRUE),
		'wipchecklist_required' => $this->input->post('wipchecklist_required',TRUE),
		'wipchecklist_checked' => $this->input->post('wipchecklist_checked',TRUE),
		'wipchecklist_mtwchecked' => $this->input->post('wipchecklist_mtwchecked',TRUE),
		'wipchecklist_permit_id' => $this->input->post('wipchecklist_permit_id',TRUE),
		'wipchecklist_mtwchecklist_id' => $this->input->post('wipchecklist_mtwchecklist_id',TRUE),
		'wipchecklist_created_at' => date('Y-m-d H:i:s'),
		 'wipchecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->wipchecklist_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('wipchecklist'));
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
    $row = $this->wipchecklist_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('wipchecklist/update_action'),
        'id' => $id,
        'wipchecklist_group' => set_value('wipchecklist_group', $row->wipchecklist_group),
		'dropdown_wipchecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'wipchecklist_name' => set_value('wipchecklist_name', $row->wipchecklist_name),
		'wipchecklist_desc' => set_value('wipchecklist_desc', $row->wipchecklist_desc),
		'wipchecklist_required' => set_value('wipchecklist_required', $row->wipchecklist_required),
		'dropdown_wipchecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'wipchecklist_checked' => set_value('wipchecklist_checked', $row->wipchecklist_checked),
		'dropdown_wipchecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'wipchecklist_mtwchecked' => set_value('wipchecklist_mtwchecked', $row->wipchecklist_mtwchecked),
		'dropdown_wipchecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'wipchecklist_permit_id' => set_value('wipchecklist_permit_id', $row->wipchecklist_permit_id),
		'permit'=> $this->wipchecklist_model->get_all_permit(),
		'wipchecklist_mtwchecklist_id' => set_value('wipchecklist_mtwchecklist_id', $row->wipchecklist_mtwchecklist_id),
		'mtwchecklist'=> $this->wipchecklist_model->get_all_mtwchecklist(),
		
      );
    $this->content = 'wipchecklist/wipchecklist_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wipchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('wipchecklist_id', TRUE));
    }
    else {
      $data = array(
        'wipchecklist_group' => $this->input->post('wipchecklist_group',TRUE),
		'wipchecklist_name' => $this->input->post('wipchecklist_name',TRUE),
		'wipchecklist_desc' => $this->input->post('wipchecklist_desc',TRUE),
		'wipchecklist_required' => $this->input->post('wipchecklist_required',TRUE),
		'wipchecklist_checked' => $this->input->post('wipchecklist_checked',TRUE),
		'wipchecklist_mtwchecked' => $this->input->post('wipchecklist_mtwchecked',TRUE),
		'wipchecklist_permit_id' => $this->input->post('wipchecklist_permit_id',TRUE),
		'wipchecklist_mtwchecklist_id' => $this->input->post('wipchecklist_mtwchecklist_id',TRUE),
		'wipchecklist_updated_at' => date('Y-m-d H:i:s'),
		 'wipchecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->wipchecklist_model->update(fixzy_decoder($this->input->post('wipchecklist_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('wipchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->wipchecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->wipchecklist_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('wipchecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wipchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->wipchecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'wipchecklist_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->wipchecklist_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('wipchecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wipchecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('wipchecklist_group', ' ', 'trim');
	$this->form_validation->set_rules('wipchecklist_name', ' ', 'trim|required');
	$this->form_validation->set_rules('wipchecklist_desc', ' ', 'trim');
	$this->form_validation->set_rules('wipchecklist_required', ' ', 'trim|required');
	$this->form_validation->set_rules('wipchecklist_checked', ' ', 'trim');
	$this->form_validation->set_rules('wipchecklist_mtwchecked', ' ', 'trim');
	$this->form_validation->set_rules('wipchecklist_permit_id', ' ', 'trim|integer');
	$this->form_validation->set_rules('wipchecklist_mtwchecklist_id', ' ', 'trim|integer');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'wipchecklist_id',
		'wipchecklist_group',
		'wipchecklist_name',
		'wipchecklist_desc',
		'wipchecklist_required',
		'wipchecklist_checked',
		'wipchecklist_mtwchecked',
		'wipchecklist_permit_id',
		'wipchecklist_mtwchecklist_id',
		
      );
      $results = $this->wipchecklist_model->listajax(
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
              $rud .=  anchor(site_url('wipchecklist/read/'.fixzy_encoder($r['wipchecklist_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('wipchecklist/update/'.fixzy_encoder($r['wipchecklist_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('wipchecklist/delete/'.fixzy_encoder($r['wipchecklist_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['wipchecklist_group'],
				$r['wipchecklist_name'],
				$r['wipchecklist_desc'],
				$r['wipchecklist_required'],
				$r['wipchecklist_checked'],
				$r['wipchecklist_mtwchecked'],
				$r['permit_bookingid_wipchecklist_permit_id'],
				$r['mtwchecklist_name_wipchecklist_mtwchecklist_id'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->wipchecklist_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->wipchecklist_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Wipchecklist.php */
/* Location: ./application/controllers/Wipchecklist.php */