<?php
require_once "connection.php";
session_start();

// Verifica se sono stati inviati i dati del form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prendi i valori inviati dal form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $eta = $_POST['eta'];
    $classe = $_POST['classe'];
    
    // Query per inserire i dati nel database
    $sql = "INSERT INTO Utente (username, password, email, nome, cognome, eta, classe) 
            VALUES ('$username', '$password', '$email', '$nome', '$cognome', '$eta', '$classe')";
    
    if ($conn->query($sql) === TRUE) {
        // Registrazione riuscita, reindirizza alla pagina di login o a un'altra pagina
        header("Location: index.php");
        exit(); // Assicura che lo script si interrompa dopo il reindirizzamento
    } else {
        // Errore durante la registrazione
        echo "Errore durante la registrazione: " . $conn->error;
    }
}

// Chiudi la connessione al database
$conn->close();
?>
