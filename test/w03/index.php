
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="display.php" method="post">
        <label>Name</label>
        <input type="text" name="name" id="name"><br>
        <label>Email</label>
        <input type="text" name="email" id="email"><br>
        <label>Major</label><br>
        <!--stretch code 1-->
        <?php //script for major inputs
        $major = array("Computer Science","Web Design and Development", "Computer Information Technology");
        foreach($major as $each){
            echo "<input type='radio' name='major' value=$each>$each <br>";
        }

        ?>
        <!--original code-->
        <!-- <input type="radio" name="major" value="Computer Science" >Computer Science<br>
        <input type="radio" name="major" value="Web Design and Development">Web Design and Development<br>
        <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br> -->
        <label>Comments</label>
        <textarea name="comments"></textarea><br>
        <label>Places visited: </label>
        
        <input type="checkbox" value="na" name="continent[]">North America<br>
        <input type="checkbox" value="sa" name="continent[]">South America<br>
        <input type="checkbox" value="eu" name="continent[]" >Europe<br>
        <input type="checkbox" value="as" name="continent[]" >Asia<br> 
        <input type="checkbox" value="au" name="continent[]" >Australia"<br> 
        <input type="checkbox" value="af" name="continent[]" >Africa<br> 
        <input type="checkbox" value="ant" name="continent[]" > Antarctica<br> 

        <input type="submit" value="Submit">
    
    </form>
</body>
</html>

