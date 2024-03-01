<?php
    session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
	$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id ='".$_SESSION['id']."'");
	$d = mysqli_fetch_object($query);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>
    <!-- Nav -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
          <a class="navbar-brand" href="index.php">WEB GALERI</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data-image.php">Data Foto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Keluar.php">Keluar</a>
                </li>
            </ul>
          </div>
        </div>
    </nav>
    
    <!-- content -->
    <div class="profil">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                   <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                   <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                   <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                   <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
                   <input type="submit" name="submit" value="Ubah Profil" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   $nama   = $_POST['nama'];
					   $user   = $_POST['user'];
					   $hp     = $_POST['hp'];
					   $email  = $_POST['email'];
					   $alamat = $_POST['alamat'];
					   
					   $update = mysqli_query($conn, "UPDATE tb_admin SET 
					                  admin_name = '".$nama."',
									  username = '".$user."',
									  admin_telp = '".$hp."',
									  admin_email = '".$email."',
									  admin_address = '".$alamat."'
									  WHERE admin_id = '".$d->admin_id."'");
					   if($update){
						   echo '<script>alert("Ubah data berhasil")</script>';
						   echo '<script>window.location="profil.php"</script>';
					   }else{
						   echo 'gagal '.mysqli_error($conn);
					   }
					   
					}  
			   ?>
            </div>
            
            <h3>Ubah password</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                   <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                   <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
               </form>
               <?php
                   if(isset($_POST['ubah_password'])){
					   
					   $pass1   = $_POST['pass1'];
					   $pass2   = $_POST['pass2'];
					   
					   if($pass2 != $pass1){
						   echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
					   }else{
						   $u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
									  password = '".$pass1."'
									  WHERE admin_id = '".$d->admin_id."'");
						   if($u_pass){
							   echo '<script>alert("Ubah data berhasil")</script>';
						       echo '<script>window.location="profil.php"</script>';
						   }else{
							   echo 'gagal '.mysqli_error($conn);
						   }
					   }
					  
					}  
			   ?>
            </div>
        </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
        </div>
    </footer>
</body>
</html>