<?php
include '../../db/koneksi.php';
// include '../akses.php';
include '../../layout/header.php';
?>

<div id="content" style="margin-top:60px;">
  <div class="regular-page-area section-padding-20">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="details-content">
            <div class="container">
              <div class="row">
                <div class="col">
                  <h2 id="xs" ><i class="icon-calendar"></i> SISWA </h2>
                </div>
                <div class="col-lg-2" style="text-align: right;margin-right: 5%;">
                  <a  href="http://localhost/smkn_1_pasaman/absensi/operator/siswa/tambah_identitas_siswa" style=""><h1 id="xs" ><i class="icon-plus-sign" style="color:mediumseagreen;"></i> </h1></a>
                </div>
              </div>
              <div id="myDiv" class="container-fluid">
                <hr>
                <form action="" method="GET">
                  <div class="container">
                   <div class="row row-cols-auto">
                    <div class="col-1">Cari</div>
                    <div class="col">:</div>
                    <div class="col"><input  class="form-control" type="text" name="nama_siswa" placeholder="Nama Siswa"></div>
                  </div>
                  <br>
                  <div class="row row-cols-auto">
                    <div class="col-1">kelas</div>
                    <div class="col">:</div>
                    <div class="col">
                      <select name="kelas" class="form-control" id="kelas">
                        <?php 
                        $queryDataKelas = mysqli_query($konek,"SELECT * FROM ruangan");
                        while ($dataKelas = mysqli_fetch_array($queryDataKelas)) {
                            # code...
                          echo "<option value='".$dataKelas['id_ruangan']."'>".$dataKelas['kelas']."-".$dataKelas['nama_ruangan']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col">
                      <button style="padding-top: calc(0.375rem + 1px);
                      padding-bottom: calc(0.375rem + 1px);
                      margin-bottom: 0; width:20%; border-color:white; width:100px; border-radius: 30px;" type="submit"><i class="icon-search"></i>Cari</button>
                    </div>
                  </div>
                </div>
              </form>
              <br>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget-box">
                    <div class="widget-title">
                     <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center " style="width:5%;background-color: #404040; color:white;border-radius: 10px 0 0 0 ;">NO</th>
                          <th class="text-center" style="background-color: #404040; color:white;">NAMA/NIS</th>
                          <th class="text-center" style="width:5%;background-color: #404040; color:white;" >L/P</th>
                          <th class="text-center" style="background-color: #404040; color:white;">TGL LAHIR</th>

                          <th class="text-center" style="background-color: #404040; color:white;">ALAMAT</th>

                          <th class="text-center" style="width:5%;background-color: #404040; color:white;">KELAS/ROMBEL</th>
                          <th class="text-center" style="background-color: #404040; color:white;">JURUSAN</th>
                          <th class="text-center" style="background-color: #404040; color:white;">TELEPON</th>
                          <!-- <th>Wali Kelas</th> -->
                          <th class="text-center" style="width: 10%;background-color: #404040; color:white;border-radius: 0 10px 0 0 ;" colspan="2">OPTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $batas = 10;
                        $halaman = @$_GET['halaman'];
                        if(empty($halaman)){
                          $posisi     = 0;
                          $halaman    = 1;
                        }
                        else{
                          $posisi = ($halaman-1) * $batas;
                        }

                        if ($posisi !=0) {
                          // code...

                          $no = $posisi;
                        }else{
                          $no=1;
                        }

                        if (isset($_GET['nama_siswa'])) {
                          # code...
                          if(isset($_GET['kelas'])){
                            if ($_GET['nama_siswa'] != '' && $_GET['kelas'] != '' ) {
                            # code...
                              $queryDataSiswa = mysqli_query($konek, "SELECT * FROM biodata_siswa JOIN ruangan ON biodata_siswa.ruangan_siswa = ruangan.id_ruangan JOIN jurusan ON biodata_siswa.jurusan_siswa = jurusan.id_jurusan WHERE nama_siswa like '%".$_GET['nama_siswa']."%' AND ruangan_siswa=".$_GET['kelas']." limit $posisi,$batas");
                            }else if($_GET['nama_siswa'] != ''){
                              $queryDataSiswa = mysqli_query($konek, "SELECT * FROM biodata_siswa JOIN ruangan ON biodata_siswa.ruangan_siswa = ruangan.id_ruangan JOIN jurusan ON biodata_siswa.jurusan_siswa = jurusan.id_jurusan WHERE ruangan_siswa=".$_GET['kelas']." limit $posisi,$batas");
                            }else if($_GET['kelas'] != ''){
                              $queryDataSiswa = mysqli_query($konek, "SELECT * FROM biodata_siswa JOIN ruangan ON biodata_siswa.ruangan_siswa = ruangan.id_ruangan JOIN jurusan ON biodata_siswa.jurusan_siswa = jurusan.id_jurusan WHERE nama_siswa like '%".$_GET['nama_siswa']."%' limit $posisi,$batas");
                            }
                          }
                        }else{
                          $queryDataSiswa = mysqli_query($konek, "SELECT * FROM biodata_siswa JOIN ruangan ON biodata_siswa.ruangan_siswa = ruangan.id_ruangan JOIN jurusan ON biodata_siswa.jurusan_siswa = jurusan.id_jurusan limit $posisi,$batas");
                        }

                        while ($dataSiswa = mysqli_fetch_array($queryDataSiswa)) {
                         ?>
                         <tr>
                          <td class="text-center"><?php echo $no; ?></td>
                          <td class="text-center"><?php echo strtoupper($dataSiswa['nama_siswa']); ?> <br> NIS : <?php echo $dataSiswa['nis_siswa']; ?> </td>
                          <td class="text-center" style="widtd:5%;"><?php echo $dataSiswa['jenis_kelamin_siswa']; ?></td>
                          <td class="text-center"><?php echo $dataSiswa['tgl_lahir_siswa']; ?></td>
                          <td class="text-center"><?php echo $dataSiswa['alamat_siswa']; ?></td>
                          <td class="text-center"><?php echo $dataSiswa['kelas_siswa']; ?> - <?php echo $dataSiswa['nama_ruangan']; ?></td>
                          <td class="text-center"><?php if ($dataSiswa['kosentrasi_jurusan']!='') {
                            # code...
                            echo $dataSiswa['nama_jurusan']."-".$dataSiswa['kosentrasi_jurusan']; 
                          }else{
                             echo $dataSiswa['nama_jurusan'];
                          }
                          ?></td>
                          <td class="text-center"><?php echo $dataSiswa['telepon_siswa']; ?></td>
                          <td class="text-center" style="width:5%;"><form action="" class="form-container" style="margin:10px" autocomplete="false">


                           <a href="edit_identitas_siswa?id_siswa=<?PHP echo $dataSiswa['id_siswa']?>" class="btn" style=" border-color: white;border-radius: 5px; background-color: #999999;"><i class="icon-edit" style="color:white;"></i></a>
                         </form>
                       </td>
                       <td class="text-center" style="width:5%;"><form action="../prosses.php?hapus=siswa" method="post" class="form-container" style="margin:10px" autocomplete="false">


                        <input type="hidden" name="id_siswa" value=<?php echo $dataSiswa['id_siswa']; ?>>
                        <button class="btn" type="submit" style=" border-color: white;border-radius: 5px; background-color: #ff3333;"><i class="icon-trash" style="color:white;"></i> </button>
                      </form></td>
                    </tr>
                    <?php
                    $no++;} ?>
                  </tbody>
                </table>
                <!--awal menentukan banyaknya halaman pagination-->
                <?php
                $query2 = mysqli_query($konek, "SELECT * FROM biodata_siswa");
                $jumlahdata = mysqli_num_rows($query2);
                $jumlahhalaman = ceil($jumlahdata/$batas);
                ?>
                <!--akhir menentukan banyaknya halaman pagination-->

                <!--awal navigasi pagination-->
                <nav>
                  <ul class="pagination justify-content-center">
                    <?php
                    for($i=1;$i<=$jumlahhalaman;$i++) {
                      if ($i != $halaman) {
                        echo "<li class='page-item'><a class='page-link' href='daftar_siswa.php?halaman=$i'>$i</a></li>";
                      } 
                      else {
                        echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                      }
                    }
                    ?>
                  </ul>
                </nav>
              </div>
              <div class="widget-content">
                <div id="placeholder"></div>
                <p id="choices"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script src="../../assets/js/custom/custom.js"></script>
<!--end-main-container-part-->
<?php include '../../layout/footer.php'; ?>
