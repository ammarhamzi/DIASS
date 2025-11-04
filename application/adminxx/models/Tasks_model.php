<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tasks_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

// get all
    public function get_all($start_date = '', $end_date = '')
    {
        $this->db->select('
    tasks.*,
    userlist.user_username AS username_task_to,
    (SELECT user_username FROM userlist WHERE user_id = tasks.task_from) AS username_task_from,
    DATE_FORMAT(task_date,\'%d/%m/%Y\') AS task_date,
    DATE_FORMAT(task_duedate,\'%d/%m/%Y\') AS task_duedate,
    case task_status
    when \'1\' then \'On Going\'
    when \'2\' then \' KIV\'
    when \'3\' then \' Completed\'
    end as task_status,
    case task_priority
    when \'1\' then \'Normal\'
    when \'2\' then \' Medium\'
    when \'3\' then \' High\'
    when \'4\' then \' Highest\'
    end as task_priority', false);
        $this->db->where('task_deleted_at');
        if ($start_date != "") {
            $this->db->where('task_duedate >=', $start_date);
        }
        if ($end_date != "") {
            $this->db->where('task_duedate <=', $end_date . ' 23:59:59');
        }

        $this->db->order_by("tasks.task_status", "ASC");
        $this->db->order_by('tasks.task_current', 'DESC');
        $this->db->order_by('tasks.task_priority', 'DESC');
        $this->db->order_by('tasks.task_duedate', 'DESC');
        $this->db->order_by('tasks.task_progress', 'DESC');
        $this->db->from('tasks');
        $this->db->join('userlist', 'userlist.user_id = tasks.task_to', 'left');
        return $query = $this->db->get()->result();
    }

    public function workinghour($id, $start_date = '', $end_date = '')
    {
        $this->db->select('sum(task_hour) as totalworkinghour');
        if ($start_date != "") {
            $this->db->where('task_duedate >=', $start_date);
        }
        if ($end_date != "") {
            $this->db->where('task_duedate <=', $end_date . ' 23:59:59');
        }
        $this->db->where('task_to', $id);
        $this->db->from('tasks');
        return $query = $this->db->get()->row()->totalworkinghour;
    }

    public function get_yourall($id, $start_date = '', $end_date = '')
    {
        $this->db->select('
    tasks.*,
    userlist.user_username AS username_task_to,
    (SELECT user_username FROM userlist WHERE user_id = tasks.task_from) AS username_task_from,
    DATE_FORMAT(task_date,\'%d/%m/%Y\') AS task_date,
    DATE_FORMAT(task_duedate,\'%d/%m/%Y\') AS task_duedate,
    case task_status
    when \'1\' then \'On Going\'
    when \'2\' then \' KIV\'
    when \'3\' then \' Completed\'
    end as task_status,
    case task_priority
    when \'1\' then \'Normal\'
    when \'2\' then \' Medium\'
    when \'3\' then \' High\'
    when \'4\' then \' Highest\'
    end as task_priority', false);
        $this->db->where('task_deleted_at');
        $this->db->where('task_to', $id);
        if ($start_date != "") {
            $this->db->where('task_duedate >=', $start_date);
        }
        if ($end_date != "") {
            $this->db->where('task_duedate <=', $end_date);
        }
        $this->db->order_by("tasks.task_status", "ASC");
        $this->db->order_by('tasks.task_current', 'DESC');
        $this->db->order_by('tasks.task_priority', 'DESC');
        $this->db->order_by('tasks.task_duedate', 'DESC');
        $this->db->order_by('tasks.task_progress', 'DESC');
        $this->db->from('tasks');
        $this->db->join('userlist', 'userlist.user_id = tasks.task_to', 'left');
        return $query = $this->db->get()->result();
    }

// get data by id
    public function get_by_id($id)
    {
        $this->db->select('*, DATE_FORMAT(task_date,\'%d/%m/%Y\') AS task_date, DATE_FORMAT(task_duedate,\'%d/%m/%Y\') AS task_duedate');
        $this->db->where('tasks.task_id', $id);
        $this->db->where('task_deleted_at');
        $this->db->from('tasks');
        return $query = $this->db->get()->row();
    }

    public function get_read($id)
    {
        $this->db->select('
    tasks.*,
    userlist.user_username AS username_task_to,
    (SELECT user_username FROM userlist WHERE user_id = tasks.task_from) AS username_task_from,
    DATE_FORMAT(task_date,\'%d/%m/%Y\') AS task_date,
    DATE_FORMAT(task_duedate,\'%d/%m/%Y\') AS task_duedate,
    case task_status
    when \'1\' then \'On Going\'
    when \'2\' then \' KIV\'
    when \'3\' then \' Completed\'
    end as task_status,
    case task_weight
    when \'1\' then \'Easy\'
    when \'2\' then \' Normal\'
    when \'3\' then \' Hard\'
    end as task_weight,
    case task_priority
    when \'1\' then \'Normal\'
    when \'2\' then \' Medium\'
    when \'3\' then \' High\'
    when \'4\' then \' Highest\'
    end as task_priority
    ', false);
        $this->db->where('tasks.task_id', $id);
        $this->db->where('task_deleted_at');
        $this->db->from('tasks');
        $this->db->join('userlist', 'userlist.user_id = tasks.task_to', 'left');
        return $query = $this->db->get()->row();
    }

// insert data
    public function insert($data)
    {
        $this->db->insert('tasks', $data);
    }

// update data
    public function update($id, $data)
    {
        $this->db->where('task_id', $id);
        $this->db->update('tasks', $data);
    }

// delete data
    public function delete($id)
    {
        $this->db->where('task_id', $id);
        $this->db->delete('tasks');
    }

    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->order_by('user_id', 'ASC');
        $this->db->from('userlist');
        return $query = $this->db->get()->result();
    }

    public function listajax($columns, $start, $length, $filter = "", $sort = "",
        $sorttype = "") {
        $i = 0;
        $this->db->select('
    tasks.*,
    userlist.user_username AS username_task_to,
    (SELECT user_username FROM userlist WHERE user_id = tasks.task_from) AS username_task_from,
    DATE_FORMAT(task_date,\'%d/%m/%Y\') AS task_date,
    DATE_FORMAT(task_duedate,\'%d/%m/%Y\') AS task_duedate,
    case task_status
    when \'1\' then \'On Going\'
    when \'2\' then \' KIV\'
    when \'3\' then \' Completed\'
    end as task_status', false);
        $this->db->where('task_deleted_at');
        $this->db->from('tasks');
        $this->db->join('userlist', 'userlist.user_id = tasks.task_to', 'left');

        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }

            $i++;
        }
        if ($sort != "") {
            $this->db->order_by($sort, $sorttype);
        } else {
            $this->db->order_by('tasks.task_id', 'DESC');
        }

        $this->db->limit($length, $start);
        $query       = $this->db->get();
        $queryResult = $query->result_array();
        return $queryResult;
    }

    public function recordsTotal()
    {
        $i = 0;
        $this->db->select('count(*) as recordstotal');
        $this->db->from('tasks');

        $this->db->where('task_deleted_at');
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function recordsFiltered($columns, $filter = "")
    {
        $i = 0;
        $this->db->select('count(*) as recordsfiltered');
        $this->db->from('tasks');

        $this->db->where('task_deleted_at');
        foreach ($columns as $column) {
            if ($i == 0) {
                $this->db->where("$column like", "%$filter%");
            } else {
                $this->db->or_where("$column like", "%$filter%");
            }
            $i++;
        }
        $query       = $this->db->get();
        $queryResult = $query->row();
        return $queryResult;
    }

    public function getchat($taskid)
    {
        $this->db->select('*', false);
        $this->db->order_by('taskchat_id', 'ASC');
        $this->db->where('task_id', $taskid);
        $this->db->from('taskchat');
        $this->db->join('userlist', 'userlist.user_id = taskchat.taskchat_memberid',
            'left');
        return $query = $this->db->get()->result();
    }

    public function insertchat($data)
    {
        $this->db->insert('taskchat', $data);
    }

    public function userinfo($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->from('userlist');
        return $query = $this->db->get()->row();
    }

    public function task_stat($id)
    {
        $query = $this->db->query("select count(*) as alltask, (select count(*) from tasks where task_to = $id and task_status = 3) as completed,(select count(*) from tasks where task_to = $id and task_status = 1) as ongoing, (select count(*) from tasks where task_to = $id and task_status = 2) as pending  from tasks where task_to = $id");
        return $query->row();
    }
}
/* End of file Refrace_model.php */
/* Location: ./application/models/Refrace_model.php */
