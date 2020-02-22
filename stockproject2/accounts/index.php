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
  /*User signs up from view/login.php*/
  case 'signup':

    //1. Collect, filter, and validate user input
    $fname = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
    if(!preg_match("/^[a-zA-Z]*$/",$fname)){
      $fnameValidation = "Only letters and white space allowed";
    }

    $lname = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
    if(!preg_match("/^[a-zA-Z]*$/",$lname)){
      $lnameValidation = "Only letters and white space allowed";
    }

    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailValidation = "Invalid email format";
    }

    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $password2 = filter_var($_POST['password2'],FILTER_SANITIZE_STRING);

    //2. verify that email is not already in use
    $emailExists = getClient($email);
    if($emailExists){
      $emailValidation = "Email already exists";
      include "../view/login.php";
      exit; 
    }

    //3. serverside validation for empty fields
    if(empty($fname)||empty($lname)||empty($email)||empty($password)||
    empty($password2)){
        $errMessage = "Please fill in all fields";
        include "../view/login.php";
        exit; 
    }

    //4. make sure that passwords match
    if($password != $password2){
      $pwValidation = "Passwords do not match";
      include "../view/login.php";
      exit;
    }

    //5. make sure passwords have at least 7 characters and 1 number
    if(!preg_match('/^(?=.*\d){7,}/',$password)){
      $pwValidation = "Password have at least 7 characters and 1 number";
      include "../view/login.php";
      exit;
    }

    //6. return user to login form if any error messages are not null
    if( isset($fnameValidation)||isset($lnameValidation)||
      isset($emailValidation)||isset($pwValidation) ||isset($errMessage))
    {
      include "../view/login.php";
      exit;
    }

    //7. input information into database    
    //7a. hash password
    $pwhash = password_hash($password,PASSWORD_DEFAULT);

    //7b. store in database
    $db = connectdb();
    $sql = "INSERT INTO public.user VALUES
      (default,'$fname','$lname','$email',1,0,'$pwhash',default,default)";
    $statement = $db->prepare($sql);

    //verify that statement successfully executed:
    if($statement->execute()){
      //sign in user, set $_SESSION variables, direct to home page
     $_SESSION['loggedin'] = true;
     $_SESSION['userInfo']=getUserInfo($email);    
     include '../view/home.php';
      die();  
    } else {
      header('Location: login.php');      
    }
  break;

  /*user clicks to see account in menu*/
  case 'getUserInfo':
    $titleTag = "Account";
    
    include '../view/admin.php';
  break;

  /*User clicks on logout in menu:*/
  case 'logout':
    $titleTag = "Log In";
    session_unset();
    session_destroy();
    include '../view/login.php';
  break;

  /* User attempts to log in; from view/login.php */
  case 'login':        
    //1. Collect and filter information
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password =filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    //2. Check for missing data
    if (empty($email) || empty($password)) {
      $message = '<p class="notice">Please provide a valid email 
                    address and password.</p>';
      include '../view/login.php';
      exit; 
    }
    //3.Check against database
    $clientData = getClient($email); //get client info in array
    $validpw = password_verify($password,$clientData['password']);

    if($clientData==null||!$validpw){
        //if invalid, return to login page
        $message = '<p class="notice">Email or Password is wrong</p>';
        include '../view/login.php';  
        exit;
      }else{
        //if valid, go to home page
        $_SESSION['userInfo'] = getUserInfo($email);
        $message = "<p class='notice'>Welcome, $clientData[firstname]";
        include '../view/home.php';
        exit;      
      }
    break;

    case 'updateUser':
      //put input into variables
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password =filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if(empty($firstname)||empty($lastname)||empty($email)||empty($password)){
          $message = '<p class="notice">You must fill in all fields to update the user</p>';
          include '../view/admin.php';
          exit; 
        }else{
          updateUser($firstname,$lastname,$email,$password);
          $_SESSION['userInfo'] = getUserInfo($password);
          $message = '<p class="notice">User information updated</p>';
          include '../view/admin.php';
          exit;
        }
      break;

    default:
       $titleTag = "Home";
      include '../view/home.php';
}

  ?>