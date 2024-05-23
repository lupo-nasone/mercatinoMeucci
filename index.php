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
    //per testare se fa
    $user_data = $result->fetch_assoc();
    echo "<h2>Dati dell'utente:</h2>";
    echo "<p>Username: " . $user_data['username'] . "</p>";
    echo "<p>Email: " . $user_data['email'] . "</p>";
    echo "    <a href='./login/logout.php'>disconnessione</a>";
} else {
    echo "Nessun dato dell'utente trovato.";
}



