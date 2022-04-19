<?php
//koneksi ke database
$db = mysqli_connect("localhost", "root", "", "webdatapasien");

function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $db;

    $nama = htmlspecialchars($data["nama"]);
    $ttl = htmlspecialchars($data["ttl"]);
    $umur = htmlspecialchars($data["umur"]);
    $jk = htmlspecialchars($data["jk"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $ruang = htmlspecialchars($data["ruang"]);

    $query = "INSERT INTO pasien VALUES 
            ('', '$nama', '$ttl', '$umur', '$jk', '$alamat', '$ruang' )";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function hapus($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM pasien WHERE id = $id");
    return mysqli_affected_rows($db);
}


function ubah($data)
{
    global $db;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $ttl = htmlspecialchars($data["ttl"]);
    $umur = htmlspecialchars($data["umur"]);
    $jk = htmlspecialchars($data["jk"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $ruang = htmlspecialchars($data["ruang"]);

    $query = "UPDATE pasien SET 
            nama = '$nama',
            ttl = '$ttl',
            umur = '$umur',
            jk = '$jk',
            alamat = '$alamat',
            ruang = '$ruang'
            WHERE id = $id
            ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function cari($keyword)
{
    $query = "SELECT * FROM pasien 
                WHERE 
                nama LIKE '%$keyword%' OR
                ttl LIKE '%$keyword%' OR
                umur LIKE '%$keyword%' OR
                jk LIKE '%$keyword%' OR
                alamat LIKE '%$keyword%' OR
                ruang LIKE '%$keyword%' 
            ";
    return query($query);
}

function registrasi($data)
{
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar');
        </script>";
        return true;
    }

    // cek konfirmasi password

    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($db, "INSERT INTO user VALUES('', '$username', '$password')
    ");

    return mysqli_affected_rows($db);
}

?>

