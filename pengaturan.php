<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Pengaturan</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Pengaturan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="modal fade" id="addSetting">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Aturan</h4>
          </div>
          <form class="form-horizontal" action="model.php" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Populasi</label>
                <div class="col-sm-10">
                  <input type="number" min="1" class="form-control" name="pop" placeholder="Populasi" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Generasi</label>
                <div class="col-sm-10">
                  <input type="number" min="1" class="form-control" name="gen" placeholder="Generasi" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Pc</label>
                <div class="col-sm-10">
                  <input type="number" step="any" min="0.1" max="1" class="form-control" name="pc" placeholder="Prob. Crossover" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Pm</label>
                <div class="col-sm-10">
                  <input type="number" step="any" min="0.001" max="1" class="form-control" name="pm" placeholder="Prob. Mutasi" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <div class="radio-inline">
                    <input type="radio" name="optstat" value="1">Aktif
                  </div>
                  <div class="radio-inline">
                    <input type="radio" name="optstat" value="0" checked>Non-aktif
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" name="saveset">Simpan</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSetting"><i class="fa fa-cogs"></i> Buat Baru</button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="table-data" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Populasi</th>
                    <th>Generasi</th>
                    <th>Pc</th>
                    <th>Pm</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $res = $mysqli->query("SELECT * FROM pengaturan");
                  while ($row = $res->fetch_object()) { ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row->populasi; ?></td>
                      <td><?php echo $row->generasi; ?></td>
                      <td><?php echo $row->pc; ?></td>
                      <td><?php echo $row->pm; ?></td>
                      <td><?php if ($row->status==1) echo "Aktif <i class='fa fa-check'></i>"; else echo "Non-aktif";?></td>
                      <td>
                        <?php
                        if ($row->status!=1) echo "<a href='model.php?do=aktif&id=$row->id'><button type='button' class='btn btn-primary'>Aktifkan!</button></a> &nbsp;";
                        echo "<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editSetting$row->id'>Ubah</button> &nbsp;";
                        echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#delSetting$row->id'>Hapus</button>";
                        ?>
                      </td>
                    </tr>

                    <div class="modal fade" id="editSetting<?php echo $row->id; ?>">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Ubah Aturan</h4>
                          </div>
                          <form action="model.php" method="post">
                            <div class="modal-body">
                              <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                              <div class="form-group">
                                <label>Populasi</label>
                                <input type="number" min="1" class="form-control" name="pop" value="<?php echo $row->populasi; ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Generasi</label>
                                <input type="number" min="1" class="form-control" name="gen" value="<?php echo $row->generasi; ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Pc</label>
                                <input type="number" step="any" min="0.1" max="1" class="form-control" name="pc" value="<?php echo $row->pc; ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Pm</label>
                                <input type="number" step="any" min="0.001" max="1" class="form-control" name="pm" value="<?php echo $row->pm; ?>" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-warning" name="editset">Simpan</button>
                            </div>
                          </form>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="modal fade" id="delSetting<?php echo $row->id; ?>">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hapus Aturan</h4>
                          </div>
                          <div class="modal-body">
                            <p>Yakin akan menghapus aturan no. <?php echo $no; ?>?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Lain kali</button>&nbsp;
                            <a href="model.php?do=delset&id=<?php echo $row->id; ?>">
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
