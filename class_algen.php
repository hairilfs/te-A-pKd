<?php
// ini class untuk memproses algen

class Algen {
  public $jml_ind;
  public $jml_pkd;
  public $jml_hari;
  public $pc;
  public $pm;
  public $bulan_x;
  public $tahun_x;
  public $minshift;
  public $maxshift;
  public $pola_shift;

  function __construct($bln=1, $thn=2016, $minshift=null, $maxshift=null, $pola=null) {
    $mysqli   = new mysqli("localhost", "root", "", "db_jadwal_pkd");
    $q_pkd    = $mysqli->query("SELECT COUNT(*) as jum_pkd FROM pkd WHERE jabatan='ANGGOTA' AND status='Aktif'");
    $q_res_p  = $q_pkd->fetch_object();

    $this->jml_ind  = 60;
    $this->jml_pkd  = $q_res_p->jum_pkd;
    $this->jml_hari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
    $this->pc       = 0.6;
    $this->pm       = 0.006;
    $this->bulan_x  = $bln;
    $this->tahun_x  = $thn;
    $this->minshift = $minshift;
    $this->maxshift = $maxshift;
    $this->pola_shift = $pola;
  }

  // fungsi untuk mengkonversi angka menjadi bulan
  function cetak_bulan($angka) {
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
    }
  }

  function shift_siang($shiftnow) {
    $siang = "<select class='no-arrow'>\n
    <option style='background: grey;'>".$shiftnow."</option>\n
    <option>S1</option>\n
    <option>S2</option>\n
    <option>SP</option>\n
    <option>SC</option>\n
    </select>";
    return $siang;
  }

  function shift_malam($shiftnow) {
    $malam = "<select class='no-arrow mlm'>\n
    <option style='background: grey;'>".$shiftnow."</option>\n
    <option>P1</option>\n
    <option>S1</option>\n
    <option>P2</option>\n
    <option>S2</option>\n
    <option>PP</option>\n
    <option>SP</option>\n
    <option>PC</option>\n
    <option>SC</option>\n
    </select>";
    return $malam;
  }

  // fungsi untuk generate random shift
  function gen_rand_shift($req="") {
    // $a = array();
    switch ($req) {
      case "P": $a = array("P1", "P2", "PP", "PC");
      break;
      case "S": $a = array("S1", "SC", "S2", "SP");
      break;
      case "M": $a = array("M1", "M2");
      break;
      case "XM": $a = array("P1", "S1", "P2", "S2", "PC", "SC", "PP", "SP");
      break;
      default:  $a = array("P1", "S1", "M1", "P2", "S2", "M2", "PC", "SC", "PP", "SP");
      break;
    }
    shuffle($a);
    $random = array_rand($a,1);
    return $a[$random];
  }

  // fungsi untuk menentukan pola libur danru
  function pola_danru($awal_libur=0) {
    switch ($awal_libur) {
      case 0:
      return array('L','S','P','S','P','S','L');
      break;
      case 1:
      return array('L','L','S','P','S','P','S');
      break;
      case 2:
      return array('S','L','L','S','P','S','P');
      break;
      case 3:
      return array('P','S','L','L','S','P','S');
      break;
      case 4:
      return array('S','P','S','L','L','S','P');
      break;
      case 5:
      return array('P','S','P','S','L','L','S');
      break;
      case 6:
      return array('S','P','S','P','S','L','L');
      break;
      default:
      return array('S','P','S','P','S','L','L');
      break;
    }
  }

  // fungsi untuk menentukan pola libur
  function pola($awal_libur=0) {
    switch ($awal_libur) {
      case 0:
      return array('S','P','S','P','M','L','L');
      break;
      case 1:
      return array('L','S','P','S','P','M','L');
      break;
      case 2:
      return array('L','L','S','P','S','P','M');
      break;
      case 3:
      return array('M','L','L','S','P','S','P');
      break;
      case 4:
      return array('P','M','L','L','S','P','S');
      break;
      case 5:
      return array('S','P','M','L','L','S','P');
      break;
      case 6:
      return array('P','S','P','M','L','L','S');
      break;
      default:      
      return array('P','S','P','M','L','L','S');
      break;
    }  
  }

  // fungsi untuk generate individu
  function gen_array_ind() {
    $ind 	  = array();
    $pkd 	  = array();
    $hari   = array();
    $shift  = $this->pola($this->pola_shift);
    // penentuan pola harian
    switch ($this->jml_hari) {
      case 31:
      $selisih=2;
      break;
      case 30:
      $selisih=1;
      break;
      case 29:
      $selisih=0;
      break;
    }
    
    for ($y=0; $y < $this->jml_ind; $y++) { // individu , populasi
      $key = 0;
      for ($x=0; $x < $this->jml_pkd; $x++) { // pkd
        for ($i=0; $i < $this->jml_hari; $i++) { // hari          
          if ($shift[$key]=="P") $acak2 = $this->gen_rand_shift("P");
          elseif ($shift[$key]=="S") $acak2 = $this->gen_rand_shift("S");
          elseif ($shift[$key]=="M") $acak2 = $this->gen_rand_shift("M");
          else $acak2 = "L";
          array_push($hari, $acak2);
          $key++;
          if ($key>=count($shift)) $key = 0;
        }
        // jika bulannya bukan februari tahun kabisat
        if ($this->jml_hari!=28) {
          if ($key-$selisih < 0) $key = count($shift) + $key - $selisih;
          else $key = $key - $selisih;
        } else {
          if ($key >= count($shift)-1) $key = 0;
          else $key = $key + 1;
        }
        array_push($pkd, $hari);
        $hari = array();
      }
      array_push($ind, $pkd);
      $pkd = array();
    }
    unset($pkd, $hari, $shift);
    return $ind;
  }

  // penalti ini terjadi apabila seorang petugas sudah 2 hari libur dan besok tidak masuk siang
  function cek_shiftLLS($new_ind) {
    $loop_ind = count($new_ind);
    $loop_pkd = count($new_ind[0]);
    $loop_hr = count($new_ind[0][0])-2;
    $pnl= 0;
    $hc_ind = array();
    for ($i=0; $i < $loop_ind; $i++) {
      for ($j=0; $j < $loop_pkd; $j++) {
        for ($k=0; $k < $loop_hr; $k++) {
          // $ceksiang = substr($new_ind[$i][$j][$k+2], 0,1);
          if ($k==0 && substr($new_ind[$i][$j][0], 0,1)!="S" && $new_ind[$i][$j][$k+5]=="L" && $new_ind[$i][$j][$k+6]=="L") $pnl += 1;
          elseif ($k==1 && substr($new_ind[$i][$j][1], 0,1)!="S" && $new_ind[$i][$j][$k+5]=="L" && $new_ind[$i][$j][$k+6]=="L") $pnl += 1;
          // elseif ($new_ind[$i][$j][$k]=="L" AND $new_ind[$i][$j][$k+1]=="L" AND $ceksiang!="S") $pnl += 1;
        }
      }
      array_push($hc_ind, $pnl);
      $pnl = 0;
    }
    unset($new_ind);
    return $hc_ind;
  }

  // penalti ini terjadi apabila seorang petugas hari ini masuk malam dan besok masuk pagi
  function cek_shiftMP($new_ind) {
    $loop_ind = count($new_ind);
    $loop_pkd = count($new_ind[0]);
    $loop_hr = count($new_ind[0][0])-1;
    $pnl = 0;
    $hc_ind = array();
    for ($i=0; $i < $loop_ind; $i++) {
      for ($j=0; $j < $loop_pkd; $j++) {
        for ($k=0; $k < $loop_hr; $k++) {
          $kini = substr($new_ind[$i][$j][$k], 0,1);
          $esok = substr($new_ind[$i][$j][$k+1], 0,1);
          if ($kini=="M" AND $esok=="P") $pnl += 1;
          elseif ($kini=="M" AND $esok=="M") $pnl += 1;
        }
      }
      array_push($hc_ind, $pnl);
      $pnl = 0;
    }
    unset($new_ind);
    return $hc_ind;
  }

  // penalti ini terjadi apabila jumlah petugas jaga dalam satu hari kurang dari jumlah yang ditentukan
  function cek_shiftHR($new_ind) {
    $loop_ind = count($new_ind);
    $loop_pkd = count($new_ind[0]);
    $loop_hr = count($new_ind[0][0]);
    $hc_ind = array();
    $hc_p1 = 0;   $hc_s1 = 0;   $hc_m1 = 0;
    $hc_p2 = 0;   $hc_s2 = 0;   $hc_m2 = 0;
    $hc_pc = 0;   $hc_sc = 0;   $hc_pp = 0;
    $hc_sp = 0;   $hc_hari = 0;

    for ($q=0; $q < $loop_ind; $q++) {
      for ($w=0; $w < $loop_hr; $w++) {
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
            default:
            break;
          }
        }

        if ($hc_p1 < $this->minshift[0] OR $hc_p1 > $this->maxshift[0]) $hc_hari += 1; 
        if ($hc_s1 < $this->minshift[1] OR $hc_s1 > $this->maxshift[1]) $hc_hari += 1; 
        if ($hc_m1 < $this->minshift[2] OR $hc_m1 > $this->maxshift[2]) $hc_hari += 1; 
        if ($hc_p2 < $this->minshift[5] OR $hc_p2 > $this->maxshift[5]) $hc_hari += 1; 
        if ($hc_s2 < $this->minshift[6] OR $hc_s2 > $this->maxshift[6]) $hc_hari += 1; 
        if ($hc_m2 < $this->minshift[7] OR $hc_m2 > $this->maxshift[7]) $hc_hari += 1; 
        if ($hc_pc < $this->minshift[3] OR $hc_pc > $this->maxshift[3]) $hc_hari += 1; 
        if ($hc_sc < $this->minshift[4] OR $hc_sc > $this->maxshift[4]) $hc_hari += 1; 

        if ($hc_pp < $this->minshift[8] OR $hc_pp > $this->maxshift[8]) $hc_hari += 1; 
        if ($hc_sp < $this->minshift[9] OR $hc_sp > $this->maxshift[9]) $hc_hari += 1; 

        $hc_p1 = 0;   $hc_s1 = 0;   $hc_m1 = 0;
        $hc_p2 = 0;   $hc_s2 = 0;   $hc_m2 = 0;
        $hc_pc = 0;   $hc_sc = 0;   $hc_pp = 0;
        $hc_sp = 0;   
      }
      array_push($hc_ind, $hc_hari);
      $hc_hari = 0;
    }
    // print_r($hc_ind);
    unset($new_ind);
    return $hc_ind;
  }

  function cek_batas(){
    echo "batas p1 | min=".$this->minshift[0]." max=".$this->maxshift[0]."<br/>";
    echo "batas s1 | min=".$this->minshift[1]." max=".$this->maxshift[1]."<br/>";
    echo "batas m1 | min=".$this->minshift[2]." max=".$this->maxshift[2]."<br/>";
    echo "batas p2 | min=".$this->minshift[5]." max=".$this->maxshift[5]."<br/>";
    echo "batas s2 | min=".$this->minshift[6]." max=".$this->maxshift[6]."<br/>";
    echo "batas m2 | min=".$this->minshift[7]." max=".$this->maxshift[7]."<br/>";
    echo "batas pc | min=".$this->minshift[3]." max=".$this->maxshift[3]."<br/>";
    echo "batas sc | min=".$this->minshift[4]." max=".$this->maxshift[4]."<br/>";
    echo "batas pp | min=".$this->minshift[8]." max=".$this->maxshift[8]."<br/>";
    echo "batas sp | min=".$this->minshift[9]." max=".$this->maxshift[9]."<br/>";
  }

  // fungsi untuk mencetak individu kedalam table
  function cetak_individu_biasa($individu, $loop =0) {
    $namapkd = array();
    $nikpkd = array();
    $mysqli   = new mysqli("localhost", "root", "", "db_jadwal_pkd");
    $res = $mysqli->query("SELECT * FROM pkd WHERE jabatan='ANGGOTA' AND status='Aktif'");
    $res2 = $mysqli->query("SELECT * FROM pkd WHERE jabatan='DANRU' AND status='Aktif'");
    $listpkd2 = $res2->fetch_object();
    while ($listpkd = $res->fetch_object()) {
      array_push($namapkd, $listpkd->nama);
      array_push($nikpkd, $listpkd->nik);
    }

    if ($loop==0) $loop_aja = count($individu); // 5
    else $loop_aja = $loop;
    $loop_pkd = count($individu[0]); // 10
    $loop_hari = count($individu[0][0]); //30

    for ($i=0; $i < $loop_aja; $i++) {
      // echo "<label>Individu ke ".$i."</label>";
      echo "<input type='hidden' name='adm' value='$_SESSION[ad_priv]'>";
      echo "<div class='table-responsive'>\n<table class='table table-bordered table-condensed'>";
      echo "<tr>\n<td align='center' rowspan='2'>No.</td>\n<td align='center' rowspan='2'>Nama</td>\n";
      echo "<td colspan='$this->jml_hari' align='center'>".$this->cetak_bulan($this->bulan_x)." ".$this->tahun_x."</td>";
      echo "</tr><tr>";
      for ($t=1; $t <=$this->jml_hari ; $t++) {
        echo "<td align='center'>".$t."</td>";
      }
      echo "</tr>";

      // create row danru
      $code2 = $this->pola_danru($this->pola_shift);
      $key2 = 0;
      echo "<tr>\n<td align='center'>1</td>\n<td>$listpkd2->nama</td>";
      echo "<input type='hidden' name=nik[] value='$listpkd2->nik'>";
      for ($p=0; $p<$this->jml_hari; $p++)
      {
        echo "<td align='center'";
        if ($code2[$key2]=="L") echo " style='background: red;'";
        echo ">".$code2[$key2]."</td>\n";
        echo "<input type='hidden' name='shift[0][]' value='$code2[$key2]' >\n";
        $key2++;
        if ($key2>=count($code2)) $key2 = 0;
      }
      if ($key2 >= count($code2)-1) $key2 = 0;
      else $key2 = $key2 + 1;
      echo "</tr>\n";

      for ($j=0; $j < $loop_pkd; $j++) {
        echo "<tr>";
        echo "<td align='center'>".($j+2)."</td>";
        echo "<td>".$namapkd[$j]."</td>";
        echo "<input type='hidden' name='nik[]' value='$nikpkd[$j]'>";
        for ($k=0; $k < $loop_hari; $k++) {
          if ($k != ($loop_hari-1) AND substr($individu[$i][$j][$k], 0, 1)=="M" AND substr($individu[$i][$j][$k+1], 0, 1)=="P") {
            echo "<td align='center' style='background: blue;'>".$individu[$i][$j][$k]."</td>";
            echo "<input type='hidden' name=shift[".($j+1)."][] value='".$individu[$i][$j][$k]."'>";
          } elseif ($k==0 && substr($individu[$i][$j][0], 0,1)!="S" && $individu[$i][$j][$k+5]=="L" && $individu[$i][$j][$k+6]=="L") {
            echo "<td align='center' style='background: yellow;'>".$individu[$i][$j][$k]."</td>";
            echo "<input type='hidden' name=shift[".($j+1)."][] value='".$individu[$i][$j][$k]."'>";
          } elseif ($k==1 AND substr($individu[$i][$j][1], 0,1)!="S" AND $individu[$i][$j][$k+5]=="L" && $individu[$i][$j][$k+6]=="L") {
            echo "<td align='center' style='background: yellow;'>".$individu[$i][$j][$k]."</td>";
            echo "<input type='hidden' name=shift[".($j+1)."][] value='".$individu[$i][$j][$k]."'>";
          } elseif ($k>=2 && $individu[$i][$j][$k-2]=="L" AND $individu[$i][$j][$k-1]=="L" AND substr($individu[$i][$j][$k], 0, 1)!="S") {
            echo "<td align='center' style='background: yellow;'>".$individu[$i][$j][$k]."</td>";
            echo "<input type='hidden' name=shift[".($j+1)."][] value='".$individu[$i][$j][$k]."'>";
          } elseif ($individu[$i][$j][$k]!= "L") {
            echo "<td align='center'>".$individu[$i][$j][$k]."</td>";
            echo "<input type='hidden' name=shift[".($j+1)."][] value='".$individu[$i][$j][$k]."'>";
          } else {
            echo "<td align='center' style='background: red;'>".$individu[$i][$j][$k]."</td>";
            echo "<input type='hidden' name=shift[".($j+1)."][] value='".$individu[$i][$j][$k]."'>";
          }
        }
        echo "</tr>";
      }
      echo "</table>\n</div>";
    }
    echo "Simpan jadwal? Jika ya, maka jadwal bulan ".$this->cetak_bulan($this->bulan_x)." ".$this->tahun_x." akan tersimpan dan <span class='bg-danger'>tidak dapat diubah.</span>&nbsp;&nbsp;";
  }

  // untuk mendapatkan nilai random 0-1
  function random_0_1() {
    $g = mt_rand(1,1000000)/1000000;
    return $g;
  }

  // untuk mencari nilai fitness
  function n_fitness($hc) {
    $a = 1+($hc);
    $fit = round((1/$a), 6);
    unset($hc);
    return $fit;
  }

  // fitness hr
  function all_fitness1($individu) {
    $fitness      = array();
    $x1           = $this->cek_shiftHR($individu); // cek harian

    for ($i=0; $i < count($individu); $i++) {
      $b = $this->n_fitness($x1[$i]);
      array_push($fitness, $b);
    }
    unset($individu, $x1);
    return $fitness;
  }

  // fitness lls dan mp
  function all_fitness2($individu) {
    $fitness      = array();
    $x1           = $this->cek_shiftLLS($individu); // cek libur libur siang
    $x2           = $this->cek_shiftMP($individu); // cek malam pagi
    // echo count($individu)." ";
    for ($i=0; $i < count($individu); $i++) {
      $a = $x1[$i] + $x2[$i];
      $b = $this->n_fitness($a);
      array_push($fitness, $b);
    }
    unset($individu,$x1,$x2);
    return $fitness;
  }

  // fitness lls, mp, dan hr
  function all_fitness3($individu) {
    $fitness  = array();
    $x1       = $this->cek_shiftLLS($individu); // testing cek libur
    $x2       = $this->cek_shiftMP($individu); // testing cek libur
    $x3       = $this->cek_shiftHR($individu); // testing cek libur

    $pjg_ind = count($individu);
    for ($i=0; $i < $pjg_ind; $i++) {
      $a = $x1[$i] + $x2[$i] + $x3[$i];
      $b = $this->n_fitness($a);
      array_push($fitness, $b);
    }
    unset($individu,$x1,$x2,$x3);
    return $fitness;
  }

  // fungsi untuk memulai roulette wheel
  function do_roullete_wheel($new_individu) {
    $new_in				= array();
    $new_poin			= array();
    $probfit      = array();
    $arr_poin_rw  = array();
    $range        = array();
    // $jum_ind 			= count($new_individu);
    $fit_masing2	= $this->all_fitness3($new_individu);
    $tot_fit      = array_sum($fit_masing2);

    for ($i=0; $i < $this->jml_ind; $i++) {
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
    for ($j=0; $j < $this->jml_ind; $j++) {
      for ($k=0; $k < $this->jml_ind; $k++) {
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
    unset($new_individu,$new_poin,$probfit,$arr_poin_rw,$range,$fit_masing2,$tot_fit);
    return $new_in;
  }

  // fungsi untuk memulai crossover
  function do_crossover($individu) {
    $new_ind_co = $individu;
    $j_ind = count($individu);
    $b3 = 0;
    $bts = count($individu[0][0])-2; // 28
    $individu_co = array();

    while ($b3 < 2) {
      for ($i=0; $i < $j_ind; $i++) {
        $op = $this->random_0_1();
        if ( $op < $this->pc) {
          $individu_co[] = $i; //mencari nilai random untuk perbandingan dgn pc
        }
        // echo $op." "; // cetak random prob mutasi
      }
      $b3 = count($individu_co); // tak tentu
    }
    // print_r($individu_co); // menentukan individu mana saja yang akan dikawinsilangkan

    $b2 = count($individu[0]); // 23

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
        for ($k=0; $k < $b2; $k++) {
          $slice = array_slice($individu[$ind_next][$k], $tp1);
          array_splice($new_ind_co[$ind_ke][$k], $tp1, count($new_ind_co[$ind_ke][$k]), $slice);

          //   // $slice2 = array_slice($individu[$ind_ke][$k], $tp1);
          //   // array_splice($new_ind_co2[$ind_next][$k], $tp1, count($new_ind_co2[$ind_next][$k]), $slice);
        }

        // multi-point crossover
        // for ($k=0; $k < $b2; $k++) {
        //   $slice = array_slice($individu[$ind_next][$k], $tp1, $tp3);
        //   array_splice($new_ind_co[$ind_ke][$k], $tp1, $tp3, $slice);
        // }
      }
    }
    // $individu = array();
    unset($individu,$j_ind,$individu_co);
    return $new_ind_co;
  }

  // fungsi untuk memulai mutasi
  function do_mutation($individu) {
    $output_array = array();
    $selected 		= array();
    $new_ind_mu 	= array();
    $j_ind = count($individu);
    $j_pkd = count($individu[0]);
    $j_hr  = count($individu[0][0]);

    for ($i = 0; $i < $j_ind; $i++) {
      for ($j = 0; $j < $j_pkd; $j++) {
        for ($k = 0; $k < $j_hr; $k++) {
          $output_array[] = $individu[$i][$j][$k];
        }
      }
    }

    $pjg 		= count($output_array); // menghitung panjang array 1 dimensi => 1500
    $jmlmut = round($this->pm * $pjg); // mengkalikan pm dgn 1500 => 15
    $ijm = 0; // isi jumlah mutasi
    while($ijm < $jmlmut) {
      $n_ran = mt_rand(0, $pjg-1); // membangkitkan nilai random 0-total panjang gen dlm populasi mutasi
      if(!in_array($n_ran, $selected)) {
        $selected[] = $n_ran; // memasukkan gen-gen terpilih ke array $selected
        $ijm += 1;
      }        
    }
    // print_r($selected);

    $jgm = count($selected); // jumlah gen yg dimutasi
    for ($m=0; $m < $jgm; $m++) {
      $isl  = $selected[$m]; // mengisi $isl dengan value pada array $selected        
      if ($output_array[$isl] != "L") {
        if ($isl > 0 && $output_array[$isl-1]=="L") {
          $output_array[$isl] = $this->gen_rand_shift("S");
        } elseif($isl < ($pjg-1) && $output_array[$isl+1]=="L") {
          $output_array[$isl] = $this->gen_rand_shift();
        } else {
          $output_array[$isl] = $this->gen_rand_shift("XM");
        }
      }
    }

    $ptg    = count($individu[0]) * count($individu[0][0]);
    $to2d 	= array_chunk($output_array, $ptg); // membuat potongan dari 3000 gen menjadi msg2 300 pcs
    $in		 	= count($to2d); // menghitung panjang $to2d => 10

    for ($h=0; $h < $in; $h++) {
      $to3d 				= array_chunk($to2d[$h], count($individu[0][0])); // membuat potongan dari 300 gen menjadi msg2 30 pcs
      $new_ind_mu[] = $to3d; // memasukan potongan2 $to3d ke array $new_ind_mu
    }
    // print_r($new_ind_mu);
    unset($individu,$output_array,$selected);
    return $new_ind_mu;
  }

  // fungsi untuk update generasi
  function do_update_generation($ind1, $ind2) { //generational model, dipilih 20 individu dgn fitness terbaik
    $new_parent = array();
    $new_parent2 = array();
    $next_new = array();
    // menggabungkan array
    $new_parent = array_merge($ind1, $ind2);
    // mengecek nilai fitness
    $fit3	= $this->all_fitness3($new_parent);

    arsort($fit3); // mengurutkan fitness terbaik, namun tidak mengubah indexnya
    $the_in = $this->jml_ind;
    $xyz = array_slice($fit3, 0, $the_in, true); // memilih 20 array teratas
    foreach ($xyz as $key => $value) {
      $next_new[] = $key;
    }

    $c_next = count($next_new);
    for ($k=0; $k < $c_next; $k++) { // memasukkan 20 array teratas berdasarkan fitnessnya
      $new_parent2[] = $new_parent[$next_new[$k]];
    }
    unset($ind1,$ind2,$new_parent,$next_new,$fit3);
    return $new_parent2;
  }

  // fungsi menjalankan seluruh proses algen
  function do_algen($gen_baru) {
    shuffle($gen_baru);
    $rw = $this->do_roullete_wheel($gen_baru);
    $co = $this->do_crossover($rw);
    $gen_now = $this->do_mutation($co);
    $gen_update = $this->do_update_generation($gen_baru, $gen_now);
    unset($gen_baru,$rw,$co,$gen_now);
    return $gen_update;
  }
} // batas class
?>
