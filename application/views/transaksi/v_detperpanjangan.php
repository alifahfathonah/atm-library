                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Detail Perpanjangan Peminjaman Buku</h1>
                <div class="row">
                        <div class="card shadow col-md-5 p-3">

                            <form action="<?php echo base_url().'admin/act_perpanjangan'?>" method="post">
                            <?php foreach($detail as $det) { ?>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>NIM</label>
                                        <input type="hidden" class="form-control" id="id_transaksi" placeholder="" name="id_transaksi" value="<?php echo $det->id_transaksi?>" readonly>
                                        <input type="number" class="form-control" id="nim_anggota" placeholder="" name="nim_anggota" value="<?php echo $det->nim?>" readonly>
                                        <?php echo form_error('nim')?>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="<?php echo $det->nama?>" readonly>
                                        <?php echo form_error('nama')?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Kode Buku</label>
                                        <input type="text" class="form-control" id="kode_buku" placeholder="" name="kode_buku" value="<?php echo $det->kode_buku?>" readonly>
                                        <?php echo form_error('kode_buku')?>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Judul Buku</label>
                                        <input type="text" class="form-control" id="judul" placeholder="" name="judul" value="<?php echo $det->judul?>" readonly>
                                        <?php echo form_error('judul')?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Tanggal Peminjaman</label>
                                        <input type="date" class="form-control" id="tgl_pinjam" placeholder="" name="tgl_pinjam" value="<?php echo $det->tgl_pinjam?>" readonly>
                                        <?php echo form_error('tgl_pinjam')?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Maksimal Dikembalikan</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="" value="<?php echo $det->tgl_kembali?>" readonly>
                                        <?php echo form_error('tgl_kembali')?>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Tanggal Perpanjangan</label>

                                    <?php
                                        $date = date($det->tgl_kembali);
                                    
                                        $perpanjang = date("Y-m-d",strtotime($date.'+7 day'));
                                    ?>

                                    <input type="date" class="form-control" id="tgl_kembali" placeholder="" name="tgl_kembali" value="<?php echo $perpanjang?>">
                                    <?php echo form_error('tgl_kembali')?>
                                </div>

                            <?php } ?>

                                <input type="hidden" class="form-control" id="denda" placeholder="" name="denda" value="<?php echo $det->denda?>">
                                
                                <a href="<?php echo base_url()?>admin/pengembalian" class="btn btn-sm btn-danger">Batal</a>
                                <button type="submit" class="btn btn-sm btn-primary">Konfirmasi</button>
                            </form>
                        </div>                    

                </div>                    
                </div>

                