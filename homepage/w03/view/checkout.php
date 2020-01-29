<!DOCTYPE html>
<html lang="en">
<?php include 'common/head.php';?>
<body>
<div class="wrapper">
    <?php include 'common/header.php';?>

    
    
    <h2>Shipping Address</h2>
    <form id = "shippingForm" action="index.php" method="post">
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
    <div class="subform">
    <h2><a href="index.php?action=viewItems">Return to cart</a></h2>
    <h2><a href="index.php?action=home">Keep shopping</a></h2>
       
        
    </div>
    
    <?php include 'common/footer.php';?>
</div>
</body>
</html>