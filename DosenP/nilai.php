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
                <a class="navbar-brand" href="../dosenp/homedosen.php">Dosen Pembimbing</a>
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
                            <a href="../dosenp/setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../dosenp/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../dosenp/homedosen.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
					<li  class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#m"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="m" class="collapse">
                            <li>
                                <a href="../upload-download-files/file.php"><i class="fa fa-fw fa-file"></i>File</a>
                            </li>
							<li>
                                <a href="../upload-download-files/format.php"><i class="fa fa-fw fa-book"></i>Upload Format</a>
                            </li>
                            </li>
							<li>
                                <a href="../dosenp/nilai.php"><i class="fa fa-fw fa-pencil"></i>Nilai</a>
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
                            Nilai <small><?php echo $nama?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href = "../dosenp/homedosen.php"> Dashboard </a>
                            </li>
							<li class="active">
                                <i class="fa fa-pencil"></i> Nilai
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <!-- <h2>Bordered with Striped Rows</h2> -->
                        <form action="" method="post">
						<div class="table-responsive">
                            
							<table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
										<th>Nama</th>
										<th>Prodi</th>
										<th>Kelas</th>
										<th>Perusahaan</th>
										<th>Nilai Log Book</th>
										<th>Nilai Absensi</th>
										<!--<th>Tambah</th>-->
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										include "koneksi.php";
										$sql1 = "SELECT * FROM pembimbing where nama = '$nama'";
										$kueri1 = mysql_query($sql1);
										$no=1;
										while($data1 = mysql_fetch_array($kueri1)){
											$nim5 = $data1['nim'];
											$sql5=mysql_query("SELECT * from magang where nim='$nim5'");
											$data5=mysql_fetch_array($sql5);
											$sql4 = "SELECT * FROM nilai where nim = '$nim5'";
											$kueri4 = mysql_query($sql4);
											$data4 = mysql_fetch_array($kueri4);
											$nim_a[]=$data1['nim'];
											$nim4=$data4['nim'];
											$sql2=mysql_query("SELECT * from mahasiswa where nim='$nim5'");
											$data2=mysql_fetch_array($sql2);
									?>
									<tr class="satu">
										<td><?php echo $data2['nama']?></td>
										<td><?php echo $data2['prodi']?></td>
										<td><?php echo $data2['kelas']?></td>
										<td><?php echo $data5['perusahaan']?></td>
										<td><input type = "text" name= "log[]" value ="<?php echo $data4['nilai_log']?>" required></td>
										<td><input type = "text" name= "absen[]" value ="<?php echo $data4['nilai_absen']?>" required></td>
										
									</tr>
									<?php
										$no++;}
									?>
                                </tbody>
                            </table>
							<button name="simpan" type="submit" class="btn btn-default">Simpan</button>
							<!-- <button name="edit" type="submit" class="btn btn-default">Ubah</button> -->
							
                        </div>
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
		if (isset($_POST['simpan'])){
			$log = $_POST['log'];
			$absen = $_POST['absen'];
			//$nim_a = $_POST['h'];
			
				for($i=0;$i<sizeof($log);$i++){
					$sql3=mysql_query("SELECT * from nilai where nim='$nim_a[$i]'");
					$data3=mysql_fetch_array($sql3);
					if($data3['nim']==""){
						$sql = "INSERT INTO nilai values('$log[$i]','$absen[$i]','$nim_a[$i]')";
						$kueri = mysql_query($sql);
						if ($kueri){
							echo "<script> document.location='nilai.php'</script>";
									}
						else {
							echo "<script> alert('Nilai gagal ditambah');document.location='nilai.php'</script>";
							echo mysql_error();
							}
					}else {
							$sql = "update nilai set nilai_log = '$log[$i]', nilai_absen = '$absen[$i]' where nim = '$nim_a[$i]'";
							$kueri = mysql_query($sql);
							if ($kueri){
								echo "<script> document.location='nilai.php'</script>";
										}
							else {
								echo "<script> alert('Nilai gagal diubah');document.location='nilai.php'</script>";
								echo mysql_error();
								}
					}
				
				}
				
		}	
		/*if (isset($_POST['edit'])){
			$log = $_POST['log'];
			$absen = $_POST['absen'];
			//$nim_a = $_POST['h'];
				for($i=0;$i<sizeof($log);$i++){
				$sql = "update nilai set nilai_log = '$log[$i]', nilai_absen = '$absen[$i]' where nim = '$nim_a[$i]'";
				$kueri = mysql_query($sql);
				if ($kueri){
					echo "<script> document.location='nilai.php'</script>";
							}
				else {
					echo "<script> alert('Nilai gagal diubah');document.location='nilai.php'</script>";
					echo mysql_error();
					}
				}
				
		}*/			
		?>