<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])){

    include_once('../config.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    // VERIFICAR SE O EMAIL E A SENHA EXISTEM NO BANCO DE DADOS
    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$password'";

    $result = $conexao->query($sql);

    if(mysqli_num_rows($result) < 1){
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }

    else{
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $password;
        header('Location: ../home/home.php');
    }
    }

else{
    header('Location: login.php');
}
?>