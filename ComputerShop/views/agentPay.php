
        <?php
session_start();
if(!isset($_SESSION['userName']))
{
    
    header('Location:index.php');
    die();
    
}
try{
    
     $displayObject = new Display("agent");
     $agentName = $displayObject->getColumnDataById("id", $agentId, "ag_name");
     $remaining = $displayObject->getColumnDataById("id", $agentId, "remaining");
     $displayObject->close();
     $displayObject = null;
    }
    catch (Exception $ex)
    {
     echo $ex->getMessage();
    }


?>
        <h2 class="sectionTitle"><?php echo"pay for <span style= 'color:grey;'>{$agentName['ag_name']}</span>"; ?></h2>
      
        <form class="formSection" id="payForAgents" name="payForAgents" method="post" action="?page=controllers/agentPay_c" autocomplete="on" enctype="multipart/form-data">
            <label for="paymentAmount">Payment Amount</label><input  id="paymentAmount"  class="<?php  $st = ";document.getElementsByClassName('errorSpans')[0].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages["paymentAmount"]))echo "errorFields\"oninput = \"$st1$st\"";?>" name="paymentAmount"   type="tel"  placeholder="maximum is <?php echo $remaining['remaining']?>" onfocus="this.placeholder=''" onblur="this.placeholder='maximum is <?php echo $remaining['remaining']?>'" class="" type="number" value="<?php if($errorsMessages['paymentAmount']==null)echo $paymentAmount; ?>"><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['paymentAmount'] ?></span></span><br/>
            <input name="id" type="hidden" value="<?php echo $agentId?>">
            <input id="pay" name="submit" type="submit" value="Pay" class="btn btn-primary">
        </form>
         
    