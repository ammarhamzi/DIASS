<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permission_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function access_role($usergroup_id = 0, $controller_name = "")
    {

        if ($usergroup_id == 0 || $controller_name == "") {
            $permission = (object) [
                'showlist' => true,
                'create' => true,
                'printlist' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
                'controller' => '',
            ];

            return $permission;
        } else {

        }
        $sql   = "select showlist, cp_create, cp_update, cp_delete, cp_read, printlist from controller_permission where cp_usergroup = $usergroup_id and cp_controller_id = (select control_id from reg_controller where control_name = '$controller_name')";
        $query = $this->db->query($sql);

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            //by default allow all? or not allowed all
            return (object) [
                'showlist' => true,
                'cp_create' => true,
                'printlist' => true,
                'cp_read' => true,
                'cp_update' => true,
                'cp_delete' => true,
                'controller' => '',
            ];
        }
    }

    public function checkcontroller($controller_name)
    {
        $sql   = "select cp_controller_id from controller_permission where cp_controller_id = (select control_id from reg_controller where control_name = '$controller_name')";
        $query = $this->db->query($sql);

        return $query->num_rows();
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
