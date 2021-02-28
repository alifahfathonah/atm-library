            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Data Buku</h1>
            <div>
                <a href="<?php echo base_url()?>admin/buku" class="btn <?php echo $semua?> btn-sm mb-2"></i>Semua</a>
                <a href="<?php echo base_url()?>admin/buku_umum" class="btn <?php echo $umum?> btn-sm mb-2"></i>Umum</a>
                <a href="<?php echo base_url()?>admin/buku_motivasi" class="btn <?php echo $motivasi?> btn-sm mb-2"></i>Motivasi</a>
                <a href="<?php echo base_url()?>admin/buku_sejarah" class="btn <?php echo $sejarah?> btn-sm mb-2"></i>Sejarah</a>
                <a href="<?php echo base_url()?>admin/buku_panduan" class="btn <?php echo $panduan?> btn-sm mb-2"></i>Panduan</a>
                <a href="<?php echo base_url()?>admin/buku_religi" class="btn <?php echo $religi?> btn-sm mb-2"></i>Religi</a>
                <a href="<?php echo base_url()?>admin/buku_filsafat" class="btn <?php echo $filsafat?> btn-sm mb-2"></i>Filsafat</a>
                <a href="<?php echo base_url()?>admin/buku_kamus" class="btn <?php echo $kamus?> btn-sm mb-2"></i>Kamus</a>
                <a href="<?php echo base_url()?>admin/buku_psikologi" class="btn <?php echo $psikologi?> btn-sm mb-2"></i>Psikologi</a>
                <a href="<?php echo base_url()?>admin/buku_negara" class="btn <?php echo $negara?> btn-sm mb-2"></i>Negara</a>
                <a href="<?php echo base_url()?>admin/buku_ekonomi" class="btn <?php echo $ekonomi?> btn-sm mb-2"></i>Ekonomi</a>
                <a href="<?php echo base_url()?>admin/buku_pendidikan" class="btn <?php echo $pendidikan?> btn-sm mb-2"></i>Pendidikan</a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <?php
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == "berhasil"){
                            echo "<div class='alert alert-success'>Berhasil Menambahkan Data</div>";
                        }
                        if($_GET['pesan'] == "gagal"){
                            echo "<div class='alert alert-danger'>Gagal Menambahkan Data</div>";
                        }
                        if($_GET['pesan'] == "hapus"){
                            echo "<div class='alert alert-success'>Berhasil Menghapus Data</div>";
                        }
                        if($_GET['pesan'] == "update"){
                            echo "<div class='alert alert-success'>Berhasil Mengupdate Data</div>";
                        }
                        if($_GET['pesan'] == "gagalupdate"){
                            echo "<div class='alert alert-danger'>Gagal Update Data | isi semua kolom !!</div>";
                        }
                    }
                ?>

                <div class="card-header py-3">
                    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#buku"><i class="fas fa-plus mr-2"></i>Tambah Buku</a>
                    <a href="<?php echo base_url('admin/'.$key_cetak)?>" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print mr-2"></i>Cetak Laporan</a>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($buku as $buk) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $buk->kode ?></td>
                            <td><?php echo $buk->judul ?></td>
                            <td><?php echo $buk->penulis ?></td>
                            <td><?php echo $buk->tahun ?></td>
                            <td><?php echo $buk->kategori ?></td>
                            <td><?php echo $buk->stok ?></td>
                            <td>
                                <?php echo anchor('admin/detail_buku/'.$buk->kode,'<div class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Buku"><i class="fas fa-search"></i></div>')?>
                                <?php echo anchor('admin/edit_buku/'.$buk->kode,'<div class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></div>')?>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="fas fa-trash" data-placement="top" title="Hapus Data" onclick="hapusdata(<?php echo $buk->kode;?>)";></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>

            </div>
            <!-- /.container-fluid -->

            <!-- Modal -->
            <div class="modal fade" id="buku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('admin/input_buku');?>
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="number" class="form-control" id="kode" placeholder="" name="kode">
                        <?php echo form_error('kode')?>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" id="judul" placeholder="" name="judul">
                        <?php echo form_error('judul')?>
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" id="penulis" placeholder="" name="penulis">
                        <?php echo form_error('penulis')?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Tahun</label>
                            <input type="number" class="form-control" id="tahun" placeholder="" name="tahun">
                            <?php echo form_error('tahun')?>
                        </div>
                        <div class="form-group col-md-7">
                            <label>Kategori</label>
                            <select id="kategori" class="form-control" name="kategori">
                                <option>Umum</option>
                                <option>Motivasi</option>
                                <option>Sejarah</option>
                                <option>Panduan</option>
                                <option>Religi</option>
                                <option>Filsafat</option>
                                <option>Kamus</option>
                                <option>Psikologi</option>
                                <option>Negara</option>
                                <option>Ekonomi</option>
                            </select>
                            <?php echo form_error('kategori')?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" placeholder="" name="penerbit">
                            <?php echo form_error('penerbit')?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Stok awal</label>
                            <input type="number" class="form-control" id="stok_awal" placeholder="" name="stok_awal">
                            <?php echo form_error('stok_awal')?>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?php echo form_close();?>
                </div>
            </div>
            </div>
            
            <div class="modal fade" tabindex="-1" id="cet_laporan" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-print mr-2"></i>Cetak Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="<?php echo base_url()?>admin/cetak" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Semua Data</a>
                    <a href="<?php echo base_url()?>admin/cetak_motivasi" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Motivasi</a>
                    <a href="<?php echo base_url()?>admin/cetak_sejarah" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Sejarah</a>
                    <a href="<?php echo base_url()?>admin/cetak_panduan" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Panduan</a>
                    <a href="<?php echo base_url()?>admin/cetak_religi" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Religi</a>
                    <a href="<?php echo base_url()?>admin/cetak_filsafat" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Filsafat</a>
                    <a href="<?php echo base_url()?>admin/cetak_kamus" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Kamus</a>
                    <a href="<?php echo base_url()?>admin/cetak_psikologi" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Psikologi</a>
                    <a href="<?php echo base_url()?>admin/cetak_negara" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Negara</a>
                    <a href="<?php echo base_url()?>admin/cetak_ekonomi" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Ekonomi</a>
                    <a href="<?php echo base_url()?>admin/cetak_pendidikan" class="btn btn-sm btn-warning mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Pendidikan</a>
                </div>
                </div>
            </div>
            </div>

            <script type="text/javascript">
                var url="<?php echo base_url();?>";
                function hapusdata(kode){
                var r=confirm("Apakah anda yakin akan menghapus data ini ?")
                    if (r==true)
                    window.location = url+"admin/hapus_buku/"+kode;
                    else
                    return false;
                } 
            </script>