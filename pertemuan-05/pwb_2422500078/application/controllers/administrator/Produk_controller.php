<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        // Load model
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/index');
        $this->load->view('administrator/templates/footer');
    }
        public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';
        $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->_simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        }
        
    }
        private function _simpan_produk()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'id_kategori ' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        
        $id_produk = $this->produk_model->tambah($data);
     

        $count = count($_FILES['gambar_produk']['name']);
        if ($count > 0) {

            $errors = $this->_produk_gambar_upload($count, $id_produk);
            if ($errors) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div>Produk tersimpan, tetapi gambar gagal diunggah:<br>' . implode('<br>', $errors) . '</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
                redirect('admin/produk');
            }
        }
        $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menambahkan produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ');

        redirect('admin/produk');
    }
        private function _produk_gambar_upload($count, $id_produk)
    {
        $errors = [];

        
        if (!is_dir('uploads/produk/')) {
            mkdir('uploads/produk/', 0777, true);
        }
        $this->load->library('upload');

        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path'] = 'uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                // $config['file_name'] = $_FILES['gambar_produk']['name'][$i];
                $config['file_name'] = "produk-" . $id_produk . '-' . $i;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data = [
                        'nama_gambar' => $filename,
                        'id_produk' => $id_produk
                    ];
                    $this->produk_gambar_model->tambah($data);
                } else {
                    $errors[] = $_FILES['gambar_produk']['name'][$i] . ': ' . $this->upload->display_errors('', '');
                }
            }
        }
        return $errors;
    }
    public function ubah_produk($id)
    {
        
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_produk($id);
            } else {
                $data['title'] = 'Ubah produk';
                $data['produk'] = $produk;
                $data['list_kategori'] = $this->produk_kategori_model->get_all();
                $data['gambar_model'] = $this->produk_gambar_model;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    produk tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/produk');
        }
    }
    private function __ubah_produk($id)
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'id_kategori ' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $ubah = $this->produk_model->ubah($data, $id);

        
        $this->load->library('upload');
        $hasil_ganti = $this->_ganti_gambar($id);
        if (!empty($_FILES['gambar_produk']['name'][0])) {
            $err_baru = $this->_produk_gambar_upload(count($_FILES['gambar_produk']['name']), $id);
            $hasil_ganti['errors'] = array_merge($hasil_ganti['errors'], $err_baru);
        }

        if ($hasil_ganti['errors']) {
            $pesan_error = implode('<br>', $hasil_ganti['errors']);
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div>Gagal mengunggah/mengganti gambar:<br>' . $pesan_error . '</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } elseif ($ubah || $hasil_ganti['berhasil'] > 0) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil mengubah produk!!
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
                    Gagal mengubah produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/produk');
    }
    
    private function _ganti_gambar($id_produk)
    {
        $hasil = ['berhasil' => 0, 'errors' => []];

        if (empty($_FILES['ganti_gambar']['name']) || !is_array($_FILES['ganti_gambar']['name'])) {
            return $hasil;
        }

        $folder = 'uploads/produk/';
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        foreach ($_FILES['ganti_gambar']['name'] as $id_gambar => $nama) {
            
            if (empty($nama) || $_FILES['ganti_gambar']['error'][$id_gambar] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

           
            $gambar_lama = $this->produk_gambar_model->get_by_id($id_gambar);
            if (!$gambar_lama || $gambar_lama['id_produk'] != $id_produk) {
                continue;
            }

            $_FILES['file'] = [
                'name'     => $_FILES['ganti_gambar']['name'][$id_gambar],
                'type'     => $_FILES['ganti_gambar']['type'][$id_gambar],
                'tmp_name' => $_FILES['ganti_gambar']['tmp_name'][$id_gambar],
                'error'    => $_FILES['ganti_gambar']['error'][$id_gambar],
                'size'     => $_FILES['ganti_gambar']['size'][$id_gambar],
            ];

            $config['upload_path']   = $folder;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = '5000';
            $config['file_name']     = 'produk-' . $id_produk . '-' . $id_gambar . '-' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $file_baru = $this->upload->data('file_name');
                $this->produk_gambar_model->ubah(['nama_gambar' => $file_baru], $id_gambar);

                
                $path_lama = './' . $folder . $gambar_lama['nama_gambar'];
                if (is_file($path_lama)) {
                    unlink($path_lama);
                }
                $hasil['berhasil']++;
            } else {
                $hasil['errors'][] = $nama . ': ' . $this->upload->display_errors('', '');
            }
        }

        return $hasil;
    }

        public function hapus_produk($id)
    {
        
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            
            $list_gambar = $this->produk_gambar_model->get_by_id_produk($id);
            foreach ($list_gambar as $gambar) {
                $id_gambar = $gambar['id_gambar'];
                $nama_gambar = $gambar['nama_gambar'];
                $this->produk_gambar_model->hapus($id_gambar);
                $path = './uploads/produk/' . $nama_gambar;
                unlink($path);
            }
            
            $this->produk_model->hapus($id);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menghapus produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        redirect('admin/produk');
    } else {
        $this->session->set_flashdata('message', '
        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                produk tidak ditemukan!!
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
        redirect('admin/produk');
    }
}

}