<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if(!isset($_SESSION["userName"]))
{
    include 'includes/vars.php';
    
    header("location:controllers/login_c.php");
    die();
}
$privilege = $_SESSION['privilege'];
if($privilege !=1)
    $displayNone="display:none";
date_default_timezone_set("Africa/Cairo");
          include'includes/autoLoader.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Albostan Sales Manager</title>
        <meta name="description" content="a computer shop application for handling sales and repository">
        <meta name="keywords" content="computer shop application , sales ,  repository manager">
        <meta name="author" content="Mohamed MOkhtar">
        <link href="styles/fonts-min.css" rel="stylesheet" type="text/css"/>
        <link href="styles/reset-min.css" rel="stylesheet" type="text/css"/>
        <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="styles/styles.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <link href="icon.png" rel="icon">
    </head>
    <body onload="endLoad()" >
        <div id="loader"></div>
        <header id="mainHeader">
            
         
         
            <a href='index.php' class="logoborder">  <div id="logo">
                </div>
              </a>
         
            <h3 id="welcome">Welcom <?php echo $_SESSION["userName"];?>  <a href="?page=controllers/logout_c" class="btn btn-toolbar"><span class="glyphicon glyphicon-user"></span> Logout</a></h3>
           
        </header>
        <div class="clearfix"></div>
        <section id="container" >
            <aside id="sidebar">
                <nav id="nav">
                    <a  style="font-size:15px;" onclick="toggle(this)" class="toggle"><div class="bar1"></div><div class="bar2"></div> <div class="bar3"></div></a>
                    <ul id="navMenu">
                        <li class="navElement"><a class="btn btn-primary <?php if($_GET['page']=='controllers/addNewItem_c')echo 'active'?>" style="<?php if($_GET['page']=='controllers/addNewItem_c')echo 'background-color:white;color:#3399ff;border:2px solid #3399ff; ';if($_SESSION['privilege']!=1)echo ";display:none;";?>" href="?page=controllers/addNewItem_c#content">Add new item</a></li>
                      <li class="navElement"><a class="btn btn-primary <?php if($_GET['page']=='controllers/viewItems_c')echo 'active'?>" style="<?php if($_GET['page']=='controllers/viewItems_c' || $_GET['page']=='views/editItem')echo 'background-color:white;color:#3399ff;border:2px solid #3399ff;';if($_SESSION['privilege']!=1)echo ";display:none;";?>" href="?page=controllers/viewItems_c#content">View , Edit and Delete items</a></li>
                      <?php if($privilege==1)
                      {
                          $agent ="'";
                          if($_GET['page']=='controllers/addNewAgent_c' || $_GET['page']=='views/addNewAgent')
                              $agent = "active' style='background-color:white;color:#3399ff;border:2px solid #3399ff;'";
                          echo"<li class='navElement'><a class='btn btn-primary $agent' href='?page=controllers/addNewAgent_c#content'>Add agent</a></li>";
                             $agentView = "View ,Edit ,pay and Delete agents";
                     
                          
                          
                      }
                      else
                      {
                          $agentView = "View and pay  agents";
                      }
                          ?>
                      
                              <li class='navElement' id = 'viewAgents'><a class='btn btn-primary'><?php echo $agentView?></a> 
                              <ul class='subMenu' id='viewAgentsSub' >
                              <li>
                                  <a class='btn btn-primary'  href='?page=controllers/viewAllAgents_c'>All</a>
                              </li>
                              <li>
                                  <a class='btn btn-primary'  href='?page=controllers/viewDebtedAgents_c'>debted</a>
                              </li>
                          </ul></li>
                      <li class='navElement'><a class='btn btn-primary'>Add dealer</a></li>
                      <li class='navElement'><a class='btn btn-primary'>View ,Edit and Delete dealers</a></li>
                      <li class="navElement"><a class="btn btn-primary <?php if($_GET['page']=='controllers/sellItems_c')echo 'active'?>" style="<?php if($_GET['page']=='controllers/sellItems_c' || $_GET['page']=='views/sellItem')echo 'background-color:white;color:#3399ff;border:2px solid #3399ff;'?>" href="?page=controllers/sellItems_c#content">Sell items</a></li>
                      <li class="navElement" id="viewSales"><a class="btn btn-primary" >View sales</a>
                      
                          <ul class="subMenu" id="viewSalessub" <?php if($_GET['page']=='controllers/salesByYear_c'||$_GET['page']=='controllers/salesByMonth_c'||$_GET['page']=='controllers/salesByDay_c')echo 'style="display:block"';?>>
                              <li>
                                  <a class="btn btn-primary <?php if($_GET['page']=='controllers/salesByYear_c')echo 'active subActive'?>"  href="?page=controllers/salesByYear_c#content">By year</a>
                              </li>
                              <li>
                                  <a class="btn btn-primary <?php if($_GET['page']=='controllers/salesByMonth_c')echo 'active subActive'?>"  href="?page=controllers/salesByMonth_c#content">By month</a>
                              </li>
                              <li>
                                  <a class="btn btn-primary <?php if($_GET['page']=='controllers/salesByDay_c')echo 'active subActive'?>"  href="?page=controllers/salesByDay_c#content">By day</a>
                              </li>
                          
                          
                          </ul>
                          
                          
                      </li>
                      <li class="navElement"><a class="btn btn-primary<?php if($_GET['page']=='controllers/viewShortages_c')echo 'active'?>" style="<?php if($_GET['page']=='controllers/viewShortages_c' || $_GET['page']=='views/viewShortages')echo 'background-color:white;color:#3399ff;border:2px solid #3399ff;'?>" href="?page=controllers/viewShortages_c#content">View shortages</a></li>
                      <li class="navElement"><a class="btn btn-primary<?php if($_GET['page']=='controllers/makeOrder_c')echo 'active'?>" style="<?php if($_GET['page']=='controllers/makeOrder_c' || $_GET['page']=='views/makeOrder')echo 'background-color:white;color:#3399ff;border:2px solid #3399ff;'?>" href="?page=controllers/makeOrder_c#content">Make order</a></li>
                      <li class="navElement"><a class="btn btn-primary" href="">View orders</a></li>
                    </ul>
                    
                </nav>
            </aside>
            <section id="content">
                   
      <?php 

      try {
           $validator = new Validator();
           $_GET = $validator->santasizeArray($_GET);
          if(isset($_GET['page']) && $_GET['page'])
          {
              $url=$_GET['page'].".php";
              
              if(is_file($url) && file_exists($url))
              include $url;
              else
                  echo"<h2 class='sectionTitle error'>ther requested file is not found</h2>";
          }
          else
              echo"<h2 class='sectionTitle'>Welcome To My strongHold Master Just Command Me <br/><span class='smile'><span class='eye'>:</span>)</span></h2><div class='loading'>:::</div>" ;
      
         } catch (Exception $ex) {
          $ex->getMessage();
      }
        
        
        ?>
               
                 
            </section>
        </section>
        <footer id="footer">
            <address>
                All rights reserved - copyright Mohamed Mokhtar.
                
            </address>
        </footer> <!--<div id="google_translate_element"></div>
 <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
