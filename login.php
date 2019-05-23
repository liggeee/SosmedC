<?php
session_start();
if(isset($_SESSION["username"])){
    header("Location: profile.php");
    exit;
}
require 'functions/functions.php';

if(isset($_POST["signin"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' and status ='verified'");
    //cek username
    if(mysqli_num_rows($result)===1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row["password"])){
            //set session
            $_SESSION["username"] = $username;
            echo " <script> alert('Berhasil Login') </script> ";
            header("Location: profile.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SosmedC</title>

  <!-- Font Awesome Icons -->
  <link href="style/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

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
            <a class="nav-link js-scroll-trigger" href="signup.php">Sign up</a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100 ">
      <div class="row justify-content-center h-75 ">
        <div class="col-lg-8 align-self-end h-75">
          <h1 class="text-uppercase text-white font-weight-bold">Your Favorite Source of Free Bootstrap Themes</h1>
          <p class="text-white-75 font-weight-light mb-5">Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!</p>
        </div>
        <div class="col-lg-4 align-self-end h-75 wall">
          <form action="" method="post">
            <div class="form-group text-uppercase text-white font-weight-bold">
              <h3 class="align-items-center text-uppercase text-white font-weight-bold">Sign In</h3>

              <?php if(isset($error)):?>
              <p style="color: #f4623a; " > Username atau Password salah </p>
              <?php endif?>
              
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">  
              
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary btn-s" name="signin" >Sign in</button>
            <a href="signup.php">belum punya akun ?</a>
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
