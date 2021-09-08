<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekening extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id, nama, no_rekening, jenis_bank,jenis_bank');
        $this->datatables->from('rekening');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('rekening');
        return $this->db->get()->result();
    }


    public function addData($data)
    {
        $this->db->insert('rekening', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }


    public function get_by_id($id)
    {
        return $this->db->get_where('rekening ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('rekening');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('rekening', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rekening');
    }
}

/* End of file Rekening.php */
