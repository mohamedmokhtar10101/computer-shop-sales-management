        <?php
        session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
        
        ?>
<div class="formSection" style="margin:0 0!important;clear:both"><input oninput="filter(event,3,[4,7],[0,2,4],itemsTable,itemsFooter)" style="height:35px" type="text" placeholder="filter results" onfocus="this.placeholder=''" onblur="this.placeholder='filter results'" ></div>
<div class="tableParent">

    <table id="itemsTable" class=" table table-striped table-hover table-bordered">
                <thead>
                    <tr class="success">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Dealer</th>
                        <th scope="col">profit</th>
                        <th scope="col">Image</th>

                    </tr>
                    
                    
                </thead>
                <tfoot>
                    <?php
                    $salesCount = count($sales);
                    $total['quantity']=0;
                    $total['profits']=0;
                    for($i = 0; $i < $salesCount; $i++ )
                    {
                    $total['quantity']+=$sales[$i]['quantity'];
                    $total['profits']+=$sales[$i]['profit'];
                    }
                    
                    ?>
                    <tr class="success">
                        <th scope="row">Total <?php echo $salesCount; ?> items</th>
                        <td colspan="3"></td>
                        <td><?php echo $total['quantity']; ?> </th>
                        <td colspan="2"></td>
                        <td><?php echo $total['profits']; ?> </th>
                        <td colspan="1"></td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                    
                    for($i = 0; $i < $salesCount; $i++ )
                    {
                       if($sales[$i]['discount'])
                          $sales[$i]['discount']="yes";
                      else 
                         $sales[$i]['discount']="no" ;
                      
                       if($sales[$i]['agent'])
                           $sales[$i]['agent']="yes";
                       else 
                           $sales[$i]['agent']="no";
                       
                        echo "<tr>";
                        echo "
                    <td>{$sales[$i]['product_id']}</td>
                    <td>{$sales[$i]['name']}</td>
                    <td>{$sales[$i]['year_']}-{$sales[$i]['month_']}-{$sales[$i]['day_']}</td>
                    <td>{$sales[$i]['time_']}</td>
                    <td>{$sales[$i]['quantity']}</td>
                    <td>{$sales[$i]['discount']}</td>  
                    <td>{$sales[$i]['agent']}</td>
                    <td>{$sales[$i]['profit']}</td>  
                    <td><img id='itemImageT' src='{$images[$i]['image']}' alt='{$sales[$i]['product_id']}'/></td>";
                    echo "</tr>";
                    }
                    
                            
                            
                            
                    ?>
                   
                </tbody>
            
            </table>    
</div>