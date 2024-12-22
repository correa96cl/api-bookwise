<?php

require_once('../includes/Book.class.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'
&& isset($_GET['titulo']) && isset($_GET['author']) && isset($_GET['descricao']) && isset($_GET['ano_de_lancamento']) && isset($_GET['usuario_id']) && isset($_GET['imagem'])){
    Book::create_book($_GET['titulo'], $_GET['author'], $_GET['descricao'], $_GET['ano_de_lancamento'], $_GET['usuario_id'], $_GET['imagem']);
}else{
    $errors = [];
    http_response_code(400); // Not Found
    $errors["error"] = 'faltan parametros';
    echo json_encode($errors);
}

?>