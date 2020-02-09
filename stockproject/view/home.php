<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>
        <?php if(isset($titleTag)){ 
            echo $titleTag ." | Gale, Inc.";
            }else{
                echo "Gale Inc.";
            }
        ?>               
    </title>
    <?php
    //this prevents the form from resubmitting when hitting back button
    /*https://stackoverflow.com/questions/15226744/prevent-form-resubmission-upon-hitting-back-button*/
    header("Cache-Control: no cache");

    //this code was also included in stack overflow but created error
    //session_cache_limiter("private_no_expire");
    ?>
</head>
<body>
<div class="topnav">
  <a class="active" href='index.php'>Home</a>
</div> 
<div class="pageIntro">
<h1>Main Interface</h1>
<p>Welcome to the first version of my stock portfolio app.
    Each of the following buttons reads data from the Postgres Database and 
    displays some dummy information. 
</p>
</div>

<form action="transactions/index.php" method="post">
    <input type="hidden" name="action" value="getPort">
    <input type ="submit" name="submit" value="See Portfolio">
</form>
<form action="accounts/index.php" method="post">
    <input type="hidden" name="action" value="getUserInfo">
    <input type ="submit" name="submit" value="User Account">
</form>
<form action="transactions/index.php" method="post">
    <input type="hidden" name="action" value="getTrans">
    <input type ="submit" name="submit" value="View Transaction History">
</form>
<form action="accounts/index.php" method="post">
    <input type="hidden" name="action" value="viewLogin">
    <input type ="submit" name="submit" value="Login">
</form>
    
</body>

<footer><?php include 'common/footer.php'?></footer>
</html>


