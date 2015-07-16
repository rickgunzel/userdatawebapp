<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" href="includes/style.css" type="text/css"  />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
   
	<div id="header">
                 
            <IMG SRC="./images/index.jpg" NAME="" ALIGN="right" WIDTH=200 HEIGHT=126 BORDER=0>
<?php 
                    
    session_Start(); 
    include ('includes/mysqli_connect.php');
     
           echo '<p><a href="profile.php">'.$_SESSION['username'].'</a> Logged In!</p>';
            echo '<a href="logout.php">Log Out<a>';
        
        
    ?>          
	</div>
    
     
	<div id="navigation">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="start.php">Register</a></li>
                        <?php
                       
                        if($_SESSION['boolean']==false) {
			echo'<li><a href="changepassword.php">Change password</a></li>
                            <li><a href="view_users.php">List all members</a></li>
                            <li><a href="edit_deleteusers.php">Edit or delete members</a></li>
                            <li><a href="view_userssort.php">Sort members</a></li>
                            <li><a href="view_userssearch.php">Search members</a></li>' ;       
                        }else{
                        echo'<li><a href="">Change password</a></li>
                            <li><a href="">List all members</a></li>
                            <li><a href="">Edit or delete members</a></li>
                            <li><a href="">Sort members</a></li>
                            <li><a href="">Search members</a></li>';    
                        
                        
                        
                        
                        }
                        ?>
			
            
			
                        
		</ul>
	</div>
    <hr />
   
	<div id="content"><!-- Start of the page-specific content. -->
<!-- Script 3.2 - header.html -->
