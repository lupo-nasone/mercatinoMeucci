<?php
  session_start();
  unset($_SESSION["regMSG"]);
  unset($_SESSION["regMSG_good"]);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<body>

    <div class="card position-relative position-absolute top-50 start-50 translate-middle p-3" style="width: 18rem;">
        <img src="./images/d1aac4779d3045627552347aa70c34b2.jpg" class="card-img-top" style="border-radius: 1rem;">
        <p class="fs-1 text-center">LOGIN</p>
        <p class="fw-semibold text-center">Benvenuto Onii-chan NYAH</p>
        <div class="card-body">
          <p class="<?php echo isset($_SESSION["loginMSG_good"]) ? ($_SESSION["loginMSG_good"] ? "alert alert-success" : "alert alert-danger") : "" ?>">
            <?php echo isset($_SESSION["loginMSG"]) ? $_SESSION["loginMSG"] : "" ?>
          </p>
          <form method="post" action="login.php">
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" name="email" class="form-control" placeholder="email" required/>
              </div>

              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="password" class="form-control" placeholder="password" required/>
              </div>
              <div class="text-center pt-1">
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block text-white bg-danger" type="submit" value="Accedi">Accedi</button>
                <br>
                <a href="registerPage.php">oppure registrati</a>
            </div>

            <!--
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Accedi">
            
            -->
          </form>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
