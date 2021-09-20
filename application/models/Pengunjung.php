<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengunjung extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id,username,jenis_kelamin,email,no_hp,create_date,create_date');
        $this->datatables->from('pengunjung');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('pengunjung');
        return $this->db->get()->result();
    }


    function countPengunjung()
    {
        $this->db->select('count(id) as total_pengunjung');
        $this->db->from('pengunjung');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('pengunjung', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function addRating($data)
    {
        $this->db->insert('rating', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('pengunjung ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('pengunjung');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pengunjung', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pengunjung');
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
}

/* End of file Pengunjung.php */