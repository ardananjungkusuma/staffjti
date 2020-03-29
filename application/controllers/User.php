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
}
