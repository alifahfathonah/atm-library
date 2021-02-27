                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Edit Anggota</h1>
                    <div class="card shadow col-md-6 p-3">
                        <?php foreach($anggota as $ang) { ?>

                            <form action="<?php echo base_url().'admin/update_anggota'?>" method="post">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" id="nis" placeholder="" name="nis" value="<?php echo $ang->nis?>" readonly>
                                    <?php echo form_error('nis')?>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="<?php echo $ang->nama?>">
                                        <?php echo form_error('nama')?>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label>Jenis Kelamin</label>
                                    <select id="jk" class="form-control" name="jk">
                                        <option><?php echo $ang->jk ?></option>
                                        <option><hr></option>
                                        <option>Laki-Laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                    <?php echo form_error('jk')?>
                                    </div>
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Kelas</label>
                                        <select id="kelas" class="form-control" name="kelas">
                                            <option><?php echo $ang->kelas ?></option>
                                            <option><hr></option>
                                            <option>X</option>
                                            <option>XI</option>
                                            <option>XII</option>
                                        </select>
                                        <?php echo form_error('kelas')?>
                                    </div>
                                    <div class="form-group col-md-8">
                                    <label>Jurusan</label>
                                        <select id="jurusan" class="form-control" name="jurusan">
                                            <option><?php echo $ang->jurusan ?></option>
                                            <option><hr></option>
                                            <option>Pemasaran</option>
                                            <option>Pariwisata</option>
                                            <option>Peternakan</option>
                                        </select>
                                        <?php echo form_error('jurusan')?>
                                    </div>
                                </div>

                                <a href="<?php echo base_url()?>admin/anggota" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>