<?php
require "../lib/connection.php";
session_start();
$status = $_POST["status"];
$id = $_POST["id"];
$annuncio_id = $_POST["annuncio_id"];

if(isset($_SESSION["login"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

    
    var_dump($id);

    $sql = "UPDATE Proposta SET accepted = $status WHERE Proposta.id = $id";

    $result = $conn->query($sql);

    if($result){
        if($status == 1){
            $sql = "UPDATE Proposta SET accepted = 2 
                WHERE Proposta.id IN (
                    SELECT Proposta.id FROM Proposta 
                    JOIN Annuncio ON Annuncio.id = Proposta.Annuncio_id
                    WHERE Annuncio.id = $annuncio_id AND Proposta.accepted = 0
                )";
        $result = $conn->query($sql);
        }
        
    }
}
echo "<script>window.location='./aggiungiProposta.php?id=$annuncio_id'</script>";




