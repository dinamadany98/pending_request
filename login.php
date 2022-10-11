<?php
session_start();
require("database.php");
$database= new Database();
@$error = json_decode($_GET['error']);
if (isset($_POST['submit'])) {
    $error=[];
   $email =  $_POST['email'];
   $password = $_POST['password']; 
   $row = $database->checkforlogin($email,$password);
    
   if($row){
   switch ($row) {
      case $row["roles"] =="user";
         $_SESSION['sessionuser'] = $row;
       
         header("location:userhome.php?email={$email}");
         break;
      case $row["roles"] =="admain";
               $_SESSION['sessionadmin'] = $row;
        
         header("location:admainhome.php");
         break;
      default:
      $_SESSION['sessionuser'] = $row;
      header("location:userhome.php?email={$email}");
      break;
   }
}else{
    $error["password"]=true;
    $er=json_encode($error);
    $url="?error={$er}";
      header("location:login.php{$url}");
   }
   /////////////////////////////////////


}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login.css">
    <!--===============================================================================================-->
    

</head>

<body>



    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
        <form action="" method="post">
       
        
                <span class="login100-form-title p-b-37"  >
					Sign In
				</span>

                <div class="wrap-input100 validate-input m-b-20"  >
                    <input type="email" name="email"   class="input100 " aria-describedby="emailHelp"   placeholder=" Email">
                 
                     
                </div>

                <div class="wrap-input100 validate-input m-b-25"  >
                    <input type="password" name="password"  aria-describedby="emailHelp"  class="input100" placeholder="Password">
               
                      
                </div>
                <?php if (isset($error->password)) echo "<div  style='color:red'> Incorrect Email Or Password <br><br></div>" ?>
                <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn" name="submit">
						Sign In
					</button>   </div>
                </form>
                

              <br>
              <br>

                <div      class="text-center">
                    <a    href="register.php"   class="txt2 hov1">
						Sign Up
					</a>
                </div>
          


        </div>
    </div>



  



</body>

</html>