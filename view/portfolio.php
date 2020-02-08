<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../common/head.php';?>
</head>
<body>
    <table>
        <tr>
            <th>Ticker</th>
            <th>Purchase Date</th>
            <th>Purchase Price</th>
            <th>Shares</th>
            <th>Current Price</th>
            <th>Current Value</th>
            <th>Profit</th>
        </tr>
        <tr>
            <td><?php echo $_SESSION['portData']['ticker']?></td>
            <td><?php echo $_SESSION['portData']['buydate']?></td>
            <td><?php echo $_SESSION['portData']['buyprice']?></td>
            <td><?php echo $_SESSION['portData']['shares']?></td>
            <td><?php echo $_SESSION['portData']['currentprice']?></td>
            <td><?php echo $_SESSION['portData']['currentvalue']?></td>
            <td><?php echo $_SESSION['portData']['profit']?></td>
        </tr>
    </table>
<?php
   echo $_SESSION['portData']['ticker'];
?>
    
</body>

<footer><?php include '../common/footer.php'?></footer>
</html>