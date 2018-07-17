<?php 

function clean($string){
    
    return htmlentities($string);
}

function redirect($location){
    
    return header("location:{$location}");
}

function set_message($message){
    
    if(!empty($message)){
        
        $_SESSION['message'] = $message ;
    }else{
        $_SESSION['message'] = "";
    }
}

function display_message(){
    
    if(isset($_SESSION['message'])){
        
        echo $_SESSION['message'] ;
        unset($_SESSION['message']) ;
    }
}

function token_generator(){
    
    $token = $_SESSION['token'] = md5(uniqid(mt_rand() ,true)) ;
    return $token ;
}

function email_exists($email){
    
    $sql = "SELECT id FROM data WHERE email = '$email' ";
    $result = query($sql);
    
    if(count_rows($result)==1){
        
        return true ;
    }else{
        return false ;
    }
}

function username_exists($username){
    
    $sql = "SELECT id FROM data WHERE username = '$username' ";
    $result = query($sql);
    
    if(count_rows($result)==1){
        
        return true ;
    }
}

function send_email($email , $sub ,$msg ,$headers){
    
    return mail($email , $sub ,$msg ,$headers) ;
}

//-------------------Validate_User_Register----------------------//

function validate_user_register(){
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
    
        $first_name = clean($_POST['first_name']);
        $last_name  = clean($_POST['last_name']);
        $username   = clean($_POST['username']);
        $email      = clean($_POST['email']);
        $password   = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);
        
        $min = 3;
        $max = 20;
        $errors=[];
        
        //Validations//
        
        if(strlen($password != $confirm_password)){
            $errors[]=  "Sorry Password Don't Match" ;
        }
        
        if(email_exists($email)){
            $errors[]= "Email Already Exists" ;
        }
        
        if(!empty($errors))
           {
               foreach($errors as $error)
               {
                   echo '<div class="alert alert-danger" role="alert">'.$error.'</div>' ;
               }
           }
        
        else
        {
        if(register_user($first_name,$last_name,$username,$email,$password))
        {
        set_message("Please Check Email" );
        redirect('message.php');
        }
           }
        
    }
}

//-------------------Register_User----------------------//

function register_user($first_name,$last_name,$username,$email,$password){
   
        $first_name = escape($first_name);
        $last_name  = escape($last_name);
        $username   = escape($username);
        $email      = escape($email);
        $password   = escape($password);
    
        if(email_exists($email)){
            return false ;
        }
    else{
        
        $password = md5($password);
        $validation_code = md5(microtime());
    
        $sql = "INSERT INTO data(first_name,last_name,username,email,password,validation_code,active)" ;
        $sql .= "VALUES('$first_name','$last_name','$username','$email','$password','$validation_code',0)" ;
        $result= query($sql);
        confirm($result);
    
        $sub = "Activation of Account" ;
        $msg ="Click on the link to Activate Your Account https://localhost/LOGIN/activate.php?email='$email'&code='$validation_code' " ;
        $headers = "FROM: NoReply@site.com" ;

        send_email($email , $sub ,$msg ,$headers) ;
        
        return true;
        
    }
}

//-------------------Activate_User----------------------//

function activate_user(){
    
    if($_SERVER['REQUEST_METHOD']=="GET"){
        
        if(isset($_GET['email'])){
        $email = clean($_GET['email']);
        $validation_code= clean($_GET['code']);
        
        $sql = "SELECT id FROM data WHERE email = '$email' AND validation_code='$validation_code'";
        $result=query($sql);
        confirm($result);
        
        if(count_rows($result)==1)
        {
            $sql2 = "UPDATE data SET active = 1 , validation_code= 0 WHERE email = '$email' AND validation_code='$validation_code'";
            $result2 = query($sql2);
            confirm($result);
            return true;
        }
        else{
            return false;
        }
    }
    }
}

//-------------------Validate_Login_User----------------------//

