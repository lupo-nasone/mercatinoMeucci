<?php
require "../lib/connection.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["login"])){
    
    $id = $_POST["id"];

    $sql = "DELETE FROM Annuncio WHERE Annuncio.id = $id";
    $result = $conn->query($sql);

    if(!$result){
        $_SESSION["MSG"] = "Errore: " . $conn->error;
        $_SESSION["MSG_good"] = false;
    }else{
        $_SESSION["MSG"] = "Annuncio eliminato con successo";
        $_SESSION["MSG_good"] = true;
    }
    header("Location: ../profile/profile.php");
}else{
    header("Location: ../index.php");
}