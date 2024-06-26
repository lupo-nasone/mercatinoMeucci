<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: ../index.php");
    }
?>
<!-- 

    TODO:
    - fixare che quando generi più file upload poi non puoi submittare finchè non gli hai riempiti tutti.
        mettere che basta riempirne 1.

-->
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
        function addFileInput() {
            const newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = 'foto[]';
            newFileInput.required = true;

            const fileInputContainer = document.getElementById('fileInputContainer');
            fileInputContainer.appendChild(newFileInput);
        }
        window.onload = () => {
            addFileInput();
        }

    </script>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="card position-relative position-absolute top-50 start-50 translate-middle p-3 bg-white bg-opacity-50" style="width: 18rem;">
    <a href="../index.php"><button type="button" class="btn btn-light btn-block"><- torna indietro</button></a>
        <!-- Tolto perchè quando compare l'alert per il success o fail poi diventa troppo grande per la pagina e non puoi tornare indietro-->
        <!-- <img src="./images/y8i8nhc6rg571.png" class="card-img-top" style="border-radius: 10rem;">
        <hr> -->
        <p class="fw-semibold text-center fs-3 mt-4">Aggiungi annuncio</p>
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

                    
                    $sql = "SELECT nome, id FROM Categoria";
                    $result = $conn->query($sql);

                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . " ' class='form-select' aria-label='Default select example'>" . $row["nome"] . "</option>";
                        }
                    } else {
                        echo "<option value='' class='form-select' aria-label='Default select example'>Nessuna tipologia disponibile</option>";
                    }
                    
                    $conn->close();
                    ?>
                </select><br><br>

                <div class="text-center pt-1">
                    <div id="fileInputContainer"></div><!--upload file-->
                    <p onclick="addFileInput()" class="btn btn-dark text-black bg-white mt-2">+</p>
                    
                    <p class="<?php echo isset($_SESSION["MSG_good"]) ? ($_SESSION["MSG_good"] ? "alert alert-success" : "alert alert-danger") : "" ?>"><?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : "" ?></p>
                    <button data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-light btn-block" type="submit"
                        value="aggiungi">Aggiungi</button>
                    <br>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>