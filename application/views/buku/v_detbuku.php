                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Detail Buku</h1>
                    <div class="card shadow col-md-6 p-3">
                        <?php foreach($buku as $buk) {?>
                        <table>
                            <tr><th>Kode Buku</th><td>: <?php echo $buk->kode?></td></tr>
                            <tr><th>Judul Buku</th><td>: <?php echo $buk->judul?></td></tr>
                            <tr><th>Penulis</th><td>: <?php echo $buk->penulis?></td></tr>
                            <tr><th>Tahun</th><td>: <?php echo $buk->tahun?></td></tr>
                            <tr><th>Penerbit</th><td>: <?php echo $buk->penerbit?></td></tr>
                            <tr><th>Kategori</th><td>: <?php echo $buk->kategori?></td></tr>
                            <tr><th>Stok</th><td>: <?php echo $buk->stok?></td></tr>
                            <tr><th>Stok awal</th><td>: <?php echo $buk->stok_awal?></td></tr>
                        </table>
                        <?php } ?>
                        <div class="mb-3 text-right"><a href="<?php echo base_url()?>admin/buku" class="btn btn-sm btn-secondary">Kembali</a></div>
                    </div>
                    
                </div>
                