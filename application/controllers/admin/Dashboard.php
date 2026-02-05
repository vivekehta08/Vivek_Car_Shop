<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Dashboard
 */
class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Car_model');
        $this->load->model('Accessory_model');
        $this->load->model('Inquiry_model');
        $this->load->model('User_model');
    }

    public function index() {
        $this->data['total_cars'] = $this->db->where('status', 'approved')->count_all_results('cars');
        $this->data['pending_cars'] = $this->db->where('status', 'pending')->count_all_results('cars');
        $this->data['total_accessories'] = $this->db->where('is_available', 1)->count_all_results('accessories');
        $this->data['total_inquiries'] = $this->Inquiry_model->count_list();
        $this->data['total_users'] = $this->User_model->count_all();
        $this->data['recent_inquiries'] = $this->Inquiry_model->get_list(array(), 10);
        $this->data['title'] = 'Dashboard';
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/dashboard', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }
}
