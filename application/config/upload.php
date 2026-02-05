<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Upload paths for car and accessory images
*/
$config['upload_path'] = FCPATH . 'uploads/';
$config['car_images_path'] = 'uploads/cars/';
$config['car_thumb_path'] = 'uploads/cars/thumbnails/';
$config['accessory_images_path'] = 'uploads/accessories/';
$config['brand_logos_path'] = 'uploads/brands/';
$config['banners_path'] = 'uploads/banners/';
$config['logo_path'] = 'uploads/';

$config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
$config['max_size'] = 5120; // 5MB
$config['max_width'] = 4096;
$config['max_height'] = 4096;
