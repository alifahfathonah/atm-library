            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 text-right">
                        <div class="card-body pb-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-left">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">Jumlah Anggota</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $ang?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                            <a class="text-xs m-0 text-secondary" href="<?php echo base_url()?>admin/anggota">Lihat Rincian<i class="fas fa-arrow-circle-right ml-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2 text-right">
                        <div class="card-body pb-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-left">
                                <div class="font-weight-bold text-success text-uppercase mb-1">Jumlah Buku</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $buku?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                            <a class="text-xs m-0 text-secondary" href="<?php echo base_url()?>admin/buku">Lihat Rincian<i class="fas fa-arrow-circle-right ml-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2 text-right">
                        <div class="card-body pb-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-left">
                                <div class="font-weight-bold text-warning text-uppercase mb-1">Jumlah pinjam</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $borrow?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                            <a class="text-xs m-0 text-secondary" href="<?php echo base_url()?>admin/lap_peminjaman">Lihat Rincian<i class="fas fa-arrow-circle-right ml-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2 text-right">
                        <div class="card-body pb-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-left">
                                <div class="font-weight-bold text-danger text-uppercase mb-1">Jumlah kembali</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $kembali?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                            <a class="text-xs m-0 text-secondary" href="<?php echo base_url()?>admin/alap_pengembalian">Lihat Rincian<i class="fas fa-arrow-circle-right ml-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2 text-right">
                        <div class="card-body pb-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-left">
                                <div class="font-weight-bold text-danger text-uppercase mb-1">Melebihi Batas</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $melebihi ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <hr class="mt-3 mb-2">
                            <a class="text-xs m-0 text-secondary" href="<?php echo base_url()?>admin/melebihi">Lihat Rincian<i class="fas fa-arrow-circle-right ml-2"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6">

                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Peminjaman</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Kode Buku</th>
                                        <th>Tanggal Pinjam</th>
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
                                        <td><?php echo date('d/m/Y',strtotime($pinj->tgl_pinjam)); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Basic Card Example -->
                    <!-- <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Peminjaman</h6>
                        </div>
                        <div class="card-body">
                        The styling for this basic card example is created by using default Bootstrap utility classes. By using utility classes, the style of the card component can be easily modified with no need for any custom CSS!
                        </div>
                    </div> -->

                </div>

                <div class="col-lg-6">

                    <!-- Basic Card Example -->
                    <!-- <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Anggota</h6>
                        </div>
                        <div class="card-body"> -->
                            <!-- <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
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
                            </div> -->
                        <!-- </div>
                    </div> -->

                    <!-- Basic Card Example -->
                    <!-- <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pengembalian</h6>
                        </div>
                        <div class="card-body">
                        The styling for this basic card example is created by using default Bootstrap utility classes. By using utility classes, the style of the card component can be easily modified with no need for any custom CSS!
                        </div>
                    </div> -->

                </div>

            </div>

            </div>
            <!-- /.container-fluid -->