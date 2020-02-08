<?php
//portfolio model - functions for reading/updating

//get portfolio based on default user
function getPort(){
    $db = connectdb();
    $sql = 'SELECT ticker, buydate, buyprice, shares, 
                currentprice, currentvalue,profit FROM portfolio
                WHERE id = 1';
    $stmt= $db->prepare($sql);
    $stmt->execute();
    $portData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $portData;
}
?>