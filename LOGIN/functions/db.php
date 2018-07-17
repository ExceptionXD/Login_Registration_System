<?php

$connection = mysqli_connect('localhost' , 'root' , '' , 'login');

function query($result){
    global $connection ; 
    return mysqli_query($connection , $result);
}

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){
    global $connection ; 
    return mysqli_fetch_array($result);
}

function confirm($result){
    global $connection ; 
    if(!$result){
        echo"Database Error".mysqli_error($connection);
    }
}

function count_rows($result){
    global $connection;
    return mysqli_num_rows($result);
}

?>