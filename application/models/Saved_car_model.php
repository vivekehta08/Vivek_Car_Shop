<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Saved Car Model - User wishlist
 */
class Saved_car_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function is_saved($user_id, $car_id) {
        return $this->db->where('user_id', $user_id)->where('car_id', $car_id)->get('saved_cars')->row();
    }

    public function add($user_id, $car_id) {
        if ($this->is_saved($user_id, $car_id)) return TRUE;
        return $this->db->insert('saved_cars', array('user_id' => $user_id, 'car_id' => $car_id));
    }

    public function remove($user_id, $car_id) {
        return $this->db->where('user_id', $user_id)->where('car_id', $car_id)->delete('saved_cars');
    }

    public function get_by_user($user_id) {
        return $this->db->select('saved_cars.*, cars.*, brands.name as brand_name, car_models.name as model_name')
            ->from('saved_cars')
            ->join('cars', 'cars.id = saved_cars.car_id')
            ->join('brands', 'brands.id = cars.brand_id')
            ->join('car_models', 'car_models.id = cars.model_id')
            ->where('saved_cars.user_id', $user_id)
            ->where('cars.status', 'approved')
            ->order_by('saved_cars.created_at', 'DESC')
            ->get()
            ->result();
    }
}
