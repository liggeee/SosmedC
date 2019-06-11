<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['username'])) {
    header("location: index.php");
}
?>
<html lang="en">

<head>
    <?php
    $user = $_SESSION['username'];

    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Find People</title>
    <!-- Font Awesome Icons -->
    <!-- Latest compiled and minified CSS -->
    <!-- Latest compiled and minified JavaScript -->

    <link href="style/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="style/css/home_style2.css">


</head>

<body>
    <div class="row">
        <?php

        if (isset($_GET['u_id'])) {
            global $conn;

            $user_id = $_GET['u_id'];
            $select = "SELECT * FROM users where user_id = $user_id";
            $row = mysqli_query($conn, $select);
            $run = mysqli_fetch_assoc($row);
            $name = $run['nama'];
            $username = $run['username'];
            $id = $run['user_id'];
            $image = $run['user_image'];
            $biodata = $run['biodata'];
            $regdate = $run['user_reg_date'];
            $gender = $run['user_gender'];
        }

        echo "
            <div class='row'>
                <div class='col-sm-1'></div>
                <center>
                    <div style='background-color: #e6e6e6' class='col-cm-3' >
                        <h2>Information About</h2>
                    </div>
                    <img class='img-sircle' src='users/$image' width='150' heigth='150' >
                    <br><br>
                    <ul class='list-group'>
                        <li class='list-group-item' title='Username' >$username</li>
                        <li class='list-group-item' title='Name' >$name</li>
                        <li class='list-group-item' title='User Status' >$biodata</li>
                        <li class='list-group-item' title='Gender' >$gender</li>
                        <li class='list-group-item' title='Registration date' >$regdate</li>
                        </ul>   
                </center>
            </div>
        ";
        ?>
    </div>

</body>

</html>