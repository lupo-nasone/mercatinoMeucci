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


         $result = $conn->query("INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) VALUES ('$titolo', '$descrizione', $tipologia , $utente_id)");
         if(!$result){
            $_SESSION["MSG"] = "Errore: " . $conn->error;
            $_SESSION["MSG_good"] = false;
        }else{
            $_SESSION["MSG"] = "annuncio postato con successo";
            $_SESSION["MSG_good"] = true;
        }

        //qui va male 
        //  $sql = "SELECT MAX(id) as id FROM Annuncio";
        //  $maxid_res = $conn->query($sql);
        //  $maxid = -1;
        //  $_SESSION["test"] = $maxid_res;
        //  if(!$maxid_res && $maxid_res->num_rows > 0){
        //     while($row = $maxid_res->fetch_assoc){
        //         $maxid = $row["id"];
        //      }
        //  }else{
        //     $_SESSION["MSG"] = "errore nel selezionare max(id)";
        //     $_SESSION["MSG_good"] = false;
        //  }
         

        //il file continua a non venire spostato
         if (!empty($_FILES['file']['name'][0]) /*&& $maxid > 0*/) {
             $uploadsDir = './uploads/';
             foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
                 $fileName = $_FILES['file']['name'][$key];
                 $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                 $newFileName = uniqid() . '.' . $fileExtension;
                 $targetPath = $uploadsDir . $newFileName;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $result = $conn->query("INSERT INTO Foto (url, Annuncio_id) VALUES ('$targetPath', $maxid)");
                 } else {
                    
                    $_SESSION["MSG"] = "errore spostamento file(annuncio postato con immagine invalida)";
                    $_SESSION["MSG_good"] = false;;
                 }
            }
        }


        //riscritto il codice senza l'immagine per far funzionare per testing
        // {
        // $sql = "INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) 
        //         VALUES ('$titolo', '$descrizione', '$tipologia', $utente_id)";
        // $result = $conn->query($sql);
        // }

        //fine riscrittura

        
        echo '<script>window.location="./aggiungiAnnuncio.php"</script>';
     }
?>