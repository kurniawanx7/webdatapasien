<?php

session_start();
require 'function.php';

// cek dulu cookie 
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($db, "SELECT username FROM user WHERE id = $id ");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}


if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


    if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username' ");
    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek pssword
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session 
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie dan acak cookie

                setcookie('id', $row['id'], time() + 60);

                // mengacak $row dengan algoritma 'sha256'
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <!-- Font Google -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
     <!-- My CSS -->
     <link rel="stylesheet" href="css/login.css">

     <title>Halaman Login|Kae Squad</title>
</head>

<body background="img/webb-dark.png">

     <div class="container">
          <div class="row my-5">
               <div class="col-md-6 text-center login bg-success">
                    <h4 class="fw-bold" style="color: white;">Login</h4>
                    <!-- Ini Error jika tidak bisa login -->
                    <?php if (isset($error)) : ?>
                    <?php echo '<script>alert("Username atau Password Salah!");</script>'; ?>
                    <?php endif; ?>
                    <form action="" method="post">
                         <div class="form-group user">
                              <input type="text" class="form-control w-50" placeholder="Masukkan Username"
                                   name="username" autocomplete="off" required>
                         </div>
                         <div class="form-group my-5">
                              <input type="password" class="form-control w-50" placeholder="Masukkan Password"
                                   name="password" autocomplete="off" required>
                         </div>
                         <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                              <input type="checkbox" class="btn-check" name="remember" id="remember" autocomplete="off">
                              <label class="btn btn-outline-light" for="remember">Remember Me</label>

                         </div>
                         <button class="btn btn-primary text-uppercase" type="submit" name="login">Login</button>
                         <a href="registrasi.php" class="btn btn-danger text-uppercase"><i
                                   class="bi bi-pencil-square"></i>SIGN UP</a> |

                    </form>
               </div>
          </div>
     </div>



     <!-- Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
     </script>
</body>

</html>