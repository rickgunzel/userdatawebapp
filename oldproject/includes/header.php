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
    
    
    $_SESSION['boolean']=true;
    $username="";
    if (!empty($_REQUEST['user'])&& !empty($_REQUEST['pass'])) {
        $username = mysql_real_escape_string($_REQUEST['user']); 
        $userpass = mysql_real_escape_string($_REQUEST['pass']); 

        $sql ="SELECT * FROM customers WHERE username= '$username'AND pass=SHA1('$userpass')" ;
        $result=mysqli_query($dbc, $sql);
        $count=mysqli_num_rows($result);
        
        if ($count==1){
        $_SESSION['boolean']=false;
        $_SESSION['username']=$username;
        $_SESSION['pass']=$userpass;


        }else{
            echo 'Username or Password Incorrect. If you have not registered yet, Please Register Now!';
        }
  

    }//end if 
    
   
    if($_SESSION['boolean']==true) {
        echo'<p>You need to login</a> or <a href="start.php">register.</a></p>
        
        <form action="index.php" method="post">
            <div class="field">
                <label for="username">Username</label>
                <input type="text" name="user" id="username">
            </div>
            <br/>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="pass" id="password">
            </div>
            <br/>
            <input type="submit" value="Login">
        </form>';
    } else{
        echo '<p><a href="profile.php">'.$username.'</a> Logged In!</p>';
        echo '<a href="logout.php">Log Out<a>';
    }   
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
