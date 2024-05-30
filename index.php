<?php
require "./lib/connection.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ./login/login.html");
}

$user_id = $_SESSION["login"];

$sql = "SELECT * FROM Utente WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: mainpage.php");
} else {
    header("Location: ./login/login.html");
}
