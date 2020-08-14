<?php

require('../config.php');

// pega o método correto

$method = strtolower($_SERVER['REQUEST_METHOD']);

// verifica se é o método PUT

if($method === 'put' || $method === 'PUT') {

    // ele puxa o input da raiz do sistema e passa para a variável PUT

    parse_str(file_get_contents('php://input'), $input);

    $id = filter_var($input['id'] ?? null);
    $title = filter_var($input['title'] ?? null);
    $body = filter_var($input['body'] ?? null);

    if($id && $title && $body) {

        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {

            $sql = $pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":title", $title);
            $sql->bindValue(":body", $body);
            $sql->execute();

            $array['result'] = [
                'id'=>$id,
                'title'=> $title,
                'body'=> $body
            ];

        } else {

            $array['error'] = 'Não foi encontrado nenhum ID';
        }

    } else {

        $array['error'] = 'Não foi enviado nenhum ID ou campos não estão preenchidos';
    }
    
} else {

    $array['error'] = 'Apenas PUT é o método permitido';

}

require('../return.php');