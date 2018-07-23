<?php 
    
    while (true) {
        # code...
    
        $conn = new mysqli('localhost', 'root', '', 'auction');
        $result = $conn->query("SELECT *,CURRENT_TIME as ct FROM bookingview");
        while($row = $result->fetch_assoc()){
            $ct=strtotime($row['ct'])-strtotime($row['last_time']);
            if($ct>20){
                $conn->query("insert into booking values('".$row['sellerid']."','".$row['cid']."','".$row['i_id']."','".$row['price']."','unpaid')");
                $conn->query("update item set status='unpaid' where i_id='".$row['i_id']."'");
                $conn->query("delete from online where i_id='".$row['i_id']."'");

            }
            echo $ct;
            echo "<br>";
            echo $row['price'];
            echo "<br>";
        }
         
        $conn = new mysqli('localhost', 'root', '', 'auction');
        $result = $conn->query("SELECT *,CURRENT_TIME as ct,CURRENT_DATE - INTERVAL 1 DAY as cd FROM item where status='verified'");
        while($row = $result->fetch_assoc()){
        	$d1=$row['bdate'];
            $t1=$row['btime'];
            $dt=strtotime($d1.$t1);
            $ct=strtotime($row['cd'].$row['ct']);
          
        	
        	if($ct-$dt>0.00){
         	$conn->query("update item set status='unsold' where i_id='".$row['i_id']."'");
        		  echo $row['i_id'];
        		echo "<br>";	
        		echo ($ct-$dt)/(3600*24);
        		echo "<br>";
        		}
        }
        sleep(2);
    }
    //for running script
    //cd C:\xampp\php
    //php.exe ..\..\xampp\htdocs\olx\script.php
?>