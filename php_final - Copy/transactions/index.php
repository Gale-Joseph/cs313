<?php
//transactions controller - manages portfolio and transactions
//create a session
session_start();


//get database connection file
require_once '../library/connections.php';
require_once '../model/transactions-model.php';
require_once '../library/functions.php';
require_once '../model/accounts-model.php';

//refresh tradeaccount amount for session variable
$email = $_SESSION['userInfo']['email'];
$_SESSION['userInfo']['tradeacctamount'] = 
  refreshTradeAcct($email);

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
    $sql = "SELECT * FROM trans WHERE userid = 
            (SELECT id FROM public.user WHERE public.user.email='$email')";
    $statement = $db->prepare($sql);
    $statement ->execute();
    //do fetch on view
    include '../view/trans.php';
    break;

  case 'addfunds':
    $email = $_SESSION['userInfo']['email'];
    $db = connectdb();
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT);
    addFunds($email,$amount);
    //update session info
    $date = date("Y-m-d");
    
    //add to trans table..this code is temporary
    $addFunds = addTrans($email,'none',0,0,$date,'deposit',$amount);
    
    //add message and return to admin page
    $message = '<p class="notice">Funds added</p>';
    include '../view/admin.php';
    exit;

  case 'buyStock':
    //validate purchase fields
    $ticker = filter_input(INPUT_POST,'ticker',FILTER_SANITIZE_STRING);
    $date = preg_replace("([^0-9/])", "", $_POST['date']);
    $shares = filter_input(INPUT_POST,'shares',FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST,'price',FILTER_SANITIZE_NUMBER_FLOAT);

    
    if(!$ticker||!$date||!$shares||!$price){
      $errBuy = "*Please enter appropriate characters for each field";
      include "../view/home.php";
      exit;
    }

    //validate whether user has sufficient funds
    $email = $_SESSION['userInfo']['email'];
    $amount = $shares * $price;
    $hasFunds = checkFunds($email,$amount);
    
    if(!$hasFunds){
      $errBuy = "*Not enough funds. Please add funds.";
      include "../view/home.php";
      exit;
    } 

    //add stock to transaction table and debit from account and add to portfolio
    //$stockPurchased = buyStock();
    //checkTicker function
    $buyStock = buyStock($email,$ticker,$price,$shares,$date);
    if($buyStock){
      $errBuy = "Purchase Complete";
    }
    include "../view/home.php";
    exit;

  case 'sellStock':
    $email = $_SESSION['userInfo']['email'];
    //validate purchase fields
    $ticker = filter_input(INPUT_POST,'ticker',FILTER_SANITIZE_STRING);
    $date = preg_replace("([^0-9/])", "", $_POST['date']);
    $shares = filter_input(INPUT_POST,'shares',FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST,'price',FILTER_SANITIZE_NUMBER_FLOAT);

    if(!$ticker||!$date||!$shares||!$price){
      $errValidate = "*Please enter appropriate characters for each field";
      include "../view/home.php";
      exit;
    }

    //validate if customer can sell

    //add stock sale to transaction table and credit to account, take out of portfolio
    $sellStock = sellStock($email,$ticker,$price,$shares,$date);
    $errValidate = $sellStock;
    
  default:
       $titleTag = "Home";
       $db = connectdb();
       $results = $db->prepare("SELECT * FROM portfolio WHERE
       userid = (SELECT id FROM public.user 
                            WHERE public.user.email = '$email')");
       $results->execute();
      include '../view/home.php';
}

  ?>