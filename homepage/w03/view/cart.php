<!DOCTYPE html>
<html lang="en">
<?php include 'common/head.php';?>
<body>
<div class="wrapper">    
    <?php include 'common/header.php';?>
    
    <h2>Shopping Cart:</h2>
    <div class="cart">
        <form action="index.php" method="post">
            <?php         
                if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                    foreach($cart as $key=>$item){
                        //print item, retain key for removal
                        echo $item . "<button type = 'submit' name='item' value=$key>Remove Item</button>"."<br>";
                    }
                } 
            ?>
        <input type="hidden" name="action" value="removeItem">
        </form>
        <form action="index.php" method="post">
            <button type="submit" name="action" value="resetSession">Empty Cart</button>
            <button type="submit" name="action" value="checkout">Check out</button>
    </form> 
    </div>
    <div class="subform">
    <h2><a href="index.php?action=home">Back to shopping</a></h2>
    
    </div>
    <?php include 'common/footer.php';?>
    </div>
    
</body>
</html>