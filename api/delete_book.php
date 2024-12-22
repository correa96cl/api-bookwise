<?php

require_once('../includes/Book.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {

    Book::deleteBook($_GET['id']);

}else{
    $errors = [];
    http_response_code(400); // Not Found
    $errors["error"] = 'faltan parametros';
    echo json_encode($errors);
}

?>