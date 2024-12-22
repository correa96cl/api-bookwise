<?php

require_once('../includes/Book.class.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){

    Book::getBook($_GET['id']);
}else{
    $errors = [];
    $errors["error"] = 'Nao se mandou nenhum parametro';
    echo json_encode($errors);
}  

?>