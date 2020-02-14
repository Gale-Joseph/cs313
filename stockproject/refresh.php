<?php
include 'library/connections.php';
try{
   
    $db = connectdb();
    $results = $db->prepare('SELECT * FROM portfolio');
    $results->execute();
    
} catch(Exception $e){
    echo "there was an error starting out";
    exit;
}
    while($row = $results->fetch(PDO::FETCH_ASSOC)){
        $ticker = $row['ticker'];
        $buydate = $row['buydate'];
        $buyprice = $row['buyprice'];
        $shares = $row['shares'];
        echo "<p>$ticker  $buydate  $buyprice  $shares</p>";
    }
?>