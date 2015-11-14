<?php
session_start();
if (!isset($_SESSION['ad_priv'])) {
  header("location: index.php");
} else {
$content = 0;
$content = $_GET['page'];
include_once "header.php";
include_once "sidebar.php";
$mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
switch ($content) {
  case 1:
  include_once "gen_jadwal.php";
  break;
  case 2:
  include_once "masterpkd.php";
  break;
  case 3:
  include_once "pengaturan.php";
  break;
  case 4:
  include_once "akun.php";
  break;
  case 5:
  include_once "testing1.php";
  break;
  default:
  include_once "welcome.php";
  break;
}

include_once "footer.php";
}
?>
