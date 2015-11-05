<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Simpan Jadwal</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/sweetalert2.css">
  <script src="dist/js/sweetalert2.min.js"></script>
</head>
<body>
  <?php
  if (isset($_POST['savejad'])) {
    $nik    = $_POST['nik'];
    $shift  = $_POST['shift'];
    $thnbln = $_POST['thnbln']."-";

    $bt = explode("-", $thnbln);
    $jum_pkd = count($nik);
    $jum_hari = cal_days_in_month(CAL_GREGORIAN, $bt[1], $bt[0]);

    $pairs = array();
    for ($i=0; $i < $jum_pkd; $i++) {
      for ($j=0; $j < $jum_hari; $j++) {
        $pairs[] = "('".$nik[$i]."', '".$thnbln.($j+1)."', '".$shift[$i][$j]."')";
      }
    }

    $mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
    $kueri = $mysqli->query("INSERT INTO jadwal(nik, tgl, shift) VALUES ".implode(",", $pairs));
    if ($kueri) { ?>
      <script>
				swal({
					title: "Sukses!",
					text: "Penyimpanan jadwal berhasil.",
					type: "success",
          height: 400,
          width: 400,
          // background: 'url(dist/img/twitcomm.jpg)'
				}, function(){
					window.close();
				});
			</script>
    <?php } else {
      echo "<script>swal('Oops, kesalahan!', '".$mysqli->error."', 'error');</script>";
    }
  }
  ?>
</body>
</html>
