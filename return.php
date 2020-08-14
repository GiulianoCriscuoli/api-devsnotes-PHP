<?php 

// aqui fica  a permissão de acessos para apis e os métodos

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json"); // sempre retorna um json

echo json_encode($array);
exit;


