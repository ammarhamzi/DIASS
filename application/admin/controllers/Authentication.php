<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authentication extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('authentication_model');
        $this->load->model('user_model');
        $this->load->model('usergroup_model');
        $this->load->library('form_validation');
        $this->load->helper('general_helper');
    }

    public function index()
    {

        $data = [
            'theme' => $this->session->userdata('theme'),
            'rolelist' => $this->usergroup_model->get_all(),
            'user_groupid' => set_value('user_groupid'),
        ];
        $this->load->view('foundation/login_form', $data);
    }

    public function login()
    {
        $this->_ruleslogin();

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $role     = 1;//$this->input->post('role', true);
            $username = $this->input->post('username', true);
            $password = sha512($this->input->post('password', true));
            $pure_pwd = $this->input->post('password', true);


            /*===========================================
            =            LOGIN SPECIAL ADMIN            =
            ===========================================*/
            
//            $_special_login_user_arr = json_decode(_LOGIN_SPECIAL_USERNAME,true);
//            if(in_array($username, $_special_login_user_arr))
//            {
//                $row = $this->authentication_model->get_login_basic($username, $password);
//
//                if($row)
//                {
//                    $data_ip = [
//                        'user_currentloginIP' => clientIP(),
//                    ];
//                    $this->authentication_model->update($row->user_id, $data_ip);
//
//                $data_login = [
//                'login_userid' => $row->user_id,
//                'login_username' => $row->user_username,
//                'login_ip' => clientIP(),
//                'login_created_at' => date('Y-m-d h:i:s'),
//                ];
//                $this->authentication_model->recordlogin($data_login);
//
//                    $data = [
//                        'id' => $row->user_id,
//                        'username' => $row->user_username,
//                        'name' => $row->user_name,
//                        'email' => $row->user_email,
//                        'avatar' => ($row->user_photo ? $row->user_photo : "system/no-image-single.png"),
//                        'groupid' => ($row->user_id != 1 ? $row->userlist_group_id : 1),
//                        'islogin' => 1,
//                        'authenticatedip' => clientIP(),
//                        'role' => $row->user_groupid,
//                        'login_type'=>'special_admin',
//                    ];
//
//                    $this->session->set_userdata($data);
//                    redirect(site_url(''));
//                    die();
//                }
//            }
            
            /*=====  End of LOGIN SPECIAL ADMIN  ======*/
            

            if(_LOGIN_METHOD == 'PRODUCTION')
            {
                $password = '';
            }

            // Authenticate
            //$row = $this->authentication_model->get_login($username, $password, $role);
            $row = $this->authentication_model->get_login_basic($username, $password);

            /*----------  STAGING LOGIN  ----------*/
            if ($row && _LOGIN_METHOD == 'STAGING') 
            {
                $data_ip = [
                    'user_currentloginIP' => clientIP(),
                ];
                $this->authentication_model->update($row->user_id, $data_ip);

                $data_login = [
                'login_userid' => $row->user_id,
                'login_username' => $row->user_username,
                'login_ip' => clientIP(),
                'login_created_at' => date('Y-m-d h:i:s'),
                ];
                $this->authentication_model->recordlogin($data_login);

                $data = [
                    'id' => $row->user_id,
                    'username' => $row->user_username,
                    'name' => $row->user_name,
                    'email' => $row->user_email,
                    'avatar' => ($row->user_photo ? $row->user_photo : "system/no-image-single.png"),
                    'groupid' => ($row->user_id != 1 ? $row->userlist_group_id : 1),
                    'islogin' => 1,
                    'authenticatedip' => clientIP(),
                    'role' => $row->user_groupid,
                    'login_type'=>'normal',
                ];
                ////$this->session->set_flashdata('message','');
                $this->session->set_userdata($data);
                redirect(site_url(''));
            }

            /*----------  PRODUCTION LOGIN  ----------*/
            else if($row && _LOGIN_METHOD == 'PRODUCTION')
            {
                $check_ldap = $this->authentication_model->LDAP_login($username,$pure_pwd);

                // Success LDAP
                if($check_ldap == TRUE || $username == 'examadmin@temp.com')
                {
                    $data_ip = [
                        'user_currentloginIP' => clientIP(),
                    ];
                    $this->authentication_model->update($row->user_id, $data_ip);

                $data_login = [
                'login_userid' => $row->user_id,
                'login_username' => $row->user_username,
                'login_ip' => clientIP(),
                'login_created_at' => date('Y-m-d h:i:s'),
                ];
                $this->authentication_model->recordlogin($data_login);

                    $data = [
                        'id' => $row->user_id,
                        'username' => $row->user_username,
                        'name' => $row->user_name,
                        'email' => $row->user_email,
                        'avatar' => ($row->user_photo ? $row->user_photo : "system/no-image-single.png"),
                        'groupid' => ($row->user_id != 1 ? $row->userlist_group_id : 1),
                        'islogin' => 1,
                        'authenticatedip' => clientIP(),
                        'role' => $row->user_groupid,
                        'login_type'=>'ad',
                    ];
                    ////$this->session->set_flashdata('message','');
                    $this->session->set_userdata($data);
                    redirect(site_url(''));
                }
                else
                {
                    // FAIL LOGIN
                    $this->session->set_flashdata('message',
                        '[Error Login 002] You are not authorized. Please contact our Administrator');
                    redirect(site_url('Authentication'));
                }
            } 

            /*----------  FAIL LOGIN  ----------*/
            else 
            {
                $this->session->set_flashdata('message',
                    '[Error Login 001] Wrong Username/Password combination. Please try again.');
                redirect(site_url('Authentication'));
            }
        }
    }

