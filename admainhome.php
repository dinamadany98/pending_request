<?php
session_start();
require("database.php");
if (isset($_REQUEST['logout'])) {
	unset($_SESSION['sessionadmin']);
	session_destroy();
	header('location:login.php');
}
if (!isset($_SESSION['sessionadmin'])) {
    header('login.php');
};
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
      <li><a href="admainhome.php?logout='true'"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>

                            
                            <a class="btn   btn btn-primary  mt-4  me-4 ms-4" href="alluser.php" role="button" style="float:right">View All User</a>
                            <a class="btn btn btn-primary mt-4 me-5 ms-5 " href="allrequest.php" role="button" style="float:right">View Requests</a>
                            <a class="btn btn btn-primary mt-4 me-4 ms-4" href="rejecteduser.php" role="button" style="float:right">View Rejected User</a>


<br><br>
<h1 style="text-align:center" class="mt-4">current users list</h1>
                                                    
<?php
$database= new Database();
@$getallusers = $database->getreaccepteduser();
  echo "<table class='table mt-4'>
  <thead class='thead-dark '>
    <tr>
      <th scope='col'>Name</th>
      <th scope='col'>Email</th>
      <th scope='col'>Image</th>
    </tr>
  </thead>
  <tbody>";
    
    while($row = $getallusers->fetch(PDO::FETCH_ASSOC))
    {
      
      echo " <tr>
      <th scope='row'>{$row["UserName"]}</th>
      <td>{$row["email"]}</td>
      <td><img src='images/{$row["photo"]}' width=40px height=40px></td>
    </tr>";
    }
   
   
 
 echo "</tbody>
</table>";
?>
                        </body>
</html>