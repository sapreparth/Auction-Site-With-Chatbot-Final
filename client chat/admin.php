<html>
    <head>
        <title>AdminControl</title>
        <link rel="stylesheet" href="css/navigation.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style> 
            .navbar {
              margin-bottom: 30px;
              border-radius: 0;
            }
             .jumbotron {
              margin-bottom: -10;
            }
            footer {
              background-color: #f2f2f2;
              padding: 25px;
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

                    <div id="main" class="navbar-brand">
                        <span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; Category</span>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="buyer.php">Home</a></li>
                        
                        <li class="dropdown">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Status <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <li><a href="admin.php ">All</a></li>
					          <li><a href="admin.php?status=pending ">Pendig</a></li>
					          <li><a href="admin.php?status=verified ">Verified</a></li>
					          <li><a href="admin.php?status=runnig ">Runnig</a></li>
					          <li><a href="admin.php?status=paid ">Paid</a></li>
                              <li><a href="admin.php?status=unpaid ">Unpaid</a></li>
                              <li><a href="admin.php?status=unsold ">Unsold</a></li>

					        </ul>
					    </li>

                        <li><a href="query.php">Query</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    </ul>
                </div>
                
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="admin.php">All</a> 
                    <hr>
                    <?php
                        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql="SELECT * FROM category";
                        $result=$dbhandler->query($sql);
                        while($rows=$result->fetch())
                        {       echo  "<a href='admin.php?cat_id=" .$rows['cat_id']. "'>" .$rows['category']. "</a>";
                        }
                    ?>
                    <hr>
                    <form action="addCategory.php" method="post">
                        <div class="form-group">
                        <input type="text" name="cat">
                        <input type="submit" value="Add New Category">

                        </div>

                    </form> 
                </div>
            </div>
        </nav>

        <?php
            session_start(); 
            if(isset($_SESSION['cname']))
            {   $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
                    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql="SELECT * FROM admin";
                    $result=$dbhandler->query($sql);
                    while($rows=$result->fetch()){
                        if($rows['cid']==$_SESSION['cid']){
                            $_SESSION['aid']=$_SESSION['cid'];
                        }
                    }
                if(isset($_SESSION['aid'])){
                    
                }
                else{
                    header("location:buyer.php");   
                }
            }
            else{
                header("location:login.php?msg=Please Login First");
            }
               try
                {
                    $i=0;
                    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
                    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql="SELECT * FROM item";

                    if(isset($_GET['cat_id'])){
                        $sql="SELECT * FROM item where cat_id='". $_GET['cat_id'] ."'";
                    }
                    if(isset($_GET['status'])){
                        $sql="SELECT * FROM item where status='". $_GET['status'] ."'";
                    }
                   

                    $result=$dbhandler->query($sql);
                    // if($result->num_rows > 0)
                    echo "<div id='container'><div class='row' class=collapse navbar-collapse' >";// for mobile class='row'

                        $arr=array(0);
                        while($rows=$result->fetch())
                        {   
                            echo "<div class='col-sm-3'>
                                    <div class='panel panel-primary'>";
                            $i=$i+1;
                            echo"<div class='panel-heading'  style='text-align:center'>".$rows['p_name']."</div>";
                            echo "<form action='product.php?i_id=".$rows['i_id']."' method='post'>";
                            $name=$rows['i_id'];
                            $tmp="images/products/".$name.".jpg";

                            echo "<div class='panel-body' style='text-align:center'><img id='imgCaptcha' src='$tmp'  height='140' width='150' /></div>";
                            $d1=$rows['bdate'];
                            $t1=$rows['btime'];
                            $d1=strtotime($d1.$t1);
                            array_push($arr,$d1);
                            echo "<br>";
                            echo'<div class="panel-footer" style="text-align:center"><text id="demo'.$i.'"></text></div>';
                            echo"<div class='panel-footer'  style='text-align:center'>Price: ".$rows['price']."</div>";
                            echo "<div class='panel-footer' style='text-align:center'><input type='submit' name='item' value='EXPLORE'></div>";
                            echo "<input type='hidden' name='i_id' value='".$rows['i_id']."'>";
                            echo "</form>";
                            echo "<form action='admin_product_verify.php?i_id=".$rows['i_id']."' method='post'>";
                            if($rows['status']=='pending')
                            	echo "<div class='panel-footer' style='text-align:center'><input type='submit' name='item_v' value='Varify'></div>";
                            elseif($rows['status']=='verified')
                            	echo "<div class='panel-footer' style='text-align:center'><span class='glyphicon glyphicon-ok'> Verified</span></div>";
                            elseif($rows['status']=='unpaid')
                            	echo "<div class='panel-footer' style='text-align:center'>Unpaid</div>";
                            elseif($rows['status']=='paid')
                                echo "<div class='panel-footer' style='text-align:center'>Paid</div>";
                            elseif($rows['status']=='unsold')
                                echo "<div class='panel-footer' style='text-align:center'>Unsold</div>";
                            else
                            	echo "<div class='panel-footer' style='text-align:center'>RUNNING!</div>";
                            echo "<input type='hidden' name='i_id' value='".$rows['i_id']."'>";
                            echo "</form>";

                            echo "<form action='admin_product_delete.php?i_id=".$rows['i_id']."' method='post'>";
                                echo "<div class='panel-footer' style='text-align:center'><span class='glyphicon glyphicon-trash'>
                                </span>
                                <input type='submit' name='item_v' value='Delete'></div>";


                            echo "<input type='hidden' name='i_id' value='".$rows['i_id']."'>";
                            echo "</form>";
                            echo "</div></div>";
                   
                        }
                        echo "</div></div>";

                        json_encode($arr); 
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    die();
                }
            
        ?>

        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
            }
        </script>

        <script>
            var max=<?=$i?>;
            var i=1;
            var ar = <?php echo json_encode($arr)?>;
                                        
            var x = setInterval(function() {
                var countDownDate = ar[i];
                var now = new Date().getTime();
                var distance = countDownDate - (now/1000) - 12600;
                if (distance > 0) {
                    var days = Math.floor(distance / ( 60 * 60 * 24));
                    var hours = Math.floor((distance % (60 * 60 * 24)) / ( 60 * 60));
                    var minutes = Math.floor((distance % (60 * 60)) / 60);
                    var seconds = Math.floor((distance %  60));
                    document.getElementById("demo"+i).innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
                }
                else {
                    document.getElementById("demo"+i).innerHTML = "BIDDING RUNNING......";
                }
                i=i+1;
                if(i>max){
                    i=1;
                }
            }, 100);
        </script>
    </body>
</html>