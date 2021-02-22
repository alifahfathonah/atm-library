<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <style type="text/css" media="print">
        @page { 
            size: 29.7cm 21cm;
            margin: 1cm 2.5cm 2.5cm 2.5cm}
    </style>

    <title><?php echo $judul?></title>
    </head>
    <body>
        <img src="<?php echo base_url()?>assets/img/header.jpg" alt="">
        <hr>
        <h3 class="text-center">Data Buku</h3>
        <p class="mb-2">Kategori : <?php echo $kategori?></p>
        <table class="table table-bordered">
        <thead>
            <tr class="text-center">
            <th scope="col">No.</th>
            <th scope="col">Kode Buku</th>
            <th scope="col">Judul</th>
            <th scope="col">Penulis</th>
            <th scope="col">Tahun</th>
            <th scope="col">Kategori</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Stok</th>
            <th scope="col">Stok Awal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($buku as $buk){
            ?>
                <tr>
                    <td class="text-center"><?php echo $no++ ?>.</td>
                    <td class="text-center"><?php echo $buk->kode ?></td>
                    <td><?php echo $buk->judul ?></td>
                    <td><?php echo $buk->penulis ?></td>
                    <td class="text-center"><?php echo $buk->tahun ?></td>
                    <td><?php echo $buk->kategori ?></td>
                    <td><?php echo $buk->penerbit ?></td>
                    <td class="text-center"><?php echo $buk->stok ?></td>
                    <td class="text-center"><?php echo $buk->stok_awal ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->

    <script>
        window.print();
        window.open('_blank');
    </script>
  </body>
</html>