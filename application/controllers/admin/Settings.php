<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Settings - WhatsApp, SEO, Banners
 */
class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Setting_model');
        $this->load->model('Banner_model');
    }

    public function index() {
        if ($this->input->post('submit')) {
            $keys = array('whatsapp_number', 'whatsapp_message', 'site_name', 'meta_title', 'meta_description', 'meta_keywords');
            foreach ($keys as $k) {
                if ($this->input->post($k) !== FALSE) {
                    $this->Setting_model->set($k, $this->input->post($k, TRUE));
                }
            }
            $this->_handle_logo_upload();
            $this->session->set_flashdata('success', 'Settings saved.');
            redirect('admin/settings');
        }
        
        $this->data['settings'] = $this->Setting_model->get_all();
        $this->data['title'] = 'Settings';
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/settings/index', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function banners() {
        $this->data['banners'] = $this->Banner_model->get_all();
        $this->data['title'] = 'Homepage Banners';
        
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/settings/banners', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function add_banner() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('title', 'Title', 'trim');
            if ($this->form_validation->run()) {
                $upload_path = FCPATH . $this->config->item('banners_path');
                if (!is_dir($upload_path)) mkdir($upload_path, 0755, TRUE);
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('image')) {
                    $ud = $this->upload->data();
                    $this->Banner_model->create(array(
                        'title' => $this->input->post('title', TRUE),
                        'image_path' => $this->config->item('banners_path') . $ud['file_name'],
                        'link_url' => $this->input->post('link_url', TRUE),
                        'display_order' => (int) $this->input->post('display_order'),
                        'is_active' => 1,
                    ));
                    $this->session->set_flashdata('success', 'Banner added.');
                }
                redirect('admin/settings/banners');
            }
        }
        $this->data['title'] = 'Add Banner';
        $this->load->view('admin/layout/header', $this->data);
        $this->load->view('admin/settings/banner_form', $this->data);
        $this->load->view('admin/layout/footer', $this->data);
    }

    public function delete_banner($id) {
        $this->Banner_model->delete($id);
        $this->session->set_flashdata('success', 'Banner deleted.');
        redirect('admin/settings/banners');
    }

    private function _handle_logo_upload() {
        if (empty($_FILES['site_logo']['name'])) return;
        $upload_path = FCPATH . $this->config->item('logo_path');
        if (!is_dir($upload_path)) mkdir($upload_path, 0755, TRUE);
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp|svg';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('site_logo')) {
            $ud = $this->upload->data();
            $this->Setting_model->set('site_logo', $this->config->item('logo_path') . $ud['file_name']);
        }
    }
}
