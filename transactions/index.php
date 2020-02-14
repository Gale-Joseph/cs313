<?php
//transactions controller - manages portfolio and transactions
//create a session
session_start();

//get database connection file
require_once '../library/connections.php';
require_once '../model/transactions-model.php';
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
  //directed from homepage to see full portfolio
  case 'getPort':
      $titleTag = "Portfolio";
      $_SESSION['portData'] = getPort();
      include '../view/portfolio.php';
      break;

    //directed from homepage to see full transaction history
  case 'getTrans':
    $titleTag = "Transactions";
    //get all transactions in an array for looping/display
    $db = connectdb();
    $sql = "SELECT * FROM trans";
    $statement = $db->prepare($sql);
    $statement ->execute();
    //do fetch on view
    include '../view/trans.php';
    break;

  default:
       $titleTag = "Home";
       $db = connectdb();
       $statement = $db->prepare('SELECT * FROM portfolio');
       $statement->execute();
      include '../view/home.php';
}

  ?>