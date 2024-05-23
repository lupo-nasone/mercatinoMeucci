<?php
require_once "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $eta = $_POST['eta'];
    $classe = $_POST['classe'];

    $sql = "INSERT INTO Utente (username, password, email, nome, cognome, eta, classe) 
            VALUES ('$username', '$password', '$email', '$nome', '$cognome', '$eta', '$classe')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errore durante la registrazione: " . $conn->error;
    }
}

$conn->close();
?>
