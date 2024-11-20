<?php

if (isset($_POST["submit"])) {

    include_once('../config.php');

    $nome = $_POST['name'];
    $sobrenome = $_POST['surname'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $dataNascimento = $_POST['birthDate'];
    $genero = $_POST['gender'];

    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, sobrenome, email, senha, data_nascimento, genero) VALUES ('$nome', '$sobrenome', '$email', '$senha', '$dataNascimento', '$genero')");
    
    header('Location: ../login/login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">

    <title>Registro</title>
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

                <h1 class="text-dark p-2 fw-bold">AlbumHub</h1>

            </div>
            <div class="container order-2 col-md-5 mb-0 p-0">
                <form class="needs-validation" action="register.php" method="POST" novalidate>
                    <div class="container vh-100 p-0 m-0 row justify-content-center">

                        <div class="container row px-5">

                            <div class="align-content-end m-0">
                                <div class="form-field">
                                    <div class="text-center">
                                        <p class="mb-2 py-0 fw-bold fs-2">Cadastro</p>
                                    </div>

                                    <!--EMAIL-->
                                    <label for="email" class="mb-1 pt-0">Endereço de email:</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                    <div class="invalid-feedback">Campo obrigatório. Insira um e-mail válido no formato:
                                        usuario@dominio.com</div>
                                </div>
                            </div>

                            <div class="col-6 d-flex flex-column">

                                <!--NOME-->
                                <div class="form-field">
                                    <label for="name" class="mb-1 pt-0">Nome:</label>
                                    <input type="text" class="form-control" name="name" id="name" minLength="2"
                                        required>
                                    <div class="invalid-feedback">Campo obrigatório. O sobrenome deve ter no mínimo 2
                                        caracteres</div>
                                </div>

                                <!--DATA DE NASCIMENTO-->
                                <div class="form-field">

                                    <label for="birthDate" class="mb-1 pt-0">Data de nascimento:</label>
                                    <input type="date" class="form-control" name="birthDate" id="birthDate" required>
                                    <div class="invalid-feedback">Campo obrigatório</div>
                                </div>

                                <!--SENHA-->
                                <div class="form-field">

                                    <label for="password" class="mb-1 pt-0">Senha:</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        minLenght="4" required>
                                    <div class="invalid-feedback">Campo obrigatório. A senha deve ter no mínimo 4
                                        caracteres
                                    </div>
                                </div>

                                <!--BOTÃO CADASTRAR-->
                                <div class="d-flex mt-4 justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-warning">Cadastrar</button>
                                </div>

                            </div>
                            <div class="col-6 d-flex flex-column">

                                <!--SOBRENOME-->
                                <div class="form-field">

                                    <label for="surname" class="mb-1 pt-0">Sobrenome:</label>
                                    <input type="text" class="form-control" name="surname" id="surname" minLength="2"
                                        required>
                                    <div class="invalid-feedback">Campo obrigatório. O sobrenome deve ter no mínimo 2
                                        caracteres
                                    </div>
                                </div>

                                <!--GÊNERO-->
                                <div class="form-field">

                                    <label for="gender" class="mb-1 pt-0">Gênero:</label>
                                    <select class="form-select" name="gender" id="gender" required>
                                        <option value="" disabled selected>Selecione uma opção</option>
                                        <option value="Homem">Homem</option>
                                        <option value="Mulher">Mulher</option>
                                        <option value="Não binário">Não binário</option>
                                        <option value="Outro">Outro</option>
                                        <option value="Prefiro não informar">Prefiro não informar</option>
                                    </select>
                                    <div class="invalid-feedback">Selecione uma opção</div>
                                </div>

                                <!--CONFIRMAÇÃO DE SENHA-->
                                <div class="form-field">

                                    <label for="passwordConfirm" class="mb-1 pt-0">Confirmar senha:</label>
                                    <input type="password" class="form-control" name="passwordConfirm"
                                        id="passwordConfirm" minLenght="4" required>
                                    <div class="invalid-feedback">Campo não preenchido ou senhas diferentes</div>
                                </div>

                                <!--BOTÃO CANCELAR-->
                                <div class="d-flex mt-4 justify-content-start">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="window.location.href='../index.php'">Cancelar</button>
                                </div>


                            </div>

                        </div>
                        <!--BOTÕES-->

                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script src="register.js"></script>
    <script src="../script.js"></script>
</body>

</html>