# Projeto: DEVSNOTES

# DESCRIÇÃO

DevsNotes é uma api, com a função de um caderno de anotações digital.

# Tecnologias utilizadas

1. PHP
2. MYSQL

# Executando o projeto

### Configure a conexão com o banco de dados notes.sql

``` 
<?php

$pdo = new PDO("mysql:dbname=devnotes;host=localhost", 'root', '');

$array = [

    'error' => '',
    'result' => []
];

```

### Dê as permissões de acesso para métodos e outros sites

``` 
<?php 

// aqui fica as permissões de acessos para apis e os métodos

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json"); // sempre retorna um json

echo json_encode($array);
exit;

``` 



