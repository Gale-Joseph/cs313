<?php
   function connectdb(){
    //this information comes from settings of database in heroku
    $user = 'postgres';
    $password='014722';
    $host = 'localhost';
    $dbname='test';
    try{
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        //sets $db to raise an exception, not necessary for connection issues in previous statement
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
      }
      catch(PDOException $ex){        
        include 'view/500.php';        
        exit;

      }
}

// $conn = mysqli_connect('localhost',)


?>