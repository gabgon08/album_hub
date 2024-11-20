<?php

session_start();
include('../config.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['albumId']) && isset($data['action'])) {
    $albumId = $data['albumId'];
    $action = $data['action'];

    $email = $_SESSION['email'];

    if ($action == 'remove') {
        $sql = "DELETE FROM albuns_salvos WHERE spotifyid = '$albumId' AND email = '$email'";
        $result = $conexao->query($sql);

        if ($result) {
            echo json_encode(['success' => 'Álbum removido']);
        } else {
            echo json_encode(['error' => 'Erro ao remover álbum']);
        }
    } else {
        echo json_encode(['error' => 'Ação inválida']);
    }
} else {
    echo json_encode(['error' => 'Dados incompletos']);
}
?>
