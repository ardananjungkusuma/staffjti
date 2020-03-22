<?php

defined('BASEPATH') or exit('No direct script access allowed');

class auth_model extends CI_Model
{
    function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function register()
    {
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => htmlspecialchars(MD5($this->input->post('password'))),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'nip' => htmlspecialchars($this->input->post('nip', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
            'level' => 'user'
        ];
        $this->db->insert('staff', $data);
    }
}
