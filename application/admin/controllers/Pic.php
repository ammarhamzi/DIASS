<?php
/* \resources\gen_template\master\crud-newpage\controllers */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pic extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pic_model');
        $this->load->model('user_model');
        $this->load->model('permittimeline_model');
        $this->load->model('password_model');
        $this->lang->load('pic_lang', $this->session->userdata('language'));
        $this->lang->load('user_lang', $this->session->userdata('language'));
    }

    public function index()
    {

        if ($this->permission->showlist == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'list',
            ];
            $pic = $this->pic_model->get_all();
            /* $this->logQueries($this->config->item('dblog')); */
            $data = [
                'pic_data' => $pic,
                'permission' => $this->permission,
            ];

            $this->content = 'pic/pic_list';
            ##--slave_combine_to_list--##
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    //type=normal/raw
    public function read($id, $type = "normal")
    {

        if ($this->permission->cp_read == true) {

            $id      = fixzy_decoder($id);
            $setting = [
                'method' => 'newpage',
                'patern' => 'read',
            ];
            $row = $this->pic_model->get_read($id);
            $changepassword = $this->pic_model->get_changepassword_history($id);
            $loginhistory = $this->pic_model->get_login_history($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'pic_company_id' => $row->company_name_pic_company_id,
                    'pic_fullname' => $row->pic_fullname,
                    'pic_ic' => $row->pic_ic,
                    'pic_phoneoffice' => $row->pic_phoneoffice,
                    'pic_handphone' => $row->pic_handphone,
                    'pic_email' => $row->pic_email,
                    'changepassword_history' => $changepassword,
                    'login_history' => $loginhistory,

                ];

                if ($type === 'normal') {
//check if parentchild exist
                    $parent_id = $this->my_model->get_value2('tabslave', 'tabslave_id',
                        "tabslave_controller = '" . strtolower($this->router->fetch_class()) . "' and tabslave_parent_id = 0");

                    if (!empty($parent_id)) {
                        $data_parentchild = [
                            'parentchildmenu' => $this->my_model->get_data('tabslave', '*',
                                "tabslave_parent_id = $parent_id"),
                            'currentcontroller' => strtolower($this->router->fetch_class()),
                            'parentid' => fixzy_encoder($id),
                        ];

                        $this->parentchildmenu = $this->load->view('foundation/parentchildmenu',
                            $data_parentchild, true);
                    }

                    $this->content = 'pic/pic_read';
                    ##--slave_combine_to_read--##
                    $this->layout($data, $setting);
                } else {
                    echo $this->load->view('pic/pic_read_raw', $data, true);
                }

            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function create()
    {

        if ($this->permission->cp_create == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $data = [
                'button' => 'Create',
                'action' => site_url('pic/create_action'),
                'pic_company_id' => set_value('pic_company_id'),
                'company' => $this->pic_model->get_all_company(),
                'pic_fullname' => set_value('pic_fullname'),
                'pic_ic' => set_value('pic_ic'),
                'pic_phoneoffice' => set_value('pic_phoneoffice'),
                'pic_handphone' => set_value('pic_handphone'),
                'pic_email' => set_value('pic_email'),
                'user_username' => set_value('user_username'),
                'user_password' => set_value('user_password'),
                'user_name' => set_value('user_name'),
                'user_email' => set_value('user_email'),
                'user_photo' => set_value('user_photo'),
                'user_groupid' => set_value('user_groupid'),
            ];
            $this->content = 'pic/pic_form';
            $this->layout($data, $setting);

        } else {
            redirect('/');
        }

    }

    public function create_action()
    {

        if ($this->permission->cp_create == true) {

            $this->createrules();

            if ($this->form_validation->run() == false) {
                $this->create();
            } else {
                $data = [
                    'pic_company_id' => $this->input->post('pic_company_id', true),
                    'pic_fullname' => $this->input->post('pic_fullname', true),
                    'pic_ic' => $this->input->post('pic_ic', true),
                    'pic_phoneoffice' => $this->input->post('pic_phoneoffice', true),
                    'pic_handphone' => $this->input->post('pic_handphone', true),
                    'pic_email' => trim($this->input->post('pic_email', true)),
                    'pic_created_at' => date('Y-m-d H:i:s'),
                    'pic_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->pic_model->insert($data);
                $primary_id = $this->db->insert_id();
                /* $this->logQueries($this->config->item('dblog')); */

                $data_user = [
                    'user_username' => trim($this->input->post('pic_email', true)),
                    'user_password' => sha512($this->input->post('user_password', true)),
                    'user_name' => $this->input->post('pic_fullname', true),
                    'user_email' => trim($this->input->post('pic_email', true)),
                    'user_photo' => $this->input->post('user_photo', true),
                    'user_groupid' => 2, //$this->input->post('user_groupid', true),
                    'user_customid' => $primary_id,
                    'user_created_at' => date('Y-m-d H:i:s'),
                    'user_isactive' => 1,
                    'user_lastchanged_by' => $this->session->userdata('id'),
                ];
                $this->user_model->insert($data_user);
                //$primary_id = $this->db->insert_id();

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function update($id)
    {

        if ($this->permission->cp_update == true) {

            $setting = [
                'method' => 'newpage',
                'patern' => 'form',
            ];
            $row = $this->pic_model->get_by_id(fixzy_decoder($id));
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data = [
                    'button' => $this->lang->line('edit'),
                    'action' => site_url('pic/update_action'),
                    'id' => $id,
                    'pic_company_id' => set_value('pic_company_id', $row->pic_company_id),
                    'company' => $this->pic_model->get_all_company(),
                    'pic_fullname' => set_value('pic_fullname', $row->pic_fullname),
                    'pic_ic' => set_value('pic_ic', $row->pic_ic),
                    'pic_phoneoffice' => set_value('pic_phoneoffice', $row->pic_phoneoffice),
                    'pic_handphone' => set_value('pic_handphone', $row->pic_handphone),
                    'pic_email' => set_value('pic_email', $row->pic_email),
                    'user_username' => set_value('user_username',
                        $row->user_username),
                    'user_password' => set_value('user_password',
                        $row->user_password),
                    'user_name' => set_value('user_name', $row->user_name),
                    'user_email' => set_value('user_email', $row->user_email),
                    'user_photo' => set_value('user_photo', $row->user_photo),
                    'user_groupid' => set_value('user_groupid', 2),
                    'user_id' => fixzy_encoder($row->user_id),
                ];
                $this->content = 'pic/pic_form';
                ##--slave_combine_to_update--##
                $this->layout($data, $setting);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function update_action()
    {

        if ($this->permission->cp_update == true) {

            $this->updaterules();

            if ($this->form_validation->run() == false) {
                $this->update($this->input->post('pic_id', true));
            } else {

            $this->db->trans_start();
            $now = date('Y-m-d H:i:s');
                $data = [
                    'pic_company_id' => $this->input->post('pic_company_id', true),
                    'pic_fullname' => $this->input->post('pic_fullname', true),
                    'pic_ic' => $this->input->post('pic_ic', true),
                    'pic_phoneoffice' => $this->input->post('pic_phoneoffice', true),
                    'pic_handphone' => $this->input->post('pic_handphone', true),
                    'pic_email' => trim($this->input->post('pic_email', true)),
                    'pic_updated_at' => $now,
                    'pic_lastchanged_by' => $this->session->userdata('id'),
                ];

                $this->pic_model->update(fixzy_decoder($this->input->post('pic_id')), $data);
                /* $this->logQueries($this->config->item('dblog')); */

                $data_user = [
                    'user_name' => $this->input->post('pic_fullname', true),
                    'user_username' => trim($this->input->post('pic_email', true)),
                    'user_email' => trim($this->input->post('pic_email', true)),
                    'user_customid' => fixzy_decoder($this->input->post('pic_id')),
                    /*'user_photo' => $this->input->post('user_photo', true),*/
                    'user_groupid' => '2', //$this->input->post('user_groupid', true),
                    'user_updated_at' => $now,
                    'user_lastchanged_by' =>$this->session->userdata('id'),
                ];

                if (!empty($this->input->post('change_password_todefault', true)) && $this->input->post('change_password_todefault', true) == 'changetodefault') {
//echo sha512('!Asd123#');exit;
                    $data_user['user_password'] = sha512('!Asd123#');

                    $body = '<p>Your DIASS password for ' . $this->input->post('pic_email', true) . ' has been successfully changed to default as requested. If you didn\'t make this request, please contact us at +603 8777 7000.</p>
<br />
<p>Your password is: <b>!Asd123#</b></p>

<p><b>Need help?</b><br>
For technical assistance, or if you feel you have received this message in error, contact us at +603 8777 7000. </p>

<p>Kind regards,<br>
<a href="' . site_url() . '" target="_blank">' . site_url() . '</a></p>

<p>PS. You cannot reply to this message. If you have not register member at at ' . site_url() . ', someone else may have entered your e-mail address by mistake. If you do not wish to activate the member account please ignore this e-mail.</p>
';
//$config = Array(
//    'smtp_from_email' => 'mahb-no-reply@malaysiaairports.com.my',
//    'protocol' => 'smtp',
//    'smtp_host' => '172.18.60.203',
//    'smtp_port' => 25,
//    'smtp_user' => '',
//    'smtp_pass' => '',
//    'mailtype'  => 'html', 
//    'charset'   => 'iso-8859-1',
//    'newline' => '\r\n'
//);
//$this->load->library('email', $config);
$body2 = 'Your DIASS password for ' . $this->input->post('pic_email', true) . ' has been successfully changed to default as requested';
                    $this->email->from('mahb-no-reply@malaysiaairports.com.my', 'DIASS Administrator');
                    $this->email->to($this->input->post('pic_email', true));
                    $this->email->subject("DIASS : Your Password Has Been Changed");
                    $this->email->message($body);
                    $this->email->send();
                    $this->email->print_debugger();

                $data_changepassword = [
                 'changepassword_userid' => fixzy_decoder($this->input->post('user_id', true)),
                 'changepassword_username' => trim($this->input->post('pic_email', true)),
                 'changepassword_timedate' => $now,
                 'changepassword_method' => 'admin',
                 'changepassword_by' => $this->session->userdata('id'),
                 'changepassword_created_at' => $now,
                ];
                $this->password_model->insert_changepwd($data_changepassword);

                }

                $this->user_model->update_customid(fixzy_decoder($this->input->post('pic_id')),
                    $data_user);


                $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        // generate an error... or use the log_message() function to log your error
                $this->session->set_flashdata('message', 'Error. Contact ITD');
                    } else {
                $this->session->set_flashdata('message', 'Update Record Success');
                    }

                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pic_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $this->pic_model->delete($id);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pic'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function delete_update($id)
    {

        if ($this->permission->cp_delete == true) {

            $id  = fixzy_decoder($id);
            $row = $this->pic_model->get_by_id($id);
            /* $this->logQueries($this->config->item('dblog')); */
            if ($row) {
                $data_pic = [
                    'pic_deleted_at' => date('Y-m-d H:i:s'),
                    'pic_lastchanged_by' => $this->session->userdata('id')
                ];
                $this->pic_model->update($id, $data_pic);

                $data = [
                    'user_isactive' => 0,
                    'user_deleted_at' => date('Y-m-d H:i:s'),
                    'user_lastchanged_by' => $this->session->userdata('id')
                ];
                $this->user_model->update($id, $data);
                /* $this->logQueries($this->config->item('dblog')); */
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pic'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pic'));
            }

        } else {
            redirect('/');
        }

    }

    public function createrules()
    {
        $this->form_validation->set_rules('pic_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pic_fullname', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_ic', ' ', 'trim');
        $this->form_validation->set_rules('pic_phoneoffice', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_handphone', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_email', ' ', 'trim|required|valid_email|callback_notexist_member');
        $this->form_validation->set_rules('user_password', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
        $this->form_validation->set_message('notexist_member', 'User already exist');
    }

    public function notexist_member($str)
    {
        $field_value = $str; //this is redundant, but it's to show you how
        if ($this->user_model->notexist_user($field_value) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updaterules()
    {
        $this->form_validation->set_rules('pic_company_id', ' ', 'trim|required|integer');
        $this->form_validation->set_rules('pic_fullname', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_ic', ' ', 'trim');
        $this->form_validation->set_rules('pic_phoneoffice', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_handphone', ' ', 'trim|required');
        $this->form_validation->set_rules('pic_email', ' ', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="alert_custom">', '</span>');
    }

    public function get_json()
    {

        $i       = $this->input->get('start');
        $columns = [
            'pic_id',
            'company_name',
            'pic_fullname',
            'pic_ic',
            'pic_phoneoffice',
            'pic_handphone',
            'pic_email',

        ];
        $results = $this->pic_model->listajax(
            $columns,
            $this->input->get('start'),
            $this->input->get('length'),
            $this->input->get('search')['value']/*,
        $columns[$this->input->get('order')[0]['column']],
        $this->input->get('order')[0]['dir']*/
        );
        $data = [];
        foreach ($results as $r) {
            $i++;
            $rud = "";

            $exist = $this->permittimeline_model->notexist_user($r['user_id']);

            if ($this->permission->cp_read == true) {
                $rud .= anchor(site_url('pic/read/' . fixzy_encoder($r['pic_id'])), '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_update == true) {
                $rud .= anchor(site_url('pic/update/' . fixzy_encoder($r['pic_id'])), '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>') .
                    ' ';
            }
            if ($this->permission->cp_delete == true && $exist == 0) {
                $rud .= anchor(site_url('pic/delete_update/' . fixzy_encoder($r['pic_id'])), '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>', 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
            }
            array_push($data, [
                $i,

                $r['pic_fullname'],
                $r['pic_ic'],
                $r['pic_phoneoffice'],
                $r['pic_handphone'],
                $r['pic_email'],
                $r['company_name_pic_company_id'],
                $rud

            ]);
        }

        echo json_encode(
            [
                "draw" => intval($this->input->get('draw')),
                "recordsTotal" => $this->pic_model->recordsTotal()->recordstotal,
                "recordsFiltered" =>$this->pic_model->recordsTotal()->recordstotal,
                'data' => $data
            ]
        );
    }

}
;
/* End of file Pic.php */
/* Location: ./application/controllers/Pic.php */
