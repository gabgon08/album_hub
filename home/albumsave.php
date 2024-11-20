<?php

session_start();

if (isset($_POST["submit"])) {

    include_once('../config.php');

    // COLETA OS DADOS ENVIADOS VIA POST
    $albumId = $_POST['album-id'];
    $artistName = $_POST['artist-name'];
    $albumName = $_POST['album-name'];
    $user = $_SESSION['email'];

    // VERIFICA SE O ÁLBUM JÁ FOI SALVO NO BD
    $checkQuery = "SELECT * FROM albuns_salvos WHERE spotifyid = '$albumId' AND artista = '$artistName' AND album = '$albumName' AND email = '$user'";
    $checkResult = $conexao->query($checkQuery);

    if ($checkResult->num_rows === 0) {
        $insertQuery = "INSERT INTO albuns_salvos (spotifyid, artista, album, email) VALUES ('$albumId', '$artistName', '$albumName', '$user')";
        $conexao->query($insertQuery);
    }

    $conexao->close();
}
?>
