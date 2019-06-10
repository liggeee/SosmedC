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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php
    $usr = $_SESSION["username"];
    $get_user = "SELECT * FROM users where username='$usr'";
    $run_user = mysqli_query($conn, $get_user);
    $row = mysqli_fetch_array($run_user);

    $username = $row['username'];

    ?>

    <title><?= $username; ?></title>
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
	<div id="insert_post" class="col-sm-12">
		<center>
		<form action="home.php?id=<?= $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
		<label class="btn btn-warning" id="">Select Image
		<input type="file" name="upload_image" size="30">
		</label>
		<button id="btn-post" class="btn btn-success" name="sub">Post</button>
		</form>
		
		</center>
	</div>
</div>
</body>

</html>