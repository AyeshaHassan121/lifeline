<?php

$host = "localhost";
$username = "lifeline_user";
$password = "YOUR_PASSWORD_HERE";
$database = "lifeline_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed.");
}

$conn->set_charset("utf8mb4");
