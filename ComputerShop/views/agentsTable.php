        <?php
        session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
        
        ?>
     <div id="displayer"> 
         <span class="close" id='closePayments'>×</span>
          <img id="displayerContent"  style="margin: auto;display: block;width: 80%;max-width:700px;z-index:9999999">
          <div id="disItemsWrapper">
            </div>  
      </div>
<div class="formSection" style="margin:0 0!important;clear:both"><input oninput="filter(event,4,[4,5,6],[0,2,3,4],itemsTable,itemsFooter)" style="height:35px" type="text" placeholder="filter results" onfocus="this.placeholder=''" onblur="this.placeholder='filter results'" ></div>
<div class="tableParent">

    <table id="itemsTable" class=" table table-striped table-hover table-bordered">
                <thead>
                    <tr class="success">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Total Debt</th>
                        <th scope="col">Paid Amount</th>
                        <th scope="col">Remaining</th>
                        <th scope="col">Redemption Date</th>
                        <th scope="col">Enrolled Date</th>
                        <th scope="col">Action</th>

                    </tr>
                    
                    
                </thead>
                <tfoot>
                    <?php
                    $agentsCount = count($agents);
                    $total['total_debt']=0;
                    $total['paid']=0;
                    $total['remaining']=0;
                    for($i = 0; $i < $agentsCount; $i++ )
                    {
                    $total['total_debt']+=$agents[$i]['total_debt'];
                    $total['paid']+=$agents[$i]['paid'];
                    $total['remaining']+=$agents[$i]['remaining'];
                    }
                    
                    ?>
                    <tr class="success">
                        <th scope="row">Total <?php echo $agentsCount; ?> agents</th>
                        <td colspan="3"></td>
                        <th scope="col"><?php echo $total['total_debt']; ?> </th>
                        <th scope="col" ><?php echo $total['paid']; ?> </th>
                        <th scope="col" ><?php echo $total['remaining']; ?> </th>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                    
                    for($i = 0; $i < $agentsCount; $i++ )
                    {
                      if($agents[$i]['email']=="")
                          $agents[$i]['email']="none";
                      if($agents[$i]['paid']!=0)
                      {
                         $payments =  "<a title='show payments' class='action' id='payments'><img id='paymentsImg' src='{$site}show.png' onclick='displayPayments({$agents[$i]['id']},\"{$agents[$i]["ag_name"]}\")' alt='payments'></a>"; 
                      }
                      if($agents[$i]['remaining']!=0)
                      {
                          $payOrNot =  "<a title='pay' class='action' id='editAction' href='?page=controllers/viewAllAgents_c&action=pay&id={$agents[$i]["id"]}'><img src='{$site}pay.png'></a>";
                      }
                      if($_SESSION['privilege']==1)
                    {
                      $privileged = " <a title ='delete this agent' class='action' id='deleteAction' style='cursor:pointer' data-id='{$agents[$i]["id"]}' onclick='displayConfirmModal(event,\"viewAllAgents_c\")'><img src='{$site}delete.png'/></a>
                        <a title='edit this agent' class='action' id='editAction' href='?page=controllers/viewAllAgents_c&action=edit&id={$agents[$i]["id"]}'><img src='{$site}edit.png'></a>";
                    }
                        echo "<tr>";
                        echo "
                    <td>{$agents[$i]['id']}</td>
                    <td>{$agents[$i]['ag_name']}</td>
                    <td>{$agents[$i]['phone']}</td>
                    <td>{$agents[$i]['email']}</td>
                    <td>{$agents[$i]['total_debt']}</td>  
                    <td>{$agents[$i]['paid']}</td>
                    <td>{$agents[$i]['remaining']}</td>
                    <td>{$agents[$i]['redemption_date']}</td>
                    <td>{$agents[$i]['date_']}</td>
                    <td class='actionTd'>
                        $privileged
                        $payOrNot   
                        $payments
                    </td>";
                    echo "</tr>";
                    }
                    
                            
                            
                            
                    ?>
                   
                </tbody>
            
            </table>    
</div>