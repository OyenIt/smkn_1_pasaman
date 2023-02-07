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
                 
                <br>
                <div class="row row-cols-auto">
                  <div class="col-1">TA</div>
                  <div class="col">:</div>
                  <div class="col">
                    <select name="ta" class="form-control" id="ta" style="width:200px;">
                      <option value="">Tahun Ajaran</option>
                      <?php 
                      $queryDataTA = mysqli_query($konek, "SELECT * FROM ta ");
                      while($dataTa = mysqli_fetch_array($queryDataTA)){
                        echo "<option value=".$dataTa['id_ta'].">Semester ".$dataTa['semester']." Tahun Ajaran ".$dataTa['tahun_ajaran']."</option>"; } ?>
                      </select>
                    </div>
                  <div class="col-1">Bulan</div>
                  <div class="col">:</div>
                  <div class="col"><input type="month" name="tgl_absen" class="form-control" style="width:200px;"></div>
                  
                  <div class="col">
                    <button style="padding-top: calc(0.375rem + 1px);
                    padding-bottom: calc(0.375rem + 1px);
                    margin-bottom: 0; border-color:white; width:100px; border-radius: 30px;" type="submit"><i class="icon-search"></i>Cari</button>
                  </div>
                </div>
                <br>
              </div>
            </div>
          </form>
          <br>
          <div class="row-fluid">
            <div class="span12">
              <div class="widget-box">
                <div class="widget-title">
                  <form action="cetak.php?absensi=Bulanan" method="post" class="form-container" style="margin:10px" autocomplete="false">
                    <div style="overflow-x:auto;">
                      <table class="table table-bordered" style="width:100%;">
                        <caption id="caption">Absensi Pertemuan</caption>
                        <thead>
                          <tr>
                            <th class="text-center thFixed"
                            style="width:5%; border-radius: 10px 0 0 0 ;" rowspan="3">NO</th>
                            <th class="text-center thFixed " rowspan="2" style="min-width:300px;" >NAMA  </th>
                            <th class="text-center thFixed " rowspan="1" colspan="31" ><?php if (isset($_GET['tgl_absen'])) {
                              # code..
                              $tgl_absen =explode("-", $_GET['tgl_absen']);
                              $date_start = date("F",strtotime($tgl_absen[0]."-".$tgl_absen[1]."-"."01"));
                              echo strtoupper($date_start);
                            }else{
                              echo "BULAN";
                            } ?></th>
                            <th class="text-center thFixed" rowspan="1" colspan="5" >TOTAL</th>
                            <th class="text-center thFixed " rowspan="2" style="min-width:300px;border-radius: 0 10px 0 0;">KETERANGAN</th>

                          </tr>
                          <tr>

                            <?php 
                            $loop_jam = 1;
                            for ($loop_jam; $loop_jam<32; $loop_jam++) { 
                               // for ($i=1; $i <= 10; $i++) { 
                              ?>
                              <th style="width: 2%;"><?php echo $loop_jam; ?></th>

                              <?php
                               // }
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
                          if(isset($_GET['ta'])){
                            $get_ruangan = $_SESSION['ruangan'];
                            $get_jurusan = $_SESSION['jurusan'];
                            $get_ta = $_GET['ta'];
                            $tgl_absen =explode("-", $_GET['tgl_absen']);
                            $date_start = strtotime($tgl_absen[0]."-".$tgl_absen[1]."-"."01");
                            $date_end = strtotime('last day of this month', $date_start);
                            $tgl_absensi_mulai = date('Y-m-d',$date_start);
                            $tgl_absensi_berakhir = date('Y-m-d',$date_end);
                            ?>
                            <?php
                            $query = "SELECT * FROM biodata_siswa WHERE id_siswa=".$_SESSION['id_user'];
                            $query_tampilSiswa = mysqli_query($konek, $query);
                            $no = 1;
                            if(mysqli_num_rows($query_tampilSiswa) > 0){
                              foreach($query_tampilSiswa as $items){
                               ?>
                               <tr>
                                <td><?php echo "".$no++; ?> </td>
                                <td><?php echo strtoupper($items['nama_siswa']);?></td>
                                <?php
                                $lop = 10;
                                $hadir=0;
                                $alfa=0;
                                $cabut=0;
                                $izin=0;
                                $sakit=0;
                                $i=1;
                                $checkJumlahTGL = 1;
                                $checkTgl='';

                                $begin = new DateTime( $tgl_absensi_mulai );
                                $end = new DateTime( $tgl_absensi_berakhir );
                                $end = $end->modify( '+1 day' ); 

                                $interval = new DateInterval('P1D');
                                $daterange = new DatePeriod($begin, $interval ,$end);
                                foreach($daterange as $date1){
                                  $tglDimulai = $date1->format("Y-m-d");
                                  $queryDataAbsensi = mysqli_query($konek,"SELECT * FROM absensi_siswa WHERE siswa=".$items['id_siswa']." AND ruangan=".$items['ruangan_siswa']." AND jurusan=".$items['jurusan_siswa']." AND jam_absensi=".$i." AND ta=".$_GET['ta']." AND tgl_absensi='".$tglDimulai."'");
                                  if(mysqli_num_rows($queryDataAbsensi) > 0){
                                    if (date('l',strtotime($tglDimulai)) != 'Sunday') {
                                    // code...
                                      while($dataAbsenSiswa = mysqli_fetch_array($queryDataAbsensi)){
                                        if ($dataAbsenSiswa['absensi']=='H') {
                                              // code...
                                          $hadir++;
                                        }else if ($dataAbsenSiswa['absensi']=='A') {
                                              // code...
                                          $alfa++;
                                        }else if ($dataAbsenSiswa['absensi']=='C') {
                                              // code...
                                          $cabut++;
                                        }else if ($dataAbsenSiswa['absensi']=='I') {
                                              // code...
                                          $izin++;
                                        }else if ($dataAbsenSiswa['absensi']=='S') {
                                              // code...
                                          $sakit++;
                                        }
                                        if ($dataAbsenSiswa['absensi']=="C" || $dataAbsenSiswa['absensi']=="A") {
                                          // code...
                                          echo "<td style='color:red;'>".$dataAbsenSiswa['absensi']."</td>";
                                        }else{
                                          echo "<td>".$dataAbsenSiswa['absensi']."</td>";
                                        }
                                      }
                                    }else{
                                      echo "<td></td>";
                                    }

                                  }else{
                                    echo "<td></td>";
                                  }
                                  $checkJumlahTGL++;
                                }
                                // $queryDataAbsensi = mysqli_query($konek,"SELECT * FROM absensi_siswa WHERE siswa=".$items['id_siswa']." AND ruangan=".$items['ruangan_siswa']." AND jurusan=".$items['jurusan_siswa']." AND ta=".$_GET['ta']);
                                //   if(mysqli_num_rows($queryDataAbsensi) > 0){

                                //       # code...
                                //       while($dataAbsenSiswa = mysqli_fetch_array($queryDataAbsensi)){
                                       
                                //         if ($checkTgl != $dataAbsenSiswa['tgl_absensi']) {
                                //           if ($dataAbsenSiswa['absensi']=='H') {
                                //                   // code...
                                //             $hadir++;
                                //           }else if ($dataAbsenSiswa['absensi']=='A') {
                                //                   // code...
                                //             $alfa++;
                                //           }else if ($dataAbsenSiswa['absensi']=='C') {
                                //                   // code...
                                //             $cabut++;
                                //           }else if ($dataAbsenSiswa['absensi']=='I') {
                                //                   // code...
                                //             $izin++;
                                //           }else if ($dataAbsenSiswa['absensi']=='S') {
                                //                   // code...
                                //             $sakit++;
                                //           }
                                //           if ($dataAbsenSiswa['absensi']=="C" || $dataAbsenSiswa['absensi']=="A") {
                                //               // code...
                                //             echo "<td style='color:red;'>".$dataAbsenSiswa['absensi']."</td>";
                                //           }else{
                                //             echo "<td>".$dataAbsenSiswa['absensi']."</td>";
                                //           }
                                //           $checkTgl = $dataAbsenSiswa['tgl_absensi'];
                                //         }
                                //       }
                                //       $i++;
                                //     }
                                if($checkJumlahTGL!=31){
                                  for ($i=$checkJumlahTGL; $i <= 31; $i++) { 
                                    # code...
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
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                  
                </form>
              </div>
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
</div><script src="../../js/custom/custom.js"></script>
<script >
  $('.pane-hScroll').scroll(function() {
    $('.pane-vScroll').width($('.pane-hScroll').width() + $('.pane-hScroll').scrollLeft());
  });
</script>
<!--end-main-container-part-->
<?php include '../../layout/footer.php'; ?>
</div>


