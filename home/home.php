<?php

    session_start();
    include_once('../config.php');

    if(!isset($_SESSION['email']) && !isset($_SESSION['senha'])){

        header('Location: ../index.php');

}

$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
$result = $conexao->query($sql);


while ($user_data = mysqli_fetch_assoc($result)) {
    $nome = $user_data['nome'];
}
?>


<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../styles.css">
    <title>Home</title>
</head>

<body class="bg-body-tertiary">

    <!--NAVBAR-->
    <?php include('../navbar.html'); ?>

    <main>


        <div class="container py-5 px-5">

            <div class="d-flex flex-direction-row">
                <h2 class="d-flex fw-bold fs-1">Encontre seus álbuns favoritos:</h2>

                <form class="d-flex ms-auto" role="search" id="searchForm">
                    <input class="form-control me-2" type="search" id="searchInput" placeholder="Buscar"
                        aria-label="Search">
                    <button class="btn btn-outline-warning py-0 px-3" type="submit"><svg
                            xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></button>
                </form>
            </div>

            <!-- RESULTADOS DA BUSCA -->
            <div class="search-results" id="searchResults">
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="home.js"></script>

</body>

</html>