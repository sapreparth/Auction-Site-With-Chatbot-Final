<?php 
$conn = new mysqli('localhost', 'root', '', 'auction');
$result = $conn->query("SELECT *,CURRENT_TIME as ct FROM bookingview");
while($row = $result->fetch_assoc()){
    $ct=strtotime($row['ct'])-strtotime($row['last_time']);
    if($ct>(15*60){
        $conn->query("insert into booking values('".$row['sellerid']."','".$row['cid']."','".$row['i_id']."','".$row['price']."','unpaid')");
        $conn->query("update item set status='soldout' where i_id='".$row['i_id']."'");
        $conn->query("delete from online where i_id='".$row['i_id']."'");

    }
    echo $ct;
    echo "<br>";
    echo $row['price'];
    echo "<br>";
}
?>