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
        <h2 class="text-center"><strong>Reset Password </strong></h2>
        <br>
        
        <div class=" message text-center">  
            

            <form action="#" method="post">
            <input type="text" name="username" placeholder="Username" class="form-control" required>
            <br>
            <input type="password" name="password" placeholder="Password" class="form-control" required>
            <br>
            <p>  <input type="submit" value="Update" class="form-control" ></p>
            </form>
        
        </div>

    </div> 
        <?php reset_password();
            
        if(reset_password()){
            redirect('login.php');
        }
        ?>
    <div class="col-md-4"></div> 
    </div>
    </div>
    
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/custom.js"></script>
</body>
</html>