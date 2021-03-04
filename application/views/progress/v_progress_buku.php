            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Cek Progress</h1>
            </div>

            <div class="row">
                <div class="card shadow mb-4 p-4 col-md-3 ml-3">
                    <form action="<?php echo base_url().'admin/progress_result'?>" method="post">
                    <h1 class="h5 mb-4 text-gray-800"><strong>Masukan NIS Anggota</strong> </h1>

                    <div class="form-group">
                        <input type="text" class="form-control" id="keyword" placeholder="Masukan NIS Anggota" name="keyword">
                        <?php echo form_error('keyword')?>
                    </div>

                        <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                    </form>
                </div>

                <div class="card shadow mb-4 p-4 col-md-3 ml-3">
                    <form action="<?php echo base_url().'admin/progress_buku'?>" method="post">
                    <h1 class="h5 mb-4 text-gray-800"><strong>Masukan Kode Buku</strong> </h1>

                    <div class="form-group">
                        <input type="text" class="form-control" id="keyword" placeholder="Masukan Kode Buku" name="keyword" value="<?php echo set_value('keyword')?>">
                        <?php echo form_error('keyword')?>
                    </div>

                        <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                    </form>
                </div>
            </div>
            
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Progress Peminjaman Buku</h6>
                    </div>
                    <div class="card-body">
                        <table>
                        <?php foreach($buku as $bk) { ?>
                            <tr><td  class="p-1 pl-0">Kode Buku</td><td> : <?php echo $bk->kode?></td></tr>
                            <tr><td class="p-1 pl-0">Judul Buku</td><td> : <?php echo $bk->judul?></td></tr>
                            <tr><td class="p-1 pl-0">Penulis</td><td> : <?php echo $bk->penulis?></td></tr>
                            <tr><td class="p-1 pl-0">Penerbit</td><td> : <?php echo $bk->penerbit?></td></tr>
                            <tr><td class="p-1 pl-0">Tahun</td><td> : <?php echo $bk->tahun?></td></tr>
                            <tr><td class="p-1 pl-0"><hr></td><td><hr></td></tr>
                        <?php } ?>
                            <tr><td class="p-1 pl-0">Dipinjam</td><td> : <?php echo $belum?></td></tr>
                            <tr><td class="p-1 pl-0">Dikembalikan</td><td> : <?php echo $kembali?></td></tr>
                            <tr><td class="p-1 pl-0"><hr></td><td><hr></td></tr>
                            
                        </table>


                        <!-- table progress -->

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
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
                                    <td><?php echo $ck->nim?></td>
                                    <td><?php echo $ck->nama?></td>
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

                                        if($ck->tgl_kembali < $date && $ck->tgl_dikembalikan == NULL){ ?>
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