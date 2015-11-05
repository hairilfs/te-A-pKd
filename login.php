<?php
$mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
// if ($mysqli->connect_errno) {
//   echo "Koneksi database gagal! : ".$mysqli->connect_error();
// }

// cek user
if (isset($_POST['ulogin'])) {
  $user = $_POST['uname'];
  $pass = md5($_POST['upass']);
  $query = $mysqli->query("SELECT * FROM user WHERE username='$user' AND password='$pass'");
  $res = $query->num_rows;
  if ($res==1) {
    $_SESSION['ad_priv'] = $user;
    header("location: main.php?page=0");
  } else { ?>
    <div class='callout callout-danger alert-dismissable' id="as">
      Oops, Username atau Password salah!
    </div>
  <?php }
}
 ?>
