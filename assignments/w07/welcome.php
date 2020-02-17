<?php 
session_start();
if(isset($_SESSION['username'])){
    echo "Hello ". $_SESSION['username'];
}
?>
<?php if(isset($message)){echo $message;}?>


<p>You successfully logged in</p>
