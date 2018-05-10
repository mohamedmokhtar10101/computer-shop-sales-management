<?php
include '../includes/autoLoader.php';
 $validator = new Validator();

if($_POST)
{
    $_POST = $validator->santasizeArray($_POST);
    $userName=$_POST['userName'];
    $password=$_POST['userPassword'];
    $validator = new Validator();
    $userName = $validator->santasizeString($userName);
    $userName = $validator->cleantIt($userName,false);
    $password = $validator->santasizeString($password);
    $password = $validator->cleantIt($password,false);
    try{
    $login= new Login($userName,$password);
     if($privilege=$login->user_exists())
     {
         session_start();
         $_SESSION['userName']=$userName;
         $_SESSION['privilege']=$privilege;
         header("location:../index.php");
      
     }
     else
     {
         $message="user name or password is inccorrect";
         include "../views/loginView.php";
     }
    
}
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
}

else
{
    
    header("location:../views/loginView.php");
}











?>