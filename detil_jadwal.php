<?php
$kd_jdw = $_GET['idjdw'];
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename='$kd_jdw.xls'");//ganti nama sesuai keperluan

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
// echo "<pre>";
// print_r($jadwal);
// echo "</pre>";
?>
<html>
<head>
	<title>jadwal bulan ini</title>
	<!-- <link rel="stylesheet" type="text/css" href="dist/css/detiltabel.css"> -->
	<style type="text/css">
	.tab-ok {
		font-size: 10px;
		font-family: 'Tahoma', 'Verdana', 'Trebuchet MS';
		/*border-collapse: collapse;*/
		border-color: black;
		text-align: center;
		/*padding: 1px;*/

	}
	.red {
		background-color: red;
	}
	/*table, td {
		padding: 3.5px;
		}*/
		</style>
	</head>
	<body>
		<table class="tab-ok">
			<tr>
				<!-- <td width="200px" colspan="4"><img src="dist/img/logo-kcj.png" width="100px"></td> -->
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="28"><h2>JADWAL DINASAN PETUGAS PAM STASIUN SUDIMARA</h2></td>
			</tr>
		</table>

		<table border="1"  class="tab-ok">
			<tr>
				<th rowspan="2">No.</th>
				<th rowspan="2">NAMA</th>
				<th rowspan="2">JABATAN	</th>
				<th rowspan="2">NIK</th>
				<?php
				include_once 'class_konversi.php';
				$getd = new Konversi();
				echo "<th colspan='".count($jadwal[0])."'>Bulan ".$getd->cetak_bulan(substr($kd_jdw, 1,2))." ".substr($kd_jdw, 3,4)."</th>";
				echo "<th rowspan='2'>HADIR</th></tr><tr>";
				for ($j=0; $j < count($jadwal[0]); $j++) { 
					echo "<th>".($j+1)."</th>";
				}
				?>				
			</tr>	
			<?php 
			for ($k=0; $k < count($nikpkd); $k++) { 
				$data_pkd = explode("-", $getd->nama_pkd($nikpkd[$k]));
				echo "<tr>";
				echo "<td>".($k+1)."</td>";
				echo "<td>".$data_pkd[0]."</td>";
				echo "<td>".$data_pkd[1]."</td>";
				echo "<td>$nikpkd[$k]</td>";
				for ($l=0; $l < count($jadwal[0]); $l++) { 
					echo "<td ";
					if ($jadwal[$k][$l]=="L") {
						echo "class='red'";
						// echo "style='background: red;'";
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
			echo "</table>\n<table class='tab-ok'>";
		// echo "<pre>";
		// print_r($arr_libur);
		// echo "</pre>";

			echo "<tr><td></td>\n<td></td>\n<td></td>\n<td>PAGI</td>";
			foreach ($arr_pagi as $keypagi) {
				echo "<td>$keypagi</td>";
			}
			echo "</tr>";

			echo "<tr><td></td>\n<td></td>\n<td></td>\n<td>SIANG</td>";
			foreach ($arr_siang as $keysiang) {
				echo "<td>$keysiang</td>";
			}
			echo "</tr>";

			echo "<tr><td></td>\n<td></td>\n<td></td>\n<td>MALAM</td>";
			foreach ($arr_malam as $keymalam) {
				echo "<td>$keymalam</td>";
			}
			echo "</tr>";

			echo "<tr><td></td>\n<td></td>\n<td></td>\n<td>LIBUR</td>";
			foreach ($arr_libur as $keylibuar) {
				echo "<td>$keylibuar</td>";
			}
			echo "</tr>";

			?>
		</table><br>
		<table  class="tab-ok">
			<tr>
				<td></td>
				<td>
					<table border="1"  class="tab-ok">
						<tr><td colspan="3">KETERANGAN</td></tr>
						<tr>
							<td>P1 / S1 / M1</td>
							<td colspan="2">GATE BAWAH</td>
						</tr>
						<tr>
							<td>P2 / S2 / M2</td>
							<td colspan="2">GATE ATAS</td>
						</tr>
						<tr>
							<td>PC / SC</td>
							<td colspan="2">CROSSINGAN</td>
						</tr>
						<tr>
							<td>PP / SP</td>
							<td colspan="2"><i>PERON (PATROLI)</i></td>
						</tr>
						<tr>
							<td>L</td>
							<td colspan="2">LIBUR</td>
						</tr>

					</table>
				</td>

				<td></td>

				<td>
					<table BORDER="1"  class="tab-ok">
						<tr>
							<td colspan="7">DIBUAT OLEH</td>
							<td colspan="21">MENGETAHUI</td>
						</tr>
						<tr>
							<td colspan="7" rowspan="4"></td>
							<td colspan="7" rowspan="4"></td>
							<td colspan="7" rowspan="4"></td>
							<td colspan="7" rowspan="4"></td>
						</tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr>
							<td colspan="7">DANRU</td>
							<td colspan="7">DANWIL</td>
							<td colspan="7">SVP/STAFF STASIUN</td>
							<td colspan="7">KEPALA STASIUN</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<!-- // <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
		<!-- // <script src="plugins/jQueryUI/jquery-ui.min.js"></script> -->
		<!-- // <script src="bootstrap/js/bootstrap.min.js"></script> -->
	</body>
	</html>
	<?php exit(); ?>