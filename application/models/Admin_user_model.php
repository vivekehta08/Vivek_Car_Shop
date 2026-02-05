<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model - Manages admin authentication
 */
class Admin_user_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get admin by username or email
     */
    public function get_by_username($username) {
        $username = trim($username);
        $this->db->where('is_active', 1);
        $this->db->group_start();
        $this->db->where('username', $username);
        $this->db->or_where('email', $username);
        $this->db->group_end();
        return $this->db->get('admin_users')->row();
    }

    /**
     * Get admin by ID
     */
    public function get($id) {
        return $this->db->where('id', $id)->get('admin_users')->row();
    }

    /**
     * Update last login
     */
    public function update_last_login($id) {
        return $this->db->where('id', $id)
            ->update('admin_users', ['last_login' => date('Y-m-d H:i:s')]);
    }

    /**
     * Verify password
     */
    public function verify_password($password, $hash) {
        return password_verify($password, $hash);
    }
}
