<?php

require_once('../includes/Book.class.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    Book::getBooks();
}  

?>