<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if(isset($_SESSION['userName']))
{
    
    header('Location:../index.php');
    die();
    
}



?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Albostan Sales Manager</title>
        <meta name="description" content="a computer shop application for handling sales and repository">
        <meta name="keywords" content="computer shop application , sales ,  repository manager">
        <meta name="author" content="Mohamed MOkhtar">
        <link href="../icon.png" rel="icon">
        <link href="../styles/fonts-min.css" rel="stylesheet" type="text/css"/>
        <link href="../styles/reset-min.css" rel="stylesheet" type="text/css"/>
        <link href="../styles/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../styles/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        
        
        

        <section id="login">
           <h1>Login To The Application</h1>
            <?php include "../includes/vars.php"?>
           <span class="error"><?php echo $message?></span>
            <form id="loginForm" name="loginForm" method="post" action="../controllers/login_c.php" autocomplete="on">
                <input class = "input-lg" id="userName" name="userName" type="text" placeholder="Enter your user name here !" onfocus="this.placeholder=''" onblur="this.placeholder='Enter your user name here !'">
                <input class = "input-lg " id="userPassword" name="userPassword" type="password"  placeholder="Enter password here !" onfocus="this.placeholder=''" onblur="this.placeholder='Enter password here !'" >
                <input class = "btn-lg btn-primary" id="LoginBtn" type="submit" value="Login" onmousedown="this.classList.remove('btn-primary');this.classList.add('btn-success');" onmouseup="this.classList.remove('btn-success');this.classList.add('btn-primary');" onmouseout="this.classList.remove('btn-success');this.classList.add('btn-primary');">
            </form>
            
            
            
        </section>

    </body>
</html>
