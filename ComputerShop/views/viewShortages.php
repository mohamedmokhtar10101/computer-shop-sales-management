        <?php
        session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
        
        ?>        

       <?php
       
       if($shortages==false)
       {
           echo "<h2 class='sectionTitle'>You have no shortages</h2>";
       }

       else {
           include 'shortageTable.php';   
       }
       
       
       
       
       ?>
            
            
            