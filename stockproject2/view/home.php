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
        <h1>User Account Information</h1>
      
        </p>
    </div>
    <?php print_r($_SESSION);?>
    <ul class="userInfo">
        <li>First Name: <?php echo $_SESSION['userInfo']['firstname'] ?></li>
        <li>Last Name: <?php echo $_SESSION['userInfo']['lastname'] ?></li>
        <li>Email: <?php echo $_SESSION['userInfo']['email']?></li>  
        <li>Trade Amount:  <?php echo '$'.$_SESSION['userInfo']['tradeacctamount']?></li>      
    </ul>

    <?php if(isset($message)){echo $message;}?>
    </div> 

    <div class="pageIntro">
        <h1>Main Interface</h1>
    </div>

    
    <div class="stockSearch">
    <h2>Search for Stocks</h2>
        <p>Type in a stock ticker symbol like 'aapl' or 'spy'</p>
        <input type="text" id = "userInput" ></input>        
        <input type="button" onclick="getStockData()" value="Get Stock Info"></input> 
            <div id="dataDisplay"></div>
    </div>


    
    <div class="forms">
    <h2>Purchase Stock</h2>
    <form id='buyForm' action="insert.php" method="post">
        <label for="ticker">Ticker Symbol</label>
        <input type="text" name="ticker" id="ticker"><br>
        <label for="date">Date</label>
        <input type="text" name="date" value="2020-01-01" id="date"><br>
        <label for="price">Price</label>
        <input type="text" name="price" id="price"><br>
        <label for="shares">Shares</label>
        <input type="text" name="shares" id="shares"><br>
        <input type ="submit" name="submit" value="Purchase">
    </form>
    </div>

    <div class="forms">
    <h2>Sell Stocks</h2>
    <form id='sellForm' action="sell.php" method="post">
    <label for="ticker">Ticker Symbol</label>
        <input type="text" name="ticker" id="ticker"><br>
        <label for="date">Date</label>
        <input type="text" name="date" value="2020-01-01" id="date"><br>
        <label for="price">Price</label>
        <input type="text" name="price" id="price"><br>
        <label for="shares">Shares</label>
        <input type="text" name="shares" id="shares"><br>
        <input type ="submit" name="submit" value="Sell">
    </form>
    </div>

    <h2>Portfolio</h2>
    <div class="content">
        <?php 
        //portfolio/ajax refresh info goes here:
        //include 'library/connections.php';
        try{
    
        $db = connectdb();
        $results = $db->prepare('SELECT * FROM portfolio');
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

        </tr>
        <?php
            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                
                echo    "<tr>" 
                        . "<td>". "$row[ticker]</td>"
                        . "<td>". "$row[buydate]</td>"
                        . "<td>". "$row[buyprice]</td>"
                        . "<td>". "$row[shares]</td>";
                }
        ?>
        </table>
       
    </div>

</body>

<footer><?php include '../common/footer.php'?></footer>
</html>


