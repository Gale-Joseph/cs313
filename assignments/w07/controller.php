<?php 
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

//set variables

//remove illegal characters
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

//hash password
$pwhash = password_hash($password,PASSWORD_DEFAULT);

//store in database
$sql = "INSERT INTO userinfo VALUES(default, '$username','$pwhash')";
$statement = $db->prepare($sql);

//verify that statement successfully excecuted and redirect to login:
if($statement->execute()){
    echo "Successfully added new user to db<br>";
    header('Location: signin.php');
    die();

} else {
    echo "Something went wrong. Please try again.<br>";
}

//################login procedure####################
//get password from user based on username
$loginname = filter_var($_POST['loginname'], FILTER_SANITIZE_STRING);
$loginpassword = filter_var($_POST['loginpassword'],FILTER_SANITIZE_STRING);
// $loginpassword = password_hash($loginpassword,PASSWORD_DEFAULT);

if($loginname || $loginpassword){
    header("Location: welcome.php");
}
//retrive the hashed password
$statement = $db->prepare("SELECT password FROM 
    userinfo WHERE username='$loginname'");
$row = $statement->fetch(PDO::FETCH_ASSOC);

if(password_verify($loginpassword,$row['password'])){
    $var1 = print_r($_POST);
    $var2 = print_r($row);
    include "welcome.php";
    // header("Location: welcome.php");
} else {
    $message = "something went wrong";
    $var1 = print_r($_POST);
    $var2 = print_r($row);
    include 'welcome.php';
}


?>