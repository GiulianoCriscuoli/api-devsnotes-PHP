<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);


if($method === 'post' || $method === 'POST') {

    $title = filter_input(INPUT_POST, "title");
    $body = filter_input(INPUT_POST, "body");

    if($title && $body) {

        $sql = $pdo->prepare("INSERT INTO notes(title, body) VALUES(:title, :body)");
        $sql->bindValue(":title", $title);
        $sql->bindValue(":body", $body);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $array['result'] = [

            'id'=> $id,
            'title'=> $title,
            'body'=> $body
        ];
    } else {

        $array['error'] = 'Preencha tudo corretamente';
    }

} else {

    $array['error'] = 'O método tem que ser POST';
}

require('../return.php');

