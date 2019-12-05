<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../../Backend/config/Database.php';
    include_once '../../../Backend/models/JogosUsados.php';

    $database = new Database();
    $db = $database->connect();

    $jogousado = new JogosUsados($db);

    $jogousado->id = isset($_GET['id']) ? $_GET['id'] : die();

    $jogousado->read_single();

    $jogousado_arr = array(
        'id' => $jogousado->id,
        'nome' => $jogousado->nome,
        'preco' => $jogousado->preco,
        'avaliacao' => $jogousado->avaliacao
    );

    print_r(json_encode($jogousado_arr));

    