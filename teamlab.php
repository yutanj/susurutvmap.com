<?php
echo 'teamlab';
/* 1問目
$array = array(1, 0, 5);
for ($i = 4; $i <=29; $i++) {
  # code...
  $sum = array_sum($array);
  echo $i;
  echo "<br />";
  echo $sum;
  echo "<br />";
  $split = array_splice($array, 0, 1);
  array_push($array, $sum);
  //print_r($array);
}
*/

/* 2問目
$sum = 0;
for ($i = 1; $i <= 100; $i++) {
  $pow = $i * $i * $i * $i;
  $sum += $pow;
}
echo $sum;
*/

/* 3問目
$sum = 0;
for ($i = 1; $i < 100000; $i++) {
  $gsum = 1 / $i;
  $sum += $gsum;
  if($sum >= 12){
    echo $sum;
    echo "<br />";
    echo $i;
    exit;
  }
}
*/

$array = range(600, 1);

$sum = 0;
$track = 0;
for ($i = 0; $i < 13; $i++) {
  # code...
  if(5000 - $sum >= $array[$i]){
    $sum += $array[$i];
} elseif(5000 - $sum <= $array[$i]){
    $track +=1 ;
    $index = array_search($array[$i], $array);
    for ($j = 0; $j < $index; $j++) {
      array_shift($array);
    }
    break;
}
echo $sum;
echo "<br />";
}

 ?>
