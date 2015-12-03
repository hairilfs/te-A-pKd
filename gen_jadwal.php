<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Jadwal
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Jadwal</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <script type="text/javascript">
    function alertnya(evt) {
      evt.preventDefault();
      swal("Oops...!", "Shift minimal dan maksimal belum tepat", "warning");
      return false;
    }

    function batasShift() {
      var min_p1 = document.getElementById("minp1").value;
      var max_p1 = document.getElementById("maxp1").value;
      var min_s1 = document.getElementById("mins1").value;
      var max_s1 = document.getElementById("maxs1").value;
      var min_m1 = document.getElementById("minm1").value;
      var max_m1 = document.getElementById("maxm1").value;
      var min_pc = document.getElementById("minpc").value;
      var max_pc = document.getElementById("maxpc").value;
      var min_sc = document.getElementById("minsc").value;
      var max_sc = document.getElementById("maxsc").value;
      var min_p2 = document.getElementById("minp2").value;
      var max_p2 = document.getElementById("maxp2").value;
      var min_s2 = document.getElementById("mins2").value;
      var max_s2 = document.getElementById("maxs2").value;
      var min_m2 = document.getElementById("minm2").value;
      var max_m2 = document.getElementById("maxm2").value;
      var min_pp = document.getElementById("minpp").value;
      var max_pp = document.getElementById("maxpp").value;
      var min_sp = document.getElementById("minsp").value;
      var max_sp = document.getElementById("maxsp").value;

      if(min_p1 > max_p1 || max_p1 < min_p1) {
        alertnya();
      } else if(min_s1 > max_s1 || max_s1 < min_s1) {
        alertnya();
      } else if(min_m1 > max_m1 || max_m1 < min_m1) {
        alertnya();
      } else if(min_pc > max_pc || max_pc < min_pc) {
        alertnya();
      } else if(min_sc > max_sc || max_sc < min_sc) {
        alertnya();
      } else if(min_p2 > max_p2 || max_p2 < min_p2) {
        alertnya();
      } else if(min_s2 > max_s2 || max_s2 < min_s2) {
        alertnya();
      } else if(min_m2 > max_m2 || max_m2 < min_m2) {
        alertnya();
      } else if(min_pp > max_pp || max_pp < min_pp) {
        alertnya();
      } else if(min_sp > max_sp || max_sp < min_sp) {
        alertnya();    
      }
    }
    </script>
    <div class="modal fade" id="addJadwal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Buat Jadwal Baru</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form id="newjad" method="post" action="main.php?page=5">
              <div class="box-body" id="bloading">
                <div class="row">
                  <div class="col-md-4">
                    <table class="table cent table-condensed borderless">
                      <tr>
                        <td align="center"><label>Bulan</label></td>
                        <td>
                          <select class="form-control" name="selbulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-4">
                    <table class="table cent table-condensed borderless">
                      <tr>
                        <td align="center"><label>Tahun</label></td>
                        <td>
                          <select class="form-control" name="seltahun">
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-4">
                    <table class="table cent table-condensed borderless">
                      <tr>
                        <td align="center"><label>Pola</label></td>
                        <td>
                          <select class="form-control" name="selpola">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table cent table-condensed table-bordered">
                      <tr>
                        <th>Shift</th>
                        <th>Min.</th>
                        <th>Maks.</th>
                      </tr>
                      <tr>
                        <td><b>P1</b></td>
                        <td><input class="form-control" type="number" id="minp1" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxp1" name="max[]" min="1" value="2"></td>
                      </tr>
                      <tr>
                        <td><b>S1</b></td>
                        <td><input class="form-control" type="number" id="mins1" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxs1" name="max[]" min="1" value="2"></td>
                      </tr>
                      <tr>
                        <td><b>M1</b></td>
                        <td><input class="form-control" type="number" id="minm1" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxm1" name="max[]" min="1" value="1"></td>
                      </tr>
                      <tr>
                        <td><b>PC</b></td>
                        <td><input class="form-control" type="number" id="minpc" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxpc" name="max[]" min="1" value="1"></td>
                      </tr>
                      <tr>
                        <td><b>SC</b></td>
                        <td><input class="form-control" type="number" id="minsc" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxsc" name="max[]" min="1" value="1"></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table cent table-condensed table-bordered">
                      <tr>
                        <th>Shift</th>
                        <th>Min.</th>
                        <th>Maks.</th>
                      </tr>
                      <tr>
                        <td><b>P2</b></td>
                        <td><input class="form-control" type="number" id="minp2" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxp2" name="max[]" min="1" value="2"></td>
                      </tr>
                      <tr>
                        <td><b>S2</b></td>
                        <td><input class="form-control" type="number" id="mins2" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxs2" name="max[]" min="1" value="2"></td>
                      </tr>
                      <tr>
                        <td><b>M2</b></td>
                        <td><input class="form-control" type="number" id="minm2" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxm2" name="max[]" min="1" value="1"></td>
                      </tr>
                      <tr>
                        <td><b>PP</b></td>
                        <td><input class="form-control" type="number" id="minpp" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxpp" name="max[]" min="1" value="3"></td>
                      </tr>
                      <tr>
                        <td><b>SP</b></td>
                        <td><input class="form-control" type="number" id="minsp" name="min[]" min="1" value="1"></td>
                        <td><input class="form-control" type="number" id="maxsp" name="max[]" min="1" value="2"></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- <hr> -->
              </div><!-- /.box-body -->
              <div class="box-footer" >
                <button type="button" class="btn btn-default" id="stopspin" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary pull-right" id="loadspin" name="genjad">Buat baru!</button>
              </div><!-- /.box-footer -->
            </form>
          </div><!-- /.box -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addJadwal"><i class="fa fa-calendar"></i> Buat Jadwal</button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="table-data" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID Jadwal</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Dibuat Oleh</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  include_once 'class_konversi.php';
                  $seem = new Konversi();
                  $res = $mysqli->query("SELECT * FROM jadwal");
                  while ($row = $res->fetch_object()) { ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->id_jadwal; ?></td>
                    <td><?= $seem->cetak_bulan($row->bln); ?></td>
                    <td><?= $row->thn; ?></td>
                    <td><?= $seem->nama_admin($row->id_admin); ?></td>
                    <td>
                      <?php
                      echo "<a href='detil_jadwal.php?idjdw=$row->id_jadwal' target='_blank'><button type='button' class='btn btn-primary'>Cetak</button></a> ";
                      echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deljdw$row->id_jadwal'>Hapus</button>";
                      ?>
                    </td>
                  </tr>

                  <div class="modal fade" id="deljdw<?= $row->id_jadwal; ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Hapus Jadwal</h4>
                        </div>
                        <div class="modal-body">
                          <p>Yakin akan menghapus jadwal bulan <?= $seem->cetak_bulan($row->bln)." ".$row->thn; ?>?</p>
                        </div>
                        <div class="modal-footer">
                          <form action="main.php?page=1" method="post">
                            <input type="hidden" name="idapus" value="<?= $row->id_jadwal; ?>">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Lain kali</button>&nbsp;
                            <button type="submit" class="btn btn-danger" name="apusjdw">Ya, hapus</button>
                          </form>
                        </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  <?php $no++; }
                  ?>
                </tbody>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php 
if (isset($_POST['apusjdw'])) {
  $sqlapusjad = $mysqli->query("DELETE FROM jadwal WHERE id_jadwal='$_POST[idapus]'");
  $sqlapusdtljad = $mysqli->query("DELETE FROM detil_jadwal WHERE id_jadwal='$_POST[idapus]'");
  if ($sqlapusjad && $sqlapusdtljad) {
    echo "<script>swal('Sukses!', 'Jadwal berhasil dihapus.', 'success');</script>";
  }
}
?>