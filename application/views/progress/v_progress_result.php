            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Cek Progress</h1>
            </div>

            <div class="row">
                <div class="card shadow mb-4 p-4 col-md-3 ml-3">
                    <form action="<?php echo base_url().'admin/progress_result'?>" method="post">
                    <h1 class="h5 mb-4 text-gray-800"><strong>Masukan NIM Anggota</strong> </h1>

                    <div class="form-group">
                        <input type="text" class="form-control" id="keyword" placeholder="Masukan NIM Anggota" name="keyword" value="<?php echo set_value('keyword')?>">
                        <?php echo form_error('keyword')?>
                    </div>

                        <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                    </form>
                </div>

                <div class="card shadow mb-4 p-4 col-md-3 ml-3">
                    <form action="<?php echo base_url().'admin/progress_buku'?>" method="post">
                    <h1 class="h5 mb-4 text-gray-800"><strong>Masukan Kode Buku</strong> </h1>

                    <div class="form-group">
                        <input type="text" class="form-control" id="keyword" placeholder="Masukan Kode Buku" name="keyword">
                        <?php echo form_error('ulangfilter')?>
                    </div>

                        <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                    </form>
                </div>
            </div>
            
            <!-- Nama :
            NIM :
            Jenis Kelamin :
            Alamat :
            Jumlah Buku yang masih dipinjam :
            Jumlah Buku yang sudah dikembalikan :
            Total Peminjaman :
            Data Buku yang dipinjam -->
            <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Progress Anggota</h6>
                    </div>
                    <div class="card-body">
                        <table>
                        <?php foreach($anggota as $ang) { ?>
                            <tr><td  class="p-1 pl-0">Nama</td><td> : <?php echo $ang->nama?></td></tr>
                            <tr><td class="p-1 pl-0">NIM</td><td> : <?php echo $ang->nim?></td></tr>
                            <tr><td class="p-1 pl-0">Jenis Kelamin</td><td> : <?php echo $ang->jk?></td></tr>
                            <tr><td class="p-1 pl-0">Alamat</td><td> : <?php echo $ang->alamat?></td></tr>
                            <tr><td class="p-1 pl-0"><hr></td><td><hr></td></tr>
                        <?php } ?>
                            <tr><td class="p-1 pl-0">Buku Yang Belum Dikembalikan </td><td> : <?php echo $belum?></td></tr>
                            <tr><td class="p-1 pl-0">Buku Yang Sudah Dikembalikan </td><td> : <?php echo $kembali?></td></tr>
                            <tr><td class="p-1 pl-0">Total Buku yang dipinjam </td><td> : <?php echo $jumlah?></td></tr>
                            <tr><td class="p-1 pl-0"><hr></td><td><hr></td></tr>
                            
                        </table>


                        <!-- table progress -->

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Dipinjam</th>
                                    <th>Maks. Dikembalikan</th>
                                    <th>Dikembalikan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                foreach($cek as $ck){
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $ck->kode_buku?></td>
                                    <td><?php echo $ck->judul?></td>
                                    <td><?php echo date('d/m/Y',strtotime($ck->tgl_pinjam)); ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($ck->tgl_kembali)); ?></td>

                                    <?php
                                        if ($ck->tgl_dikembalikan != NULL) { ?>
                                        <td><?php echo date('d/m/Y',strtotime($ck->tgl_dikembalikan)); ?></td>
                                    <?php } else {?>
                                        <td>-</td>
                                    <?php } ?>

                                    <?php
                                        $date = date("Y-m-d");

                                        if($ck->tgl_kembali < $date){ ?>
                                        <td class="text-danger">Melebihi Batas</td>
                                    <?php }
                                        else{
                                    ?>
                                        <td><?php echo $ck->status ?></td>
                                    <?php }?>

                                </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->