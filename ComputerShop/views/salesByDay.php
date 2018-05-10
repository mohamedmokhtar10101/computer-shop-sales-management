        <?php
        session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
        
        ?> 
<h2 class='sectionTitle'>view sales in a  year</h2>
 <section class="formSection">
            <form name="salesByYear" method="post" action="" autocomplete="on">
        <label  for="salesYear">Select a year</label>
        <select id="salesYear" name="salesYear" onchange="if (this.value != ''){getYearMonths(this.value)} " class="<?php  $st = ";document.getElementsByClassName('errorSpans')[0].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages['salesYear']))echo "errorFields\"oninput = \"$st1$st\"";?>">      
            <option value='' selected="selected">select a year</option>  
 <?php
                    $yearsCount = count($salesyear);
                 
                    for($i = 0; $i < $yearsCount; $i++ )
                    {
              
                         echo"<option value='{$salesyear[$i]['year_']}'>{$salesyear[$i]['year_']}</option>";
  
                    }
                    
           ?>
            
        </select><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['salesYear']?></span></span>
        <label  for="salesMonth">Select a month</label>
        <select id="salesMonth" name="salesMonth" onchange="if (this.value != ''){getMonthDays(this.value)} " class="<?php  $st = ";document.getElementsByClassName('errorSpans')[1].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages['salesMonth']))echo "errorFields\"oninput = \"$st1$st\"";?>">      
   
            <option value='' selected="selected">select a month</option> 
            <?php
                   
                 
                    for($i = 1; $i <=12; $i++ )
                   {
              
                       echo"<option value='{$i}'>{$i}</option>";
  
                   }
                    
           ?>
            
        </select><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['salesMonth']?></span></span>  
        <label  for="salesDay">Select a day</label><select id="salesDay" name="salesDay" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[2].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessages['salesDay']))echo "errorFields\"oninput = \"$st1$st\"";?>">      
   <?php
                   
                 
                    for($i = 1; $i <=31; $i++ )
                   {
              
                       echo"<option value='{$i}'>{$i}</option>";
  
                   }
                    
           ?>
            
        </select><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessages['salesDay']?></span></span>    
        <input type="submit" name="submit" value="Select"  class="btn btn-primary">
           </form>
        </section>
       <?php
       
       if($sales==false)
       {
      echo "<h2 class='generalmessage'>there is no sales in this day</h2>";
       }

       else {
           include 'sales.php';   
       }
       
       
       
       
       ?>
            
            
            