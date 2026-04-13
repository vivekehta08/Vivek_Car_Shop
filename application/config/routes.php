<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'errors/page_missing';
$route['translate_uri_dashes'] = TRUE;

// Admin routes
$route['admin'] = 'admin/auth/login';
$route['admin/login'] = 'admin/auth/login';
$route['admin/logout'] = 'admin/auth/logout';
$route['admin/dashboard'] = 'admin/dashboard/index';

// User auth
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['account'] = 'auth/account';

// Accessories
$route['accessories'] = 'accessories/index';
$route['accessories/(:num)'] = 'accessories/index/$1';
$route['accessory/(:num)/(:any)'] = 'accessories/detail/$1/$2';

// Cars
$route['cars'] = 'cars/index';
$route['cars/(:num)'] = 'cars/index/$1';
$route['car/(:num)/(:any)'] = 'cars/detail/$1/$2';


// ================= ADMIN (MUST BE ABOVE GENERIC) =================
$route['admin/cars/models-by-brand'] = 'admin/cars/models_by_brand';

$route['admin/cars/create'] = 'admin/cars/create';
$route['admin/cars/store'] = 'admin/cars/store';

$route['admin/cars/edit/(:num)'] = 'admin/cars/edit/$1';
$route['admin/cars/update/(:num)'] = 'admin/cars/update/$1';

$route['admin/cars/delete/(:num)'] = 'admin/cars/delete/$1';
$route['admin/cars/delete-image/(:num)'] = 'admin/cars/delete_image/$1';

$route['admin/cars/index/(:num)'] = 'admin/cars/index/$1';
$route['admin/cars'] = 'admin/cars/index';

$route['admin/accessories/create'] = 'admin/accessories/create';
$route['admin/accessories/store'] = 'admin/accessories/store';
$route['admin/accessories/edit/(:num)'] = 'admin/accessories/edit/$1';
$route['admin/accessories/update/(:num)'] = 'admin/accessories/update/$1';
$route['admin/accessories/delete/(:num)'] = 'admin/accessories/delete/$1';
$route['admin/accessories/delete-image/(:num)'] = 'admin/accessories/delete_image/$1';

$route['admin/accessories/index/(:num)'] = 'admin/accessories/index/$1';
$route['admin/accessories'] = 'admin/accessories/index';
        
