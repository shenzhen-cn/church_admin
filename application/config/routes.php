<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//smqntq 
$route['default_controller']   = 'login';

//for  home
$route['uploadCourse'] 		   = 'priest_preach/uploadCourse';

$route['look_volume']          = 'Bibile/look_volume';
$route['onlineBibile']         = 'Bibile/onlineBibile';
$route['wall_for_photos']      = 'Fellowship_life/wall_for_photos';


$route['seeMember']   		   = 'Group/seeMember';

$route['read'] 				   = 'priest_preach/pp_read';
$route['PP_add'] 			   = 'priest_preach/PP_add';
$route['myEdit']   	           = 'priest_preach/myEdit';
$route['read_myEdit']   	   = 'priest_preach/read_myEdit';


$route['add_today_scriptures'] 	   = 'Homesetting/add_today_scriptures';
$route['urgentPrayer'] 		   = 'Homesetting/urgentPrayer';
$route['noticeGroup'] 		   = 'Homesetting/noticeGroup';

$route['setPersonalData']      = 'personal/setPersonalData';

$route['add_personal']          = 'Personal/add_personal';
$route['user_registered']      = 'Personal/user_registered';
$route['forgetpassword']   	   = 'Resetpassword/forgetpassword';
$route['resetPwd']             = 'login/reset_pwd_for_forget';





