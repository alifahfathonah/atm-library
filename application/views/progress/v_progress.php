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
                        <input type="text" class="form-control" id="keyword" placeholder="Masukan NIM Anggota" name="keyword">
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
                        <?php echo form_error('keyword_buku')?>
                    </div>

                        <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                    </form>
                </div>
            </div>

            </div>
            <!-- /.container-fluid -->