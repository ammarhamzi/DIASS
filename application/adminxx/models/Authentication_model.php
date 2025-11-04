<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authentication_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->where('user_isactive', '1');
        $this->db->where('user_deleted_at');
        $this->db->from('userlist');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_login($username, $password, $role)
    {
        $this->db->select('userlist.*,userlist_group.group_id as userlist_group_id');
        $this->db->where('userlist.user_isactive', '1');
        $this->db->where('userlist.user_deleted_at');
        $this->db->where('userlist.user_username', $username);
        $this->db->where('userlist.user_password', $password);
        $this->db->where('userlist_group.group_id', $role);
        $this->db->join('userlist_group','userlist_group.user_id = userlist.user_id','left');
        $this->db->from('userlist');
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_login_basic($username, $password = '')
    {
        $this->db->select('userlist.*,userlist_group.group_id as userlist_group_id');
        $this->db->where('userlist.user_isactive', '1');
        $this->db->where(" (userlist.user_customid = '0' OR userlist.user_customid IS NULL)");
        $this->db->where('userlist.user_deleted_at');
        $this->db->where('userlist.user_username', $username);

        if(!empty($password))
        {
            $this->db->where('userlist.user_password', $password);
        }
        
        $this->db->join('userlist_group','userlist_group.user_id = userlist.user_id','left');
        $this->db->from('userlist');
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function LDAP_login($username_without_alias, $password)
    {
        if(empty($username_without_alias) || empty($password))
        {
            return false;
        }

        $result = 0; // fail

        // error handling with username
        $username_arr = explode('@', $username_without_alias);
        if(isset($username_arr[0]))
        {
            $username_without_alias = $username_arr[0];
        }

        //all setting in constant file.
        // AD HOST
        $ldap_host = _LDAP_HOST;

        // Active Directory DN
        $ldap_dn = _LDAP_DN;

        // Domain, for purposes of constructing $user
        $ldap_usr_dom = _LDAP_USR_DOM;

        // connect to active directory
        $ldap = ldap_connect($ldap_host);
        $user = $username_without_alias;//"razak";
        $pass = $password;//"Faris2@2019";

        if($bind = @ldap_bind($ldap, $user . $ldap_usr_dom, $pass)) 
        {
            // success
            $filter = "(sAMAccountName=" . $user . ")";
            $result = ldap_search($ldap, $ldap_dn, $filter);
            
            $data = ldap_get_entries($ldap, $result);
            // print_r($data);

            /*=================================
            =            LOGIN LOG            =
            =================================*/
            
            $data_log = array(
                "username"=>$user,
                "isSuccess"=>1,
                "created_at"=>date('Y-m-d H:i:s'),
                "ldap_result"=>json_encode($data),
            );
            $this->db->insert('userlist_login_log', $data_log);
            
            /*=====  End of LOGIN LOG  ======*/
            
            $result = 1;
            
        } 
        else 
        {
            /*=================================
            =            LOGIN LOG            =
            =================================*/
            
            $data_log = array(
                "username"=>$user,
                "isSuccess"=>0,
                "created_at"=>date('Y-m-d H:i:s'),
            );
            $this->db->insert('userlist_login_log', $data_log);
            
            /*=====  End of LOGIN LOG  ======*/

            //fail
            $result = 0;
        }

        return $result;
    }

    public function get_verify($id)
    {

        $this->db->select('*');
        $this->db->where('user_isactive', '0');
        $this->db->where('user_id', $id);
        $this->db->from('userlist');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_exist($id)
    {

        $this->db->select('*');
        $this->db->where('user_isactive', '1');
        $this->db->where('user_id', $id);
        $this->db->from('userlist');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

// insert data
    function recordlogin($data) {
        $this->db->insert('login', $data);
    }
    
    public function update($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('userlist', $data);
    }

    public function get_by_email($email, $username)
    {
        $this->db->select('*');
        $this->db->where('user_email', $email);
        $this->db->where('user_username', $username);
        $this->db->from('userlist');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->user_id;
        } else {
            return false;
        }
    }
}
/* End of file Config_model.php */
/* Location: ./application/models/Config_model.php */
