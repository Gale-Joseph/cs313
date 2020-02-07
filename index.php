<?php 


try{
  //this information comes from settings of database
  $user = 'afcznoceukzzju';
  $password='449c32a4d853e16e1a2a2af197b9ec5b9304fbb3c170ad009d55b5e3459afd3a';
  $host = 'ec2-52-22-111-202.compute-1.amazonaws.com';
  $dbname='d1ali0b11dpglf';

  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
  //sets $db to raise an exception, not necessary for connection issues in previous statement
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'Connection made!!';
}
catch(PDOException $ex){
  echo 'Error!: '. $ex->getMessage();
  die();
}

  ?>