<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
        function __construct(){
		parent::__construct();
		// cek login
		if($this->session->userdata('status') != "login"){
                        redirect('auth?pesan=belumlogin');
		}
	}
	public function index()
	{
                $data['judul'] = 'Dashboard Admin';

                $data['ang']            = $this->db->get('tb_anggota')->num_rows();
                $data['buku']           = $this->db->get('tb_buku')->num_rows();
                $data['borrow']         = $this->db->query("select * from tb_transaksi where tgl_dikembalikan is NULL")->num_rows();
                $data['kembali']        = $this->db->query("select * from tb_transaksi where tgl_dikembalikan is NOT NULL")->num_rows();
                $data['pinjam']         = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NULL")->result();
                
                $date = date("Y-m-d");
                $data['melebihi'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_kembali < '$date' and tgl_dikembalikan is NULL")->num_rows();
                
                $data['anggota'] = $this->m_master->get_data('tb_anggota')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('v_dashboard',$data);
                $this->load->view('template/footer');
        }
        
        public function anggota(){
                $data['judul'] = 'Data Anggota';
                $data['anggota'] = $this->m_master->get_data('tb_anggota')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('anggota/v_anggota',$data);
                $this->load->view('template/footer');
        }

        public function input_anggota(){
                $nim = $this->input->post('nim');
                $nama = $this->input->post('nama');
                $jk = $this->input->post('jk');
                $hp = $this->input->post('hp');
                $email = $this->input->post('email');
                $alamat = $this->input->post('alamat');
                $password = $this->input->post('password');

                $data = array(
                        'nim'    => $nim,
                        'nama'   => $nama,
                        'jk'     => $jk,
                        'hp'     => $hp,
                        'email'  => $email,
                        'alamat' => $alamat,
                        'password' => md5($password)
                );

                $this->form_validation->set_rules('nim','Nim','trim|required');
                $this->form_validation->set_rules('nama','Nama','trim|required');
                $this->form_validation->set_rules('jk','JK','trim|required');
                $this->form_validation->set_rules('hp','HP','trim|required');
                $this->form_validation->set_rules('email','EMAIL','trim|required');
                $this->form_validation->set_rules('alamat','Alamat','trim|required');
                $this->form_validation->set_rules('password','Password','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->insert_data($data,'tb_anggota');
                        redirect('admin/anggota?pesan=berhasil');
                }
                else{
                        redirect('admin/anggota?pesan=gagal');
                }
                
        }

        public function hapus_anggota($nim){
                $where = array(
                        'nim' => $nim
                );
                $this->m_master->delete_data($where,'tb_anggota');
                redirect('admin/anggota?pesan=hapusberhasil');
        }

        public function edit_anggota($nim){
                $data['judul'] = 'Data Buku';
                $where = array(
                        'nim' => $nim
                );
                $data['anggota'] = $this->m_master->edit_data($where,'tb_anggota')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('anggota/v_editanggota',$data);
                $this->load->view('template/footer');
        }

        public function update_anggota(){
                $nim = $this->input->post('nim');
                $nama = $this->input->post('nama');
                $jk = $this->input->post('jk');
                $hp = $this->input->post('hp');
                $email = $this->input->post('email');
                $alamat = $this->input->post('alamat');
                $password = $this->input->post('password');

                $data = array(
                        'nama'   => $nama,
                        'jk'     => $jk,
                        'hp'     => $hp,
                        'email'  => $email,
                        'alamat' => $alamat,
                        'password' => md5($password)
                );

                $where = array(
                        'nim'    => $nim
                );

                $this->form_validation->set_rules('nim','Nim','trim|required');
                $this->form_validation->set_rules('nama','Nama','trim|required');
                $this->form_validation->set_rules('jk','JK','trim|required');
                $this->form_validation->set_rules('hp','HP','trim|required');
                $this->form_validation->set_rules('email','EMAIL','trim|required');
                $this->form_validation->set_rules('alamat','Alamat','trim|required');
                $this->form_validation->set_rules('password','Password','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->update_data($where,$data,'tb_anggota');
                        redirect('admin/anggota?pesan=update');
                }
                else{
                        redirect('admin/anggota?pesan=gagalupdate');
                }
        }

        public function cetak_anggota(){
                $data['anggota'] = $this->m_master->get_data('tb_anggota')->result();
                $data['judul']   = 'Data Anggota';
                $this->load->view('anggota/print_anggota',$data);
        }

        public function kartu($nim){
                $data['judul'] = 'Kartu Anggota';
                $where = array(
                        'nim' => $nim
                );
                $data['kartu'] = $this->m_master->edit_data($where,'tb_anggota')->result();
                $this->load->view('anggota/kartu',$data);
        }

        public function all_kartu(){
                $data['judul'] = 'Cetak Kartu';
                $data['kartu'] = $this->m_master->get_data('tb_anggota')->result();

                $this->load->view('anggota/all_kartu',$data);
        }

        public function petugas(){
                $data['judul'] = 'Data Petugas';
                $data['petugas'] = $this->m_master->get_data('tb_petugas')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('petugas/v_petugas',$data);
                $this->load->view('template/footer');
        }

        public function input_petugas(){
                $nama     = $this->input->post('nama');
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $data = array(
                        'nama'     => $nama,
                        'username' => $username,
                        'password' => md5($password)
                );

                $this->form_validation->set_rules('nama','Nama','trim|required');
                $this->form_validation->set_rules('username','Username','trim|required');
                $this->form_validation->set_rules('password','Password','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->insert_data($data,'tb_petugas');
                        redirect('admin/petugas?pesan=berhasil');
                }
                else{
                        redirect('admin/petugas?pesan=gagal');
                }
        }

        public function hapus_petugas($id){
                $where = array(
                        'id' => $id
                );
                $this->m_master->delete_data($where,'tb_petugas');
                redirect('admin/petugas?pesan=hapus');
        }

        public function buku(){
                $data['judul']  = 'Data Buku';
                $data['buku']   = $this->m_master->get_data('tb_buku')->result();

                $data['semua']      = 'btn-info';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_umum(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'umum'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-info';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_umum';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }
        
        public function buku_motivasi(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'motivasi'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-info';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_motivasi';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_sejarah(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'sejarah'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-info';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_sejarah';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_panduan(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'panduan'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-info';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_panduan';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_religi(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'religi'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-info';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';
                
                $data['key_cetak'] = 'cetak_religi';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_filsafat(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'filsafat'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-info';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_filsafat';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_kamus(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'kamus'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-info';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_kamus';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_psikologi(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'psikologi'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-info';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_psikologi';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_negara(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'negara'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-info';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_negaras';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_ekonomi(){
                $data['judul'] = 'Data Buku';
                $data['buku'] = $this->db->get_where('tb_buku', array('kategori' => 'ekonomi'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-info';
                $data['pendidikan'] = 'btn-secondary';

                $data['key_cetak'] = 'cetak_ekonomi';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function buku_pendidikan(){
                $data['judul'] = 'Data Buku';
                $data['buku']  = $this->db->get_where('tb_buku', array('kategori' => 'pendidikan'))->result();

                $data['semua']      = 'btn-secondary';
                $data['umum']       = 'btn-secondary';
                $data['motivasi']   = 'btn-secondary';
                $data['sejarah']    = 'btn-secondary';
                $data['panduan']    = 'btn-secondary';
                $data['religi']     = 'btn-secondary';
                $data['filsafat']   = 'btn-secondary';
                $data['kamus']      = 'btn-secondary';
                $data['psikologi']  = 'btn-secondary';
                $data['negara']     = 'btn-secondary';
                $data['ekonomi']    = 'btn-secondary';
                $data['pendidikan'] = 'btn-info';

                $data['key_cetak'] = 'cetak_pendidikan';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_buku',$data);
                $this->load->view('template/footer');
        }

        public function cetak(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Semua kategori';
                $data['buku']     = $this->m_master->get_data('tb_buku')->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_umum(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Umum';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'umum'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_motivasi(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Motivasi';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'motivasi'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_sejarah(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Sejarah';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'sejarah'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_panduan(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Panduan';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'panduan'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_religi(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Religi';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'religi'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_filsafat(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Filsafat';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'filsafat'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_kamus(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Kamus';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'kamus'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_psikologi(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Psikologi';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'psikologi'))->result();

                $this->load->view('buku/all',$data);
        }
        
        public function cetak_negara(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Negara';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'negara'))->result();

                $this->load->view('buku/all',$data);
        }

        public function cetak_ekonomi(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Ekonomi';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'ekonomi'))->result();

                $this->load->view('buku/all',$data);
        }
        
        public function cetak_pendidikan(){
                $data['judul']    = 'Data Buku';
                $data['kategori'] = 'Pendidikan';
                $data['buku']     = $this->db->get_where('tb_buku', array('kategori' => 'pendidikan'))->result();

                $this->load->view('buku/all',$data);
        }

        public function input_buku(){
                $kode           = $this->input->post('kode');
                $judul          = $this->input->post('judul');
                $penulis        = $this->input->post('penulis');
                $tahun          = $this->input->post('tahun');
                $halaman        = $this->input->post('halaman');
                $kategori       = $this->input->post('kategori');
                $penerbit       = $this->input->post('penerbit');
                $stok_awal      = $this->input->post('stok_awal');
                $sumber         = $this->input->post('sumber');
                $kondisi        = $this->input->post('kondisi');

                $data = array(
                        'kode'          => $kode,
                        'judul'         => $judul,
                        'penulis'       => $penulis,
                        'tahun'         => $tahun,
                        'halaman'       => $halaman,
                        'kategori'      => $kategori,
                        'penerbit'      => $penerbit,
                        'stok'          => $stok_awal,
                        'stok_awal'     => $stok_awal,
                        'sumber'        => $sumber,
                        'kondisi'       => $kondisi
                );

                $this->form_validation->set_rules('kode','Kode','trim|required');
                $this->form_validation->set_rules('judul','Judul','trim|required');
                $this->form_validation->set_rules('penulis','Penulis','trim|required');
                $this->form_validation->set_rules('tahun','Tahun','trim|required');
                $this->form_validation->set_rules('halaman','Halaman','trim|required');
                $this->form_validation->set_rules('kategori','Kategori','trim|required');
                $this->form_validation->set_rules('penerbit','Penerbit','trim|required');
                $this->form_validation->set_rules('stok_awal','Stok_awal','trim|required');
                $this->form_validation->set_rules('sumber','Sumber','trim|required');
                $this->form_validation->set_rules('kondisi','Kondisi','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->insert_data($data,'tb_buku');
                        redirect('admin/buku?pesan=berhasil');
                }
                else{
                        redirect('admin/buku?pesan=gagal');
                }
        }

        public function hapus_buku($kode){
                $where = array(
                        'kode' => $kode
                );

                $this->m_master->delete_data($where,'tb_buku');
                redirect('admin/buku?pesan=hapus');
        }

        public function edit_buku($kode){
                $data['judul'] = 'Edit Buku';

                $where = array(
                        'kode' => $kode
                );

                $data['buku'] = $this->m_master->edit_data($where,'tb_buku')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_editbuku',$data);
                $this->load->view('template/footer');
        }

        public function update_buku(){
                $kode           = $this->input->post('kode');
                $judul          = $this->input->post('judul');
                $penulis        = $this->input->post('penulis');
                $tahun          = $this->input->post('tahun');
                $halaman        = $this->input->post('halaman');
                $kategori       = $this->input->post('kategori');
                $penerbit       = $this->input->post('penerbit');
                $stok_awal      = $this->input->post('stok_awal');
                $sumber         = $this->input->post('sumber');
                $kondisi        = $this->input->post('kondisi');

                $pinjam  = $this->db->query("SELECT * FROM tb_transaksi,tb_anggota,tb_buku WHERE nim_anggota=nim AND kode_buku=kode AND tgl_dikembalikan IS NULL AND kode_buku=".$kode)->num_rows();
                $jumstok = $stok_awal - $pinjam;

                $data = array(
                        'judul'         => $judul,
                        'penulis'       => $penulis,
                        'tahun'         => $tahun,
                        'halaman'       => $halaman,
                        'kategori'      => $kategori,
                        'penerbit'      => $penerbit,
                        'stok'          => $jumstok,
                        'stok_awal'     => $stok_awal,
                        'sumber'        => $sumber,
                        'kondisi'       => $kondisi
                );

                $where = array(
                        'kode'          => $kode
                );

                $this->form_validation->set_rules('kode','Kode','trim|required');
                $this->form_validation->set_rules('judul','Judul','trim|required');
                $this->form_validation->set_rules('penulis','Penulis','trim|required');
                $this->form_validation->set_rules('tahun','Tahun','trim|required');
                $this->form_validation->set_rules('halaman','Halaman','trim|required');
                $this->form_validation->set_rules('kategori','Kategori','trim|required');
                $this->form_validation->set_rules('penerbit','Penerbit','trim|required');
                $this->form_validation->set_rules('stok_awal','Stok_Awal','trim|required');
                $this->form_validation->set_rules('sumber','Sumber','trim|required');
                $this->form_validation->set_rules('kondisi','Kondisi','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->update_data($where,$data,'tb_buku');
                        redirect('admin/buku?pesan=update');
                }
                else{
                        redirect('admin/buku?pesan=gagalupdate');
                }
        }

        public function detail_buku($kode){
                $data['judul'] = 'Detail Buku';
                $where = array(
                        'kode' => $kode
                );
                $data['buku'] = $this->m_master->edit_data($where,'tb_buku')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/v_detbuku',$data);
                $this->load->view('template/footer');
        }

        public function peminjaman2(){
                $data['judul']   = 'Peminjaman';
                $data['anggota'] = $this->m_master->get_data('tb_anggota')->result();
                $data['buku']    = $this->m_master->get_data('tb_buku')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('transaksi/v_peminjaman',$data);
                $this->load->view('template/footer');
        }

        public function peminjaman(){
                $data['judul']   = 'Peminjaman';
                $data['anggota'] = $this->m_master->get_data('tb_anggota')->result();
                $data['buku']    = $this->m_master->get_data('tb_buku')->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('transaksi/v_peminjaman',$data);
                $this->load->view('template/footer');                
        }

        public function checkout(){
                $data['judul'] = 'Peminjaman';

                $key_anggota   = $this->input->post('key_anggota');
                $key_buku      = $this->input->post('key_buku');
                
                $data['anggota'] = $this->m_master->get_data('tb_anggota')->result();
                $data['buku']    = $this->m_master->get_data('tb_buku')->result();
                
                $data['key_anggota'] = $key_anggota;
                $data['key_buku']    = $key_buku;

                $cek_anggota = $this->db->get_where('tb_anggota', array('nim' => $key_anggota))->result();
                $cek_buku    = $this->db->get_where('tb_buku', array('kode' => $key_buku))->result();

                $data['anggota_result'] = $this->db->get_where('tb_anggota',array('nim' => $key_anggota))->result();
                $data['buku_result']    = $this->db->get_where('tb_buku',array('kode' => $key_buku))->result();

                $this->form_validation->set_rules('key_anggota','Key_anggota','trim|required');
                $this->form_validation->set_rules('key_buku','Key_buku','trim|required');
                
                $query = $this->db->select('stok')->from('tb_buku')->where('kode', $key_buku)->get();
                $cek   = $query->row()->stok;
                
                if($cek_anggota != false && $cek_buku != false){
                        if($cek == 0){
                                redirect('admin/peminjaman?pesan=udah');
                        }
                        else{
                                $this->load->view('template/header',$data);
                                $this->load->view('template/sidebar');
                                $this->load->view('transaksi/v_checkout',$data);
                                $this->load->view('template/footer');
                        }
                }
                
                else{
                        redirect('admin/peminjaman?pesan=gagal');
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

                        redirect('admin/peminjaman?pesan=berhasil');
                }
                else{
                        redirect('admin/peminjaman?pesan=berhasil');
                }
                

        }

        public function lap_peminjaman(){
                $data['judul']   = 'Laporan Peminjaman';
                $data['pinjam'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NULL")->result();
                
                $data['keyword'] = $this->input->post('keyword');
                $data['dari'] = $this->input->post('dari');
                $data['sampai'] = $this->input->post('sampai');

                $data['link']    = 'cetak_lappem';

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('laporan/v_laptransaksi',$data);
                $this->load->view('template/footer');
        }

        public function batal($id_transaksi){
                //update stok buku
                $this->db->select('kode_buku');
                $this->db->from('tb_transaksi');
                $this->db->where('id_transaksi',$id_transaksi);
                $get_kode = $this->db->get();
                $get_kode_buku = $get_kode->row_array();
                $book_code = $get_kode_buku['kode_buku'];
                
                $this->db->where('kode',$book_code);
                $this->db->select('stok');
                $this->db->from('tb_buku');
                $data  = $this->db->get();

                $stok  = $data->row_array();
                
                $hasil = $stok['stok'] + 1;

                $d = array (
                        'stok' => $hasil
                );

                $where = array (
                        'kode' => $book_code
                );

                //hapus transaksi
                $this->m_master->update_data($where,$d,'tb_buku');

                
                $w = array(
                        'id_transaksi' => $id_transaksi
                );

                $this->m_master->delete_data($w,'tb_transaksi');

                redirect('admin/lap_peminjaman?pesan=berhasil');
        }

        public function filter_peminjaman_nim(){
                $data['judul']   = 'Laporan Peminjaman';

                $keyword = $this->input->post('keyword');

                $data['keyword'] = $this->input->post('keyword');
                $data['dari'] = $this->input->post('dari');
                $data['sampai'] = $this->input->post('sampai');
                $data['link']    = 'cetak_lappem_nim';

                $this->form_validation->set_rules('keyword','Keyword','trim|required');
                
                if($this->form_validation->run() != false){

                        $this->db->select('*');
                        $this->db->from('tb_transaksi');
                        $this->db->join('tb_anggota','tb_anggota.nim = tb_transaksi.nim_anggota');
                        $this->db->join('tb_buku','tb_buku.kode = tb_transaksi.kode_buku');
                        $this->db->where('tb_transaksi.tgl_dikembalikan is NULL');
                        $this->db->where('tb_anggota.nim',$keyword);
                        
                        $data['pinjam'] = $this->db->get()->result();

                        $data['keyword'] = $keyword;

                        $this->load->view('template/header',$data);
                        $this->load->view('template/sidebar');
                        $this->load->view('laporan/v_laptransaksi',$data);
                        $this->load->view('template/footer');
                }

                else{
                        redirect('admin/lap_peminjaman');
                }
        }

        public function filter_peminjaman_tgl(){
                $data['judul']   = 'Laporan Peminjaman';
                
                $dari   = $this->input->post('dari');
                $sampai = $this->input->post('sampai');

                $data['keyword'] = $this->input->post('keyword');
                $data['dari']    = $this->input->post('dari');
                $data['sampai']  = $this->input->post('sampai');
                $data['link']    = 'cetak_lappem_tgl';

                $this->form_validation->set_rules('dari','dari','trim|required');
                $this->form_validation->set_rules('sampai','sampai','trim|required');

                if($this->form_validation->run() != false){

                        $data['pinjam'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and date(tgl_dikembalikan) is NULL and date(tgl_kembali)>='$dari' and date(tgl_kembali)<='$sampai'")->result();

                        $this->load->view('template/header',$data);
                        $this->load->view('template/sidebar');
                        $this->load->view('laporan/v_laptransaksi',$data);
                        $this->load->view('template/footer');
                }

                else{
                        redirect('admin/lap_peminjaman');
                }
        }

        public function cetak_lappem(){
                $data['judul']    = 'Data Peminjaman';
                $data['peminjaman'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NULL")->result();

                $data['filter'] = 'Semua Data';

                $this->load->view('laporan/print_laporan',$data);
        }

        public function cetak_lappem_nim($key){
                $data['judul']    = 'Data Peminjaman';

                $keyword = $this->input->post('keyword');
                $data['filter']  = 'Berdasarkan NIM ('.$key.')';

                $data['peminjaman'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NULL and nim_anggota='$key'")->result();
                
                $this->load->view('laporan/print_laporan',$data);
        }

        public function cetak_lappem_tgl($dari,$sampai){
                $data['judul']    = 'Data Peminjaman';

                $a = date("d-m-Y", strtotime($dari));
                $b = date("d-m-Y", strtotime($sampai));

                $data['filter']   = 'Berdasarkan Tanggal ('.$a.' - '.$b.')';

                $data['peminjaman'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and date(tgl_dikembalikan) is NULL and date(tgl_kembali)>='$dari' and date(tgl_kembali)<='$sampai'")->result();
                
                $this->load->view('laporan/print_laporan',$data);
        }

        public function pengembalian(){
                $data['judul']   = 'Pengembalian';

                $data['pinjam'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NULL")->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('transaksi/v_pengembalian',$data);
                $this->load->view('template/footer');
        }

        public function detail_kembali($id_transaksi){
                $data['judul']   = 'Detail Pengembalian';

                $data['detail'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and id_transaksi='$id_transaksi'")->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('transaksi/v_detkembali',$data);
                $this->load->view('template/footer');
        }

        public function act_pengembalian(){
                $id_transaksi      = $this->input->post('id_transaksi');
                $nim_anggota       = $this->input->post('nim_anggota');
                $kode_buku         = $this->input->post('kode_buku');
                $tgl_pinjam        = $this->input->post('tgl_pinjam');
                $tgl_kembali       = $this->input->post('tgl_kembali');
                $tgl_dikembalikan  = $this->input->post('tgl_dikembalikan');
                $denda             = $this->input->post('denda');
                $total_denda       = $this->input->post('total_denda');
                $status            = 'Dikembalikan';
                $id_petugas        = $this->session->userdata('id');

                $where = array(
                        'id_transaksi'          => $id_transaksi
                );

                $data = array(
                        'nim_anggota'           => $nim_anggota,
                        'kode_buku'             => $kode_buku,
                        'tgl_pinjam'            => $tgl_pinjam,
                        'tgl_kembali'           => $tgl_kembali,
                        'tgl_dikembalikan'      => $tgl_dikembalikan,
                        'denda'                 => $denda,
                        'status'                => $status,
                        'id_petugas'            => $id_petugas
                );

                $this->form_validation->set_rules('nim_anggota','Nim_anggota','trim|required');
                $this->form_validation->set_rules('kode_buku','Kode_buku','trim|required');
                $this->form_validation->set_rules('tgl_pinjam','Tgl_pinjam','trim|required');
                $this->form_validation->set_rules('tgl_kembali','Tgl_kembali','trim|required');
                $this->form_validation->set_rules('tgl_dikembalikan','tgl_dikembalikan','trim|required');
                $this->form_validation->set_rules('total_denda','Total_denda','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->update_data($where,$data,'tb_transaksi');

                        //update stok buku
                        $this->db->where('kode',$kode_buku);
                        $this->db->select('stok');
                        $this->db->from('tb_buku');
                        $data  = $this->db->get();

                        $stok  = $data->row_array();
                        
                        $hasil = $stok['stok'] + 1;

                        //update stok buku
                        $d = array (
                                'stok' => $hasil
                        );

                        $w = array (
                                'kode' => $kode_buku
                        );

                        $this->m_master->update_data($w,$d,'tb_buku');

                        redirect('admin/pengembalian?pesan=berhasil');
                }
                else{
                        redirect('admin/pengembalian?pesan=gagal');
                }
        }

        public function lap_pengembalian(){
                $data['judul']   = 'Laporan Pengembalian';

                $data['kembali'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NOT NULL")->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('laporan/v_lappengembalian',$data);
                $this->load->view('template/footer');
        }

        public function cetak_lappen(){
                $data['judul']    = 'Data Pengembalian';
                $data['filter']   = 'Semua data';

                $data['pengembalian'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NOT NULL")->result();

                $this->load->view('laporan/print_pengembalian',$data);
        }

        public function filter_pengembalian_nim(){
                $data['judul']   = 'Filter Laporan Pengembalian';

                $keyword = $this->input->post('keyword');

                $this->form_validation->set_rules('keyword','Keyword','trim|required');

                if($this->form_validation->run() != false){

                        $this->db->select('*');
                        $this->db->from('tb_transaksi');
                        $this->db->join('tb_anggota','tb_anggota.nim = tb_transaksi.nim_anggota');
                        $this->db->join('tb_buku','tb_buku.kode = tb_transaksi.kode_buku');
                        $this->db->where('tb_transaksi.tgl_dikembalikan is NOT NULL');
                        $this->db->where('tb_anggota.nim',$keyword);
                        
                        $data['kembali'] = $this->db->get()->result();

                        $this->load->view('template/header',$data);
                        $this->load->view('template/sidebar');
                        $this->load->view('laporan/v_lappengembalian_filter_nim',$data);
                        $this->load->view('template/footer');
                }

                else{
                        redirect('admin/lap_peminjaman');
                }
        }

        public function cetak_lappen_nim($keyword){
                $data['judul']    = 'Data Pengembalian';
                $data['filter']   = 'Berdasarkan NIM ('.$keyword.')';

                $this->db->select('*');
                $this->db->from('tb_transaksi');
                $this->db->join('tb_anggota','tb_anggota.nim = tb_transaksi.nim_anggota');
                $this->db->join('tb_buku','tb_buku.kode = tb_transaksi.kode_buku');
                $this->db->where('tb_transaksi.tgl_dikembalikan is NOT NULL');
                $this->db->where('tb_anggota.nim',$keyword);
                        
                $data['pengembalian'] = $this->db->get()->result();

                $this->load->view('laporan/print_pengembalian',$data);
        }

        public function filter_pengembalian_tgl(){
                $data['judul']   = 'Filter Laporan Pengembalian';

                $dari   = $this->input->post('dari');
                $sampai = $this->input->post('sampai');

                $this->form_validation->set_rules('dari','Dari','trim|required');
                $this->form_validation->set_rules('sampai','Sampai','trim|required');

                if($this->form_validation->run() != false){

                        $data['kembali'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and date(tgl_dikembalikan) is NOT NULL and date(tgl_dikembalikan)>='$dari' and date(tgl_dikembalikan)<='$sampai'")->result();

                        $this->load->view('template/header',$data);
                        $this->load->view('template/sidebar');
                        $this->load->view('laporan/v_lappengembalian_filter_tgl',$data);
                        $this->load->view('template/footer');
                }

                else{
                        redirect('admin/lap_pengembalian');
                }
        }

        public function cetak_lappen_tgl($dari,$sampai){
                $data['judul']    = 'Data Pengembalian';
                
                $a = date("d-m-Y", strtotime($dari));
                $b = date("d-m-Y", strtotime($sampai));

                $data['filter']   = 'Berdasarkan Tanggal ('.$a.' - '.$b.')';

                $data['pengembalian'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and date(tgl_dikembalikan) is NOT NULL and date(tgl_dikembalikan)>='$dari' and date(tgl_dikembalikan)<='$sampai'")->result();

                $this->load->view('laporan/print_pengembalian',$data);
        }

        public function perpanjangan(){
                $data['judul']   = 'Perpanjangan';

                $data['pinjam'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_dikembalikan is NULL")->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('transaksi/v_perpanjangan',$data);
                $this->load->view('template/footer');
        }

        public function detail_perpanjangan($id_transaksi){
                $data['judul']   = 'Detail Perpanjangan';

                $data['detail'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and id_transaksi='$id_transaksi'")->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('transaksi/v_detperpanjangan',$data);
                $this->load->view('template/footer');
        }

        public function act_perpanjangan(){
                $id_transaksi      = $this->input->post('id_transaksi');
                $nim_anggota       = $this->input->post('nim_anggota');
                $kode_buku         = $this->input->post('kode_buku');
                $tgl_pinjam        = $this->input->post('tgl_pinjam');
                $tgl_kembali       = $this->input->post('tgl_kembali');
                $denda             = $this->input->post('denda');
                $status            = 'Diperpanjang';
                $id_petugas        = $this->session->userdata('id');

                $where = array(
                        'id_transaksi'          => $id_transaksi
                );

                $data = array(
                        'nim_anggota'           => $nim_anggota,
                        'kode_buku'             => $kode_buku,
                        'tgl_pinjam'            => $tgl_pinjam,
                        'tgl_kembali'           => $tgl_kembali,
                        'denda'                 => $denda,
                        'status'                => $status,
                        'id_petugas'            => $id_petugas
                );

                $this->form_validation->set_rules('nim_anggota','Nim_anggota','trim|required');
                $this->form_validation->set_rules('kode_buku','Kode_buku','trim|required');
                $this->form_validation->set_rules('tgl_pinjam','Tgl_pinjam','trim|required');
                $this->form_validation->set_rules('tgl_kembali','Tgl_kembali','trim|required');

                if($this->form_validation->run() != false){
                        $this->m_master->update_data($where,$data,'tb_transaksi');

                        redirect('admin/perpanjangan?pesan=berhasil');
                }
                else{
                        redirect('admin/perpanjangan?pesan=gagal');
                }
        }

        public function melebihi(){
                $data['judul']   = 'Laporan Peminjaman Melebihi Deadline';
                $date = date("Y-m-d");
                
                $data['pinjam'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_kembali < '$date' and tgl_dikembalikan is NULL")->result();

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('laporan/v_melebihi',$data);
                $this->load->view('template/footer');
        }

        public function cetak_melebihi(){
                $data['judul']   = 'Laporan Peminjaman Melebihi Deadline';
                $date = date("Y-m-d");
                $data['pinjam'] = $this->db->query("select * from tb_transaksi,tb_anggota,tb_buku where nim_anggota=nim and kode_buku=kode and tgl_kembali < '$date' and tgl_dikembalikan is NULL")->result();
                $this->load->view('laporan/print_melebihi',$data);
        }

        public function progress(){
                $data['judul']   = 'Cek Progress';
                
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('progress/v_progress',$data);
                $this->load->view('template/footer');
        }

        public function progress_result(){
                $data['judul']   = 'Cek Progress';

                $keyword = $this->input->post('keyword');

                $this->form_validation->set_rules('keyword','Keyword','trim|required');

                $data['anggota']        = $this->db->query("select * from tb_anggota where nim='$keyword'")->result();
                $data['belum']          = $this->db->query("select * from tb_transaksi where nim_anggota='$keyword' and tgl_dikembalikan is NULL")->num_rows();
                $data['kembali']        = $this->db->query("select * from tb_transaksi where nim_anggota='$keyword' and tgl_dikembalikan is NOT NULL")->num_rows();
                $data['jumlah']         = $this->db->query("select * from tb_transaksi where nim_anggota='$keyword'")->num_rows();

                $this->db->select('*');
                $this->db->from('tb_transaksi');
                $this->db->join('tb_anggota','tb_anggota.nim = tb_transaksi.nim_anggota');
                $this->db->join('tb_buku','tb_buku.kode = tb_transaksi.kode_buku');
                $this->db->where('tb_anggota.nim',$keyword);
                        
                $data['cek'] = $this->db->get()->result();

                if($this->form_validation->run() != false){
                        $this->load->view('template/header',$data);
                        $this->load->view('template/sidebar');
                        $this->load->view('progress/v_progress_result',$data);
                        $this->load->view('template/footer');
                }
                else{
                        redirect('admin/progress');
                }
        }

        public function progress_buku(){
                $data['judul']   = 'Cek Progress';

                $keyword = $this->input->post('keyword');

                $this->form_validation->set_rules('keyword','Keyword','trim|required');

                $data['buku']           = $this->db->query("select * from  tb_buku where kode='$keyword'")->result();
                $data['belum']          = $this->db->query("select * from tb_transaksi where kode_buku='$keyword' and tgl_dikembalikan is NULL")->num_rows();
                $data['kembali']        = $this->db->query("select * from tb_transaksi where kode_buku='$keyword' and tgl_dikembalikan is NOT NULL")->num_rows();

                $this->db->select('*');
                $this->db->from('tb_transaksi');
                $this->db->join('tb_anggota','tb_anggota.nim = tb_transaksi.nim_anggota');
                $this->db->join('tb_buku','tb_buku.kode = tb_transaksi.kode_buku');
                $this->db->where('tb_buku.kode',$keyword);
                        
                $data['cek'] = $this->db->get()->result();

                if($this->form_validation->run() != false){
                        $this->load->view('template/header',$data);
                        $this->load->view('template/sidebar');
                        $this->load->view('progress/v_progress_buku',$data);
                        $this->load->view('template/footer');
                }
                else{
                        redirect('admin/progress');
                }
        }
}
