<?php
include "../../db/koneksi.php";
include "../akses.php";
include "../../layout/header.php"
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
                  <h2 id="xs" ><i class="icon-calendar"></i> GURU </h2>
                </div>
                <div class="col-lg-2" style="text-align: right;margin-right: 5%;">
                  <a href="http://localhost/smkn_1_pasaman/absensi/operator/guru/tambah_identitas_guru" style=""><h1 id="xs" ><i class="icon-plus-sign" style="color:mediumseagreen;"></i> </h1></a>
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
                     <table class="table table-bordered" >
                      <thead>
                        <tr>
                          <th class="text-center" style="width:5%;background-color: #404040; color:white;border-radius: 10px 0 0 0 ;">NO</th>
                          <th class="text-center" style="background-color: #404040; color:white;">NAMA/NIP</th>
                          <th class="text-center" style="width:5%;background-color: #404040; color:white;">L/P</th>
                          <th class="text-center" style="background-color: #404040; color:white;">TGL LAHIR</th>
                          <th class="text-center"style="background-color: #404040; color:white;">ALAMAT</th>
                          <th class="text-center"style="background-color: #404040; color:white;">STATUS</th>
                          <!-- <th class="text-center"style="background-color: #404040; color:white;">JABATAN</th> -->
                          <th class="text-center"style="background-color: #404040; color:white;">TELEPON</th>
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
                          if($dataGuru['status_guru']!= "admin"){
                            ?>
                            <tr>
                              <td class="text-center"><?php echo $no; ?></td>
                              <td class="text-center"><?php echo strtoupper($dataGuru['nama_guru']); ?><br> NIP : <?php echo $dataGuru['nip_guru']; ?> </td>
                              <td class="text-center" style="widtd:5%;"><?php echo $dataGuru['jenis_kelamin_guru']; ?></td>
                              <td class="text-center"><?php echo $dataGuru['tgl_lahir_guru']; ?></td>
                              <td class="text-center"><?php echo $dataGuru['alamat_guru']; ?></td>
                              <td class="text-center"><?php echo $dataGuru['status_guru']; ?></td>
                              <!-- <td class="text-center"><?php echo $dataGuru['jabatan_guru']; ?></td> -->
                              <td class="text-center"><?php echo $dataGuru['telepon_guru']; ?></td>
                              <td class="text-center" style="width:5%;"><form action="" class="form-container" style="margin:10px" autocomplete="false">
                               <a href="edit_identitas_guru?id_guru=<?PHP echo $dataGuru['id_guru']?>" class="btn" style=" border-color: white;border-radius: 5px; background-color: #999999;"><i class="icon-edit" style="color:white;"></i></a>
                             </form>
                           </td>
                           <td class="text-center" style="width:5%;"><form action="../prosses.php?hapus=guru" method="post" class="form-container" style="margin:10px" autocomplete="false">


                            <input type="hidden" name="id_guru" value=<?php echo $dataGuru['id_guru']; ?>>
                            <button class="btn" type="submit" style=" border-color: white;border-radius: 5px; background-color: #ff3333;"><i class="icon-trash" style="color:white;"></i> </button>
                          </form></td>
                        </tr>
                        <?php $no++;}}
                        
                        ?>
                      </tbody>
                    </table>
                    <?php
                    $query2 = mysqli_query($konek, "SELECT * FROM biodata_guru");
                    $jumlahdata = mysqli_num_rows($query2);
                    $jumlahhalaman = ceil($jumlahdata/$batas);
                    ?>
                    <nav>
                      <ul class="pagination justify-content-center">
                        <?php
                        for($i=1;$i<=$jumlahhalaman;$i++) {
                          if ($i != $halaman) {
                            echo "<li class='page-item'><a class='page-link' href='identitas_guru.php?halaman=$i'>$i</a></li>";
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
<script src="../../assets/js/custom/custom.js"></script>
<?php include '../../layout/footer.php'; ?>
</div>
