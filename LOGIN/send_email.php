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
    <?php 
        validate_forgot_email();
    ?>
        
    <div class="col-md-4">
        <h2 class="text-center"><strong>Send Email </strong></h2>
        <br>
        
        <div class=" message text-center">  
            
            
            <form action="#" method="post">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
            <br>
            <p>  <input type="submit" value="Send" class="form-control" ></p>
            </form>
        
        </div>

    </div> 
        
        
    <div class="col-md-4"></div> 
    </div>
    </div>
    
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/custom.js"></script>
</body>
</html>