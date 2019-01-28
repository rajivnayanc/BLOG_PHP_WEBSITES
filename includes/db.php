<?php
    $db['db_host'] = "localhost";
    $db['db_user'] = username;
    $db['db_pass'] = password;
    $db['db_name'] = database_name;
    
    foreach($db as $key => $value){
        define(strtoupper($key),$value);
    }

    $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    if(!$conn){
       die("Database Connection Failed!");
    }
    
    
?>
