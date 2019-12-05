<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Acess-Control-Allow-Methods: POST');
    header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers, Content-Type, Acess-Control-Allow-Methods, Authorizantion, X-Request-With');


    include_once '../../Backend/config/Database.php';
    include_once '../../Backend/models/JogosUsados.php';

    $database = new Database();
    $db = $database->connect();

    $jogousado = new JogosUsados($db);

    $data = json_decode(file_get_contents("php://input"));

    $jogousado->id = $data->id;
    $jogousado->nome = $data->nome;
    $jogousado->preco = $data->preco;
    $jogousado->avaliacao = $data->avaliacao; 

    if($jogousado->create()){
        echo json_encode(
            array('message' => 'Post Criado')
        );
    }
    else {
        echo json_encode(
            array('massage' => 'Post Não Criado')
        );
    } 

