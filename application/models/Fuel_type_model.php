<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fuel Type Model
 */
class Fuel_type_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->order_by('name', 'ASC')->get('fuel_types')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('fuel_types')->row();
    }
}
