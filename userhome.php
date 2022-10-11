<?php
session_start();
require("database.php");
$database= new Database();
if (isset($_REQUEST['logout'])) {
	unset($_SESSION['sessionuser']);
	session_destroy();
	header('location:index.html');
}


?>

<!DOCTYPE html>
<html>

<head>


  <title>Task Test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
</head>

<body >
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="">E2ECounty </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="">Home</a></li>
    
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="userhome.php?logout='true'"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>

<br><br>
<?php
 $queryselectfromuser = "select * from user  WHERE email='{$_REQUEST['email']}'  ";
 @$seletuserquery = $database->fetchAll($queryselectfromuser);
 
 $queryselectfromrequest = "select * from request  WHERE email='{$_REQUEST['email']}'  ";
 @$seletrequestquery = $database->fetchAll($queryselectfromrequest);
 
 $queryselectfromreject = "select * from reject  WHERE email='{$_REQUEST['email']}'  ";
 @$seletrejectquery = $database->fetchAll($queryselectfromreject);
 if($seletuserquery){
    echo "<h1  class='mt-4'>Welcome sir,{$seletuserquery["UserName"]}</h1>                        
    <h3  class='mt-4'>Your Data :-</h3>                
    <h4  class='mt-4'>Your Email :{$seletuserquery["email"]}</h4>               
    <h4  class='mt-4'>Your Pasword :{$seletuserquery["Pasword"]}</h4>            
    <h4  class='mt-4'>Your profile image : <img src='images/{$seletuserquery["photo"]}' width=40px height=40px> </h4> ";
 }else if($seletrequestquery){
    echo "<h1>Pending Request for sir,{$seletrequestquery["UserName"]}</h1>";
    
 }else if($seletrejectquery)
 {
    echo "<h1>Rejected  Request for sir,{$seletrejectquery["UserName"]}</h1>";
 }



?>
                        </body>
</html>