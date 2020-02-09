<?php
include 'index.php';//adding this due to laziness; better solution to reference controller page
$id = $_GET['action'];
$textArray = $db->prepare("SELECT * FROM scriptures WHERE id='$id'");//add ' ' for postgres
$textArray->execute();//step 2 of creating a PDOstatement that can be read
$result = $textArray->fetch(PDO::FETCH_ASSOC);//must put ->fetch in a variable to echo results

$content = $result['content'];
$book = $result['book'];
$chapter = $result['chapter'];
$verse = $result['verse'];
$content = $result['content'];

echo $content . "<br>";
echo "<strong>$book $chapter:$verse</strong>";


?>