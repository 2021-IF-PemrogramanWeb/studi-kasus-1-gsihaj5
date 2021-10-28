<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = "pweb_1";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) die("connection failed: " . mysqli_connect_error());
