<html>
    <head><link rel="stylesheet" href="css/product.css">
          <script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
              <a class="navbar-brand" href="#">Logo</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="account.php"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
              </ul>
            </div>
          </div>
        </nav>

      
        <?php
            session_start();

            if(isset($_SESSION['cname']))
           {    

                try
                {
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                $i_id=$_POST['i_id'];
                $_SESSION['i_id']=$i_id;



                $sql1="select * from item where i_id='".$i_id."'";
                $result1=$dbhandler->query($sql1);
                $rows=$result1->fetch();
                    
                echo "<div class=container-fluid text-center'><div class='row content'>";
                $name=$rows['i_id'];
                $tmp="images/products/".$name.".jpg";
                echo "<div class='col-sm-5 sidenav'>
                        <img id='imgCaptcha' src='$tmp' style='width:100%'  />
                        <h2 style='text-align:center' id='demo'></h2>
                      </div>";

                echo '<div class="col-sm-6 sidenav"> ';
                echo '<h4>';
                echo  "Seller's Name : ".$rows['cid']."<br> Category : ".$rows['cat_id']."<br>";
                echo"Base Price: ".$rows['price']."<br>Product Name: ".$rows['p_name']."<br>";
                echo "Description: ".$rows['description']."<br>";
                echo "</h4>";
               

                $d1=$rows['bdate'];
                $t1=$rows['btime'];
                $d1=strtotime($d1.$t1);
                     
               
                echo "<br><br>";
                
                echo'<h3><text id ="n1"></text>';
                echo'<text id ="name"></text></h3>';
                echo'<h3><text id ="p1">current price: </text>';
                echo'<text id="price">Baseprice</text></h3>';

                }
                catch(PDOException $ex)
                {
                    $ex->getMessage();	
                    die();
                }
           }
           else
           {
               header("Location:login.php?msg=Please login first");
            }
        ?>

        <form action="bidPrice.php" method="post" name="myForm" onsubmit="return validateForm()" >
          <h1><input id="t1" rows="1" cols="20" name="price" type="hidden" >
            <br/>
            <input  id="bt1" type="hidden" >
            <input type='hidden' name='i_id' value="<?php echo $_POST['i_id']?>">
          </h1>
        </form>
        <script>
            function validateForm() {
                var x = document.forms["myForm"]["price"].value;
                if (x <= <?php echo $rows['price'];?>) {
                        alert("database Price must be gratter..");
                        return false;                    
                }
                else{
                    if (x <= document.getElementById("price").innerHTML) {
                        alert("tag Price must be gratter..");
                        return false;
                    }
                }
            }
        </script>
        
        <script>     document.getElementById("demo").innerHTML = "Bdddddd";         
                    var x = setInterval(function() {
                    
                        var countDownDate = <?=$d1?>;
                        var now = new Date().getTime();
                        var distance = countDownDate - (now/1000) - 16200;


                        if (distance > 0) {
                            var days = Math.floor(distance / ( 60 * 60 * 24));
                            var hours = Math.floor((distance % (60 * 60 * 24)) / ( 60 * 60));
                            var minutes = Math.floor((distance % (60 * 60)) / 60);
                            var seconds = Math.floor((distance %  60));
                            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                            + minutes + "m " + seconds + "s ";

                        }
                        else {

                            document.getElementById("demo").innerHTML = "<br>BIDDING RUNNING......";
                            document.getElementById("n1").innerHTML ="highest bidder: ";
                            document.getElementById("p1").innerHTML ="Current Price: ";                            
                            document.getElementById("bt1").value = "BID NOW";
                            document.getElementById("bt1").type = "submit";
                            document.getElementById("t1").type = "number";
                            $i_id=<?=$i_id?>;
                            $('#price').load('fetch.php?i_id='+$i_id);
                            $('#name').load('fetchname.php?i_id='+$i_id);
                        }
                        
                    }, 100);              

    </script>

    </body>
</html>

