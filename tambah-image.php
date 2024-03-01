<?php
    session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
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
    <div class="tambah-img">
        <div class="container">
            <h3>Tambah Data Foto</h3>
            <div class="box">
             
               <form action="" method="POST" enctype="multipart/form-data">
                
                   <?php   $result = mysqli_query($conn,"select * from tb_category");   $jsArray = "var prdName = new Array();\n";   
                    echo '<select class="input-control" name="kategori" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" required>  <option>-Pilih Kategori Foto-</option>';while ($row = mysqli_fetch_array($result)) {  echo ' <option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';  
                    $jsArray .= "prdName['" . $row['category_id'] . "'] = '" . addslashes($row['category_name']) . "';\n";}echo '</select>';?>
                   </select>
                   <input type="hidden" name="nama_kategori" id="prd_name">
                   <input type="hidden" name="adminid" value="<?php echo $_SESSION['a_global']->admin_id ?>">
                   <input type="text" name="namaadmin" class="input-control" value="<?php echo $_SESSION['a_global']->admin_name ?>" readonly="readonly">
                   <input type="text" name="nama" class="input-control" placeholder="Nama Foto" required>
                   <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br />
                   <input type="file" name="gambar" class="input-control" required>
                   <select class="input-control" name="status">
                       <option value="">--Pilih--</option>
                       <option value="1">Aktif</option>
                       <option value="0">Tidak Aktif</option> 
                   </select>
                   <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   // print_r($_FILES[gambar']);
					   // menampung inputan dari form
					   $kategori  = $_POST['kategori'];
					   $nama_ka   = $_POST['nama_kategori'];
					   $ida  	   = $_POST['adminid'];
					   $user	  = $_POST['namaadmin'];
					   $nama      = $_POST['nama'];
					   $deskripsi = $_POST['deskripsi'];
					   $status    = $_POST['status'];
					   
					   // menampung data file yang diupload
					   $filename = $_FILES['gambar']['name'];
					   $tmp_name = $_FILES['gambar']['tmp_name'];
					   
					   $type1 = explode('.', $filename);
					   $type2 = $type1[1];

                       $newname = 'foto'.time().'.'.$type2; 
						
					   // menampung data format file yang diizinkan
					   $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
					   
					   // validasi format file
					   if(!in_array($type2, $tipe_diizinkan)){
						  // jika format file tidak ada di dalam tipe diizinkan
						  echo '<script>alert("Format file tidak diizinkan")</script>';
						
					   }else{
						   // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
						   // proses upload file sekaligus insert ke database
						   move_uploaded_file($tmp_name, './foto/'.$newname);
						   
						   $insert = mysqli_query($conn, "INSERT INTO tb_image VALUES (
						               null,
									   '".$kategori."',
									   '".$nama_ka."',
									   '".$ida."',
									   '".$user."',
									   '".$nama."',
									   '".$deskripsi."',
									   '".$newname."',
									   '".$status."') ");
										   
				           if($insert){
							   echo '<script>alert("Tambah Foto berhasil")</script>';
							   echo '<script>window.location="data-image.php"</script>';
						   }else{
							   echo 'gagal'.mysqli_error($conn);
							   
						   }
					   }

					   
					   }
			   ?>
        </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
        </div>
    </footer>
    <script>
            CKEDITOR.replace( 'deskripsi' );
    </script>
    <script type="text/javascript"><?php echo $jsArray; ?></script>
</body>
</html>