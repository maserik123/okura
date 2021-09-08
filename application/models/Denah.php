<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Denah extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id,nama_bunga,gambar,status,create_date,create_date');
        $this->datatables->from('denah');
        return $this->datatables->generate();
    }

    public function getData()
    {

        $this->db->select('*');
        $this->db->from('denah');
        $this->db->order_by('id', 'desc');

        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('denah', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function simpan_upload($nama_bunga, $gambar, $status, $create_date)
    {
        $data['nama_bunga'] = $nama_bunga;
        $data['gambar'] = $gambar;
        $data['status'] = $status;
        $data['create_date'] = $create_date;
        $result = $this->db->insert('denah', $data);
        return $result;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('denah ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('denah');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('denah', $data);
        return $this->db->affected_rows();
    }
    public function _deleteImage($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->gambar)[0];
        return array_map('unlink', glob(FCPATH . "denah/$filename.*"));
    }
    function delete($id)
    {
        $this->_deleteImage($id);
        $this->db->where('id', $id);
        $this->db->delete('denah');
    }
}

/* End of file Fasilitas.php */
