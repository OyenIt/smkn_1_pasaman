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

            <h2><i class="icon-calendar"></i> JURUSAN </h2>
            <hr>
            <div>
              <div id="myDiv" class="container-fluid">
                <form action="../prosses.php?tipe=jurusan" method="post" class="form-container" style="margin:10px" autocomplete="false">
                <div style="width: 100%; text-align: center;">
                  <h1>Tambahkan Jurusan</h1></div>
                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nama Jurusan</label>
                    :
                    <div class="col-sm-8">
                      <input type="text" class="form-control"  placeholder="Nama Jurusan" name="jurusan">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Kosentrasi</label>
                    :
                    <div class="col-sm-8">
                      <input type="text" class="form-control"  placeholder="Kosentrasi" name="kosentrasi" 
                      >
                    </div>
                  </div>
                  <div class="row mb-3">

                    <div class="col-sm-10 offset-sm-2">
                      <input type="batal" value="Kembali" name="batal" onclick="closeForm('jurusan')" style="width:25%; background: #ff3333;" />
                      <input type="submit" value="Simpan" name="simpan"style="width:25%;" />
                    </div>
                  </div>
                </form>
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

</div>
