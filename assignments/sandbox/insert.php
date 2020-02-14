<?php
include 'db.php';
$name=$_POST['name'];
$age=$_POST['age'];

$db = connectdb();
if($db){
    //echo"connection made";
}
$sql = "INSERT INTO public.user values('$name','$age')";
$stmt = $db->prepare($sql);
$stmt->execute();

// function getUserInfo(){
//     $db = connectdb();
//     $sql = 'SELECT firstname, lastname, email FROM public.user
//     WHERE id = 1';
//     $stmt= $db->prepare($sql);
//     $stmt->execute();
//     $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $userInfo;
// }

// include_once('db.php');
// $name=$_POST['name'];
// $age = $_POST['age'];

// if(mysql_query("INSERT INTO public.user VALUES ('$name','$age')"))
// echo "Successfully Inserted";else echo"Insertion failed";

?>