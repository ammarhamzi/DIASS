<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| LOGIN SETTING   
|--------------------------------------------------------------------------
|
| - PRODUCTION
|	: This method will use LDAP function to login for all admin and partial ASP.
| - STAGING
| 	: This method will only use local login to our local database.
| Please use capital letter.
|
*/
defined('_LOGIN_METHOD') OR define('_LOGIN_METHOD', 'PRODUCTION');

/*
|--------------------------------------------------------------------------
| LDAP SETTING
|--------------------------------------------------------------------------
|
| LDAP variable config
|
*/
defined('_LDAP_HOST') OR define('_LDAP_HOST', '172.18.60.77');
defined('_LDAP_DN') OR define('_LDAP_DN', 'OU=ALL USERS,DC=malaysiaairports,DC=com,DC=my');
defined('_LDAP_USR_DOM') OR define('_LDAP_USR_DOM', '@malaysiaairports.com.my');



/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* timeline status */
define('PIC_SUBMIT_ADP','PIC submited ADP application');
define('AIRSIDE_ADMIN_CHECK_DOCS_ADP','Admin Licensing will validate the submitted documents');
define('PIC_SUBMIT_EVDP','PIC submited EVDP application');
define('TERMINAL_ADMIN_CHECK_DOCS_EVDP','Terminal admin will validate the submitted documents');
define('PIC_SUBMIT_AVP','PIC submited AVP application');
define('MTW_ADMIN_CHECK_DOCS_AVP','Inspector will validate the submitted documents');
define('PIC_SUBMIT_EVP','PIC submited EVP application');
define('MTW_ADMIN_CHECK_DOCS_EVP','Inspector will validate the submitted documents');
define('CANCEL_PERMIT','PIC cancelled the permit');
define('CANCEL_PERMIT_DESC','PIC cancelled permit application');
define('TERMINATE_PERMIT','PIC terminated the permit');
define('TERMINATE_PERMIT_DESC','PIC requested to terminate permit');
define('REPLACE_PERMIT','PIC replaced permit');
define('REPLACE_PERMIT_DESC','PIC requested for replacement');

define('PIC_SUBMIT_PBB','PIC submited PBB application');
define('PBB_ADMIN_CHECK_DOCS_PBB','PBB admin will validate the submitted documents');
define('PIC_SUBMIT_SH','PIC submited SH application');
define('SH_ADMIN_CHECK_DOCS_SH','Sh admin will validate the submitted documents');
define('PIC_SUBMIT_VDGS','PIC submited VDGS application');
define('VDGS_ADMIN_CHECK_DOCS_VDGS','Vdgs admin will validate the submitted documents');
define('PIC_SUBMIT_CS','PIC submited CS application');
define('CS_ADMIN_CHECK_DOCS_CS','CS admin will validate the submitted documents');
define('PIC_SUBMIT_GPU','PIC submited GPU application');
define('GPU_ADMIN_CHECK_DOCS_GPU','GPU admin will validate the submitted documents');
define('PIC_SUBMIT_PCA','PIC submited PCA application');
define('PCA_ADMIN_CHECK_DOCS_PCA','PCA admin will validate the submitted documents');
define('PIC_SUBMIT_WIP','PIC submited WIP application');
define('MTW_ADMIN_CHECK_DOCS_WIP','Inspector will validate the submitted documents');

define('PIC_SUBMIT_SHINS','PIC submited SHINS application');
define('MTW_ADMIN_CHECK_DOCS_SHINS','Inspector will validate the submitted documents');

define('PIC_SUBMIT_WIPBRIEFING','PIC submited WIPBRIEFING application');
define('WIPBRIEFING_ADMIN_CHECK_DOCS_WIPBRIEFING','Wipbriefing admin will validate the submitted documents');

define('_ACCEPT_FILE_TYPE','.jpg,.jpeg,.png,.pdf,.ppt,.pptx,.doc,.docx');

define('EXAM_COMPULSORY_COUNT', 1);
define('EXAM_NEW_TIMELIMIT', 45);
define('EXAM_RENEW_TIMELIMIT', 30);
define('EXAM_NEW_NONCOMPULSORY_COUNT', 39);
define('EXAM_RENEW_NONCOMPULSORY_COUNT', 19);
define('EXAM_NEW_CATEGORY1_COUNT', 5);
define('EXAM_RENEW_CATEGORY1_COUNT', 5);
define('EXAM_NEW_CATEGORY2_COUNT', 20);
define('EXAM_RENEW_CATEGORY2_COUNT', 8);
define('EXAM_NEW_CATEGORY3_COUNT', 15);
define('EXAM_RENEW_CATEGORY3_COUNT', 7);
define('EXAM_ALLOWED_IP', [
    '127.0.0.1',
    '172.18.60.41',
    '172.18.32.186',
    '172.18.32.187',
    '172.18.32.188',
    '172.18.32.189',
    '172.18.32.190',
    '172.18.32.191',
    '172.18.32.192',
    '172.18.32.193',
    '172.18.32.194',
    '172.18.32.195',
    '172.18.32.196',
    '172.18.32.197',
    '172.18.32.198',
    '10.40.20.130',
    '10.40.20.131',
    '10.40.20.132',
    '10.40.20.133',
    '10.40.20.134',
    '10.40.20.135',
    '10.40.20.136'
]);