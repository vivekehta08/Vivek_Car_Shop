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

// Cars
$route['cars'] = 'cars/index';
$route['cars/(:num)'] = 'cars/index/$1';
$route['car/(:num)/(:any)'] = 'cars/detail/$1/$2';

// Accessories
$route['accessories'] = 'accessories/index';
$route['accessories/(:num)'] = 'accessories/index/$1';
$route['accessory/(:num)/(:any)'] = 'accessories/detail/$1/$2';
