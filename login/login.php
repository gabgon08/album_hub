<?php
    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">

    <title>Login</title>
</head>

<body class="bg-body-tertiary"> 
    <main class="d-flex flex-column">
        <div class="vh-100 d-flex flex-nowrap">
            <div
                class="container bg-warning d-flex flex-column align-content-center justify-content-center text-center order-1 flex-wrap">
                <div class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="#212529" class="bi bi-disc"
                        viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0M8 4a4 4 0 0 0-4 4 .5.5 0 0 1-1 0 5 5 0 0 1 5-5 .5.5 0 0 1 0 1m4.5 3.5a.5.5 0 0 1 .5.5 5 5 0 0 1-5 5 .5.5 0 0 1 0-1 4 4 0 0 0 4-4 .5.5 0 0 1 .5-.5" />
                    </svg>
                </div>

                <h1 class="text-dark p-2 fw-bold">Album Hub</h1>

            </div>
            <div
                class="container d-flex align-content-center justify-content-center text-center order-2 col-md-5 p-0 flex-wrap">
                <form class="d-flex align-content-center justify-content-center flex-column flex-wrap needs-validation"
                    action="testlogin.php" method="POST" novalidate>

                    <!--TÍTULO-->
                    <p class="mb-0 mt-5 p-0 fw-bold fs-2">Login</p>

                    <!--USUÁRIO-->
                    <div class="form-input">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="" required>
                            <label for="email">E-mail</label>
                            <div class="invalid-feedback">Campo não preenchido ou email inválido</div>
                        </div>

                        <!--SENHA-->
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder=""
                                required>
                            <label for="password" class="form-label">Senha</label>
                            <div class="invalid-feedback">Campo não preenchido</div>
                        </div>
                    </div>

                    <!--BOTÕES-->
                    <div class="d-flex p-2 mb-5 align-content-center justify-content-center">
                        <button type="submit" class="btn btn-warning m-1" name="submit">Entrar</button>
                        <button type="button" class="btn btn-outline-warning m-1"
                            onclick="window.location.href='../register/register.php'">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="../script.js"></script>

</body>

</html>