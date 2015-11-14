<?php 
/**
* ini class untuk mengkonversi beberapa nilai
*/
class Konversi {
	// fungsi untuk mengkonversi angka menjadi bulan
  function cetak_bulan($angka) {
    $bulan = "";
    switch ($angka) {
      case 1: $bulan = "JANUARI";
      break;
      case 2: $bulan = "FEBRUARI";
      break;
      case 3: $bulan = "MARET";
      break;
      case 4: $bulan = "APRIL";
      break;
      case 5: $bulan = "MEI";
      break;
      case 6: $bulan = "JUNI";
      break;
      case 7: $bulan = "JULI";
      break;
      case 8: $bulan = "AGUSTUS";
      break;
      case 9: $bulan = "SEPTEMBER";
      break;
      case 10: $bulan = "OKTOBER";
      break;
      case 11: $bulan = "NOVEMBER";
      break;
      case 12: $bulan = "DESEMBER";
      break;
    }
    return $bulan;
  }

  function nama_admin($id) {
    $nama = "";
    $mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
    $kueri = $mysqli->query("SELECT username FROM admin WHERE id='$id' ");
    $res = $kueri->fetch_assoc();
    $nama = $res['username'];

    return strtoupper($nama);
  }

  function nama_pkd($id) {
  	$nama = "";
  	$mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
  	$kueri = $mysqli->query("SELECT nama, jabatan FROM pkd WHERE nik='$id' ");
  	$res = $kueri->fetch_assoc();
  	$nama = $res['nama']."-".$res['jabatan'];

  	return $nama;
  }
}
?>