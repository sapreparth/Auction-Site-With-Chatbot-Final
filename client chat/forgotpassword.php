<!DOCTYPE html>


<?php 
session_start();
require 'PHPMailer/PHPMailerAutoload.php';

 /*if(isset($_GET['msg']))
  {
    $pr=$_GET['msg'];
    if($pr=="INVALID DETAIL")
    echo "<center><font color='red' >$pr</font></center>";
  }
  else
    echo "";*/
if(isset($_POST['name']) && isset($_POST['email']))
{
     
  $cuname=$_POST['name'];
  $cemail=$_POST['email'];
 
  try{
  $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
 // echo "Connection is established...<br/>";
  $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $query=$dbhandler->query("SELECT cpassword FROM customer WHERE cname = '".$cuname."' AND  email = '".$cemail."'");
  
    
  }
  catch(PDOException $e)
  {
  echo $e->getMessage();
  die();
  }
  
  if(($query->rowcount())>0)
    {
      
      while($r=$query->fetch()){
      //echo specific attributes
    
    //  $random = rand(72891,92729);
    $new_password=$r['cpassword'];
  }
     try{
  $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
 // echo "Connection is established...<br/>";
  $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $query=$dbhandler->query("UPDATE customer SET cpassword='$new_password' WHERE cname = '".$cuname."' AND  email = '".$cemail."'");
   $m = new PHPMailer;
    
    $m->isSMTP();
    //$m->SMTPDebug  = 4; 
    $m->SMTPAuth = true;
    
    $m->Host='smtp.gmail.com';
    $m->Username='ribadiya1998arpit@gmail.com';//enter your email id
    $m->Password='arpit1240';//enter your email password
    $m->SMTPSecure = 'tls';
    $m->Port=587;
    $m->isHTML(true);
    $m->Subject= 'We have send Your password';
    
    //$m->Body = 'Your updated password is .{$new_password}.';
    $m->Body = "The old password is " . $new_password . ".";

    $m->FromName = 'ARP Auction';
    
    
    $m->AddAddress($cemail,'Arpit Ribadiya');
    if(!$m->send()){
      echo "Mailer Error: " . $m->ErrorInfo;
     
    }else{
     header("location:login.php"); 
    } 
}
catch(PDOException $e){
  echo $e->getMessage();
  die();
}
    //  header("location:index.php");
      
    }
    else
    {
    header("location:forgotpassword.php?msg=INVALID DETAIL");  
    }
}
?>



<html>
<head>
  <link rel="stylesheet" href="css/login.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link">Forgot Password</a>
              </div>
              
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form" action="forgotpassword.php" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="email" id="email" tabindex="2" class="form-control" placeholder="Email" required>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="SEND">
                      </div>
                    </div>
                  </div>
                               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
    $(function() {

    $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });

});

</script>

</body>
</html>
