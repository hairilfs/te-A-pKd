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
    $adm    = $_POST['adm'];
    $thnbln = $_POST['thnbln']."-";

    if ($adm=="danru") {
      $id_adm = 2;
    } else {
      $id_adm = 1;
    }

    $bt = explode("-", $thnbln);
    $jum_pkd = count($nik);
    $jum_hari = cal_days_in_month(CAL_GREGORIAN, $bt[1], $bt[0]);
    if ($bt[1]<10) {
      $id_jad = "J0".$bt[1].$bt[0];
    } else {
      $id_jad = "J".$bt[1].$bt[0];
    }    

    $mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
    $kueri1 = $mysqli->query("INSERT INTO jadwal(id_jadwal, id_admin, bln, thn, pola) VALUES('$id_jad', $id_adm, '$bt[1]', '$bt[0]', 3)");
    if ($kueri1) {
      $pairs = array();
      for ($i=0; $i < $jum_pkd; $i++) {
        for ($j=0; $j < $jum_hari; $j++) {
          $pairs[] = "('".$id_jad."', '".$nik[$i]."', '".$thnbln.($j+1)."', '".$shift[$i][$j]."')";
        }
      }

      $kueri2 = $mysqli->query("INSERT INTO detil_jadwal(id_jadwal, nik, tgl, shift) VALUES ".implode(",", $pairs));
      if ($kueri2) { ?>
      <script>
      swal({
       title: "Sukses!",
       text: "Penyimpanan jadwal berhasil.",
       type: "success"
     }, function(){
       window.close();
     });
      </script>
      <?php } else {
        echo "<script>swal('Oops, kesalahan!', '".$mysqli->error."', 'error');</script>";
      }
    } else {
      echo "<script>swal('Oops, kesalahan tabel jadwal!', '".$mysqli->error."', 'error');</script>";
    }
  }
  ?>
</body>
</html>
