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

function addFunds($email,$amount){
    $db = connectdb();
    $sql = "SELECT tradeacctamount FROM public.user 
        WHERE public.user.email = '$email'";
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
function buyStock($email,$ticker,$price,$shares,$date){
    $db = connectdb();
    //if ticker and price already in portfolio, update share number
    if(checkTickerPrice($email,$ticker,$price)){
        //retreive current number of shares
        $oldShares = $db->prepare("SELECT shares FROM portfolio 
                INNER JOIN public.user ON portfolio.userid=public.user.id
                WHERE ticker='$ticker' AND public.user.email='$email'");
        $oldShares->execute();
        $row = $oldShares->fetch(PDO::FETCH_BOTH);
        $oldShares = $row['shares'];
        //add new shares to current number of shares
        $newShares = $oldShares + $shares;
        $sql = "UPDATE portfolio SET shares='$newShares' 
                FROM public.user 
                WHERE ticker='$ticker' AND shares='$oldShares'
                AND public.user.id = portfolio.userid";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        //add to transaction table as a debit and update user amount
        addTrans($email,$ticker,$price,$shares,$date,'debit',0);        
        return True;
    }else {
        //add to portfolio as a new entry
        $sql = "INSERT INTO portfolio 
                VALUES(default,'$ticker','$date','$price',
        '$shares',
                (SELECT public.user.id FROM public.user WHERE
                public.user.email='$email'))";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        //add to transaction table as debit and update user amount
        addTrans($email,$ticker,$price,$shares,$date,'debit',0);  
        return True;
    }
}
function sellStock($email,$ticker,$price,$shares,$date){
    //see if just ticker is in portfolio
    if(checkTicker($email,$ticker)){
        $db = connectdb();
        //create a loop to sell one share from portfolio at a time
        for($x = 1; $x<=$shares;$x++){
            //get id and shares number of first available stock
            $portfolio = $db->prepare("SELECT portfolio.id,shares FROM portfolio 
            INNER JOIN public.user ON portfolio.userid=public.user.id
            WHERE public.user.email='$email'AND portfolio.ticker='$ticker'
            fetch first row only");
            $portfolio->execute();
            $row = $portfolio->fetch(PDO::FETCH_BOTH);
            $id = $row['id'];
            $oldShares = $row['shares'];

            //get updated number of shares
            $currentShares = $oldShares-1;
            //delete row if $currentShares == 0;
            if($currentShares==0){
                $sql = "DELETE FROM portfolio WHERE portfolio.id='$id'";
                $stmt = $db->prepare($sql);
                $stmt->execute();  
            }else{
                //add new number of shares
                $sql = "UPDATE portfolio SET shares = '$currentShares'
                        WHERE portfolio.id='$id'";
                $stmt = $db->prepare($sql);
                $stmt->execute(); 
            }
            //add to transaction table
            addTrans($email,$ticker,$price,$shares,$date,'credit',0);
            return True;            
        }
       
    }else{
        return False;
    }
}
//this function adds a transaction for debit, credit, deposit, withdraw
function addTrans($email,$ticker,$price,$shares,$date,$string,$amount){
    $db = connectdb();
    //set debits, credits, withdraws, and deposits
    if($string=='debit'){
        $stockTotal = $price*$shares*-1;
        $deposit = 0;
    }
    if($string=='credit'){
        $stockTotal = $price*$shares;
        $deposit = 0;
    }
    if($string=='deposit'){
        $stockTotal=0;
        $deposit = $amount;
    }
    if($string=='withdraw'){
        $stockTotal=0;
        $deposit = $amount * -1;
    }
    //prepare for insert for debit and credit
    $sql = "INSERT INTO trans VALUES(default,'$date','$ticker','$price'
    ,'$shares','$stockTotal',$deposit,(SELECT public.user.id 
                                FROM  public.user 
                                WHERE public.user.email='$email'))";  
    $stmt = $db->prepare($sql);
    $stmt->execute();

    //update public.user amount
    $stmt = $db->prepare("SELECT tradeacctamount FROM public.user 
    WHERE public.user.email= '$email'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_BOTH);
    $oldAmount = $row['tradeacctamount'];

    if($string=='credit'||$string=='debit'){
        $currentAmount = $oldAmount + $stockTotal;
    } 
    if($string=='deposit'||$string=='withdraw') {
        $currentAmount = $oldAmount + $deposit;
    }    
    //insert current amount in public.user
    $sql2 = "UPDATE public.user SET tradeacctamount='$currentAmount'
            WHERE public.user.email = '$email'";
    $stmt2 = $db->prepare($sql2);
    $stmt2 ->execute();

}

//this function verifies if symbol and price already exist in db
function checkTickerPrice($email,$ticker,$price){
    $tickerFound= False;
    $db = connectdb(); 
    //find query where ticker and buyprice are same    
    $portfolio = $db->prepare("SELECT ticker, buyprice 
                FROM portfolio INNER JOIN public.user 
                ON portfolio.userid = public.user.id 
                WHERE public.user.email='$email'
                AND portfolio.buyprice = '$price'");
    $portfolio->execute();
    //if above query has results, return true
    while($row=$portfolio->fetch(PDO::FETCH_ASSOC)){
        if(strtolower($row['ticker'])==strtolower($ticker)){
            $tickerFound = True;
            return $tickerFound;
        }
    }
    return $tickerFound;
}

function checkTicker($email,$ticker){
    $tickerFound= False;
    $db = connectdb(); 
    //find query where ticker and buyprice are same    
    $portfolio = $db->prepare("SELECT ticker 
                FROM portfolio INNER JOIN public.user 
                ON portfolio.userid = public.user.id 
                WHERE public.user.email='$email'");
    $portfolio->execute();
    //if above query has results, return true
    while($row=$portfolio->fetch(PDO::FETCH_ASSOC)){
        if(strtolower($row['ticker'])==strtolower($ticker)){
            $tickerFound = True;
            return $tickerFound;
        }
    }
    return $tickerFound;
}


function checkFunds($email,$amount){
    $db = connectdb();
    $accountAmount = $db->prepare("SELECT tradeacctamount FROM public.user 
    WHERE public.user.id= (SELECT public.user.id FROM public.user WHERE
     email = '$email')");
    $accountAmount->execute();
    $row = $accountAmount->fetch(PDO::FETCH_BOTH);
    if($row['tradeacctamount']<$amount){
        return False;
    }else{
        return True;
    }
}
?>