        <?php
        session_start();
if(!isset($_SESSION['userName'])|| $_SESSION['privilege']!=1)
{
    header("location:index.php");

    die();
}
        
        ?>
<h2 class="sectionTitle">View Edit and Delete items</h2>
       
        <section id="itemIdSelectSection">
            <form name="ItemToEdit" method="post" action="" autocomplete="on">
        <label id="itemdIdSelectLabel" for="itemIdSelect">Select an item to edit</label>
        <select id="itemIdSelect" name="itemToEdit">
            <optgroup label="ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name">            
   <?php
                    $ItemsCount = count($itemsData);
                 
                    for($i = 0; $i < $ItemsCount; $i++ )
                    {
                        if($i==0)
                         echo"<option value='{$itemsData[$i]['id']}' selected='selected'>{$itemsData[$i]['id']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$itemsData[$i]['p_name']}</option>";
                        else 
                         echo"<option value='{$itemsData[$i]['id']}'>{$itemsData[$i]['id']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$itemsData[$i]['p_name']}</option>";

                     
                         
                    }
                    
           ?>
            
              </optgroup>
        </select>    
        <input type="submit" name="submit" value="Select" id="selectId" class="btn btn-primary">
           </form>
        </section>
        <div id="displayer"> 
          <span class="close">×</span>
          <img id="displayerContent"  style="margin: auto;display: block;width: 80%;max-width:700px;z-index:9999999">
          <div id="disItemsWrapper">
            </div>  
      </div>
      <?php include 'confirmModal.php'?>

        <div class="formSection" style="margin:0 0!important;clear:both"><input oninput="    filter(event,6,[3,8,9,10,11],[0,2,4,5,6,7],itemsTable,itemsFooter)" style="height:35px" type="text" placeholder="filter results" onfocus="this.placeholder=''" onblur="this.placeholder='filter results'" ></div>
        <div class="tableParent">    
        <table id="itemsTable" class=" table table-striped table-hover table-bordered">
                <thead>
                    <tr class="success">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Price</th>
                        <th scope="col">Price for dealers</th>
                        <th scope="col">Discount Amount</th>
                        <th scope="col">total cost</th>
                        <th scope="col">Sold Quantity</th>
                        <th scope="col">Money for sold</th>
                        <th scope="col">Earnings</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>

                    </tr>
                    
                    
                </thead>
                <tfoot>
                    <tr class="success">
                  <?php
                  
                    $total['quantity']=0;
                    $total['sold_quantity']=0;
                    $total['cost']=0;
                    $total['money']=0;
                    $total['profits']=0;
                    for($i = 0; $i < $ItemsCount; $i++ )
                    {
                    $total['quantity']+=$itemsData[$i]['quantity'];
                    $total['sold_quantity']+=$itemsData[$i]['sold_quantity'];
                    $total['cost']+=$itemsData[$i]['total_cost'];
                    $total['money']+=$itemsData[$i]['total_money'];
                    $total['profits']+=$itemsData[$i]['profits'];
                    }
                        
                   ?>
                        <th scope="row">Total <?php echo $ItemsCount; ?> items</th>
                        <td colspan="2"></td>
                        <td ><?php echo $total['quantity']; ?></td>
                        <td colspan="4"></td>
                        <td><?php echo $total['cost']; ?></td>
                        <td><?php echo $total['sold_quantity']; ?></td>
                        <td><?php echo $total['money']; ?></td>
                        <td><?php echo $total['profits']; ?></td>
                        <td colspan="3"></td>
                        
                    </tr>
                </tfoot>
                <tbody>
                    <?php 

                    
                    for($i = 0; $i < $ItemsCount; $i++ )
                    {
                        echo "<tr>";
                        echo "
                    <td>{$itemsData[$i]['id']}</td>
                    <td>{$itemsData[$i]['p_name']}</td>
                    <td>{$itemsData[$i]['category']}</td>
                    <td>{$itemsData[$i]['quantity']}</td>
                    <td>{$itemsData[$i]['cost']}</td>
                    <td>{$itemsData[$i]['price']}</td>
                    <td>{$itemsData[$i]['d_price']}</td>
                    <td>{$itemsData[$i]['discount']}</td>
                    <td>{$itemsData[$i]['total_cost']}</td>
                    <td>{$itemsData[$i]['sold_quantity']}</td>
                    <td>{$itemsData[$i]['total_money']}</td>
                    <td>{$itemsData[$i]['profits']}</td>
                    <td><img id='itemImageT' src='{$itemsData[$i]['image']}' onclick='displayModal(event)' alt='{$itemsData[$i]['id']}'/></td>
                    <td>
                        <a title ='delete this item' class='action' id='deleteAction' style='cursor:pointer' data-id='{$itemsData[$i]["id"]}' onclick='displayConfirmModal(event,\"viewItems_c\")'><img src='{$site}delete.png'/></a>
                        <a title='edit this item' class='action' id='editAction' href='?page=controllers/viewItems_c&action=edit&id={$itemsData[$i]["id"]}'><img src='{$site}edit.png'></a>
                    </td>";
                    echo "</tr>";
                    }
                    
                            
                            
                            
                    ?>
                   
                </tbody>
            
            </table>    
            
            
</div>