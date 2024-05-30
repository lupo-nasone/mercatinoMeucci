<!--

        TODO:
        - fixare sto casin bordel disastro della roba dei file


-->
<?php
require_once "../lib/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $_POST['Titolo'];
    $descrizione = $_POST['descrizione'];
    $tipologia = $_POST['tipologia'];

    
    session_start();
    $utente_id = $_SESSION["login"];


         $result = $conn->query("INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) VALUES ('$titolo', '$descrizione', $tipologia , $utente_id)");
         if(!$result){
            $_SESSION["MSG"] = "Errore: " . $conn->error;
            $_SESSION["MSG_good"] = false;
        }else{
            $_SESSION["MSG"] = "Annuncio pubblicato con successo";
            $_SESSION["MSG_good"] = true;
        }

         $sql = "SELECT MAX(id) as id FROM annuncio";
         $maxid_res = $conn->query($sql);
         $maxid = -1;
         if($maxid_res->num_rows > 0){
            while($row = $maxid_res->fetch_assoc){
                $maxid = $row["id"];
             }
         }else{
            echo "errore nel selezionare max(id)";
         }
         



         if (!empty($_FILES['file']['name'][0])) {
             $uploadsDir = './uploads/';
             foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
                 $fileName = $_FILES['file']['name'][$key];
                 $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                 $newFileName = uniqid() . '.' . $fileExtension;
                 $targetPath = $uploadsDir . $newFileName;

                 if (move_uploaded_file($tmpName, $targetPath)) {
                     $result = $conn->query("INSERT INTO Foto (url, Annuncio_id) VALUES ('$targetPath', $maxid)");

                     echo "Annuncio aggiunto con successo!";
                 } else {
                     echo "Error: file upload fail";
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

        
        header("Location: ./aggiungiAnnuncio.php");
     }
?>