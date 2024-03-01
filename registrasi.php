<?php
	include 'db.php';
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
                    <a class="nav-link" href="galeri.php">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registrasi.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="galeri.php">
              <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
              <input class="search" type="submit" name="cari" value="Search">
            </form>
          </div>
        </div>
    </nav>

    <!-- register -->
    <div class="register">
        <div class="container">
            <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama User" class="input-control" required>
                   <input type="text" name="user" placeholder="Username" class="input-control" required>
                   <input type="password" name="password" placeholder="Password" class="input-control" required>
                   <input type="text" name="tlp" placeholder="Nomor Telpon" class="input-control" required>
                   <input type="text" name="email" placeholder="E-mail" class="input-control" required>
                   <input type="text" name="almt" placeholder="Alamat" class="input-control" required>
                   <input type="submit" name="submit" value="Submit" class="btn-second">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   $nama = ucwords($_POST['nama']);
					   $username = $_POST['user'];
					   $password = $_POST['pass'];
					   $telpon = $_POST['tlp'];
					   $mail = $_POST['email'];
					   $alamat = ucwords($_POST['almt']);
					   
					   $insert = mysqli_query($conn, "INSERT INTO tb_admin VALUES (
					                        null,
											'".$nama."',
											'".$username."',
											'".$password."',
											'".$telpon."',
											'".$mail."',
											'".$alamat."')
											
											");
						if($insert){
							echo '<script>alert("Registrasi berhasil")</script>';
							echo '<script>window.location="login.php"</script>';
						}else{
						    echo 'gagal '.mysqli_error($conn);
						}
						
					   }
			   ?>
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