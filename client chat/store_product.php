<?php
    session_start();
    
    $cid=$_SESSION['cid'];
    $price=$_POST['price'];
    $pname=$_POST['pname'];
    $des=$_POST['des'];
    $date=$_POST['date'];
    $time=$_POST['time'].':00';
    $cat_id=$_POST['cat_id'];
    echo $time;
    echo $cid;
    echo $price;
    echo $pname;
    echo $des;
    echo $date;
    echo $cat_id;

    if(isset($_SESSION['cname']))//isset($_SESSION['cname'])
    {
        try {
            
            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="insert into item values (null,'$cat_id','$cid','$price','$pname','$des','$date','$time','pending')";
            $query=$dbhandler->query($sql);
            echo "Your product has been Posted Successfully"; 

            $conn = new mysqli('localhost', 'root', '', 'auction');
            $result = $conn->query("SELECT * FROM item");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $pic=$row['i_id'];
                }
            }

            echo "<br>"."<a href='buyer.php'>HOME</a>";
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }
    }
    else
    {
        header("location:login.php?msg=PLEASE LOGIN FIRST");
    }

  $target_dir = "images/products/";
  $target_file = $target_dir . $pic.'.jpg';

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  } else {
      echo "Sorry, there was an error uploading your file.";
  }
  header('Location:buyer.php');
?>