<?php
require_once("../config/database/database.php");

$link = $_POST['link'];
$curto = "";

for($x = 0; $x <=7; $x++){
    $curto = $curto . strval(rand(0, 9));
}

$sql = "INSERT INTO links (link_longo, link_curto) values ('$link', '$curto')";
$con->query($sql);

header("Location: ../index.php");