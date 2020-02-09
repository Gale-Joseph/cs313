<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../common/head.php';?>
</head>


<body>
<header>
    <?php include '../common/header.php';?>
</header>

<div class="pageIntro">
        <h1>Login</h1>
        <p>This page will accept credentials to start a session with a user
        </p>
    </div>
<form action="../accounts/index.php" method="post" id="loginForm">
   
    <label>Email:</label><br>
    <input type="text" id="emailAddress" name="emailAddress"><br>
    <label>Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="hidden" name="action" value="login">
    <input type ="submit" name="submit" value="Login">
</form>

<?php include '../common/forms.php';?>
</body>
<footer><?php include '../common/footer.php'?></footer>
</html>