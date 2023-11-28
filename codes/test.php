<?php 

$data = "1671977957.jpg";
//$command = escapeshellcmd("'C:\xampp\htdocs\result.py' .$data'");
$out=shell_exec("python final.py $data");
echo $out;
?>
