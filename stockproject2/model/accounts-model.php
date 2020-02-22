<?php
//accounts model - functions for reading/updating

//get account info based on default user
function getUserInfo($email){
    $db = connectdb();
    $sql = 'SELECT firstname, lastname, email, tradeacctamount FROM public.user
    WHERE email = :email';
    $stmt= $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userInfo;
}

function getClient($clientEmail){
    $db = connectdb();
    $sql = 'SELECT firstname, password FROM public.user WHERE email = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    //fetch is used if single record return expected
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }
function updateUser($firstname,$lastname,$email,$password){
    $db = connectdb();
    $sql = 'UPDATE public.user SET firstname= :firstname, lastname= :lastname, 
            email= :email, password= :password WHERE id = 1';
    $stmt= $db->prepare($sql);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
}


?>