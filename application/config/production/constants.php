<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/* Paging */

define('DEFAULT_PAGE', 1);
define('DEFAULT_LIMIT', 10);


/* define API BASE URL */

define('API_BASE_LINK', 'http://192.168.1.123/church_dev/tq_api/index.php/');
define('ROLE_USER_PHOTOS_URL', 'http://192.168.1.123/church_dev/tq_user/');


define('ROLE_FILE_PRIEST_PREACH_BASE_URL', 'http://192.168.1.123/church_dev/tq_admin/public/uploads/files/course_ppt/');

define('ROLE_USER_HEAD_BASE_SRC', 'http://192.168.1.123/church_dev/tq_user/public/uploads/userHeadsrc/');


define('YES_FLAG', 'Y');
define('NO_FLAG', 'N');

$ajax_request = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? TRUE : FALSE;
define('IS_AJAX', $ajax_request);
unset($ajax_request);


/* End of file constants.php */
/* Location: ./application/config/constants.php */
