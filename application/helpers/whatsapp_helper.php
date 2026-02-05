<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WhatsApp Helper - Build inquiry URLs
 */
if (!function_exists('whatsapp_car_url')) {
    function whatsapp_car_url($car_name, $custom_message = NULL) {
        $CI =& get_instance();
        $CI->load->model('Setting_model');
        $template = $CI->Setting_model->get('whatsapp_message') ?: 'Hello, I am interested in this car: {item_name}. Please share more details.';
        $message = $custom_message ?: str_replace('{item_name}', $car_name, $template);
        return $CI->Setting_model->get_whatsapp_url($message);
    }
}

if (!function_exists('whatsapp_accessory_url')) {
    function whatsapp_accessory_url($accessory_name, $custom_message = NULL) {
        $CI =& get_instance();
        $CI->load->model('Setting_model');
        $message = $custom_message ?: "Hello, I am interested in this accessory: {$accessory_name}. Please share more details.";
        return $CI->Setting_model->get_whatsapp_url($message);
    }
}
