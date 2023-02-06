<?php
include '../../db/koneksi.php';
include '../akses.php';
include '../../layout/header.php';
?>

<div id="content" style="margin-top:60px;">
  <div class="regular-page-area section-padding-20">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="details-content">
            <h2 id="xs"><i class="icon-calendar"></i> GURU </h2>
            <div id="myDiv" class="container-fluid">
              <hr>
              <form action="" method="GET">
                <div class="container">
                  <div class="row row-cols-auto">
                    <div class="col-1">Jurusan</div>
                    <div class="col">:</div>
                    <div class="col">
                      <select name="jurusan" class="form-control" id="jurusan" style="width:200px; margin: ;">
                        <option value="">Jurusan</option>
                        <?php 
                        $queryDataJurusan = mysqli_query($konek, "SELECT * FROM jurusan;");

                        while($dataJurusan = mysqli_fetch_array($queryDataJurusan)){
                          if ($dataJurusan['kosentrasi_jurusan'] != null) {
                            // code...
                            echo "<option value=".$dataJurusan['id_jurusan'].">".$dataJurusan['nama_jurusan']."-".$dataJurusan['kosentrasi_jurusan']."</option>";
                          }else{
                            echo "<option value=".$dataJurusan['id_jurusan'].">".$dataJurusan['nama_jurusan']."</option>";
                          }
                          ?>
                        <?php } ?>
                      </select>
                    </div>
                      <div class="col-1">Ruangan</div>
                    <div class="col">:</div>
                    <div class="col-3">
                      <select name="ruangan" class="form-control" id="ruangan" style="width:200px;">
                        <option value="">ruangan</option>
                        <?php 
                        $queryDataRuangan = mysqli_query($konek, "SELECT * FROM ruangan ");
                        while($dataRuangan = mysqli_fetch_array($queryDataRuangan)){
                          echo "<option value=".$dataRuangan['id_ruangan'].">".$dataRuangan['kelas']."-".$dataRuangan['nama_ruangan']."</option>";
                          ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <br>
                  <div class="row row-cols-auto">
                    <div class="col-1">Tanggal</div>
                    <div class="col">:</div>
                    <div class="col"><input type="date" name="tgl_absen" class="form-control" style="width:200px;"></div>

                    <div class="col-1">TA</div>
                    <div class="col">:</div>
                    <div class="col">
                      <select name="ta" class="form-control" id="ta" style="width:200px;">
                        <caption id="caption"><?php 
                            if (isset($_GET['ta'])) {
                              # code...
                              $queryDataTA = mysqli_query($konek, "SELECT * FROM ta WHERE id_ta=".$_GET['ta']);
                              while($dataTa = mysqli_fetch_array($queryDataTA)){
                                echo "<h6><i>Semester ".$dataTa['semester']." Tahun Ajaran ".$dataTa['tahun_ajaran']."</i></h6>"; } 
                            } ?>
                              
                            </caption>
                        <?php 
                        $queryDataTA = mysqli_query($konek, "SELECT * FROM ta ");
                        while($dataTa = mysqli_fetch_array($queryDataTA)){
                          echo "<option value=".$dataTa['id_ta'].">Semester ".$dataTa['semester']." Tahun Ajaran ".$dataTa['tahun_ajaran']."</option>"; } ?>
                      </select>
                    </div>
                    <div class="col">
                      <button style="padding-top: calc(0.375rem + 1px);
                      padding-bottom: calc(0.375rem + 1px);
                      margin-bottom: 0; border-color:white; width:100px; border-radius: 30px;" type="submit"><i class="icon-search"></i>Cari</button>
                    </div>
                  </div>
                </div>
              </form>
            <br>
            <div class="row-fluid">
              <div class="span12">
                <div class="widget-box">
                  <div class="widget-title">
                    <div style="overflow-x:auto;" id="dvContents" >
                      <form action="cetak.php?absensi=harian" method="post" class="form-container" style="margin:10px" autocomplete="false">
                        <table class="table table-bordered" style="width:100%;">
                          <caption id="caption">Absensi Harian</caption>
                          <thead>
                            <tr>
                              <th class="text-center thFixed"
                              style="width:5%; border-radius: 10px 0 0 0 ;" rowspan="3">NO</th>
                              <th class="text-center thFixed " rowspan="3" style="min-width:300px;" >NAMA</th>
                              <th class="text-center thFixed " rowspan="1" colspan="10" >HARI</th>
                              <th class="text-center thFixed" rowspan="2" colspan="5" style="">TOTAL</th>
                              <th class="text-center thFixed " rowspan="3" style="min-width:100px;border-radius: 0 10px 0 0;">KETERANGAN</th>
                            </tr>
                            <tr>
                              <th  colspan="10" class="text-center thFixed"><?php 
                              if(isset($_GET['tgl_absen']) ){
                                $hari =date('l',strtotime($_GET['tgl_absen']));
                                if ($hari == "Monday") {
                                  $hari = "SENIN";
                                }else if ($hari == "Tuesday") {
                                  $hari = "SELASA";
                                }else if ($hari == "Wednesday") {
                                  $hari = "RABU";
                                }else if ($hari == "Thursday") {
                                  $hari = "KAMIS";
                                }else if ($hari == "Friday") {
                                  $hari = "JUMAT";
                                }else if ($hari == "Saturday") {
                                  $hari = "SABTU";
                                }else if ($hari == "Sunday") {
                                  $hari = "MINGGU";
                                }
                                echo $hari;
                              }?></th>
                            </tr>
                            <tr>
                              <?php 
                              $loop_jam = 1;
                              for ($loop_jam; $loop_jam<2; $loop_jam++) { 
                               for ($i=1; $i <= 10; $i++) { 
                                ?>
                                <th class='text-center' style="width: 5%;"><?php echo $i; ?></th>
                              <?php }
                            } ?>
                            <th class="text-center thFixed">H</th>
                            <th class="text-center thFixed">I</th>
                            <th class="text-center thFixed">S</th>
                            <th class="text-center thFixed">A</th>
                            <th class="text-center thFixed">C</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if(isset($_GET['ruangan']) && isset($_GET['jurusan']) && isset($_GET['tgl_absen']) && isset($_GET['ta'])){
                            $get_ruangan = $_GET['ruangan'];
                            $get_jurusan = $_GET['jurusan'];
                            $get_tgl = $_GET['tgl_absen'];
                            $get_ta = $_GET['ta'];
                            ?>
                            <input type='hidden' name='get_kelas' value="<?php echo $get_kelas; ?>" />
                            <input type='hidden' name='get_ruangan' value="<?php echo $get_ruangan; ?>" />
                            <input type='hidden' name='get_jurusan' value="<?php echo $get_jurusan; ?>" />
                            <input type='hidden' name='get_tgl' value="<?php echo $get_tgl; ?>" />
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM biodata_siswa WHERE ruangan_siswa = '$get_ruangan' AND jurusan_siswa = '$get_jurusan';";
                            $query_tampilSiswa = mysqli_query($konek, $query);
                            if(mysqli_num_rows($query_tampilSiswa) > 0){
                              foreach($query_tampilSiswa as $items){
                                ?>
                                <tr>
                                  <td><?php echo "".$no++; ?> </td>
                                  <td><?php echo strtoupper($items['nama_siswa']);?></td>
                                  <?php $lop=10;
                                  $hadir=0;
                                  $alfa=0;
                                  $cabut=0;
                                  $izin=0;
                                  $sakit=0;
                                  for ($i=1; $i <= $lop; $i++) { 
                                      // code...
                                    $queryDataAbsensiSiswa = mysqli_query($konek,"SELECT * FROM absensi_siswa WHERE siswa=".$items['id_siswa']." AND ruangan=".$get_ruangan." AND jurusan=".$get_jurusan." AND jam_absensi=".$i." AND tgl_absensi='".$get_tgl."' AND ta='".$get_ta."'");

                                    if(mysqli_num_rows($queryDataAbsensiSiswa) > 0){
                                      while($dataSiswa = mysqli_fetch_array($queryDataAbsensiSiswa)){

                                        if ($dataSiswa['absensi']=='H') {
                                            // code...
                                          $hadir++;
                                        }else if ($dataSiswa['absensi']=='A') {
                                            // code...
                                          $alfa++;
                                        }else if ($dataSiswa['absensi']=='C') {
                                            // code...
                                          $cabut++;
                                        }else if ($dataSiswa['absensi']=='I') {
                                            // code...
                                          $izin++;
                                        }else if ($dataSiswa['absensi']=='S') {
                                            // code...
                                          $sakit++;
                                        }
                                        if ($dataSiswa['absensi']=="C" || $dataSiswa['absensi']=="A") {
                                        // code...
                                          echo "<td class='text-center' style='color:red;'>".$dataSiswa['absensi']."</td>";
                                        }else{
                                          echo "<td class='text-center'>".$dataSiswa['absensi']."</td>";
                                        }
                                        ?>

                                        <input type='hidden' name='input_absensi_siswa[]' value="<?php echo $dataSiswa['id_absensi']; ?>" />
                                        <?php
                                      }
                                    }else{
                                      echo "<td></td>";
                                    }
                                  }
                                  echo "<td>".$hadir."</td>";
                                  echo "<td>".$izin."</td>";
                                  echo "<td>".$sakit."</td>";
                                  echo "<td>".$alfa."</td>";
                                  echo "<td>".$cabut."</td>";
                                  echo "<td></td>";
                                  ?>
                                </tr>
                                <?php 
                              }
                            }}
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <div align="right">
                        <input type="submit" value="Print" name="simpan" style="width:10%;">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="widget-content">
                <div id="placeholder"></div>
                <p id="choices"></p>
              </div>
              <!-- <input type="button" onclick="window.print();" value="Print"/> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../../js/custom/custom.js"></script>
<script >
  $('.pane-hScroll').scroll(function() {
    $('.pane-vScroll').width($('.pane-hScroll').width() + $('.pane-hScroll').scrollLeft());
  });
</script>

<!--end-main-container-part-->
<?php include '../../layout/footer.php'; ?>
</div>

