<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Inquiry Controller - Log car/accessory inquiries and get WhatsApp URL
 */
class Inquiry extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Inquiry_model');
        $this->load->model('Setting_model');
        $this->load->model('Car_model');
        $this->load->model('Accessory_model');
    }

    /**
     * Log inquiry and return WhatsApp URL (AJAX)
     */
    public function log_car() {
        $car_id = (int) $this->input->post('car_id');
        $car = $this->Car_model->get($car_id); // CI loads as Car_model
        if (!$car) {
            echo json_encode(array('success' => FALSE, 'url' => '#'));
            return;
        }
        
        $car_name = $car->brand_name . ' ' . $car->model_name . ($car->variant ? ' ' . $car->variant : '');
        $message = "Hello, I am interested in this car: {$car_name}. Please share more details.";
        
        $data = array(
            'type' => 'car',
            'car_id' => $car_id,
            'customer_name' => $this->input->post('name') ?: 'Visitor',
            'customer_phone' => $this->input->post('phone') ?: '',
            'customer_email' => $this->input->post('email') ?: '',
            'message' => $message,
            'user_id' => $this->session->userdata('user_id') ?: NULL,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
        );
        $this->Inquiry_model->create($data);
        
        $url = $this->Setting_model->get_whatsapp_url($message);
        echo json_encode(array('success' => TRUE, 'url' => $url));
    }

    /**
     * Log accessory inquiry
     */
    public function log_accessory() {
        $accessory_id = (int) $this->input->post('accessory_id');
        $accessory = $this->Accessory_model->get($accessory_id);
        if (!$accessory) {
            echo json_encode(array('success' => FALSE, 'url' => '#'));
            return;
        }
        
        $message = "Hello, I am interested in this accessory: {$accessory->name}. Please share more details.";
        
        $data = array(
            'type' => 'accessory',
            'accessory_id' => $accessory_id,
            'customer_name' => $this->input->post('name') ?: 'Visitor',
            'customer_phone' => $this->input->post('phone') ?: '',
            'customer_email' => $this->input->post('email') ?: '',
            'message' => $message,
            'user_id' => $this->session->userdata('user_id') ?: NULL,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
        );
        $this->Inquiry_model->create($data);
        
        $url = $this->Setting_model->get_whatsapp_url($message);
        echo json_encode(array('success' => TRUE, 'url' => $url));
    }
}
