<?php
  include_once 'class_algen.php';
  $algen = new Hairil(12,2015);

  $ind = $algen->gen_array_ind();
  $algen->cetak_individu_biasa($ind,1);

  $danru = $algen->jadwal_danru();

  array_unshift($ind[0], $danru);

  echo "<pre>";
  // print_r($danru);
  // print_r($gabung);
  print_r($ind[0]);
  echo "</pre>";
?>
