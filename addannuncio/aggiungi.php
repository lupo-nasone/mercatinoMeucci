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

    // decommenta questo blocco e commenta la riscrittura per tornare al codice di prima
    // $conn->begin_transaction();

    // try {
    //     $stmt = $conn->prepare("INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) VALUES (?, ?, (SELECT id FROM Categoria WHERE nome = ?), ?)");
    //     $stmt->bind_param("sssi", $titolo, $descrizione, $tipologia, $utente_id);
    //     $stmt->execute();
    //     $annuncio_id = $stmt->insert_id;

    //     if (!empty($_FILES['file']['name'][0])) {
    //         $uploadsDir = './uploads/';
    //         foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
    //             $fileName = $_FILES['file']['name'][$key];
    //             $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    //             $newFileName = uniqid() . '.' . $fileExtension;
    //             $targetPath = $uploadsDir . $newFileName;

    //             if (move_uploaded_file($tmpName, $targetPath)) {
    //                 $stmt = $conn->prepare("INSERT INTO Foto (url, Annuncio_id) VALUES (?, ?)");
    //                 $stmt->bind_param("si", $targetPath, $annuncio_id);
    //                 $stmt->execute();
    //                 $conn->commit();
    //                 echo "Annuncio aggiunto con successo!";
    //             } else {
    //                 echo "Error: file upload fail";
    //             }
    //         }
    //     }


    //riscritto il codice senza l'immagine per far funzionare per testing
    {
    $sql = "INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) 
            VALUES ('$titolo', '$descrizione', (SELECT id FROM Categoria WHERE nome = '$tipologia'), $utente_id)";
    $result = $conn->query($sql);
    }

    //fine riscrittura

    if(!$result){
        $_SESSION["MSG"] = "Errore: " . $conn->error;
        $_SESSION["MSG_good"] = false;
    }else{
        $_SESSION["MSG"] = "Annuncio pubblicato con successo";
        $_SESSION["MSG_good"] = true;
    }
    header("Location: ./aggiungiAnnuncio.php");

}else{
    header("Location: ../index.php");
}
?>
