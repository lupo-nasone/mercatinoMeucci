<?php
// Avvia la sessione
session_start();

// Controlla se la variabile di sessione login non è impostata
if (!isset($_SESSION['login'])) {
    // Reindirizza alla pagina di login
    header("Location: ./login/login.html");
    exit(); // Assicura che lo script si interrompa dopo il reindirizzamento
}

// Includi il file di connessione al database
require_once "./lib/connection.php";

// Prendi l'ID dell'utente dalla variabile di sessione
$user_id = $_SESSION["login"];

// Query per ottenere tutti i dati dell'utente
$sql = "SELECT * FROM utenti WHERE id = $user_id";
$result = $conn->query($sql);

// Verifica se la query ha prodotto dei risultati
if ($result->num_rows > 0) {
    // Ottieni i dati dell'utente
    $user_data = $result->fetch_assoc();
    // Stampa i dati dell'utente
    echo "<h2>Dati dell'utente:</h2>";
    echo "<p>Username: " . $user_data['username'] . "</p>";
    echo "<p>Email: " . $user_data['email'] . "</p>";
    echo "    <a href='./login/logout.php'>disconnessione</a>";
    // Aggiungi altri dati dell'utente se necessario
} else {
    echo "Nessun dato dell'utente trovato.";
}

// Chiudi la connessione al database
$conn->close();
?>
