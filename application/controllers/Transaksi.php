<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    var $API = "";

    public function __construct()
    {
        parent::__construct();
        $this->API = "http://localhost/inventarisjti-server/api";
    }

    public function index()
    {
        $data['title'] = 'Data Transaksi';
        $result =  $this->curl->simple_get($this->API . '/transaksi');
        $data['transaksi'] = json_decode($result, true);
        if ($this->session->userdata('level') == "admin") {
            $this->load->view('user/admin/header', $data);
            $this->load->view('transaksi/index', $data);
            $this->load->view('user/footer');
        } elseif ($this->session->userdata('level') == "user") {
            if ($this->session->userdata('jabatan') == "dosen") {
                redirect('user');
            } else {
                $this->load->view('user/header', $data);
                $this->load->view('transaksi/index', $data);
                $this->load->view('user/footer');
            }
        } else {
            redirect('auth');
        }
    }
}
