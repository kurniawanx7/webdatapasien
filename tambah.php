<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'function.php';


//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {
    //cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
                document.location.href = 'tambah.php';
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
    <title>Tambah Data Pasien</title>
</head>


<body background="img/blue-snow.webp">
     <div class="header">
    <h1>Tambah Data Pasien</h1>
</div>

<br><br>

    <form action="" method="POST" enctype="multipart/form-data">
        
                    <ul>
                         <p> 
                              <label for="nama" style="margin-right: 25px;">
                                   NAMA : </label>
                              <input type="text" name="nama" id="nama" required>
                         </p>

                         <br>

                         <p>
                              <label for="ttl" style="margin-right: 42px;">
                                   TTL : </label>
                              <input type="text" name="ttl" id="ttl" required>
                         </p>

                         <br>
                         
                         <p>
                              <label for="jk" style="margin-right: 55px;">
                                   JK : </label>
                              <input type="text" name="jk" id="jk" required>
                         </p>

                         <br>
                         
                         <p>
                              <label for="umur" style="margin-right: 25px;">
                                   UMUR : </label>
                              <input type="text" name="umur" id="umur" required>
                         </p>

                         <br>

                         <p>
                              <label for="alamat" style="margin-right: 8px;">
                                   ALAMAT : </label>
                              <input type="text" name="alamat" id="alamat" required>
                              
                         </p>

                         <br>

                         <p>
                              <label for="ruang" style="margin-right: 18px;">
                                   RUANG : </label>
                              <input type="text" name="ruang" id="ruang" required>
                              
                         </p>

                         <br>
                         
                         <p>
                              <button type="submit" name="submit">Tambah Data</button>
                         </p>
                    </ul>
       
    </form>

    
    <div class="footer">
          <h10 style="color:white;"> Created by : Kurniawan, Ayu Jurgantini, Elta Septiana.
          <div style="float:left">&copy; <?php echo date("Y"); ?> </div> </h10>
          <div style="float:right">
               <a href="https://www.instagram.com/wannn_x7/"><button type="button"
                         class="social-media-button icon instagram">my instagram</button> </a>
          </div>

</body>

</html>