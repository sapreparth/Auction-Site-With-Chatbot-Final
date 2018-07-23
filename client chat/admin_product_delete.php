<?php
    session_start();
    if(isset($_SESSION['cname'])){
        try{
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $i_id=$_POST['i_id'];
        $_SESSION['i_id']=$i_id;

        $sql1="delete from item where i_id='". $i_id ."'";
        $dbhandler->query($sql1);
        }
        catch(PDOException $ex)
        {
            $ex->getMessage();  
            echo " catch";
            header("Location:admin.php");
            die();
        }
        //echo "end";
        header("Location:admin.php");
   }
   else
   {
       header("Location:login.php?msg=Please login first");
    }
?>