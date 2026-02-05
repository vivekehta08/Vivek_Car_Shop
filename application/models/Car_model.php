<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Car Model - Main car listings (named Car_model to match table cars)
 * Note: Use Car_model_model for car_models table
 */
class Car_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get cars with filters and pagination
     */
    public function get_list($filters = array(), $limit = 12, $offset = 0, $order_by = 'created_at', $order_dir = 'DESC') {
        $this->db->select('cars.*, brands.name as brand_name, brands.slug as brand_slug, car_models.name as model_name, car_models.slug as model_slug, cities.name as city_name, fuel_types.name as fuel_type, transmission_types.name as transmission');
        $this->db->from('cars');
        $this->db->join('brands', 'brands.id = cars.brand_id');
        $this->db->join('car_models', 'car_models.id = cars.model_id');
        $this->db->join('cities', 'cities.id = cars.city_id');
        $this->db->join('fuel_types', 'fuel_types.id = cars.fuel_type_id');
        $this->db->join('transmission_types', 'transmission_types.id = cars.transmission_id');
        $this->db->where('cars.status', 'approved');

        // Apply filters
        if (!empty($filters['brand_id'])) {
            $this->db->where('cars.brand_id', $filters['brand_id']);
        }
        if (!empty($filters['model_id'])) {
            $this->db->where('cars.model_id', $filters['model_id']);
        }
        if (!empty($filters['fuel_type_id'])) {
            $this->db->where('cars.fuel_type_id', $filters['fuel_type_id']);
        }
        if (!empty($filters['city_id'])) {
            $this->db->where('cars.city_id', $filters['city_id']);
        }
        if (!empty($filters['min_price'])) {
            $this->db->where('cars.price >=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $this->db->where('cars.price <=', $filters['max_price']);
        }
        if (!empty($filters['min_year'])) {
            $this->db->where('cars.year >=', $filters['min_year']);
        }
        if (!empty($filters['max_year'])) {
            $this->db->where('cars.year <=', $filters['max_year']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('cars.variant', $filters['keyword']);
            $this->db->or_like('cars.description', $filters['keyword']);
            $this->db->or_like('brands.name', $filters['keyword']);
            $this->db->or_like('car_models.name', $filters['keyword']);
            $this->db->group_end();
        }
        if (isset($filters['is_featured']) && $filters['is_featured']) {
            $this->db->where('cars.is_featured', 1);
        }

        // Ordering
        $allowed_orders = array('price' => 'ASC', 'price_desc' => 'DESC', 'year' => 'DESC', 'newest' => 'created_at', 'popular' => 'view_count');
        if ($order_by == 'price_low') {
            $this->db->order_by('cars.price', 'ASC');
        } elseif ($order_by == 'price_high') {
            $this->db->order_by('cars.price', 'DESC');
        } elseif ($order_by == 'newest') {
            $this->db->order_by('cars.created_at', 'DESC');
        } elseif ($order_by == 'popular') {
            $this->db->order_by('cars.view_count', 'DESC');
        } else {
            $this->db->order_by('cars.created_at', 'DESC');
        }

        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    /**
     * Count cars with filters
     */
    public function count_list($filters = array()) {
        $this->db->from('cars');
        $this->db->join('brands', 'brands.id = cars.brand_id');
        $this->db->join('car_models', 'car_models.id = cars.model_id');
        $this->db->where('cars.status', 'approved');

        foreach ($filters as $key => $val) {
            if (empty($val)) continue;
            if ($key == 'brand_id') $this->db->where('cars.brand_id', $val);
            if ($key == 'model_id') $this->db->where('cars.model_id', $val);
            if ($key == 'fuel_type_id') $this->db->where('cars.fuel_type_id', $val);
            if ($key == 'city_id') $this->db->where('cars.city_id', $val);
            if ($key == 'min_price') $this->db->where('cars.price >=', $val);
            if ($key == 'max_price') $this->db->where('cars.price <=', $val);
            if ($key == 'min_year') $this->db->where('cars.year >=', $val);
            if ($key == 'max_year') $this->db->where('cars.year <=', $val);
            if ($key == 'keyword') {
                $this->db->group_start();
                $this->db->like('cars.variant', $val);
                $this->db->or_like('cars.description', $val);
                $this->db->or_like('brands.name', $val);
                $this->db->or_like('car_models.name', $val);
                $this->db->group_end();
            }
            if ($key == 'is_featured') $this->db->where('cars.is_featured', 1);
        }
        return $this->db->count_all_results();
    }

    public function get($id) {
        $car = $this->db->select('cars.*, brands.name as brand_name, brands.slug as brand_slug, car_models.name as model_name, car_models.slug as model_slug, cities.name as city_name, fuel_types.name as fuel_type, transmission_types.name as transmission')
            ->from('cars')
            ->join('brands', 'brands.id = cars.brand_id')
            ->join('car_models', 'car_models.id = cars.model_id')
            ->join('cities', 'cities.id = cars.city_id')
            ->join('fuel_types', 'fuel_types.id = cars.fuel_type_id')
            ->join('transmission_types', 'transmission_types.id = cars.transmission_id')
            ->where('cars.id', $id)
            ->get()
            ->row();
        return $car;
    }

    public function get_featured($limit = 8) {
        return $this->get_list(array('is_featured' => 1), $limit, 0, 'created_at', 'DESC');
    }

    public function get_latest($limit = 8) {
        return $this->get_list(array(), $limit, 0, 'newest', 'DESC');
    }

    public function increment_view($id) {
        return $this->db->set('view_count', 'view_count+1', FALSE)
            ->where('id', $id)
            ->update('cars');
    }

    public function create($data) {
        $this->db->insert('cars', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('cars', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('cars');
    }

    /**
     * Admin: Get all cars (including pending)
     */
    public function get_admin_list($filters = array(), $limit = 20, $offset = 0) {
        $this->db->select('cars.*, brands.name as brand_name, car_models.name as model_name, cities.name as city_name');
        $this->db->from('cars');
        $this->db->join('brands', 'brands.id = cars.brand_id');
        $this->db->join('car_models', 'car_models.id = cars.model_id');
        $this->db->join('cities', 'cities.id = cars.city_id');

        if (!empty($filters['status'])) {
            $this->db->where('cars.status', $filters['status']);
        }
        if (!empty($filters['brand_id'])) {
            $this->db->where('cars.brand_id', $filters['brand_id']);
        }

        $this->db->order_by('cars.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_admin_list($filters = array()) {
        $this->db->from('cars');
        if (!empty($filters['status'])) $this->db->where('status', $filters['status']);
        if (!empty($filters['brand_id'])) $this->db->where('brand_id', $filters['brand_id']);
        return $this->db->count_all_results();
    }
}
