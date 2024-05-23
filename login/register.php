<?php
require "../lib/connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = hash("sha256", $_POST['password']);
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $eta = $_POST['eta'];
    $classe = $_POST['classe'];
    
    $sql = "INSERT INTO Utente (email, password, nome, cognome, eta, classe) 
            VALUES ('$email', '$password', '$nome', '$cognome', '$eta', '$classe')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Errore durante la registrazione: " . $conn->error;
    }
}
else{
    header("Location:../index.php");
}

