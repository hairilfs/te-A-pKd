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

  function pola($awal_libur=0) {
    switch ($awal_libur) {
      case 0:
        $shift  = array('L','X','X','X','X','X','L');
        break;
      case 1:
        $shift  = array('L','L','X','X','X','X','X');
        break;
      case 2:
        $shift  = array('X','L','L','X','X','X','X');
        break;
      case 3:
        $shift  = array('X','X','L','L','X','X','X');
        break;
      case 4:
        $shift  = array('X','X','X','L','L','X','X');
        break;
      case 5:
        $shift  = array('X','X','X','X','L','L','X');
        break;
      case 6:
        $shift  = array('X','X','X','X','X','L','L');
        break;
      default:
        $shift  = array('X','X','X','X','X','L','L');
        break;
    }
    return $shift;
  }

  function gen_array_ind() {
    $ind 	  = array();
    $pkd 	  = array();
    $hari   = array();
    $shift  = $this->pola(6);
    for ($y=0; $y < 24; $y++) { // individu , populasi
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
    $ind = array();
  }

  // penalti ini terjadi apabila seorang petugas sudah 2 hari libur dan besok tidak masuk siang
  function cek_shiftLLS($new_ind) {
    // $new_ind = $individu;
    $loop_aja = count($new_ind); // 5
    $loop_pkd = count($new_ind[0]); // 10
    $loop_hari = count($new_ind[0][0]); //30

    $hc31 = 0;
    $hc_ind = array();
    for ($i=0; $i < $loop_aja; $i++) {
      for ($j=0; $j < $loop_pkd; $j++) {
        for ($k=0; $k < $loop_hari-2; $k++) {
          $ceksiang = substr($new_ind[$i][$j][$k+2], 0,1);
          if ($k==0 && substr($new_ind[$i][$j][0], 0,1)!="S" && $new_ind[$i][$j][$k+5]=="L" && $new_ind[$i][$j][$k+6]=="L") $hc31 += 1;
          if ($k==1 AND substr($new_ind[$i][$j][1], 0,1)!="S" AND $new_ind[$i][$j][$k+5]=="L") $hc31 += 1;
          if ($new_ind[$i][$j][$k]=="L" AND $new_ind[$i][$j][$k+1]=="L" AND $ceksiang!="S") $hc31 += 1;
        }
      }
      array_push($hc_ind, $hc31);
      $hc31 = 0;
    }
    return $hc_ind;
  }

  // penalti ini terjadi apabila seorang petugas hari ini masuk malam dan besok masuk pagi
  function cek_shiftMP($new_ind) {
    $loop_aja = count($new_ind); // 5
    $loop_pkd = count($new_ind[0]); // 10
    $loop_hari = count($new_ind[0][0]); //30

    $hc31 = 0;
    $hc_ind = array();
    for ($i=0; $i < $loop_aja; $i++) {
      for ($j=0; $j < $loop_pkd; $j++) {
        for ($k=0; $k < $loop_hari-1; $k++) {
          $kini = substr($new_ind[$i][$j][$k], 0,1);
          $esok = substr($new_ind[$i][$j][$k+1], 0,1);
          if ($kini=="M" AND $esok=="P") {
            $hc31 += 1;
          }
          if ($kini=="M" AND $esok=="M") {
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
  function cek_shiftHR($new_ind) {
    $hc_ind = array();
    $loop_aja = count($new_ind); // 5
    $loop_pkd = count($new_ind[0]); // 10
    $loop_hari = count($new_ind[0][0]); //30

    $hc_p1 = 0;   $hc_s1 = 0;   $hc_m1 = 0;
    $hc_p2 = 0;   $hc_s2 = 0;   $hc_m2 = 0;
    $hc_pc = 0;   $hc_sc = 0;   $hc_pp = 0;
    $hc_sp = 0;   $hc_lb = 0;   $hc_hari = 0;

    for ($q=0; $q < $loop_aja; $q++) {
      for ($w=0; $w < $loop_hari; $w++) {
        for ($e=0; $e < $loop_pkd; $e++) {
          $isi_gen = $new_ind[$q][$e][$w];
          switch ($isi_gen) {
            case 'P1':
            $hc_p1 += 1;
            break;
            case 'S1':
            $hc_s1 += 1;
            break;
            case 'M1':
            $hc_m1 += 1;
            break;
            case 'P2':
            $hc_p2 += 1;
            break;
            case 'S2':
            $hc_s2 += 1;
            break;
            case 'M2':
            $hc_m2 += 1;
            break;
            case 'PC':
            $hc_pc += 1;
            break;
            case 'SC':
            $hc_sc += 1;
            break;
            case 'PP':
            $hc_pp += 1;
            break;
            case 'SP':
            $hc_sp += 1;
            break;
            case 'L':
            $hc_lb += 1;
            break;
          }
        }

        if ($hc_p1 < 1 || $hc_p1 > 2) $hc_hari += 1;
        if ($hc_s1 < 1 || $hc_s1 > 2) $hc_hari += 1;
        if ($hc_m1 < 1 ) $hc_hari += 1;
        if ($hc_p2 < 1 || $hc_p2 > 2) $hc_hari += 1;
        if ($hc_s2 < 1 || $hc_s2 > 2) $hc_hari += 1;
        if ($hc_m2 < 1) $hc_hari += 1;
        if ($hc_pc < 1) $hc_hari += 1;
        if ($hc_sc < 1) $hc_hari += 1;

        if ($hc_pp < 2 || $hc_pp > 3) $hc_hari += 1;
        if ($hc_sp < 1 || $hc_sp > 2) $hc_hari += 1;

        $hc_p1 = 0;   $hc_s1 = 0;   $hc_m1 = 0;
        $hc_p2 = 0;   $hc_s2 = 0;   $hc_m2 = 0;
        $hc_pc = 0;   $hc_sc = 0;   $hc_pp = 0;
        $hc_sp = 0;   $hc_lb = 0;
      }
      array_push($hc_ind, $hc_hari);
      $hc_hari = 0;
    }
    // print_r($hc_ind);
    return $hc_ind;
  }

  function cetak_individu_biasa($individu, $loop =0) {
    // $loop_aja = count($individu); // 5
    if ($loop==0) {
      $loop_aja = count($individu); // 5
    } else {
      $loop_aja = $loop;
    }
    $loop_pkd = count($individu[0]); // 10
    $loop_hari = count($individu[0][0]); //30

    for ($i=0; $i < $loop_aja; $i++) {
      echo "<label>Individu ke ".$i;
      echo "<table class='table table-bordered table-condensed'>";
      for ($j=0; $j < $loop_pkd; $j++) {
        echo "<tr>";
        for ($k=0; $k < $loop_hari; $k++) {
          if ($k != ($loop_hari-1) AND substr($individu[$i][$j][$k], 0, 1)== "M" AND substr($individu[$i][$j][$k+1], 0, 1)== "P") {
            echo "<td width='25px' align='center' style='background: blue;'>".$individu[$i][$j][$k]."</td>";
          } elseif ($individu[$i][$j][$k]!= "L") {
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

  // untuk mendapatkan nilai random 0-1
  function random_0_1() {
    $g = mt_rand(0,1000000)/1000000;
    return $g;
  }

  // untuk mencari nilai fitness
  function n_fitness($hc) {
    $a = 1+($hc);
    $fit = round((1/$a), 6);

    return $fit;
  }

  function all_fitness1($individu) {
    $fitness      = array();
    $x1           = $this->cek_shiftHR($individu); // cek harian

    for ($i=0; $i < count($individu); $i++) {
      $b = $this->n_fitness($x1[$i]);
      array_push($fitness, $b);
    }
    return $fitness;
  }

  function all_fitness2($individu) {
    $fitness      = array();
    $x1           = $this->cek_shiftLLS($individu); // cek libur libur siang
    $x2           = $this->cek_shiftMP($individu); // cek malam pagi

    for ($i=0; $i < count($individu); $i++) {
      $a = $x1[$i] + $x2[$i];
      $b = $this->n_fitness($a);
      array_push($fitness, $b);
    }
    return $fitness;
  }

  function all_fitness3($individu) {
    $fitness  = array();
    $x1       = $this->cek_shiftLLS($individu); // testing cek libur
    $x2       = $this->cek_shiftMP($individu); // testing cek libur
    $x3       = $this->cek_shiftHR($individu); // testing cek libur

    for ($i=0; $i < count($individu); $i++) {
      $a = $x1[$i] + $x2[$i] + $x3[$i];
      $b = $this->n_fitness($a);
      array_push($fitness, $b);
    }
    return $fitness;
  }

  // fungsi untuk memulai roulette wheel
  function do_roullete_wheel($new_individu) {
    $new_in				= array();
    $new_poin			= array();
    $probfit      = array();
    $arr_poin_rw  = array();
    $range        = array();
    $jum_ind 			= count($new_individu);
    $fit_masing2	= $this->all_fitness3($new_individu);
    $tot_fit      = array_sum($fit_masing2);

    for ($i=0; $i < $jum_ind; $i++) {
      // prob fit tiap individu
      $c = $fit_masing2[$i] / $tot_fit;
      $d = round($c, 6);
      array_push($probfit, $d);

      // get pointer
      $p =  $this->random_0_1();
      array_push($arr_poin_rw, $p);

      // get range
      if ($i==0) {
        $range[0] = $probfit[0];
      } else {
        $range[$i] = $range[$i-1] + $probfit[$i];
      }
    }

    // print_r($arr_poin_rw);
    // echo "<br/>";
    // print_r($range);
    // echo "<br/>";

    // menempatkan pointer
    for ($j=0; $j < $jum_ind; $j++) {
      for ($k=0; $k < $jum_ind; $k++) {
        if ($arr_poin_rw[$j] <= $range[$k]) {
          if (!in_array($k, $new_poin)) {
            array_push($new_poin, $k);
            $new_in[] = $new_individu[$k];
            // echo $k;
          }
          break;
        }
      }
    }
    return $new_in;
  }

  // fungsi untuk memulai crossover
  function do_crossover($individu) {
    $pc = 0.72; // nilai prob crossover 0.6-0.85
    $new_ind_co = $individu;

    $bts = count($individu[0][0])-2; // 28
    $individu_co = array();

    for ($i=0; $i < count($individu); $i++) {
      $op = $this->random_0_1();
      if ( $op < $pc) {
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
        $tp1 = mt_rand(1, $bts-1); // menerapkan batas dari 0 - batas-2 untuk titik potong => (28)
        $tp2 = mt_rand($tp1+1, $bts);
        $tp3 = $tp2-$tp1;
        // echo $tp." "; // menentukan titik potong index 0-28
        $ind_ke = $individu_co[$r]; // diisi dengan individu terpilih crossover
        if ($r == ($b3-1)) {
          $ind_next = $individu_co[0];
        } else {
          $ind_next = $individu_co[$r+1];
        }

        // one-point crossover
        // for ($k=0; $k < $b2; $k++) {
        //   $slice = array_slice($individu[$ind_next][$k], $tp1);
        //   array_splice($new_ind_co[$ind_ke][$k], $tp1, count($new_ind_co[$ind_ke][$k]), $slice);
        //
        //   // $slice2 = array_slice($individu[$ind_ke][$k], $tp1);
        //   // array_splice($new_ind_co2[$ind_next][$k], $tp1, count($new_ind_co2[$ind_next][$k]), $slice);
        // }

        // multi-point crossover
        for ($k=0; $k < $b2; $k++) {
          $slice = array_slice($individu[$ind_next][$k], $tp1, $tp3);
          array_splice($new_ind_co[$ind_ke][$k], $tp1, $tp3, $slice);
        }
      }
    }
    $individu = array();
    return $new_ind_co;
    // return array_merge($new_ind_co, $new_ind_co2);
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
    $pm 		= round(0.006 * $pjg); // mengkalikan pm dgn 1500 => 15

    for ($l=0; $l < $pm; $l++) {
      $n_ran 			= mt_rand(0, $pjg-1); // membangkitkan nilai random 0-1499
      $selected[] = $n_ran; // memasukkan gen-gen terpilih ke array $selected
    }
    // print_r($selected);

    for ($m=0; $m < count($selected); $m++) {
      $isl  = $selected[$m]; // mengisi $isl dengan value pada array $selected
      if ($output_array[$isl] != "L") {
        $ran0123 						= $this->gen_rand_shift();
        $output_array[$isl] = $ran0123; // menukar isi dari array $output_array yg terpilih indexnya dgn 0-3
      }
      // echo $ran0123." ";
    }

    $ptg    = count($individu[0]) * count($individu[0][0]);
    $to2d 	= array_chunk($output_array, $ptg); // membuat potongan dari 3000 gen menjadi msg2 300 pcs
    $in		 	= count($to2d); // menghitung panjang $to2d => 10

    for ($h=0; $h < $in; $h++) {
      $to3d 				= array_chunk($to2d[$h], count($individu[0][0])); // membuat potongan dari 300 gen menjadi msg2 30 pcs
      $new_ind_mu[] = $to3d; // memasukan potongan2 $to3d ke array $new_ind_mu
    }
    // print_r($new_ind_mu);
    return $new_ind_mu;
  }

  function do_update_generation($ind1, $ind2) { //generational model, dipilih 20 individu dgn fitness terbaik
    $new_parent = array();
    $new_parent2 = array();
    $next_new = array();
    // menggabungkan array
    $new_parent = array_merge($ind1, $ind2);
    // mengecek nilai fitness
    $fit3	= $this->all_fitness3($new_parent);

    arsort($fit3); // mengurutkan fitness terbaik, namun tidak mengubah indexnya
    $xyz = array_slice($fit3, 0, 24, true); // memilih 20 array teratas
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
