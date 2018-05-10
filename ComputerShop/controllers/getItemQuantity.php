<?php
session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}

if($_REQUEST)
{
    include '../includes/autoLoader.php';
        
   try{
        $validator = new Validator();
        $_REQUEST = $validator->santasizeArray($_REQUEST);
        
            
    if(isset($_REQUEST['id']))
    {
        
         $id = $_REQUEST['id'];
        $itemObj = new Display("product","../includes/dataBaseVars.php");
        $quantity = $itemObj->getColumnDataById("id", $id, "quantity");
        if($quantity != false)
        {
            echo $quantity['quantity'];

        }
       
      
    }
    

        
   }
   catch(Exception $ex){
    echo $ex->getMessage();
      }
}







?>
