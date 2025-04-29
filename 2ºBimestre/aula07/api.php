<?php
header("Content-Type: application/json");

$metodo_requisicao = $_SERVER['REQUEST_METHOD'];

$caminho_arquivo = 'dados_usuarios.json';

if (!file_exists($caminho_arquivo)) {
    file_put_contents($caminho_arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$dados_usuarios = json_decode(file_get_contents($caminho_arquivo), true);

switch ($metodo_requisicao) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id_usuario = intval($_GET['id']);
            $usuario_encontrado = null;

            foreach ($dados_usuarios as $usuario) {
                if ($usuario['id'] == $id_usuario) {
                    $usuario_encontrado = $usuario;
                    break;
                }
            }

            if ($usuario_encontrado) {
                echo json_encode($usuario_encontrado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(["erro" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode($dados_usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'POST':
        $novos_dados = json_decode(file_get_contents('php://input'), true);

        if (!isset($novos_dados["nome"]) || !isset($novos_dados["email"])) {
            http_response_code(400);
            echo json_encode(["erro" => "Nome e email são campos obrigatórios."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $novo_id_usuario = 1;
        if (!empty($dados_usuarios)) {
            $ids_usuarios = array_column($dados_usuarios, 'id');
            $novo_id_usuario = max($ids_usuarios) + 1;
        }

        $usuario_inserido = [
            "id" => $novo_id_usuario,
            "nome" => $novos_dados["nome"],
            "email" => $novos_dados["email"]
        ];

        $dados_usuarios[] = $usuario_inserido;

        file_put_contents($caminho_arquivo, json_encode($dados_usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo json_encode([
            "mensagem" => "Usuário adicionado com sucesso!",
            "usuario" => $usuario_inserido
        ], JSON_UNESCAPED_UNICODE);
        break;

    default:
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido."], JSON_UNESCAPED_UNICODE);
        break;
}
?>
