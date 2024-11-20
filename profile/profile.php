<?php
session_start();
include_once('../config.php');


$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
$result = $conexao->query($sql);

while ($user_data = mysqli_fetch_assoc($result)) {
    $nome = $user_data['nome'];
    $sobrenome = $user_data['sobrenome'];
    $email = $user_data['email'];
    $date = $user_data['data_nascimento'];
    $dateFormatted = DateTime::createFromFormat('Y-m-d', $date)->format('d-m-Y');
    $genero = $user_data['genero'];
    $senha = $user_data['senha'];
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

    <title>Meu perfil</title>
</head>

<body class="bg-body-tertiary">
    
    <?php include('../navbar.html'); ?>

    <main>
        <div class="container p-5">
            <div class="d-flex flex-direction-row">
                <h2 class="d-flex fw-bold fs-1">Editar perfil</h2>

                <div class="container col-md-8 ms-auto me-3">
                    <form class="container row align-items-center" action="edit.php" method="POST">
                        <div class="col">
                            <!--NOME-->
                            <div class="form-field">
                                <label for="name">Nome:</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="<?php echo $nome ?>">
                            </div>

                            <!--SOBRENOME-->
                            <div class="form-field">
                                <label for="surname">Sobrenome:</label>
                                <input type="text" class="form-control" name="surname" id="surname"
                                    value="<?php echo $sobrenome ?>">
                            </div>

                            <!--EMAIL-->
                            <div class="form-field">
                                <label for="email">Endereço de email:</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="<?php echo $email ?>" readonly>
                            </div>

                            <!--DATA DE NASCIMENTO-->
                            <div class="form-field">
                                <label for="birthDate">Data de nascimento:</label>
                                <input type="text" class="form-control" name="birthDate" id="birthDate"
                                    value="<?php echo $dateFormatted ?>" readonly>
                            </div>

                            <!--GÊNERO-->
                            <div class="form-field">
                                <label for="gender">Gênero</label>
                                <input type="text" class="form-control" name="gender" id="gender"
                                    value="<?php echo $genero ?>" readonly>
                            </div>
                            <!--MODAL SALVAR ALTERAÇÕES-->
                            <div class="container d-flex flex-direction-row px-0 py-4">
                                <button type="button" class="btn container col-md-5 ms-0 p-0 btn-warning"
                                    data-bs-toggle="modal" data-bs-target="#myModal2" id="myInput2">Salvar
                                    alterações</button>
                                <div class="modal fade" id="myModal2" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="alterarSenha">Confirme sua senha para
                                                    salvar
                                                </h1>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <label for="currentPasswordInput2">Senha
                                                    atual:</label>
                                                <input type="password" class="form-control" name="currentPasswordInput2"
                                                    id="currentPasswordInput2">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" name="update" id="update"
                                                    class="btn btn-warning me-auto">Salvar alterações</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn container col-md-5 me-0 btn-outline-secondary"
                                    onclick="window.location.href='../home/home.php'">Cancelar</button>
                            </div>

                        </div>


                        <div class="col d-flex flex-column">

                            <!--MODAL ALTERAR SENHA-->
                            <button type="button" class="btn container my-4 col-md-6 btn-warning" data-bs-toggle="modal"
                                data-bs-target="#myModal1" id="myInput1">Alterar senha</button>


                            <div class="modal fade" id="myModal1" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="alterarSenha">Alterar senha</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <label for="newPassword">Senha nova:</label>
                                            <input type="password" class="form-control" name="newPassword"
                                                id="newPassword">

                                            <label for="confirmNewPassword">Confirmar senha
                                                nova:</label>
                                            <input type="password" class="form-control" name="confirmNewPassword"
                                                id="confirmNewPassword">

                                            <label for="currentPasswordInput1">Senha atual:</label>
                                            <input type="password" class="form-control" name="currentPasswordInput1"
                                                id="currentPasswordInput1">

                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" name="update" id="update"
                                                class="btn btn-warning me-auto">Salvar</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="delete" id="delete"
                                class="btn container my-4 col-md-6 btn-danger">Deletar
                                conta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="profile.js"></script>


</body>

</html>