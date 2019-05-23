<?php
require 'functions/functions.php';
session_start();
// if(isset($_SESSION["login"])){
//     header("Location: index.php");
//     exit;
// }
if(isset($_POST["signup"])){
    if(registrasi($_POST) > 0){
        echo "
            <script>
                alert('user baru berhasil ditambahkan');
                header('Location: index.php');
            </script>
        ";
    } 
    else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

    <!-- Font Awesome Icons -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="style/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="style/css/creative.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="index.php">SosmedC</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#services">Sign up</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead">
        <div class="container h-80 ">
            <div class="row justify-content-center h-80 ">

                <div class="col-lg-10 align-self-end h-80 wall">
                    <form action="" method="post" >
                        <div class="form-group text-uppercase text-white font-weight-bold">
                            <h3 class="align-items-center text-uppercase text-white font-weight-bold">Sign Up</h3>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" >
                            <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Masukkan No HP">
                            <select name="gender" id="gender" class="form-control">
                                <option value="disabled"> --Pilih Kelamin--</option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password">
                            <input type="date" class="form-control" id="date" name="date">

                        </div>
                        <button type="submit" class="btn btn-primary btn-s" name="signup" >Sing Up </button>
                    </form>

                </div>
            </div>
        </div>
    </header>


    <!-- Bootstrap core JavaScript -->
    <script src="style/vendor/jquery/jquery.min.js"></script>
    <script src="style/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="style/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="style/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="style/js/creative.min.js"></script>

</body>

</html>