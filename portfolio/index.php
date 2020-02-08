<?php
//create a session
session_start();

//get database connection file
require_once '../library/connections.php';
require_once '../model/portfolio-model.php';
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
  case 'getPort':
      $titleTag = "Portfolio";
      $_SESSION['portData'] = getPort();
      include '../view/portfolio.php';
      break;
  default:
       $titleTag = "Home";
      include '../view/home.php';
}

  ?>