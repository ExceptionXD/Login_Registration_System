<?php include"functions/init.php" ?>

<!Doctype html>
<html lang="en">
<head>
<title>Login system</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
    <div class="row">
    <div class="col-md-4"></div> 
        
        
    <div class="col-md-4">
        <h2 class="text-center"><strong>Activate Page </strong></h2>
        <br>
        
        <div class=" message text-center"> 
            <?php
           activate_user();

            if(activate_user){
                redirect("login.php");
            }
            ?>  </div>

    </div> 
        
        
    <div class="col-md-4"></div> 
    </div>
    </div>
    
<script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
<script src="js/custom.js"></script>
</body>
</html>