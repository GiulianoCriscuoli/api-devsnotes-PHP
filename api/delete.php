<?php

require('../config.php');

// passando o método para  avariável

$method = strtolower($_SERVER['REQUEST_METHOD']);

// verificando se o método é delete

if($method === 'DELETE' || $method === 'delete') {

    // passando as informações do input para a variável $input

    parse_str(file_get_contents("php://input"), $input);

    $id = filter_var($input['id']) ?? null;

    // verificando se existe o id retornado

    if($id) {

        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        // se existir, exclua o registro

        if($sql->rowCount() > 0) {

            $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $sql->bindValue("id", $id);
            $sql->execute();

            $array['result'] = [

                'id'=> $id
            ];

        } else {

            $array['error'] = 'Não encontrou nenhum ID';
        }

    } else {

        $array['error'] = 'Nenhum ID foi enviado';   
    
    }

} else {

    $array['error'] = 'Permite apenas o método DELETE';
}

require('../return.php');