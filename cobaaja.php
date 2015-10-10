<?php
  $a = 0;
  while ($a <= 10) {
    if ($a == 0) {
      echo $a;
      $a+=2;
    } elseif($a!=0) {
      echo $a." " ;
      $a+=3;
    }
  }
?>
