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
        window.onload = function() {
            addFileInput(); // Add the initial file input
        }
    </script>
</head>
<body>
    <form method="post" action="aggiungi.php" enctype="multipart/form-data">
        <label for="Titolo">Titolo:</label><br>
        <input type="text" id="Titolo" name="Titolo"><br>
        
        <label for="descrizione">Descrizione:</label><br>
        <input type="text" id="descrizione" name="descrizione"><br><br>
        
        <label for="tipologia">Tipologia:</label><br>
        <select id="tipologia" name="tipologia">
            <?php
            require_once "../lib/connection.php";

            // Query per ottenere le tipologie
            $sql = "SELECT nome FROM Categoria";
            $result = $conn->query($sql);

            // Popola il menu a tendina
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                }
            } else {
                echo "<option value=''>Nessuna tipologia disponibile</option>";
            }

            // Chiude la connessione
            $conn->close();
            ?>
        </select><br><br>

        <div id="fileInputContainer"></div>

        <input type="submit" value="aggiungi">
    </form>
    <a href="register.html">registrati</a>
</body>
</html>
