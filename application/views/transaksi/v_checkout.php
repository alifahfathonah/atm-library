                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Transaksi Peminjaman</h1>
                <div class="row">
                        <div class="card shadow col-md-3 p-3">
                        <?php
                            if(isset($_GET['pesan'])){
                                if($_GET['pesan'] == "berhasil"){
                                    echo "<div class='alert alert-success'>Transaksi Berhasil</div>";
                                }
                                if($_GET['pesan'] == "gagal"){
                                    echo "<div class='alert alert-danger'>Transaksi Gagal</div>";
                                }
                            }
                        ?>

                            <form action="" method="post">                                
                                <div class="form-group">
                                    <label>Masukan NIS</label>
                                    <input type="text" class="form-control" id="key_anggota" name="key_anggota" value="<?php echo $key_anggota?>" readonly>
                                    <?php echo form_error('key_anggota')?>
                                </div>
                                <div class="form-group">
                                        <label>Masukan Kode Buku</label>
                                        <input type="text" class="form-control" id="key_buku" placeholder="" name="key_buku" value="<?php echo $key_buku?>" readonly>
                                </div>
                            </form>
                        </div>

                        <div class="card shadow col-md-8 p-3 ml-5">
                            <form action="<?php echo base_url('admin/act_checkout')?>" method="post">
                                <p><strong>DETAIL PEMINJAMAN</strong></p>
                                <hr>
                                <table>
                                <?php foreach($anggota_result as $res) { ?>
                                    <tr><th>NIS</th><td>: <?php echo $res->nis?></td></tr>
                                    <tr><th>Nama</th><td>: <?php echo $res->nama?></td></tr>
                                <?php }
                                foreach($buku_result as $res) {?>
                                    <tr><th>Kode Buku</th><td>: <?php echo $res->kode?></td></tr>
                                    <tr><th>Judul Buku</th><td>: <?php echo $res->judul?></td></tr>
                                    <tr><th>Penulis</th><td>: <?php echo $res->penulis?></td></tr>
                                <?php } ?>
                                </table>
                                <hr>
                                <div class="row">

                                <?php
                                    $date = date("Y-m-d");

                                    $kembali = date("Y-m-d", strtotime($date.'+7 day'));
                                ?>
                                    <input type="hidden" name="nis" value="<?php echo $key_anggota?>">
                                    <input type="hidden" name="kode_buku" value="<?php echo $key_buku?>">
                                    <div class="form-group col-md-4">
                                            <label>Tanggal Pinjam</label>
                                            <input type="date" class="form-control" id="tgl_pinjam" placeholder="" name="tgl_pinjam" value="<?php echo $date?>" readonly>
                                            <?php echo form_error('tgl_pinjam')?>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Tanggal Kembali</label>
                                        <input type="date" class="form-control" id="tgl_kembali" placeholder="" name="tgl_kembali" value="<?php echo $kembali?>" readonly>
                                        <?php echo form_error('tgl_kembali')?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Denda</label>
                                        <input type="number" class="form-control mb-2" id="denda" placeholder="" name="denda" value="1000">
                                    </div>
                                </div>
                                <a href="<?php echo base_url('admin/peminjaman')?>" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    

                </div>                    
                </div>

                