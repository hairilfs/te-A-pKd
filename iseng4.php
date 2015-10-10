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
?>
