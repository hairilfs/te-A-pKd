<?php
$content = 0;
$content = $_GET['page'];
include("header.php");
include("sidebar.php");

switch ($content) {
  case 1:
  include("testing1.php");
  break;
  case 2:
  include("masterpkd.php");
  break;
  case 3:
  include("pengaturan.php");
  break;
  default:
  include("welcome.php");
  break;
}

include("footer.php");
?>
