<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Production
$config['smtp_from_email'] = "mahb-no-reply@malaysiaairports.com.my";
$config['protocol'] = "smtp";
$config['smtp_host'] = "172.18.60.203";
$config['smtp_port'] = "25";
$config['smtp_user'] = "";
$config['smtp_pass'] = "";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";   //added on 30-04-2021 to able send email in html format

