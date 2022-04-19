<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'function.php';
$pasien = query("SELECT * FROM pasien");

// ketika tombol cari di klik maka akan menampilkan hasil data yang dicari
if (isset($_POST["cari"])) {
    $pasien = cari($_POST["keyword"]);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Web Data Pasien</title>
</head>
<body background="img/darkness.webp">
  
     <div class="header">
     <h1>Data Pasien</h1> 
               <div style="float:LEFT">
                    <a class="akun" href="tambah.php"><button style="background-color:red; border-color:blue; color:white">+ TAMBAH DATA</button> </a>
               </div>
               <form style="float:RIGHT"  action="" method="POST">
          <input type="text" name="keyword" size="40" autofocus placeholder="Cari data yang diinginkan.." autocomplete="off">
          <button style="background-color:red; border-color:red; color:white" type="submit" name="cari"> Search</button>
          </form> 
     </div>

          <br><br><br>

          <table style="margin-left:auto;margin-right:auto" border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>...</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>TTL</th>
            <th>Umur</th>
            <th>JK</th>
            <th>Alamat</th>
            <th>Ruang</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($pasien as $row) : ?>
        <tr>
            <td> <?= $i; ?> </td>
            <td>
                <td>
                    <a href="ubah.php?id=<?php echo $row["id"]; ?>">
                    <button style="background-color:BLUE; border-color:blue; color:white"> UBAH </button> </a>
                    <a href="hapus.php?id=<?php echo $row["id"] ?>"
                    onclick="return confirm('Yakin Ingin Menghapus Data');  ">
                    <button style="background-color:red; border-color:RED; color:white"> HAPUS </button></a>
                </td>
            </td>
            <td><?=  $row["nama"] ?></td>
            <td><?=  $row["ttl"] ?></td>
            <td><?=  $row["umur"] ?></td>
            <td><?=  $row["jk"] ?></td>
            <td><?=  $row["alamat"] ?></td>
            <td><?=  $row["ruang"] ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

        
    </table>

    <br>

    <a href="logout.php">
    <button style="background-color:red; border-color:RED; color:white"> Logout</a>
        </button>
    <br>
    <Copyright class="footer">
          <h10 style="color:white;">Created by : Kurniawan, Ayu Jurgantini, Elta Septiana.
               <div style="float:left">&copy; <?php echo date("Y"); ?> </div> <h10>
              
               <div style="float:right">
                    <a href="https://www.instagram.com/wannn_x7/">
                        <button type="button" class="social-media-button icon instagram">my instagram</button> </a>
                </div>
            </div>


    
</body>
</html>