<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../common/head.php';?>
</head>
<body>
<header>
    <?php include '../common/header.php';?>
</header>
    <div class="pageIntro">
        <h1>Transaction List</h1>
        <p>This page will display all the transactions of the user, including
            deposits/withdrawls to and from the brockerage account, as well 
            as sales and purchases of stocks.
        </p>
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
        <tr>
            <td><?php echo $_SESSION['transData']['date']?></td>
            <td><?php echo $_SESSION['transData']['ticker']?></td>
            <td><?php echo $_SESSION['transData']['price']?></td>
            <td><?php echo $_SESSION['transData']['shares']?></td>
            <td><?php echo $_SESSION['transData']['stocktotal']?></td>
            <td><?php echo $_SESSION['transData']['deposittotal']?></td>
        </tr>
    </table>
    <?php include '../common/forms.php';?>
</body>
<footer><?php include '../common/footer.php'?></footer>
</html>