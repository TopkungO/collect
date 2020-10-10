<?php
    define('DB_server','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','crud_oop');

    $dbcon=mysqli_connect(DB_server,DB_USER,DB_PASS,DB_NAME);
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQLI:" . mysqli_connect_error();
    }
?>