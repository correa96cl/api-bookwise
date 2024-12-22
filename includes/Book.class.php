<?php


require_once('Database.php');
require_once('config.php');
require_once('Validacao.php');

class Book
{
    public static function create_book($titulo, $author, $descricao, $ano_de_lancamento, $usuario_id, $imagem)
    {
        $data = compact('titulo', 'author', 'descricao', 'ano_de_lancamento', 'usuario_id', 'imagem');
        $errors = Validacao::validateBookData($data);

        if (!empty($errors)) {

            echo json_encode($errors);
            http_response_code(400); // Not Found
            header('Content-Type: application/json');
            return ['errors' => $errors];
        }

        $database = new Database(config('database'));
        try {
            $database->query(
                query: "
        insert into livros (titulo, author, descricao, ano_de_lancamento, usuario_id, imagem)
        values ( :titulo, :author, :descricao, :ano_de_lancamento, :usuario_id, :imagem)",
                params: $data
            );
            http_response_code(200); // Internal Server Error
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Libro creado con éxito. ' . $database->lastInsertId()]);
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Erro ao criar um livro: Ocurreu um erro ao momento de criar books. Error: ' . $e->getMessage()]);
        }
    }


    public static function update_book($id, $titulo, $author, $descricao, $ano_de_lancamento, $usuario_id, $imagem)
    {
        $data = compact('id', 'titulo', 'author', 'descricao', 'ano_de_lancamento', 'usuario_id', 'imagem');
        $errors = Validacao::validateBookUpdateData($data);

        if (self::validarBook($id) && empty($errors)) {
            $errors['error'] = 'Livro nao encontrado';
        }

        if (!empty($errors)) {
            echo json_encode($errors);
            http_response_code(400); // Not Found
            header('Content-Type: application/json');
            return ['errors' => $errors];
        }


        $database = new Database(config('database'));
        try {
            $database->query(
                query: "
        update livros set titulo = :titulo, author = :author, descricao = :descricao, ano_de_lancamento = :ano_de_lancamento, usuario_id = :usuario_id, imagem = :imagem where id = :id",
                params: $data
            );

            http_response_code(200); // Not Found
            echo json_encode(['success' => 'Livro atualizado com sucesso']);
            header('Content-Type: application/json');
            return ['errors' => $errors];

        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Erro ao criar um livro: Ocurreu um erro ao momento de criar books. Error: ' . $e->getMessage()]);        }
    }

    public static function getBooks()
    {
        $database = new Database(config('database'));

        try {
            $books = $database->query(query: "select * from livros")->fetchAll(PDO::FETCH_ASSOC);

            if ($books) {
                http_response_code(200); // OK
                header('Content-Type: application/json');
                echo json_encode($books);
            } else {
                http_response_code(400); // Not Found
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Livros nao encontrados']);
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Erro ao buscar livros: Ocurreu um erro ao momento de procurar books']);
        }
    }

    public static function getBook($id)
    {
        $database = new Database(config('database'));
        $errors = Validacao::validarIdBook($id);

        try {
            if (empty($errors)) {
                $book = $database->query(query: "select * from livros where id = :id", params: ['id' => $id])->fetch(PDO::FETCH_ASSOC);
                if ($book) {
                    http_response_code(200); // OK
                    header('Content-Type: application/json');
                    echo json_encode($book);
                } else {
                    http_response_code(400); // Not Found
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Livro com id ' . $id . ' nao encontrado']);
                }
            } else {
                http_response_code(400); // Not Found
                header('Content-Type: application/json');
                echo json_encode($errors);
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Erro ao buscar livros: Ocurreu um erro ao momento de procurar books']);
        }
    }
    public static function deleteBook($id)
    {
        $errors = Validacao::validarIdBook($id);
        if (self::validarBook($id) && empty($errors)) {
            $errors['error'] = 'Livro nao encontrado';
        }

        if (!empty($errors)) {
            echo json_encode($errors);
            http_response_code(400); // Not Found
            header('Content-Type: application/json');
            return ['errors' => $errors];
        }
        try {
            $database = new Database(config('database'));

            $database->query(query: "delete from livros where id = :id", params: ['id' => $id]);
            http_response_code(200); // Not Found
            echo json_encode(['success' => 'Livro excluido com sucesso']);
            header('Content-Type: application/json');
            return ['errors' => $errors];
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Erro ao buscar livros: Ocurreu um erro ao momento de procurar books' . $e->getMessage()]);
            return ['status' => 500, 'message' => 'Erro ao excluir livro: ' . $e->getMessage()];
        }
    }


    private static function validarBook($id)
    {
        $database = new Database(config('database'));
        try {

            $book = $database->query(query: "select * from livros where id = :id", params: ['id' => $id])->fetch(PDO::FETCH_ASSOC);
            if (!$book) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Erro ao buscar livros: Ocurreu um erro ao momento de procurar books']);
        }
    }
}
