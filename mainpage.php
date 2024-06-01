<?php
require "./lib/connection.php";
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
}
unset($_SESSION["MSG"]);
unset($_SESSION["MSG_good"]);
?>
<!--



        TODO:
        - bottone account per gestire account (cambia foto profilo, logout) (richiederà pagina account [se abbiamo intenzione di fare una cosa de genere {se abbiamo tempo}]);


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

<nav class="navbar navbar-expand-lg bg-body-tertiary bg-opacity-75">
    <div class="container-fluid opacity-100">
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
        <div class="form-inline my-2 my-lg-0">
          <a href="./addannuncio/aggiungiAnnuncio.php">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
              <span class="text-dark text-decoration-none">+ Crea Annuncio</span>
            </button>
          </a>
        </div>
        <div class="form-inline my-2 my-lg-0 ms-3">
          <a href="./profile/profile.php">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">
              <span class="text-dark text-decoration-none" >Profilo</span>
            </button>
          </a>
          
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>