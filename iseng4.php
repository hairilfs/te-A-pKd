<?php
$nikpkd = array();
$jadwal = array();
$rincian = array();
$hadir = 0;
$mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
$kueri = $mysqli->query("SELECT DISTINCT nik FROM detil_jadwal WHERE id_jadwal='J102017'");
while ($res = $kueri->fetch_assoc()) {
	$nikpkd[] = $res['nik'];
}

for ($i=0; $i < count($nikpkd); $i++) { 
	$kueri2 = $mysqli->query("SELECT shift FROM detil_jadwal WHERE id_jadwal='J102017' AND nik='$nikpkd[$i]'");
	while ($res2 = $kueri2->fetch_assoc()) {
		$jadwal[$i][] = $res2['shift'];
		// $jadwal[$nikpkd[$i]][] = $res2['shift'];
	}
}
// echo "<pre>";
// print_r($jadwal);
// echo "</pre>";
?>
<html>
<head>
	<title>jadwal bulan ini</title>
</head>
<body>
	<table border='1' style='border-collapse: collapsed;'>
		<tr>
			<th>No.</th>
			<th>NIK</th>
			<?php 
			for ($j=0; $j < count($jadwal[0]); $j++) {
				echo "<th>".($j+1)."</th>";
			}
			?>
			<th>Hadir</th>
		</tr>	
		<?php 
		for ($k=0; $k < count($nikpkd); $k++) { 
			echo "<tr>";
			echo "<td>".($k+1)."</td>";
			echo "<td>$nikpkd[$k]</td>";
			for ($l=0; $l < count($jadwal[0]); $l++) { 
				echo "<td ";
				if ($jadwal[$k][$l]=="L") {
					echo "style='background: red;'";
					echo ">".$jadwal[$k][$l]."</td>";
				} else {
					echo ">".$jadwal[$k][$l]."</td>";
				}
				if ($jadwal[$k][$l] != "L") {
					$hadir += 1;
				}
			}
			echo "<td>$hadir</td>";
			echo "</tr>";
			$hadir = 0;
		}

		$pagi = 0;
		$siang = 0;
		$malam = 0;
		$libur = 0;
		$arr_pagi = array();
		$arr_siang = array();
		$arr_malam = array();
		$arr_libur = array();
		for ($m=0; $m < count($jadwal[0]); $m++) { 
			for ($n=0; $n < count($nikpkd); $n++) { 
				if (substr($jadwal[$n][$m], 0,1)=="P") {
					$pagi += 1;
				} elseif (substr($jadwal[$n][$m], 0,1)=="S") {
					$siang += 1;
				} elseif (substr($jadwal[$n][$m], 0,1)=="M") {
					$malam += 1;
				} elseif (substr($jadwal[$n][$m], 0,1)=="L") {
					$libur += 1;
				}
			}
			$arr_pagi[] = $pagi;
			$arr_siang[] = $siang;
			$arr_malam[] = $malam;
			$arr_libur[] = $libur;
			$pagi = 0;
			$siang = 0;
			$malam = 0;
			$libur = 0;
		}
		// echo "<pre>";
		// print_r($arr_libur);
		// echo "</pre>";

		echo "<tr><td colspan='2'>Pagi</td>";
		foreach ($arr_pagi as $keypagi) {
			echo "<td>$keypagi</td>";
		}
		echo "</tr>";

		echo "<tr><td colspan='2'>Siang</td>";
		foreach ($arr_siang as $keysiang) {
			echo "<td>$keysiang</td>";
		}
		echo "</tr>";

		echo "<tr><td colspan='2'>Malam</td>";
		foreach ($arr_malam as $keymalam) {
			echo "<td>$keymalam</td>";
		}
		echo "</tr>";

		echo "<tr><td colspan='2'>Libur</td>";
		foreach ($arr_libur as $keylibuar) {
			echo "<td>$keylibuar</td>";
		}
		echo "</tr>";

		?>
	</table>
</body>
</html>
