<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		session_start();
		$p=$_POST['price'];
		$i=$_POST['i_id'];
		$c=$_SESSION['cid'];
		$name=$_SESSION['cname'];	 	

        $conn = new mysqli('localhost', 'root', '', 'auction');
        $result = $conn->query("SELECT * FROM online where i_id='".$i."'");
		if ($result->num_rows > 0) {
		    echo'yes';
		    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
	        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	        $query=$dbhandler->query("UPDATE online set last_time=CURTIME(), price='". $p ."' ,name='". $name ."',cid='" .$c. "'  WHERE i_id='". $i ."'");
	        
		}
		else{
			echo 'no';
			$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
	        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
			$query=$dbhandler->query("UPDATE item set status='running'  WHERE i_id='". $i ."'");
			$result = $conn->query("INSERT INTO  online (`i_id`,`cid`,`name`,`price`,`status`,`last_time`) VALUES ('" .$i. "','" .$c. "','" .$name. "','" .$p. "','running',CURTIME())");
		}

	?>

	<form action="product.php" method="post" id="form">
          <input type='hidden' name='i_id' value="<?php echo $_POST['i_id']?>">
          <input type="submit">
    </form>
	<script type="text/javascript">
    	document.getElementById("form").submit(); // SUBMIT FORM
	</script>
</body>
</html>