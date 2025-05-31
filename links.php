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
          <a class="nav-link" aria-current="page" href="./">Inicio</a>
          <a class="nav-link active" href="./">Links</a>
        </div>
      </div>
    </div>
  </nav>

  
  <main class="justify-content-center row row-cols-4 p-2 gap-3">
    <?php
      $sql = "SELECT * FROM links ORDER BY id"; 
      $rows = $con->query($sql);
      if($rows->num_rows > 0){
        while($row = $rows->fetch_assoc()){
            $dominio = explode("/", $row['link_longo']); 
          echo '
            <div class="card text-center p-2">
                <div class="card-header">
                    Link
                </div>
                <div class="card-body">
                    <h5 class="card-title">'.$dominio[2].'</h5>
                    <a href="?id='.$row['link_curto'].'" class="btn btn-primary">Link Encurtado</a>
                </div>
                <a class="btn btn-danger" href="actions/deletar.php?id='.$row['id'].'">
                  <i class="bi bi-trash"></i>
                  Deletar
                </a>
            </div>';
        }
      }
      if(isset($_GET['id'])){
        $curto = $_GET['id'];
        $sql = "SELECT link_longo FROM links WHERE link_curto = $curto;";
        $longo = $con->query($sql)->fetch_array()[0];
        header("Location: ".$longo."");
      }
    ?>
  </main>


</body>
</html>