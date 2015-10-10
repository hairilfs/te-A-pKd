<?php
/**
* ini class untuk proses algen
*/
class Hairil 	{

	function gen_array_ind() {
		$ind 	= array();
		$pkd 	= array();
		$hari = array();
		for ($y=0; $y < 5; $y++) {
			for ($x=0; $x < 10; $x++) {
				for ($i=0; $i < 30; $i++) {
					$acak2 = rand(0,3);
					array_push($hari, $acak2);
				}
				array_push($pkd, $hari);
				$hari = array();
			}
			array_push($ind, $pkd);
			$pkd = array();
		}
		// print_r($ind);
		return $ind;
	}

	// penalti ini terjadi apabila seorang petugas hari ini masuk malam, besoknya masuk pagi
	function cek_shift31($individu) {
		$new_ind = $individu;
		$loop_aja = count($new_ind); // 5
		$loop_pkd = count($new_ind[0]); // 10
		$loop_hari = count($new_ind[0][0]); //30

		$hc31 = 0;
		$hc_ind = array();
		for ($i=0; $i < $loop_aja; $i++) {
			for ($j=0; $j < $loop_pkd; $j++) {
				for ($k=0; $k < $loop_hari-1; $k++) {
					if ($new_ind[$i][$j][$k]==3 AND $new_ind[$i][$j][$k+1]==1 ) {
						$hc31 += 1;
					}
				}
			}
			array_push($hc_ind, $hc31);
			$hc31 = 0;
		}
		// print_r($hc_ind);
		// echo array_sum($hc_ind)."<br/><br/>";
		return $hc_ind;
	}

	// penalti ini terjadi apabila jumlah petugas jaga dalam satu hari kurang dari jumlah yang ditentukan
	function cek_min_jaga($individu) {
		$new_ind = $individu;
		$loop_aja = count($new_ind); // 5
		$loop_pkd = count($new_ind[0]); // 10
		$loop_hari = count($new_ind[0][0]); //30

		$hc_min_jaga = 0;
		$hc_jaga = 0;
		$hc_ind = array();

		for ($q=0; $q < $loop_aja; $q++) {
			for ($w=0; $w < $loop_hari; $w++) {
				for ($e=0; $e < $loop_pkd; $e++) {
					if ($new_ind[$q][$e][$w]!=0) {
						$hc_min_jaga += 1;
					}
				}
				if ($hc_min_jaga < 6) {
					$hc_jaga += 1;
				}
				$hc_min_jaga = 0;
			}
			array_push($hc_ind, $hc_jaga);
			$hc_jaga = 0;
		}
		// print_r($hc_ind);
		// echo array_sum($hc_ind)."<br/><br/>";
		return $hc_ind;
	}

	function cetak_individu_minjaga($individu) {
		$loop_aja = count($individu); // 5
		$loop_pkd = count($individu[0]); // 10
		$loop_hari = count($individu[0][0]); //30

		for ($i=0; $i < $loop_aja; $i++) {
			echo "<label>Individu ke ".$i;
			echo "<table border='1' style='border-collapse: collapse;'";
			for ($j=0; $j < $loop_pkd; $j++) {
				echo "<tr>";
				for ($k=0; $k < $loop_hari; $k++) {
					if ($individu[$i][$j][$k]!=0) {
						echo "<td width='20px' align='center'>".$individu[$i][$j][$k]."</td>";
					} else {
						echo "<td width='20px' align='center' style='background: grey;'>".$individu[$i][$j][$k]."</td>";
					}
				}
				echo "</tr>";
			}
			echo "</table><br/>";
		}
	}

	function cetak_individu_31($individu) {
		$loop_aja = count($individu); // 5
		$loop_pkd = count($individu[0]); // 10
		$loop_hari = count($individu[0][0]); //30

		for ($i=0; $i < $loop_aja; $i++) {
			echo "<label>Individu ke ".$i;
			echo "<table border='1' style='border-collapse: collapse;'";
			for ($j=0; $j < $loop_pkd; $j++) {
				echo "<tr>";
				for ($k=0; $k < $loop_hari-1; $k++) {
					if ($individu[$i][$j][$k]==3 AND $individu[$i][$j][$k+1]==1 ) {
						echo "<td width='20px' align='center' style='background: red;'>".$individu[$i][$j][$k]."</td>";
					} else {
						echo "<td width='20px' align='center'>".$individu[$i][$j][$k]."</td>";
					}

					if ($k == ($loop_hari-2)) {
						echo "<td width='20px' align='center'>".$individu[$i][$j][$k+1]."</td>";
					}
				}
				echo "</tr>";
			}
			echo "</table><br/>";
		}
	}

