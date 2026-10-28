<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_gambar_model extends CI_Model
{

    private $_table = "produk_gambar";

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function get_by_id_produk($id)
    {
        $this->db->where('id_produk', $id);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function get_by_id($id_gambar)
    {
        $this->db->where('id_gambar', $id_gambar);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    public function ubah($data, $id_gambar)
    {
        $this->db->where('id_gambar', $id_gambar);
        return $this->db->update($this->_table, $data);
    }

    public function hapus($id)
    {
        $this->db->delete($this->_table, array('id_gambar' => $id));
    }
}
