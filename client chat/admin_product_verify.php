<?php
    session_start();
    if(isset($_SESSION['cname'])){
        try{
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $i_id=$_POST['i_id'];
        $_SESSION['i_id']=$i_id;

        $sql1="UPDATE item set status='verified' where i_id='". $i_id ."'";
        $dbhandler->query($sql1);
        }
        catch(PDOException $ex)
        {
            $ex->getMessage();  
            header("Location:admin.php");
            die();
        }
        header("Location:admin.php");
   }
   else
   {
       header("Location:login.php?msg=Please login first");
    }
?>