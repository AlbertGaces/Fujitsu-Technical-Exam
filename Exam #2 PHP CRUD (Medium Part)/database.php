<?php
    $database = mysqli_connect("localhost", "root", "", "crud_db");
    if(!$database){
        die("Connection Failed: " . mysqli_connect_error());
    }
?>