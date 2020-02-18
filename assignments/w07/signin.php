<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Document</title>
</head>
<body>
<h1>Login </h1>
<?php if(isset($message)){echo $message;}?>


<form action='controller2.php' method='post'>
<label for="loginname">Username</label><br>
    <input type  = "text" name = "loginname" id = "loginname"><br>
   
<label for ="password">Password</label><br>
    <input type ="password" name = "loginpassword" id = "loginpassword"><br>
    
</form>
    
</body>
</html>
