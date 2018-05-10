<?php
session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
function defaultDisplay()
{
       try{
    $displayObject = new Display("agent");
    $agents = $displayObject->getALLData();
    $displayObject->close();
    include "views/agents.php";
    }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
}
function displayAgent($id)
{
            $displayAgentObj = new Display("agent");
        
            return $displayAgentObj->getDataById("id", $id);
}

 $validator = new Validator();


session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
       try{
    $displayObject = new Display("agent");
    $agents = $displayObject->getALLData();
    $displayObject->close();
    $displayObject = null;
    
    }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
 if($_GET['action'] && ($_GET['action'] == "delete" || $_GET['action'] == "edit" || $_GET["action"] == "pay") && $_GET['id'])
{

    $agents = null;
    try
    {
    $_GET = $validator->santasizeArray($_GET);
    $id = $validator->santasizeString($_GET['id']);
    $id = $validator->cleantIt($id , false);
    if(!$validator->isValidRequired($id))
        throw new Exception("<div class='sectionTitle error'>the id  must not be empty </div>");
   
    if($_GET['action'] == "delete")
    {
 
        if($_GET['confirm'] && $_GET['confirm']=="Yes" )
         {
 
               
            if( $_GET['confirm'] == "Yes")
               {
                
                $deleteAgent = new Delete("agent");
                if(!$deleteAgent->doesDataExist("id", $id))
                        throw new Exception("<div class='sectionTitle error'>the agent  doesn't exist </div>");               
                $deleteAgent->deleteDataById("id", $id);
                echo "<div class='sectionTitle actionMessage'>agent with $id id  deleted successfully </div>";
                $deleteAgent->close();
               }
               

         
          }
          else {
            defaultDisplay();    
          }
      
    
       }
         else if($_GET['action']=="edit")
    {
                   
                      $displayObject = new Display("agent");
                      if(!$displayObject->dataExists("id", $id)){
                          $displayObject->close(); 
                          throw new Exception("<div class='sectionTitle error'>the agent  doesn't exist </div>");   
                          }
               $agentToDisplay = displayAgent($id);
                 $data = explode("-",$agentToDisplay['redemption_date'] );
                 $temp = $data[0];
                 $data[0] = $data[2];
                 $data[2] = $temp;
                 $agentToDisplay['redemption_date'] = implode($data, "-");
               $agentId = $id;
               $edit = true;
               include 'views/addNewAgent.php';
    }
    else if($_GET['action'] == "pay")
    {
       
        $displayObject = new Display("agent");
          if(!$displayObject->dataExists("id", $id)){
            $displayObject->close(); 
            throw new Exception("<div class='sectionTitle error'>the agent  doesn't exist </div>");   
                          }
               
               $agentId = $id;
               
               include 'views/agentPay.php';
    }
 
    else 
        {
       
        defaultDisplay();
    
        
    
        
        }
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
    }
    elseif ($agents == FALSE) 
        {
        echo "<h2 class='sectionTitle'>No agents to view</h2>";
        }
else
{
     
     
        defaultDisplay();
   
}