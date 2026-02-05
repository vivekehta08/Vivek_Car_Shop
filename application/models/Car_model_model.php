<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Car Model Model - Car models (Swift, Nexon, etc.) - Note: Named to avoid conflict with CI_Model
 */
class Car_model_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all($brand_id = NULL, $active_only = TRUE) {
        if ($brand_id) {
            $this->db->where('brand_id', $brand_id);
        }
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        return $this->db->order_by('name', 'ASC')->get('car_models')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('car_models')->row();
    }

    public function get_by_brand_slug($brand_id, $slug) {
        return $this->db->where('brand_id', $brand_id)
            ->where('slug', $slug)
            ->get('car_models')
            ->row();
    }

    public function get_by_brand($brand_id) {
        return $this->db->where('brand_id', $brand_id)
            ->where('is_active', 1)
            ->order_by('name', 'ASC')
            ->get('car_models')
            ->result();
    }

    public function create($data) {
        $this->db->insert('car_models', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('car_models', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('car_models');
    }
}
