<?php
    $db['db_host'] = "localhost";
    $db['db_user'] = "rajiv";
    $db['db_pass'] = "tweet@twit";
    $db['db_name'] = "cms";
    
    foreach($db as $key => $value){
        define(strtoupper($key),$value);
    }

    $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    if(!$conn){
       die("Database Connection Failed!");
    }
    
    
?>