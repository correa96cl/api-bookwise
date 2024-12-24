# api-bookwise

php -S localhost:8888 -d auto_prepend_file=server.php -t public/

php -S localhost:8888


# REST API Bookwise application


The REST API to the example app is described below.

## Get list of Books

### Request

`GET /get_books/`

    curl -i -H 'Accept: application/json'  http://localhost:8888/get_books/

### Response

    HTTP/1.1 200 OK
    Date: Thu, 24 Feb 2011 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: 2

    [{
        "id": 44,
        "titulo": "Livro 1",
        "author": "Author 1",
        "descricao": "Livro muito interesante",
        "ano_de_lancamento": 2025,
        "usuario_id": 20,
        "imagem": "images/.f35518288e1b4b686a1ec95ec7c505b2.png"
    },
    {
        "id": 53,
        "titulo": "Livro 2",
        "author": "Author 2",
        "descricao": "Livro muito interesante2",
        "ano_de_lancamento": 2025,
        "usuario_id": 20,
        "imagem": "images/.f35518288e1b4b686a1ec95ec7c505b2.png"
    }]

## Create a new Book

### Request

`POST /create_book?titulo=Livro 3&author=Author 3&descricao=Livro muito interesante 3&ano_de_lancamento=2025&usuario_id=20&imagem=images/.f35518288e1b4b686a1ec95ec7c505b2.png`

    curl -i -H 'Accept: application/json' -d 'name=Foo&status=new' http://localhost:8888/create_book?titulo=Livro 3&author=Author 3&descricao=Livro muito interesante 3&ano_de_lancamento=2025&usuario_id=20&imagem=images/.f35518288e1b4b686a1ec95ec7c505b2.png

### Response

    HTTP/1.1 201 Created
    Date: Thu, 24 Feb 2011 12:36:30 GMT
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Location: /thing/1
    Content-Length: 36

    {"success": "Libro creado con éxito. 54"}

## Get a specific Book

### Request

`GET /get_book?id=53`

    curl -i -H 'Accept: application/json' http://localhost:8888/get_book?id=53

### Response

    HTTP/1.1 200 OK
    Date: Thu, 24 Feb 2011 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: 36

    {"id":1,"name":"Foo","status":"new"}

## Delete Book By Id

### Request

`DELETE /delete_book?id=53`

    curl -i -H 'Accept: application/json' http://localhost:8888/delete_book?id=53

### Response

    HTTP/1.1 404 Not Found
    Date: Thu, 24 Feb 2011 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: 35

    {"success": "Livro excluido com sucesso"}

## Update Book By Id

### Request

`PUT /update_book?id=53&titulo=Cagon2233232&author=Kamala Harris2232323&descricao=Livro muito interesante2232323&ano_de_lancamento=202&usuario_id=20&imagem=images/.f35518288e1b4b686a1ec95ec7c505b2.png`

    curl -i -H 'Accept: application/json' -d 'name=Bar&junk=rubbish' http://localhost:8888/update_book?id=53&titulo=Cagon2233232&author=Kamala Harris2232323&descricao=Livro muito interesante2232323&ano_de_lancamento=202&usuario_id=20&imagem=images/.f35518288e1b4b686a1ec95ec7c505b2.png

### Response

    HTTP/1.1 200 OK
    Date: Thu, 24 Feb 2011 12:36:31 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Location: /thing/2
    Content-Length: 35

    {"success": "Livro atualizado com sucesso"}
