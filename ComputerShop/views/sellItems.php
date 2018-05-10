   <?php
        session_start();
if(!isset($_SESSION['userName']))
{
    header("location:index.php");

    die();
}
        
        ?>
<?php
        function displayItems($cols)
{
    try {
       
        $itemsObj = new Display("product");
        return $itemsObj->getAllColumnsData($cols);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
                  
} 
           
?>

        <h2 class="sectionTitle">sell item</h2>
        <form class="formSection" id="sellItemForm" name="sellItemForm" method="post" action="" autocomplete="on">
      
        <label id="" for="itemToSell">Select an item to sell</label>
        <select id="itemToSell" name="itemToSell" onchange="if (this.value != ''){itemQuantity(this.value);itemImage(this.value)} " >
            <option value="">select an item</option>
            <optgroup label="ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name">
                
                <?php 
                $items =displayItems(array("id","p_name","quantity"));
                foreach ($items as $key=>$value)
                {
                  
                  
                    if($value['quantity'] == 0)
                        continue;
                      
                            echo"<option value='{$value['id']}'>{$value['id']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$value['p_name']}</option>";
                         
                   
                }
                
                ?>
                
              </optgroup>
        </select>
        <label for="quantity">quantity</label> <input type="number" id="quantity" name="quantity"  value="1" min="1" max="" class="<?php  $st = ";document.getElementsByClassName('errorSpans')[0].innerHTML = ' '";$st1="this.className ='recoveryFields'" ;if(!empty($errorMessage))echo "errorFields\"oninput = \"$st1$st\"";?>"><span class="parentSpan"><span class="errorSpans"><?php echo $errorMessage; ?></span></span>
        <label for="makeDiscount" >discount </label><label class="switch"><input type="checkbox" id="makeDiscount" name="makeDiscount"  value="Yes" ><div class="slider round"></div>discount</label>
        <label  for="isDealer">dealer </label><label class="switch"><input type="checkbox" id="isDealer" name="isDealer"  value="Yes" ><div class="slider round"></div>dealer</label>
         <input id="sellItembtn" name="submit" type="submit" value="Sell" class="btn btn-primary">
         <image src="" id="imageToSell" alt="" />
         <h2  id="message"><?php echo $message;?></h2>   
        </form>
      