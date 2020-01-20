<?php
echo "Name: " . $_POST["name"] . "<br>";
echo "Email: " . $_POST["email"]. "<br>";
echo "Major: " . $_POST["major"]. "<br>";
echo "Comments: " . $_POST["comments"]. "<br>";
echo "Countries Visited: <br>";

$contAbbr = $_POST["continent"];
$contName = array("na"=>"North America","sa"=>"South America","eu"=>"Europe","au"=>"Australia","as" => "Asia", "af"=>"Africa", "ant"=>"Antarctica");


foreach($contAbbr as $each){
    echo "$contName[$each] <br>";
}


?>