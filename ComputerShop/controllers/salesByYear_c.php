<?php

session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
     $displayObject = new Display("sold_product");
     $salesyear=$displayObject->getAllColumnData("DISTINCT  year_");
  if($_POST)
  {
try{
    $validator = new Validator();
    $_POST = $validator->santasizeArray($_POST);
    if($_POST['submit'] && $_POST['submit'] == 'Select' && isset($_POST['salesYear']) )
    {
        $rules = array(
            "salesYear"=>"isValidRequired&isValidInteger"
            );
            $errors = $validator->validateArray($_POST, $rules);  
            $isThereError = false;
            $errorsMessage;
            foreach($errors as $value)
            {
                if(!empty($value)&&(strpos($value,"d")!==false)){
                $errorsMessage = "*";
                $isThereError = true;
                
                }
                else if(!empty($value)&&(strpos($value,"r")!==false))
                {
                    $errorsMessage = "the field must be integer";
                    $isThereError = TRUE;
                }
            }
            if($isThereError)
            {
                $displayObject->close();
                include "views/salesByYear.php";  
            }
            else
            {
                $mask=false;
                foreach ($salesyear as $value)
                {
                    if($value['year_']==$_POST['salesYear'])
                    {
                        $mask = true;
                        break;
                    }
                    
                    
                }
               if($mask)
               {
                 
                   
                   $sales = $displayObject->getColumnsDataBycolumns( array("year_"=>$_POST['salesYear']),"quantity desc");
                  if($sales !=FALSE){  
                   foreach ($sales as $value)
                       $images[] = $displayObject->getDataByIdSimpleJoin("product_id", $value['product_id'], "product", "id", "image");
                  }
               
                   $displayObject->close();
                   include "views/salesByYear.php";     
                   
                   
                   
                   

               }
 
               else {
     
                     $errorsMessage = " the year must be in the range";
                    $isThereError = TRUE;
                    include "views/salesByYear.php";   
                    $displayObject->close();
               }
            }
                
            
    }
 else {
     $displayObject->close();
     throw new exception("<h2 class='sectionTitle error'>stop trying to hack this solid structure</h2>");
        
    }

   

    }
   
catch(Exception $ex)
{
        echo $ex->getMessage();
    
        
}

  }
    else if($salesyear ==false)
  {
      echo "<h2 class='sectionTitle'>No sales to view</h2>";
  }
 else {
     
 
     $sales = $displayObject->getALLData("quantity desc");
                   
          if($sales !=FALSE){             
    
        
              foreach ($sales as $value)
                 $images[] = $displayObject->getDataByIdSimpleJoin("product_id", $value['product_id'], "product", "id", "image");
      }
     
     
     $displayObject->close();
include "views/salesByYear.php";      
}