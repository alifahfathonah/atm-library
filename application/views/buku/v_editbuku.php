                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Edit Buku</h1>
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
                        <div class="form-group col-md-6">
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

                                <a href="<?php echo base_url()?>admin/buku" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>


                        
                        <?php } ?>
                    </div>
                