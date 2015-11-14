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
  <div class="center-block">
    <section class="content">
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
                              <option value="">- Pilih Bulan -</option>
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
                              <option value="">- Pilih Tahun -</option>
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
                              <option value="">- Pilih Pola -</option>
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
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="2"></td>
                        </tr>
                        <tr>
                          <td><b>S1</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="2"></td>
                        </tr>
                        <tr>
                          <td><b>M1</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="1"></td>
                        </tr>
                        <tr>
                          <td><b>PC</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="1"></td>
                        </tr>
                        <tr>
                          <td><b>SC</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="1"></td>
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
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="2"></td>
                        </tr>
                        <tr>
                          <td><b>S2</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="2"></td>
                        </tr>
                        <tr>
                          <td><b>M2</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="1"></td>
                        </tr>
                        <tr>
                          <td><b>PP</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="3"></td>
                        </tr>
                        <tr>
                          <td><b>SP</b></td>
                          <td><input class="form-control" type="number" name="min[]" min="1" value="1"></td>
                          <td><input class="form-control" type="number" name="max[]" min="1" value="2"></td>
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
  </div>
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