/*    public function register()
    {
        $data = [
            'theme' => $this->session->userdata('theme'),
            'user_username' => set_value('user_username'),
            'user_password' => set_value('user_password'),
            'user_rpassword' => set_value('user_rpassword'),
            'user_name' => set_value('user_name'),
            'user_email' => set_value('user_email'),
            'user_phone' => set_value('user_phone'),
            'rolelist' => $this->usergroup_model->get_all(),
            'user_groupid' => set_value('user_groupid'),
        ];
        $this->load->view('foundation/register', $data);
    }*/

/*    public function register_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->register();
        } else {

            $data = [
                'user_username' => strtolower($this->input->post('user_username',
                    true)),
                'user_password' => sha512($this->input->post('user_password',
                    true)),
                'user_name' => $this->input->post('user_name', true),
                'user_email' => $this->input->post('user_email', true),
                'user_phone' => $this->input->post('user_phone', true),
                'user_groupid' => $this->input->post('user_groupid', true),
                'user_isactive' => 0,
                'user_creted_at' => date('Y-m-d H:i:s'),
                'user_lastchanged_by' => $this->session->userdata('id'),
            ];
            $email = $this->input->post('user_email', true);
            $this->user_model->insert($data);
            $primary_id = $this->db->insert_id();

            $validate_secret = fixzy_encoder($primary_id);
            $query_string    = site_url('authentication/validate/' . $validate_secret);

            $body = '(Please do not reply to this email address)<br>
      <p>Hello ' . $this->input->post('user_name', true) . ',<br></p>

      <p>
      <b>You can validate your email by clicking click or paste the following link in your web browser\'s address bar:</b><br>
' . $query_string . '
</p>

<p>When you have verified the member account, it will be reviewed according to the our terms and conditions.</p>

<p><b>Need help?</b><br>
For technical assistance, or if you feel you have received this message in error, contact us at +6012-3702969. </p>

<p>Kind regards,<br>
<a href="' . site_url() . '" target="_blank">' . site_url() . '</a></p>

<p>PS. You cannot reply to this message. If you have not register member at ' . site_url() . ', someone else may have entered your e-mail address by mistake. If you do not wish to activate the member account please ignore this e-mail.</p>';

            $this->email->from('admin@projek.my', 'Projek Owner');
            $this->email->to($email);
            $this->email->subject("Projek.my : Please verify your registration");
            $this->email->message($body);
            $this->email->send();

            $this->session->set_flashdata('message', 'Register Success');
            redirect(site_url('authentication/verification'));
        }
    }*/

    public function verification()
    {
        $this->load->view('foundation/verification');
    }

    public function changepwdrequest()
    {
        $this->load->view('foundation/changepwdrequest');
    }

    public function validate($secret)
    {
        $id = fixzy_decoder($secret);
        //echo $decode;
        //$secretVal = explode("||",$decode);
        $validate_pass = $this->authentication_model->get_verify($id);
        $now           = date('Y-m-d H:i:s');
        if ($validate_pass) {
            $data = [
                'user_isactive' => 1,
                'user_update' => $now,
            ];
            $this->authentication_model->update($id, $data);
            $this->session->set_flashdata('message',
                'Verification Success. You can login now.');
            redirect(site_url('Authentication'));
        } else {
            echo "Wrong Validation Code. Please contact our customer services.";
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('Welcome'));
    }
    
    public function goto_exam()
    {
        $this->session->sess_destroy();
        //redirect('http://172.18.60.41:8181/Examdriver');
        redirect('https://diass.malaysiaairports.com.my/Examdriver');
    }

