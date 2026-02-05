<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * City Model
 */
class City_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all($active_only = TRUE) {
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        return $this->db->order_by('name', 'ASC')->get('cities')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('cities')->row();
    }

    public function get_by_slug($slug) {
        return $this->db->where('slug', $slug)->get('cities')->row();
    }

    public function create($data) {
        $this->db->insert('cities', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('cities', $data);
    }
}
