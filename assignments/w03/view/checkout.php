<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    <h1>Checkout page</h1>

    
    
    <h2>Shipping Address</h2>
    <form action="/cs313/assignments/w03/index.php" method="post">
        <label for="address">Street Address 1</label><br>
        <input type="text" name="address1"><br>
        <label for="address">Street Address 2</label><br>
        <input type="text" name="address2"><br>
        <label for="city">City</label><br>
        <input type="text" name="city"><br>
        <label for="state">State</label><br>
        <input type="text" name="state"><br>
        <label for="zip">Zipcode</label><br>
        <input type="text" name="zip"><br><br>
    <input type="submit" name="action" value="confirm">

    
    </form>
    <a href="/cs313/assignments/w03/index.php?action=home">Go home</a>
    <a href="/cs313/assignments/w03/index.php?action=viewItems">Return to cart</a>
</body>
</html>