<?php
//this page takes care of stock purchases 
include 'library/connections.php';
$db = connectdb();

//validate whether user can make that purchase
//1.Get total of user's account
//$accountAmount = $db->prepare('SELECT tradeacctamount FROM public.user WHERE id=(SELECT id from public.user where $_SESSION[userInfo][email]=public.user.email)');
$accountAmount = $db->prepare('SELECT tradeacctamount FROM public.user WHERE public.user.id=9');
$accountAmount->execute();
$row = $accountAmount->fetch(PDO::FETCH_BOTH);
$oldAmount = $row['tradeacctamount'];
if($oldAmount<100){
    $message = "Not enough in account";
    include "/view/home";
    exit;
}

// header('Location: test.php');

//2. Put form data into variables
$ticker=strtolower($_POST['ticker']);
$date=$_POST['date'];
$price=$_POST['price'];
$shares=$_POST['shares'];
$total = $price*$shares;


//3. Compare prices and insert into portfolio
//check if stock is already in portfolio
/* this is a problem because portfolio won't represent true price;
new shares added will have price of original shares*/
$tickerFound= False;
$portfolio = $db->prepare('SELECT ticker, buyprice FROM portfolio');
$portfolio->execute();
while($row=$portfolio->fetch(PDO::FETCH_ASSOC)){
    if(strtolower($row['ticker'])==strtolower($ticker)){
        $tickerFound = True;
    }
}

//if ticker already exists in portfolio:
if($tickerFound==True){
    //find current number of shares
    $oldShares = $db->prepare("SELECT shares FROM portfolio WHERE ticker='$ticker'");
    $oldShares->execute();
    $row = $oldShares->fetch(PDO::FETCH_BOTH);
    $oldShares = $row['shares'];
    //add new shares to create new total
    $newShares = $oldShares + $shares;
    $sql = "UPDATE portfolio SET shares='$newShares' WHERE ticker='$ticker'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    //add to trans table    
    $sql = "INSERT INTO trans VALUES(default,'$date','$ticker','$price'
    ,'$shares','$total',0)";
    $stmt = $db->prepare($sql);
    $stmt->execute();

//if ticker does not yet exist in portfolio;
}else{
    if($oldAmount>$total){
        //add to portfolio
        $updateAmount = $oldAmount-$total;
        $sql = "INSERT INTO portfolio values(default,'$ticker','$date','$price',
        '$shares')";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    
        //add amount to user account
        $sql2 = "UPDATE public.user SET tradeacctamount='$updateAmount'";
        $stmt2 = $db->prepare($sql2);
        $stmt2 ->execute();

        //add to trans table        
       $sql3 = "INSERT INTO trans VALUES(default,'$date','$ticker','$price'
         ,'$shares','$total',0)";
        $stmt3 = $db->prepare($sql3);
        $stmt3->execute();
    }
}


?>