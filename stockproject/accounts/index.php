<?php
//accounts controller

//create a session
session_start();

//get database connection file
require_once '../library/connections.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';

//use filter_input() to weed out malicious code
$action = filter_input(INPUT_POST, 'action');

//check POST/GET objects for key value that == 'action'
if($action==NULL){ 
  $action=filter_input(INPUT_GET,'action');
  if($action==NULL){
      $action = 'home';
  }
}


switch($action){
    case 'getUserInfo':
      $titleTag = "Account";
      $_SESSION['userInfo'] = getUserInfo();
      include '../view/admin.php';
      break;

    case 'viewLogin':
    $titleTag = "Login";
    include '../view/login.php';
    break;

    case 'login':        
        //1. Collect and filter information
        $email = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
        $password =filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //2. Check for missing data
        if (empty($email) || empty($password)) {
          $message = '<p class="notice">Please provide a valid email address and password.</p>';
          include '../view/login.php';
          exit; 
         }
         //3.Check against database
         $clientData = getClient($email);
         if($clientData==null||$clientData['password']!=$password){
           $message = '<p class="notice">Email or Password is wrong</p>';
          }else{
          $_SESSION['firstname']=$clientData['firstname'];
          $message = "<p class='notice'>Welcome, $clientData[firstname]";
         }
        

        //Go to homepage or redirect to login
        //set session variable with firstname


        //if using include, errors appear on homepage    
        include '../view/login.php';   
        break;

    default:
       $titleTag = "Home";
      include '../view/home.php';
}

  ?>