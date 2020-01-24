<!DOCTYPE html>
<html lang="en">
<?php include 'common/head.php';?>
<body>
    <div class="wrapper">
        <?php include 'common/header.php';?>  
        
        <div class="shopSection">
            <!--all items for sale go here-->
            <form action="index.php" method="post">
                <div class="product">
                    <div class="fruitpic"><img src="images/apples.jpg"></div>
                    <button type="submit" name="item" value="apples">Add apples</button>
                </div>
                <div class="product">
                    <div class="fruitpic"><img src="images/oranges.jpg"></div>
                    <button type="submit" name="item" value="oranges">Add oranges</button>
                </div>
                <div class="product">
                    <div class="fruitpic"><img src="images/bananas.jpg"></div>
                    <button type="submit" name="item" value="bananas">Add bananas</button>
                </div>
                <input type="hidden" name="action" value="addItem">                
            </form>
        </div><!--close shopSection-->
        <?php include 'common/footer.php';?>
    </div><!--close wrapper-->
</body>
</html>