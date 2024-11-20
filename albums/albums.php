<?php

session_start();
include_once('../config.php');

if (!isset($_SESSION['email']) && !isset($_SESSION['senha'])) {
    header('Location: ../login/index.php');
    exit();
}

$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
$result = $conexao->query($sql);
$user_data = mysqli_fetch_assoc($result);
$nome = $user_data['nome'];

// Código para buscar os álbuns
$albums = '';
$sql = "SELECT spotifyid FROM albuns_salvos WHERE email = '$_SESSION[email]'";
$result = $conexao->query($sql);

while ($row = mysqli_fetch_assoc($result)) {
    $albums = $row['spotifyid'];
}

?>



<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="albums.css">
    <link rel="stylesheet" href="../styles.css">
    <title>Meus álbuns</title>
</head>

<body class="bg-body-tertiary">

    <!--NAVBAR-->
    <?php include('../navbar.html'); ?>

    <main>

        <div class="container py-5 px-4">

            <div class="d-flex flex-direction-row">
                <h2 class="d-flex fw-bold fs-1">Minha Biblioteca</h2>
            </div>

            <!-- RESULTADOS DA BUSCA -->
            <div class="search-results" id="searchResults">
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="albums.js"></script>

</body>

</html>