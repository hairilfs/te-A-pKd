<?php
for($i=0;$i<=9;$i++){
  for($j=0;$j<=$i;$j++){
    echo "*&nbsp;";
  }
  echo "<br>";
}

echo "<br><br>";

for($i=0;$i<=6;$i++){
  for($j=6-$i;$j>=0;$j--){
    if ($j==1 || $j==0) {
      echo "L&nbsp;";
    } else {
      echo "O&nbsp;";
    }

  }
  echo "<br>";
}

$f = 5;
$g = 10;
$h = 20;

if ($f < $g) {
  echo "g lebih besar";
} elseif ($f < $h) {
  echo "h lebih besar";
} elseif ($h > $f) {
  echo "h lebih besar";
}

?>
