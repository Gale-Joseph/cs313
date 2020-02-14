<?php include 'db.php'?>
<html>
    <head><title>Insert into my database</title></head>
    <script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    <script src="my_script.js" type="text/javascript"></script>
    
    
    <body>

        <form id="myForm" action="insert.php" method="post">
            Name: <input type="text" name="name" /><br>
            Age: <input type="text" name="age" /><br>
            <button id = "sub">Save</button>
        </form>
    <div class="content">
    
    
    
    <?php
    try{
   
    $db = connectdb();
    $results = $db->prepare('SELECT * FROM public.user');
    $results->execute();
    $names=$results->fetchAll(PDO::FETCH_ASSOC);
    $results->closeCursor();
} catch(Exception $e){
    echo "there was an error starting out";
    exit;
}

if ($names==true){
    foreach($names as $name){
        $name = $name['name'];
        
        echo "$name";
    }
}
   ?> </div>
    </body>
    
</html>