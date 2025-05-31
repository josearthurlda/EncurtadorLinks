<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once("./config/database/database.php");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Encurtador</title>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">Encurtador</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
          <a class="nav-link" href="#">Links</a>
        </div>
      </div>
    </div>
  </nav>
  <main class="d-flex flex-column justify-content-center position-absolute top-50 start-50 translate-middle">
    <h1>Encurtador de Links</h1>
    <div class="card">
      <div class="card-header text-center">
        Encurtar link
      </div>
      <div class="card-body text-center">
        <form action="./actions/encurtar.php" method="POST">
            <label for="link">Link para ser encurtado:</label>
            <input class="form-control mt-2 mb-2" name="link" id="link" type="url" placeholder="seulink.com" required>
            <button type="submit" class="btn btn-primary">Encurtar</button>
        </form>
      </div>
    </div>

  </main>

    <?php
      $sql = "SELECT * FROM links ORDER BY id"; 
      $rows = $con->query($sql);
      if($rows->num_rows > 0){
        while($row = $rows->fetch_assoc()){
          echo '
            <tr class="text-center">
              <td>'.$row['link_longo'].'</td>
              <td><a href="?id='.$row['link_curto'].'">Link Encurtado</a></td>
              <td>
                <a class="btn btn-danger" href="actions/deletar.php?id='.$row['id'].'">
                  <i class="bi bi-trash"></i>
                  Deletar
                </a>

              </td>
            </tr>';
        }
      }
      if(isset($_GET['id'])){
        $curto = $_GET['id'];
        $sql = "SELECT link_longo FROM links WHERE link_curto = $curto;";
        $longo = $con->query($sql)->fetch_array()[0];
        header("Location: ".$longo."");
      }
    ?>
</body>
</html>