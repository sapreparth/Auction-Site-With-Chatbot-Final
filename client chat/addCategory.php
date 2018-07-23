<?php
$cat=$_POST['cat'];

$conn = new mysqli('localhost', 'root', '', 'auction');
$result = $conn->query("insert into category values (null,'".$cat."')");
header('Location:admin.php');

?>