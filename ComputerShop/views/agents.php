       <?php
       
       if($agents==false)
       {
      echo "<h2 class='generalmessage'>you have no agents</h2>";
       }

       else {
           include 'confirmModal.php';
           include 'agentsTable.php';   
       }
       
       
       
       
       ?>