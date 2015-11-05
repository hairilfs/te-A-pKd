<?php 
if (isset($_POST['saveshift'])) {
  $nama_ang = $_POST['nama'];
  $tgl = $_POST['tgl'];
  $tahun = "2015-02-";

    // $pairs = array();
    // for ($j=0; $j < 28; $j++) { 
    //   $pairs[] = "(".$tahun.($j+1).", ".$nama_ang[0].", ".$tgl[1][$j].")";
    // }

    $pairs = array();
  for ($i=1; $i <= 22; $i++) {    
    for ($j=0; $j < 28; $j++) { 
      $pairs[] = "('".$tahun.($j+1)."', '".$nama_ang[$i-1]."', '".$tgl[$i][$j]."')";
    }
  }

  $mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
  $kueri = $mysqli->query("INSERT INTO jadwal2(tgl, nik, shift) VALUES ".implode(",", $pairs));
  if ($kueri) {
    echo "sukses menyimpan";
  } else {
    echo "gagal : ".$mysqli->error;
  }

  // echo implode(", ", $pairs);
  echo "<pre>";
  print_r($pairs);
  echo "</pre>";

  echo "<pre>";
  print_r($tgl);
  echo "</pre>";
}
?>