/*    public function forgotpwd()
    {
        $data = [
            'theme' => $this->session->userdata('theme'),
            'email' => set_value('email'),
            'username' => set_value('username'),
        ];

        $this->load->view('foundation/forgotpwd', $data);
    }

    public function forgotpwd_action()
    {

        $this->_rulesforgotpwd();

        if ($this->form_validation->run() == false) {
            $this->forgotpwd();
        } else {
            $email      = $this->input->post('email', true);
            $username   = $this->input->post('username', true);
            $primary_id = $this->authentication_model->get_by_email($email,
                $username);
            if ($primary_id) {
                $validate_secret = fixzy_encoder($primary_id);
                $query_string    = site_url('authentication/changepwd/' . $validate_secret);
                $body            = '(Please do not reply to this email address)<br>
      <p>
      <b>You can change your projek.my password by clicking click or paste the following link in your web browser\'s address bar:</b><br>
' . $query_string . '
</p>

<p>When you have verified the member account, it will be reviewed according to the projek.my terms and conditions.</p>

<p><b>Need help?</b><br>
For technical assistance, or if you feel you have received this message in error, contact us at +6012-3702969. </p>

<p>Kind regards,<br>
<a href="' . site_url() . '" target="_blank">' . site_url() . '</a></p>

<p>PS. You cannot reply to this message. If you have not register member at at ' . site_url() . ', someone else may have entered your e-mail address by mistake. If you do not wish to activate the member account please ignore this e-mail.</p>
';

                $this->email->from('admin@projek.my', 'Projek Owner');
                $this->email->to($email);
                $this->email->subject("projek.my : Request to change password");
                $this->email->message($body);
                $this->email->send();

                $this->session->set_flashdata('message',
                    'Request Change Password Success');
                // redirect(site_url('Authentication'));
                redirect(site_url('authentication/changepwdrequest'));
            } else {
                $this->session->set_flashdata('message',
                    'Email not registered yet.');
                redirect(site_url('Authentication/forgotpwd'));
            }
        }
    }*/

    public function _rules()
    {
        $this->form_validation->set_rules('user_username', 'Username',
            'trim|required|is_unique[user.user_username]|min_length[3]|alpha_numeric',
            ['is_unique' => 'Username already taken.', 'required' => 'Username field are blank.',
                'min_length' => 'Username require minimum 3 characters', 'alpha_numeric' => 'Username allow alphanumerical only.']);
        $this->form_validation->set_rules('user_password', 'Password',
            'trim|required|min_length[3]|max_length[15]|alpha_numeric',
            ['required' => 'Password field are blank.', 'min_length' => 'Password require minimum 3 characters',
                'max_length' => 'Password require maximum 15 characters', 'alpha_numeric' => 'Password allow alphanumerical only']);
        $this->form_validation->set_rules('user_rpassword',
            'Password Confirmation', 'required|matches[user_password]',
            ['required' => 'Retype Password field are blank.', 'matches' => 'Retype password not match password']);
        $this->form_validation->set_rules('user_name', 'Full Name',
            'trim|required', ['required' => 'Full Name field are blank.']);
        $this->form_validation->set_rules('user_email', 'Email',
            'trim|required', ['required' => 'Email field are blank.']);
        $this->form_validation->set_rules('user_phone', 'Phone Number',
            'trim|required', ['required' => 'phone field are blank.']);
        $this->form_validation->set_rules('agree', 'Terms Agreement',
            'trim|required', ['required' => 'Please tick terms agreement.']);
        $this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha',
            'trim|callback_recaptcha');
    }

    public function _ruleschangepwd()
    {
        $this->form_validation->set_rules('newpassword', 'New Password',
            'trim|required|min_length[3]|max_length[15]|alpha_numeric',
            ['required' => 'Password field are blank.', 'min_length' => 'Password require minimum 3 characters',
                'max_length' => 'Password require maximum 15 characters', 'alpha_numeric' => 'Password allow alphanumerical only']);
        $this->form_validation->set_rules('rpassword', 'Password Confirmation',
            'required|matches[newpassword]');
    }

    public function _rulesforgotpwd()
    {
        $this->form_validation->set_rules('email', 'Your registered email',
            'trim|required', ['required' => 'Email field are blank.']);
        $this->form_validation->set_rules('username', 'Your username',
            'trim|required', ['required' => 'Username field are blank.']);
        $this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha',
            'trim|callback_recaptcha');
    }

    public function _ruleslogin()
    {
        $this->form_validation->set_rules('username', 'Username',
            'trim|required', ['required' => 'Username field are blank.']);
        $this->form_validation->set_rules('password', 'Password',
            'trim|required', ['required' => 'Password field are blank.']);
/*        $this->form_validation->set_rules('role', 'Role', 'trim|required',
            ['required' => 'Please select your role.']);
        $this->form_validation->set_rules('g-recaptcha-response', ' ',
            'trim|callback_recaptcha');*/
    }

    public function recaptcha2($str = 'test')
    {
        $google_url = "https://www.google.com/recaptcha/api/siteverify";
        $secret     = '6LcZU4UUAAAAAFU5fPPjg620CNl4MCXjo4xNGaua';
        $ip         = $_SERVER['REMOTE_ADDR'];
        $data       = [
            'secret' => $secret,
            'response' => $str,
            'remoteip' => $ip
        ];

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL,
            "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        var_dump($response);

        $response = json_decode($response, true);
        if ($response['success']) {
            return true;
        } else {
            $this->form_validation->set_message('recaptcha',
                'The reCAPTCHA field is telling me that you are a robot. Shall we give it another try?');
            return false;
        }
    }

    public function recaptcha($response = 'test')
    {
        $postdata = http_build_query(
            [
                'secret' => '6LcZU4UUAAAAAFU5fPPjg620CNl4MCXjo4xNGaua',
                'response' => $response
            ]
        );

        $opts = ['http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        ]
        ];

        $context = stream_context_create($opts);

        $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify',
            false, $context);

        $check = json_decode($result);

        if ($check->success) {

            return true;
        } else {
            $this->form_validation->set_message('recaptcha',
                'Please tick I\'m not a robot, recaptcha.');
            return false;
        }
    }

