<?php
//transactions controller - manages portfolio and transactions
//create a session
session_start();

//get database connection file
require_once '../library/connections.php';
require_once '../model/transactions-model.php';
require_once '../library/functions.php';
require_once '../model/accounts-model.php';

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

    case 'addfunds':
      $db = connectdb();
      $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT);
      addFunds($amount);
      //update session info
      $_SESSION['userInfo'] = getUserInfo();
      $date = date("Y-m-d");
      
      //add to trans table..this code is temporary
      $sql3 = "INSERT INTO trans(date,deposittotal) 
        VALUES('$date','$amount')";
      $stmt3 = $db->prepare($sql3);
      $stmt3->execute();

      //add message and return to admin page
      $message = '<p class="notice">Funds added</p>';
      include '../view/admin.php';
      exit;

  default:
       $titleTag = "Home";
       $db = connectdb();
       $statement = $db->prepare('SELECT * FROM portfolio');
       $statement->execute();
      include '../view/home.php';
}

  ?>