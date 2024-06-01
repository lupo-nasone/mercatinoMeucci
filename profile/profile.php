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
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">
            <a class="text-dark text-decoration-none" href="../login/logout.php">Log Out</a>
        </button>
    </div>
  </div>
  
  


</body>
</html>