<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rating extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('r.id,r.kategori,r.komentar,p.username,p.username');
        $this->datatables->from('rating r');
        $this->datatables->join('pemesanan_tiket p', 'p.id = r.id_pemesanan', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('rating');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('rating', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function addRating($data)
    {
        $this->db->insert('rating', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('rating ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('rating');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('rating', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rating');
    }
}

/* End of file Rating.php */
