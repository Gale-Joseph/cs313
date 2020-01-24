<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    
    <h2>Shopping Cart:</h2>
    <form action="/cs313/assignments/w03/index.php" method="post">
    <?php         
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            foreach($cart as $key=>$item){
                //print item, retain key for removal
                echo $key . " ". $item . "<button type = 'submit' name='item' value=$key>Remove Item</button>"."<br>";
            }
        } 
    ?>
    <input type="hidden" name="action" value="removeItem">
    </form>
    <a href="/cs313/assignments/w03/index.php?action=home">Browse more items</a>
    <a href="/cs313/assignments/w03/index.php?action=checkout">Proceed to Checkout</a>
</body>
</html>