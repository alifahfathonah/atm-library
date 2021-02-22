                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Edit Anggota</h1>
                    <div class="card shadow col-md-6 p-3">
                        <?php foreach($buku as $buk) { ?>

                        <form action="<?php echo base_url().'admin/update_buku'?>" method="post">
                        <div class="form-group">
                        <label>Kode</label>
                        <input type="number" class="form-control" id="kode" placeholder="" name="kode" value="<?php echo $buk->kode?>" readonly>
                        <?php echo form_error('kode')?>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" id="judul" placeholder="" name="judul" value="<?php echo $buk->judul?>">
                        <?php echo form_error('judul')?>
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" id="penulis" placeholder="" name="penulis" value="<?php echo $buk->penulis?>">
                        <?php echo form_error('penulis')?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Tahun</label>
                            <input type="number" class="form-control" id="tahun" placeholder="" name="tahun" value="<?php echo $buk->tahun?>">
                            <?php echo form_error('tahun')?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Halaman</label>
                            <input type="number" class="form-control" id="halaman" placeholder="" name="halaman" value="<?php echo $buk->halaman?>">
                            <?php echo form_error('halaman')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <select id="kategori" class="form-control" name="kategori">
                                <option><?php echo $buk->kategori?></option>
                                <option></option>
                                <option>Umum</option>
                                <option>Motivasi</option>
                                <option>Sejarah</option>
                                <option>Panduan</option>
                                <option>Religi</option>
                                <option>Filsafat</option>
                                <option>Kamus</option>
                                <option>Psikologi</option>
                                <option>Negara</option>
                            </select>
                            <?php echo form_error('kategori')?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" placeholder="" name="penerbit" value="<?php echo $buk->penerbit?>">
                            <?php echo form_error('penerbit')?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Stok awal</label>
                            <input type="number" class="form-control" id="stok" placeholder="" name="stok_awal" value="<?php echo $buk->stok_awal?>">
                            <?php echo form_error('stok')?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Sumber</label>
                            <select id="sumber" class="form-control" name="sumber">
                                <option><?php echo $buk->sumber?></option>
                                <option></option>
                                <option>Yayasan</option>
                                <option>Organisasi</option>
                                <option>Donasi</option>
                            </select>
                            <?php echo form_error('sumber')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kondisi</label>
                            <select id="kondisi" class="form-control" name="kondisi">
                                <option><?php echo $buk->kondisi?></option>
                                <option></option>
                                <option>Lama</option>
                                <option>Baru</option>
                            </select>
                            <?php echo form_error('kondisi')?>
                        </div>
                    </div>
                                
                            </div>

                                <a href="<?php echo base_url()?>admin/buku" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>


                        
                        <?php } ?>
                    </div>
                