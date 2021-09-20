<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan_tiket extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id,kode_tiket,jenis_pemesanan,tanggal,jml_tiket,status,bukti_bayar,jenis_akun,username,username');
        $this->datatables->from('pemesanan_tiket');
        return $this->datatables->generate();
    }

    public function getAllData1($bulan)
    {
        $this->db->select('*');
        $this->db->from('pemesanan_tiket');
        $this->db->where('MONTH(tanggal) ', $bulan);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    function visualisasiPemasukan()
    {
        $this->db->select('count(id) as total, sum(jumlah_bayar) as tot, MONTH(tanggal) as bulan');
        $this->db->from('pemesanan_tiket');
        $this->db->group_by('MONTH(tanggal)');
        $this->db->where('YEAR(tanggal)', date('Y'));
        $this->db->order_by('MONTH(tanggal)', 'asc');
        return $this->db->get()->result();
    }

    function countTransaksi($status)
    {
        $this->db->select('count(id) as total');
        $this->db->from('pemesanan_tiket');
        $this->db->where('status', $status);
        return $this->db->get()->result();
    }


    public function total($bulan)
    {
        $this->db->select('sum(jumlah_bayar) as total_keseluruhan');
        $this->db->from('pemesanan_tiket');
        $this->db->where('MONTH(tanggal) ', $bulan);
        return $this->db->get()->result();
    }

    public function getData()
    {

        $this->db->select('*');
        $this->db->from('pemesanan_tiket');
        $this->db->limit(6);
        $this->db->order_by('id', 'desc');
        $this->db->where('username', $this->session->userdata('username'));

        return $this->db->get()->result();
    }

    public function getData1()
    {

        $this->db->select('*');
        $this->db->from('pemesanan_tiket');
        $this->db->order_by('id', 'desc');
        $this->db->where('username', $this->session->userdata('username'));

        return $this->db->get()->result();
    }

    public function getByUser_Id($username)
    {
        $this->db->select('*');
        $this->db->from('pemesanan_tiket');
        $this->db->where('username', $username);
        // $this->db->where('id', $id);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('pemesanan_tiket', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function simpan_upload($tanggal, $jml_tiket, $id_rekening, $bukti_bayar, $create_date)
    {
        $data['tanggal'] = $tanggal;
        $data['jml_tiket'] = $jml_tiket;
        $data['id_rekening'] = $id_rekening;
        $data['bukti_bayar'] = $bukti_bayar;
        $data['create_date'] = $create_date;

        $result = $this->db->insert('pemesanan_tiket', $data);
        return $result;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('pemesanan_tiket ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('pemesanan_tiket');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    public function get_ById($id)
    {
        $this->db->select('r.nama,r.no_rekening,r.jenis_bank,p.id,p.kode_tiket,p.tanggal,p.jml_tiket,p.id_rekening,p.status,p.bukti_bayar,p.create_date,p.username');
        $this->db->from('pemesanan_tiket p');
        $this->db->join('rekening r', 'r.id = p.id_rekening', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->result();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pemesanan_tiket', $data);
        return $this->db->affected_rows();
    }
    private function _deleteImage($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->bukti_bayar)[0];
        return array_map('unlink', glob(FCPATH . "../bill_of_payment/$filename.*"));
    }
    function delete($id)
    {
        $this->_deleteImage($id);
        $this->db->where('id', $id);
        $this->db->delete('pemesanan_tiket');
    }
}

/* End of file Pemesanan_tiket.php */