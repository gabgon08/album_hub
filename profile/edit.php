<?php
session_start();
include_once('../config.php');

$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
$result = $conexao->query($sql);

while ($user_data = mysqli_fetch_assoc($result)) {
    $senha = $user_data['senha'];
}

if(isset($_POST['update'])){

    $nome = $_POST['name'];
    $sobrenome = $_POST['surname'];
    $email = $_POST['email'];

    $senhaNova = $_POST['newPassword']; //avril confirmar avril
    $senhaAtualDigitada1 = $_POST['currentPasswordInput1']; //viola
    $senhaAtualDigitada2 = $_POST['currentPasswordInput2']; //viola
    $senhaBD = $senha; //viola

    if($senhaBD === $senhaAtualDigitada1){
        $sqlUpdate = "UPDATE usuarios SET nome='$nome', sobrenome='$sobrenome', senha='$senhaNova' WHERE email = '$email'";
        $result = $conexao->query($sqlUpdate);
        header('Location: profile.php');

    } elseif ($senhaBD === $senhaAtualDigitada2){
        $sqlUpdate = "UPDATE usuarios SET nome='$nome', sobrenome='$sobrenome' WHERE email = '$email'";
        $result = $conexao->query($sqlUpdate);
        header('Location: ../home/home.php');
    }
    
} elseif (isset($_POST['delete'])) {
    
    $email = $_POST['email'];

    $sqlDeleteProfile = "DELETE FROM usuarios WHERE email='$email'";
    $result = $conexao->query($sqlDeleteProfile);

    $sqlDeleteSavedAlbums = "DELETE FROM albuns_salvos WHERE email='$email'";
    $result = $conexao->query($sqlDeleteSavedAlbums);

    header('Location: ../login/login.php');
}

?>