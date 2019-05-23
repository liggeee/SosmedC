<?php
include 'connections.php';
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle collapsed" aria-expanded="false" data-target="#bs-example-navbar-collapse-1">
            
            <span class="sr-only">Toggle navigatioin</span>
            <span class="iconbar"></span>
            <span class="iconbar"></span>
            <span class="iconbar"></span>
            </button>
            <a href="home.php" class="navbar-brand">SosmedC</a>
        </div>
        <div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $usr = $_SESSION['username'];
                $get_user = "SELECT * FROM users where username='$usr'";
                $run_user = mysqli_query($conn, $get_user);
                $row = mysqli_fetch_array($run_user);

                $userid = $row['user_id'];
                $username = $row['username'];
                $name = $row['nama'];
                $biodata = $row['biodata'];
                $relationship = $row['relationship'];
                $userpass = $row['password'];
                $email = $row['email'];
                $gender = $row['user_gender'];
                $birthday = $row['user_birthday'];
                $image = $row['user_image'];
                $cover = $row['user_cover'];
                $status = $row['status'];
                $posts = $row['posts'];
                $regdate = $row['user_reg_date'];
                $recover = $row['recover_account'];

                $user_posts = "SELECT * FROM posts where user_id='$userid'";
                $run_posts = mysqli_query($conn, $user_posts);
                $posts = mysqli_num_rows($run_posts);
                ?>

                <li><a href="profile.php?<?php echo 'u_id=$userid' ?>"> <?php echo $name; ?> </a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="home.php">Find People</a></li>
                <li><a href="messages.php?u_id=new">Messages</a></li>
                <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                        <i> <span class='glyphicon glyphicon-chevron-down'></i></span></a>
                    <ul class='dropdown-menu'>
                        <li>
                            <a href='my_posts.php?u_id=<? $userid; ?>'>My Posts<span class='badge badge-secondary'><?= $posts ?></span></a>
                        </li>
                        <li>
                            <a href='edit_profile.php?u_id=<?=$userid?>'>Edit Account</a>
                        </li>
                        <li role='separator' class='decider'></li>
                        <li>
                            <a href='logout.php'>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <form action="results.php" method="GET" class="navbar-form nafbar-left">
                        <div class="form-group">
                            <input type="text" name="user_query" class="form-control" placeholder="Search">
                            <button type="submit" class="btn btn-info" name="search">Search</button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>