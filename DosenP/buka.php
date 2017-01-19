<?php
	include "koneksi.php";
	if(isset($_GET['kode'])){
		$kode = $_GET['kode'];
	} else {
		echo "<script>alert('Data Belum Dipilih');document.location='perusahaan.php'</script>";
	}
	$sql = "SELECT * FROM perusahaan WHERE id='$kode'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nama = $data['nama'];
	$alamat= $data['alamat'];
	$jumlah= $data['jumlah'];
	$tanggal= $data['tanggal'];
	$sql1 = "create table $nama (nim varchar(10),id int(10))";
	$kueri1 = mysql_query($sql1);
	if ($kueri1){
				echo "<script> document.location='kerjasama.php'</script>";
			}
			else {
				echo "<script> alert('Data Perusahaan gagal dimasukkan ke database');document.location='kerjasama.php'</script>";
				echo mysql_error();
			}
	?>