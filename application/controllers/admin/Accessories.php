<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Accessories Management
 */
class Accessories extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accessory_model');
        $this->load->model('Accessory_image_model');
        $this->load->model('Accessory_category_model');
        $this->load->model('Brand_model');
        $this->load->model('Car_model_model');
    }

    public function index($page = 1) {
        $per_page = 20;
        $total = $this->db->count_all('accessories');
        $offset = ($page - 1) * $per_page;
        
        $this->data['accessories'] = $this->db->select('accessories.*, accessory_categories.name as category_name')
            ->from('accessories')
            ->join('accessory_categories', 'accessory_categories.id = accessories.category_id', 'left')
            ->order_by('accessories.created_at', 'DESC')
            ->limit($per_page, $offset)
            ->get()
            ->result();
        $this->data['total'] = $total;
        $this->data['page'] = $page;
        $this->data['total_pages'] = ceil($total / $per_page);
        $this->data['title'] = 'Manage Accessories';
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/accessories/list', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function add() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            
            if ($this->form_validation->run()) {
                $slug = url_title($this->input->post('name', TRUE), '-', TRUE);
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'slug' => $slug,
                    'category_id' => $this->input->post('category_id') ?: NULL,
                    'brand_id' => $this->input->post('brand_id') ?: NULL,
                    'model_id' => $this->input->post('model_id') ?: NULL,
                    'price' => $this->input->post('price'),
                    'description' => $this->input->post('description', TRUE),
                    'compatible_models' => $this->input->post('compatible_models', TRUE),
                    'is_available' => $this->input->post('is_available') ? 1 : 0,
                );
                $acc_id = $this->Accessory_model->create($data);
                $this->_handle_image_upload($acc_id);
                $this->session->set_flashdata('success', 'Accessory added successfully.');
                redirect('admin/accessories');
            }
        }
        
        $this->data['categories'] = $this->Accessory_category_model->get_all(FALSE);
        $this->data['brands'] = $this->Brand_model->get_all(FALSE);
        $this->data['models'] = array();
        $this->data['title'] = 'Add Accessory';
        $this->data['accessory'] = NULL;
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/accessories/form', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function edit($id) {
        $accessory = $this->Accessory_model->get($id);
        if (!$accessory) show_404();
        
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            
            if ($this->form_validation->run()) {
                $slug = url_title($this->input->post('name', TRUE), '-', TRUE);
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'slug' => $slug,
                    'category_id' => $this->input->post('category_id') ?: NULL,
                    'brand_id' => $this->input->post('brand_id') ?: NULL,
                    'model_id' => $this->input->post('model_id') ?: NULL,
                    'price' => $this->input->post('price'),
                    'description' => $this->input->post('description', TRUE),
                    'compatible_models' => $this->input->post('compatible_models', TRUE),
                    'is_available' => $this->input->post('is_available') ? 1 : 0,
                );
                $this->Accessory_model->update($id, $data);
                $this->_handle_image_upload($id);
                $this->session->set_flashdata('success', 'Accessory updated.');
                redirect('admin/accessories');
            }
        }
        
        $this->data['accessory'] = $accessory;
        $this->data['accessory_images'] = $this->Accessory_image_model->get_by_accessory($id);
        $this->data['categories'] = $this->Accessory_category_model->get_all(FALSE);
        $this->data['brands'] = $this->Brand_model->get_all(FALSE);
        $this->data['models'] = $accessory->brand_id ? $this->Car_model_model->get_by_brand($accessory->brand_id) : array();
        $this->data['title'] = 'Edit Accessory';
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/accessories/form', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function delete($id) {
        $this->Accessory_model->delete($id);
        $this->session->set_flashdata('success', 'Accessory deleted.');
        redirect('admin/accessories');
    }

    private function _handle_image_upload($accessory_id) {
        if (empty($_FILES['images']['name'][0])) return;
        
        $upload_path = FCPATH . $this->config->item('accessory_images_path');
        if (!is_dir($upload_path)) mkdir($upload_path, 0755, TRUE);
        
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
        $config['max_size'] = 5120;
        $this->load->library('upload', $config);
        
        $files = $_FILES;
        $cpt = is_array($_FILES['images']['name']) ? count($_FILES['images']['name']) : 0;
        
        for ($i = 0; $i < $cpt; $i++) {
            if ($_FILES['images']['error'][$i] != 0) continue;
            $_FILES['img']['name'] = $files['images']['name'][$i];
            $_FILES['img']['type'] = $files['images']['type'][$i];
            $_FILES['img']['tmp_name'] = $files['images']['tmp_name'][$i];
            $_FILES['img']['error'] = $files['images']['error'][$i];
            $_FILES['img']['size'] = $files['images']['size'][$i];
            
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img')) {
                $ud = $this->upload->data();
                $this->Accessory_image_model->add(array(
                    'accessory_id' => $accessory_id,
                    'image_path' => $this->config->item('accessory_images_path') . $ud['file_name'],
                    'is_primary' => $i == 0 ? 1 : 0,
                    'display_order' => $i,
                ));
            }
        }
    }
}
