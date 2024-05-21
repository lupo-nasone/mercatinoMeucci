<?php
require_once "connection.php";
session_start();


// Verifica se sono stati inviati i dati del form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prendi i valori inviati dal form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Query per verificare se l'utente esiste nel database
    $sql = "SELECT id FROM Utente WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Otteniamo l'ID dell'utente dal risultato della query
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        
        // Memorizziamo l'ID dell'utente nella variabile di sessione
        $_SESSION["login"] = $user_id;
        
        header("Location: index.php");
        exit(); // Assicura che lo script si interrompa dopo il reindirizzamento
    } else {
        // Login fallito
        echo "Nome utente o password non validi.";
        echo "<a href='login.html'>Torna al login</a>";
    }
}

// Chiudi la connessione al database
$conn->close();
?>
