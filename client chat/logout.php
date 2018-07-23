<?php
	session_start();
	unset($_SESSION['cid']);
	unset($_SESSION['cname']);
	unset($_SESSION['aid']);
	header('Location:buyer.php');	
?>