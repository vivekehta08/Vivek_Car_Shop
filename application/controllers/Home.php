<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home Controller - Landing page
 */
class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Car_model');
        $this->load->model('Brand_model');
        $this->load->model('Banner_model');
        $this->load->model('Accessory_model');
    }

    public function index() {
        $this->load->model('Car_image_model');
        $this->load->model('Accessory_image_model');
        $this->data['banners'] = $this->Banner_model->get_active();
        $this->data['featured_cars'] = $this->Car_model->get_featured(8);
        $this->data['latest_cars'] = $this->Car_model->get_latest(8);
        foreach ($this->data['featured_cars'] as $c) {
            $p = $this->Car_image_model->get_primary($c->id);
            $c->primary_image = $p ? base_url($p->image_path) : 'https://via.placeholder.com/400x200?text=No+Image';
        }
        foreach ($this->data['latest_cars'] as $c) {
            $p = $this->Car_image_model->get_primary($c->id);
            $c->primary_image = $p ? base_url($p->image_path) : 'https://via.placeholder.com/400x200?text=No+Image';
        }
        $this->data['popular_brands'] = $this->Brand_model->get_popular(12);
        $this->data['featured_accessories'] = $this->Accessory_model->get_featured(6);
        foreach ($this->data['featured_accessories'] as $a) {
            $p = $this->Accessory_image_model->get_primary($a->id);
            $a->primary_image = $p ? base_url($p->image_path) : 'https://via.placeholder.com/300x200?text=Accessory';
        }
        $this->data['meta_title'] = $this->Setting_model->get('meta_title') ?: 'VivekCarShop - Buy & Sell Cars';
        $this->data['meta_description'] = $this->Setting_model->get('meta_description') ?: 'Find your perfect car. Browse new and used cars.';
        
        $this->load->view('layout/header', $this->data);
        $this->load->view('home/index', $this->data);
        $this->load->view('layout/footer', $this->data);
    }
}
