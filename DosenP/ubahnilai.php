<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
else{
	$nm = $_SESSION['username'];
}

//cek level user
if($_SESSION['hak_akses']!="dosenpembimbing"){
die("Anda bukan Dosen Pembimbing");//jika bukan admin jangan lanjut
}
?>
<?php
	include "koneksi.php";
	
	$sql = "SELECT * FROM p_poltek WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nama = $data['nama'];
	?>
<?php
		include "koneksi.php";
		if(isset($_GET['kode'])){
			$kode = $_GET['kode'];
		} else {
			echo "<script>alert('Mahasiswa Belum Dipilih');document.location='nilai.php'</script>";
		}
			$sql3 = "SELECT * FROM mhs where nim = '$kode'";
			$kueri3 = mysql_query($sql3);
			$data3 = mysql_fetch_array($kueri3);
			$nim3=$data3['nim'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Dosen Pembimbing</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="homedosen.php">Dosen Pembimbing</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nama?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!-- <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                        <li>
                            <a href="setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="homedosen.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
					<li  class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#m"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="m" class="collapse">
                            <li>
                                <a href="../upload-download-files/file.php"><i class="fa fa-fw fa-file"></i>File</a>
                            </li>
                            </li>
							<li>
                                <a href="nilai.php"><i class="fa fa-fw fa-pencil"></i>Nilai</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Ubah Nilai <small><?php echo $nama?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="homedosen.php"> Dashboard </a>
                            </li>
							<li>
                                <i class="fa fa-pencil"></i><a href="nilai.php"> Nilai </a> 
                            </li>
							<li class="active">
                                <i class="fa fa-edit"></i> Ubah Nilai
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               
                <!-- /.row -->

                <div class="row">
				<div class="col-lg-4">
                    <form role="form" action="" method="post">
					<?php
						include "koneksi.php";
							$sql2 = "SELECT * FROM nilai where nim = '$kode'";
							$kueri2 = mysql_query($sql2);
							$data2 = mysql_fetch_array($kueri2);
							$nilai1=$data2['nilai_log'];
							$nilai2=$data2['nilai_absen'];
					?>
					
							<div class="form-group">
                                <label>Nim</label>
                                <input name="nim" class="form-control" type="text" value = "<?php echo $nim3?>" readonly>
                            </div>
							<div class="form-group">
								<label>Nilai Log Book</label>
								<input name="log" type="text" class="form-control" value = "<?php echo $nilai1?>" required>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
                                <label>Nilai Absensi</label>
                                <input name="absen" class="form-control" type="text" value = "<?php echo $nilai2?>" required>
                            </div>
							
							<button name="tbltambah" type="submit" class="btn btn-default">Simpan</button>
							<button name="batal" type="submit" class="btn btn-default">Batal</button>
						</form>
                </div>
				</div>
                <!-- /.row -->

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
<?php
		include "koneksi.php";
		if (isset($_POST['tbltambah'])){
			$log = $_POST['log'];
			$absen = $_POST['absen'];
			$nim = $_POST['nim'];
			$sql = "UPDATE nilai set nilai_log = '$log', nilai_absen = '$absen' where nim = '$nim'";
			$kueri = mysql_query($sql);
			
			if ($kueri){
				echo "<script> document.location='nilai.php'</script>";
			}
			else {
				echo "<script> alert('Akun gagal disimpan ke database');document.location='tambahnilai.php'</script>";
				echo mysql_error();
			}
		}
		if (isset($_POST['batal'])){
		echo "<script> document.location='nilai.php'</script>";
		
		}
		?>			
	