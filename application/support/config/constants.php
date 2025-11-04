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
| SPECIAL ADMIN LOGIN SETTING
|--------------------------------------------------------------------------
|
| list of special username for admin login
|
*/
defined('_LOGIN_SPECIAL_PASSWORD') OR define('_LOGIN_SPECIAL_PASSWORD', '["CJbbU-yk=V2m", "j@m#@a~w0dXv", "32tKM#~sAI2K"]');



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

defined('_PIC_URL')			OR define('_PIC_URL', 'http://diass.pic.karyastaging.com/');
/* timeline */
define('ATTEND_BRIEFING_ADP','Attend briefing');
define('ATTEND_BRIEFING_ADP_DESC','Admin Licensing validates the presence of the candidate');
define('ATTEND_BRIEFING_EVDP','Attend briefing');
define('ATTEND_BRIEFING_EVDP_DESC','Terminal admin validates the presence of the candidate');
define('PERMIT_APPROVED_ADP','ADP permit approved');
define('PERMIT_APPROVED_ADP_DESC','Pending for the payment');
define('PERMIT_APPROVED_EVDP','EVDP permit approved');
define('PERMIT_APPROVED_EVDP_DESC','Pending for the payment');
define('PERMIT_APPROVED_AVP','AVP permit approved');
define('PERMIT_APPROVED_AVP_DESC','Pending for the payment');
define('PERMIT_APPROVED_EVP','EVP permit approved');
define('PERMIT_APPROVED_EVP_DESC','Pending for the payment');

define('PERMIT_REJECTED_ADP','ADP permit rejected');
define('PERMIT_REJECTED_ADP_DESC','PIC needs to apply a new ADP permit');
define('PERMIT_REJECTED_EVDP','EVDP permit rejected');
define('PERMIT_REJECTED_EVDP_DESC','PIC needs to apply a new EVDP permit');
define('PERMIT_REJECTED_AVP','AVP permit rejected');
define('PERMIT_REJECTED_AVP_DESC','PIC needs to apply a new AVP permit');
define('PERMIT_REJECTED_EVP','EVP permit rejected');
define('PERMIT_REJECTED_EVP_DESC','PIC needs to apply a new EVP permit');
define('DOCUMENTS_VERIFIED_ADP','Documents verified' );
define('BRIEFING_CONFIRMED_ADP','Briefing confirmed. Please ensure the driver attend the briefing session' );
define('EXAM_CONFIRMED_ADP','Exam confirmed. Please ensure the driver complete the examination' );
define('DOCUMENTS_VERIFIED_EVDP','Documents verified' );
define('BRIEFING_CONFIRMED_EVDP','Terminal briefing confirmed.  Please ensure the driver attend the briefing session' );

define('DOCUMENTS_VERIFIED_AVP','Documents verified' );
define('INSPECTION_CONFIRMED_AVP','Vehicle is required to send for inspection' );
define('INSPECTION_PASSED_AVP','Inspection passed' );
define('INSPECTION_PASSED_AVP_DESC','Inspection requires verification by Mechanical Engineer' );
define('INSPECTION_FAILED_AVP','Inspection failed' );
define('INSPECTION_FAILED_AVP_DESC','PIC needs to apply a new AVP permit' );
define('INSPECTION_KIV_AVP','Inspection on hold' );
define('INSPECTION_KIV_AVP_DESC','Inspection on hold. Requires rectification by PIC' );
define('MANAGERINSPECTION_PASSED_AVP','Inspection passed (engineer)' );
define('MANAGERINSPECTION_FAILED_AVP','Inspection failed (engineer)' );
define('MANAGERINSPECTION_PASSED_AVP_DESC','Verified by Mechanical Engineer' );
define('MANAGERINSPECTION_FAILED_AVP_DESC','Unverified by Mechanical Engineer' );

