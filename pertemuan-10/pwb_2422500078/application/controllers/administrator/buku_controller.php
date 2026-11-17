<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class buku_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('buku_model');
    }

    public function index()
    {
        $data['list_buku'] = $this->buku_model->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/buku/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_buku()
    {
        $data['title'] = 'Tambah buku';

        $this->form_validation->set_rules('nm_buku', 'nm_buku', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->_simpan_buku();
        } else {
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/buku/tambah_buku');
            $this->load->view('administrator/templates/footer');
        }
    }

    private function _simpan_buku()
    {
        $data = [
            'nm_buku' => ucwords($this->input->post('nm_buku')),
            'penerbit' => ucfirst($this->input->post('penerbit')),
            'editor' => ucfirst($this->input->post('editor')),
            'author' => ucfirst($this->input->post('author'))
        ];
        $simpan = $this->buku_model->tambah($data);
        if ($simpan) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
                Berhasil menambahkan buku!!
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                Gagal menambahkan buku!!
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/buku');
    }

    public function ubah_buku($id)
    {
        // check dulu apakah id dengan buku ada?
        $buku = $this->buku_model->get_by_id($id);
        if ($buku) {
            $this->form_validation->set_rules('nm_buku', 'nm_buku', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $this->_ubah_buku($id);
            } else {
                $data['title'] = 'Ubah buku';
                $data['buku'] = $buku;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/buku/ubah_buku', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    buku tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/buku');
        }
    }

    private function _ubah_buku($id)
    {
        $data = [
            'nm_buku' => ucwords($this->input->post('nm_buku')),
            'penerbit' => ucfirst($this->input->post('penerbit')),
            'editor' => ucfirst($this->input->post('editor')),
            'author' => ucfirst($this->input->post('author'))
        ];
        $ubah = $this->buku_model->ubah($data, $id);
        if ($ubah) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil mengubah buku!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Gagal mengubah buku!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/buku');
    }

    public function hapus_buku($id)
    {
        // check apakah ada buku
        $buku = $this->buku_model->get_by_id($id);
        if ($buku) {
            $hapus = $this->buku_model->hapus($id);
            if ($hapus) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        Berhasil menghapus buku!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        Gagal menghapus buku!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            }
            redirect('admin/buku');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    buku tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/buku');
        }
    }
}