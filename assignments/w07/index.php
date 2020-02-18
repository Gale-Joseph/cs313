<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Document</title>
</head>
<body>
<h1>Sign Up Page</h1>
<form action='controller.php' method='post'>
    <label for="username">Username</label><br>   
        <input type  = "text" name = "username" id = "username"><br>
    
    <label for ="password">Password</label><br>
        <?php if(isset($validation))
            {echo "<input type='password' name='password' id='password'
                    required  pattern='(?=.*\d).{7,}'>" . 
                "<span class='validation'>*$validation</span>";}
            else{
                echo "<input type='password' name='password' id='password'>"; 
            }?>
            <br>
    
    <label for ="password2">Retype Password</label><br>
        <?php if(isset($validation))
                {echo "<input type='text' name='password2' id='password2'
                    required  pattern='(?=.*\d).{7,}'>" . 
                    "<span class='validation'>*$validation</span>";}
                else{
                    echo "<input type='text' name='password2' id='password'>"; 
                }?>
            <br>

    <button type = "submit" name = "submit" id = "submit">Submit</submit>

</form>
    
</body>
</html>
