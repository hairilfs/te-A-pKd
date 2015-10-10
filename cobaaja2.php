<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <style>
  td {
    padding: 3px;
    min-width: 20px;
    line-height: 20px;
    text-align: center;
    font: 11px Tahoma;
  }
  td.red {
    background: red;
    color: #fff;
  }
  </style>
</head>
<body>

  <?php
  $column = 31;
  $row = 22;
  $code = array('S2','PC','P2','SP','M2','L','L'); // 7

  function gen_rand_shift() {
    $a = array("P1", "S1", "M1", "P2", "S2", "M2", "PC", "SC", "PP", "SP");
    shuffle($a);
    $random = array_rand($a,1);

    return $a[$random];
  }

  // create table
  echo "<table cellpadding='0' cellspacing='0' border='1'>";

  // create table header
  echo "<tr>\n<td>No</td>\n";
  for ($c=1; $c<=$column; $c++)
  {
    echo "<td>$c</td>\n";
  }
  echo "</tr>\n";

  // create row
  $key = 0;
  for ($r=1; $r<=$row; $r++)
  {
    echo "<tr>\n<td>$r</td>\n";

    for ($c=1; $c<=$column; $c++)
    {
      echo "<td";
      if ($code[$key]=="L") {
        echo " class='red'";
        echo ">$code[$key]</td>\n";
      } else {

      echo ">".gen_rand_shift()."</td>\n";
      }
      $key++;
      if ($key>=count($code)) $key = 0;
    }
    // if ($key-2 <0) $key = count($code) + $key - 2;
    // else $key = $key - 2;
    echo "</tr>\n";
  }

  echo "</table>";
  ?>

  </body>
  </html>
