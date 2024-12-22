<?php

class Validacao
{
    public static function validateBookData($data)
    {
        $errors = [];

        // Validações básicas
        if (empty($data['titulo'])) {
            $errors['titulo'] = 'El título es obligatorio.';
        }
        if (empty($data['author'])) {
            $errors['author'] = 'El autor es obligatorio.';
        }
        // Validações más específicas (ajusta según tus necesidades)
        if (!is_numeric($data['ano_de_lancamento'])) {
            $errors['ano_de_lancamento'] = 'El año de lanzamiento debe ser un número.';
        }
        if ($data['ano_de_lancamento'] < 1900) {
            $errors['ano_de_lancamento'] = 'El año de lanzamiento debe ser posterior a 1900.';
        }


        if (strlen($data['ano_de_lancamento']) > 4) {
            $errors['ano_de_lancamento'] = 'El año de lanzamiento debe tener un número de cuatro dígitos.';
        }


        if (empty($data['imagem'])) {
            $errors['imagem'] = 'La imagen es obligatoria.';
        }


        return $errors;
    }


    public static function validateBookUpdateData($data)
    {
        $errors = [];

        // Validações básicas

        if (empty($data['id'])) {
            $errors['id'] = 'El id es obligatorio.';

        }
        if (empty($data['titulo'])) {
            $errors['titulo'] = 'El título es obligatorio.';
        }
        if (empty($data['author'])) {
            $errors['author'] = 'El autor es obligatorio.';
        }
        // Validações más específicas (ajusta según tus necesidades)
        if (!is_numeric($data['ano_de_lancamento'])) {
            $errors['ano_de_lancamento'] = 'El año de lanzamiento debe ser un número.';
        }
        if ($data['ano_de_lancamento'] < 1900) {
            $errors['ano_de_lancamento'] = 'El año de lanzamiento debe ser posterior a 1900.';
        }


        if (strlen($data['ano_de_lancamento']) > 4) {
            $errors['ano_de_lancamento'] = 'El año de lanzamiento debe tener un número de cuatro dígitos.';
        }


        if (empty($data['imagem'])) {
            $errors['imagem'] = 'La imagen es obligatoria.';
        }


        return $errors;
    }

    public static function validarIdBook($id)
    {
        $errors = [];

        if (!is_numeric($id)) {
            $errors["error"] = 'El id debe ser un número.';
        }

        if (empty($id)) {
            $errors['error'] = "El parametro Id viene nulo";
        }



        return $errors;
    }
}
