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
        $titleTag = "Home";
        //if using include, errors appear on homepage    
        header('Location: ../index.php');    
        break;

    default:
       $titleTag = "Home";
      include '../view/home.php';
}

  ?>