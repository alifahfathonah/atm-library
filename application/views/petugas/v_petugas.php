            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Data Petugas</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <?php
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == "berhasil"){
                            echo "<div class='alert alert-success'>Berhasil Menambahkan Data</div>";
                        }
                        if($_GET['pesan'] == "gagal"){
                            echo "<div class='alert alert-danger'>Gagal Menambahkan Data</div>";
                        }
                        if($_GET['pesan'] == "hapus"){
                            echo "<div class='alert alert-success'>Berhasil Menghapus Data</div>";
                        }
                    }
                ?>

                <div class="card-header py-3">
                    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#petugas"><i class="fas fa-plus mr-2"></i>Tambah Petugas</a>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($petugas as $pet) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $pet->nama ?></td>
                            <td><?php echo $pet->username ?></td>
                            <td><input type="password" class="form-control" id="password" placeholder=""  value="<?php echo $pet->password?>" name="password" readonly></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="fas fa-trash" data-placement="top" title="Hapus Data" onclick="hapusdata(<?php echo $pet->id;?>)";></i></a>
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

            <!-- Modal -->
            <div class="modal fade" id="petugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('admin/input_petugas');?>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nim" placeholder="" name="nama">
                        <?php echo form_error('nama')?>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="alamat" placeholder="" name="username">
                        <?php echo form_error('username')?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="alamat" placeholder="" name="password">
                        <?php echo form_error('password')?>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?php echo form_close();?>
                </div>
            </div>
            </div>


            <script type="text/javascript">
                var url="<?php echo base_url();?>";
                function hapusdata(id){
                var r=confirm("Apakah anda yakin akan menghapus data ini ?")
                    if (r==true)
                    window.location = url+"admin/hapus_petugas/"+id;
                    else
                    return false;
                } 
            </script>