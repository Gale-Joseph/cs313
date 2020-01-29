<!DOCTYPE html>
<html lang="en">
<?php include 'common/head.php';?>
<body>
<div class="wrapper">
    <?php include 'common/header.php';?>
    <div class="confirmForm">
        <h2>Congratulations, you just placed an order</h2>
        <p>Your order will be shipped to:</p>
        <ul>
            <li><?php echo $address1;?></li>
            <li><?php echo $address2;?></li>
            <li><?php echo $city;?></li>
            <li><?php echo $state;?></li>
            <li><?php echo $zip;?></li>        
        </ul>

    </div>
    
    <form action="index.php" method="post">
    <h3>Here are the items you purchased</h3>
    <?php         
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            foreach($cart as $key=>$item){
                //print item, retain key for removal
                echo "<p class='itemsPurchased'>" . $item . "</p>"."<br>";
            }
        } 
    ?>    
    </form>
    <div class="subform">    
    <h2><a href="index.php?action=startNew">Start a new order</a></h2> 
    </div>
    <?php include 'common/footer.php';?>
    </div>
</body>
</html>