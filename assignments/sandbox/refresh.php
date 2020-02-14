<?php
require_once('db.php');
try{
    $db = connectdb();
    $results = $db->prepare('SELECT * FROM public.user');
    $results->execute();
    $names=$results->fetchAll(PDO::FETCH_ASSOC);
    $results->closeCursor();
} catch(Exception $e){
    echo "there was an error pulling from db";
    exit;
}

if ($names==true){
    foreach($names as $name){
        $name = $name['name'];
        //$age = $name['age'];
        echo "$name";
    }
}


?>