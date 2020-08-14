<?php
require('../config.php');

// armazena os métodos em uma variável $method

$method =  strtolower($_SERVER['REQUEST_METHOD']);

// verifica se o método é get

if($method === 'get' || $method === 'GET') {

    // busca no banco de dados as informações

    $sql = $pdo->query("SELECT * FROM notes");

    if($sql->rowCount() > 0) {

        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item) {

            $array['result'][] = [

                'id'=> $item['id'],
                'title' => $item['title'],
                'body' => $item['body']
            ];
        }
    }
}

require('../return.php');