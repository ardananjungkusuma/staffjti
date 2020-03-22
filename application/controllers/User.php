<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

        if ($this->session->userdata('level') != "user" and $this->session->userdata('level') != "admin") {
            redirect('auth', 'refresh');
        }
    }

    public function index()
    {
        if ($this->session->userdata('level') == "admin") {
            $data['title'] = 'Admin Dashboard';
            $this->load->view('user/admin/header', $data);
            $this->load->view('user/index');
        } elseif ($this->session->userdata('level') == "user") {
            if ($this->session->userdata('jabatan') == "dosen") {
                $data['title'] = 'Dosen Dashboard';
                $this->load->view('user/dosen/header', $data);
                $this->load->view('user/index');
            } else {
                $data['title'] = 'Staff Admin Dashboard';
                $this->load->view('user/header', $data);
                $this->load->view('user/index');
            }
        }
    }

    public function hapusDataUser($id)
    {
        $this->user_model->hapusDataUser($id);
        $this->session->flashdata('flash-data-hapus', 'Dihapus');
        redirect('user/listUser', 'refresh');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail User';
        $data['user'] = $this->user_model->getUserById($id);
        $this->load->view('admin/template/header', $data);
        $this->load->view('user/detail', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Form Edit User';
        $data['status'] = ['Aktif', 'Tidak Aktif'];
        $data['level'] = ['admin', 'user', 'kalab'];
        $data['user'] = $this->user_model->getUserById($id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/header', $data);
            $this->load->view('user/edit', $data);
        } else {
            $this->user_model->ubahDataUser();
            $this->session->set_flashdata('flash-data', 'diedit');
            redirect('user/listUser', 'refresh');
        }
    }

    public function changePassword($id)
    {
        $data['title'] = 'Change Password';
        $data['status'] = ['Aktif', 'Tidak Aktif'];
        $data['level'] = ['admin', 'user', 'kalab'];
        $data['user'] = $this->user_model->getUserById($id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[passwordConf]', [
            'matches' => 'Password Doesn"t Match',
        ]);
        $this->form_validation->set_rules('passwordConf', 'Confirmation Password', 'required|trim|min_length[6]|matches[password]');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/header', $data);
            $this->load->view('user/change-password', $data);
        } else {
            $this->user_model->changePassword();
            $this->session->set_flashdata('flash-data', 'diedit');
            redirect('user/listUser', 'refresh');
        }
    }

    public function listUser()
    {
        if ($this->session->userdata('level') == "user") {
            redirect('user', 'refresh');
        } elseif ($this->session->userdata('level') == "admin") {
            $data['title'] = 'Data Admin';
            $data['user'] = $this->user_model->datatabels();
            $this->load->view('user/admin/header', $data);
            $this->load->view('user/list', $data);
            $this->load->view('user/footer');
        } else {
            redirect('auth', 'refresh');
        }
    }
}
