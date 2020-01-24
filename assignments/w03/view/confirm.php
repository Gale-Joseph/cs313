<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    <h1>Confirmation Page</h1>
    <?php echo $address1;?>
    <?php echo $address2;?>
    <?php echo $city;?>
    <?php echo $state;?>
    <?php echo $zip;?>
    
    <h2>Shopping Cart:</h2>
    <?php         
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            foreach($cart as $key=>$item){
                //print item, retain key for removal
                echo $item;
            }
        } 
    ?>
    <form action="/cs313/assignments/w03/index.php" method="post">
    <p>Here are the items you checked out</p>
    <input type="submit" name="action" value="confirm">
    
    </form>
    <a href="/cs313/assignments/w03/index.php?action=home">Go home</a>
    <a href="/cs313/assignments/w03/index.php?action=viewItems">Return to cart</a>
</body>
</html>