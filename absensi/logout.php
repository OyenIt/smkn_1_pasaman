<?PHP
include "db/koneksi.php";;
if(isset($_GET['id'])){
	session_destroy();
	Header("Location:/smkn_1_pasaman/absensi/");
}
?>
