<?php

$servername = 'localhost';
$username = 'u220838971_pweb_1';
$password = 'haloPweb123';
$dbName = "u220838971_pweb_1";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) die("connection failed: " . mysqli_connect_error());
