<?php
  include_once 'class_algen.php';
  $algen = new Hairil(12,2015);

  $input_array = $algen->gen_array_ind();

  $a = array_2d_to_1d($input_array);
  function array_2d_to_1d($input_array) {
      $output_array = array();
      for ($i = 0; $i < count($input_array); $i++) {
        for ($j = 0; $j < count($input_array[$i]); $j++) {
          for ($k = 0; $k < count($input_array[$i][$j]); $k++) {
            $output_array[] = $input_array[$i][$j][$k];
          }
        }
      }
      return $output_array;
  }

  echo "<pre>";
  print_r($input_array);
  print_r($a);
  echo "</pre>";
?>
