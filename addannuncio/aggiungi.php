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

    $annuncio_id = null;
    $uploadSuccess = true;

    // Inizia una transazione
    $conn->begin_transaction();

    // Inserisci l'annuncio una sola volta
    $result = $conn->query("INSERT INTO Annuncio (titolo, descrizione, Categoria_id, Utente_id) VALUES ('$titolo', '$descrizione', $tipologia, $utente_id)");

    if ($result) {
        $annuncio_id = $conn->insert_id;

        $total = count($_FILES['foto']['name']);

        for ($i = 0; $i < $total; $i++) {
            $tmpFilePath = $_FILES['foto']['tmp_name'][$i];

            if ($tmpFilePath != "") {
                $ext = pathinfo($_FILES['foto']['name'][$i], PATHINFO_EXTENSION);
                // Verifica il tipo di file immagine
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($ext, $allowedTypes)) {
                    $_SESSION["MSG"] = "Errore: Formato file non supportato.";
                    $_SESSION["MSG_good"] = false;
                    $uploadSuccess = false;
                    break;
                }

                $newFileName = uniqid() . '.' . $ext;
                $newFilePath = "./uploads/" . $newFileName;

                if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $_SESSION["MSG"] = "Errore: Impossibile caricare il file.";
                    $_SESSION["MSG_good"] = false;
                    $uploadSuccess = false;
                    break;
                } else {
                    $result = $conn->query("INSERT INTO Foto (url, Annuncio_id) VALUES ('$newFilePath', $annuncio_id)");
                    if (!$result) {
                        $_SESSION["MSG"] = "Errore: " . $conn->error;
                        $_SESSION["MSG_good"] = false;
                        $uploadSuccess = false;
                        break;
                    }
                }
            }
        }
    } else {
        $_SESSION["MSG"] = "Errore: " . $conn->error;
        $_SESSION["MSG_good"] = false;
        $uploadSuccess = false;
    }

    if ($uploadSuccess) {
        // Se tutto è andato bene, conferma la transazione
        $conn->commit();
        $_SESSION["MSG"] = "Annuncio postato con successo.";
        $_SESSION["MSG_good"] = true;
    } else {
        // Altrimenti, annulla la transazione
        $conn->rollback();
    }

    echo '<script>window.location="./aggiungiAnnuncio.php"</script>';
}
?>
