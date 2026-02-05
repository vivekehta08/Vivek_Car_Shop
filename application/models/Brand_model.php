<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Brand Model - Car brands (Maruti, Tata, etc.)
 */
class Brand_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all($active_only = TRUE) {
        $this->db->order_by('display_order', 'ASC')->order_by('name', 'ASC');
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        return $this->db->get('brands')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('brands')->row();
    }

    public function get_by_slug($slug) {
        return $this->db->where('slug', $slug)->get('brands')->row();
    }

    public function create($data) {
        $this->db->insert('brands', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('brands', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('brands');
    }

    /**
     * Get popular brands (with car count)
     */
    public function get_popular($limit = 12) {
        return $this->db->select('brands.*, COUNT(cars.id) as car_count')
            ->from('brands')
            ->join('cars', 'cars.brand_id = brands.id AND cars.status = "approved"', 'left')
            ->where('brands.is_active', 1)
            ->group_by('brands.id')
            ->order_by('car_count', 'DESC')
            ->order_by('display_order', 'ASC')
            ->limit($limit)
            ->get()
            ->result();
    }
}
