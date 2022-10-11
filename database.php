<?php

class Database{
    public $database;
    public function connect(){
        $databaseinformaion = 'mysql:dbname=tasktest;host=127.0.0.1;port=3306;';
        $user = 'root';
        $password = '';
        $database = new PDO($databaseinformaion, $user, $password);
     
     
    return $database; 
   
   }
   public function register(...$arg){
    $databaseconection=Database::connect();
    $insert_query="insert into request (UserName,email,Pasword,photo,message,date) values('{$arg[0]}','{$arg[1]}','{$arg[2]}','{$arg[3]}','{$arg[4]}','{$arg[5]}') ";
    $stmt=$databaseconection->prepare($insert_query);
    $resltobject=$stmt->execute();
    return $resltobject;
   }

   public function checkforlogin(...$arg){
    $databaseconection=Database::connect();
     $select_query=" SELECT UserName,email,Pasword,photo,roles FROM user WHERE email='{$arg[0]}' 
     AND Pasword='{$arg[1]}' UNION SELECT UserName,email,Pasword,photo,'null' FROM request 
     WHERE email='{$arg[0]}' AND Pasword='{$arg[1]}' 
     UNION SELECT UserName,email,Pasword,photo,'null' FROM reject WHERE
      email='{$arg[0]}' AND Pasword='{$arg[1]}';  ";
     $stmt=$databaseconection->prepare($select_query);
     $resltobject=$stmt->execute();
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     return $row;
    
    
    }
   
    public function checkexistanceofemail($email){
        $databaseconection=Database::connect();
        $select_query="SELECT email FROM user WHERE email='{$email}' 
        UNION SELECT email FROM request 
       WHERE email='{$email}' ";
        $stmt=$databaseconection->prepare($select_query);
        $resltobject=$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

  public function getallrequest(){
        $databaseconection=Database::connect();
        $select_query="select * from request ";
        $stmt=$databaseconection->prepare($select_query);
        $resltobject=$stmt->execute();
        return $stmt;
    }
    
    public function getrejecteduser(){
        $databaseconection=Database::connect();
        $select_query="select * from reject ";
        $stmt=$databaseconection->prepare($select_query);
        $resltobject=$stmt->execute();
        return $stmt;
    }

    public function getreaccepteduser(){
        $databaseconection=Database::connect();
        $select_query="select * from user  WHERE roles='user' ";
        $stmt=$databaseconection->prepare($select_query);
        $resltobject=$stmt->execute();
        return $stmt;
    }

   public function performQuery($query){
        $con =Database::connect();
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function fetchAll($query){
        $con =Database::connect();
        $stmt = $con->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getalluser(){
        $databaseconection=Database::connect();
        $select_query="(SELECT Id, UserName, email ,photo,'acept' AS STATUS FROM user WHERE user.roles='user' ) 
        UNION (SELECT Id, UserName, email ,photo,'reject' FROM reject) ORDER BY Id; ";
        $stmt=$databaseconection->prepare($select_query);
        $resltobject=$stmt->execute();
        return $stmt;
    }
  
}

 