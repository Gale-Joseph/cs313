<?php
//accounts model - functions for reading/updating

//get account info based on default user
function getUserInfo(){
    $db = connectdb();
    $sql = 'SELECT firstname, lastname, email FROM public.user
    WHERE id = 1';
    $stmt= $db->prepare($sql);
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
?>