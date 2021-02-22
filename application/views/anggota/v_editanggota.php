                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Edit Anggota</h1>
                    <div class="card shadow col-md-6 p-3">
                        <?php foreach($anggota as $ang) { ?>

                            <form action="<?php echo base_url().'admin/update_anggota'?>" method="post">
                                <div class="form-group">
                                    <label>NIM</label>
                                    <input type="text" class="form-control" id="nim" placeholder="" name="nim" value="<?php echo $ang->nim?>" readonly>
                                    <?php echo form_error('nim')?>
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
                                <div class="form-group">
                                    <label>No. Handphone</label>
                                    <input type="text" class="form-control" id="hp" placeholder="" name="hp" value="<?php echo $ang->hp?>">
                                    <?php echo form_error('hp')?>
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="text" class="form-control" id="email" placeholder="" name="email" value="<?php echo $ang->email?>">
                                    <?php echo form_error('email')?>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"><?php echo $ang->alamat?></textarea>
                                    <?php echo form_error('alamat')?>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="" name="password" value="<?php echo $ang->password?>">
                                    <?php echo form_error('password')?>
                                </div>

                                <a href="<?php echo base_url()?>admin/anggota" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>