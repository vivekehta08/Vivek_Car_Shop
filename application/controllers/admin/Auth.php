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
        $this->load->library(['session', 'form_validation']); // IMPORTANT
        $this->load->helper(['url', 'form']);
    }

    public function login() {

        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }

        $data = [];

        // Validation
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {

            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password');

            $admin = $this->Admin_user_model->get_by_username($username);

            if ($admin) {

                if (password_verify($password, $admin->password)) {

                    $this->Admin_user_model->update_last_login($admin->id);

                    $this->session->set_userdata([
                        'admin_logged_in' => TRUE,
                        'admin_id' => $admin->id,
                        'admin_user' => [
                            'id' => $admin->id,
                            'username' => $admin->username,
                            'full_name' => $admin->full_name,
                            'role' => $admin->role,
                        ],
                    ]);

                    redirect('admin/dashboard');

                } else {
                    $data['error'] = 'Wrong password';
                }

            } else {
                $data['error'] = 'User not found';
            }
        }

        $data['title'] = 'Admin Login';
        $this->load->view('admin/auth/login', $data);
    }

    public function logout() {
        $this->session->unset_userdata(array('admin_logged_in', 'admin_id', 'admin_user'));
        redirect('admin/login');
    }
}
