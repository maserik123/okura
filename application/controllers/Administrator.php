<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('User', 'Pemesanan_tiket', 'Pengunjung', 'Denah', 'Gambar', 'Fasilitas', 'Promosi', 'Sejarah', 'Contact', 'Rating', 'Rekening'));
    }

    public function index()
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_home'] = 'active';
            $view['title']       = 'Beranda';
            $view['pageName']    = 'home';
        }
        $this->load->view('index_admin', $view);
    }

    public function pemesananTiket($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_pemesananTiket'] = 'active';
            $view['title']                 = 'Pemesanan Tiket';
            $view['pageName']              = 'pemesananTiket';
            if ($param == 'getAllData') {
                $dt    = $this->Pemesanan_tiket->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = '<center><button class="btn btn-mini btn-info">' . $row->username . '</button></center>';
                    $th3 = $row->kode_tiket;
                    $th4 = tgl_indo($row->tanggal);
                    $th5 = '<center>' . $row->jml_tiket . '</center>';
                    $th6 = $row->status == 0 ? '<center>' . get_btn_verifikasi1('verifikasi("' . $id . '")', 'unverifikasi("' . $id . '")') . '</center>' : ($row->status == 1 ? '<div class="label label-mini bg-green">Telah diverifikasi</div>' : 'Pesanan ditolak');
                    $th7 = empty($row->bukti_bayar) ? '<p style="color:black; text-align:center; background-color:red;">Bukti belum diupload !</p>' : '<img src="../bill_of_payment/' . $row->bukti_bayar . '" height="150px" width="150px">';
                    // $th8 = get_btn_delete('hapus("' . $id . '")');
                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'delete') {
                $this->Pemesanan_tiket->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'verify') {
                $data['status']   = 1;
                $result['messages'] = '';
                $this->Pemesanan_tiket->update($id, $data);
                $result = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'unverify') {
                $data['status']   = 2;
                $result['messages'] = '';
                $this->Pemesanan_tiket->update($id, $data);
                $result = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }

    public function pengunjung($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_pengunjung'] = 'active';
            $view['title']             = 'Pengunjung';
            $view['pageName']          = 'pengunjung';
            if ($param == 'getAllData') {
                $dt    = $this->Pengunjung->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = '<center><button class="btn btn-mini btn-info">' . $row->username . '</button></center>';
                    $th3 = '<center>' . $row->jenis_kelamin . '</center>';
                    $th4 = $row->email;
                    $th5 = $row->no_hp;
                    $th6 = tgl_indo($row->create_date);
                    $th7 = get_btn_delete('hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'delete') {
                $this->Pengunjung->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }

    public function denah($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_denah'] = 'active';
            $view['title']        = 'Denah';
            $view['pageName']     = 'denah';
            if ($param == 'getAllData') {
                $dt    = $this->Denah->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = $row->nama_bunga;
                    $th3 = '<img src="../denah/' . $row->gambar . '" width="150px" height="150px">';
                    $th4 = $row->status;
                    $th5 = tgl_indo($row->create_date);
                    $th6 = get_btn_group2('ubah_gambar("' . $id . '")', 'ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $data = $this->Denah->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("nama_bunga1", "Nama Bunga", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("gambar1", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("status1", "Status", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $aidi          = $this->input->post('id1');
                    $data['nama_bunga']  = htmlspecialchars($this->input->post('nama_bunga1'));
                    $data['gambar']      = $this->input->post('gambar1');
                    $data['status']      = htmlspecialchars($this->input->post('status1'));
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date1'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Denah->update($aidi, $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'updateGambar') {
                $config['upload_path']   = "./denah";
                $config['allowed_types'] = 'gif|jpg|png|jpeg|png|bmp';
                $config['remove_spaces'] = TRUE;
                if (!empty($_FILES['gambar2']['name'])) {
                    $this->load->library('upload', $config);
                    $aidi = $this->input->post('id2');
                    // $db['nama_bunga']  = htmlspecialchars($this->input->post('nama_bunga'));
                    $cek = $this->Denah->getById($aidi);
                    if (empty($_FILES['gambar2']['name'])) {
                        $db['gambar'] = $cek[0]->gambar;
                    } else {
                        $db['gambar'] = str_replace(' ', '_', $_FILES['gambar2']['name']);
                    }
                    // $db['status']      = htmlspecialchars($this->input->post('status'));
                    // $db['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $cekData = $this->Denah->getData();
                    if ($cekData[0]->gambar != $db['gambar']) {
                        $this->Denah->_deleteImage($aidi);
                        $this->Denah->update($aidi, $db);
                        $this->upload->do_upload('gambar2');
                        $this->session->set_flashdata('alert', 'Berhasil Mengupload Data');

                        redirect('administrator/denah');
                    } else {
                        $this->session->set_flashdata('alert', 'Gagal Mengupload Data, Gambar yang anda pilih sudah ada!');

                        redirect('administrator/denah');
                    }
                }
            } else if ($param == 'delete') {
                $this->Denah->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }

    public function uploadDenah()
    {

        $config['upload_path']   = "./denah";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|png|bmp';
        $config['remove_spaces'] = TRUE;
        if (!empty($_FILES['gambar']['name'])) {
            $this->load->library('upload', $config);
            $db['nama_bunga']  = htmlspecialchars($this->input->post('nama_bunga'));
            $db['gambar']      = $_FILES['gambar']['name'];
            $db['status']      = htmlspecialchars($this->input->post('status'));
            $db['create_date'] = htmlspecialchars($this->input->post('create_date'));
            $cekData       = $this->Denah->getData();
            if ($cekData[0]->gambar != $db['gambar']) {
                $this->Denah->simpan_upload($db['nama_bunga'], str_replace(' ', '_', $db['gambar']), $db['status'], $db['create_date']);
                $this->upload->do_upload('gambar');
                $this->session->set_flashdata('alert', 'Berhasil Mengupload Data');

                redirect('administrator/denah');
            } else {
                $this->session->set_flashdata('alert', 'Gagal Mengupload Data, Gambar yang anda pilih sudah ada!');

                redirect('administrator/denah');
            }
        }
    }

    public function uploadGambar()
    {
        $config['upload_path']   = "./gambar";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|png|bmp';
        $config['remove_spaces'] = TRUE;
        if (!empty($_FILES['url']['name'])) {
            $this->load->library('upload', $config);
            $db['url']         = $_FILES['url']['name'];
            $db['judul']       = htmlspecialchars($this->input->post('judul'));
            $db['jenis']       = htmlspecialchars($this->input->post('jenis'));
            $db['create_date'] = htmlspecialchars($this->input->post('create_date'));
            $cekData       = $this->Gambar->getData();
            if ($cekData[0]->url != $db['url']) {
                $this->Gambar->simpan_upload(str_replace(' ', '_', $db['url']), $db['judul'], $db['jenis'], $db['create_date']);
                $this->upload->do_upload('url');
                $this->session->set_flashdata('alert', 'Berhasil Mengupload Data');
                redirect('administrator/gambar');
            } else {
                $this->session->set_flashdata('alert', 'Gagal Mengupload Data, Gambar yang anda pilih sudah ada!');

                redirect('administrator/gambar');
            }
        }
    }

    public function fasilitas($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_fasilitas']     = 'active';
            $view['title']                = 'Fasilitas';
            $view['pageName']             = 'fasilitas';
            $view['getGambarByFasilitas'] = $this->Fasilitas->getGambarByFasilitas();
            if ($param == 'getAllData') {
                $dt    = $this->Fasilitas->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = $row->judul;
                    $th3 = $row->keterangan;
                    $th4 = '<img src="../gambar/' . $row->url . '" width="150px" height="150px">';
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['judul']       = htmlspecialchars($this->input->post('judul'));
                    $data['keterangan']  = $this->input->post('keterangan');
                    $data['id_gambar']   = htmlspecialchars($this->input->post('id_gambar'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Fasilitas->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'getById') {
                $data = $this->Fasilitas->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $aidi = $this->input->post('id');
                    $data['judul']       = htmlspecialchars($this->input->post('judul'));
                    $data['keterangan']  = $this->input->post('keterangan');
                    $data['id_gambar']   = htmlspecialchars($this->input->post('id_gambar'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Fasilitas->update($aidi, $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Fasilitas->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }

    public function promosi($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_promosi'] = 'active';
            $view['title']          = 'Promosi';
            $view['pageName']       = 'promosi';
            $view['getGambarByPromosi'] = $this->Promosi->getGambarByPromosi();
            if ($param == 'getAllData') {
                $dt    = $this->Promosi->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = $row->judul;
                    $th3 = $row->keterangan;
                    $th4 = '<img src="../gambar/' . $row->url . '" width="150px" height="150px">';
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['judul']       = htmlspecialchars($this->input->post('judul'));
                    $data['keterangan']  = $this->input->post('keterangan');
                    $data['id_gambar']   = htmlspecialchars($this->input->post('id_gambar'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Promosi->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'getById') {
                $data = $this->Promosi->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $aidi = $this->input->post('id');
                    $data['judul']       = htmlspecialchars($this->input->post('judul'));
                    $data['keterangan']  = $this->input->post('keterangan');
                    $data['id_gambar']   = htmlspecialchars($this->input->post('id_gambar'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Promosi->update($aidi, $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Promosi->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }

    public function sejarah($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_sejarah'] = 'active';
            $view['title']          = 'Sejarah';
            $view['pageName']       = 'sejarah';
            $view['getGambarBySejarah'] = $this->Sejarah->getGambarBySejarah();
            if ($param == 'getAllData') {
                $dt    = $this->Sejarah->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = $row->judul;
                    $th3 = $row->keterangan;
                    $th4 = '<img src="../gambar/' . $row->url . '" width="150px" height="150px">';
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['judul']       = htmlspecialchars($this->input->post('judul'));
                    $data['keterangan']  = $this->input->post('keterangan');
                    $data['id_gambar']   = htmlspecialchars($this->input->post('id_gambar'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Sejarah->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'getById') {
                $data = $this->Sejarah->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $aidi = $this->input->post('id');
                    $data['judul']       = htmlspecialchars($this->input->post('judul'));
                    $data['keterangan']  = $this->input->post('keterangan');
                    $data['id_gambar']   = htmlspecialchars($this->input->post('id_gambar'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Sejarah->update($aidi, $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Sejarah->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }
    public function contact($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_contact'] = 'active';
            $view['title']          = 'Contact';
            $view['pageName']       = 'contact';
            if ($param == 'getAllData') {
                $dt    = $this->Contact->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = $row->no_hp;
                    $th3 = $row->instagram;
                    $th4 = $row->facebook;
                    $th5 = $row->whatsapp;
                    $th6 = $row->keterangan;
                    $th7 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("no_hp", "No HP", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("instagram", "Instagram", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("facebook", "Facebook", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("whatsapp", "Whatsapp", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['no_hp']       = htmlspecialchars($this->input->post('no_hp'));
                    $data['instagram']  = $this->input->post('instagram');
                    $data['facebook']   = htmlspecialchars($this->input->post('facebook'));
                    $data['whatsapp']   = htmlspecialchars($this->input->post('whatsapp'));
                    $data['keterangan']   = htmlspecialchars($this->input->post('keterangan'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Contact->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'getById') {
                $data = $this->Contact->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("no_hp", "No HP", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("instagram", "Instagram", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("facebook", "Facebook", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("whatsapp", "Whatsapp", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("keterangan", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $aidi = $this->input->post('id');
                    $data['no_hp']       = htmlspecialchars($this->input->post('no_hp'));
                    $data['instagram']  = $this->input->post('instagram');
                    $data['facebook']   = htmlspecialchars($this->input->post('facebook'));
                    $data['whatsapp']   = htmlspecialchars($this->input->post('whatsapp'));
                    $data['keterangan']   = htmlspecialchars($this->input->post('keterangan'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Contact->update($aidi, $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Contact->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }

    public function rating($param = '', $id = '')
    {
        $view['active_rating'] = 'active';
        $view['title']          = 'Rating';
        $view['pageName']       = 'rating';
        if ($param == 'getAllData') {
            $dt    = $this->Rating->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id  = $row->id;
                $th1 = '<center>' . ++$start . '</center>';
                $th2 = $row->kategori;
                $th3 = $row->komentar;
                $th4 = $row->username;
                $th5 = get_btn_delete('hapus("' . $id . '")');
                $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'delete') {
            $this->Rating->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
        $this->load->view('index_admin', $view);
    }

    public function gambar($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_gambar'] = 'active';
            $view['title']         = 'gambar';
            $view['pageName']      = 'gambar';
            if ($param == 'getAllData') {
                $dt    = $this->Gambar->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = '<img src="../gambar/' . $row->url . '" width="150" height="150">';
                    $th3 = $row->judul;
                    $th4 = $row->jenis;
                    $th5 = tgl_indo($row->create_date);
                    $th6 = get_btn_delete('hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'addData') {
            } else if ($param == 'delete') {
                $this->Gambar->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }

    public function rekening($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['active_rekening'] = 'active';
            $view['title']          = 'Rekening';
            $view['pageName']       = 'rekening';
            if ($param == 'getAllData') {
                $dt    = $this->Rekening->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<center>' . ++$start . '</center>';
                    $th2 = $row->nama;
                    $th3 = $row->no_rekening;
                    $th4 = $row->jenis_bank;
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("nama", "Nama", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_rekening", "No Rekening", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("jenis_bank", "Jenis Bank", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['nama']       = htmlspecialchars($this->input->post('nama'));
                    $data['no_rekening']  = $this->input->post('no_rekening');
                    $data['jenis_bank']   = htmlspecialchars($this->input->post('jenis_bank'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Rekening->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'getById') {
                $data = $this->Rekening->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("nama", "Nama", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_rekening", "No Rekening", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("jenis_bank", "Jenis Bank", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $aidi = $this->input->post('id');
                    $data['nama']       = htmlspecialchars($this->input->post('nama'));
                    $data['no_rekening']  = $this->input->post('no_rekening');
                    $data['jenis_bank']   = htmlspecialchars($this->input->post('jenis_bank'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Rekening->update($aidi, $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Rekening->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
        $this->load->view('index_admin', $view);
    }
}

/* End of file Administrator.php */
