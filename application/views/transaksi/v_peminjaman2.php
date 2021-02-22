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

                            <form action="<?php echo base_url().'admin/act_peminjaman'?>" method="post">
                                <div class="form-group">
                                    <label>NIM Anggota</label>
                                    <select id="nim_anggota" class="form-control" name="nim_anggota">
                                        <option>Masukan NIM Anggota</option>
                                        <option><hr></option>
                                        <?php foreach($anggota as $ang) { ?>
                                            <option><?php echo $ang->nim?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('nim')?>
                                </div>
                                <div class="form-group">
                                    <label>Kode Buku</label>
                                    <select id="kode_buku" class="form-control" name="kode_buku">
                                        <option>Masukan Kode Buku</option>
                                        <option><hr></option>
                                        <?php foreach($buku as $buk) { ?>
                                            <option><?php echo $buk->kode?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('kode')?>
                                </div>

                                <?php
                                    $date = date("Y-m-d");
                                    
                                    $kembali = date("Y-m-d",strtotime($date.'+7 day'));
                                ?>

                                <div class="form-group">
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" class="form-control" id="tgl_pinjam" placeholder="" name="tgl_pinjam" value="<?php echo $date ?>" readonly>
                                    <?php echo form_error('tgl_pinjam')?>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="tgl_kembali" placeholder="" name="tgl_kembali" value="<?php echo $kembali ?>" readonly>
                                    <?php echo form_error('tgl_kembali')?>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Denda</label>
                                    <input type="number" class="form-control" id="denda" placeholder="" name="denda" value="">
                                    <?php echo form_error('denda')?>
                                </div>

                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                        <div class="card shadow col-md-8 p-3 ml-5">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach($anggota as $ang) { ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $ang->nim ?></td>
                                            <td><?php echo $ang->nama ?></td>
                                            <td><?php echo $ang->jk ?></td>
                                            <td><?php echo $ang->alamat ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    

                </div>                    
                </div>

                