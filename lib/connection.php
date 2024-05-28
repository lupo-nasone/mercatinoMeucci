<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_faginali5cia";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
