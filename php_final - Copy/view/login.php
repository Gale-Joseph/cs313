<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../common/head.php';?>
</head>


<body>

<div class="main">
    <div class="welcome">
        <h1>Welcome to your practice stock portfolio</h1>
    </div>
    <div class="login">
        <div class="pageIntroLogin">
            <h2>Login</h2>
            <?php if(isset($message)){echo$message;};?>
            
            <form action="../accounts/index.php" method="post" id="loginForm">   
                <label>Email:</label><br>
                    <input type="text" id="email" name="email" required><br>
                <label>Password:</label><br>
                    <input type="password" id="password" name="password" required><br>
                    <input type="hidden" name="action" value="login">
                    <input type ="submit" name="submit" value="Login">
            </form>
        </div>
    </div>

    <div class="signup">
        <div class="pageIntroLogin">
        <h2>Not a member yet? Sign up for free</h2>
        <?php if(isset($errMessage)){echo "<p class='validation'>*"
                .$errMessage . "</p>";}?>
            <form action="../accounts/index.php" method="post" id="signup">   
                <label>First Name</label><br>
                    <?php if(isset($fnameValidation))
                    {echo "<input type='text' name='fname' id='fname'
                    required " . 
                "<span class='validation'>*$fnameValidation</span>";
                    }else{
                    echo "<input type='text' name='fname' id='fname'>"; 
                    }?>
                <br> 
                <label>Last Name</label><br>
                    <?php if(isset($lnameValidation))
                    {echo "<input type='text' name='lname' id='lname'
                    required" . 
                     "<span class='validation'>*$lnameValidation</span>";}
                    else{
                    echo "<input type='text' name='lname' id='lname'>"; 
                    }?>
                <br> 
                <label>Email:</label><br>
                <?php if(isset($emailValidation))
                {echo "<input type='email' name='email' id='email'
                required " . 
                "<p class='validation'>*".$emailValidation."</p>";}
                else{
                echo "<input type='email' name='email' id='email'>"; 
                }?> 

                <div class="instructions">
                    <p>Passwords must have at least 7 characters and 1 digit</p>
                </div>
                <label>Password:</label><br>
                <?php if(isset($pwValidation))
                {echo "<input type='password' name='password' id='password'
                required pattern='(?=.*\d).{7,}'>" . 
                "<span class='validation'>*".$pwValidation."</span>";}
                else{
                echo "<input type='password' name='password' id='password'>"; 
                }?>     
                <br>
                <label>Retype Password:</label><br>
                    <?php if(isset($pwValidation))
                    {echo "<input type='text' name='password2' id='password2'
                    required pattern='(?=.*\d).{7,}'>" . 
                    "<span class='validation'>*$pwValidation</span>";}
                    else{
                    echo "<input type='password' name='password2' id='password2'>"; 
                    }?>
                <br>
                <input type="hidden" name="action" value="signup">
                <input type ="submit" name="submit" value="Sign Up">
            </form>
        </div><!--page intro-->
        </div><!--end class signup-->

</body>
<footer><?php include '../common/footer.php'?></footer>
</div><!--end class wrapper-->
</html>