<?php
include 'library/connections.php';
if(!isset($_SESSION)){
    session_start();
}
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
    echo "<table><tr><th>Ticker</th><th>Date</th><th>Price</th><th>Shares</th><th>Total Value</th></tr>";
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
    echo"</table>";
?>