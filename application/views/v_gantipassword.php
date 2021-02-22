<div class="container-fluid">
    <h3 class="mb-3">GANTI PASSWORD</h3>
    <div class="col-md-6">
    <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan'] == "berhasil"){
                echo "<div class='alert alert-success'>Password berhasil di ganti.</div>";
            }
            if($_GET['pesan'] == "gagal"){
                echo "<div class='alert alert-danger'>Password gagal di ganti.</div>";
            }
        }
    ?>

        <form action="<?php echo base_url().'auth/act'?>" method="post">
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="passbaru" placeholder="" name="passbaru">
            <?php echo form_error('passbaru')?>
        </div>
        <div class="form-group">
            <label>Ulangi Password Baru</label>
            <input type="password" class="form-control" id="ulangpass" placeholder="" name="ulangpass">
            <?php echo form_error('ulangpass')?>
        </div>
            <button class="btn btn-primary btn-danger btn-sm mr-2" type="reset">Reset</button>
            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
        </form>
    </div>
    
</div>