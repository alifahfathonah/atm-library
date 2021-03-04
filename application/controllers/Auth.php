<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index(){
        $this->load->view('v_login');
    }

    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run() != false){
            $where = array(
                'username' => $username,
                'password' => md5($password)
            );

            $data = $this->m_master->edit_data($where,'tb_petugas')->num_rows();
            $d    = $this->m_master->edit_data($where,'tb_petugas')->row();

            if($data>0){
                $session = array (
                    'id'     => $d->id,
                    'nama'   => $d->nama,
                    'status' => 'login'
                );
                $this->session->set_userdata($session);
                redirect('admin');
            }
            else{
                redirect('auth?pesan=gagal');
            }
        }
        else{
            $this->load->view('v_login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth?pesan=logout');
    }

    public function gantipassword(){
        $data['judul'] = 'Ganti Password';

        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('v_gantipassword');
        
        $this->load->view('template/footer');
    }

    public function act(){
        $passbaru      = $this->input->post('passbaru');
        $ulangpass     = $this->input->post('ulangpass');
        
        $this->form_validation->set_rules('passbaru','Password Baru', 'required|matches[ulangpass]');
        $this->form_validation->set_rules('ulangpass','Ulangi Password Baru','required');

        if($this->form_validation->run() != false){
            $data = array(
                'password' =>md5($passbaru)
            );
            $w = array(
                'id' => $this->session->userdata('id')
            );

            $this->m_master->update_data($w,$data,'tb_petugas');
            redirect('auth/gantipassword?pesan=berhasil');
        }
        else{
            redirect('auth/gantipassword?pesan=gagal');
        }
    }
}