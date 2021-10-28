<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = "pweb_1";

$conn = mysqli_connect($servername, $username, $password);
$createDB = "CREATE DATABASE IF NOT EXISTS $dbName";
mysqli_query($conn, $createDB);

mysqli_select_db($conn, $dbName);

$createTableUser = "
    CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(50)
        )
    ";
mysqli_query($conn, $createTableUser);  //create table