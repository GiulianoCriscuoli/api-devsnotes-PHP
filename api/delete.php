<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);


if($method === 'DELETE' || $method === 'delete') {

    parse_str(file_get_contents("php://input"), $input);

    $id = filter_var($input['id']) ?? null;

    if($id) {

        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

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