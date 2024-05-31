<?php

require "../lib/connection.php";
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prezzo = $_POST["proposta"];
    $annuncio_id = $_POST["annuncio_id"];	
    $sql = "INSERT INTO Proposta (prezzo, created_at, accepted, Annuncio_id, Utente_id) 
            VALUES($prezzo, '" . date('Y-m-d H:i:s') . "' , false, $annuncio_id, '" . $_SESSION["login"] . "')";

    $result = $conn->query($sql);

    if(!$result){
        $_SESSION["MSG"] = "Errore: " . $conn->error;
        $_SESSION["MSG_good"] = false;
    }else{
        $_SESSION["MSG"] = "proposta inviata con successo!";
        $_SESSION["MSG_good"] = true;
    }
    header("Location: ./aggiungiProposta.php?id=$annuncio_id");
}else{
    header("Location: ../index.html");
}