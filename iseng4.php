<?php 
$kd_jdw = "J042019";

$nikpkd = array();
$jadwal = array();
$rincian = array();
$hadir = 0;
$mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
$kueri = $mysqli->query("SELECT DISTINCT nik FROM detil_jadwal WHERE id_jadwal='$kd_jdw'");
while ($res = $kueri->fetch_assoc()) {
	$nikpkd[] = $res['nik'];
}

for ($i=0; $i < count($nikpkd); $i++) { 
	$kueri2 = $mysqli->query("SELECT shift FROM detil_jadwal WHERE id_jadwal='$kd_jdw' AND nik='$nikpkd[$i]'");
	while ($res2 = $kueri2->fetch_assoc()) {
		$jadwal[$i][] = $res2['shift'];
		// $jadwal[$nikpkd[$i]][] = $res2['shift'];
	}
}

function fitLLS($new_ind) {
	$loop_pkd = count($new_ind);
	$loop_hr = count($new_ind[0]);
	$pnl= 0;
	$hc_ind = array();
	
		for ($j=0; $j < $loop_pkd; $j++) {
			for ($k=0; $k < $loop_hr; $k++) {
          // $ceksiang = substr($new_ind[$i][$j][$k+2], 0,1);
				if ($k==0 && substr($new_ind[$j][0], 0,1)!="S" && $new_ind[$j][$k+5]=="L" && $new_ind[$j][$k+6]=="L") $pnl += 1;
				elseif ($k==1 && substr($new_ind[$j][1], 0,1)!="S" && $new_ind[$j][$k+5]=="L" && $new_ind[$j][$k+6]=="L") $pnl += 1;
          // elseif ($new_ind[$i][$j][$k]=="L" AND $new_ind[$i][$j][$k+1]=="L" AND $ceksiang!="S") $pnl += 1;
			}
		}
		array_push($hc_ind, $pnl);
		// $pnl = 0;
	// return $hc_ind;
	return $pnl;
}

function fitMP($new_ind) {
	$loop_pkd = count($new_ind);
	$loop_hr = count($new_ind[0])-1;
	$pnl = 0;
	$hc_ind = array();
		for ($j=0; $j < $loop_pkd; $j++) {
			for ($k=0; $k < $loop_hr; $k++) {
				$kini = substr($new_ind[$j][$k], 0,1);
				$esok = substr($new_ind[$j][$k+1], 0,1);
				if ($kini=="M" AND $esok=="P") $pnl += 1;
				// elseif ($kini=="M" AND $esok=="M") $pnl += 1;
			}
		}
		array_push($hc_ind, $pnl);
		// $pnl = 0;
	// return $hc_ind;
	return $pnl;

}

function fitHR($new_ind) {
	$loop_pkd = count($new_ind);
	$loop_hr = count($new_ind[0]);
	$hc_ind = array();
	$hc_hari = 0;
	$hc_p1 = 0;   $hc_s1 = 0;   $hc_m1 = 0;
	$hc_p2 = 0;   $hc_s2 = 0;   $hc_m2 = 0;
	$hc_pc = 0;   $hc_sc = 0;   $hc_pp = 0;
	$hc_sp = 0;

		for ($w=0; $w < $loop_hr; $w++) {
			for ($e=0; $e < $loop_pkd; $e++) {
				$isi_gen = $new_ind[$e][$w];
				switch ($isi_gen) {
					case 'P1': $hc_p1 += 1;
					break;
					case 'S1': $hc_s1 += 1;
					break;
					case 'M1': $hc_m1 += 1;
					break;
					case 'P2': $hc_p2 += 1;
					break;
					case 'S2': $hc_s2 += 1;
					break;
					case 'M2': $hc_m2 += 1;
					break;
					case 'PC': $hc_pc += 1;
					break;
					case 'SC': $hc_sc += 1;
					break;
					case 'PP': $hc_pp += 1;
					break;
					case 'SP': $hc_sp += 1;
					break;
					default:
					break;
				}
			}

			if ($hc_p1 < 1 OR $hc_p1 > 2) $hc_hari += 1; 
			if ($hc_s1 < 1 OR $hc_s1 > 2) $hc_hari += 1; 
			if ($hc_m1 < 1 OR $hc_m1 > 1) $hc_hari += 1; 
			if ($hc_p2 < 1 OR $hc_p2 > 2) $hc_hari += 1; 
			if ($hc_s2 < 1 OR $hc_s2 > 2) $hc_hari += 1; 
			if ($hc_m2 < 1 OR $hc_m2 > 1) $hc_hari += 1; 
			if ($hc_pc < 1 OR $hc_pc > 1) $hc_hari += 1; 
			if ($hc_sc < 1 OR $hc_sc > 1) $hc_hari += 1; 

			if ($hc_pp < 1 OR $hc_pp > 3) $hc_hari += 1; 
			if ($hc_sp < 1 OR $hc_sp > 2) $hc_hari += 1; 

			if($w==6) {
				echo $hc_m1." - ";
				echo $hc_m2." - ";
				echo $hc_hari;
			}

			$hc_p1 = 0;   $hc_s1 = 0;   $hc_m1 = 0;
			$hc_p2 = 0;   $hc_s2 = 0;   $hc_m2 = 0;
			$hc_pc = 0;   $hc_sc = 0;   $hc_pp = 0;
			$hc_sp = 0;   
		}
		array_push($hc_ind, $hc_hari);
		// $hc_hari = 0;
	// return $hc_ind;
	return $hc_hari;
}

  // untuk mencari nilai fitness
function n_fitness($hc) {
	$a = 1+($hc);
	$fit = round((1/$a), 6);
	return $fit;
}
// fitness lls, mp, dan hr
function all_fitness3($individu) {
	$fitness  = array();
  $x1       = fitLLS($individu); // testing cek libur
  $x2       = fitMP($individu); // testing cek libur
  $x3       = fitHR($individu); // testing cek libur

  	$a = $x1 + $x2 + $x3;
  	$b = n_fitness($a);
  	array_push($fitness, $b);
  return $fitness;
}

$aj = array_shift($jadwal);

// include_once 'class_algen.php';
// $cAlgen = new Algen();
$fit = all_fitness3($jadwal);
echo "<pre>";
print_r($fit);
echo "</pre>";

echo "<pre>";
// echo count($jadwal[0]);
print_r($jadwal);
echo "</pre>";
?>