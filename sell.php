<?php
//this page takes care of stock sales
include 'library/connections.php';
$db = connectdb();


//validate whether user can make that purchase
//1.Get total of user's account
$accountAmount = $db->prepare('SELECT tradeacctamount FROM public.user');
$accountAmount->execute();
$row = $accountAmount->fetch(PDO::FETCH_BOTH);
$oldAmount = $row['tradeacctamount'];

//2. Put form data into variables
$ticker=strtolower($_POST['ticker']);
$date=$_POST['date'];
$price=$_POST['price'];
$shares=$_POST['shares'];
$total = $price*$shares;

//3. Get current shares of stock from portfolio
$currentShares = $db->prepare("SELECT shares FROM portfolio
                                WHERE ticker='$ticker'");
$currentShares->execute();
$row2 = $currentShares->fetch(PDO::FETCH_BOTH);
$oldShares = $row2['shares'];

//4. Compare prices and update user and portfolio    
if($oldShares>=$shares){    
    $currentShares = $oldShares-$shares;
    $sql = "UPDATE portfolio SET shares ='$currentShares'
                WHERE ticker='$ticker'";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    if($currentShares==0){
        $sql = "DELETE FROM portfolio WHERE ticker='$ticker'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    

    $oldAmount = $oldAmount+$total;
    $sql2 = "UPDATE public.user SET tradeacctamount='$oldAmount'";
    $stmt2 = $db->prepare($sql2);
    $stmt2 ->execute();
}


?>