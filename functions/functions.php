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
