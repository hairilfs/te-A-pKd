<?php
// $arr1 = array('ani', 'budi', 'ratna', 'mardi', 'ira');
// $arr2 = array('udin', 'deni', 'abdul', 'edo', 'sanusi');
$arr1 = array(1,2,3,4,5,6,7,8,9,10);
$arr2 = array(11,12,13,14,15,16,17,18,19,20);

$bts = count($arr1);
$r1 = mt_rand(1, $bts-1);
$r2 = mt_rand($r1+1, $bts);
$r3 = $r2-$r1;

echo $r1." ";
echo $r2." ";
echo $r3." <br/>";

print_r($arr1);
echo "<br/>";
print_r($arr2);
echo "<br/><br/>";
$slice = array_slice($arr2, $r1, $r3); // diambil abdul dan edo
array_splice($arr1, $r1, $r3, $slice); // mengganti ratna dan mardi dengan abdul dan edo
print_r($arr1);

?>
