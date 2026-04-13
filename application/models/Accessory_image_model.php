<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Accessory Image Model
 */
class Accessory_image_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($image_id) {
        return $this->db->where('id', $image_id)->get('accessory_images')->row();
    }

    public function get_by_accessory($accessory_id) {
        return $this->db->where('accessory_id', $accessory_id)
            ->order_by('is_primary', 'DESC')
            ->order_by('display_order', 'ASC')
            ->get('accessory_images')
            ->result();
    }

    public function get_primary($accessory_id) {
        $row = $this->db->where('accessory_id', $accessory_id)->where('is_primary', 1)->get('accessory_images')->row();
        if (!$row) {
            $row = $this->db->where('accessory_id', $accessory_id)->order_by('id', 'ASC')->limit(1)->get('accessory_images')->row();
        }
        return $row;
    }

    public function add($data) {
        $this->db->insert('accessory_images', $data);
        return $this->db->insert_id();
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('accessory_images');
    }

    public function delete_by_accessory($accessory_id) {
        return $this->db->where('accessory_id', $accessory_id)->delete('accessory_images');
    }
}
