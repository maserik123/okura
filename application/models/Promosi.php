<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Promosi extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('f.id,f.judul,f.keterangan,g.url,g.url');
        $this->datatables->from('promosi f');
        $this->datatables->join('gambar g', 'g.id = f.id_gambar', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {

        $this->db->select('f.id,f.judul,f.keterangan,g.url');
        $this->db->from('promosi f');
        $this->db->join('gambar g', 'g.id = f.id_gambar', 'left');
        return $this->db->get()->result();
    }

    public function getGambarByPromosi()
    {
        $this->db->select('*');
        $this->db->from('gambar');
        $this->db->where('jenis', 'Promosi');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('promosi', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function simpan_upload($judul, $keterangan, $foto)
    {
        $data['judul'] = $judul;
        $data['keterangan'] = $keterangan;
        $data['foto'] = $foto;
        $result = $this->db->insert('promosi', $data);
        return $result;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('promosi ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('promosi');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('promosi', $data);
        return $this->db->affected_rows();
    }
    public function deleteImage($id)
    {
        $product = $this->get_by_id($id);
        $filename = explode(".", $product[0]->bukti_bayar)[0];
        return array_map('unlink', glob(FCPATH . "fasilitas/$filename.*"));
    }
    function delete($id)
    {
        // $this->_deleteImage($id);
        $this->db->where('id', $id);
        $this->db->delete('promosi');
    }
}

/* End of file Fasilitas.php */
