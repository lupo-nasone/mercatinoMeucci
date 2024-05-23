<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ./login/login.html");
    exit();
}

require_once "./lib/connection.php";

$user_id = $_SESSION["login"];

$sql = "SELECT * FROM utenti WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    echo "<h2>Dati dell'utente:</h2>";
    echo "<p>Username: " . $user_data['username'] . "</p>";
    echo "<p>Email: " . $user_data['email'] . "</p>";
    echo "    <a href='./login/logout.php'>disconnessione</a>";
} else {
    echo "Nessun dato dell'utente trovato.";
}

$conn->close();
?>
