<?php
session_start();
if(!isset($_SESSION['userName'])|| $_SESSION['privilege']!=1)
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
            //$getItem = new Display("product","../includes/dataBaseVars.php");
            $getSuppliers = new Display("supplier_products","../includes/dataBaseVars.php");
            
    if(isset($_REQUEST['id']))
    {
         $id = $_REQUEST['id'];
         $id = $validator->santasizeString($id);
         $id = $validator->cleantIt($id,false);
      

         /*if(  $validator->isNan($id) == false)
             throw new Exception("<div class='displayerElements'>it is not a valid ID</div>");
        $theItem=$getItem->getDataById('id', $id);
        if($theItem == false)
        {
             throw new Exception("<div class='displayerElements error'>No ID with this value exists</div>");
        }*/
        $suppliersData = $getSuppliers->getDataByIdJoin('product_id', $id, "supplier", "supplier_id", "s_name","id");
      
    }
    
      /*echo"<div class=\"elementSection\">";
        foreach ($theItem as $key=>$value)
        {
            
            echo "<div class='displayerElements'><span style='color:white'>$key<span> : <span style='color:grey'>$value</span></div>";
        }
        echo"</div>";*/
        echo"<div class=\"elementSection\">";
           echo "<div class='displayerElements'><span class='sp1'>suppliers<span></div>";

             if(!$suppliersData)
        {
              throw new Exception("<div class='displayerElements error'>there is not supplier for  $id </div>");
        }
        
           foreach ($suppliersData as $key=>$value)
        {
               
         
            echo "<div class='displayerElements'><span class='sp1'>supplier name : <span class='sp2'>{$value['s_name']}</span></span></div>";
        }
        echo"</div>";
        
   }
   catch(Exception $ex){
    echo $ex->getMessage();
      }
}







?>