	function n_fitness($hc) {
		$a = 1+($hc);
		$fit = round((1/$a), 4);

		return $fit;
	}

	function random_0_1() {
		// auxiliary function
		// returns random number with flat distribution from 0 to 1
		// $f = (float)rand()/(float)getrandmax();
		// $g = round($f, 4);
		$g = rand(0,10000)/10000;
		return $g;
	}

	function gen_pointer_rw($n_rw) {
		$arr_poin_rw = array();
		for ($t=0; $t < $n_rw; $t++) {
			$p =  $this->random_0_1();
			array_push($arr_poin_rw, $p);
		}
		return $arr_poin_rw;
	}

	function gabung_fitness($x1, $x2, $j_ind) {
			$x3 = array();
			for ($i=0; $i < $j_ind; $i++) {
				$a = $x1[$i] + $x2[$i];
				$b = $this->n_fitness($a);
				array_push($x3, $b);
			}
			return $x3;
	}

	function probfit_masing2($t_fit, $each_fit) {
		$probfit = array();

		for ($v=0; $v < count($each_fit); $v++) {
			$c = $each_fit[$v] / $t_fit;
			$d = round($c, 4);
			array_push($probfit, $d);
		}
		return $probfit;
	}

	function get_range($prob_m, $jum_ind) {
		$range = array();
		for ($i=0; $i < $jum_ind; $i++) {
			if ($i == 0) {
				$range[0] = $prob_m[0];
			} else {
				$range[$i] = $range[$i-1] + $prob_m[$i];
			}
		}
		return $range;
	}

	// fungsi untuk memulai roulette wheel
	function do_roullete_wheel($new_individu) {
		$new_in				= array();
		$jum_ind 			= count($new_individu);
		$x1 					= $this->cek_shift31($new_individu);
		$x2 					= $this->cek_min_jaga($new_individu);
		$fit_masing2	= $this->gabung_fitness($x1, $x2, $jum_ind);
		$prob_m 			= $this->probfit_masing2(array_sum($fit_masing2), $fit_masing2);
		$arr_poin_rw 	= $this->gen_pointer_rw($jum_ind);
		$range				= $this->get_range($prob_m, $jum_ind);

		print_r($arr_poin_rw);
		echo "<br/>";
		print_r($range);
		echo "<br/>";
		// menempatkan pointer
		for ($j=0; $j < $jum_ind; $j++) {
			for ($k=0; $k < $jum_ind; $k++) {
				if ($arr_poin_rw[$j] <= $range[$k]) {
					$new_in[$j] = $new_individu[$k];
					// echo $k;
					break;
				}
			}
		}
		return $new_in;
	}

	function do_crossover($individu) {
		$pc = 0.7;
		$new_ind_co = $individu;
		$bts = count($individu[0][0])-2; // 28
		$individu_co = array();
		for ($i=0; $i < count($individu); $i++) {
			$op = $this->random_0_1();
			if ( $op <= $pc) {
				$individu_co[] = $i; //mencari nilai random untuk perbandingan dgn pc
				// echo $i;
			}
				// echo $op." "; // cetak random prob mutasi
		}
		// print_r($individu_co); // menentukan individu mana saja yang akan dikawinsilangkan

	  $b2 = count($individu[0]); // 10
	  $b3 = count($individu_co); // 7

		if ($b3 != 1) { // jika yang terpilih hanya 1, maka tidak di crossover
			for ($r=0; $r < $b3; $r++) { // mengulangi sebanyak individu terpilih utk di crossover
				$tp = mt_rand(0,$bts); // menerapkan batas dari 0 - batas-2 => (28)
				// echo $tp." "; // menentukan titik potong index 0-28
				$ind_ke = $individu_co[$r]; // diisi dengan individu terpilih crossover
				if ($r == ($b3-1)) {
					$ind_next = $individu_co[0];
				} else {
					$ind_next = $individu_co[$r+1];
				}

				for ($k=0; $k < $b2; $k++) {
					array_splice($new_ind_co[$ind_ke][$k], $tp, count($new_ind_co[$ind_ke][$k]), array_slice($individu[$ind_next][$k], $tp) );
				}
			}
		}

		// print_r($individu_co);
		return $new_ind_co;
		// return $individu_co;

	}

