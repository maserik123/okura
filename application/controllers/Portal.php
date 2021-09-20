<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Portal extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->gallery_path     = realpath(APPPATH . 'bill_of_payment/');
        $this->gallery_path_url = base_url() . 'bill_of_payment/';
        $this->load->model(array('Pengunjung', 'Rekening', 'Pemesanan_tiket', 'Rating', 'Fasilitas', 'Sejarah', 'Denah', 'Promosi', 'Contact'));
    }

    public function index()
    {
        $view['title']       = 'Beranda';
        $view['pageName']    = 'home';
        $view['active_home'] = 'active';
        $this->load->view('index_portal', $view);
    }

    public function pemesanan_tiket($param = '', $id = '')
    {
        # code...
        if (!($this->session->userdata('status') == 'login')) {

            $view['title']                  = 'Pemesanan Tiket';
            $view['pageName']               = 'pemesanan_tiket';
            $view['active_pemesanan_tiket'] = 'active';
            $this->load->view('index_portal', $view);
        } else {
            $view['title']          = 'Pengunjung';
            $view['pageName']       = 'pengunjung';
            $view['active_beranda'] = 'active';
            $view['dataRekening']   = $this->Rekening->getData();
            $view['dataPemesanan']  = $this->Pemesanan_tiket->getData();

            $this->load->view('index_portal_pengunjung', $view);
        }
    }

    public function approvedTiket($id = '')
    {
        if (!($this->session->userdata('status') == 'login')) {

            $view['title']                  = 'Pemesanan Tiket';
            $view['pageName']               = 'pemesanan_tiket';
            $view['active_pemesanan_tiket'] = 'active';
            $this->load->view('index_portal', $view);
        } else {
            $view['title']          = 'Ambil tiket';
            $view['pageName']       = 'approvedTiket';
            $view['active_beranda'] = 'active';
            $view['dataRekening']   = $this->Rekening->getData();
            $view['dataPemesanan']  = $this->Pemesanan_tiket->getData();
            $view['dataTiket']      = $this->Pemesanan_tiket->get_ById($id);

            $this->load->view('index_portal_pengunjung', $view);
        }
    }

    public function listTiket()
    {
        if (!($this->session->userdata('status') == 'login')) {
            redirect('portal/pemesanan_tiket');
        } else {
            $view['title']         = 'Ambil tiket';
            $view['pageName']      = 'listTiket';
            $view['active_tiket']  = 'active';
            $view['dataRekening']  = $this->Rekening->getData();
            $view['dataPemesanan'] = $this->Pemesanan_tiket->getData1();
            // $view['dataTiket'] = $this->Pemesanan_tiket->get_ById($id);

            $this->load->view('index_portal_pengunjung', $view);
        }
    }

    public function denah($param = '', $id = '')
    {
        $view['title']        = 'Denah';
        $view['pageName']     = 'denah';
        $view['active_denah'] = 'active';
        $view['getData']      = $this->Denah->getData();
        $this->load->view('index_portal', $view);
    }

    public function fasilitas($param = '', $id = '')
    {
        $view['title']            = 'Fasilitas';
        $view['pageName']         = 'fasilitas';
        $view['active_fasilitas'] = 'active';
        $view['getDataFasilitas'] = $this->Fasilitas->getData();
        if (empty($param)) {
        }
        $this->load->view('index_portal', $view);
    }

    public function sejarah($param = '', $id = '')
    {
        $view['title']          = 'Fasilitas';
        $view['pageName']       = 'sejarah';
        $view['active_sejarah'] = 'active';
        $view['getDataSejarah'] = $this->Sejarah->getData();
        if (empty($param)) {
        }
        $this->load->view('index_portal', $view);
    }

    public function rating()
    {
        $view['title']         = 'Rating dan Review';
        $view['pageName']      = 'rating';
        $view['active_rating'] = 'active';
        $view['getDataRating'] = $this->Rating->getData();
        $this->load->view('index_portal', $view);
    }

    public function addFeedBack()
    {
        $this->form_validation->set_rules("kategori", "Kategori", "trim|required|is_unique[pengunjung.username]", array('required' => '{field} Wajib diisi !', 'is_unique' => 'Username yang anda masukkan sudah ada, silahkan masukkan username lain !'));
        $this->form_validation->set_rules("komentar", "Komentar", "trim|required", array('required' => '{field} Wajib diisi !'));
        $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');

        if ($this->form_validation->run() == FALSE) {
            $result = array('status' => 'error', 'msg' => 'Terdapat formulir yang masih kosong atau belum benar!');
            foreach ($_POST as $key => $value) {
                $result['messages'][$key] = form_error($key);
            }
        } else {
            $data['kategori']     = htmlspecialchars($this->input->post('kategori'));
            $data['komentar']     = htmlspecialchars($this->input->post('komentar'));
            $data['id_pemesanan'] = $this->input->post('id_pemesanan');
            $result['messages']     = '';
            $result         = array('status' => 'success', 'msg' => 'Terimakasih atas partisipasi anda karena telah mengunjungi Taman Bunga Impian Okura !');
            $this->Pengunjung->addRating($data);
            $dc['feedback'] = 1;
            $this->Pemesanan_tiket->update($data['id_pemesanan'], $dc);
            // $this->Pemesanan_tiket->deleteImage($data['id_pemesanan']);
        }

        $csrf    = array(
            'token' => $this->security->get_csrf_hash()
        );
        echo json_encode(array('result' => $result, 'csrf' => $csrf));
        die;
    }

    public function promosi($param = '', $id = '')
    {
        $view['title']          = 'Promosi';
        $view['pageName']       = 'promosi';
        $view['active_promosi'] = 'active';
        $view['getDataPromosi'] = $this->Promosi->getData();
        $this->load->view('index_portal', $view);
    }

    public function contact($param = '', $id = '')
    {
        $view['title']          = 'Promosi';
        $view['pageName']       = 'contact';
        $view['active_contact'] = 'active';
        $view['getData']        = $this->Contact->getData();
        $this->load->view('index_portal', $view);
    }

    public function regis_pengunjung($param = '', $id = '')
    {
        $view['title']                  = 'Pengunjung';
        $view['pageName']               = 'regis_pengunjung';
        $view['active_pemesanan_tiket'] = 'active';
        if (empty($param)) {
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("username", "Username", "trim|required|is_unique[pengunjung.username]", array('required' => '{field} Wajib diisi !', 'is_unique' => 'Username yang anda masukkan sudah ada, silahkan masukkan username lain !'));
            $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jenis_kelamin", "Jenis Kelamin", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("email", "Email", "trim|required|is_unique[pengunjung.email]", array('required' => '{field} Wajib diisi !', 'is_unique' => 'Email Sudah terdaftar !'));
            $this->form_validation->set_rules("no_hp", "No Hp", "trim|required|is_unique[pengunjung.no_hp]", array('required' => '{field} Wajib diisi !', 'is_unique' => 'No Hp Sudah terdaftar !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Terdapat formulir yang masih kosong atau belum benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['username']      = htmlspecialchars($this->input->post('username'));
                $data['password']      = md5($this->input->post('password'));
                $data['jenis_kelamin'] = htmlspecialchars($this->input->post('jenis_kelamin'));
                $data['email']         = htmlspecialchars($this->input->post('email'));
                $data['no_hp']         = htmlspecialchars($this->input->post('no_hp'));
                $data['create_date']   = date('Y-m-d');

                $result['messages'] = '';
                $result     = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Pengunjung->addData($data);
            }

            $csrf    = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
        $this->load->view('index_portal', $view);
    }

    public function pembayaran($param = '', $id = '')
    {
        if (empty($param)) {
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("tanggal", "Tanggal", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jml_tiket", "Jumlah Tiket", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_rekening", "Bank Tujuan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Terdapat formulir yang masih kosong atau belum benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['kode_tiket']  = 'T-O' . $this->session->userdata('username') . $this->input->post('jml_tiket') . '-' . $this->input->post('tanggal');
                $data['jenis_pemesanan']     = 'Online Melalui Aplikasi';
                $data['tanggal']     = htmlspecialchars($this->input->post('tanggal'));
                $data['jumlah_bayar']   = 5000;
                $data['jml_tiket']   = htmlspecialchars($this->input->post('jml_tiket'));
                $data['id_rekening'] = htmlspecialchars($this->input->post('id_rekening'));
                $data['create_date'] = date('Y-m-d H:i:s');
                $data['username']    = $this->session->userdata('username');

                $result['messages'] = '';
                if ($data['tanggal'] < date('Y-m-d')) {
                    $result = array('status' => 'error', 'msg' => 'Tanggal yang anda masukkan tidak tepat !');
                } else {
                    $result = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->Pemesanan_tiket->addData($data);
                }
            }
            $csrf    = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'add') {
            $config['upload_path']   = './bill_of_payment';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['remove_spaces'] = TRUE;
            if (!empty($_FILES['bukti_bayar']['name'])) {
                $this->load->library('upload', $config);

                $db['bukti_bayar'] = $_FILES['bukti_bayar']['name'];
                $db['tanggal']     = htmlspecialchars($this->input->post('tanggal'));
                $db['jml_tiket']   = htmlspecialchars($this->input->post('jml_tiket'));
                $db['id_rekening'] = htmlspecialchars($this->input->post('id_rekening'));
                $db['create_date'] = date('Y-m-d');
                $db['id_pengguna'] = $this->session->userdata('id');

                $this->Pemesanan_tiket->simpan_upload($db['tanggal'], $db['jml_tiket'], $db['id_rekening'], str_replace(' ', '_', $db['bukti_bayar']), $db['create_date']);
                $this->upload->do_upload('bukti_bayar');
                redirect('portal/upload_bayar');
                $this->session->set_flashdata('notif', 'Berhasil memasukkan data gambar !');
                // echo 'Berhasil';
            } else {
                echo 'tidak ada file yang dipilih';
            }
        } else if ($param == 'getById') {
            $data = $this->Pemesanan_tiket->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'delete') {
            $this->Pemesanan_tiket->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    public function upload_bayar($id = '')
    {
        if (!($this->session->userdata('status') == 'login')) {
        } else {
            $view['title']          = 'Upload Pembayaran';
            $view['pageName']       = 'upload_bayar';
            $view['active_beranda'] = 'active';
            $view['dataRekening']   = $this->Rekening->getData();
            $view['dataPemesanan']  = $this->Pemesanan_tiket->getData();
            $view['pembayaran']     = $this->Pemesanan_tiket->get_ById($id);

            $config['upload_path']   = './bill_of_payment';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['remove_spaces'] = TRUE;
            if (!empty($_FILES['bukti_bayar']['name'])) {
                $this->load->library('upload', $config);
                $db_id         = $this->input->post('id');
                $db['bukti_bayar'] = $_FILES['bukti_bayar']['name'];
                $this->Pemesanan_tiket->update($db_id, str_replace(' ', '_', $db));
                $this->upload->do_upload('bukti_bayar');
                redirect('portal/pemesanan_tiket');
            }

            $this->load->view('index_portal_pengunjung', $view);
        }
    }

    function login()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        $where    = array(
            'username like binary' => $username,
            'password like binary' => md5($password)
        );
        $cek = $this->Pengunjung->cek_login("pengunjung", $where)->num_rows();
        if ($cek > 0) {
            $data_session = array(
                'username' => $username,
                'status'   => 'login',
            );
            $this->session->set_userdata($data_session);
            $this->session->set_flashdata('notif', 'Berhasil Login !');

            redirect('portal/pemesanan_tiket');
        } else {
            echo 'Password salah bro';
            redirect('portal/false_pwd');
        }
    }

    public function false_pwd()
    {

        $view['title']                  = 'Ambil tiket';
        $view['pageName']               = 'notif';
        $view['active_pemesanan_tiket'] = 'active';
        $view['dataRekening']           = $this->Rekening->getData();
        $view['dataPemesanan']          = $this->Pemesanan_tiket->getData();
        // $view['dataTiket'] = $this->Pemesanan_tiket->get_ById($id);

        $this->load->view('index_portal', $view);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('portal/pemesanan_tiket');
    }
}

/* End of file Portal.php */
