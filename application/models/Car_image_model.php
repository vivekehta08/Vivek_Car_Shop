<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Car Image Model
 */
class Car_image_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($image_id) {
        return $this->db->where('id', $image_id)->get('car_images')->row();
    }

    public function get_by_car($car_id) {
        return $this->db->where('car_id', $car_id)
            ->order_by('is_primary', 'DESC')
            ->order_by('display_order', 'ASC')
            ->get('car_images')
            ->result();
    }

    public function get_primary($car_id) {
        $row = $this->db->where('car_id', $car_id)->where('is_primary', 1)->get('car_images')->row();
        if (!$row) {
            $row = $this->db->where('car_id', $car_id)->order_by('id', 'ASC')->limit(1)->get('car_images')->row();
        }
        return $row;
    }

    public function add($data) {
        $this->db->insert('car_images', $data);
        return $this->db->insert_id();
    }

    public function set_primary($car_id, $image_id) {
        $this->db->where('car_id', $car_id)->update('car_images', array('is_primary' => 0));
        return $this->db->where('id', $image_id)->where('car_id', $car_id)->update('car_images', array('is_primary' => 1));
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('car_images');
    }

    public function delete_by_car($car_id) {
        return $this->db->where('car_id', $car_id)->delete('car_images');
    }
}
