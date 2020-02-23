<?php 
// main controller page

//create a session
session_start();

//get database connection file
require_once 'library/connections.php';
require_once 'model/transactions-model.php';
require_once 'library/functions.php';

//get head

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
  case 'home':
    header('Location: view/login.php');
    break;
  default:
    header('Location: view/login.php');
    break;
}

  ?>