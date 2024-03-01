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
    <div class="data-img">
        <div class="container">
            <h3>Data Galeri Foto</h3>
            <div class="box">
                <p><a href="tambah-image.php">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                           <th width="60px">No</th>
                           <th>Kategori</th>
                           <th>Nama User</th>
                           <th>Nama Foto</th>
                           <th>Deskripsi</th>
                           <th>Gambar</th>
                           <th>Status</th>
                           <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						    $no = 1;
							$user = $_SESSION['a_global']->admin_id;
                            $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE admin_id = '$user' ");
							if(mysqli_num_rows($foto) >0 ){
							while($row = mysqli_fetch_array($foto)){
						?>
                        <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $row['category_name'] ?></td>
                           <td><?php echo $row['admin_name'] ?></td>
                           <td><?php echo $row['image_name'] ?></td>
                           <td><?php echo $row['image_description']?></td>
                           <td><a href="foto/<?php echo $row['image']?>" target="_blank"><img src="foto/<?php echo $row['image']?>" width="50px"></a></td>
                           <td><?php echo ($row['image_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                           <td>
                              <a href="edit-image.php?id=<?php echo $row['image_id'] ?>">Edit</a> || 
                              <a href="proses-hapus.php?idp=<?php echo $row['image_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                           </td>
                        </tr>
                        <?php }}else{ ?>
                             <tr>
                                <td colspan="8">Tidak ada data</td>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
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