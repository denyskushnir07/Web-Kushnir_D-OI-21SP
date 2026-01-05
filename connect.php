<?php
// Параметри підключення до БД
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deves_medical_centre";

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

