            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Pengembalian Buku</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <?php
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == "berhasil"){
                            echo "<div class='alert alert-success'>Pengembalian Buku Berhasil</div>";
                        }
                        if($_GET['pesan'] == "gagal"){
                            echo "<div class='alert alert-danger'>Pengembalian Buku Gagal</div>";
                        }
                    }
                ?>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($pinjam as $pinj) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $pinj->nim_anggota ?></td>
                            <td><?php echo $pinj->nama ?></td>
                            <td><?php echo $pinj->kode_buku ?></td>
                            <td><?php echo $pinj->judul ?></td>
                            <td><?php echo date('d/m/Y',strtotime($pinj->tgl_pinjam)); ?></td>
                            <td><?php echo $pinj->denda?></td>
                            <?php
                                $date = date("Y-m-d");
                                
                                if($pinj->tgl_kembali < $date){
                            ?>
                                <td class="text-danger">Melebihi Batas</td>
                            <?php }
                                else{
                            ?>
                                <td><?php echo $pinj->status ?></td>
                            <?php }?>
                            <td>
                                <?php echo anchor('admin/detail_kembali/'.$pinj->id_transaksi,'<div class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-sign-in-alt""></i></div>')?>
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