<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Cars Management
 */
class Cars extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Car_model');
        $this->load->model('Car_image_model');
        $this->load->model('Brand_model');
        $this->load->model('Car_model_model');
        $this->load->model('City_model');
        $this->load->model('Fuel_type_model');
        $this->load->model('Transmission_model');
    }

    public function index($page = 1) {
        $per_page = 20;
        $filters = array(
            'status' => $this->input->get('status'),
            'brand_id' => $this->input->get('brand'),
        );
        $total = $this->Car_model->count_admin_list($filters);
        $offset = ($page - 1) * $per_page;
        
        $this->data['cars'] = $this->Car_model->get_admin_list($filters, $per_page, $offset);
        $this->data['total'] = $total;
        $this->data['page'] = $page;
        $this->data['total_pages'] = ceil($total / $per_page);
        $this->data['title'] = 'Manage Cars';
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/cars/list', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function add() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('brand_id', 'Brand', 'required');
            $this->form_validation->set_rules('model_id', 'Model', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required|integer');
            $this->form_validation->set_rules('fuel_type_id', 'Fuel Type', 'required');
            $this->form_validation->set_rules('transmission_id', 'Transmission', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('city_id', 'City', 'required');
            
            if ($this->form_validation->run()) {
                $data = array(
                    'brand_id' => $this->input->post('brand_id'),
                    'model_id' => $this->input->post('model_id'),
                    'variant' => $this->input->post('variant', TRUE),
                    'year' => $this->input->post('year'),
                    'fuel_type_id' => $this->input->post('fuel_type_id'),
                    'transmission_id' => $this->input->post('transmission_id'),
                    'mileage' => $this->input->post('mileage', TRUE),
                    'price' => $this->input->post('price'),
                    'city_id' => $this->input->post('city_id'),
                    'description' => $this->input->post('description', TRUE),
                    'seller_name' => $this->input->post('seller_name', TRUE),
                    'seller_phone' => $this->input->post('seller_phone', TRUE),
                    'seller_email' => $this->input->post('seller_email', TRUE),
                    'status' => $this->input->post('status') ?: 'approved',
                    'is_featured' => $this->input->post('is_featured') ? 1 : 0,
                    'created_by' => $this->session->userdata('admin_id'),
                );
                $car_id = $this->Car_model->create($data);
                $this->_handle_image_upload($car_id);
                $this->session->set_flashdata('success', 'Car added successfully.');
                redirect('admin/cars');
            }
        }
        
        $this->data['brands'] = $this->Brand_model->get_all(FALSE);
        $this->data['cities'] = $this->City_model->get_all(FALSE);
        $this->data['fuel_types'] = $this->Fuel_type_model->get_all();
        $this->data['transmissions'] = $this->Transmission_model->get_all();
        $this->data['models'] = array();
        $this->data['title'] = 'Add Car';
        $this->data['car'] = NULL;
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/cars/form', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function edit($id) {
        $car = $this->Car_model->get($id);
        if (!$car) {
            show_404();
        }
        
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('brand_id', 'Brand', 'required');
            $this->form_validation->set_rules('model_id', 'Model', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required|integer');
            $this->form_validation->set_rules('fuel_type_id', 'Fuel Type', 'required');
            $this->form_validation->set_rules('transmission_id', 'Transmission', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('city_id', 'City', 'required');
            
            if ($this->form_validation->run()) {
                $data = array(
                    'brand_id' => $this->input->post('brand_id'),
                    'model_id' => $this->input->post('model_id'),
                    'variant' => $this->input->post('variant', TRUE),
                    'year' => $this->input->post('year'),
                    'fuel_type_id' => $this->input->post('fuel_type_id'),
                    'transmission_id' => $this->input->post('transmission_id'),
                    'mileage' => $this->input->post('mileage', TRUE),
                    'price' => $this->input->post('price'),
                    'city_id' => $this->input->post('city_id'),
                    'description' => $this->input->post('description', TRUE),
                    'seller_name' => $this->input->post('seller_name', TRUE),
                    'seller_phone' => $this->input->post('seller_phone', TRUE),
                    'seller_email' => $this->input->post('seller_email', TRUE),
                    'status' => $this->input->post('status') ?: 'approved',
                    'is_featured' => $this->input->post('is_featured') ? 1 : 0,
                );
                $this->Car_model->update($id, $data);
                $this->_handle_image_upload($id);
                $this->session->set_flashdata('success', 'Car updated successfully.');
                redirect('admin/cars');
            }
        }
        
        $this->data['car'] = $car;
        $this->data['car_images'] = $this->Car_image_model->get_by_car($id);
        $this->data['brands'] = $this->Brand_model->get_all(FALSE);
        $this->data['models'] = $this->Car_model_model->get_by_brand($car->brand_id);
        $this->data['cities'] = $this->City_model->get_all(FALSE);
        $this->data['fuel_types'] = $this->Fuel_type_model->get_all();
        $this->data['transmissions'] = $this->Transmission_model->get_all();
        $this->data['title'] = 'Edit Car';
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/cars/form', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function delete($id) {
        $this->Car_model->delete($id);
        $this->session->set_flashdata('success', 'Car deleted.');
        redirect('admin/cars');
    }

    public function models_by_brand() {
        $brand_id = (int) $this->input->get('brand_id');
        $models = $this->Car_model_model->get_by_brand($brand_id);
        header('Content-Type: application/json');
        echo json_encode($models);
    }

    private function _handle_image_upload($car_id) {

        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            return;
        }

        $upload_path = FCPATH . $this->config->item('car_images_path');
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        $config = array(
            'upload_path'   => $upload_path,
            'allowed_types' => 'gif|jpg|jpeg|png|webp',
            'max_size'      => 5120,
            'encrypt_name'  => TRUE,
        );
        $this->load->library('upload', $config);

        $files = $_FILES;
        $count = count($files['images']['name']);

        $uploadErrors = array();

        for ($i = 0; $i < $count; $i++) {

            if (empty($files['images']['name'][$i])) {
                continue;
            }

            $_FILES['image']['name']     = $files['images']['name'][$i];
            $_FILES['image']['type']     = $files['images']['type'][$i];
            $_FILES['image']['tmp_name'] = $files['images']['tmp_name'][$i];
            $_FILES['image']['error']    = $files['images']['error'][$i];
            $_FILES['image']['size']     = $files['images']['size'][$i];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {

                $data = $this->upload->data();

                $this->Car_image_model->add([
                    'car_id' => $car_id,
                    'image_path' => $this->config->item('car_images_path') . $data['file_name'],
                    'is_primary' => ($i == 0 ? 1 : 0),
                    'display_order' => $i,
                ]);

            } else {
                $uploadErrors[] = $files['images']['name'][$i] . ': ' . $this->upload->display_errors('', '');
            }
        }

        if (!empty($uploadErrors)) {
            $this->session->set_flashdata('upload_errors', $uploadErrors);
        }
    }
}