define('DOCUMENTS_VERIFIED_EVP','Documents verified' );
define('INSPECTION_CONFIRMED_EVP','Vehicle is required to send for inspection' );
define('INSPECTION_PASSED_EVP','Inspection passed' );
define('INSPECTION_PASSED_EVP_DESC','Inspection requires verification by Mechanical Engineer' );
define('INSPECTION_FAILED_EVP','Inspection failed' );
define('INSPECTION_FAILED_EVP_DESC','PIC needs to apply a new EVP permit' );
define('INSPECTION_KIV_EVP','Inspection on hold' );
define('INSPECTION_KIV_EVP_DESC','Inspection on hold. Requires rectification by PIC' );
define('MANAGERINSPECTION_PASSED_EVP','Inspection passed (engineer)' );
define('MANAGERINSPECTION_FAILED_EVP','Inspection failed (engineer)' );
define('MANAGERINSPECTION_PASSED_EVP_DESC','Verified by Mechanical Engineer' );
define('MANAGERINSPECTION_FAILED_EVP_DESC','Unverified by Mechanical Engineer' );

define('PAID_IN_FULL_ADP','Paid');
define('READY_COLLECT_ADP','ADP ready for collection' );
define('PAID_IN_FULL_EVDP','Paid');
define('READY_COLLECT_EVDP','EVDP ready for collection' );
define('PAID_IN_FULL_AVP','Paid');
define('READY_COLLECT_AVP','AVP ready for collection' );
define('PAID_IN_FULL_EVP','Paid');
define('READY_COLLECT_EVP','EVP ready for collection' );

define('PERMIT_PRINTOUT_ADP','Completed');
define('PERMIT_PRINTOUT_ADP_DESC','ADP permit printed & collected' );
define('PERMIT_PRINTOUT_EVDP','Completed');
define('PERMIT_PRINTOUT_EVDP_DESC','EVDP permit printed & collected' );
define('PERMIT_PRINTOUT_AVP','Completed');
define('PERMIT_PRINTOUT_AVP_DESC','AVP permit printed & collected' );
define('PERMIT_PRINTOUT_EVP','Completed');
define('PERMIT_PRINTOUT_EVP_DESC','EVP permit printed & collected' );



