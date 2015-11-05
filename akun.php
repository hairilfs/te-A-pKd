<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Akun
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Akun</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <div class="center-block">
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ganti Password</h3>
              <?php
                if (isset($_POST['ganpass'])) {
                  $now = md5($_POST['passnow']);
                  $new = $_POST['passnew'];
                  $renew = $_POST['repassnew'];

                  $query = $mysqli->query("SELECT * FROM user WHERE username='admin'");
                  $res = $query->fetch_object();

                  if ($now==$res->password) {
                    if ($new==$renew) {
                      $newpass = md5($new);
                      $ganti = $mysqli->query("UPDATE user SET password='$newpass' WHERE username='admin';");
                      echo "<script>swal('Sukses!', 'Penggantian password berhasil.', 'success');</script>";
                    } else {
                      echo "<script>swal('Oops!', 'Salah mengulangi password baru.', 'warning');</script>";
                    }
                  } else {
                    echo "<script>swal('Oops!', 'Password saat ini tidak cocok.', 'error');</script>";
                  }
                }
              ?>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-4 control-label">Password saat ini</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="passnow" placeholder="Password saat ini">
                  </div>
                </div><hr>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Password baru</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="passnew" placeholder="Password baru">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Ulangi password baru</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="repassnew" placeholder="Ulangi password baru">
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Batal</button>
                <button type="submit" class="btn btn-primary pull-right" name="ganpass">Ya, ganti!</button>
              </div><!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>
    </section><!-- /.content -->
  </div>
</div><!-- /.content-wrapper -->
