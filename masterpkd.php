<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Master PKD</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Master PKD</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="modal fade" id="addPKD">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah PKD</h4>
          </div>
          <form class="form-horizontal" action="model.php" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">NIK</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nik" placeholder="NIK" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-10">
                  <div class="radio-inline">
                    <input type="radio" name="optjab" value="DANRU">Danru
                  </div>
                  <div class="radio-inline">
                    <input type="radio" name="optjab" value="ANGGOTA" checked>Anggota
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <div class="radio-inline">
                    <input type="radio" name="optstat" value="Aktif">Aktif
                  </div>
                  <div class="radio-inline">
                    <input type="radio" name="optstat" value="Non-aktif" checked>Non-aktif
                  </div>
                </div>
              </div>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" name="savepkd">Simpan</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPKD"><i class="fa fa-users"></i> Tambah PKD</button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="table-data" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $res = $mysqli->query("SELECT * FROM pkd");
                  while ($row = $res->fetch_object()) { ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row->nik; ?></td>
                      <td><?php echo $row->nama; ?></td>
                      <td><?php echo $row->jabatan; ?></td>
                      <?php
                      if($row->status=="Aktif") echo "<td class='bg-success'>".$row->status." <i class='fa fa-check'></i></td>";
                      else echo "<td class='bg-danger'>".$row->status." <i class='fa fa-close'></i></td>";
                      ?>
                      <td>
                        <?php
                        echo "<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editpkd$row->id'>Ubah</button> &nbsp;";
                        echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#delpkd$row->id'>Hapus</button>";
                        ?>
                      </td>
                    </tr>

                    <div class="modal fade" id="editpkd<?php echo $row->id; ?>">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Ubah PKD</h4>
                          </div>
                          <form action="model.php" method="post">
                            <div class="modal-body">
                              <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                              <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" name="nik" value="<?php echo $row->nik; ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $row->nama; ?>" required>
                              </div>
                              <label>Jabatan</label>
                              <div class="form-group">
                                <label class="radio-inline">
                                  <input type="radio" name="optjab" value="DANRU" <?php if($row->jabatan=="DANRU") echo "checked";?>>Danru
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optjab" value="ANGGOTA" <?php if($row->jabatan=="ANGGOTA") echo "checked";?>>Anggota
                                </label>
                              </div>
                              <label>Status</label>
                              <div class="form-group">
                                <label class="radio-inline">
                                  <input type="radio" name="optstat" value="Aktif" <?php if($row->status=="Aktif") echo "checked";?>>Aktif
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optstat" value="Non-aktif" <?php if($row->status=="Non-aktif") echo "checked";?>>Non-aktif
                                </label>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-warning" name="editpkd">Simpan</button>
                            </div>
                          </form>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="modal fade" id="delpkd<?= $row->id; ?>">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hapus PKD</h4>
                          </div>
                          <div class="modal-body">
                            <p>Yakin akan menghapus <?= $row->nama; ?>?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Lain kali</button>&nbsp;
                            <a href="model.php?do=delpkd&id=<?php echo $row->id; ?>">
                              <button type="button" class="btn btn-danger">Ya, hapus</button>
                            </a>
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
