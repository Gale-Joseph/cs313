<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>   

<?php
/* New Steps to creating a PDO object and looping through a query array: 
    Step 1: Create a PDO Object:                    $db = new PDO('host;dbname=db',$user,$passowrd);
    Step 2: create a PDOStatement object (2 steps): $statement=$db->prepare(query); $statement->execute;
    Step 3: Use While loop & loop with fetch:       while($row = statement->fetch(PDO::FETCH_ASSOC));

    Old Steps to creating a PDO object and querying... 
*   Step 1: create a PDO object:                    $var = new PDO('host;dbname=db',$user,$password)
    Step 2: create a PDO statement object:          $statement = $var->query('Select statement')
    Step 3: use a fetchAll & put in $result var:    $result = $statement->fetchALL(PDO::FETCH_ASSOC)
*/

echo '<h1>Scripture Resources</h1>';

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

/*Creating a statement object is a two step process: */
// $statement = $db->query('SELECT * FROM scriptures'); //can also use query but prepare will be preferred
$statement = $db->prepare("SELECT * FROM scriptures");//step 1: use prepare statement
$statement->execute();//step 2: use execute statement

echo "prepared statement used on db:" . "<br>";
print_r($statement);

while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $book = $row['book'];
    $chapter = $row['chapter'];
    $verse = $row['verse'];
    $content = $row['content'];

    echo "<p><strong>$book $chapter:$verse</strong> - \"$content\"<p>";
}

/*using a form to search database*/
?>
<form method="post"><!--Tells us what kind of an array the form data will be put in-->
    <input type = "text" name = "bookName"><!--identifies a key name of 'bookname'-->
    <input type="submit" name = "submit"><!--identifies a key name of 'submit'-->
</form>
<?php
/*check to make sure $_POST is filled*/
if(isset($_POST['submit'])){
    $book = $_POST['bookName'];//put the value of key 'bookName' in $book
    $bookArray = $db->prepare("SELECT * FROM scriptures WHERE book = '$book'");//add ' ' for postgres
    $bookArray->execute();//step 2 of creating a PDOstatement that can be read

    while($row = $bookArray->fetch(PDO::FETCH_ASSOC)){//go through line by line using fetch
        $book = $row['book'];
        $chapter = $row['chapter'];
        $verse = $row['verse'];
        $content = $row['content'];
        $id = $row['id'];
    
        // echo "<p><strong>$book $chapter:$verse</strong> - \"$content\"<p>"; //show references with text
        echo "<p><strong>$book $chapter:$verse</strong> - <a href='details.php?action=$id'>Link to text</a><p>"; //implicity create $_GET[] key-value pair
    }
}
?>
</body>
</html>
