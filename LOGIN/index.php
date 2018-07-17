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
       <?php validate_user_register(); ?>
        <h2 class="text-center"><strong>Register</strong></h2>
        <div class="box">
        <div class="form-box">
        <form action="#" method="post">
        <p>
        <input type="text" name="first_name" placeholder="First Name" class="form-control" required>    
        </p>  
        <p>
        <input type="text" name="last_name" placeholder="Last Name" class="form-control" required>    
        </p>
        <p>
        <input type="text" name="username" placeholder="Userame" class="form-control" required>    
        </p> 
        <p>
        <input type="email" name="email" placeholder="Email" class="form-control" required>    
        </p> 
        <p>
        <input type="password" name="password" placeholder="Password" class="form-control" required>    
        </p> 
        <p>
        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>    
        </p> 
        <p>
        <input type="submit" name="submit" value="Register" class="form-control btn-success" required>    
        </p> 
            
            
            
        </form>
        
        </div>
        
        </div>
    </div> 
        
        
    <div class="col-md-4"></div> 
    </div>
    </div>
    <br><br>
    <hr>
    
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/custom.js"></script>
</body>
</html>