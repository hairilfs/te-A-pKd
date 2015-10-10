<?php
/**
* ini class untuk proses algen
*/
class Hairil 	{

  function gen_rand_shift() {
    $a = array("P1", "S1", "M1", "P2", "S2", "M2", "PC", "SC", "PP", "SP");
    shuffle($a);
    $random = array_rand($a,1);

    return $a[$random];
  }

  function gen_array_ind() {
    $ind 	= array();
    $pkd 	= array();
    $hari = array();
    $rand05 = 0;
    for ($y=0; $y < 20; $y++) { // individu , populasi
      for ($x=0; $x < 22; $x++) { // pkd
        for ($i=0; $i < 31; $i++) { // hari
            $acak2 = $this->gen_rand_shift();
          array_push($hari, $acak2);
        }
        array_push($pkd, $hari);
        $hari = array();
      }
      array_push($ind, $pkd);
      $pkd = array();
    }
    return $ind;
  }

  function gen_array_ind2() {
    $ind 	  = array();
    $pkd 	  = array();
    $hari   = array();
    $shift  = array('1','2','3','4','5','L','L');
    for ($y=0; $y < 20; $y++) { // individu , populasi
      $key = 0;
      for ($x=0; $x < 22; $x++) { // pkd
        for ($i=0; $i < 31; $i++) { // hari
          if ($shift[$key] == "L") {
            $acak2 = "L";
          } else {
            $acak2 = $this->gen_rand_shift();
          }
            array_push($hari, $acak2);
            $key++;
            if ($key>=count($shift)) $key = 0;
        }
        if ($key-2 <0) $key = count($shift) + $key - 2;
        else $key = $key - 2;
        array_push($pkd, $hari);
        $hari = array();
      }
      array_push($ind, $pkd);
      $pkd = array();
    }
    return $ind;
  }

