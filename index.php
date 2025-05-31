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
    <form action="./actions/encurtar.php" method="POST">
        <label for="link">Link para ser encurtado:</label>
        <input class="form-control" name="link" id="link" type="url" placeholder="seulink.com" required>
        <button type="submit" class="btn btn-primary">Encurtar</button>
    </form>
    <?php
      $por_pagina = 10;
      $pagina = $_GET['pagina'] ?? 1;
      $inicio = ($pagina - 1) * $por_pagina;

      $sql = "SELECT * FROM links ORDER BY id DESC LIMIT $inicio, $por_pagina"; 
      $rows = $con->query($sql);
      if($rows->num_rows > 0){
        while($row = $rows->fetch_assoc()){
          echo '
            <tr class="text-center">
              <th scope="row">'.$row['id'].'</th>
              <td>'.$row['link_longo'].'</td>
              <td><a href="./'.$row['link_curto'].'?id='.$row['link_curto'].'">Link Encurtado</a></td>
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