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
        <h2 class="text-center"><strong>Login </strong></h2>
        <br>
        <div class="box"> 
        <div class="form">
        <form action="#" method="post"> 
        <p>
        <input type="email" name="email" placeholder="Email" class="form-control" required>    
        </p> 
        <p>
        <input type="password" name="password" placeholder="Password" class="form-control" required>    
        </p> 
        <p><label for="remember">Remember Me</label>
        <input type="checkbox" name="remember" id="remember" checked >
        </p>
        <p>
            <a href="send_email.php">Forgot Username/Password</a>
        </p>
        <p>
        <input type="submit" name="submit" value="Login" class="form-control btn-success" required>    
        </p> 
            
            <?php validate_user_login(); ?>
            
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