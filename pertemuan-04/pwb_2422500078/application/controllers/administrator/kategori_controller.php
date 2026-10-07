<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('produk_kategori_model');
    }

    public function index() {
        $data['list_kategori'] = $this->produk_kategori_model->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('kategori/index',$data);
        $this->load->view('administrator/templates/footer');
    }
}