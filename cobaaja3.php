<?php 
	function ambil($kata) {
		$kata2 = $kata;
		// echo $kata2;
		unset($kata);
		return $kata2;
		// echo $kata2;
	}

	  // fungsi untuk mengkonversi angka menjadi bulan
  function cetak_bulan($angka) {
  	// unset($angka);
    switch ($angka) {
      case 1: return "JANUARI";
      break;
      case 2: return "FEBRUARI";
      break;
      case 3: return "MARET";
      break;
      case 4: return "APRIL";
      break;
      case 5: return "MEI";
      break;
      case 6: return "JUNI";
      break;
      case 7: return "JULI";
      break;
      case 8: return "AGUSTUS";
      break;
      case 9: return "SEPTEMBER";
      break;
      case 10: return "OKTOBER";
      break;
      case 11: return "NOVEMBER";
      break;
      case 12: return "DESEMBER";
      break;
      default: return array('asd' => 2, 'asda' => 4 );
    }
  }

	// ambil("asik-asik joss");
	$kl = ambil("-> asik-asik joss");
	$bln = cetak_bulan(15);
	echo $kl;
	print_r($bln);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// $x = str_repeat('x', 8000000);
// echo memory_get_usage() . "<br>\n";      // 120172
// echo memory_get_peak_usage() . "<br>\n"; // 121248

// // unset($x);
// $x = str_repeat('x', 8000000);
// echo memory_get_usage() . "<br>\n";      // 120172
// echo memory_get_peak_usage() . "<br>\n";

?>