	function do_mutation($individu) {
		$output_array = array();
		$selected 		= array();
		$new_ind_mu 	= array();

	  for ($i = 0; $i < count($individu); $i++) {
	    for ($j = 0; $j < count($individu[$i]); $j++) {
	      for ($k = 0; $k < count($individu[$i][$j]); $k++) {
	      $output_array[] = $individu[$i][$j][$k];
	      }
	    }
	  }

		$pjg 		= count($output_array); // menghitung panjang array 1 dimensi => 1500
		echo "panjang kromosom 1d = ".$pjg;
		$pm 		= round(0.01 * $pjg); // mengkalikan pm dgn 1500 => 15

		for ($l=0; $l < $pm; $l++) {
			$n_ran 			= mt_rand(0, $pjg-1); // membangkitkan nilai random 0-1499
			$selected[] = $n_ran; // memasukkan gen-gen terpilih ke array $selected
		}

		print_r($selected);

		for ($m=0; $m < count($selected); $m++) {
			$isl 								= $selected[$m]; // mengisi $isl dengan value pada array $selected
			$ran0123 						= mt_rand(0,3);
			$output_array[$isl] = $ran0123; // menukar isi dari array $output_array yg terpilih indexnya dgn 0-3
			echo $ran0123." ";
		}

	  $to2d 	= array_chunk($output_array, 300); // membuat potongan dari 3000 gen menjadi msg2 300 pcs
	  $in		 	= count($to2d); // menghitung panjang $to2d => 10

	  for ($h=0; $h < $in; $h++) {
	    $to3d 				= array_chunk($to2d[$h], 30); // membuat potongan dari 300 gen menjadi msg2 30 pcs
	    $new_ind_mu[] = $to3d; // memasukan potongan2 $to3d ke array $new_ind_mu
	  }

	  // print_r($new_ind_mu);
	  return $new_ind_mu;
	}


} // batas class

// =================================== pembatas class
$saya = new Hairil();
$gen_baru = $saya->gen_array_ind();

$x1 = $saya->cek_shift31($gen_baru);
$x2 = $saya->cek_min_jaga($gen_baru);

// print_r($gen_baru[4]);
$jum_individu = count($saya->gen_array_ind());

print_r($x1);
$q1 = array_sum($x1);
echo "<table border='1'><tr>";
foreach ($x1 as $key_x1) {
	echo "<td>".$key_x1."</td>";
}
echo "</tr></table><br/>";

print_r($x2);
$q2 = array_sum($x2);
echo "<table border='1'><tr>";
foreach ($x2 as $key_x2) {
	echo "<td>".$key_x2."</td>";
}
echo "</tr></table><br/>";

$fit_alone = array();
$tot_fit = 0;
for ($i=0; $i < $jum_individu; $i++) {
	$temp = $x1[$i] + $x2[$i];
	$hasil_fit = $saya->n_fitness($temp);
	$tot_fit += $hasil_fit;
	array_push($fit_alone, round($hasil_fit, 4));
	echo "hasil fitness individu ".$i."<br/>";
	echo round($hasil_fit, 4)."<br/><br/>";
}

echo "total nilai fitness<br>";
$qq = round($tot_fit, 4);
echo $qq ."<br/><br/>";
echo "nilai probabilitas masing-masing<br>";
foreach ($fit_alone as $key_fit) {
	echo round($key_fit/$qq, 4)."<br>";
}

// echo "nilai pointer masing-masing<br>";
// print_r($saya->gen_pointer_rw($jum_individu));

echo "<br>";

$rw = $saya->do_roullete_wheel($gen_baru); //melakukan seleksi roullete wheel
// print_r($rw);

// $saya->cetak_individu_31($gen_baru);
// // echo count($rw);
// $saya->cetak_individu_31($rw); // cetak yang telah individu terpilih dari proses roulette wheel

$op = $saya->do_crossover($rw); // melakukan crossover
// print_r($op);

$saya->cetak_individu_31($op); // mencetak individu yang telah dicrossover
$h_mutasi = $saya->do_mutation($op); // melakukan mutasi

$saya->cetak_individu_31($h_mutasi);

// for ($j=0; $j < count($gen_baru); $j++) {
// 	$bts = count($gen_baru[0][0])-1;
// 	$hari = mt_rand(0, $bts);
// 	echo $hari." ";
// }


?>
