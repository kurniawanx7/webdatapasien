<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'function.php';

//ambil data di URL
$id = $_GET["id"];
// query data mahasiswa berdasarkan id

$pasien = query("SELECT * FROM pasien WHERE id = $id")[0];

//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {
    //cek apakah data berhasil di ubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah');
                document.location.href = 'ubah.php';
            </script>
        ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/style.css">
     <title>Ubah Data Mahasiswa</title>
</head>

<body background="img/blue-snow.webp">

<div align="center" class="header">
<h1>Ubah Data Pasien</h1>
</div>

<br>
    <fieldset>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $pasien["id"] ?>">
        <ul>

        <br>
        
        <div class="badge bg-primary text-wrap" style="width: 6rem;">
            <li>
                <label  for="nama" style="margin-right: 25px;"> NAMA : </label>
                <input class="fw-bold" type="text" name="nama" id="nama" required value="<?= $pasien["nama"] ?>">
            </li>
            </div>

            <br>
            <div class="badge bg-primary text-wrap" style="width: 6rem;">
            <li>
                <label for="ttl" style="margin-right: 42px;"> TTL : </label>
                <input type="text" name="ttl" id="ttl" required value="<?= $pasien["ttl"] ?>">
            </li>
            </div>

            <br>
            <div class="badge bg-primary text-wrap" style="width: 6rem;">

            <li>
                <label for="umur" style="margin-right: 25px;"> UMUR : </label>
                <input type="text" name="umur" id="umur" required value="<?= $pasien["umur"] ?>">
            </li>
            </div>
            
            <br>
            <div class="badge bg-primary text-wrap" style="width: 6rem;">
            <li>
                <label for="jk" style="margin-right: 55px;"> JK : </label>
                <input type="text" name="jk" id="jk" required value="<?= $pasien["jk"] ?>">
            </li>
            </div>

            <br>
            <div class="badge bg-primary text-wrap" style="width: 6rem;">

            <li>
                <label for="alamat" style="margin-right: 8px;"> ALAMAT : </label>
                <input type="text" name="alamat" id="alamat" required value="<?= $pasien["alamat"] ?>">
            </li>
            </div>

            <br>

            <div class="badge bg-primary text-wrap" style="width: 6rem;">
            <li>
                <label for="ruang" style="margin-right: 18px;"> RUANG : </label>
                <input type="text" name="ruang" id="ruang" required value="<?= $pasien["ruang"] ?>">
            </li>
            </div>

            <br>
            
                <button type="submit" name="submit">Ubah Data</button>
            
        </ul>
        
    </form>
</fieldset>

    <div class="footer">
          <h10 style="color:white;"> Created by : Kurniawan, Ayu Jurgantini, Elta Septiana.
          <div style="float:left">&copy; <?php echo date("Y"); ?> </div> </h10>
          <div style="float:right">
               <a href="https://www.instagram.com/wannn_x7/"><button type="button"
                         class="social-media-button icon instagram">my instagram</button> </a>
          </div>

</body>

</html>