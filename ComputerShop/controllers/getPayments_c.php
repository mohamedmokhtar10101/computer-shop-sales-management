<?php
session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}

if($_POST)
{
    try {
        
    
    include '../includes/autoLoader.php';
        
   
        $validator = new Validator();
        $_POST = $validator->santasizeArray($_POST);
          
          
            
    if(isset($_POST['id']))
    {
         $id = $_POST['id'];
         $id = $validator->santasizeString($id);
         $id = $validator->cleantIt($id,false);
         $displayObject = new Display("agentPayments","../includes/dataBaseVars.php");
         if($displayObject->dataExists("agent_id", $id))
         {
      
             $payments = $displayObject ->getDataById("agent_id", $id,true);
             

         echo" <table style ='background-color:white' id='itemsTable' class=' table table-striped table-hover table-bordered'>
                <thead>
                    <tr class=\"success\">
                        <th scope=\"col\">Paid Amount</th>
                        <th scope=\"col\">Date And time</th>
                    </tr>
                </thead>";
         echo"<tbody>";
         
         foreach ($payments as $key=>$payment)
         {
             
             echo "<tr>";
             echo "<td>{$payment['paid']}</td>";
             echo "<td>{$payment['date_time']}</td>";
             echo "</tr>";
         }
         
         
         
         echo"</tbody> </table>";

         }
 else {
    throw new Exception("<div class='displayerElements error'>there is no payment for this agent  </div>");
 }
      
    }
    
    
    
        
        
  





    }
     catch (Exception $ex) {
     echo $ex->getMessage();   
    }
}


?>
