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
    echo "<table><tr><th>Ticker</th><th>Date</th><th>Price</th><th>Shares</th></tr>";
    while($row = $results->fetch(PDO::FETCH_ASSOC)){
        echo    "<tr>" 
        . "<td>". "$row[ticker]</td>"
        . "<td>". "$row[buydate]</td>"
        . "<td>". "$row[buyprice]</td>"
        . "<td>". "$row[shares]</td>";
}
    echo"</table>";
?>