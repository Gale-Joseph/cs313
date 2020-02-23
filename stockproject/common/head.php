<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    <script src="../js/main.js" type="text/javascript"></script>
    <title>
        <?php if(isset($titleTag)){ 
            echo $titleTag ." | Gale, Inc.";
            }else{
                echo "Gale Inc.";
            }
        ?>               
    </title>
    
    <?php
    
    //this prevents the form from resubmitting when hitting back button
    /*https://stackoverflow.com/questions/15226744/prevent-form-resubmission-upon-hitting-back-button*/
    header("Cache-Control: no cache");

    //this code was also included in stack overflow but created error
    //session_cache_limiter("private_no_expire");

    if(isset($_SESSION['firstname'])){
       echo "Welcome, ".$_SESSION['firstname']; 
    }
    ?>
</head>
