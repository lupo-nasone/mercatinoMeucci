<?php
require "../lib/connection.php";
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = hash("sha256", $_POST['password']);
    
    $sql = "SELECT id FROM Utente WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        
        $_SESSION["login"] = $user_id;


        unset($_SESSION["loginMSG"]);
        unset($_SESSION["loginMSG_good"]);
        header("Location: ../index.php");
        exit(); 
    } else {
        $_SESSION["loginMSG"] = "Errore: email o password errati";
        $_SESSION["loginMSG_good"] = false;
        header("Location: loginPage.php");
    }
}else{
    header("Location:../index.php"); 
}

