            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Perpanjangan Peminjaman Buku</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <?php
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == "berhasil"){
                            echo "<div class='alert alert-success'>Perpanjangan Peminjaman Buku Berhasil</div>";
                        }
                        if($_GET['pesan'] == "gagal"){
                            echo "<div class='alert alert-danger'>Perpanjangan Peminjaman Buku Gagal</div>";
                        }
                    }
                ?>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Maks. Dikembalikan</th>
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
                            <td><?php echo $pinj->nis_anggota ?></td>
                            <td><?php echo $pinj->nama ?></td>
                            <td><?php echo $pinj->kode_buku ?></td>
                            <td><?php echo $pinj->judul ?></td>
                            <td><?php echo date('d/m/Y',strtotime($pinj->tgl_pinjam)); ?></td>
                            <td><?php echo date('d/m/Y',strtotime($pinj->tgl_kembali)); ?></td>
                            <td><?php echo $pinj->status?></td>
                            <td>
                                <?php echo anchor('admin/detail_perpanjangan/'.$pinj->id_transaksi,'<div class="btn btn-sm btn-success mr-1" data-toggle="tooltip" data-placement="top" title="Perpanjang Peminjaman"><i class="fas fa-plus""></i></div>')?>
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