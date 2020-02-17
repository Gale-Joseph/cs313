<?php
session_start();
//database connection
$user = 'postgres';
$password = '014722';
$host = 'localhost';
$dbname='w07';
try{
    $db = new PDO("pgsql:host=$host;dbname=$dbname",$user,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if($db){
        echo "Connection made<br>";
    }
    
    //return $db;
} catch(PDOException $ex){
    echo "Connection failure";
    exit;
    }
//################login procedure####################
//get password from user based on username
$loginname = filter_var($_POST['loginname'], FILTER_SANITIZE_STRING);
$loginpassword = filter_var($_POST['loginpassword'],FILTER_SANITIZE_STRING);
//$loginpassword = password_hash($loginpassword,PASSWORD_DEFAULT);

//retrive the hashed password
$statement = $db->prepare("SELECT password FROM 
    userinfo WHERE username=:username");
$statement->bindValue(':username',$loginname,PDO::PARAM_STR);
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);


if(password_verify($loginpassword,$row['password'])){
    $var1 = "Successful login";
    $var2 = "Way to go";
    $_SESSION['username'] = $loginname;
    header("Location: welcome.php");
} else {
    $message = "something went wrong";
    $var1 = $loginpassword;
    $var2 = print_r($row);

    include 'welcome.php';
}
?>