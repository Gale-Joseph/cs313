<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'common/head.php';?>
</head>
<body>
    <header>        

    </header>

<?php
$myconnect = connectdb();
?>

<form action="portfolio/index.php" method="post">
    <input type="hidden" name="action" value="getPort">
    <input type ="submit" name="submit" value="getPort">
</form>
    
</body>

<footer><?php include 'common/footer.php'?></footer>
</html>


