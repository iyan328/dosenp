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
			$log = isset($_POST['log']);
			$absen = isset($_POST['absen']);
			//$nim = $_POST['nim'];
			if($log=="" && $absen==""){
				echo "<script> alert('nilai tidak boleh kosong');document.location='nilai.php'</script>";
			}else{
					$sql = "INSERT INTO nilai values(NULL,'$log','$absen','$kode')";
			$kueri = mysql_query($sql);
			
			if ($kueri){
				echo "<script> document.location='nilai.php'</script>";
			}
			else {
				echo "<script> alert('Akun gagal dimasukkan ke database');document.location='nilai.php'</script>";
				echo mysql_error();
			}
			}
			
		} else {
			echo "<script>alert('Mahasiswa Belum Dipilih');document.location='nilai.php'</script>";
		}
		
	?>
