<?php

session_start();
include('../config.php'); 

$email = $_SESSION['email'];

$query = "SELECT spotifyid FROM albuns_salvos WHERE email = '$email'"; 
$result = $conexao->query($query);

$ids = [];
while ($row = $result->fetch_assoc()) {
    $ids[] = $row['spotifyid'];
}

echo json_encode($ids);

$conexao->close();
?>
