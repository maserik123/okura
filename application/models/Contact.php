<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id, no_hp, instagram, facebook, whatsapp, keterangan, keterangan');
        $this->datatables->from('contact');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('id,no_hp,instagram,facebook,whatsapp,keterangan');
        $this->db->from('contact');
        return $this->db->get()->result();
    }


    public function addData($data)
    {
        $this->db->insert('contact', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }


    public function get_by_id($id)
    {
        return $this->db->get_where('contact ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('contact');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('contact', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('contact');
    }
}

/* End of file Fasilitas.php */
