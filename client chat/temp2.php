<?php 
while(){
sleep(2)

$conn = new mysqli('localhost', 'root', '', 'test');
$result = $conn->query("insert into temp values (null,'as')");


}
?>