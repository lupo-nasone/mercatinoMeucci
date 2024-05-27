<?php
require_once "../lib/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $_POST['Titolo'];
    $descrizione = $_POST['descrizione'];
    $tipologia = $_POST['tipologia'];

    $utente_id = 1; //non dovrebbe essere $_SESSION["login"] ?

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) VALUES (?, ?, (SELECT id FROM Categoria WHERE nome = ?), ?)");
        $stmt->bind_param("sssi", $titolo, $descrizione, $tipologia, $utente_id);
        $stmt->execute();
        $annuncio_id = $stmt->insert_id;

        if (!empty($_FILES['file']['name'][0])) {
            $uploadsDir = __DIR__ . '/uploads/';
            foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
                $fileName = $_FILES['file']['name'][$key];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = uniqid() . '.' . $fileExtension;
                $targetPath = $uploadsDir . $newFileName;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $stmt = $conn->prepare("INSERT INTO Foto (url, Annuncio_id) VALUES (?, ?)");
                    $stmt->bind_param("si", $targetPath, $annuncio_id);
                    $stmt->execute();
                }
            }
        }

        $conn->commit();
        echo "Annuncio aggiunto con successo!";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Errore: " . $e->getMessage();
    }

    $conn->close();
}
?>
