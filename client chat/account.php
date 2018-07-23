<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .row.content {height: 1500px}
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>


<body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="buyer.php">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart </a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

          </ul>
        </div>
      </div>
    </nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-4 sidenav">
      <h3>Account Details:</h3>
      	<?php
      		session_start();
          if(!isset($_SESSION['cname'])){header('Location:login.php');}

			$conn = new mysqli('localhost', 'root', '', 'auction');
			$result = $conn->query("SELECT * FROM customer where cid='".$_SESSION['cid']."'");
			$row = $result->fetch_assoc();
			echo '<div class="well">';
			echo "<h4>Name : ".$row['cname'];
			echo "<br>Email : ".$row['email'];
			echo "<br>Phone number: ".$row['mobile'];
			echo "<br>Address: ".$row['address'];
			echo "</h4></div>";

		?>
		<a href="updateAccount.php"><span class="glyphicon glyphicon-pencil"></span> Edit Details</a>
    </div>

    <div class="col-sm-5">
      <h4>Purchase history</h4>
      <hr>
      		<?php  

			$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
			$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql1="select * from cart where  status='paid' and buyerid='". $_SESSION['cid'] ."'";
			$result1=$dbhandler->query($sql1);
			while ($rows=$result1->fetch()){
			
			$name=$rows['i_id'];
			$tmp="images/products/".$name.".jpg";
			echo "<div class='well'>
			      <h4>Product Name: ".$rows['p_name']."
			        <br><br><img id='imgCaptcha' src='$tmp' style='width:50%'/>
			    ";
			//echo '<div class="col-sm-4 text-left sidenav"> ';
			echo '<div class="well">';
			//echo "Seller's Name : ".$rows['cid'];
			
			echo "Description: ".$rows['description'];
			echo "<br>Price: ".$rows['price'];
			echo "</div></h4></div>";
			}	
		?>

      	<br><br>
      	<h4>Post item</h4>
      	<hr>
     		<?php  

			$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
			$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql1="select * from item where cid='". $_SESSION['cid'] ."'";//status='sold' and
			$result1=$dbhandler->query($sql1);
			while ($rows=$result1->fetch()){
			
			$name=$rows['i_id'];
			$tmp="images/products/".$name.".jpg";
			echo "<div class='well'>
			      <h4>Product Name: ".$rows['p_name']."
			        <br><br><img id='imgCaptcha' src='$tmp' style='width:50%'/>
			    ";
			//echo '<div class="col-sm-4 text-left sidenav"> ';
			echo '<div class="well">';
			echo "Description: ".$rows['description'];	
			echo "<br>Status: ".$rows['status'];
			echo "<br>Price: ".$rows['price'];
			echo "</div></h4></div>";
			}	
		?>


      	<hr>
      <h4>Leave a Comment:</h4>
      <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
      <br><br>
      
      <p><span class="badge">2</span> Comments:</p><br>
      
      <div class="row">

        <div class="col-sm-10">
          <h4>Anja <small>Sep 29, 2015, 9:12 PM</small></h4>
          <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <br>
        </div>

        <div class="col-sm-10">
          <h4>John Row <small>Sep 25, 2015, 8:25 PM</small></h4>
          <p>I am so happy for you man! Finally. I am looking forward to read about your trendy life. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <br>
          <p><span class="badge">1</span> Comment:</p><br>
          <div class="row">

            <div class="col-xs-10">
              <h4>Nested Bro <small>Sep 25, 2015, 8:28 PM</small></h4>
              <p>Me too! WOW!</p>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
