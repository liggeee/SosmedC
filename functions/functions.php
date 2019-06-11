<?php

//koneksi ke database     

$conn = mysqli_connect("localhost","root","","sosmedc");

function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
        
    }
    return $rows;
}


function insertPost(){
	if(isset($_POST['sub'])){
		global $conn;
		global $userid;

		$content = htmlentities($_POST['content']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);
		if(strlen($content) > 250){
			echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			if(strlen($upload_image) >= 1 && strlen($content) >= 1){

				move_uploaded_file($image_tmp, "imageposts/$upload_image.$random_number");
				$insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$userid', '$content', '$upload_image.$random_number', NOW())";

				$run = mysqli_query($conn, $insert);

				if($run){
					echo "<script>alert('Your Post updated a moment ago!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";

					$update = "update users set posts='yes' where user_id='$userid'";
					$run_update = mysqli_query($conn, $update);
				}

				exit();
			}else{
				if($upload_image=='' && $content == ''){
					echo "<script>alert('Error Occured while uploading!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else{
					if($content==''){
                        
						move_uploaded_file($image_tmp, "imageposts/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$userid','No','$upload_image.$random_number',NOW())";
						$run = mysqli_query($conn, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$userid'";
							$run_update = mysqli_query($conn, $update);
						}

						exit();
					}else{
                        
                        
						$insert = "insert into posts (user_id, post_content, post_date) values('$userid', '$content', NOW())";
						$run = mysqli_query($conn, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$userid'";
							$run_update = mysqli_query($conn, $update);
						}
					}
				}
			}
		}
	}
}

function get_posts(){
	global $conn;
	$per_page = 4;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($conn, $get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['posts_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['post_content'], 0,40);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select *from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($conn,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['username'];
		$user_image = $row_user['user_image'];

		//now displaying posts from database

		if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<img id='posts-img' src='imageposts/$upload_image' style='height:350px;'>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p>$content</p>
							<img id='posts-img' src='imageposts/$upload_image' style='height:350px;'>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<h3><p>$content</p></h3>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}

	include("pagination.php");
}

function tambah($data){
    global $conn;
    
    $nohp = htmlspecialchars($data["nohp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    //upload gambar
    $gambar = upload();
    
    if(!$gambar){
        return false;
    }
    $query = "INSERT INTO mahasiswaa 
                VALUES
            ('','$nim','$nama','$email','$jurusan','$gambar')
            ";
    mysqli_query($conn,$query);
    
    return mysqli_affected_rows($conn);

    }

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    
    if($error === 4){
        echo "
           <script>
                alert('pilih gambar terlebih dahulu');
            </script> 
        ";
        return false;
    }
    
    //cek ekxtensi file
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if (!in_array($ekstensiGambar,$ekstensiGambarValid)){
        echo "
           <script>
                alert('yang diupload bukan gambar');
            </script> 
        ";
        return false;
    }
    
    if ($ukuranFile > 1000000){
        echo "
           <script>
                alert('ukuran gambar terlalu besar');
            </script> 
        ";
        return false;
    }
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= '$ekstensiGambar';
    move_uploaded_file($tmpName,'img/'. $namaFile);
    
    return $namaFile;
}

function hapus($id){
    global $conn;
    $query = "DELETE FROM mahasiswaa WHERE id = $id";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;
    
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    
    if ($_FILES['gambar']['error']===4){
        $gambar = $gambarLama;
    }
    else {
        $gambar = upload();
    }   
    $id = $data["id"];
    
    $query = "UPDATE mahasiswaa SET
            nim='$nim',
            nama='$nama',
            email='$email',
            jurursan='$jurusan',
            gambar='$gambar'
            
            WHERE id = $id
            
            ";
    mysqli_query($conn,$query);
    
    return mysqli_affected_rows($conn);

}

function cari($search){
    $query = "
        SELECT * FROM mahasiswaa WHERE
        nama like '%$search%' OR
        nim like '%$search%' OR
        jurursan like '%$search%'
        
    ";
        return query($query);
}

function registrasi($data){
    global $conn;
    
    $nama = htmlentities(mysqli_real_escape_string($conn,$data["nama"]));
    $username = strtolower(stripslashes($data["username"]));
    $email = htmlentities(mysqli_real_escape_string($conn,$data["email"]));
    $gender = htmlentities(mysqli_real_escape_string($conn,$data["gender"]));
    $birthday = htmlentities(mysqli_real_escape_string($conn,$data["date"]));
    $status = "verified";
    $posts = "no";
    $check_username_query = "select username from users where username='$username'";
    $run_username = mysqli_query($conn, $check_username_query);
    
    
    $password = htmlentities(mysqli_real_escape_string($conn,$data["password"]));
    $password2 = htmlentities(mysqli_real_escape_string($conn,$data["password2"]));

    
    
    if (!$username && !$password && !$password2 ){
        echo"
            <script>
                alert('HARAP ISI USERNAME DAN PASSWORD !!');
            </script>
        ";
        return false;
    }
    
    if(mysqli_fetch_assoc($run_username)){
        echo"
            <script>
                alert('username yang dipilih telah terdaftar!');
            </script>
        ";
        
        return false;
    }
    
    if($password != $password2){
        echo"
            <script>
                alert('password tidak sama');
            </script>
        ";
    return false;
    }
    
    $password  = password_hash($password, PASSWORD_DEFAULT);
    
    //tambahkan data baru ke database
    
    $insert = "INSERT INTO users VALUES
    ('','$nama','$username','$password','$email','Halo Saya sekarang menggunakan SosmedC :) ','...','$gender','default.png','default.jpg','$birthday',NOW(),'$status','$posts','rotio')";

    mysqli_query($conn,$insert);
    
    return mysqli_affected_rows($conn);
}

function search_user() {
	global $conn;

	if	(isset($_GET['search_user_btn'])) {
		$search_query = htmlentities($_GET['search_user']);
		$get_user = "select * form users where nama like '%$search_query%' "; 
		
	}
	else {
		$get_user = "SELECT * FROM users";
	}

	$run_user = mysqli_query($conn,$get_user);

	while ($row_user = mysqli_fetch_assoc($run_user)) {
		
		$username = $row_user['username'];
		$user_id = $row_user['user_id'];
		$name = $row_user['nama'];
		$user_image = $row_user['user_image'];


		echo "
		<div class='row'>
			<div class='col-sm-3'>
			</div>
			<div class='col-sm-6'>
				<div class='row' id='find_pople'>
					<div class='col-sm-4'>
					<a href='user_profile.php?u_id=$user_id'>
					<img src='users/$user_image' width='150px' heigth ='140px' 
					title='$username' style='float : left; ,margin  1px;'>
					</a>
					</div><br><br>
					<div class='col-sm-6'>
					<a style='text-decoration:none; cursor:pointer;color#3897f0;' href='user_profile.php?u_id=$user_id '>
					<strong><h2>$name</h2></strong>
					</a>
					</div>
					<div class='col-sm-3'></div>
				</div>
			</div>
			<div class='col-sm-4'>
			</div>
		</div><br>
		";

	}
}