function validate_user_login(){
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
       
        
        $sql = "SELECT id FROM data WHERE email='$email' AND active = 1";
        $result = query($sql);
        confirm($result);
        
        if(count_rows($result)==1){
            if(login_user($email,$password,$remember)){
            redirect('welcome.php');
            }
        }
        else{
            $mosg = "Invalid Credentials" ;
            echo "<div class='alert alert-danger' role= 'alert'>".$mosg."</div>" ;
        }
    }
}

//-------------------Login_User----------------------//

function login_user($email,$password,$remember){
    
        $email = escape($email);
        $password = escape($password);
        $remember = isset(($remember));
    
        $sql = "SELECT password,id FROM data WHERE email='$email' AND active = 1" ;
        $result = query($sql);
        confirm($result);
        
        if(count_rows($result)==1){
            
            $rows = fetch_array($result);
            $dbpassword = $rows['password']; 
            
            if($dbpassword==md5($password)){
                
                if($remember=='on'){
                    
                    setcookie('validity',$email,time()+86400);
                    $_SESSION['validity'] = $email ;
                    
                   return true;
                }
                else{
                    return true;
                }
            }
            else{
                $mosg = "Invalid Credentials" ;
            echo "<div class='alert alert-danger' role= 'alert'>".$mosg."</div>" ;
            }
        }
    else{
        return false;
    }

}


//-------------------Logged_In----------------------//

function logged_in(){
    
    if( isset($_COOKIE['validity']) || isset($_SESSION['validity']) ){
        return true;
    }
    else{
        return false ;
    }
}

//-------------------Validate_Forgot_Password----------------------//

function validate_forgot_email(){
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $email = clean($_POST['email']);
        
        $sql = "SELECT id FROM data WHERE email='$email' AND active = 1";
        $result = query($sql);
        confirm($result);
        
        if(count_rows($result)==1){
            
        $validation_code = md5($email) ;
        $sql = "UPDATE data SET validation_code =' $validation_code' WHERE email='$email' AND active = 1";
        $result = query($sql);
        confirm($result);
            
        
        $sub = "Reset Password" ;
        $msg ="Click on the link to Reset Your Account Password https://localhost/LOGIN/reset_code.php?email=$email&reset_code=$validation_code and your code is = $validation_code " ;
        $headers = "FROM: NoReply@site.com" ;

        send_email($email , $sub ,$msg ,$headers) ;
            
        set_message("Please Check Your Email For the Code") ;
        redirect('message.php');
        }
        else{
            $mosg = "Invalid Credentials" ;
            echo "<div class='alert alert-danger' role= 'alert'>".$mosg."</div>" ;
        }
    }
}

//-------------------Validate_Code_Password----------------------//

function validate_code(){
    
    if($_SERVER['REQUEST_METHOD']=="GET"){
        
        $email = clean($_GET['email']);
        $validation_code = md5($email) ;
//        $code = clean($_GET['reset_code']);
//        
//        $sql = "SELECT id , validation_code FROM data WHERE email = '$email' ";
//        $result = query($sql);
//        confirm($result);
//        
//        if(count_rows($result)==1){
//            $row = fetch_array($result);
//            $dbcode = $row['validation_code'];
//            
        if($_POST['code']==$valiadtion_code){
//            if($dbcode == ($code)){
                setcookie('reset',$email,time()+60);
                $_SESSION['reset'] = $email ;
                return true;
            }
            else{
                return false ;
            }
        }
        else{
            return false;
        }
        
    }


//-------------------Reset_Password----------------------//

function reset_password(){
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $password = clean($_POST['password']);
        $username = clean($_POST['username']);
        $password = md5($password);
        
        if( isset($_COOKIE['reset']) || isset($_SERVER['reset']) ){
            $sql = "UPDATE data SET password ='$password' , validation_code = 0 WHERE username = '$username'";
            $result = query($sql);
            confirm($result);
            
            return true ;
        }
        else{
            $mosg = "Session Timed Out" ;
            echo "<div class='alert alert-danger' role='alert'> ".$mosg."</div>" ;
        }
        
    }
}

























?>