<?php
require "./lib/connection.php";

$categoria_filtrata = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;

if ($categoria_filtrata > 0) {
    $sql = "SELECT Annuncio.id, Annuncio.titolo, Annuncio.descrizione, Categoria.nome as categoria, Utente.nome as utente_nome, Utente.cognome as utente_cognome
            FROM Annuncio
            JOIN Categoria ON Annuncio.Categoria_id = Categoria.id
            JOIN Utente ON Annuncio.Utente_id = Utente.id
            WHERE Categoria.id = $categoria_filtrata
            AND Utente.id NOT IN (
            	SELECT Utente.id FROM Utente
                	JOIN Proposta ON Utente.id = Proposta.Utente_id
                	WHERE Proposta.accepted = 1
            )";
} else {
    $sql = "SELECT Annuncio.id, Annuncio.titolo, Annuncio.descrizione, Categoria.nome as categoria, Utente.nome as utente_nome, Utente.cognome as utente_cognome, Utente.id as utente_id
            FROM Annuncio
            JOIN Categoria ON Annuncio.Categoria_id = Categoria.id
            JOIN Utente ON Annuncio.Utente_id = Utente.id
            WHERE Annuncio.id NOT IN (
            	SELECT Annuncio.id FROM Annuncio
                	JOIN Proposta ON Annuncio.id = Proposta.Annuncio_id
                	WHERE Proposta.accepted = 1
            )";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = 0;
    while ($row = $result->fetch_assoc()) {
        if ($counter % 3 == 0) {
            echo "<div class='row'>";
        }

        $annuncio_id = $row['id'];
        echo "<div class='col-md-4 mb-4'>
            <div class='card'>";
        

        $sql_images = "SELECT url FROM Foto WHERE Annuncio_id = $annuncio_id";
        $result_images = $conn->query($sql_images);
        $num_images = $result_images->num_rows;

        if ($num_images > 1) {

            echo "<div id='carousel$annuncio_id' class='carousel slide'>
                    <div class='carousel-inner'>";

            $first = true;
            while ($row_image = $result_images->fetch_assoc()) {
                echo "<div class='carousel-item " . ($first ? 'active' : '') . "'>
                        <img src='./addannuncio/uploads/" . htmlspecialchars(basename($row_image['url'])) . "' class='d-block w-100' alt='...'>
                    </div>";
                $first = false;
            }

            echo "  </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#carousel$annuncio_id' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Previous</span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#carousel$annuncio_id' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Next</span>
                    </button>
                </div>";
        } else {

            $row_image = $result_images->fetch_assoc();
            $image_url = $row_image ? './addannuncio/uploads/' . htmlspecialchars(basename($row_image['url'])) : './addannuncio/uploads/placeholder.png';
            echo "<img src='$image_url' class='d-block w-100' alt='...'>";
        }

        echo "  <div class='card-body'>
                    <h5 class='card-title'>" . htmlspecialchars($row['titolo']) . "</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>Categoria: " . htmlspecialchars($row['categoria']) . "</h6>
                    <p class='card-text'>" . htmlspecialchars($row['descrizione']) . "</p>
                    <p class='card-text'>
                        <small class='text-muted'>
                            Postato da: 
                                <a href='./profile/profile.php?id=" . $row["utente_id"] . "'>" . htmlspecialchars($row['utente_nome']) . " " . htmlspecialchars($row['utente_cognome']) . "</a>
                        </small>
                    </p>
                </div>
                <div class='d-flex justify-content-center pb-2'>
                    <a href='./addproposta/aggiungiProposta.php?id=" . $row["id"] . "'>
                        <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>
                            <span>fai una proposta</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>";

        $counter++;

        if ($counter % 3 == 0) {
            echo "</div>";
        }
    }

    if ($counter % 3 != 0) {
        echo "</div>";
    }
} else {
    echo "<p>Nessun annuncio trovato.</p>";
}

$conn->close();
?>
