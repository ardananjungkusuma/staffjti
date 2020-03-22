<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    var $API = "";

    public function __construct()
    {
        parent::__construct();
        $this->API = "http://localhost/inventarisjti-server/api";
    }

    public function index()
    {
        $data['title'] = 'Data Barang';
        $result =  $this->curl->simple_get($this->API . '/barang');
        $data['barang'] = json_decode($result, true);
        if ($this->session->userdata('level') == "admin") {
            $this->load->view('user/admin/header', $data);
            $this->load->view('barang/index', $data);
            $this->load->view('user/footer');
        } elseif ($this->session->userdata('level') == "user") {
            if ($this->session->userdata('jabatan') == "dosen") {
                $this->load->view('user/dosen/header', $data);
                $this->load->view('barang/index', $data);
                $this->load->view('user/footer');
            } else {
                $this->load->view('user/header', $data);
                $this->load->view('barang/index', $data);
                $this->load->view('user/footer');
            }
        } else {
            redirect('auth');
        }
    }
}
