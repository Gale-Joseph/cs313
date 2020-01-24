<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Main Page</h1>
    <!--all items for sale go here-->
    <form action="/cs313/assignments/w03/index.php" method="post">

        <div>
        <button type="submit" name="item" value="apples">Add apples</button>
        <button type="submit" name="item" value="oranges">Add oranges</button>
        </div>

        <input type="hidden" name="action" value="addItem">
        
    </form>

    <!--Reset session for testing -->

    <form action="/cs313/assignments/w03/index.php" method="post">
        <input type="submit" name="action" value="resetSession">    
    </form> 

    <!--Navigate to Shopping Cart-->
    <a href="/cs313/assignments/w03/index.php?action=viewItems">View Shopping Cart</a>
</body>
</html>