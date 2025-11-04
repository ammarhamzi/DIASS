<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Logging extends CI_Controller {

  function __construct() {
    //parent::__construct();
    $CI = & get_instance();
  $CI->load->library('session');
  }

    // Name of function same as mentioned in Hooks Config
    function logQueries() {


        $CI = & get_instance();
        //$filepath = APPPATH . 'logs/querylog-' . date('Ymd') . '.php';
        //$handle = fopen($filepath, "a+");

        $times = $CI->db->query_times;
        foreach ($CI->db->queries as $key => $query) {
            //if (strpos($query,'INSERT') !== false) {
            if (preg_match("/\binsert\b/i", $query)) {
            $log_action = 'Add New';
            }else if (preg_match("/\bupdate\b/i", $query)) {
            $log_action = 'Edit';
            }else if (preg_match("/\bdelete\b/i", $query)) {
            $log_action = 'Remove';
            //}else if (stripos($query,'SELECT') !== false) {
            //$log_action = 'Log-in';
            }else{
            $log_action = 'Display';
            }
            $sql = $query . " \n Execution Time:" . $times[$key];
            //fwrite($handle, $sql . "\n\n");
            $CI->db->insert('logging', array('user_id'=>$CI->session->userdata('id'),'string_query'=>$query, 'query_type'=>$log_action, 'executetime'=>$times[$key],'datetime_query'=>date('Y-m-d h:m:s')));
        }

        //fclose($handle);
    }

  

}
;
/* End of file Logging.php */
/* Location: ./application/controllers/Logging.php */