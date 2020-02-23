<?php if(!isset($_SESSION)){
    session_start();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include '../common/head.php';?>
</head>
<body>
    
    <header>
        <?php include '../common/header.php';?>
    </header>
    <div class='main'>
    <div class="pageIntro">
        <h1>User Account Information</h1>
    
        <ul class="userInfo">
            <li>First Name: <?php echo $_SESSION['userInfo']['firstname'] ?></li>
            <li>Last Name: <?php echo $_SESSION['userInfo']['lastname'] ?></li>
            <li>Email: <?php echo $_SESSION['userInfo']['email']?></li> 
        </ul>

        <?php if(isset($message)){echo $message;}?>
    </div> 
    <hr class='new1'>

    <div class="pageIntro2">
        <h1>Dashboard</h1>
    </div>

    
    <div class="stockSearch">
    <h2>Search for Stocks</h2>
        <p>Type in a stock ticker symbol like 'aapl' or 'spy'</p>
        <input type="text" id = "userInput" ></input>        
        <input type="button" onclick="getStockData()" value="Get Stock Info"></input> 
            <div id="dataDisplay"></div>
    </div>


    <div class="forms">
        <h2>Buy Stocks</h2>
    <form id='buyForm2' action='../transactions/index.php' method='post'>
            <label for="ticker">Ticker Symbol</label><br>
                <input type="text" name="ticker" id="ticker"><br>
            <label for="date">Date</label><br>
                <input type="text" name="date" value="2020/12/31" id="date"><br>
            <label for="shares">Shares</label><br>
                <input type="text" name="shares" id="shares"><br>
            <label for="price">Price</label><br>
                <input type="text" name="price" id="price"><br>
                <input type='hidden' name='action' value='buyStock'>
                <?php if(isset($errBuy))
                {echo '<p class="error">'.$errBuy. '</p>';}?>
                <input type='submit' value='Submit'>
        </form>
</div>

    <div class="forms">
    <h2>Sell Stocks</h2>
     <form id='sellForm2' action='../transactions/index.php' method='post'>
        <label for="ticker">Ticker Symbol</label><br>
            <input type="text" name="ticker" id="ticker"><br>
        <label for="date">Date</label><br>
            <input type="text" name="date" value="2020/12/31" id="date"><br>
        <label for="shares">Shares</label><br>
            <input type="text" name="shares" id="shares"><br>
        <label for="price">Price</label><br>
            <input type="text" name="price" id="price"><br>
            <input type='hidden' name='action' value='sellStock'>
            <?php if(isset($errSell))
            {echo '<p class="error">'.$errSell. '</p>';}?>
            <input type='submit' value='Submit'>
        </form>
    </div>

    <h2>Portfolio</h2>
    <div class="content">
        <?php 
        //portfolio/ajax refresh info goes here:
        //include 'library/connections.php';
        try{
            $email = $_SESSION['userInfo']['email'];
            $db = connectdb();
            $results = $db->prepare("SELECT * FROM portfolio WHERE userid = 
            (SELECT id FROM public.user WHERE public.user.email = '$email')");
            $results->execute();
    
        } catch(Exception $e){
            echo "there was an error starting out";
        exit;
        }
        ?>
        <table>
        <tr>
            <th>Ticker</th>
            <th>Date</th>
            <th>Price</th>
            <th>Shares</th>
            <th>Total Value</th>

        </tr>
        <?php
            $total = 0;
            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                $total = $total + ((int)$row['buyprice']*(int)$row['shares']);
                echo    "<tr>" 
                        . "<td>". "$row[ticker]</td>"
                        . "<td>". "$row[buydate]</td>"
                        . "<td>". "$row[buyprice]</td>"
                        . "<td>". "$row[shares]</td>"
                        . "<td>". $row['buyprice']*$row['shares'] . "</tr>";
                }
                echo "<p class='portText'>". "Total value: ". '$'. "$total" . "</p>";
        ?>     
        </table>
       
    </div>

</body>

<footer><?php include '../common/footer.php'?></footer>
</div><!--close main-->
</html>


