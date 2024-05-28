<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
}
?>
<!--



        TODO:
        - bottone su ogni annuncio per fare una proposta
        - bottone account per gestire account (cambia foto profilo, logout) (richiederà pagina account [se abbiamo intenzione di fare una cosa de genere {se abbiamo tempo}]);
        - carousel delle immagini di annuncio




-->
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mercatino dell'Assunzione</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
  <link rel="stylesheet" href="./css/main.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="./images/pngwing.com.png" width="75" height="50">Mercatino dell'Assunzione</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <?php
          require("./lib/connection.php");
          $sql = "SELECT * FROM Categoria";
          $query = $conn->query($sql);
          while ($row = $query->fetch_assoc()) {
            echo "<li class='nav-item'><a class='nav-link' data-categoria='" . htmlspecialchars($row['id']) . "' href='#'>" . htmlspecialchars($row['nome']) . "</a></li>";
          }
          ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            <a style="color:black; text-decoration:none" href="./addannuncio/aggiungiAnnuncio.php">+ Crea Annuncio</a>
          </button>
        </form>
        <div class="form-inline my-2 my-lg-0 ms-3">
          <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">
            <a style="color:black; text-decoration:none" href="./login/logout.php">Logout</a>
          </button>
          <br>

      </div>
    </div>
  </nav>

  <div class="container mt-5" id="annunci-container">
    <?php include 'render_annunci.php'; ?>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const links = document.querySelectorAll('.nav-link');
      const annunciContainer = document.getElementById('annunci-container');

      links.forEach(link => {
        link.addEventListener('click', function(event) {
          event.preventDefault();
          const categoria = this.getAttribute('data-categoria');
          const url = 'render_annunci.php?categoria=' + categoria;

          fetch(url)
            .then(response => response.text())
            .then(html => {
              annunciContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching annunci:', error));
        });
      });
    });
  </script>

</body>

</html>