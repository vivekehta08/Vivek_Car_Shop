<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Auth Controller
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('Admin_user_model');
    }

    public function login() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }
        
        if ($this->input->post('login')) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run()) {
                $admin = $this->Admin_user_model->get_by_username($this->input->post('username', TRUE));
                if ($admin && $this->Admin_user_model->verify_password($this->input->post('password'), $admin->password)) {
                    $this->Admin_user_model->update_last_login($admin->id);
                    $this->session->set_userdata(array(
                        'admin_logged_in' => TRUE,
                        'admin_id' => $admin->id,
                        'admin_user' => array(
                            'id' => $admin->id,
                            'username' => $admin->username,
                            'full_name' => $admin->full_name,
                            'role' => $admin->role,
                        ),
                    ));
                    redirect('admin/dashboard');
                } else {
                    $this->data['error'] = 'Invalid username or password.';
                }
            }
        }
        
        $this->data['title'] = 'Admin Login';
        $this->load->view('admin/auth/login', $this->data);
    }

    public function logout() {
        $this->session->unset_userdata(array('admin_logged_in', 'admin_id', 'admin_user'));
        redirect('admin/login');
    }
}
