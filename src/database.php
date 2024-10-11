<?php
$servername = "db";
$username = "root";
$password = "root_password";
$database = "lamp_db"; // Replace with your database name

$mysqli = new mysqli($servername, $username, $password);

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Select the database
if (!$mysqli->select_db($database)) {
  die("Database selection failed: " . $mysqli->error);
}
