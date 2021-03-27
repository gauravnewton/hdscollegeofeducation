<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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



/**
 * User defined constants
 */

defined('SUPER_USER') OR define('SUPER_USER', 0);  //SUPER USER ROLE
defined('ROLE_ADMIN') OR define('ROLE_ADMIN', 1);    //ADMIN ROLE
defined('ROLE_DOWNLOAD') OR define('ROLE_DOWNLOAD', 2);  //DOWNLOAD ROLE
defined('ROLE_UPLOAD') OR define('ROLE_UPLOAD', 3);  //UPLOAD ROLE
defined('ROLE_DOWNLOAD_UPLOAD') OR define('ROLE_DOWNLOAD_UPLOAD', 4);    //DOWNLOAD AND UPLOAD ROLE

/**
 * user definedd Error code
 */

 defined('MISMATCH_FILE_TYPE') OR define('MISMATCH_FILE_TYPE', 600);
 defined('UNSUPPORTED_FILE_TYPE') OR define('UNSUPPORTED_FILE_TYPE', 605);
 defined('FILE_UPLOADING_ERROR') OR define('FILE_UPLOADING_ERROR', 604);
 defined('TEMPLATE_MISMATCH') OR define('TEMPLATE_MISMATCH', 606);
 defined('INVALID_SPREADSHEET') OR define('INVALID_SPREADSHEET',700);
 
/**
 * File formats
 */
defined('FILE_CSV') OR define('FILE_CSV', 1);
defined('FILE_XLS') OR define('FILE_XLS', 2);
defined('FILE_XLSX') OR define('FILE_XLSX', 3);

defined('CSV_EXT') OR define("CSV_EXT","CSV");
defined('XLS_EXT') OR define("XLS_EXT","XLS");
defined('XLSX_EXT') OR define("XLSX_EXT","XLSX");


defined('JPG') OR define("JPG","JPG");
defined('JPEG') OR define("JPEG","JPEG");
defined('PDF') OR define("PDF","PDF");
defined('PNG') OR define("PNG","PNG");

/**
 * Top level Main Menus
 */

defined('DASHBOARD') OR define('DASHBOARD', 'Dashboard');  
defined('USERS')  OR define ('USERS','Users');
defined('BRAND') OR define('BRAND','Brand');
defined('DOCUMENT') OR define('DOCUMENT','Batch');
defined('KEYWORDS') OR define('KEYWORDS','Keywords');
defined('REPORTS') OR define('REPORTS','Reports');
defined('API') OR define('API','API');
defined('RECORDS') OR define('RECORDS','Records');
defined('LOGS') OR define('LOGS','Logs');
defined('GALLERY') OR define('GALLERY', 'Gallery');
defined('GALLERYVIEUPLOAD') OR define('GALLERYVIEUPLOAD', 'Site Gallery');
defined('UPLOAD_PATH') OR define('UPLOAD_PATH','../../assets/uploads/');
defined('ALLOWED_WIDTH') OR define('ALLOWED_WIDTH',800);
defined('ALLOWED_HEIGHT') OR define('ALLOWED_HEIGHT',800);




/**
 * Level one Menus
 */

 defined('USER_SIGNUP') OR define('USER_SIGNUP','User Signup');
 defined('USER_LIST') OR define('USER_LIST','User List');
 defined('CREATE_BRAND') OR define('CREATE_BRAND', 'Create Brand');
 defined('BRAND_LIST') OR define('BRAND_LIST', 'Brand List');
 defined('DOCUMENT_UPLOAD') OR define('DOCUMENT_UPLOAD', 'Import Batch');
 defined('DOCUMENT_LIST') OR define('DOCUMENT_LIST', 'Batch List');
 defined('KEYWORDS_AIO') OR define('KEYWORDS_AIO', 'Keyword Management');
 defined('REPORT_VIEW') OR define('REPORT_VIEW', 'View');
 defined('API_MANAGEMENT') OR define('API_MANAGEMENT', 'API Management');
 defined('LIST_RECORDS') OR define('LIST_RECORDS', 'Records List');
 defined('LIST_LOGS') OR define('LIST_LOGS', 'List');
 defined('NOTIFICATIONS') OR define('NOTIFICATIONS','Notifications ');

 /**
  * Categories constants
  */
  
  defined('DUPLICATE_CATEGORY') OR define('DUPLICATE_CATEGORY', 1);
  defined('PROBABLE_BUSINESS') OR define('PROBABLE_BUSINESS', 2);
  defined('HOME_CATEGORY') OR define('HOME_CATEGORY', 3);
  defined('EDU_CATEGORY') OR define('EDU_CATEGORY', 4);
  defined('BUSINESS_CATEGORY') OR define('BUSINESS_CATEGORY', 5);
  defined('DISCARDED_CATEGORY') OR define('DISCARDED_CATEGORY', 6);
  defined('PHONE_API_RESPONSE_ERROR') OR define('PHONE_API_RESPONSE_ERROR',7);
  defined('EMAIL_API_RESPONSE_ERROR') OR define('EMAIL_API_RESPONSE_ERROR',8);
  defined('FREE_MAILS') OR define('FREE_MAILS',9);
  defined('EDU_DOMAIN') OR define('EDU_DOMAIN', 10);
  defined('NOTIFICATION_MANAGEMENT') OR define('NOTIFICATION_MANAGEMENT','Manage Notifications');

  /**
   * API HOOK TYPE
   */

   defined('HOOK_TYPE_CLEAROUT') OR define('HOOK_TYPE_CLEAROUT', 1);
   defined('HOOK_TYPE_CLEARPHONE') OR define('HOOK_TYPE_CLEARPHONE', 2);   
   defined('HOOK_TYPE_BUSINESS') OR define('HOOK_TYPE_BUSINESS', 3);
   defined('HOOK_TYPE_EDU_FREE_MAIL') OR define('HOOK_TYPE_EDU_FREE_MAIL', 4);
   defined('HOOK_TYPE_EDU') OR define('HOOK_TYPE_EDU', 5);
   defined('HOOK_TYPE_HOME') OR define('HOOK_TYPE_HOME', 6);
   defined('HOOK_TYPE_RESEARCH_TASK') OR define('HOOK_TYPE_RESEARCH_TASK', 7);
   defined('HOOK_TYPE_CALL_TASK') OR define('HOOK_TYPE_CALL_TASK', 8);

  