<?php
    include_once("../config/database/database.php");

    $id = $_GET['id'];
    $sql = "DELETE FROM links WHERE id = $id";
    $con->query($sql);

    header("Location: ../links.php");
    exit();