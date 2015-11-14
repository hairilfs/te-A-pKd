<?php
session_start();
if (isset($_SESSION['ad_priv'])) {
  header("location: main.php?page=0");
} else { ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OpaL-PKD | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- animate css -->
  <link rel="stylesheet" href="dist/css/animate.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo"><b>OpaL</b>-PKD
    </div><!-- /.login-logo -->
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-blue" style="background: url('./dist/img/com.jpg') center; ">
        <h3 class="widget-user-username">Admin</h3>
        <h5 class="widget-user-desc">Login page</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle" src="dist/img/cop-512.png" alt="User Avatar">
      </div>
      <div class="box-footer">
        <br>
        <?php include_once "login.php"; ?>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="uname" placeholder="Username" required>
            <span class="fa fa-at form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="upass" placeholder="Password" required>
            <span class="fa fa-key form-control-feedback"></span>
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="ulogin">Login</button>
        </form>
      </div>
    </div>
  </div><!-- /.widget-user -->
</div><!-- /.login-box -->

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $('#as').addClass("shake animated");
</script>
</body>
</html>
<?php } ?>
