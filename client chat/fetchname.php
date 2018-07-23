<?php 
$conn = new mysqli('localhost', 'root', '', 'auction');
$result = $conn->query("SELECT * FROM online where i_id='".$_GET['i_id']."'");
$row = $result->fetch_assoc();
echo $row['name'];
?>