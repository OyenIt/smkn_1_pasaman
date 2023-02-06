<?php
if(!isset($_SESSION['id_user'])){
//jika belum login jangan lanjut..
header("Location:http://localhost/absensi_siswa/");
}

//cek level user
if($_SESSION['akses']=="guru"){
}else if ($_SESSION['akses']=="wali kelas") {
}else{
	header("Location:http://localhost/smkn_1_pasaman/absensi/404.php");
}

?>
