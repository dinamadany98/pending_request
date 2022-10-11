<?php
session_start();
require("database.php");
$database= new Database();
if (isset($_REQUEST['logout'])) {
	unset($_SESSION['sessionadmin']);
	session_destroy();
	header('location:login.php');
}
if (!isset($_SESSION['sessionadmin'])) {
  header('login.php');
};
if (isset($_REQUEST['acceptid'])) {
  $idaccept=$_REQUEST['acceptid'];
  $queryinsert = "insert INTO user (Id,UserName,email,Pasword,roles,photo) 
  SELECT request.Id, request.UserName,request.email,request.Pasword,'user',request.photo FROM request where request.Id='$idaccept' ;";
  @$insertquery = $database->performQuery($queryinsert);
  if($insertquery){
  $query = "DELETE FROM `request` WHERE `request`.`Id` = '$idaccept';";
  @$deletquery = $database->performQuery($query);
  if($deletquery){
      header('location:allrequest.php');
  }else{
        echo "<script>alert('Unknown error occured.')</script>";
  }

}else{
echo "<script>alert('Unknown error occured.')</script>";
}

}
if (isset($_REQUEST['rejectid'])) {
    $idrejet=$_REQUEST['rejectid'];
    $queryinsert = "insert INTO reject (Id,UserName,email,Pasword,photo) 
    SELECT request.Id, request.UserName,request.email,request.Pasword,request.photo FROM request where request.Id='$idrejet' ;";
    @$insertquery = $database->performQuery($queryinsert);
    if($insertquery){
    $query = "DELETE FROM `request` WHERE `request`.`Id` = '$idrejet';";
    @$deletquery = $database->performQuery($query);
    if($deletquery){
        header('location:allrequest.php');
    }else{
          echo "<script>alert('Unknown error occured.')</script>";
    }
	
}else{
  echo "<script>alert('Unknown error occured.')</script>";
}
}
?>

<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
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
      <li class="active"><a href="admainhome.php">Home</a></li>
    
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="allrequest.php?logout='true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>

                            
                            <a class="btn   btn btn-primary  mt-4  " href="alluser.php" role="button" style="float:right">View All User</a>
                            <a class="btn btn btn-primary mt-4 me-1 ms-1 " href="allrequest.php" role="button" style="float:right">View Requests</a>
                            <a class="btn btn btn-primary mt-4 " href="rejecteduser.php" role="button" style="float:right">View Rejected User</a>


<br><br>
<h1 style="text-align:center" class="mt-4">All Requests</h1>
<?php
$database= new Database();
@$getallusers = $database->getallrequest();
while($row = $getallusers->fetch(PDO::FETCH_ASSOC))
    {
        echo "<div class='card mt-4 d-inline-block col-5 ms-4 me-4' style='display:inline-block'>
        <div class='card-header'>
        {$row['UserName']}
        </div>
        <div class='card-body'>
          <h5 class='card-title'>Email : {$row['email']}</h5>
          <p class='card-text'>{$row['message']}.<br>{$row['date']}</p>
          <a href='allrequest.php?acceptid={$row['Id']}' class='btn btn-primary'> Accept</a>
          <a href='allrequest.php?rejectid={$row['Id']}' class='btn btn-danger'> Reject</a>
        </div>
      </div>";
    }

?>


                        </body>
</html>