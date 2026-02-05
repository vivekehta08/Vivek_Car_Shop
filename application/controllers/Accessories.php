<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Accessories Controller
 */
class Accessories extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accessory_model');
        $this->load->model('Accessory_image_model');
        $this->load->model('Accessory_category_model');
        $this->load->model('Brand_model');
        $this->load->model('Car_model_model');
    }

    public function index($page = 1) {
        $per_page = 12;
        $filters = array(
            'category_id' => $this->input->get('category'),
            'brand_id' => $this->input->get('brand'),
            'model_id' => $this->input->get('model'),
            'min_price' => $this->input->get('min_price'),
            'max_price' => $this->input->get('max_price'),
            'keyword' => $this->input->get('keyword'),
        );
        
        $total = $this->Accessory_model->count_list($filters);
        $offset = ($page - 1) * $per_page;
        
        $this->data['accessories'] = $this->Accessory_model->get_list($filters, $per_page, $offset);
        foreach ($this->data['accessories'] as $a) {
            $p = $this->Accessory_image_model->get_primary($a->id);
            $a->primary_image = $p ? base_url($p->image_path) : 'https://via.placeholder.com/300x200?text=Accessory';
        }
        $this->data['filters'] = $filters;
        $this->data['total'] = $total;
        $this->data['page'] = $page;
        $this->data['total_pages'] = ceil($total / $per_page);
        $this->data['categories'] = $this->Accessory_category_model->get_all();
        $this->data['meta_title'] = 'Car Accessories - ' . $this->data['site_name'];
        
        if (!empty($filters['brand_id'])) {
            $this->data['models'] = $this->Car_model_model->get_by_brand($filters['brand_id']);
        } else {
            $this->data['models'] = array();
        }
        
        $this->load->view('layout/header', $this->data);
        $this->load->view('accessories/listing', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function detail($id, $slug = '') {
        $accessory = $this->Accessory_model->get($id);
        if (!$accessory || !$accessory->is_available) {
            show_404();
        }
        
        $this->data['accessory'] = $accessory;
        $this->data['images'] = $this->Accessory_image_model->get_by_accessory($id);
        $this->data['whatsapp_url'] = whatsapp_accessory_url($accessory->name);
        $this->data['meta_title'] = $accessory->name . ' - ' . $this->data['site_name'];
        
        $this->load->view('layout/header', $this->data);
        $this->load->view('accessories/detail', $this->data);
        $this->load->view('layout/footer', $this->data);
    }
}
