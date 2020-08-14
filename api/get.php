<?php

require('../config.php');

// armazena o método na variável

$method = strtolower($_SERVER['REQUEST_METHOD']);

// verifica se é método get

if($method === 'get' || $method === 'GET') {

    // filtra o id enviado via GET

    $id = filter_input(INPUT_GET, "id");

    // se existir, faz a busca pelo id enviado via GET

    if($id) {

        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        // se for encontrado, armazena o fetch(PDO::FETCH_ASSOC) em $data

        if($sql->rowCount() > 0) {

            $data = $sql->fetch(PDO::FETCH_ASSOC);

            // armazena o resultado da busca no array

            $array['result'] = [
                
                'id'=> $data['id'],
                'title'=> $data['title'],
                'body'=> $data['body']
            ]; 
        } else {

            $array['error'] = 'Não foi enviado o ID';

        }

        }  else {

            $array['error'] = 'O ID não existe';
        }   

    } else {

        $array['error'] = ' Não é permitido outro método além de GET';

    }

require('../return.php');