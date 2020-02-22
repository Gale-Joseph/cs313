<?php
//transactions model - both portfolio and transactions

//get portfolio based on default user
//function called on transactions controller
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

//get transaction history based on default user
//function called on transactions controller
function getTrans(){
    $db = connectdb();
    $sql = 'SELECT trans.date, ticker, price, shares, stocktotal,deposittotal
            FROM trans WHERE id = 1';
    $stmt= $db->prepare($sql);
    $stmt->execute();
    $transData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $transData;
}

function addFunds($amount){
    $db = connectdb();
    $sql = 'SELECT tradeacctamount FROM public.user WHERE id=1';
    //get funds
    $stmt= $db->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $originalAmount = $row['tradeacctamount'];
    //add funds to original amount and insert
    $newAmount = $originalAmount + $amount;
    $sql = "UPDATE public.user SET tradeacctamount='$newAmount' WHERE id=1";
    $stmt= $db->prepare($sql);
    $stmt->execute();   
    //add the transaction to the transaction table
    

}
?>