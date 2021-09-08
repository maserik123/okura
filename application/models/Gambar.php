<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gambar extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id,url,judul,jenis,create_date,create_date');
        $this->datatables->from('gambar');
        return $this->datatables->generate();
    }

    public function getData()
    {

        $this->db->select('*');
        $this->db->from('gambar');
        $this->db->order_by('id', 'desc');

        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('gambar', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function simpan_upload($url, $judul, $jenis, $create_date)
    {
        $data['url'] = $url;
        $data['judul'] = $judul;
        $data['jenis'] = $jenis;
        $data['create_date'] = $create_date;
        $result = $this->db->insert('gambar', $data);
        return $result;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('gambar ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('gambar');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('gambar', $data);
        return $this->db->affected_rows();
    }
    public function _deleteImage($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->url)[0];
        return array_map('unlink', glob(FCPATH . "gambar/$filename.*"));
    }
    function delete($id)
    {
        $this->_deleteImage($id);
        $this->db->where('id', $id);
        $this->db->delete('gambar');
    }
}

/* End of file Gambar.php */
