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
                                    if($_GET['pesan'] == "udah"){
                                        echo "<div class='alert alert-danger'>Stok buku kosong</div>";
                                    }
                                }
                            ?>

                            <form action="<?php echo base_url().'admin/checkout'?>" method="post">

                                <div class="form-group">
                                    <label>NIM Anggota</label>
                                    <input type="text" class="form-control" id="key_anggota" placeholder="Masukan NIM Anggota" name="key_anggota">
                                    <?php echo form_error('key_anggota')?>
                                </div>

                                <div class="form-group">
                                    <label>Kode Buku</label>
                                    <input type="text" class="form-control" id="key_buku" placeholder="Masukan Kode Buku" name="key_buku">
                                    <?php echo form_error('key_buku')?>
                                </div>

                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-primary">Checkout</button>
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

                