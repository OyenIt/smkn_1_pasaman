<?php 
include '../db/koneksi.php';

function generatePassword($fullName){
  $removedMultispace = preg_replace('/\s+/', ' ', $fullName);

  $sanitized = preg_replace('/[^A-Za-z0-9\ ]/', '', $removedMultispace);
  $lowercased = strtolower($sanitized);
  $splitted = explode(" ", $lowercased);
  if (count($splitted) == 1) {
   $Pasw = substr($splitted[0], 0, rand(2, 5)) . rand(111111, 999999);
 } else {
   $Pasw = $splitted[0] . substr($splitted[1], 0, rand(0, 3)) . rand(11111, 99999);
 }
 return $Pasw;
}
function MessagePopUp($message,$RedirectTo) {
  echo "<script>window.location.href='".$RedirectTo."';alert('".$message."');</script>";
}

if(isset($_GET['tipe'])){
  if ($_GET['tipe'] == "guru") {

  	// Mengambil data foto dan username
  	$getName =  preg_replace('/\s+/', ' ', $_POST['nama']);
    $name = strtolower($getName);
    $getPassword = generatePassword($getName);
    $namaFile = $_FILES['foto']['name'];
    $namaSementara = $_FILES['foto']['tmp_name'];
    $dirUpload = "../assets/image/guru/";
    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    // Memasukan data ke database
    $queryInputGuru = mysqli_query($konek,"INSERT INTO biodata_guru(nip_guru, nama_guru, jenis_kelamin_guru, tgl_lahir_guru, alamat_guru, pendidikan_guru, status_guru, jabatan_guru, telepon_guru, foto_guru, username, password) VALUES ('$_POST[nip]', '".strtolower($_POST['nama'])."', '$_POST[jenis_kelamin]', '$_POST[tgl_lahir]', '$_POST[alamat]', '$_POST[pendidikan]', '".strtolower($_POST['status'])."', '$_POST[jabatan]', '$_POST[telepon]', '$namaFile', '$name','$getPassword')");

    // check query
    if($queryInputGuru){
      MessagePopUp("Data Guru Tersimpan","guru/tambah_identitas_guru");
    }else{
      MessagePopUp("Data Guru Tidak Tersimpan","guru/tambah_identitas_guru");
    }
  }else if($_GET['tipe'] == "tugasTambahan"){
    $queryInputTugas = mysqli_query($konek, "INSERT INTO tugas_tambahan(guru,nama_tugas_tambahan,kelas_tugas_tambahan,jam_tugas_tambahan,ta)VALUES('$_POST[guru]', '$_POST[tugasTambahan]', '$_POST[kelas]', '$_POST[jamtugasTambahan]', '$_POST[ta]')");

    if($queryInputTugas){
      MessagePopUp("Data Tugas Guru Tersimpan","guru/tambah_fungsi_tugas_guru");
    }else{
      MessagePopUp("Data Tugas Guru Tidak Tersimpan","guru/tambah_fungsi_tugas_guru");
    }
  }else if ($_GET['tipe'] == "jadwalMengajar"){
        // code...
    $queryInputJam = mysqli_query($konek,"INSERT INTO jadwal_mengajar (guru,mapel,ruangan,jurusan,hari,jam_mulai,jam_berakhir,ta)VALUES('$_POST[guru]','$_POST[mapel]','$_POST[ruangan]','$_POST[jurusan]','$_POST[hari]','$_POST[jamMulai]','$_POST[jamBerakhir]', '$_POST[ta]')");

    if ($queryInputJam) {
            // code...
      MessagePopUp("Data Jadwal Mengajar Tersimpan","guru/tambah_jadwal_mengajar_guru");
            // Header("Location:guru/tambah_jam_mengajar");
    }else{
      MessagePopUp("Data Jadwal Mengajar Tidak Tersimpan","guru/tambah_jadwal_mengajar_guru");
    }
  }else if ($_GET['tipe'] == "siswa") {

    // Mengambil Data foto
    $getName =  preg_replace('/\s+/', ' ', $_POST['nama']);
    $name = strtolower($getName);
    $getPassword = generatePassword($getName);
    $namaFile = $_FILES['foto']['name'];
    $namaSementara = $_FILES['foto']['tmp_name'];
    $dirUpload = "../assets/image/siswa/";
    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    $queryInputSiswa = mysqli_query($konek,"INSERT INTO biodata_siswa (nis_siswa,nama_siswa,jenis_kelamin_siswa,tgl_lahir_siswa,alamat_siswa,kelas_siswa,ruangan_siswa,jurusan_siswa,telepon_siswa,foto_siswa,username,password)VALUES('$_POST[nis]','".strtolower($_POST['nama'])."','$_POST[jenis_kelamin]','$_POST[tgl_lahir]','$_POST[alamat]','$_POST[kelas]','$_POST[lokal]','$_POST[jurusan]','$_POST[telepon]', '$namaFile', '$name','$getPassword' )");

    if ($queryInputSiswa) {
            // code...
      MessagePopUp("Data Siswa Tersimpan","siswa/tambah_identitas_siswa");
            // Header("Location:siswa/tambah_siswa");
    }else{
      MessagePopUp("Data Siswa Tidak Tersimpan","siswa/tambah_identitas_siswa");
    }
  }else if ($_GET['tipe'] == "mapel") {
        // code...
    $queryInputJurusan = mysqli_query($konek,"INSERT INTO mapel (nama_mapel,kosentrasi)VALUES('$_POST[mapel]','$_POST[jurusan]')");
    if ($queryInputJurusan) {
      MessagePopUp("Data Mapel Tersimpan","rombel/tambah_mapel");
    }else{
      MessagePopUp("Data Mapel Tidak Tersimpan","rombel/tambah_mapel");
    }
  }else if ($_GET['tipe'] == "jurusan") {
        // code...
    $queryInputJurusan = mysqli_query($konek,"INSERT INTO jurusan (nama_jurusan,kosentrasi_jurusan)VALUES('$_POST[jurusan]','$_POST[kosentrasi]')");

    if ($queryInputJurusan) {
            // code...
      MessagePopUp("Data Jurusan Tersimpan","rombel/tambah_jurusan");

    }else{
      MessagePopUp("Data Jurusan Tidak Tersimpan","rombel/tambah_jurusan");
    }
  }else if ($_GET['tipe'] == "ruangan") {
        // code...
    $queryInputJurusan = mysqli_query($konek,"INSERT INTO ruangan (guru,kelas,nama_ruangan)VALUES('$_POST[guru]','$_POST[kelas]','$_POST[ruangan]')");

    if ($queryInputJurusan) {
            // code...
            // echo '<script>alert("Welcome to Geeks for Geeks")</script>';
            // Header("Location:pelajaran/tambah_lokal");
      MessagePopUp("Data Ruangan Tersimpan","rombel/tambah_ruangan");

    }else{
      MessagePopUp("Data Ruangan Tidak Tersimpan","rombel/tambah_ruangan");
    }
  }else if ($_GET['tipe'] == "ta") {
      
    $queryInputJurusan = mysqli_query($konek,"INSERT INTO ta (semester,tahun_ajaran)VALUES('$_POST[semester]','$_POST[tahun_ajaran]')");
    if ($queryInputJurusan) {
            // code...
      MessagePopUp("Data TA Tersimpan","rombel/tambah_ta");
            // Header("Location:pelajaran/tambah_mapel");
    }else{
      MessagePopUp("Data TA Tidak Tersimpan","rombel/tambah_ta");
    }
  }
}else if(isset($_GET['edit'])){
    if ($_GET['edit'] == "guru") {
        // code...
        $namaFile = $_FILES['foto']['name'];
        $namaSementara = $_FILES['foto']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "../assets/image/guru/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

        $query_daftar=mysqli_query($konek,"UPDATE biodata_guru SET foto_guru='".$namaFile."', nip_guru='$_POST[nip]', nama_guru='$_POST[nama]', jenis_kelamin_guru='$_POST[jenis_kelamin]', tgl_lahir_guru='$_POST[tgl_lahir]', alamat_guru='$_POST[alamat]', pendidikan_guru='$_POST[pendidikan]', status_guru='$_POST[status]', jabatan_guru='$_POST[jabatan]', telepon_guru='$_POST[telepon]' WHERE
            id_guru='$_POST[id_guru]'");
        if($query_daftar){
            MessagePopUp("Data Guru Sudah Dirubah","guru/identitas_guru");
        }else{
            MessagePopUp("Data Guru Tidak Terubah","guru/identitas_guru");
        }
    }
}else if(isset($_GET['hapus'])){
  if($_GET['hapus']=="guru"){
    $queryHapusGuru = mysqli_query($konek,"DELETE FROM biodata_guru WHERE id_guru='$_POST[id_guru]'");
    if($queryHapusGuru){
      MessagePopUp("Data Guru Sudah Terhapus","guru/identitas_guru");
    }else{
      MessagePopUp("Data Guru Tidak Terhapus","guru/identitas_guru");
    }
  }
}




?>