  function cek_libur($new_ind) {
    $loop_aja = count($new_ind); // 5
    $loop_pkd = count($new_ind[0]); // 10
    $loop_hari = count($new_ind[0][0]); //30
    $penaliti_pola_libur = array();
    $penalti1 = 0;
    $penalti2 = 0;
    $gap = 0;

    for ($i=0; $i < $loop_aja; $i++) {
      $gap = 0;
      $w = 0;
      for ($j=0; $j < $loop_pkd; $j++) {
        if ($gap == 6) {
          $w = 1;
          $gap = 0;
        }
        $k = 0;
        while ($k < ($loop_hari-1)) {
          if ($k == 0 && $w==0) {
            // if ($new_ind[$i][$j][$k+5-$gap]!="L" || $new_ind[$i][$j][$k+6-$gap]!="L" ) {
            //   $penalti1 += 1;
            $new_ind[$i][$j][$k+5-$gap]="L";
            $new_ind[$i][$j][$k+6-$gap]="L";
            $k+=5;
            // echo $k." ";
            // }
          } elseif ($k == 0 && $w!=0) {
            // if ($new_ind[$i][$j][$k+7-$gap]!="L" || $new_ind[$i][$j][$k+8-$gap]!="L" ) {
            //   $penalti1 += 1;
            $new_ind[$i][$j][$k]="L";
            $w=0;
            // $new_ind[$i][$j][$k+8-$gap]="L";
            // }
            $k+=6;
            // echo $k." ";
          } elseif ($k != 0 && $k <= 20 ) {
            // if ($new_ind[$i][$j][$k+7-$gap]!="L" || $new_ind[$i][$j][$k+8-$gap]!="L" ) {
            //   $penalti1 += 1;
            $new_ind[$i][$j][$k+7-$gap]="L";
            $new_ind[$i][$j][$k+8-$gap]="L";
            // }
            $k+=7;
            // echo $k." ";
          } elseif ($k != 0 && $k >= 20 && $gap==3) {
            // if ($new_ind[$i][$j][$k+7-$gap]!="L" || $new_ind[$i][$j][$k+8-$gap]!="L" ) {
            //   $penalti1 += 1;
            $new_ind[$i][$j][$k+7-$gap]="L";
            // $new_ind[$i][$j][$k+8-$gap]="L";
            // }
            $k+=7;
            // echo $k." ";
          } elseif ($k != 0 && $k >= 20 && $gap>=4) {
            // if ($new_ind[$i][$j][$k+7-$gap]!="L" || $new_ind[$i][$j][$k+8-$gap]!="L" ) {
            //   $penalti1 += 1;
            $new_ind[$i][$j][$k+7-$gap]="L";
            $new_ind[$i][$j][$k+8-$gap]="L";
            // }
            $k+=7;
            // echo $k." ";
          } else {
            $k+=1;
          }
          // echo $gap;
          // $k+=5;
        }

        $gap += 1;
        // echo $gap;
      }
      // array_push($penaliti_pola_libur, $penalti1);
      $penalti1 = 0;
    }
    // return $penaliti_pola_libur;
    return $new_ind;
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
        if ($hc_min_jaga < 17) {
          $hc_jaga += 1;
        }
        $hc_min_jaga = 0;
      }
      array_push($hc_ind, $hc_jaga);
      $hc_jaga = 0;
    }
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

  function cetak_individu_biasa($individu) {
    $loop_aja = count($individu); // 5
    $loop_pkd = count($individu[0]); // 10
    $loop_hari = count($individu[0][0]); //30

    for ($i=0; $i < $loop_aja; $i++) {
      echo "<label>Individu ke ".$i;
      echo "<table border='1' style='border-collapse: collapse; font:  12px sans-serif;'";
      for ($j=0; $j < $loop_pkd; $j++) {
        echo "<tr>";
        for ($k=0; $k < $loop_hari; $k++) {
          if ($individu[$i][$j][$k]!= "L") {
            echo "<td width='25px' align='center'>".$individu[$i][$j][$k]."</td>";
          } else {
            echo "<td width='25px' align='center' style='background: red;'>".$individu[$i][$j][$k]."</td>";
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
          } elseif ($individu[$i][$j][$k]==0 ) {
            echo "<td width='20px' align='center' style='background: grey;'>".$individu[$i][$j][$k]."</td>";
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

  // untuk mencari nilai fitness
  function n_fitness($hc) {
    $a = 1+($hc);
    $fit = round((1/$a), 6);

    return $fit;
  }

  // untuk mendapatkan nilai random 0-1
  function random_0_1() {
    $g = mt_rand(0,1000000)/1000000;
    return $g;
  }

  // untuk mendapatkan pointer acak roullete wheel
  function gen_pointer_rw($n_rw) {
    $arr_poin_rw = array();
    for ($t=0; $t < $n_rw; $t++) {
      $p =  $this->random_0_1();
      array_push($arr_poin_rw, $p);
    }
    return $arr_poin_rw;
  }

  // untuk menggabungkan penalti dan meneruskannya ke fungsi fitness
  function gabung_fitness($x1, $x2, $j_ind) {
    $fitness = array();
    for ($i=0; $i < $j_ind; $i++) {
      $a = $x1[$i] + $x2[$i];
      $b = $this->n_fitness($a);
      array_push($fitness, $b);
    }
    return $fitness;
  }

  // untuk menggabungkan penalti dan meneruskannya ke fungsi fitness
  function gabung_fitness2($x1, $j_ind) {
    $fitness = array();
    for ($i=0; $i < $j_ind; $i++) {
      $a = $x1[$i];
      $b = $this->n_fitness($a);
      array_push($fitness, $b);
    }
    return $fitness;
  }

  // mendapatkan probabilitas fitness masing-masing individu
  function probfit_masing2($t_fit, $each_fit) {
    $probfit = array();

    for ($v=0; $v < count($each_fit); $v++) {
      $c = $each_fit[$v] / $t_fit;
      $d = round($c, 6);
      array_push($probfit, $d);
    }
    return $probfit;
  }

  // mendapatkan jarak untuk dilanjutkan ke roulette wheel
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
    $cekhc        = $this->cek_libur($new_individu); // testing cek libur
    $fitn         = $this->gabung_fitness2($cekhc, $jum_ind);
    // $x1 					= $this->cek_shift31($new_individu);
    // $x2 					= $this->cek_min_jaga($new_individu);
    // $fit_masing2	= $this->gabung_fitness($x1, $x2, $jum_ind);
    $prob_m 			= $this->probfit_masing2(array_sum($fitn), $fitn);
    $arr_poin_rw 	= $this->gen_pointer_rw($jum_ind);
    $range				= $this->get_range($prob_m, $jum_ind);

    // print_r($arr_poin_rw);
    // echo "<br/>";
    // print_r($range);
    // echo "<br/>";
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

  // fungsi untuk memulai crossover (one-point-cut)
  function do_crossover($individu) {
    $pc = 0.6; // nilai prob crossover 0.6-0.85
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

    $b2 = count($individu[0]); // 23
    $b3 = count($individu_co); // tak tentu

    if ($b3 != 1) { // jika yang terpilih hanya 1, maka tidak di crossover
      for ($r=0; $r < $b3; $r++) { // mengulangi sebanyak individu terpilih utk di crossover
        $tp = mt_rand(0, $bts); // menerapkan batas dari 0 - batas-2 untuk titik potong => (28)
        // echo $tp." "; // menentukan titik potong index 0-28
        $ind_ke = $individu_co[$r]; // diisi dengan individu terpilih crossover
        if ($r == ($b3-1)) {
          $ind_next = $individu_co[0];
        } else {
          $ind_next = $individu_co[$r+1];
        }

        for ($k=0; $k < $b2; $k++) {
          $slice = array_slice($individu[$ind_next][$k], $tp);
          array_splice($new_ind_co[$ind_ke][$k], $tp, count($new_ind_co[$ind_ke][$k]), $slice);
          // echo $ind_next." ";
        }
          // echo $tp." ";
      }
          // echo count($individu)." ";
          // echo $b3." ";
    }

    return $new_ind_co;
  }

  // fungsi untuk memulai mutasi
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
    // echo "panjang kromosom 1d = ".$pjg;
    $pm 		= round(0.01 * $pjg); // mengkalikan pm dgn 1500 => 15

    for ($l=0; $l < $pm; $l++) {
      $n_ran 			= mt_rand(0, $pjg-1); // membangkitkan nilai random 0-1499
      $selected[] = $n_ran; // memasukkan gen-gen terpilih ke array $selected
    }

    // print_r($selected);

    for ($m=0; $m < count($selected); $m++) {
      $isl 								= $selected[$m]; // mengisi $isl dengan value pada array $selected
      // $ran0123 						= mt_rand(0,3);
      $ran0123 						= $this->gen_rand_shift();
      $output_array[$isl] = $ran0123; // menukar isi dari array $output_array yg terpilih indexnya dgn 0-3
      // echo $ran0123." ";
    }

    $ptg    = count($individu[0]) * count($individu[0][0]);
    $to2d 	= array_chunk($output_array, $ptg); // membuat potongan dari 3000 gen menjadi msg2 300 pcs
    $in		 	= count($to2d); // menghitung panjang $to2d => 10

    for ($h=0; $h < $in; $h++) {
      $to3d 				= array_chunk($to2d[$h], 31); // membuat potongan dari 300 gen menjadi msg2 30 pcs
      $new_ind_mu[] = $to3d; // memasukan potongan2 $to3d ke array $new_ind_mu
    }

    // print_r($new_ind_mu);
    return $new_ind_mu;
  }

  function do_update_generation($ind1, $ind2) { //generational model, dipilih 20 individu dgn fitness terbaik
    $new_parent = array();
    $new_parent2 = array();
    $next_new = array();

    for ($i=0; $i < count($ind1); $i++) { // memasukan individu awal ke array baru
      $new_parent[] = $ind1[$i];
    }

    for ($j=0; $j < count($ind2); $j++) { // memasukan individu selanjutnya ke array baru
      $new_parent[] = $ind2[$j];
    }
    // mengecek nilai fitness
    $z1 	= $this->cek_shift31($new_parent);
    $z2 	= $this->cek_min_jaga($new_parent);
    $fit3	= $this->gabung_fitness($z1, $z2, count($new_parent));

    arsort($fit3); // mengurutkan fitness terbaik, namun tidak mengubah indexnya
    $xyz = array_slice($fit3, 0, 20, true); // memilih 20 array teratas
    foreach ($xyz as $key => $value) {
      $next_new[] = $key;
    }

    $c_next = count($next_new);
    for ($k=0; $k < $c_next; $k++) { // memasukkan 20 array teratas berdasarkan fitnessnya
      $new_parent2[] = $new_parent[$next_new[$k]];
    }

    return $new_parent2;
  }

} // batas class
?>
