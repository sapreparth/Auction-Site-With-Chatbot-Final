<!DOCTYPE html>
<?php
session_start();
if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['confirmpassword']) && isset($_POST['email']) && isset($_POST['mobile']))
{
     
  $tname=$_POST['name'];
  $tpwd=$_POST['password'];
  $tpwd1=$_POST['confirmpassword'];
  $temail=$_POST['email'];
  $taddress=$_POST['address'];
  $tmob=$_POST['mobile'];
  


  
  $fnam=preg_match("/^[A-Za-z]{3,20}$/",$tname);
  $pass=preg_match("/^[0-9a-zA-Z]{6,10}$/",$tpwd);
  $pass1=preg_match("/^[0-9a-zA-Z]{6,10}$/",$tpwd1);
  $em=preg_match("/^.+@(gmail.com|ymail.com|yahoo.com|ddu.ac.in)$/",$temail);
  $mo=preg_match("/^(\+91|\+91\-)?[789][0-9]{9}$/",$tmob);

  
  if($tpwd==$tpwd1)
  {
    $temp=1;
  }
  else
  {
    $temp=0;
  }
  
  if($fnam && $pass && $pass1 && $em && $mo && $temp)
  {
    
    
    try{
  $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
  
  $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql="insert into customer (cname,cpassword,email,address,mobile) values ('$tname','$tpwd','$temail','$taddress','$tmob')";
  $query=$dbhandler->query($sql);
  echo "<p align='center' font='green'>You are registered successfully</p>";
  
}
catch(PDOException $e){
  echo $e->getMessage();
  die();
}

  }
  else
  {
    
    echo "Please,Enter with valid cradintial";
    
  }

}
else
{

}



if(isset($_POST['lemail']) && isset($_POST['lpassword']))
{
  $tlemail=$_POST['lemail'];
  $tlpwd=$_POST['lpassword'];
  
  try{
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
    //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $result=$dbhandler->query("SELECT * FROM customer WHERE email = '".$tlemail."'");
    while($rows=$result->fetch()){
        if($rows['cpassword']==$tlpwd){
        $_SESSION['cname']=$rows['cname'];
        $_SESSION['cid']=$rows['cid'];
          header("location:buyer.php");
        }
        else{
          //echo $rows['cpassword'];
          //echo $tlpwd;
          
          echo "Please,Enter with valid cradintial";
        }
        
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
    die();
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
                <a href="#" class="active" id="login-form-link">Login</a>
              </div>
              <div class="col-xs-6">
                <a href="#" id="register-form-link">Register</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="lemail" id="lemail" tabindex="1" class="form-control" placeholder="Email" value="" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="lpassword" id="lpassword" tabindex="2" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group text-center">
                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                    <label for="remember"> Remember Me</label>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="forgotpassword.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <form id="register-form" action="login.php" method="post" role="form" style="display: none;">
                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="" required>
                  </div>
           <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirmpassword" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
                  </div>
                 <div class="form-group">
                    <input type="text" name="address" id="address" tabindex="1" class="form-control" placeholder="Address" value="" required>
                  </div>
          <div class="form-group">
                    <input type="text" name="mobile" id="mobile" tabindex="1" class="form-control" placeholder="Mobile Number" value="" required>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                    </div>
                  </div>
                </form>
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
