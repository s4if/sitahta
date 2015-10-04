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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Custom Routing Starts Here
$route['siswa'] = 'admin/siswa/lihat';
$route['logout'] = '/login/logout';
$route['home'] = 'admin/home';
$route['home/password'] = 'admin/home/password';
$route['home/profil'] = 'admin/home/profil';
$route['guru'] = 'admin/guru/lihat';
$route['siswa'] = 'admin/siswa/lihat';
$route['siswa/kelas/(:any)'] = 'admin/siswa/lihat/$1';
$route['siswa/(:num)'] = 'admin/siswa/profil/$1';
$route['nilai'] = 'admin/nilai/lihat';
$route['nilai/(:any)'] = 'admin/nilai/lihat/$1';
$route['nilai/(:any)/(:num)'] = 'admin/nilai/lihat/$1/$2';
$route['nilai/(:any)/(:any)/(:num)'] = 'admin/nilai/lihat/$1/$2/$3';
$route['sertifikasi'] = 'admin/sertifikasi/lihat';
$route['sertifikasi/(:any)'] = 'admin/sertifikasi/lihat/$1';
$route['kurikulum'] = 'admin/kurikulum/lihat';
$route['kurikulum/(:any)'] = 'admin/kurikulum/lihat/$1';