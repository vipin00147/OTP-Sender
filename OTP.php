<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  <center>  <h2>Send OTP by using Textlocal</h2></center><br>
<form method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationServer01">Name</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer02">Mobile Number</label>
      <input type="text" class="form-control" name="mobile" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServerUsername">Click below to send OTP</label>
      <div class="input-group">
        <button class="btn btn-primary" name="sendotp">Send OTP</button>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationServer03">Enter OTP</label>
      <input type="text" class="form-control" name="num">
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationServer04">Click below to varify</label>
      <div class="input-group">
        <button class="btn btn-primary" name="varify">Varify OTP</button>
      </div>
    </div>
</form>
</body>
</html>
<?php

if(isset($_POST["sendotp"]))
{
    require("textlocal.class.php");
    require("credential.php");
    $textlocal = new Textlocal(false,false,API_KEY);

    $numbers = array($_POST['mobile']);
    $sender = "TXTLCL";
    $OTP = mt_rand(1000,2000);
    $message = "Hello ".$_POST['name']." OTP : ".$OTP." Never Share Your One Time Password With Anyone";
    try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    setcookie('otp',$OTP);
    echo"OTP Successfully Send...";
    } catch (Exception $e) {
    die('Error: ' . $e->getMessage());
    }
}
if(isset($_POST["varify"]))
{
    $OTP=$_POST['num'];
    if($OTP==$_COOKIE['otp'])
    {
        echo"OTP varified";
    }
    else
    {
        echo"Incorrect OTP";
    }
}
?>