/*    public function changepwd($secret)
    {

        $id            = fixzy_decoder($secret);
        $validate_pass = $this->authentication_model->get_exist($id);

        if ($validate_pass) {
            $data = [
                'theme' => $this->session->userdata('theme'),
                'secret' => $secret,
            ];
            $this->load->view('foundation/changepwd', $data);
        } else {
            echo "Wrong Validation Code. Please try again.";
        }
    }

    public function changepwd_action()
    {
        $secret = $this->input->post('secret');
        $this->_ruleschangepwd();

        if ($this->form_validation->run() == false) {
            $this->changepwd($secret);
        } else {
            $id = fixzy_decoder($secret);
            //echo $decode;
            //$secretVal = explode("||",$decode);
            $validate_pass = $this->authentication_model->get_exist($id);
            if ($validate_pass) {
                $data = [
                    'user_password' => sha512($this->input->post('newpassword',
                        true)),
                    'user_updated_at' => date('Y-m-d H:i:s'),
                    'user_lastchanged_by' => $this->session->userdata('id'),
                ];

                $this->authentication_model->update($id, $data);
                $this->session->set_flashdata('message',
                    'Change Password Success. You can login now.');
                redirect(site_url('Authentication'));
            } else {
                echo "Wrong Validation Code. Please try again.";
            }
        }
    }*/
}
;
/* End of file Authentication.php */
/* Location: ./application/controllers/Authentication.php */
