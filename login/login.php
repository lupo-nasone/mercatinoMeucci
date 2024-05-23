<?php
require_once "connection.php";
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT id FROM Utente WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        
        $_SESSION["login"] = $user_id;
        
        header("Location: index.php");
        exit();
    } else {
        echo "Nome utente o password non validi.";
        echo "<a href='login.html'>Torna al login</a>";
    }
}

$conn->close();
?>
