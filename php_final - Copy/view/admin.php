<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include '../common/head.php';?>
    
</head>
<body>
   
        <header>
            <?php include '../common/header.php';?>
        </header>
        <div class='main'>
    
        <div class="pageIntro">
            <h1>User Account Information</h1>
        </div>
        <ul class="userInfo">
            <li>First Name: <?php echo $_SESSION['userInfo']['firstname'] ?></li>
            <li>Last Name: <?php echo $_SESSION['userInfo']['lastname'] ?></li>
            <li>Email: <?php echo $_SESSION['userInfo']['email']?></li>
            <li>Trade Amount:  <?php echo '$'.$_SESSION['userInfo']['tradeacctamount']?></li>      
        </ul>

        <?php if(isset($message)){echo $message;}?>
    
        <hr class='new1'>
        <div class="forms">
        <h2>Update Information</h2>
        <form id='updateForm' action="../accounts/index.php" method="post">
        <label for="firstname">First Name:</label><br>
            <input type="text" name="firstname" id="firstname"><br>
            <label for="lastname">Last Name</label><br>
            <input type="text" name="lastname" id="lastname"><br>
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="password">Password</label><br>
            <input type="text" name="password" id="password"><br>
            <input type ="hidden" name="action" value="updateUser">
            <input type ="submit" name="submit" value="Update">
        </form>
        </div>

        <div class="forms">
        <h2>Add funds</h2>
        <form id='addfunds' action="../transactions/index.php" method="post">
        <label for="amount">Add Amount:</label>
            <input type="text" name="amount" id="amount"><br>
            <input type ="hidden" name="action" value="addfunds">
            <input type ="submit" name="submit" value="Add Funds">
        </form>
        </div>

    
</body>

<footer><?php include '../common/footer.php'?></footer>
</div><!--close main-->
</html>