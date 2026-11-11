<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ekspedisi_2422500078_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('ekspedisi_2422500078_model');
    }

    public function index()
    {
        $data['list_ekspedisi'] = $this->ekspedisi_2422500078_model->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/ekspedisi/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_ekspedisi078()
    {
        $data['title'] = 'Tambah ekspedisi';

        $this->form_validation->set_rules('nama_ekspedisi078', 'nama_ekspedisi078', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->_simpan_ekspedisi();
        } else {
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/ekspedisi/tambah_ekspedisi078');
            $this->load->view('administrator/templates/footer');
        }
    }

    private function _simpan_ekspedisi()
    {
        $data = [
            'nama_ekspedisi078' => ucwords($this->input->post('nama_ekspedisi078')),
            'jenis_layanan078' => ucfirst($this->input->post('jenis_layanan078')),
            'tarif_per_kg078' => ucfirst($this->input->post('tarif_per_kg078')),
            'status078' => ucfirst($this->input->post('status078'))
        ];
        $simpan = $this->ekspedisi_2422500078_model->tambah($data);
        if ($simpan) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
                Berhasil menambahkan ekspedisi!!
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
                Gagal menambahkan ekspedisi!!
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/ekspedisi_2422500078');
    }

    public function ubah_ekspedisi078($id)
    {
        // check dulu apakah id dengan ekspedisi ada?
        $ekspedisi_2422500078 = $this->ekspedisi_2422500078_model->get_by_id($id);
        if ($ekspedisi_2422500078) {
            $this->form_validation->set_rules('nama_ekspedisi078', 'nama_ekspedisi078', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $this->_ubah_ekspedisi078($id);
            } else {
                $data['title'] = 'Ubah ekspedisi';
                $data['ekspedisi_2422500078'] = $ekspedisi_2422500078;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/ekspedisi/ubah_ekspedisi078', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    ekspedisi tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/ekspedisi_2422500078');
        }
    }

    private function _ubah_ekspedisi078($id)
    {
        $data = [
            'nama_ekspedisi078' => ucwords($this->input->post('nama_ekspedisi078')),
            'jenis_layanan078' => ucfirst($this->input->post('jenis_layanan078')),
            'tarif_per_kg078' => ucfirst($this->input->post('tarif_per_kg078')),
            'status078' => ucfirst($this->input->post('status078'))
        ];
        $ubah = $this->ekspedisi_2422500078_model->ubah($data, $id);
        if ($ubah) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil mengubah ekspedisi!!
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
                    Gagal mengubah ekspedisi!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/ekspedisi_2422500078');
    }

    public function hapus_ekspedisi078($id)
    {
        // check apakah ada ekspedisi
        $ekspedisi_2422500078 = $this->ekspedisi_2422500078_model->get_by_id($id);
        if ($ekspedisi_2422500078) {
            $hapus = $this->ekspedisi_2422500078_model->hapus($id);
            if ($hapus) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        Berhasil menghapus ekspedisi!!
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
                        Gagal menghapus ekspedisi!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            }
            redirect('admin/ekspedisi_2422500078');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    ekspedisi tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/ekspedisi_2422500078');
        }
    }
}