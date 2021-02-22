<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    function __construct(){
		parent::__construct();
		// cek login
		if($this->session->userdata('status') != "masuk"){
                        redirect('auth_user?pesan=belumlogin');
		}
	}
    public function index(){
        $nim = $this->session->userdata('nim');
        $date = date("Y-m-d");

        $data['pinjam'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NULL AND nim_anggota=".$nim)->result();       
        $data['melebihi'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_kembali < '$date' AND tgl_dikembalikan AND NULL AND nim_anggota=".$nim)->result();
        $data['kembali'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NOT NULL AND nim_anggota=".$nim)->result();

        $data['j_pinjam'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NULL AND nim_anggota=".$nim)->num_rows();       
        $data['j_melebihi'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_kembali < '$date' AND tgl_dikembalikan AND NULL AND nim_anggota=".$nim)->num_rows();
        $data['j_kembali'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NOT NULL AND nim_anggota=".$nim)->num_rows();

        $this->load->view('user/v_user',$data);
    }

    public function password(){
        $this->load->view('user/v_password');
    }

    public function act_password(){
        $key1 = $this->input->post('key1');
        $key2 = $this->input->post('key2');

        $this->form_validation->set_rules('key1','Key1', 'required|matches[ulangpass]');
        $this->form_validation->set_rules('key2','Key2 Password Baru','required');

        if($key1 == '' && $key2 == ''){
            redirect('user/password?pesan=ulang');
        }

        else if($key1 == $key2){
            $nim = array(
                'nim' => $this->session->userdata('nim')
            );

            $password = array(
                'password' => md5($key1)
            );

            $this->m_master->update_data($nim,$password,'tb_anggota');
            redirect('user?pesan=berhasilubah');
            
        }

        else{
            redirect('user/password?pesan=ulang');
        }
    }

    public function checkout(){
        $keyword  = $this->input->post('keyword');
        $nim      = $this->session->userdata('nim');

        $query    = $this->db->select('stok')->from('tb_buku')->where('kode', $keyword)->get();
        $cek      = $query->row()->stok;

        if($keyword == ''){
            redirect('user?pesan=key');
        }
        else if($cek == 0){
            redirect('user?pesan=udah');
        }
        else{
            $date = date("Y-m-d");
            
            $data['anggota'] = $this->db->get_where('tb_anggota', array('nim' => $nim))->result();
            $data['buku']    = $this->db->get_where('tb_buku', array('kode' => $keyword))->result();
            $data['key']     = $keyword;
            $data['nim']     = $nim;

            $data['pinjam'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NULL AND nim_anggota=".$nim)->result();       
            $data['melebihi'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_kembali < '$date' AND tgl_dikembalikan AND NULL AND nim_anggota=".$nim)->result();
            
            $kem = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NOT NULL AND nim_anggota=".$nim);
            if($kem->num_rows() >= 0 ){
                $results = $kem->result();
            }
            $data['bali'] = $results;

            $data['j_pinjam'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NULL AND nim_anggota=".$nim)->num_rows();       
            $data['j_melebihi'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_kembali < '$date' AND tgl_dikembalikan AND NULL AND nim_anggota=".$nim)->num_rows();
            $data['j_kembali'] = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NOT NULL AND nim_anggota=".$nim)->num_rows();

            $this->load->view('user/v_checkout',$data);
        }
    }
    
    public function act_checkout(){
        $nim_anggota    = $this->input->post('nim_anggota');
                $kode_buku      = $this->input->post('kode_buku');
                $tgl_pinjam     = $this->input->post('tgl_pinjam');
                $tgl_kembali    = $this->input->post('tgl_kembali');
                $denda          = $this->input->post('denda');
                $status         = 'Belum Dikembalikan';
                $id_petugas     = $this->session->userdata('id');

                $data = array(
                        'nim_anggota' => $nim_anggota,
                        'kode_buku'   => $kode_buku,
                        'tgl_pinjam'  => $tgl_pinjam,
                        'tgl_kembali' => $tgl_kembali,
                        'denda'       => $denda,
                        'status'      => $status,
                        'id_petugas'  => $id_petugas
                );

                $this->form_validation->set_rules('nim_anggota','Nim_anggota','trim|required');
                $this->form_validation->set_rules('kode_buku','Kode_buku','trim|required');
                $this->form_validation->set_rules('tgl_pinjam','Tgl_pinjam','trim|required');
                $this->form_validation->set_rules('tgl_kembali','Tgl_kembali','trim|required');
                $this->form_validation->set_rules('denda','Denda','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->insert_data($data,'tb_transaksi');

                        //update stok buku
                        $this->db->where('kode',$kode_buku);
                        $this->db->select('stok');
                        $this->db->from('tb_buku');
                        $data  = $this->db->get();

                        $stok  = $data->row_array();
                        
                        $hasil = $stok['stok'] - 1;

                        //update stok buku
                        $d = array (
                                'stok' => $hasil
                        );

                        $w = array (
                                'kode' => $kode_buku
                        );

                        $this->m_master->update_data($w,$d,'tb_buku');

                        redirect('user?pesan=berhasil');
                }
                else{
                        redirect('user?pesan=gagal');
                }
    }
}