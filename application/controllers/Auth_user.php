<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_user extends CI_Controller {

    public function index(){
        $this->load->view('user/v_login');
    }

    public function login(){
        $nim      = $this->input->post('nim');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('nim','Nim','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run() != false){
            $where = array(
                'nim' => $nim,
                'password' => md5($password)
            );

            $data = $this->m_master->edit_data($where,'tb_anggota')->num_rows();
            $d    = $this->m_master->edit_data($where,'tb_anggota')->row();

            if($data>0){
                $session = array (
                    'nim'     => $d->nim,
                    'nama'   => $d->nama,
                    'status' => 'masuk'
                );
                $this->session->set_userdata($session);
                redirect('user');
            }
            else{
                redirect('auth_user?pesan=gagal');
            }
        }
        else{
            $this->load->view('user/v_login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth_user?pesan=logout');
    }
}