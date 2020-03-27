<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('level') == "user") {
            redirect('user', 'refresh');
        } elseif ($this->session->userdata('level') == "admin") {
            redirect('user', 'refresh');
        }
        $data['title'] = 'Portal Staff JTI Polinema';
        $this->load->view('auth/template/header', $data);
        $this->load->view('auth/index');
    }

    public function login()
    {
        $data['title'] = 'User Login';
        $this->load->view('auth/template/header', $data);
        $this->load->view('auth/login');
    }

    public function register()
    {
        if ($this->session->userdata('level') == "user") {
            redirect('user', 'refresh');
        } elseif ($this->session->userdata('level') == "admin") {
            redirect('admin', 'refresh');
        }
        $data['title'] = 'User Register';
        $this->load->view('auth/template/header', $data);
        $this->load->view('auth/register');
    }

    public function prosesLogin()
    {
        if ($this->session->userdata('level') == "user") {
            redirect('user', 'refresh');
        } elseif ($this->session->userdata('level') == "admin") {
            redirect('admin', 'refresh');
        }
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars(MD5($this->input->post('password')));

        $cekLogin = $this->auth_model->login($username, $password);

        if ($cekLogin) {
            foreach ($cekLogin as $row);
            $this->session->set_userdata('id_user', $row->id_user);
            $this->session->set_userdata('user', $row->username);
            $this->session->set_userdata('level', $row->level);
            $this->session->set_userdata('jabatan', $row->jabatan);
            if ($this->session->userdata('level') == "admin") {
                redirect('user');
            } elseif ($this->session->userdata('level') == "user") {
                redirect('user');
            }
        } else {
            $data['pesan'] = "Maaf Username dan Password anda salah!";
            $data['title'] = 'Login';
            $this->load->view('auth/template/header', $data);
            $this->load->view('auth/login');
        }
    }

    public function prosesRegister()
    {
        $this->form_validation->set_rules('nip', 'Nip', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[passwordConf]', [
            'matches' => 'Password Doesn"t Match',
        ]);
        $this->form_validation->set_rules('passwordConf', 'Confirmation Password', 'required|trim|min_length[6]|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'User Register';
            $this->load->view('auth/template/header', $data);
            $this->load->view('auth/register');
        } else {
            $this->auth_model->register();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulations, your account has been created.
          </div>');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth', 'refresh');
    }
}
