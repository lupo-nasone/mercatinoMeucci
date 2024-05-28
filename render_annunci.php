<!--


        TODO:
        - don't display carousel arrows when there's only 1 image


-->

<?php
require "./lib/connection.php";

$categoria_filtrata = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;

if ($categoria_filtrata > 0) {
    $sql = "SELECT Annuncio.id, Annuncio.titolo, Annuncio.descrizione, Categoria.nome as categoria, Utente.nome as utente_nome, Utente.cognome as utente_cognome 
            FROM Annuncio
            JOIN Categoria ON Annuncio.Categoria_id = Categoria.id
            JOIN Utente ON Annuncio.Utente_id = Utente.id
            WHERE Categoria.id = $categoria_filtrata";
} else {
    $sql = "SELECT Annuncio.id, Annuncio.titolo, Annuncio.descrizione, Categoria.nome as categoria, Utente.nome as utente_nome, Utente.cognome as utente_cognome 
            FROM Annuncio
            JOIN Categoria ON Annuncio.Categoria_id = Categoria.id
            JOIN Utente ON Annuncio.Utente_id = Utente.id";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = 0;
    while ($row = $result->fetch_assoc()) {
        if ($counter % 3 == 0) {
            echo "<div class='row'>";
        }
        
        $annuncio_id = $row['id'];
        echo "
        <div class='col-md-4 mb-4'>
            <div class='card'>
                <div id='carouselExampleIndicators$annuncio_id' class='carousel slide' data-bs-ride='carousel'>
                    <div class='carousel-inner'>";
                    
                    $sql_images = "SELECT url FROM Foto WHERE Annuncio_id = $annuncio_id";
                    $result_images = $conn->query($sql_images);

                    if ($result_images->num_rows > 0) {
                        $active = 'active';
                        while ($row_image = $result_images->fetch_assoc()) {
                            echo "
                            <div class='carousel-item $active'>
                                <img src='./addannuncio/uploads/" . htmlspecialchars(basename($row_image['url'])) . "' class='d-block w-100' alt='...'>
                            </div>";
                            $active = '';
                        }
                    } else {
                        echo "
                        <div class='carousel-item active'>
                            <img src='placeholder.jpg' class='d-block w-100' alt='...'>
                        </div>";
                    }

        echo "      </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators$annuncio_id' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Previous</span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators$annuncio_id' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Next</span>
                    </button>
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>" . htmlspecialchars($row['titolo']) . "</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>Categoria: " . htmlspecialchars($row['categoria']) . "</h6>
                    <p class='card-text'>" . htmlspecialchars($row['descrizione']) . "</p>
                    <p class='card-text'><small class='text-muted'>Inserito da: " . htmlspecialchars($row['utente_nome']) . " " . htmlspecialchars($row['utente_cognome']) . "</small></p>
                </div>
            </div>
        </div>";

        $counter++;

        if ($counter % 3 == 0) {
            echo "</div>";
        }
    }

    // Chiude la riga se il numero di annunci non è multiplo di 3
    if ($counter % 3 != 0) {
        echo "</div>";
    }
} else {
    echo "<p>Nessun annuncio trovato.</p>";
}

$conn->close();
?>
