
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>YAM LIBRARY - USER</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url();?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-3">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                
                    <div class="p-4">
                        <div class="text-center">
                            <h1 class="h3 text-gray-900 mb-2"><strong>Selamat Datang</strong></h1>
                            <h1 class="h6 text-gray-900 mb-4"><?php echo $this->session->userdata('nama')?></h1>
                        </div>
                        
                        <?php
                        if(isset($_GET['pesan'])){
                            if($_GET['pesan'] == "berhasilubah"){
                                echo "<div class='alert alert-success'>Berhasil mengubah Password</div>";
                            }
                            if($_GET['pesan'] == "logout"){
                                echo "<div class='alert alert-warning'>Anda telah Logout</div>";
                            }
                            if($_GET['pesan'] == "belumlogin"){
                                echo "<div class='alert alert-success'>Anda belum login</div>";
                            }
                        } ?>
                    <section class="mb-6">
                        <form class="user" method="post" action="<?php echo base_url()?>user/checkout">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="kode" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Input Kode Buku" value="<?php echo $key?>">
                                    <?php echo form_error('kode')?>
                                </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Checkout</button>
                        </form>
                    </section>

                    <br>

                    <section>
                        <hr>
                        <h1 class="h6 text-gray-900 mt-3"><strong>Detail Peminjaman :</strong></h1>
                        <hr>
                        <form action="<?php echo base_url('user/act_checkout')?>" method="post">
                                <table>
                                <?php foreach($anggota as $res) { ?>
                                    <tr><th>NIM</th><td>: <?php echo $res->nim?></td></tr>
                                    <tr><th>Nama</th><td>: <?php echo $res->nama?></td></tr>
                                <?php }
                                foreach($buku as $res) {?>
                                    <tr><th>Kode Buku</th><td>: <?php echo $res->kode?></td></tr>
                                    <tr><th>Judul Buku</th><td>: <?php echo $res->judul?></td></tr>
                                    <tr><th>Penulis</th><td>: <?php echo $res->penulis?></td></tr>
                                <?php } ?>
                                </table>
                                <hr>
                                <div class="">

                                <?php
                                    $date = date("Y-m-d");

                                    $kembali = date("Y-m-d", strtotime($date.'+7 day'));
                                ?>
                                    <input type="hidden" name="nim_anggota" value="<?php echo $nim?>">
                                    <input type="hidden" name="kode_buku" value="<?php echo $key?>">

                                    <div class="form-group">
                                            <label>Tanggal Pinjam</label>
                                            <input type="date" class="form-control" id="tgl_pinjam" placeholder="" name="tgl_pinjam" value="<?php echo $date?>" readonly>
                                            <?php echo form_error('tgl_pinjam')?>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Kembali</label>
                                        <input type="date" class="form-control" id="tgl_kembali" placeholder="" name="tgl_kembali" value="<?php echo $kembali?>" readonly>
                                        <?php echo form_error('tgl_kembali')?>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label>Denda</label>
                                        <input type="number" class="form-control mb-2" id="denda" placeholder="" name="denda" value="1000" readonly>
                                    </div>
                                </div>
                                <a href="<?php echo base_url('admin/peminjaman')?>" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form> 
                    </section>
                    <br>
                    <hr>
                    <br>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item ml-auto">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pinjam<span class="badge badge-primary ml-2"><?php echo $j_pinjam?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Kembali<span class="badge badge-success ml-2"><?php echo $j_kembali?></span></a>
                        </li>
                        <li class="nav-item mr-auto">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Lebih<span class="badge badge-danger ml-2"><?php echo $j_melebihi?></span></a>
                        </li>
                    </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h1 class="h6 text-gray-900 mt-3"><strong>Buku yang dipinjam :</strong></h1>
                                <ol>
                                <?php
                                    foreach($pinjam as $pin) {
                                ?>
                                    <li><?php echo $pin->judul?> <div class="text-success">(<?php echo date("d-m-Y",strtotime($pin->tgl_pinjam))?> s.d <?php echo date("d-m-Y",strtotime($pin->tgl_kembali))?>)</div></li>
                                <?php } ?>
                                </ol>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h1 class="h6 text-gray-900 mt-3"><strong>Buku yang dikembalikan :</strong></h1>
                                <ol>
                                <?php
                                    foreach($bali as $pin) {
                                ?>
                                    <li><?php echo $pin->judul?> <div class="text-success">(<?php echo date("d-m-Y",strtotime($pin->tgl_dikembalikan))?>)</div></li>
                                <?php } ?>
                                </ol>
                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <h1 class="h6 text-gray-900 mt-3"><strong>Buku yang dedline :</strong></h1>
                                <ol>
                                <?php
                                    foreach($melebihi as $pin) {
                                ?>
                                    <li><?php echo $pin->judul?> <div class="text-danger">(<?php echo date("d-m-Y",strtotime($pin->tgl_kembali))?>)</div></li>
                                <?php } ?>
                                </ol>
                            </div>
                    </div>
                    <br>
                    <br>
                    <section class="text-center">
                        <hr><a href="<?php echo base_url()?>user/password" class="text-center">Ganti Password</a><br><hr>
                        <a href="<?php echo base_url()?>auth_user/logout" class="text-center">Logout</a>
                    </section>
                    </div>
                </div>
                </div>
            </div>

        </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>