define('ATTEND_BRIEFING_PBB','Assessment Passed');
define('ATTEND_BRIEFING_PBB_DESC','PBB operator pass the assessment');
define('ATTEND_BRIEFING_PBB_FAIL','Assessment Failed');
define('ATTEND_BRIEFING_PBB_FAIL_DESC','PBB operator fail the assessment');
define('PERMIT_APPROVED_PBB','PBB permit approved');
define('PERMIT_APPROVED_PBB_DESC','Pending for the payment');
define('PERMIT_REJECTED_PBB','PBB permit rejected');
define('PERMIT_REJECTED_PBB_DESC','PIC needs to apply a new PBB permit');
define('DOCUMENTS_VERIFIED_PBB','Documents verified' );
define('BRIEFING_CONFIRMED_PBB','PBB briefing confirmed. Driver need to attend the briefing' );
define('PAID_IN_FULL_PBB','Paid');
define('READY_COLLECT_PBB','PBB ready for collection' );
define('PERMIT_PRINTOUT_PBB','Completed');
define('PERMIT_PRINTOUT_PBB_DESC','PBB permit printed & collected' );
define('ATTEND_BRIEFING_SH','Attend briefing');
define('ATTEND_BRIEFING_SH_DESC','Sh admin validate the presence of the candidate');
define('PERMIT_APPROVED_SH','SH permit approved');
define('PERMIT_APPROVED_SH_DESC','Pending for the payment');
define('PERMIT_REJECTED_SH','SH permit rejected');
define('PERMIT_REJECTED_SH_DESC','PIC needs to apply a new SH permit');
define('DOCUMENTS_VERIFIED_SH','Documents verified' );
define('BRIEFING_CONFIRMED_SH','Sh briefing confirmed. Driver need to attend the briefing' );
define('PAID_IN_FULL_SH','Paid');
define('READY_COLLECT_SH','SH ready for collection' );
define('PERMIT_PRINTOUT_SH','Completed');
define('PERMIT_PRINTOUT_SH_DESC','SH permit printed & collected' );
define('ATTEND_BRIEFING_VDGS','Attend briefing');
define('ATTEND_BRIEFING_VDGS_DESC','VDGS admin validate the presence of the candidate');
define('PERMIT_APPROVED_VDGS','VDGS permit approved');
define('PERMIT_APPROVED_VDGS_DESC','Pending for the payment');
define('PERMIT_REJECTED_VDGS','VDGS permit rejected');
define('PERMIT_REJECTED_VDGS_DESC','PIC needs to apply a new VDGS permit');
define('DOCUMENTS_VERIFIED_VDGS','Documents verified' );
define('BRIEFING_CONFIRMED_VDGS','VDGS briefing confirmed. Driver need to attend the briefing' );
define('PAID_IN_FULL_VDGS','Paid');
define('READY_COLLECT_VDGS','VDGS ready for collection' );
define('PERMIT_PRINTOUT_VDGS','Completed');
define('PERMIT_PRINTOUT_VDGS_DESC','VDGS permit printed & collected' );
define('ATTEND_BRIEFING_CS','Attend briefing');
define('ATTEND_BRIEFING_CS_DESC','Cs admin validate the presence of the candidate');
define('PERMIT_APPROVED_CS','CS permit approved');
define('PERMIT_APPROVED_CS_DESC','Pending for the payment');
define('PERMIT_REJECTED_CS','CS permit rejected');
define('PERMIT_REJECTED_CS_DESC','PIC needs to apply a new CS permit');
define('DOCUMENTS_VERIFIED_CS','Documents verified' );
define('BRIEFING_CONFIRMED_CS','Cs briefing confirmed. Driver need to attend the briefing' );
define('PAID_IN_FULL_CS','Paid');
define('READY_COLLECT_CS','CS ready for collection' );
define('PERMIT_PRINTOUT_CS','Completed');
define('PERMIT_PRINTOUT_CS_DESC','CS permit printed & collected' );
define('ATTEND_BRIEFING_GPU','Attend briefing');
define('ATTEND_BRIEFING_GPU_DESC','Gpu admin validate the presence of the candidate');
define('PERMIT_APPROVED_GPU','GPU permit approved');
define('PERMIT_APPROVED_GPU_DESC','Pending for the payment');
define('PERMIT_REJECTED_GPU','GPU permit rejected');
define('PERMIT_REJECTED_GPU_DESC','PIC needs to apply a new GPU permit');
define('DOCUMENTS_VERIFIED_GPU','Documents verified' );
define('BRIEFING_CONFIRMED_GPU','Gpu briefing confirmed. Driver need to attend the briefing' );
define('PAID_IN_FULL_GPU','Paid');
define('READY_COLLECT_GPU','GPU ready for collection' );
define('PERMIT_PRINTOUT_GPU','Completed');
define('PERMIT_PRINTOUT_GPU_DESC','GPU permit printed & collected' );
define('ATTEND_BRIEFING_PCA','Attend briefing');
define('ATTEND_BRIEFING_PCA_DESC','Pca admin validate the presence of the candidate');
define('PERMIT_APPROVED_PCA','PCA permit approved');
define('PERMIT_APPROVED_PCA_DESC','Pending for the payment');
define('PERMIT_REJECTED_PCA','PCA permit rejected');
define('PERMIT_REJECTED_PCA_DESC','PIC needs to apply a new PCA permit');
define('DOCUMENTS_VERIFIED_PCA','Documents verified' );
define('BRIEFING_CONFIRMED_PCA','Pca briefing confirmed. Driver need to attend the briefing' );
define('PAID_IN_FULL_PCA','Paid');
define('READY_COLLECT_PCA','PCA ready for collection' );
define('PERMIT_PRINTOUT_PCA','Completed');
define('PERMIT_PRINTOUT_PCA_DESC','PCA permit printed & collected' );

define('PERMIT_APPROVED_WIP','WIP permit approved');
define('PERMIT_APPROVED_WIP_DESC','Pending for the payment');
define('PERMIT_REJECTED_WIP','WIP permit rejected');
define('PERMIT_REJECTED_WIP_DESC','PIC needs to apply a new WIP permit');
define('DOCUMENTS_VERIFIED_WIP','Documents verified' );
define('INSPECTION_CONFIRMED_WIP','Vehicle need to do inspection' );
define('INSPECTION_PASSED_WIP','Inspection passed' );
define('INSPECTION_PASSED_WIP_DESC','Need to verify by Mechanical Engineer' );
define('INSPECTION_FAILED_WIP','Inspection failed' );
define('INSPECTION_FAILED_WIP_DESC','PIC needs to apply a new WIP permit' );
define('INSPECTION_KIV_WIP','Inspection on hold' );
define('INSPECTION_KIV_WIP_DESC','Inspection on hold. Requires rectification by PIC' );
define('MANAGERINSPECTION_PASSED_WIP','Inspection passed (engineer)' );
define('MANAGERINSPECTION_FAILED_WIP','Inspection failed (engineer)' );
define('MANAGERINSPECTION_PASSED_WIP_DESC','Verified by Mechanical Engineer' );
define('MANAGERINSPECTION_FAILED_WIP_DESC','Unverified by Mechanical Engineer' );
define('PAID_IN_FULL_WIP','Paid');
define('READY_COLLECT_WIP','WIP ready for collection' );
define('PERMIT_PRINTOUT_WIP','Completed');
define('PERMIT_PRINTOUT_WIP_DESC','WIP permit printed & collected' );

