<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <title>
        <?php if(isset($titleTag)){ 
            echo $titleTag ." | Gale, Inc.";
            }else{
                echo "Gale Inc.";
            }
        ?>               
    </title>
    <?php
    
    //this prevents the form from resubmitting when hitting back button
    /*https://stackoverflow.com/questions/15226744/prevent-form-resubmission-upon-hitting-back-button*/
    header("Cache-Control: no cache");

    //this code was also included in stack overflow but created error
    //session_cache_limiter("private_no_expire");
    if(isset($_SESSION['firstname'])){
        echo "Welcome, ".$_SESSION['firstname']; 
     }
     ?>
    
</head>
<body>
    <div class="topnav">
    
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="">
        <input type ="submit" name="submit" value="Home">
    </form>
    <form action="accounts/index.php" method="post">
        <input type="hidden" name="action" value="getUserInfo">
        <input type ="submit" name="submit" value="User Account">
    </form>
    <form action="transactions/index.php" method="post">
        <input type="hidden" name="action" value="getTrans">
        <input type ="submit" name="submit" value="View Transaction History">
    </form>
    <form action="accounts/index.php" method="post">
        <input type="hidden" name="action" value="viewLogin">
        <input type ="submit" name="submit" value="Login">
    </form>
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

<footer><?php include 'common/footer.php'?></footer>
</html>


