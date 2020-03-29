<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    var $API = "";

    public function __construct()
    {
        parent::__construct();
        $this->API = "http://localhost/inventarisjti/api";
    }

    public function index()
    {
        $data['title'] = 'Data Mahasiswa';
        $result =  $this->curl->simple_get($this->API . '/mahasiswa');
        $data['mahasiswa'] = json_decode($result, true);
        if ($this->session->userdata('level') == "admin") {
            $this->load->view('user/admin/header', $data);
            $this->load->view('mahasiswa/index', $data);
            $this->load->view('user/footer');
        } elseif ($this->session->userdata('level') == "user") {
            if ($this->session->userdata('jabatan') == "dosen") {
                redirect('user/index');
            } else {
                $this->load->view('user/header', $data);
                $this->load->view('mahasiswa/index', $data);
                $this->load->view('user/footer');
            }
        } else {
            redirect('auth');
        }
    }

    public function tambah()
    {
        if ($this->session->userdata('level') == "admin") {
            if (isset($_POST['submit'])) {
                $data = array(
                    'nim'       =>  $this->input->post('nim'),
                    'nama'      =>  $this->input->post('nama'),
                    'no_hp'      =>  $this->input->post('no_hp'),
                    'alamat' =>  $this->input->post('alamat')
                );
                $insert =  $this->curl->simple_post($this->API . '/mahasiswa', $data, array(CURLOPT_BUFFERSIZE => 10));
                if ($insert) {
                    $this->session->set_flashdata('hasil', 'Tambah Data Berhasil');
                } else {
                    $this->session->set_flashdata('hasil', 'Tambah Data Gagal');
                }
                redirect('mahasiswa');
            } else {
                $data['title'] = "Tambah Mahasiswa";
                $this->load->view('user/header', $data);
                $this->load->view('mahasiswa/tambah');
            }
        } elseif ($this->session->userdata('level') == "user") {
            if ($this->session->userdata('jabatan') == "dosen") {
                redirect('user/index');
            } else {
                if (isset($_POST['submit'])) {
                    $data = array(
                        'nim'       =>  $this->input->post('nim'),
                        'nama'      =>  $this->input->post('nama'),
                        'no_hp'      =>  $this->input->post('no_hp'),
                        'alamat' =>  $this->input->post('alamat')
                    );
                    $insert =  $this->curl->simple_post($this->API . '/mahasiswa', $data, array(CURLOPT_BUFFERSIZE => 10));
                    if ($insert) {
                        $this->session->set_flashdata('hasil', 'Tambah Data Berhasil');
                    } else {
                        $this->session->set_flashdata('hasil', 'Tambah Data Gagal');
                    }
                    redirect('mahasiswa');
                } else {
                    $data['title'] = "Tambah Mahasiswa";
                    $this->load->view('user/header', $data);
                    $this->load->view('mahasiswa/tambah');
                }
            }
        } else {
            redirect('auth');
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata('level') == "admin") {
            if (isset($_POST['submit'])) {
                $data = array(
                    'id_mahasiswa'       =>  $this->input->post('id_mahasiswa'),
                    'nama'      =>  $this->input->post('nama'),
                    'nim'      =>  $this->input->post('nim'),
                    'no_hp'      =>  $this->input->post('no_hp'),
                    'alamat' =>  $this->input->post('alamat')
                );
                $update =  $this->curl->simple_put($this->API . '/mahasiswa', $data, array(CURLOPT_BUFFERSIZE => 10));
                if ($update) {
                    $this->session->set_flashdata('hasil', 'Update Data Berhasil');
                } else {
                    $this->session->set_flashdata('hasil', 'Update Data Gagal');
                }
                redirect('mahasiswa');
            } else {
                $data['mahasiswa'] = json_decode($this->curl->simple_get($this->API . '/mahasiswa?id_mahasiswa=' . $id));
                $data['title'] = "Edit Mahasiswa";
                $this->load->view('user/header', $data);
                $this->load->view('mahasiswa/edit', $data);
            }
        } elseif ($this->session->userdata('level') == "user") {
            if ($this->session->userdata('jabatan') == "dosen") {
                redirect('user/index');
            } else {
                if (isset($_POST['submit'])) {
                    $data = array(
                        'id_mahasiswa'       =>  $this->input->post('id_mahasiswa'),
                        'nama'      =>  $this->input->post('nama'),
                        'nim'      =>  $this->input->post('nim'),
                        'no_hp'      =>  $this->input->post('no_hp'),
                        'alamat' =>  $this->input->post('alamat')
                    );
                    $update =  $this->curl->simple_put($this->API . '/mahasiswa', $data, array(CURLOPT_BUFFERSIZE => 10));
                    if ($update) {
                        $this->session->set_flashdata('hasil', 'Update Data Berhasil');
                    } else {
                        $this->session->set_flashdata('hasil', 'Update Data Gagal');
                    }
                    redirect('mahasiswa');
                } else {
                    $data['mahasiswa'] = json_decode($this->curl->simple_get($this->API . '/mahasiswa?id_mahasiswa=' . $id));
                    $data['title'] = "Edit Mahasiswa";
                    $this->load->view('user/header', $data);
                    $this->load->view('mahasiswa/edit', $data);
                }
            }
        } else {
            redirect('auth');
        }
    }

    public function hapus($id)
    {
        if ($this->session->userdata('level') == "admin") {
            if (empty($id)) {
                redirect('mahasiswa');
            } else {
                $delete =  $this->curl->simple_delete($this->API . '/mahasiswa?id_mahasiswa=', array('id_mahasiswa' => $id), array(CURLOPT_BUFFERSIZE => 10));
                if ($delete) {
                    $this->session->set_flashdata('hasil', 'Delete Data gagal');
                } else {
                    $this->session->set_flashdata('hasil', 'Delete Data Berhasil');
                }
                redirect('mahasiswa');
            }
        } elseif ($this->session->userdata('level') == "user") {
            if ($this->session->userdata('jabatan') == "dosen") {
                redirect('user/index');
            } else {
                if (empty($id)) {
                    redirect('mahasiswa');
                } else {
                    $delete =  $this->curl->simple_delete($this->API . '/mahasiswa?id_mahasiswa=' . $id, array(CURLOPT_BUFFERSIZE => 10));
                    if ($delete) {
                        $this->session->set_flashdata('hasil', 'Delete Data Gagal');
                    } else {
                        $this->session->set_flashdata('hasil', 'Delete Data Berhasil');
                    }
                    redirect('mahasiswa');
                }
            }
        } else {
            redirect('auth');
        }
    }
}