<script>
var myVar;
function toggle(x) {
    x.classList.toggle("change");

         
   
        
    }
function endLoad() {
    
    showPage();
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("container").style.display = "block";
  document.getElementById("mainHeader").style.display = "block";
   document.getElementById("footer").style.display = "block";

}
</script>
<script>
    $(document).ready(function(){
  $("#viewSales").click(function(){
    $("#viewSales .subMenu").slideToggle("slow");
  });
    $(".toggle").click(function(){
    $("#navMenu").slideToggle("slow");
  });
  $("#viewAgents").click(function(){
    $("#viewAgents .subMenu").slideToggle("slow");});
});

</script>
<script>
    function getItemData(event)
    {
        var tds = event.currentTarget.parentElement.parentElement.children;
        var itemData = [];
        for(var i =0;i<tds.length-2;i++)
        {
            itemData[i] = tds[i].innerHTML;
        }
        return itemData;
            
    }
   
    function printItemData(arr,out)
    {
        var a;
       var  names = ["ID" ,"Name" ,"Category" ,"Quantity" ,"Cost","Price" ,"Price for dealers" ,"Discount Amount" ,"total cost" ,"Sold Quantity" ,"Money for sold" ,"Earnings","Image"];

       var all;
        all="<div class='elementSection'>";

        for(var i =0;i<names.length;i++)
        {
          all+= "<div class='displayerElements'><span class='sp1'>"+names[i]+" : <span class='sp2'>"+arr[i]+"</span></span></div>";
        }
         

        all+="</div>";
       out.innerHTML=all;
    }
    function showItem(id,targetId,scriptPage) {


        

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               document.getElementById(targetId).innerHTML += xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST", scriptPage, true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
    
}
    var modal = document.getElementById('displayer');
    var modalImg = document.getElementById("displayerContent");
    var captionText = document.getElementById("displayerCaption");
    var disItemsWrapper = document.getElementById("disItemsWrapper");
    var confirmModal = document.getElementById("confirmDeleteDisplayer");
    var confirmYes = document.getElementById("confirmYes");
    var confirmNo = document.getElementById("confirmNO");
    var SellQuantity = document.getElementById("quantity");
    var imageToSell = document.getElementById("imageToSell");
    if( document.getElementById("itemsTable")){
    var itemsTable = document.getElementById("itemsTable").querySelectorAll("tbody tr");
    var itemsFooter = document.getElementById("itemsTable").querySelectorAll("tfoot tr");
    }
    var salesMonth = document.getElementById("salesMonth");
    var salesDay = document.getElementById("salesDay");
    var salesYear = document.getElementById("salesYear");
    function filter(event,count,indexes1,indexes2,trs,footer)
    {

        var total = [];
for(var j=0;j<count;j++)
total[j]=0;
        for(var i =0;i<itemsTable.length;i++)
        {
             itemsTable[i].style.display="table-row";
        }
        var q = event.currentTarget.value;
        q=q.toLowerCase();
        for(var i =0;i<itemsTable.length;i++)
        {  
            name = itemsTable[i].children[1].innerHTML;
            name =name.toLowerCase();
            len = name.length;
             
            pos = name.search(q.substr(0,len));   
          if (pos==-1) 
              {
                     
              itemsTable[i].style.display="none";
               }
               else
               {
  
              incrementTotal(total,indexes1,trs,i);
               }
        
        
    }
     setTotal(total,indexes2,footer);


    }
    function setTotal(total,indexes,footer)
    {
        
        footer[0].children[0].innerHTML="Total "+total[0]+" items";
        for(var i =1;i<indexes.length;i++)
        {
          
             footer[0].children[indexes[i]].innerHTML=total[i];
    }
    }
        function incrementTotal(total,indexes,trs,i)
    { 
                     total[0]++;
        for(var j =0;j<indexes.length;j++)
        {
           
             total[j+1]+=Number(trs[i].children[indexes[j]].innerHTML);
    }
    }
     function itemQuantity(id) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var out = xmlhttp.responseText;
               SellQuantity.setAttribute("max",out);
               SellQuantity.setAttribute("value",out);
            }
        }
         
        xmlhttp.open("POST", "controllers/getItemQuantity.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        xmlhttp.send("id="+id);
    
}
 function itemImage(id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
            
            var out = xmlhttp.responseText;
            if(out!="")
            {
                imageToSell.style.display = "block";
            }
               imageToSell.setAttribute("src",out);
               
            }
        }
         
        xmlhttp.open("POST", "controllers/getItemImage.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
    
}
function getYearMonths(year) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
            
           document.getElementById("salesMonth").innerHTML= xmlhttp.responseText;
    
        }
    }
         
        xmlhttp.open("POST", "controllers/getYearMonths.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("id="+year);
    
    }
    function getMonthDays(month) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
            
          document.getElementById("salesDay").innerHTML= xmlhttp.responseText;
    
        }
    }
 
        xmlhttp.open("POST", "controllers/getMonthDays.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("m="+month+"&y="+document.getElementById("salesYear").value);
    
    }
    function displayModal(event)
{
    modal.style.display = "block";
    modalImg.src = event.currentTarget.src;
    modalImg.alt = event.currentTarget.alt;
    showItem(modalImg.alt,'disItemsWrapper',"controllers/getItem.php");
    var itemArr = getItemData(event);
      if(modalImg.src.indexOf("index.php")!=-1)
    {
        itemArr[itemArr.length]="the item has no image";
        modalImg.alt="";
        modalImg.innerHTML="No Image available";
        modalImg.style=" background-color: initial;font-family: cursive;font-size: 29px;text-align: center;color: white;";
    }
    else
    {
            itemArr[itemArr.length]=modalImg.src;
    }
 
    printItemData(itemArr,disItemsWrapper);
    modal.focus();
    
}
if(document.getElementsByClassName("close")[0]){
var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
 modal.style.display = "none";
};
}
if(document.getElementsByClassName("close")[1]){
var span2 = document.getElementsByClassName("close")[1];
span2.onclick = function() { 
 confirmModal.style.display = "none";
};
}
/*modal.onclick = function() { 
    modal.style.display = "none";
};*/
if(confirmModal){
confirmModal.onclick = function() { 
    confirmModal.style.display = "none";
};
}
       document.onkeyup=function(e) {
     if (e.keyCode == 27) { // escape key maps to keycode `27`
       modal.style.display = "none";
       confirmModal.style.display="none";
    } };
    function displayConfirmModal(event,page)
    {
     confirmModal.style.display = "block";
    confirmYes.href = "?page=controllers/"+page+"&action=delete&id="+event.currentTarget.getAttribute('data-id')+"&confirm=Yes";


    }
    if(confirmNo){
    confirmNo.onclick = function() { 
    confirmModal.style.display = "none";
};
    }
    document.getElementById("closePayments").onclick  = function(event)
    {
        document.getElementById('displayer').style = "display:none;";
    };
    function displayPayments(id,agentName)
    {
     modal.style.display = "block";
     document.getElementById("disItemsWrapper").innerHTML = "<div class=\"elementSection\" style='margin-bottom:10px;margin-top:150px'><div class='displayerElements' style='background-color:initial;'><span style='color:wheat'>"+agentName+"</span> payments</div></div>";
     showItem(id,'disItemsWrapper',"controllers/getPayments_c.php");

        
        
    }


function displayLoading()
{
    var x=document.getElementsByClassName("loading")[0];
    x.style.display="block";
    
}
function hideLoading()
{
    var x=document.getElementsByClassName("loading")[0];
    x.style.display="none"; 
}
    </script>
    </body>
</html>
