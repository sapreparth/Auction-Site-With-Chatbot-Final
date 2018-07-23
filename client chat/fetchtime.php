<?php 
$conn = new mysqli('localhost', 'root', '', 'auction');
$result = $conn->query("SELECT *,CURRENT_TIME as ct FROM online where i_id='".$_GET['i_id']."'");
$row = $result->fetch_assoc();
$ct=strtotime($row['ct'])-strtotime($row['last_time']);
$ct=20-$ct;

$min=floor($ct/60);
$sec=$ct%60;
//echo "<br>Remaining Time->0:0";
echo "<br>Remaining Time->".$min.":".$sec;
?>