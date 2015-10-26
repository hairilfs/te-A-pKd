<?php
  include_once 'class_algen.php';

  $cons = new Hairil();
  $genbaru = $cons->gen_array_ind();
  $rw = $cons->do_roullete_wheel($genbaru);
echo "<pre>";
  // print_r($rw);
echo "</pre>";

  $cons->cetak_individu_biasa($rw);
  // $co = $cons->do_crossover($rw);
  // $gen_now = $cons->do_mutation($co); // melakukan mutasi
  // $gen_update = $cons->do_update_generation($genbaru, $gen_now);
?>
