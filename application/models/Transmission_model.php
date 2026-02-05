<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Transmission Type Model
 */
class Transmission_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->order_by('name', 'ASC')->get('transmission_types')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('transmission_types')->row();
    }
}
