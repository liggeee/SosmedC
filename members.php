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
        <div class="col-sm-12">
            <center>
                <h2>Find New People</h2>
            </center><br><br>
            <div class="row">
                <div class="col-sm-4">

                </div>

                <div class="col-sm-4">
                    <form class="search_form" action="" method="get">
                        <input type="text" placeholder="Search User" name="search_friend">
                        <button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
                    </form>
                    
                </div>

                <div class="col-sm-4">

                </div>

            </div><br><br><br>

            <?php search_user(); ?>
        </div>
    </div>

</body>

</html>