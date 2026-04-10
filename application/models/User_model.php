<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Model - Frontend users
 */
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('users')->row();
    }

    public function get_by_email($email) {
        return $this->db->where('email', $email)->get('users')->row();
    }

    public function create($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function verify_password($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Admin: Get all users
     */
    public function get_all($filters = array(), $limit = 50, $offset = 0) {
        $this->db->from('users');
        if (isset($filters['is_blocked'])) {
            $this->db->where('is_blocked', $filters['is_blocked']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('name', $filters['keyword']);
            $this->db->or_like('email', $filters['keyword']);
            $this->db->group_end();
        }
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_all($filters = array()) {
        $this->db->from('users');
        if (isset($filters['is_blocked'])) $this->db->where('is_blocked', $filters['is_blocked']);
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('name', $filters['keyword']);
            $this->db->or_like('email', $filters['keyword']);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }
}
