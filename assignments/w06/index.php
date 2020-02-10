<?php
//connection attmpt
try{
    $user = 'postgres';
    $password='014722';

    $db = new PDO('pgsql:host=localhost;dbname=scriptures', $user, $password);
    //sets $db to raise an exception, not necessary for connection issues in previous statement
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo 'Error!: '. $ex->getMessage();
    die();
}
//db display checkboxes
//call db
$table_connection = $db;

//put all info from table topics

$statement = $db->prepare("SELECT * FROM topic");
$statement->execute();
if(isset($_POST['book'])){
    print_r($_POST);
}

//db insert
if(isset($_POST['book'])){
$book = $_POST['book'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topic = $_POST['topic'];


}


//statements


?>

<!--submission form-->
<form id="sForm" method="post"><!--Tells us what kind of an array the form data will be put in-->
    <label>book</labeL>
    <input type = "text" name = "book"><br>
    <label>chapter</label>
    <input type = "text" name = "chapter"><br>
    <label>verse</label>
    <input type = "text" name = "verse"><br>
    <label>content</label>
    <textarea name="content"></textarea><br>
    <label>topic</label><br>
    <?php
    $statement2 = $db->prepare("SELECT * FROM topic");
    $statement2->execute();    
    while($row = $statement2->fetch(PDO::FETCH_ASSOC)){
        $topic = $row['name'];
        echo "<input type = 'checkbox' name='topic'>$topic</input><br>";
    }
    ?>
    <input type="submit" name = "submit"><!--identifies a key name of 'submit'-->
</form>
