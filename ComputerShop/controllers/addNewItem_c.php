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
              $edit = true;
          }
          else if($_POST['submit']=="Add")
              $str = "Add";
          
          $keys = "`id`, `p_name`, `category`, `cost`, `quantity`, `price`, `d_price`, `discount`, `image`";
          $itemsToAdd = assignArrWKeys(array_diff($_POST,array("submit"=>$str)), $keys);
      if($itemsToAdd==false)
         throw new Exception ("<h2 class='sectionTitle error'>stop trying to hack this solid structure</h2>");
            $rules = array(
            "id"=>"santasizeString",
            "p_name"=>"santasizeString",
            "category"=>"santasizeString",
            "cost"=>"santasizeFloat",
            "quantity"=>"santasizeInt",
            "price"=>"santasizeFloat",
            "d_price"=>"santasizeFloat",
            "discount"=>"santasizeFloat"
             );
            
            $itemsToAdd = $validator->santasizeArray($itemsToAdd, $rules);
            $rules = array(
            "id"=>"isValidRequired&isValidString",
            "p_name"=>"isValidRequired&isValidString&isNan",
            "cost"=>"isValidRequired&isValidFloat&isPlus",
            "quantity"=>"isValidRequired&isValidInteger&isPlus",
            "price"=>"isValidRequired&isValidFloat&isPlus",
            "d_price"=>"isValidRequired&isValidFloat&isPlus"
             );
            if($itemsToAdd['category']=="0"||!empty($itemsToAdd['category']))
            {
                $rules['category']="isValidString&isNan";
           
            }
            if($itemsToAdd['discount']=="0"||!empty($itemsToAdd['discount']))
            {
                  $rules['discount']="isValidFloat&isPlus";
            }
            $errors = $validator->validateArray($itemsToAdd, $rules);     
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
            if(!empty($itemsToAdd['discount'])&&!empty($itemsToAdd['d_price'])&&!empty($itemsToAdd['cost'])&&!$validator->isInRange(0, $itemsToAdd['d_price']-$itemsToAdd['cost'], $itemsToAdd['discount']))
            {
                $errorsMessages['discount']="the field is not valid";
            }
             $image=$_FILES['image'];
             $imageName=$itemsToAdd['id'].".".pathinfo($image['name'])["extension"];
             if(!empty($image['name']))
             if(!doesAccept($imageName,array('jpg','png','bmp','gif')))
             {
                $isThereError = true; 
                $errorsMessages['image']="the file must be an image";
             }
            if($isThereError)
            {
                 include 'views/addNewItem.php';
            }
            else 
                {
                 $addItems= new Add("product");
                 if($_POST['submit'] == "Add" && $addItems->dataExists('id',$itemsToAdd['id']))
                 {
                     include 'views/addNewItem.php';
                      echo "<h2 class='sectionTitle error' style='font-size:16px;clear:both'>Item with this id exists<h2>";
                     die();
                 }
                 else if($_POST['submit'] == "Edit" && !$addItems->dataExists('id',$oldId))
                     {
                      include 'views/addNewItem.php';
                      echo "<h2 class='sectionTitle error' style='font-size:16px;clear:both'>Item with this id doesn't exist<h2>";
                      die();
                     }
                 $itemsToAdd["total_cost"] = $itemsToAdd["cost"]*$itemsToAdd['quantity'];
                 $dir="resources/items/";
                 $path=$dir.$imageName;
                 if(!file_exists($dir))
                    mkdir($dir);
                 if(!empty($image['name']))
                     {
                       $upload= new Upload();
                       $upload->uploadFile($image['tmp_name'],$path);
                       $upload=NULL;
                       $itemsToAdd['image']=$path;
                  }
          

                
                 if($_POST['submit'] == "Add")
                  {
                 
                     $addItems->addData($itemsToAdd);                 
                     $addItems->close();
                 }
                 else if($_POST['submit'] == "Edit")
                 {
                   
                     $editItemObj = new Update("product");
                     $editItemObj->updateDataById('id', $oldId, $itemsToAdd);
                     $editItemObj->close();
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
            include 'views/addNewItem.php';
            }
