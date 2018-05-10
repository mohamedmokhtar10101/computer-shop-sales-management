<?php
session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}

 $validator = new Validator();
      
 try{
    
     $displayObject = new Display("product");
     $itemsData = $displayObject->getALLData("sold_quantity desc");
     $displayObject->close();
     $displayObject = null;
    }
    catch (Exception $ex)
    {
     echo $ex->getMessage();
    }

if($_POST)
{
    $_POST = $validator->santasizeArray($_POST);
    
    try
    {
        include "models/functions.php";
        $itemToSell = $_POST['itemToSell'];
        $makeDiscount = $_POST['makeDiscount'];
        $isDealer = $_POST['isDealer']; 
        if(!empty($itemToSell))
        {
                       
            if($_POST['quantity']&&(($makeDiscount && $makeDiscount == "Yes")|| ($isDealer && $isDealer == "Yes") || !$makeDiscount || $isDealer) )
            {
                     
                
                $sellItemObj = new Add("product");
                if($sellItemObj->dataExists("id", $itemToSell))
                {
                    
                    $rules = array(
                        
                        "quantity"=>"isValidRequired&isValidInteger&isPlus"
                        
                    );
                    $errors = $validator->validateArray($_POST, $rules);
                   $isThereError=FALSE;
                    foreach($errors as $value)
                        {
                        if(!empty($value)&&(strpos($value,"d")!==false)){
                            $errorMessage = "*";
                            $isThereError = true;
                            } 
                            else if(!empty($value)&&strpos($value,"d")==false)
                                 {
                                $errorMessage = "the field is not valid";
                                $isThereError = TRUE;
                                }
                            
                          }
                          
                          if($isThereError)
                          {
                              include 'views/sellItems.php'; 
                              
                          }
                          else
                              {
                          $quantityObj = new Display("product");
                          $quantity = $quantityObj->getColumnDataById("id", $itemToSell, "quantity");
                          $quantityObj->close();
                          if(!$validator->isInRange(1, $quantity['quantity'], $_POST['quantity']))
                          {
                              $errorMessage = " the value must be from 1 to ".$quantity['quantity'];
                              include 'views/sellItems.php';
                              
                          }  else {
                              
                         
                    $sellItemObj->close();
                    $itemsToSell ['product_id'] = $itemToSell ;
                    $itemsToSell ['quantity'] = $_POST['quantity'];
                    
                    if($isDealer)
                    {
                     $itemsToSell['discount'] = 0;
                     $itemsToSell['agent'] = 2;
                    }
                    else
                    {
                        $itemsToSell['discount'] = 2;
                        $itemsToSell['agent'] = 0;
                    }
                    
                    $itemsToSell['day_'] = date("d");
                    $itemsToSell['month_'] = date("m");
                    $itemsToSell['year_'] = date("Y");
                    $itemsToSell['time_'] = date("h:i:s",time());
                    $sellItemObj = new Add("sold_product");
                    $sellItemObj->addData($itemsToSell);
                    $sellItemObj->close();
                    
                     $message = "<span class='actionMessage'>successfully added</span>";
                     include 'views/sellItems.php';     
                     
                    }
                     }
                    
                }
                
                else 
                    {
                    $message = "<span style='color:red'>the item doesn't exist </span>";
                     include 'views/sellItems.php'; 
                    }
                
                
                
                
            }

            else 
     
                {
                $message = "<span style='color:red'>the discount and dealer must be Yes and quantity must be present </span>";
                include 'views/sellItems.php';  
 
                
                }
        }
        else {
                $message = "<span style='color:red'>item id must not be empty</span>";
                
               include 'views/sellItems.php';     
              
        }    
   
        
        
        
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
    
    
    
  }
    elseif ($itemsData == FALSE) 
        {
        echo "<h2 class='sectionTitle'>No Items to sell</h2>";
        }
else
{
        include 'views/sellItems.php';  
}