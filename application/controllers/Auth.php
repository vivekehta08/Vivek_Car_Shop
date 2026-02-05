<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller - User login, register, account
 */
class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Saved_car_model');
        $this->load->model('Inquiry_model');
    }

    public function login() {
        if ($this->session->userdata('user_id')) {
            redirect('account');
        }
        
        if ($this->input->post('login')) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run()) {
                $user = $this->User_model->get_by_email($this->input->post('email', TRUE));
                if ($user && !$user->is_blocked && $this->User_model->verify_password($this->input->post('password'), $user->password)) {
                    $this->session->set_userdata(array(
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_email' => $user->email,
                    ));
                    redirect('account');
                } else {
                    $this->data['error'] = 'Invalid email or password.';
                }
            }
        }
        
        $this->data['meta_title'] = 'Login - ' . $this->data['site_name'];
        $this->load->view('layout/header', $this->data);
        $this->load->view('auth/login', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function register() {
        if ($this->session->userdata('user_id')) {
            redirect('account');
        }
        
        if ($this->input->post('register')) {
            $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
            
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'phone' => $this->input->post('phone', TRUE),
                    'password' => $this->input->post('password'),
                );
                $user_id = $this->User_model->create($data);
                $user = $this->User_model->get($user_id);
                $this->session->set_userdata(array(
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                ));
                redirect('account');
            }
        }
        
        $this->data['meta_title'] = 'Register - ' . $this->data['site_name'];
        $this->load->view('layout/header', $this->data);
        $this->load->view('auth/register', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function logout() {
        $this->session->unset_userdata(array('user_id', 'user_name', 'user_email'));
        redirect('');
    }

    public function account() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $this->data['user'] = $this->User_model->get($user_id);
        $this->data['saved_cars'] = $this->Saved_car_model->get_by_user($user_id);
        $this->data['inquiries'] = $this->Inquiry_model->get_by_user($user_id);
        $this->data['meta_title'] = 'My Account - ' . $this->data['site_name'];
        
        $this->load->view('layout/header', $this->data);
        $this->load->view('auth/account', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    /**
     * AJAX: Toggle save car
     */
    public function toggle_save() {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('success' => FALSE, 'message' => 'Please login first'));
            return;
        }
        $car_id = (int) $this->input->post('car_id');
        $user_id = $this->session->userdata('user_id');
        
        if ($this->Saved_car_model->is_saved($user_id, $car_id)) {
            $this->Saved_car_model->remove($user_id, $car_id);
            echo json_encode(array('success' => TRUE, 'saved' => FALSE));
        } else {
            $this->Saved_car_model->add($user_id, $car_id);
            echo json_encode(array('success' => TRUE, 'saved' => TRUE));
        }
    }
}