define('PERMIT_APPROVED_SHINS','SHINS permit approved');
define('PERMIT_APPROVED_SHINS_DESC','Pending for the payment');
define('PERMIT_REJECTED_SHINS','SHINS permit rejected');
define('PERMIT_REJECTED_SHINS_DESC','PIC needs to apply a new SHINS permit');
define('DOCUMENTS_VERIFIED_SHINS','Documents verified' );
define('INSPECTION_CONFIRMED_SHINS','Vehicle need to do inspection' );
define('INSPECTION_PASSED_SHINS','Inspection passed' );
define('INSPECTION_PASSED_SHINS_DESC','Need to verify by Mechanical Engineer' );
define('INSPECTION_FAILED_SHINS','Inspection failed' );
define('INSPECTION_FAILED_SHINS_DESC','PIC needs to apply a new SHINS permit' );
define('INSPECTION_KIV_SHINS','Inspection on hold' );
define('INSPECTION_KIV_SHINS_DESC','Inspection on hold. Requires rectification by PIC' );
define('MANAGERINSPECTION_PASSED_SHINS','Inspection passed (engineer)' );
define('MANAGERINSPECTION_FAILED_SHINS','Inspection failed (engineer)' );
define('MANAGERINSPECTION_PASSED_SHINS_DESC','Verified by Mechanical Engineer' );
define('MANAGERINSPECTION_FAILED_SHINS_DESC','Unverified by Mechanical Engineer' );
define('PAID_IN_FULL_SHINS','Paid');
define('READY_COLLECT_SHINS','SHINS ready for collection' );
define('PERMIT_PRINTOUT_SHINS','Completed');
define('PERMIT_PRINTOUT_SHINS_DESC','SHINS permit printed & collected' );

define('ATTEND_BRIEFING_WIPBRIEFING','Attend briefing');
define('ATTEND_BRIEFING_WIPBRIEFING_DESC','Wipbriefing admin validate the presence of the candidate');
define('PERMIT_APPROVED_WIPBRIEFING','WIPBRIEFING permit approved');
define('PERMIT_APPROVED_WIPBRIEFING_DESC','Pending for the payment');
define('PERMIT_REJECTED_WIPBRIEFING','WIPBRIEFING permit rejected');
define('PERMIT_REJECTED_WIPBRIEFING_DESC','PIC needs to apply a new WIPBRIEFING permit');
define('DOCUMENTS_VERIFIED_WIPBRIEFING','Documents verified' );
define('BRIEFING_CONFIRMED_WIPBRIEFING','Wipbriefing briefing confirmed. Driver need to attend the briefing' );
define('PAID_IN_FULL_WIPBRIEFING','Paid');
define('READY_COLLECT_WIPBRIEFING','WIPBRIEFING ready for collection' );
define('PERMIT_PRINTOUT_WIPBRIEFING','Completed');
define('PERMIT_PRINTOUT_WIPBRIEFING_DESC','WIPBRIEFING permit printed & collected' );

define('PERMIT_TERMINATED','Permit terminated');
define('PERMIT_TERMINATED_DESC','Permit successfully terminated');
define('PERMIT_TERMINATE_REJECTED','Permit termination rejected');
define('PERMIT_TERMINATE_REJECTED_DESC','Permit termination request rejected');

define('PERMIT_REPLACED_PAYMENT','Permit replacement successfully');
define('PERMIT_REPLACED_PAYMENT_DESC','Waiting for the payment');
define('PERMIT_REPLACE_REJECTED','Permit replacement rejected');
define('PERMIT_REPLACE_REJECTED_DESC','Permit replacement request rejected');
