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
        
        header("Location: ../index.php");
        exit(); 
    } else {
        echo "Nome utente o password non validi.";
        echo "<a href='login.html'>Torna al login</a>";
    }
}else{
    header("Location:../index.php");
}

