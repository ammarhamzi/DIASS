<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['profiler'] = FALSE;
$config['title'] = 'DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM'; 
$config['apps_type'] = 'web';// web, json
$config['dblog'] = TRUE;
$config['dbconfig_identifier'] = 'admin'; // untuk identify config untuk part admin atau user jika gunakan 2 app berlainan.
//$config['client_url'] = 'http://diass.pic';
$config['client_url'] = 'http://localhost:8990';
$config['theme_url'] = 'http://localhost:8990';