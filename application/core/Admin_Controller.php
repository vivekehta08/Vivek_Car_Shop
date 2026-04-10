<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Base Controller - Requires admin authentication
 */
class Admin_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
        
        $this->data['admin'] = $this->session->userdata('admin_user');
    }
}
