<?php

$start = microtime(true);
set_time_limit(3000);
include_once("class_algen.php");

$saya = new Hairil();
$gen_baru = $saya->gen_array_ind();

$gen_now = array();

  $aa = 0;
  $bb = 0;
  do {

    $rw = $saya->do_roullete_wheel($gen_baru);
    $op = $saya->do_crossover($rw);
    $gen_now = $saya->do_mutation($op); // melakukan mutasi
    $gen_update = $saya->do_update_generation($gen_baru, $gen_now);

    $a1 = $saya->cek_shift31($gen_update);
    $a2 = $saya->cek_min_jaga($gen_update);
    $a3 = $saya->gabung_fitness($a1, $a2, count($gen_update));

    for ($j=0; $j < count($gen_update); $j++) {
      if ($a3[$j] >= 0.9) {
        $aa = 1;
        break;
      }
    }
    $gen_baru = array();
    $gen_baru = $gen_update;
    $bb++;

} while ($bb<=1000 && $aa != 1);
  echo "<br>".$bb."<br>";

  echo "<pre>";
  print_r($a3);
  echo "</pre>";

$saya->cetak_individu_31($gen_now);


$end = microtime(true);
$time = number_format(($end - $start), 4);

echo 'This page loaded in ', $time, ' seconds';

?>
