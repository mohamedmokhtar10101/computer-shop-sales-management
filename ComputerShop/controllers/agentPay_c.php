<?php

session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}

include "models/functions.php";
if($_POST)
{
     $validator = new Validator();
     $_POST = $validator->santasizeArray($_POST);
    if($_POST['submit']=="Pay" &&$_POST['id'])
    {
      try{
            $agentId = $_POST['id'];
            $rules = array(
            "paymentAmount"=>"isValidRequired&isValidFloat&isPlus",
             );
           
            $errors = $validator->validateArray(array("paymentAmount"=>$_POST['paymentAmount']), $rules);   
            $isThereError = false;
            $errorsMessages;
            foreach($errors as $key=>$value)
            {
                if(!empty($value)&&(strpos($value,"d")!==false)){
                $errorsMessages[$key] = "*";
                $isThereError = true;
                
                }
                else if(!empty($value)&&strpos($value,"d")==false)
                {
                    $errorsMessages[$key] = "the field is not valid";
                    $isThereError = TRUE;
                }

            }            
          

            if($isThereError)
            {
                 include 'views/agentPay.php';
                 
            }
            else 
                {
                 
                 $displayObject = new Display("agent");
                 $agentPaid = $displayObject->getColumnDataById("id", $agentId, "paid");
                 $displayObject->close();
                 $displayObject = null;
                 $updateObject= new Update("agent");
                 $updateObject ->updateDataById("id",$agentId, array('paid'=>($agentPaid['paid']+$_POST['paymentAmount'])));
                
               
              include 'viewAllAgents_c.php';
                 
              echo "<h2 class='sectionTitle actionMessage' >successfully payed<h2>";
                 
                 
                 
               
        
        
        
        
        
         
          }
      }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
       
    }
    else
         include 'viewAllAgents_c.php';
   
        }

        else

            {
            include 'viewAllAgents_c.php';
            }
