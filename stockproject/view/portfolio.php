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
    <h1>Portfolio</h1>
    <p>This page will display the complete, active portfolio of the user</p>
    </p>
</div>
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

    <?php include '../common/forms.php';?>
    
</body>

<footer><?php include '../common/footer.php'?></footer>
</html>