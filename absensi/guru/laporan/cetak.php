<?php
include '../../db/koneksi.php';
include '../akses.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="http://localhost/smkn_1_pasaman/absensi/assets/css/bootstrap.min.css" /> 
  <link rel="stylesheet" href="http://localhost/smkn_1_pasaman/absensi/assets/css/bootstrap-responsive.min.css" /> 
  <link href="http://localhost/smkn_1_pasaman/absensi/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="shortcut icon" href="http://localhost/smkn_1_pasaman/absensi/assets/image/<?PHP echo $data['photo_sekolah']; ?>" />
  <link rel="stylesheet" href="http://localhost/smkn_1_pasaman/absensi/assets/css/custom/style.css">
</head>
<body style="    display: block;">
  <!-- HEADER -->
  <div class="row">
    <div class="text-center col-3" >
      <img src="http://localhost/smkn_1_pasaman/absensi/assets/image/logoProv.png" style="width:30%; margin-top: 25%;">  
    </div>
    <div class="text-center col-6" >
      <h4>PEMERINTAH PROVINSI SUMATERA BARAT</h4>
      <h2>DINAS PENDIDIKAN</h2>
      <h2>CABANG DINAS WILAYAH VI</h2>
      <h1>SMK NEGERI 1 PASAMAN</h1> 
      <h6>Jln. Pertanian Padang Tujuh Kec.Pasaman Kab.Pasaman Barat Kode Pos. 26366</h6>
    </div>
    <div class="text-center col-3" >
      <img src="http://localhost/smkn_1_pasaman/absensi/assets/image/logosmk.png" style="width:30%; margin-top: 25%;">  
    </div>
  </div>
  <hr style="border: 3px solid black;">
  <!-- CONTENT -->
  <?php if ($_GET['absensi'] == "harian") { ?>
    <br>
    <div class="row">
      <div class="text-center col" >
        <h3>DAFTAR ABSENSI SISWA</h3>
          <!-- <h3><?php $queryGetTa = mysqli_query($konek,"SELECT * FROM ta WHERE id_ta=".$_POST['ta']);
              while ($dataTa = mysqli_fetch_array($queryGetTa)) {
                # code...
                echo "SEMESTER ".$dataTa['semester']." TAHUN AJARAN ".$dataTa['tahun_ajaran'];
              }
              ?>
            </h3> -->
          </div>
        </div>
        <br>
        <table class="table table-bordered" style="width:100%;">
          <caption id="caption">Absensi Harian</caption>
          <thead>
            <tr>
              <th class="text-center thFixed"
              style="width:5%; border-radius: 10px 0 0 0 ;" rowspan="3">NO</th>
              <th class="text-center thFixed " rowspan="3" style="min-width:300px;" >NAMA/NIS  </th>
              <th class="text-center thFixed " rowspan="3" style="width:10px;" >L/P</th>
              <th class="text-center thFixed " rowspan="1" colspan="10" >HARI</th>

              <th class="text-center thFixed" rowspan="2" colspan="5" style="">TOTAL</th>
              <th class="text-center thFixed " rowspan="3" style="min-width:100px;border-radius: 0 10px 0 0;">KETERANGAN</th>

            </tr>
            <tr>
              <th  colspan="10" class="text-center thFixed">Senin</th>

              <!-- <th style="width:100%;" class="text-center thFixed">Minggu</th> -->
            </tr>
            <tr>

              <?php 
              $loop_jam = 1;
              for ($loop_jam; $loop_jam<2; $loop_jam++) { 
               for ($i=1; $i <= 10; $i++) { 
                ?>
                <th class="text-center" style="width: 5%;"><?php echo $i; ?></th>

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
          $no = 1;
          if (isset($_POST['get_ruangan'])) {
            // code...

            $query = "SELECT * FROM biodata_siswa WHERE ruangan_siswa = '$_POST[get_ruangan]' AND jurusan_siswa = '$_POST[get_jurusan]';";
            $query_tampilSiswa = mysqli_query($konek, $query);
            if(mysqli_num_rows($query_tampilSiswa) > 0){
              foreach($query_tampilSiswa as $items){
                ?>
                <tr>
                  <td class='text-center'><?php echo "".$no++; ?> </td>
                  <td><?php echo strtoupper($items['nama_siswa']);?></td>
                  <td class='text-center'><?php echo strtoupper($items['jenis_kelamin_siswa']);?></td>
                  <?php $lop=10;
                  $hadir=0;
                  $alfa=0;
                  $cabut=0;
                  $izin=0;
                  $sakit=0;
                  for ($i=1; $i <= $lop; $i++) { 
                                      // code...
                    $queryDataAbsensiSiswa = mysqli_query($konek,"SELECT * FROM absensi_siswa WHERE siswa=".$items['id_siswa']." AND ruangan=".$_POST['get_ruangan']." AND jurusan=".$_POST['get_jurusan']." AND jam_absensi=".$i." AND tgl_absensi='".$_POST['get_tgl']."'");

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
              }}}
              ?>

            </tbody>
          </table>
        </div>

      <?php } else if ($_GET['absensi'] == "Mingguan"){ ?>
        <br>
        <div class="row">
          <div class="text-center col" >
            <h3>DAFTAR ABSENSI SISWA</h3>
            <h3><?php $queryGetTa = mysqli_query($konek,"SELECT * FROM ta WHERE id_ta=".$_POST['ta']);
            while ($dataTa = mysqli_fetch_array($queryGetTa)) {
                # code...
              echo "SEMESTER ".$dataTa['semester']." TAHUN AJARAN ".$dataTa['tahun_ajaran'];
            }
            ?>
          </h3>
        </div>
      </div>
      <br>
      <h6>KELAS :
        <?php 
        $queryDataRuangan = mysqli_query($konek,"SELECT * FROM ruangan WHERE id_ruangan=".$_POST['get_ruangan']);
        while($dataRuangan = mysqli_fetch_array($queryDataRuangan)){
          echo $dataRuangan['kelas']."-".$dataRuangan['nama_ruangan'];
        }
        ?> 
      </h6>
      <table class="table table-bordered" style="width:100%;">
        <caption id="caption">Absensi Mingguan</caption>
        <thead>
          <tr>
            <th class="text-center thFixed"
            style="width:5%; border-radius: 10px 0 0 0 ;" rowspan="3">NO</th>
            <th class="text-center thFixed " rowspan="3" style="min-width:300px;" >NAMA/NIS  </th>
            <th class="text-center thFixed " rowspan="1" colspan="60" >BULAN<br>MINGGU/HARI</th>
            <th class="text-center thFixed" rowspan="2" colspan="5" >TOTAL</th>
            <th class="text-center thFixed " rowspan="3" style="min-width:100px;border-radius: 0 10px 0 0;">Keterangan</th>
          </tr>
          <tr>
            <th  colspan="10" class="text-center thFixed">Senin</th>
            <th  colspan="10" class="text-center thFixed">Selasa</th>
            <th  colspan="10" class="text-center thFixed">Rabu</th>
            <th  colspan="10" class="text-center thFixed">Kamis</th>
            <th  colspan="10" class="text-center thFixed">Jum'at</th>
            <th  colspan="10" class="text-center thFixed">Sabtu</th>
            <!-- <th style="width:100%;" class="text-center thFixed">Minggu</th> -->
          </tr>
          <tr>

            <?php 
            $loop_jam = 1;
            for ($loop_jam; $loop_jam<7; $loop_jam++) { 
             for ($i=1; $i <= 10; $i++) { 
              ?>
              <th style="width: 2%;"><?php echo $i; ?></th>

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

        if(isset($_POST['get_ruangan']) && isset($_POST['get_jurusan']) && isset($_POST['tgl_absen1']) && isset($_POST['ta'])){

          $get_ruangan = $_POST['get_ruangan'];
          $get_jurusan = $_POST['get_jurusan'];
          $tgl_absen = array($_POST['tgl_absen1'],$_POST['tgl_absen2']) ;
          // echo $tgl_absen;
          $mingguke = $_POST['mingguke'];
          $date_start = strtotime($tgl_absen[0]."-".$tgl_absen[1]."-"."01");
          $month_start = date('l',strtotime($tgl_absen[0]."-".$tgl_absen[1]."-"."01"));
          if ($month_start == 'Sunday') {
                            // code...
            $day_start = strtotime("-6 day", $date_start);
          }else if($month_start == 'Saturday'){
            $day_start = strtotime("-5 day", $date_start);
          }else if($month_start == 'Friday'){
            $day_start = strtotime("-4 day", $date_start);
          }else if($month_start == 'Thursday'){
            $day_start = strtotime("-3 day", $date_start);
          }else if($month_start == 'Wednesday'){
            $day_start = strtotime("-2 day", $date_start);
          }else if($month_start == 'Tuesday'){
            $day_start = strtotime("-2 day", $date_start);
          }else{
            $day_start = $date_start;
          }


          $date_end = strtotime($tgl_absen[0]."-".$tgl_absen[1]."-".date('t',strtotime( $tgl_absen[0]."-".$tgl_absen[1]."-"."01")));
          $month_end = date('l',$date_end);

          if ($month_end == 'Sunday') {
                            // code...
            $day_end = strtotime("+1 day", $date_end);
          }else if($month_end == 'Saturday'){
            $day_end = strtotime("+2 day", $date_end);
          }else if($month_end == 'Friday'){
            $day_end = strtotime("+3 day", $date_end);
          }else if($month_end == 'Thursday'){
            $day_end = strtotime("+4 day", $date_end);
          }else if($month_end == 'Wednesday'){
            $day_end = strtotime("+5 day", $date_end);
          }else if($month_end == 'Tuesday'){
            $day_end = strtotime("+6 day", $date_end);
          }else{
            $day_end = $date_end;
          }

          $tgl_mulai = date('l',strtotime(date('Y-m-d', $day_start)))." ".date('Y-m-d', $day_start);
          $tgl_berakhir = date('l',strtotime(date('Y-m-d', $day_end)))." ".date('Y-m-d', $day_end);



          if ($mingguke == 1) {

                            // code...

            $tgl_absensi_mulai = date('Y-m-d', $day_start);
            $tgl_absensi_berakhir = date('Y-m-d',strtotime("+5 day", $day_start));
          }else if ($mingguke == 2) {

                            // code...

            $tgl_absensi_mulai = date('Y-m-d', strtotime("+7 day", $day_start));
            $tgl_absensi_berakhir = date('Y-m-d',strtotime("+12 day", $day_start));
          }
          else if ($mingguke == 3) {

                            // code...

            $tgl_absensi_mulai = date('Y-m-d', strtotime("+14 day", $day_start));
            $tgl_absensi_berakhir = date('Y-m-d',strtotime("+19 day", $day_start));
          }
          else if ($mingguke == 4) {

                            // code...

            $tgl_absensi_mulai = date('Y-m-d', strtotime("+21 day", $day_start));
            $tgl_absensi_berakhir = date('Y-m-d',strtotime("+26 day", $day_start));
          }
          else if ($mingguke == 5) {
                            // code...

            $tgl_absensi_mulai = date('Y-m-d', strtotime("+28 day", $day_start));
            $tgl_absensi_berakhir = date('Y-m-d',strtotime("+33 day", $day_start));
          }else if ($mingguke == 6) {
                            // code...

            $tgl_absensi_mulai = date('Y-m-d', strtotime("+35 day", $day_start));
            $tgl_absensi_berakhir = date('Y-m-d',strtotime("+40 day", $day_start));
          }
          $query = "SELECT * FROM biodata_siswa WHERE ruangan_siswa = '$get_ruangan' AND jurusan_siswa = '$get_jurusan';";
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
                $test=6;
                $begin = new DateTime( $tgl_absensi_mulai );
                $end = new DateTime( $tgl_absensi_berakhir );
                $end = $end->modify( '+1 day' ); 

                $interval = new DateInterval('P1D');
                $daterange = new DatePeriod($begin, $interval ,$end);
                foreach($daterange as $date1){
                  $tglDimulai = $date1->format("Y-m-d");
                  for ($i=1; $i <= $lop; $i++) {
                                  // echo "<td>".$tglDimulai."</td>";
                   $queryDataAbsensi = mysqli_query($konek,"SELECT * FROM absensi_siswa  WHERE siswa=".$items['id_siswa']." AND ruangan=".$get_ruangan." AND jurusan=".$get_jurusan." AND jam_absensi=".$i." AND tgl_absensi='".$tglDimulai."'");
                   if(mysqli_num_rows($queryDataAbsensi) > 0){
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


                }
              }
              echo "<td>".$hadir."</td>";
              echo "<td>".$izin."</td>";
              echo "<td>".$sakit."</td>";
              echo "<td>".$alfa."</td>";
              echo "<td>".$cabut."</td>";
              ?>
            </tr>
            <?php 
            $no++;}
          }
        }
        ?>
      </tbody>
    </table>
  <?php } else if ($_GET['absensi'] == "Bulanan") { ?>
    <br>
    <div class="row">
      <div class="text-center col" >
        <h3>DAFTAR ABSENSI SISWA</h3>
        <h3><?php $queryGetTa = mysqli_query($konek,"SELECT * FROM ta WHERE id_ta=".$_POST['ta']);
        while ($dataTa = mysqli_fetch_array($queryGetTa)) {
                # code...
          echo "SEMESTER ".$dataTa['semester']." TAHUN AJARAN ".$dataTa['tahun_ajaran'];
        }
        ?>
      </h3>
    </div>
  </div>
  <br>
  <h6>KELAS :
    <?php 
    $queryDataRuangan = mysqli_query($konek,"SELECT * FROM ruangan WHERE id_ruangan=".$_POST['get_ruangan']);
    while($dataRuangan = mysqli_fetch_array($queryDataRuangan)){
      echo $dataRuangan['kelas']."-".$dataRuangan['nama_ruangan'];
    }
    ?> 
  </h6>
  <table class="table table-bordered" style="width:100%;">
    <caption id="caption">Absensi Bulanan</caption>
    <thead>
      <tr>
        <th class="text-center thFixed"
        style="width:5%; border-radius: 10px 0 0 0 ;" rowspan="3">No</th>
        <th class="text-center thFixed " rowspan="2" style="min-width:300px;" >Nama/Nis  </th>
        <th class="text-center thFixed " rowspan="1" colspan="31" >Bulanan</th>
        <th class="text-center thFixed" rowspan="1" colspan="5" >Total</th>
        <th class="text-center thFixed " rowspan="2" style="min-width:300px;border-radius: 0 10px 0 0;">Keterangan</th>

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
      if(isset($_POST['get_ruangan']) && isset($_POST['get_jurusan']) ){

        $get_ruangan = $_POST['get_ruangan'];
        $get_jurusan = $_POST['get_jurusan'];
        $tgl_absen = array($_POST['tgl_absen1'],$_POST['tgl_absen2']) ;
        $date_start = strtotime($tgl_absen[0]."-".$tgl_absen[1]."-"."01");
        $date_end = strtotime('last day of this month', $date_start);
        $tgl_absensi_mulai = date('Y-m-d',$date_start);
        $tgl_absensi_berakhir = date('Y-m-d',$date_end);
        $query = "SELECT * FROM biodata_siswa WHERE ruangan_siswa = '$get_ruangan' AND jurusan_siswa = '$get_jurusan';";
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
            $begin = new DateTime( $tgl_absensi_mulai );
            $end = new DateTime( $tgl_absensi_berakhir );
            $end = $end->modify( '+1 day' ); 

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);
            foreach($daterange as $date1){
              $tglDimulai = $date1->format("Y-m-d");

              $queryDataAbsensi = mysqli_query($konek,"SELECT * FROM absensi_siswa  WHERE siswa=".$items['id_siswa']." AND ruangan=".$get_ruangan." AND jurusan=".$get_jurusan." AND jam_absensi=".$i." AND tgl_absensi='".$tglDimulai."'");
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
<?php
}else if ($_GET['absensi'] == "pertemuan") { ?>
  <br>
  <div class="row">
    <div class="text-center col" >
      <h3>DAFTAR ABSENSI SISWA</h3>
      <h3><?php $queryGetTa = mysqli_query($konek,"SELECT * FROM ta WHERE id_ta=".$_POST['ta']);
      while ($dataTa = mysqli_fetch_array($queryGetTa)) {
                # code...
        echo "SEMESTER ".$dataTa['semester']." TAHUN AJARAN ".$dataTa['tahun_ajaran'];
      }
      ?>
    </h3>
  </div>
</div>
<br>
<div  style="width: 100%;">
  <div class="row">
    <div class="col" style="width: 50%; margin-left: 10px;">
      <h6>KELAS :
        <?php 
        $queryDataRuangan = mysqli_query($konek,"SELECT * FROM ruangan WHERE id_ruangan=".$_POST['get_ruangan']);
        while($dataRuangan = mysqli_fetch_array($queryDataRuangan)){
          echo $dataRuangan['kelas']."-".$dataRuangan['nama_ruangan'];
        }
        ?> 
      </h6>
    </div>
    <div style="width: 50%; margin-right: 10px; text-align: right;">
      <h6>MATA PELAJARAN :
        <?php 
        $queryDataJadwal = mysqli_query($konek,"SELECT * FROM jadwal_mengajar JOIN mapel ON jadwal_mengajar.mapel = mapel.id_mapel WHERE ruangan=".$_POST['get_ruangan']." AND guru=".$_SESSION['id_user']);
        while($dataJadwal = mysqli_fetch_array($queryDataJadwal)){
          echo strtoupper($dataJadwal['nama_mapel']);
        }
        ?> 
      </h6>
    </div>
  </div>
</div>

<table class="table table-bordered" style="width:100%;">
 <caption id="caption"><?php 
 if (isset($_POST['ta'])) {
  $queryDataTA = mysqli_query($konek, "SELECT * FROM ta WHERE id_ta=".$_POST['ta']);
  while($dataTa = mysqli_fetch_array($queryDataTA)){
    echo "<h6><i>Semester ".$dataTa['semester']." Tahun Ajaran ".$dataTa['tahun_ajaran']."</i></h6>"; } 
  } ?>        
</caption>
<thead>
  <tr>
    <th class="text-center thFixed"
    style="width:5%; border-radius: 10px 0 0 0 ;" rowspan="3">NO</th>
    <th class="text-center thFixed " rowspan="2" style="min-width:300px;" >NAMA  </th>
    <th class="text-center thFixed " rowspan="1" colspan="25" >PERTEMUAN</th>
    <th class="text-center thFixed" rowspan="1" colspan="5" >TOTAL</th>
    <th class="text-center thFixed " rowspan="2" style="min-width:300px;border-radius: 0 10px 0 0;">KETERANGAN</th>
  </tr>
  <tr>
    <?php 
    $loop_jam = 1;
    for ($loop_jam; $loop_jam<26; $loop_jam++) { 
                                 // for ($i=1; $i <= 10; $i++) { 
      ?>
      <th style="width: 2%;"><?php echo $loop_jam; ?></th>
      <?php
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

  if(isset($_POST['get_ruangan']) && isset($_POST['get_jurusan']) && isset($_POST['ta']) ){
    
    $get_ruangan = $_POST['get_ruangan'];
    $get_jurusan = $_POST['get_jurusan'];
    $get_ta = $_POST['ta'];
    ?>
    <?php
    $query = "SELECT * FROM biodata_siswa WHERE ruangan_siswa = '$get_ruangan' AND jurusan_siswa = '$get_jurusan';";
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
        $checkTgl='';
        $i=1;
        $daterange=1;
        $checkJumlahTGL = 1;
        $queryDataAbsensi = mysqli_query($konek,"SELECT * FROM absensi_siswa  WHERE siswa=".$items['id_siswa']." AND ruangan=".$get_ruangan." AND jurusan=".$get_jurusan." AND guru=".$_SESSION['id_user']." AND ta=".$get_ta);
        if(mysqli_num_rows($queryDataAbsensi) > 0){

                                      # code...
          while($dataAbsenSiswa = mysqli_fetch_array($queryDataAbsensi)){

            if ($checkTgl != $dataAbsenSiswa['tgl_absensi']) {
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
              $checkTgl = $dataAbsenSiswa['tgl_absensi'];
            }
          }
          $i++;
        }
        if ($i!= 25) {
                                      # code...
          for ($i; $i<25 ; $i++) { 
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

<?php
} ?>

<br>
<!-- FOOTER -->
<div class="row">
  <div class="col-4" >
    <div class="col" style="margin-left:10%;"><h6>Diketahui,</h6></div>
    <div class="col" style="margin-left:10%;"><h6>Kepala Sekolah</h6></div>
    <div class="col" style="margin-left:10%;"><br><br><br></div>
    <div class="col" style="margin-left:10%;"><h6><b><u>Edi Supanri, S.Pd, M.Pd, T</u></b></h6></div>
    <div class="col" style="margin-left:10%;"><h6>NIP. 19770705 200801 1 006</h6></div> 
  </div>
  <div class="text-center col-4" >
    <div class="col" style="margin-left:10%;"><h6>Diketahui,</h6></div>
    <div class="col" style="margin-left:10%;"><h6>Wakil Kurikulum</h6></div>
    <div class="col" style="margin-left:10%;"><br><br><br></div>
    <div class="col" style="margin-left:10%;"><h6><b><u>Desi Novita, S.Pd</u></b></h6></div>
    <div class="col" style="margin-left:10%;"><h6>NIP. 19811121 201101 1 006</h6></div>
  </div>
  <div class="col-4" >
    <div class="col" style="margin-left:50%;"><h6>Padang Tujuh, <?php echo date('d-m-Y'); ?></h6></div>
    
    <?php 
    if ($_GET['absensi'] == "pertemuan") { ?>
      <div class="col" style="margin-left:50%;"><h6>GURU MATA PELAJARAN</h6></div>
      <div class="col" style="margin-left:50%;"><br><br></div>.
      <?php
      if (isset($_POST['get_ruangan'])) {
          // code...
        $queryDataGuru = mysqli_query($konek,"SELECT * FROM biodata_guru WHERE id_guru=".$_SESSION['id_user']);
        while($dataGuru = mysqli_fetch_array($queryDataGuru)){?>
          <div class="col" style="margin-left:50%;"><h6><b><u> <?php echo strtoupper($dataGuru['nama_guru']); ?></u></b></h6></div>
          <div class="col" style="margin-left:50%;"><h6>NIP. <?php echo $dataGuru['nip_guru']; ?></h6></div>
          <?php
        } 
      }else{ ?>
        <div class="col" style="margin-left:50%;"><h6><b><u></u></b></h6></div>
        <div class="col" style="margin-left:50%;"><h6>NIP. </h6></div>
        <?php 
      }
      ?>
    <?php }else{ ?>
      <div class="col" style="margin-left:50%;"><h6>Wali Kelas</h6></div>
      <div class="col" style="margin-left:50%;"><br><br></div>
      <?php
      if (isset($_POST['get_ruangan'])) {
          // code...
        $queryGetWaliKelas = mysqli_query($konek,"SELECT * FROM ruangan JOIN biodata_guru ON ruangan.guru = biodata_guru.id_guru WHERE id_ruangan=".$_POST['get_ruangan']);
        while($dataWaliKelas = mysqli_fetch_array($queryGetWaliKelas)){?>
          <div class="col" style="margin-left:50%;"><h6><b><u> <?php echo strtoupper($dataWaliKelas['nama_guru']); ?></u></b></h6></div>
          <div class="col" style="margin-left:50%;"><h6>NIP. <?php echo $dataWaliKelas['nip_guru']; ?></h6></div>
          <?php
        } 
      }else{ ?>
        <div class="col" style="margin-left:50%;"><h6><b><u></u></b></h6></div>
        <div class="col" style="margin-left:50%;"><h6>NIP. </h6></div>
        <?php 
      } 
    }
    ?>

  </div>
</div>
</body>
</html>
