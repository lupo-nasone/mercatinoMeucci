<?php 
require "../lib/connection.php";
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="icon" type="image/x-icon" href="./images/favicon.ico">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-opacity-75">
    <div class="container-fluid opacity-100">
        <a class="navbar-brand" href="../index.php"><img src="../images/pngwing.com.png" width="75" height="50">Mercatino dell'Assunzione</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <a class="text-dark text-decoration-none" href="../addannuncio/aggiungiAnnuncio.php">+ Crea Annuncio</a>
                </button>
            </form>
            <div class="form-inline my-2 my-lg-0 ms-3">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">
                    <a class="text-dark text-decoration-none" href="../profile/profile.php">Profilo</a>
                </button>
            <br>
        </div>
    </div>
</nav>

<p class="fs-2 mt-4 text-center">Dati Utente</p>
<hr>
<div class="d-flex flex-column text-center">
    <?php 
        $sql = "SELECT * FROM Utente WHERE Utente.id = " . $_SESSION["login"];
        $result = $conn->query($sql);
        if(!$result){
            echo "utente non valido";
        }else{
            $data = $result->fetch_assoc();
            echo "<p><strong>E-Mail</strong>: " . $data["email"]."</p>";
            echo "<p><strong>Nome</strong>: " . $data["nome"]."</p>";
            echo "<p><strong>Cognome</strong>: " . $data["cognome"]."</p>";
            echo "<p><strong>Classe</strong>: " . $data["classe"]."</p>";
            echo "<p><strong>Età</strong>: " . $data["eta"]."</p>";

        }
    ?>
    <div class="d-flex justify-content-center">
        <a href="../login/logout.php">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">
                <span >Log Out</span>
            </button>
        </a>
    </div>
</div>
<hr>
    <div class="form-check form-switch text-center d-flex justify-content-center">
        <p class="pe-5">Annunci</p>
        <input class="form-check-input me-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
        <p class="pe-4">Proposte</p>
    </div>
    <!-- e poi qui si dovrà mettere gli annunci e le proposte e farli apparire rispetto a come selezionato-->    
    <div id="annunci" class="row row-cols-1">
        <?php 
        $sql = "SELECT Annuncio.id, Annuncio.titolo, Annuncio.descrizione, Categoria.nome as categoria, Utente.nome as utente_nome, Utente.cognome as utente_cognome, Utente_id
        FROM Annuncio
        JOIN Categoria ON Annuncio.Categoria_id = Categoria.id
        JOIN Utente ON Annuncio.Utente_id = Utente.id WHERE Utente.id = " . $_SESSION["login"];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
        
                echo "<div class='col d-flex justify-content-center'><div class='col-md-4 mb-4'>
                    <div class='card'>";
                
        
                $sql_images = "SELECT url FROM Foto WHERE Annuncio_id = " . $row["id"];
                $result_images = $conn->query($sql_images);
                $num_images = $result_images->num_rows;
        
                if ($num_images > 1) {
        
                    echo "<div id='carousel" . $row["id"] . "' class='carousel slide'>
                            <div class='carousel-inner'>";
        
                    $first = true;
                    while ($row_image = $result_images->fetch_assoc()) {
                        echo "<div class='carousel-item " . ($first ? 'active' : '') . "'>
                                <img src='../addannuncio/" . $row_image['url'] . "' class='d-block w-100' alt='...'>
                            </div>";
                        $first = false;
                    }
        
                    echo "  </div>
                            <button class='carousel-control-prev' type='button' data-bs-target='#carousel" . $row["id"] . "' data-bs-slide='prev'>
                                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Previous</span>
                            </button>
                            <button class='carousel-control-next' type='button' data-bs-target='#carousel" . $row["id"] . "' data-bs-slide='next'>
                                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Next</span>
                            </button>
                        </div>";
                } else {
        
                    $row_image = $result_images->fetch_assoc();
                    $image_url = $row_image ? '../addannuncio/' . $row_image['url'] : '../addannuncio/uploads/placeholder.png';
                    echo "<img src='$image_url' class='d-block w-100' alt='...'>";
                }
        
                echo "  <div class='card-body'>
                            <h5 class='card-title'>" . $row['titolo'] . "</h5>
                            <h6 class='card-subtitle mb-2 text-muted'>Categoria: " . $row['categoria'] . "</h6>
                            <p class='card-text'>" . $row['descrizione'] . "</p>
                            <p class='card-text'><small class='text-muted'>Postato da: " . $row['utente_nome'] . " " . $row['utente_cognome'] . "</small></p>
                            <div class='d-flex justify-content-center gap-5'>
                                <a href='../addproposta/aggiungiProposta.php?id=" . $row["id"] . "'><button class='btn btn-outline-success'>Visualizza proposte</button></a>
                                <button class='btn btn-outline-danger'>Elimina annuncio</button>
                            </div>
                        </div>
                    </div>
                </div></div>";

        }} else {
            echo "<p>Nessun annuncio trovato.</p>";
        }
        ?>
    </div>    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>