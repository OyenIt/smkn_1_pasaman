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
            <div class="container">
              <div class="row">
                <div class="col-sm">
                  <h2 id="xs" ><i class="icon-calendar"></i> JADWAL MENGAJAR </h2>
                </div>
                <div class="col-sm" style="text-align: right;margin-right: 5%;">
                  <a class="col-sm" href="http://localhost/smkn_1_pasaman/absensi/operator/guru/tambah_jadwal_mengajar_guru" style=""><h1 id="xs" ><i class="icon-plus-sign" style="color:mediumseagreen;"></i> </h1></a>
                </div>
              </div>
            </div>
            <div id="myDiv" class="container-fluid">
              <hr>
              <form action="" method="GET">
                <div class="container">
                 <div class="row row-cols-auto">
                  <div class="col-1">Cari</div>
                  <div class="col">:</div>
                  <div class="col"><input  class="form-control" type="text" name="nama_guru" placeholder="Nama Guru"></div>
                </div>
                <br>
                <div class="row row-cols-auto">
                  <div class="col-1">TA</div>
                  <div class="col">:</div>
                  <div class="col">
                    <select name="ta" class="form-control" id="ta" style="width:200px;">
                      <option value="">Semester & Tahun Ajaran</option>
                      <?php 
                      $queryDataTa = mysqli_query($konek,"SELECT * FROM ta");
                      while ($dataTa = mysqli_fetch_array($queryDataTa)) {
                            # code...
                        echo "<option value='".$dataTa['id_ta']."'> Semester ".$dataTa['semester']." Tahun ".$dataTa['tahun_ajaran']."</option>";
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
            <div id="myDiv" class="container-fluid">
              <form action="" method="GET">
                <div class="container">
                 <div class="row row-cols-auto">
                 </div>
               </form>
             </div>
             <br>
             <?php
              if (isset($_GET['ta'])) {
                 # code...
                  if ($_GET['ta']!='') {
                    # code...
                    $queryDataTa = mysqli_query($konek,"SELECT * FROM ta WHERE id_ta=".$_GET['ta']);
                    while ($dataTa = mysqli_fetch_array($queryDataTa)) {
                      # code...

                      echo "<caption> Tahun Ajaran : ".$dataTa['tahun_ajaran']."</caption>";
                    }
                  }
               } 
              ?>
             <div class="row-fluid">
              <div class="span12">
                <div class="widget-box">
                  <div class="widget-title">
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" style="width:5%;background-color: #404040; color:white;border-radius: 10px 0 0 0 ;" rowspan="2">NO</th>
                        <th class="text-center" style="background-color: #404040; color:white;" rowspan="2">NAMA/NIP</th>
                        <th class="text-center" style="background-color: #404040; color:white;" rowspan="2">MATA PELAJARAN</th>
                        <th class="text-center" style="width:5%;background-color: #404040; color:white;" rowspan="2">KELAS</th>
                        <!-- <th class="text-center" style="background-color: #404040; color:white;">JURUSAN</th> -->
                        <th class="text-center" style="background-color: #404040; color:white; width: 10%;" colspan="2" rowspan="1">JUMLAH</th>
                        <th class="text-center" style="width: 10%;background-color: #404040; color:white;border-radius: 0 10px 0 0 ;" colspan="2" rowspan="2">OPTION</th>
                      </tr>
                      <tr>
                        <th>JAM</th>
                        <th>TOTAL</th>
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
                      if (isset($_GET['nama_guru'])) {
                          # code...

                          if ($_GET['nama_guru']!='') {
                            # code...
                            $queryDataGuru = mysqli_query($konek,"SELECT * FROM biodata_guru WHERE nama_guru like '%".$_GET['nama_guru']."%' limit $posisi,$batas");
                          }else{
                            $queryDataGuru = mysqli_query($konek,"SELECT * FROM biodata_guru limit $posisi,$batas");
                          }
                        }else{
                          $queryDataGuru = mysqli_query($konek,"SELECT * FROM biodata_guru limit $posisi,$batas");
                        }
                      while($dataGuru = mysqli_fetch_array($queryDataGuru)){
                        if($dataGuru['jabatan_guru'] != "admin"){
                          ?>

                          <?php
                          if (isset($_GET['ta'])) {
                              # code...
                              if ($_GET['ta']!='') {
                              # code...
                                $queryDataJamMengajar = mysqli_query($konek,"SELECT * FROM jadwal_mengajar WHERE guru=".$dataGuru['id_guru']." AND ta=".$_GET['ta']);
                              }else{
                                $queryDataJamMengajar = mysqli_query($konek,"SELECT * FROM jadwal_mengajar WHERE guru=".$dataGuru['id_guru']);
                              }
                            }else{
                              $queryDataJamMengajar = mysqli_query($konek,"SELECT * FROM jadwal_mengajar WHERE guru=".$dataGuru['id_guru']);
                            }
                          $arrayMapel = array();
                          $arrayjumlahJam = array();
                          $arrayKelas = array();
                          $arrayRuangan = array();
                          $arrayTa = array();
                          while($dataJamMengajar = mysqli_fetch_array($queryDataJamMengajar)){

                            $arrayMapel[$dataJamMengajar['mapel']."-".$dataJamMengajar['kelas']] = $dataJamMengajar['mapel'];
                            $arrayKelas[$dataJamMengajar['mapel']."-".$dataJamMengajar['kelas']] = $dataJamMengajar['kelas'];
                            // $arrayTa[$dataJamMengajar['mapel']."-".$dataJamMengajar['kelas']] = $dataJamMengajar['semester']." Tahun Ajaran ".$dataJamMengajar['tahun_ajaran'];
                          }
                          ?>
                          <tr>
                            <td class="text-center"><?php echo $no; ?></td>
                            <td class="text-center"><?php echo strtoupper($dataGuru['nama_guru']); ?> <br> NIP : <?php echo $dataGuru['nip_guru']; ?> </td>

                            <td class="text-center">
                              <?php
                              $arrm = array();
                              foreach($arrayMapel as $key=>$value)
                              {
                                $queryDataMapel = mysqli_query($konek,"SELECT * FROM mapel WHERE id_mapel=".$value);
                                while ($dataMapel = mysqli_fetch_array($queryDataMapel)) {
                                  // code...
                                  echo $dataMapel['nama_mapel']."<br>";
                                }
                                $arrm[] = $value;
                              }
                              ?>
                            </td>
                              <!-- <td class="text-center"> 
                                <?php
                                $arrk = array(); 
                                foreach($arrayTa as $key=>$value)
                                {
                                  echo $value."<br>";
                                  $arrk[] = $value;
                                }
                                ?></td> -->
                                <td class="text-center"> 
                                  <?php
                                  $arrk = array(); 
                                  foreach($arrayKelas as $key=>$value)
                                  {
                                    echo $value."<br>";
                                    $arrk[] = $value;
                                  }
                                  ?></td>
                                  <td class="text-center">
                                    <?php 
                                    $total = 0;
                                    for ($i=0; $i < sizeof($arrm); $i++) {
                                      $queryJumlahJamMengajar = mysqli_query($konek,"SELECT COUNT(*) AS JumlahJam FROM jadwal_mengajar WHERE guru=".$dataGuru['id_guru']." AND kelas='".$arrk[$i]."'"." AND mapel=".$arrm[$i]);
                                      if($queryJumlahJamMengajar != null){
                                        while($dataJumlahJam = mysqli_fetch_array($queryJumlahJamMengajar)){
                                          echo $dataJumlahJam['JumlahJam']."<br>";
                                          $total+=$dataJumlahJam['JumlahJam'];
                                        }
                                      }

                                    }

                                    ?>
                                  </td>

                                  <td  style="text-align: center;
                                  vertical-align: middle;;">
                                  <?php if ($total != 0) {
                                    echo $total;
                                  } ?>
                                </td>
                            <!-- <td class="text-center" style="width:5%;"><form action="" class="form-container" style="margin:10px" autocomplete="false">


                               <a href="editJamMengajar?jam_mengajar=<?PHP echo $dataJamMengajar['id_jam_mengajar']?>" class="btn" style=" border-color: white;border-radius: 5px; background-color: #999999;"><i class="icon-edit" style="color:white;"></i></a>
                             </form>
                           </td> -->
                           <td class="text-center" style="width:5%;"><form action="../prosses.php?hapus=jadwal_mengajar" method="post" class="form-container" style="margin:10px" autocomplete="false">


                            <input type="hidden" name="id_guru" value=<?php echo $dataGuru['id_guru']; ?>>
                            <button class="btn" type="submit" style=" border-color: white;border-radius: 5px; background-color: #ff3333;"><i class="icon-trash" style="color:white;"></i> </button>
                          </form></td>
                        </tr>

                        <?php
                        $no++;

                      }} ?> 

                    </tbody>
                  </table>
                  <?php
                  $query2 = mysqli_query($konek, "SELECT * FROM biodata_guru");
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
                          echo "<li class='page-item'><a class='page-link' href='jadwal_mengajar_guru.php?halaman=$i'>$i</a></li>";
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
<script >

</script>
<!--end-main-container-part-->
<?php include '../../layout/footer.php'; ?>
