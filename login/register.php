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
        $_SESSION["regMSG"] = "Account creato con successo!";
        $_SESSION["regMSG_good"] = true;
        header("Location: registerPage.php");
    } else {
        $_SESSION["regMSG"] = "Errore durante la registrazione: " . $conn->error;
        $_SESSION["regMSG_good"] = false;
    }
}
else{
    header("Location:../index.php");
}

