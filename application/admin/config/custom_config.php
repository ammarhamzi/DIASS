<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['profiler'] = FALSE;
$config['title'] = 'DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM'; 
$config['apps_type'] = 'web';// web, json
$config['dblog'] = TRUE;
$config['dbconfig_identifier'] = 'admin'; // untuk identify config untuk part admin atau user jika gunakan 2 app berlainan.
// Local development URLs
$config['client_url'] = 'http://localhost';
$config['theme_url'] = 'http://localhost/admin';
// Production URLs (commented out)
//$config['client_url'] = 'https://diass.malaysiaairports.com.my';
//$config['theme_url'] = 'https://diass.malaysiaairports.com.my';
