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
        <h1>User Account Information</h1>
        <p>The following data displays information pulled from the user table</p>
        </p>
    </div>
    <ul class="userInfo">
        <li>First Name: <?php echo $_SESSION['userInfo']['firstname'] ?></li>
        <li>Last Name: <?php echo $_SESSION['userInfo']['lastname'] ?></li>
        <li>Email: <?php echo $_SESSION['userInfo']['email']?></li>       
    </ul>

</body>

<footer><?php include '../common/footer.php'?></footer>
</html>