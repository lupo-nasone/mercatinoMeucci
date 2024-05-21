<?php
// Parametri di connessione al database
$servername = "localhost"; // Modifica con il nome del server del tuo database
$username = "root"; // Modifica con il tuo nome utente del database
$password = ""; // Modifica con la tua password del database
$dbname = "mercatino"; // Modifica con il nome del tuo database

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}