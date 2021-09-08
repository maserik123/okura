<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sejarah extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('f.id,f.judul,f.keterangan,g.url,g.url');
        $this->datatables->from('sejarah f');
        $this->datatables->join('gambar g', 'g.id = f.id_gambar', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {

        $this->db->select('f.id,f.judul,f.keterangan,g.url');
        $this->db->from('sejarah f');
        $this->db->join('gambar g', 'g.id = f.id_gambar', 'left');
        return $this->db->get()->result();
    }

    public function getGambarBySejarah()
    {
        $this->db->select('*');
        $this->db->from('gambar');
        $this->db->where('jenis', 'Sejarah');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('sejarah', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function simpan_upload($judul, $keterangan, $foto)
    {
        $data['judul'] = $judul;
        $data['keterangan'] = $keterangan;
        $data['foto'] = $foto;
        $result = $this->db->insert('sejarah', $data);
        return $result;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('sejarah ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('sejarah');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('sejarah', $data);
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
        $this->db->delete('sejarah');
    }
}

/* End of file Fasilitas.php */
