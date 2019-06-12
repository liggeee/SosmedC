<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['username'])) {
    header("location: index.php");
}

if (isset($_POST["submit"])) {

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
            </script>
        ";
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Edit Account Settings</title>
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
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="6" class="active">
                            <h2>Edit Your Profile</h2>>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Change Your Name</td>
                        <td>
                            <input class="form-control" type="text" name="name" required value="<?php echo $name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Change Your Username</td>
                        <td>
                            <input class="form-control" type="text" name="username" required value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Change Your Biodata</td>
                        <td>
                            <input class="form-control" type="text" name="biodata" required value="<?php echo $biodata; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Change Your Relationship Status</td>
                        <td>
                            <select class="form-control" name="relationship">
                                <option><?php echo $relationship ?></option>
                                <option>Engaged</option>
                                <option>Married</option>
                                <option>Single</option>
                            </select>
                        </td>
                    </tr>

                    <td style="font-weight: bold;">Email</td>
                    <td>
                        <input class="form-control" type="email" name="email" required value="<?php echo $email; ?>">
                    </td>
                    </tr>

                    <tr>
                        <td>
                            <button class="btn btn-default" name="submit">Submit</button>
                        </td>

                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>