<?php

header("Content-Type: application/json; charset=UTF-8");


$tipo_requisicao = $_SERVER['REQUEST_METHOD'];


$arquivo_usuarios = 'usuarios.json';


if (!file_exists($arquivo_usuarios)) {
    file_put_contents($arquivo_usuarios, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}


$lista_usuarios = json_decode(file_get_contents($arquivo_usuarios), true);


switch ($tipo_requisicao) {
    case 'GET':

        if (isset($_GET['id'])) {
            $id_usuario = intval($_GET['id']); 
            $usuario_encontrado = null;

            // Busca o usuário com o ID correspondente
            foreach ($lista_usuarios as $usuario) {
                if ($usuario['id'] == $id_usuario) {
                    $usuario_encontrado = $usuario;
                    break; // Para o loop ao encontrar o usuário
                }
            }

            // Se o usuário foi encontrado, retorna ele em JSON
            if ($usuario_encontrado) {
                echo json_encode($usuario_encontrado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                // Se o usuário não foi encontrado, retorna erro 404
                http_response_code(404);
                echo json_encode(["erro" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
            }
        } else {
            // Se nenhum ID foi passado, retorna todos os usuários cadastrados
            echo json_encode($lista_usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'POST':
        // Lê o corpo da requisição (geralmente JSON) e converte para array
        $dados_usuario = json_decode(file_get_contents('php://input'), true);

        // Verifica se os campos obrigatórios "nome" e "email" foram enviados
        if (!isset($dados_usuario["nome"]) || !isset($dados_usuario["email"])) {
            http_response_code(400); // Código de erro para requisição inválida
            echo json_encode(["erro" => "Nome e email são obrigatórios."], JSON_UNESCAPED_UNICODE);
            exit; // Interrompe o script
        }

        // Define um novo ID automaticamente:
        // Se o array de usuários não estiver vazio, pega o maior ID existente e soma 1
        $novo_id_usuario = 1;
        if (!empty($lista_usuarios)) {
            $ids_usuarios = array_column($lista_usuarios, 'id'); // Pega todos os IDs existentes
            $novo_id_usuario = max($ids_usuarios) + 1; // Novo ID é o maior ID + 1
        }

        // Cria um novo usuário com os dados recebidos
        $usuario_adicionado = [
            "id" => $novo_id_usuario,
            "nome" => $dados_usuario["nome"],
            "email" => $dados_usuario["email"],
        ];

        // Adiciona o novo usuário à lista de usuários
        $lista_usuarios[] = $usuario_adicionado;

        // Salva a lista atualizada no arquivo JSON
        file_put_contents($arquivo_usuarios, json_encode($lista_usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Retorna uma mensagem de sucesso junto com os dados do novo usuário
        echo json_encode([
            "mensagem" => "Usuário adicionado com sucesso!",
            "usuario" => $usuario_adicionado
        ], JSON_UNESCAPED_UNICODE);
        break;

    default:
        // Se o método usado não for GET ou POST, retorna erro 405 (Método não permitido)
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido!"], JSON_UNESCAPED_UNICODE);
        break;
}
?>
