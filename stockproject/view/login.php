<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../common/head.php';?>
</head>

<header>
    <?php include '../common/header.php';?>
</header>
<body>
<form action="../accounts/index.php" method="post">
    <input type="hidden" name="action" value="login">
    <input type ="submit" name="submit" value="Login">
</form>
    
</body>
<footer><?php include '../common/footer.php'?></footer>
</html>