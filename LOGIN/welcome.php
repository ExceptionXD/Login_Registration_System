<?php include"functions/init.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
  
  <h1>Welcome to your Account</h1>
   <?php 
    
    if(logged_in()){
        return true ;
    }
    else{
        redirect('login.php');
    }

    ?>
    
    <h1>Welcome to your Account</h1>
</body>
</html>