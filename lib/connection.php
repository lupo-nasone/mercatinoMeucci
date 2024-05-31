<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercatino";

mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
