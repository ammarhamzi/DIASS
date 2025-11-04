<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Shinschecklist extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('shinschecklist_model');
    $this->lang->load('shinschecklist_lang', $this->session->userdata('language'));
    
  }

  public function index() {

    if($this->permission->showlist == true){

    $setting = array(
    'method'=>'newpage',
    'patern'=>'list',
    );
    //$shinschecklist = $this->shinschecklist_model->get_all();
    /* $this->logQueries($this->config->item('dblog')); */
    $data = array(
    //'shinschecklist_data' => $shinschecklist,
    'permission' => $this->permission,
    );

    $this->content = 'shinschecklist/shinschecklist_list';
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
    $row = $this->shinschecklist_model->get_read($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'shinschecklist_group' => $row->shinschecklist_group,
		'shinschecklist_name' => $row->shinschecklist_name,
		'shinschecklist_desc' => $row->shinschecklist_desc,
		'shinschecklist_required' => $row->shinschecklist_required,
		'shinschecklist_checked' => $row->shinschecklist_checked,
		'shinschecklist_mtwchecked' => $row->shinschecklist_mtwchecked,
		'shinschecklist_permit_id' => $row->permit_bookingid_shinschecklist_permit_id,
		'shinschecklist_mtwchecklist_id' => $row->mtwchecklist_name_shinschecklist_mtwchecklist_id,
		
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

    $this->content = 'shinschecklist/shinschecklist_read';
    ##--slave_combine_to_read--##
    $this->layout($data, $setting);
}else{
    echo $this->load->view('shinschecklist/shinschecklist_read_raw', $data, TRUE);
}

    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinschecklist'));
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
        'action' => site_url('shinschecklist/create_action'),
        'shinschecklist_group' => set_value('shinschecklist_group'),
		'dropdown_shinschecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'shinschecklist_name' => set_value('shinschecklist_name'),
		'shinschecklist_desc' => set_value('shinschecklist_desc'),
		'shinschecklist_required' => set_value('shinschecklist_required'),
		'dropdown_shinschecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'shinschecklist_checked' => set_value('shinschecklist_checked'),
		'dropdown_shinschecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'shinschecklist_mtwchecked' => set_value('shinschecklist_mtwchecked'),
		'dropdown_shinschecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'shinschecklist_permit_id' => set_value('shinschecklist_permit_id'),
		'permit'=> $this->shinschecklist_model->get_all_permit(),
		'shinschecklist_mtwchecklist_id' => set_value('shinschecklist_mtwchecklist_id'),
		'mtwchecklist'=> $this->shinschecklist_model->get_all_mtwchecklist(),
		
);
    $this->content = 'shinschecklist/shinschecklist_form';
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
        'shinschecklist_group' => $this->input->post('shinschecklist_group',TRUE),
		'shinschecklist_name' => $this->input->post('shinschecklist_name',TRUE),
		'shinschecklist_desc' => $this->input->post('shinschecklist_desc',TRUE),
		'shinschecklist_required' => $this->input->post('shinschecklist_required',TRUE),
		'shinschecklist_checked' => $this->input->post('shinschecklist_checked',TRUE),
		'shinschecklist_mtwchecked' => $this->input->post('shinschecklist_mtwchecked',TRUE),
		'shinschecklist_permit_id' => $this->input->post('shinschecklist_permit_id',TRUE),
		'shinschecklist_mtwchecklist_id' => $this->input->post('shinschecklist_mtwchecklist_id',TRUE),
		'shinschecklist_created_at' => date('Y-m-d H:i:s'),
		 'shinschecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->shinschecklist_model->insert($data);
      $primary_id = $this->db->insert_id();
      /* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('shinschecklist'));
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
    $row = $this->shinschecklist_model->get_by_id(fixzy_decoder($id));
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'button' => $this->lang->line('edit'),
        'action' => site_url('shinschecklist/update_action'),
        'id' => $id,
        'shinschecklist_group' => set_value('shinschecklist_group', $row->shinschecklist_group),
		'dropdown_shinschecklist_group' =>  array(
(object)array('id'=>'g','value'=>'General'),(object)array('id'=>'a','value'=>'Additional'),(object)array('id'=>'s','value'=>'Special'),
),
		'shinschecklist_name' => set_value('shinschecklist_name', $row->shinschecklist_name),
		'shinschecklist_desc' => set_value('shinschecklist_desc', $row->shinschecklist_desc),
		'shinschecklist_required' => set_value('shinschecklist_required', $row->shinschecklist_required),
		'dropdown_shinschecklist_required' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'shinschecklist_checked' => set_value('shinschecklist_checked', $row->shinschecklist_checked),
		'dropdown_shinschecklist_checked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'shinschecklist_mtwchecked' => set_value('shinschecklist_mtwchecked', $row->shinschecklist_mtwchecked),
		'dropdown_shinschecklist_mtwchecked' =>  array(
(object)array('id'=>'y','value'=>'Yes'),(object)array('id'=>'n','value'=>'No'),
),
		'shinschecklist_permit_id' => set_value('shinschecklist_permit_id', $row->shinschecklist_permit_id),
		'permit'=> $this->shinschecklist_model->get_all_permit(),
		'shinschecklist_mtwchecklist_id' => set_value('shinschecklist_mtwchecklist_id', $row->shinschecklist_mtwchecklist_id),
		'mtwchecklist'=> $this->shinschecklist_model->get_all_mtwchecklist(),
		
      );
    $this->content = 'shinschecklist/shinschecklist_form';
    ##--slave_combine_to_update--##
    $this->layout($data, $setting);
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinschecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function update_action() {

   if($this->permission->cp_update == true){

    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('shinschecklist_id', TRUE));
    }
    else {
      $data = array(
        'shinschecklist_group' => $this->input->post('shinschecklist_group',TRUE),
		'shinschecklist_name' => $this->input->post('shinschecklist_name',TRUE),
		'shinschecklist_desc' => $this->input->post('shinschecklist_desc',TRUE),
		'shinschecklist_required' => $this->input->post('shinschecklist_required',TRUE),
		'shinschecklist_checked' => $this->input->post('shinschecklist_checked',TRUE),
		'shinschecklist_mtwchecked' => $this->input->post('shinschecklist_mtwchecked',TRUE),
		'shinschecklist_permit_id' => $this->input->post('shinschecklist_permit_id',TRUE),
		'shinschecklist_mtwchecklist_id' => $this->input->post('shinschecklist_mtwchecklist_id',TRUE),
		'shinschecklist_updated_at' => date('Y-m-d H:i:s'),
		 'shinschecklist_lastchanged_by' => $this->session->userdata('id'),
      );
      $this->shinschecklist_model->update(fixzy_decoder($this->input->post('shinschecklist_id')), $data);
/* $this->logQueries($this->config->item('dblog')); */
      
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('shinschecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->shinschecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $this->shinschecklist_model->delete($id);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('shinschecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinschecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function delete_update($id) {

   if($this->permission->cp_delete == true){

      $id = fixzy_decoder($id);
    $row = $this->shinschecklist_model->get_by_id($id);
    /* $this->logQueries($this->config->item('dblog')); */
    if ($row) {
      $data = array(
        'shinschecklist_deleted_at' => date('Y-m-d H:i:s')
      );
      $this->shinschecklist_model->update($id, $data);
      /* $this->logQueries($this->config->item('dblog')); */
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('shinschecklist'));
    }
    else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('shinschecklist'));
    }

   }else{
     redirect('/');
   }

  }

  public function _rules() {
    $this->form_validation->set_rules('shinschecklist_group', ' ', 'trim');
	$this->form_validation->set_rules('shinschecklist_name', ' ', 'trim|required');
	$this->form_validation->set_rules('shinschecklist_desc', ' ', 'trim');
	$this->form_validation->set_rules('shinschecklist_required', ' ', 'trim|required');
	$this->form_validation->set_rules('shinschecklist_checked', ' ', 'trim');
	$this->form_validation->set_rules('shinschecklist_mtwchecked', ' ', 'trim');
	$this->form_validation->set_rules('shinschecklist_permit_id', ' ', 'trim|integer');
	$this->form_validation->set_rules('shinschecklist_mtwchecklist_id', ' ', 'trim|integer');
	
    $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
  }

  

    public function get_json() {

      $i = $this->input->get('start');
      $columns = array(
        'shinschecklist_id',
		'shinschecklist_group',
		'shinschecklist_name',
		'shinschecklist_desc',
		'shinschecklist_required',
		'shinschecklist_checked',
		'shinschecklist_mtwchecked',
		'shinschecklist_permit_id',
		'shinschecklist_mtwchecklist_id',
		
      );
      $results = $this->shinschecklist_model->listajax(
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
              $rud .=  anchor(site_url('shinschecklist/read/'.fixzy_encoder($r['shinschecklist_id'])),'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_update == true){
              $rud .=    anchor(site_url('shinschecklist/update/'.fixzy_encoder($r['shinschecklist_id'])),'<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').
                ' ';
                }
                if($this->permission->cp_delete == true){
              $rud .= anchor(site_url('shinschecklist/delete/'.fixzy_encoder($r['shinschecklist_id'])),'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>','onclick="javasciprt: return confirm(\'' .$this->lang->line('delete_alert'). '\')"');
                }
            array_push($data, array(
                $i,
                $r['shinschecklist_group'],
				$r['shinschecklist_name'],
				$r['shinschecklist_desc'],
				$r['shinschecklist_required'],
				$r['shinschecklist_checked'],
				$r['shinschecklist_mtwchecked'],
				$r['permit_bookingid_shinschecklist_permit_id'],
				$r['mtwchecklist_name_shinschecklist_mtwchecklist_id'],
				
                $rud



            ));
        }

        echo json_encode(
        array(
          "draw"=>intval( $this->input->get('draw') ),
          "recordsTotal"=> $this->shinschecklist_model->recordsTotal()->recordstotal,
          "recordsFiltered" => $this->shinschecklist_model->recordsFiltered($columns, $this->input->get('search')['value'])->recordsfiltered,
          'data' => $data
        )
        );
    }

}
;
/* End of file Shinschecklist.php */
/* Location: ./application/controllers/Shinschecklist.php */