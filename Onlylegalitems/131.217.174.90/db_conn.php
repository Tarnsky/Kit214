<?php
//database connection
$mysqli=new mysqli("localhost", "root", "", "item_db");

if (mysqli_connect_errno()) {
    printf("failed to connect to datebase: %s\n", mysqli_connect_error());
    exit();
}
?>
