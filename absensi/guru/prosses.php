<?php 
include "../db/koneksi.php";

function MessagePopUp($message,$RedirectTo) {
//     echo "<div id='dialog' title='Basic dialog'>
//   <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the &apos;x&apos; icon.</p>
// </div>";
	echo "<script>window.location.href='".$RedirectTo."';alert('".$message."');</script>";
} 

if (isset($_GET['tipe'])) {
	if ($_GET['tipe'] == "absensiSiswa") {
		$queryCheckAbsen = "SELECT * FROM absensi_siswa WHERE guru='$_SESSION[id_user]'AND ruangan='$_POST[ruangan]' AND jurusan='$_POST[jurusan]' AND tgl_absensi='$_POST[tgl]' AND jam_absensi='$_POST[jam]' AND ta='$_POST[ta]'";
		$showCheckAbsen = mysqli_query($konek, $queryCheckAbsen);
		if(mysqli_num_rows($showCheckAbsen)>0){
			foreach ($_POST['siswa'] as $x => $value) {
				$queryInput = mysqli_query($konek,"UPDATE absensi_siswa SET absensi='".$_POST['absensi'][$x]."' , keterangan='".$_POST['keterangan'][$x]."' WHERE siswa='".$_POST['siswa'][$x]."' AND tgl_absensi='$_POST[tgl]' AND jam_absensi='$_POST[jam]';");
			}
			MessagePopUp("Data Absensi Sudah Diupdate","absensi_online");
		}else{
			foreach($_POST['siswa'] as $x => $value){
				$queryInput = mysqli_query($konek,"INSERT INTO absensi_siswa(siswa,ruangan,guru,jurusan,tgl_absensi,jam_absensi, absensi,keterangan,ta)
					values('".$_POST['siswa'][$x]."','$_POST[ruangan]','$_SESSION[id_user]','$_POST[jurusan]','$_POST[tgl]','$_POST[jam]','".$_POST['absensi'][$x]."','".$_POST['keterangan'][$x]."','$_POST[ta]');");				
			}
			MessagePopUp("Data Absensi Sudah Tersimpan","absensi_online");
					// Header("Location:absensi/absensi_online");
		}
		// $queryCheckJam = "SELECT * FROM jam_mengajar WHERE id_guru='$_SESSION[id_user] 'AND kelas='$_POST[kelas]' AND ruangan='$_POST[lokal]' AND id_jurusan='$_POST[id_jurusan]'";
		// $showCheck =mysqli_query($konek,$queryCheckJam);
		// if(mysqli_num_rows($showCheck)>0){
		// 	while ($data=mysqli_fetch_array($showCheck)) {
		// 		$queryCheckAbsen = "SELECT * FROM absensi_siswa WHERE id_guru='$_SESSION[id_user]'AND id_wali_kelas='$_POST[lokal]' AND id_jurusan='$_POST[id_jurusan]' AND tgl_absensi='$_POST[tgl]' AND jam_absensi='$_POST[jam]'";
		// 		$showCheckAbsen = mysqli_query($konek, $queryCheckAbsen);
		// 		if(mysqli_num_rows($showCheckAbsen)>0){
		// 			foreach ($_POST['id_siswa'] as $x => $value) {
		// 				$queryInput = mysqli_query($konek,"UPDATE absensi_siswa SET absensi='".$_POST['absensi'][$x]."' , keterangan='".$_POST['keterangan'][$x]."' WHERE id_siswa='".$_POST['id_siswa'][$x]."' AND tgl_absensi='$_POST[tgl]' AND jam_absensi='$_POST[jam]';");
		// 			}
		// 			MessagePopUp("Data Absensi Sudah Diupdate","absensi/absensi_online");
		// 			// Header("Location:absensi/absensi_online");
		// 		}else{

		// 			foreach($_POST['id_siswa'] as $x => $value){
		// 				$queryInput = mysqli_query($konek,"INSERT INTO absensi_siswa(id_siswa,id_wali_kelas,id_guru,id_jurusan,tgl_absensi,jam_absensi, absensi,keterangan)
		// 					values('".$_POST['id_siswa'][$x]."','$_POST[lokal]','$_SESSION[id_user]','$_POST[id_jurusan]','$_POST[tgl]','$_POST[jam],','".$_POST['absensi'][$x]."','".$_POST['keterangan'][$x]."');");				
		// 			}
		// 			MessagePopUp("Data Absensi Sudah Tersimpan","absensi/absensi_online");
		// 			// Header("Location:absensi/absensi_online");

		// 		}

		// 	}
		// }
	}
} 
?>