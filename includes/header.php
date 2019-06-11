<?php
include 'connections.php';
include 'functions/functions.php';
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">SosmedC</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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

                <li><a href='profile.php?<?php echo "u_id=$userid" ?>'><?php echo "$name"; ?></a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="members.php">Find People</a></li>
                


                <?php
                echo "

						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
							<ul class='dropdown-menu'>
								
								<li>
									<a href='edit_profile.php?u_id=$userid'>Edit Account</a>
								</li>
								<li role='separator' class='divider'></li>
								<li>
									<a href='logout.php'>Logout</a>
								</li>
							</ul>
						</li>
						";
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <form class="navbar-form navbar-left" method="get" action="results.php">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_query" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-info" name="search">Search</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>