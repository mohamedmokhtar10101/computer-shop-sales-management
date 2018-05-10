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
        <select id="salesYear" name="salesYear" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[0].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorsMessage))echo "errorFields\"oninput = \"$st1$st\"";?>">      
   <?php
                    $yearsCount = count($salesyear);
                 
                    for($i = 0; $i < $yearsCount; $i++ )
                    {
              
                         echo"<option value='{$salesyear[$i]['year_']}'>{$salesyear[$i]['year_']}</option>";
  
                    }
                    
           ?>
            
        </select><span class="parentSpan"><span class="errorSpans"><?php echo $errorsMessage?></span></span>    
        <input type="submit" name="submit" value="Select"  class="btn btn-primary">
           </form>
        </section>
       <?php
       
       if($sales==false)
       {
         echo "<h2 class='generalmessage' sytle='clear: both'>there is no sales in this year</h2>";
       }

       else {
           include 'sales.php';   
       }
       
       
       
       
       ?>
            
            
            