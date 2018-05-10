
        <?php
session_start();
if(!isset($_SESSION['userName']) || $_SESSION['privilege']!=1)
{
    
    header('Location:index.php');
    die();
    
}



?>
        <h2 class="sectionTitle"><?php if($edit==true)echo"edit {$agentToDisplay['ag_name']}$agentId"; else echo"Add new Agent";?></h2>
      
        <form class="formSection" id="addNewAgent" name="addNewAgent" method="post" action="?page=controllers/addNewAgent_c" autocomplete="on" enctype="multipart/form-data">
            <label for="agentName">agent Name</label><input id="agentName" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[0].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages["ag_name" ]))echo "errorFields\"oninput = \"$st1$st\"";?>" name="agentName" type="text"  placeholder="Enter agent name here !" onfocus="this.placeholder=''" onblur="this.placeholder='Enter agent name here !'" value="<?php if($errorsMessages['ag_name']==null)echo $agentsToAdd['ag_name']; if($edit == true)  echo $agentToDisplay['ag_name'];?>"><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['ag_name'] ?></span></span><br/>
            <label for="agentPhone">agent phone</label><input id="agentPhone" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[1].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if ($errorsMessages["phone"]!="*")if(!empty($errorsMessages["phone"]))echo "errorFields\"oninput = \"$st1$st\"";?>" name="agentPhone" type="text"  placeholder="Enter phone here !" onfocus="this.placeholder=''" onblur="this.placeholder='Enter phone here !'" value="<?php if($errorsMessages['phone']==null)echo $agentsToAdd['phone']; if($edit == true)  echo $agentToDisplay['phone'];?>" autocomplete="off"><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['phone'];?></span></span><br/>
            <label for="agentEmail"> agent E-mail</label><input id="agentPhone" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[2].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages["email"]))echo "errorFields\"oninput = \"$st1$st\"";?>" name="agentEmail" type="text"  placeholder="Enter E-mail here !" onfocus="this.placeholder=''" onblur="this.placeholder='Enter E-mail here !'" value="<?php if($errorsMessages['email']==null)echo $agentsToAdd['email']; if($edit == true)  echo $agentToDisplay['email'];?>"><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['email'] ?></span></span><br/>
            <label for="agentTotalDebt">total debt</label><input id="agentTotalDebt" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[3].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages["total_debt" ]))echo "errorFields\"oninput = \"$st1$st\"";?>" name="agentTotalDebt" type="text"  placeholder="Enter total debt here !" onfocus="this.placeholder=''" onblur="this.placeholder='Enter total debt here !'" value="<?php if($errorsMessages['total_debt']==null)echo $agentsToAdd['total_debt']; if($edit == true)  echo $agentToDisplay['total_debt'];?>"><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['total_debt'] ?></span></span><br/>
            <label for="agentPaid">paid amount</label><input id="agentPaid" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[4].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages["paid"]))echo "errorFields\"oninput = \"$st1$st\"";?>" name="agentPaid" type="text"  placeholder="Enter  paid money here !" onfocus="this.placeholder=''" onblur="this.placeholder='Enter paid money here !'" value="<?php if($errorsMessages['paid']==null)echo $agentsToAdd['paid']; if($edit == true)  echo $agentToDisplay['paid'];?>"><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['paid'] ?></span></span><br/>
            <label for="agentRedemetionDate">redemption date</label><input id="agentRedemetionDate" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[5].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages["redemption_date"]))echo "errorFields\"oninput = \"$st1$st\"";?>" name="agentRedemetionDate" type="text"  placeholder="redemetion date ex:03-03-2017 !" onfocus="this.placeholder=''" onblur="this.placeholder='redemtion date  ex:03-03-2017 !'" value="<?php if($errorsMessages['redemption_date']==null)echo $agentsToAdd['redemption_date']; if($edit == true)  echo $agentToDisplay['redemption_date'];?>"><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['redemption_date'] ?></span></span><br/>
            <?php if($edit==true) echo "<input name='oldId' type='hidden' value='{$agentId}'>";?>
            <input id="addAgent" name="submit" type="submit" value="<?php if($edit==true)echo"Edit"; else echo"Add";?>" class="btn btn-primary">
        </form>
         
