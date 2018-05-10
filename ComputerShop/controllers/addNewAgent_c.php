<?php

session_start();
if(!isset($_SESSION['userName'])|| $_SESSION['privilege']!=1)
{
    header("location:index.php");

    die();
}

include "models/functions.php";
if($_POST)
{
     $validator = new Validator();
     $_POST = $validator->santasizeArray($_POST);
    if($_POST['submit']=="Add" || $_POST['submit']=="Edit")
    {
      try{
          if($_POST['submit']=="Edit"){
              $str = "Edit";
              $oldId = $_POST['oldId'];
              $_POST = array_diff($_POST,array("oldId"=>$_POST['oldId']));
              $edit = true;
          }
          else if($_POST['submit']=="Add")
              $str = "Add";
          
          $keys = "`ag_name`, `phone`, `email`, `total_debt`, `paid`, `redemption_date`";
          $agentsToAdd = assignArrWKeys(array_diff($_POST,array("submit"=>$str)), $keys);
      if($agentsToAdd==false)
         throw new Exception ("<h2 class='sectionTitle error'>stop trying to hack this solid structure</h2>");

            $rules = array(
            "ag_name"=>"isValidRequired&isValidString",
             );
           
           if(!empty($agentsToAdd['phone']))
                $rules['phone']="isValidePhone";

           if(!empty($agentsToAdd['email']))
                $rules['email']="isValideEmail&isNan";
            if($agentsToAdd['total_debt']=="0"||!empty($agentsToAdd['total_debt']))
                  $rules['total_debt']="isValidFloat&isPlus";
            if($agentsToAdd['paid']=="0"||!empty($agentsToAdd['paid']))
                $rules['paid']="isValidFloat&isPlus";
            
            if(!empty($agentsToAdd['redemption_date']))
            {
                  $rules['redemption_date']="isValidDate";
            }
            $errors = $validator->validateArray($agentsToAdd, $rules);     
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
            if(!empty($agentsToAdd['paid'])&&empty($agentsToAdd['total_debt']))
            {
                $errorsMessages['paid']="can't take a value";
            }
           else if(!empty($agentsToAdd['total_debt'])&&!empty($agentsToAdd['paid'])&&!$validator->isInRange(0, $agentsToAdd['total_debt'], $agentsToAdd['paid']))
            {
                $errorsMessages['paid']="the field is not valid";
                 $isThereError = TRUE;
            }

            if($isThereError)
            {
                 include 'views/addNewAgent.php';
                 
            }
            else 
                {
                 $addAgents= new Add("agent");
                
                 
                 $agentsToAdd["remaining"] = $agentsToAdd["agentTotalDebt"]-$agentsToAdd['agentPaid'];
               
                 $data = explode("-",$agentsToAdd['redemption_date'] );
       
                 $data[0] = "0".intval($data[0]);
       
                 $temp = $data[0];
       
                 $data[0] = $data[2];
      
                 $data[2] = $temp;
      
                 $data[1] = "0".intval($data[1]);
       
     
                 $agentsToAdd['redemption_date'] = implode($data, "-");
                 $agentsToAdd['date_'] = date("Y-m-d");
                 if($_POST['submit'] == "Add")
                  {
                     if(!empty($agentsToAdd['phone'])){
                     if($idToDelete=$addAgents->dataExistsByColumns(["ag_name"=>$agentsToAdd['ag_name'],"phone"=>$agentsToAdd['phone']], "id"))
                     {
                         $deleteObj = new Delete("agent");
                         $deleteObj->deleteDataById("id", $idToDelete);
                         
                     }
                     }
                     $addAgents->addData($agentsToAdd);                 
                     $addAgents->close();
                 }
                 else if($_POST['submit'] == "Edit")
                 {

     
                     $editAgentObj = new Update("agent");
                     $editAgentObj->updateDataById('id', $oldId, $agentsToAdd);
                     $editAgentObj->close();
                 }
                               
                
                 if(!$isThereError && $_POST['submit'] == "Add")
                 {
                   echo "<h2 class='sectionTitle actionMessage' >successfully added<h2>";
                 }
                 else if(!$isThereError && $_POST['submit'] == "Edit")
                 {
                   echo "<h2 class='sectionTitle actionMessage' >successfully Edited<h2>";
                 }
                 
                 
                 
                 
                 
                 
                 
               }
        
        
        
        
        
         
          }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
       
    }

        }

        else

            {
            include 'views/addNewAgent.php';
            }
