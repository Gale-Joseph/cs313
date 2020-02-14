<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var commentCount = 2;
            $("button").click(function(){
                commentCount = commentCount + 2;
                $("#output").load("load-comments.php", {
                    commentNewCount: commentCount
                });
            });
        });
    </script>


    <title>Document</title>
</head>

<?php
// ############ connection attmpt
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

//################# db insert
//1. set variables. I'm being lazy and creating these variables if only book gets filled in
if(isset($_POST['book'])){
$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
//put the array of chkTopics[] into variable:
if(isset($_POST['chkTopics'])){
    $topicIds = $_POST['chkTopics'];
}

if(isset($_POST['newTopicBox'])){
    $newTopicTrue = $_POST['newTopicBox'];
}

if(isset($_POST['newTopic'])){
    $newTopic = $_POST['newTopic'];
}

//2. insert your new scripture into the database
$query = "INSERT INTO scriptures(book,chapter,verse,content) VALUES('$book','$chapter','$verse','$content')";
$statement = $db->prepare($query);
$statement->execute();

//3. insert topic and scripture pair into scripture_topic table:
//get the id of the last inserted scripture. Use ->lastInsertId with the sequence from the database
$scriptureId = $db->lastInsertId('scriptures_id_seq');
//loop through the $topicIds array and insert each topic and associated scripture into scripture_topic table
if(isset($topicIds)){
    foreach($topicIds as $topicId){
        echo "ScriptureId: $scriptureId, topicId: $topicId";
        $statement = $db->prepare("INSERT INTO scripture_topic(scriptureid,topicid) VALUES('$scriptureId','$topicId')");
        $statement->execute();
    }
}

if(isset($newTopicTrue)){
    echo "A new topic has been entered";
    $query = "INSERT INTO topic(name) VALUES('$newTopic')";
    $statement = $db->prepare($query);
    $statement->execute();

    $query2 = "INSERT INTO scripture_topic(scriptureid,topicid) VALUES('$scriptureId',(SELECT id from topic WHERE name='$newTopic'))";
    $statement2 = $db->prepare($query2);
    $statement2->execute();

}

}
?>
<p id="msg"></p>
<!-- #################   submission form #####################-->
<form id="sForm" method="post"><!--Tells us what kind of an array the form data will be put in-->
    <label>book</labeL>
    <input type = "text" name = "book" id="book"><br>
    <label>chapter</label>
    <input type = "text" name = "chapter" id="chapter"><br>
    <label>verse</label>
    <input type = "text" name = "verse" id="verse"><br>
    <label>content</label>
    <textarea name="content" id="content"></textarea><br>
    <label>topic</label><br>
    <?php
    $statement2 = $db->prepare("SELECT * FROM topic");
    $statement2->execute();    
    while($row = $statement2->fetch(PDO::FETCH_ASSOC)){
        //get id var from solution
        $id=$row['id'];
        $topic = $row['name'];

       //create an array on the fly as a key use chkTopics[] as name, let $id correspond with index value of array
        echo "<input type='checkbox' name='chkTopics[]' id='chkTopic#id' value='$id'>$topic</input><br>";
        echo "<label for='chkTopics$id'>$topic</label><br />";
        echo "\n";
    }
    ?>
    <input type="checkbox" name="newTopicBox" value=1>
    <input type="text" name="newTopic"></input>
    <button type="submit" name = "submit" value="submit">Submit</button><!--identifies a key name of 'submit'-->

    <?php

    //*****************print scriptures with topics*****************************
    echo "<div id='output'>";
    $query= "SELECT book, chapter, verse, topic.name from scriptures inner join scripture_topic on scriptures.id=scripture_topic.scriptureid inner join topic on scripture_topic.topicid=topic.id;";
    $statement = $db->prepare($query);
    $statement->execute();

    while($row = $statement->fetch(PDO::FETCH_ASSOC)){//go through line by line using fetch
        $book = $row['book'];
        $chapter = $row['chapter'];
        $verse = $row['verse'];
        $topic = $row['name'];
       
    
        //print scriptures with topics
        echo "<p><strong>$book $chapter:$verse</strong> - $topic;"; 
    }
    echo "</div>";

    //###attemping printing with ajax

    ?>
</form>
</html>
