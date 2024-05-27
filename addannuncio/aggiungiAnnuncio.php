<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
        function addFileInput() {
            const fileInputContainer = document.getElementById('fileInputContainer');
            const newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = 'file[]';
            newFileInput.onchange = addFileInput;
            fileInputContainer.appendChild(newFileInput);
        }
        window.onload = function () {
            addFileInput(); // Add the initial file input
        }
    </script>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="card position-relative position-absolute top-50 start-50 translate-middle p-3 bg-white bg-opacity-50" style="width: 18rem;">
        <img src="./images/y8i8nhc6rg571.png" class="card-img-top" style="border-radius: 10rem;">
        <br>
        <p class="fw-semibold text-center">(Langone non fa niente)</p>
        <div class="card-body">
            <form method="post" action="aggiungi.php" enctype="multipart/form-data">

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="Titolo" name="Titolo" class="form-control" placeholder="Titolo" required />
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="descrizione" name="descrizione" class="form-control"
                        placeholder="Descrizione" required />
                </div>

                <select id="tipologia" name="tipologia">
                    <?php
                    require_once "../lib/connection.php";

                    // Query per ottenere le tipologie
                    $sql = "SELECT nome FROM Categoria";
                    $result = $conn->query($sql);

                    // Popola il menu a tendina
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["nome"] . " ' class='form-select' aria-label='Default select example'>" . $row["nome"] . "</option>";
                        }
                    } else {
                        echo "<option value='' class='form-select' aria-label='Default select example'>Nessuna tipologia disponibile</option>";
                    }
                    // Chiude la connessione
                    $conn->close();
                    ?>
                </select><br><br>

                <div class="text-center pt-1">
                    <div id="fileInputContainer"></div>
                    <br>
                    <button data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-dark btn-lg btn-block text-black bg-white" type="submit"
                        value="aggiungi">Aggiungi</button>
                    <br>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>