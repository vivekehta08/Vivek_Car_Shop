<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Accessory Category Model
 */
class Accessory_category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all($active_only = TRUE) {
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        return $this->db->order_by('name', 'ASC')->get('accessory_categories')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('accessory_categories')->row();
    }
}
