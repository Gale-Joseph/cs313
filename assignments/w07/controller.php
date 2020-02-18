<?php
//this page handles the sign up
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

//set variables

//remove illegal characters
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
$password2 = filter_var($_POST['password2'],FILTER_SANITIZE_STRING);

//make sure passwords have at least 7 characters and 1 number
if(!preg_match('/^(?=.*\d){7,}/',$password)){
    $validation = "Password have at least 7 characters and 1 number";
    include "index.php";
    exit;
}

//make sure that passwords match
if($password != $password2){
    $validation = "Passwords do not match";
    include "index.php";
    exit;
}

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
?>