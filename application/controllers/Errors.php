<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom error pages
 */
class Errors extends MY_Controller {

    public function page_missing() {
        $this->data['meta_title'] = 'Page Not Found';
        $this->load->view('layout/header', $this->data);
        $this->load->view('errors/404', $this->data);
        $this->load->view('layout/footer', $this->data);
    }
}
