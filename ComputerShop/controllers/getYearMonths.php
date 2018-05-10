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
        
            
    if(isset($_REQUEST['id']) && $validator->isValidInteger($_REQUEST['id']))
    {
        
         $id = $_REQUEST['id'];
          $displayObject = new Display("sold_product","../includes/dataBaseVars.php");
     $salesMonth=$displayObject->getColumnDataById("year_",$id,"DISTINCT month_",TRUE);
        if($salesMonth != false)
        {
            echo "<option value='' selected='selected'>select a month</option>";
            foreach ($salesMonth as $value)
                echo "<option value='{$value['month_']}'>{$value['month_']}</option>";

        }
       
      
    }
    

        
   }
   catch(Exception $ex){
    echo $ex->getMessage();
      }
}







?>
