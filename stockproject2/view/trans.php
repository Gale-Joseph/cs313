<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../common/head.php';?>
</head>
<body>
<header>
    <?php include '../common/header.php';?>
</header>
<?php print_r($_SESSION);?>
    <div class="pageIntro">
        <h1>Transaction List</h1>
        
    </div>
    <table>
        <tr>
            <th>Date</th>
            <th>Ticker</th>
            <th>Price</th>
            <th>Shares</th>
            <th>Stock Total</th>
            <th>Deposit</th>
        </tr>
        <?php
        while($row=$statement->fetch(PDO::FETCH_BOTH)){
            echo    "<tr>" 
                    . "<td>". "$row[date]</td>"
                    . "<td>". "$row[ticker]</td>"
                    . "<td>". "$row[price]</td>"
                    . "<td>". "$row[shares]</td>"
                    . "<td>". "$row[stocktotal]</td>"
                    . "<td>". "$row[deposittotal]</td></tr>";
        }
        ?>
    </table>

</body>
<footer><?php include '../common/footer.php'?></footer>
</html>