<?php 
    session_start();
    unset($_SESSION["MSG"]);
    unset($_SESSION["MSG_good"]);
?>

<!--

        TODO:
        - fixare sto casin bordel disastro della roba dei file
        - quando l'upload file funziona, assicurarsi che l'annuncio non venga postato se non va a buon fine anche il file


-->
<?php
require_once "../lib/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $_POST['Titolo'];
    $descrizione = $_POST['descrizione'];
    $tipologia = $_POST['tipologia'];

    $utente_id = $_SESSION["login"];

        // questo andrebbe fatto dopo l'upload della foto
         $result = $conn->query("INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) VALUES ('$titolo', '$descrizione', $tipologia , $utente_id)");
         if(!$result){
            $_SESSION["MSG"] = "Errore: " . $conn->error;
            $_SESSION["MSG_good"] = false;
        }else{
            $_SESSION["MSG"] = "annuncio postato con successo";
            $_SESSION["MSG_good"] = true;
        }



        
        echo '<script>window.location="./aggiungiAnnuncio.php"</script>';
     }
?>