<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <style>
  td {
    padding: 2px;
    /*min-width: 20px;*/
    line-height: 20px;
    text-align: center;
    font: 12px Tahoma;
  }
  td.red {
    background: red;
    color: #fff;
  }
  .fit{
    width: 20px !important;
    margin: 0;
    padding: 0;
    border: none;
  }
  </style>
</head>
<body>

  <?php
  $mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
  $ang = array();
  $kueri = $mysqli->query("SELECT nik FROM pkd WHERE jabatan='ANGGOTA';");
  while($res = $kueri->fetch_object()) {
    array_push($ang, $res->nik);
  }
  $column = 28;
  $row = 22;
  $code = array('SP','PC','P2','SP','M2','L','L'); // 7
  $code2 = array('L','S','P','S','P','S','L'); // 7

  function gen_rand_shift() {
    $a = array("P1", "S1", "M1", "P2", "S2", "M2", "PC", "SC", "PP", "SP");
    shuffle($a);
    $random = array_rand($a,1);

    return $a[$random];
  }

  // create table
  echo "<form method='post' action='cobaaja3.php' target='_blank'>";
  echo "<table cellpadding='0' cellspacing='0' border='1'>";

  // create table header
  echo "<tr>\n<td>No</td>\n<td>Nama</td>\n";
  for ($c=1; $c<=$column; $c++)
  {
    echo "<td>$c</td>\n";
  }
  echo "</tr>\n";

  // create row danru
  $key2 = 0;
  echo "<tr>\n<td>1</td>\n<td>11-11-5-1111</td>";
  for ($k=1; $k<=$column; $k++)
  {
    echo "<td";
    if ($code2[$key2]=="L") {
      echo " class='red'";
      echo "><input type='text' class='fit' name='tgl[".$k."][]' value='$code2[$key2]' readonly></td>\n";
    } else {

      echo "><input type='text' class='fit' name='tgl[".$k."][]' value='".gen_rand_shift()."' readonly></td>\n";
    }
    $key2++;
    if ($key2>=count($code2)) $key2 = 0;
  }
  if ($key2 >= count($code2)-1) $key2 = 0;
  else $key2 = $key2 + 1;
  echo "</tr>\n";

  // create row anggota
  $key = 0;
  for ($r=1; $r<=$row; $r++)
  {
    $ang2 = $ang[$r-1];
    echo "<tr>\n<td>".($r+1)."</td>\n<td><input type='text' name='nama[]' value='$ang2' readonly></td>\n";

    for ($y=1; $y<=$column; $y++)
    {
      echo "<td";
      if ($code[$key]=="L") {
        echo " class='red'";
        echo "><input type='text' class='fit' name='tgl[".$r."][]' value='$code[$key]' readonly></td>\n";
      } else {

        echo "><input type='text' class='fit' name='tgl[".$r."][]' value='".gen_rand_shift()."' readonly></td>\n";
      }
      $key++;
      if ($key>=count($code)) $key = 0;
    }
    if ($key >= count($code)-1) $key = 0;
    else $key = $key + 1;
    // $key = $key + 1;
    echo "</tr>\n";
  }

  echo "</table>";
  echo "<input type='submit' name='saveshift' value='simpan'>";
  echo "</form>";
  // echo $key;
  ?>
</body>
</html>
