<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../../Backend/config/Database.php';
    include_once '../../../Backend/models/JogosUsados.php';

    $database = new Database();
    $db = $database->connect();

    $jogousado = new JogosUsados($db);

    $result = $jogousado->read();

    $num = $result->rowCount();

    if($num > 0) {

        $jogousados_arr = array();
        $jogousados_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {

            extract($row);

            $jogousado_item = array(

                'id' => $id,
                'nome' => $nome,
                'preco' => $preco,
                'avaliacao' => $avaliacao
            );

            array_push($jogousados_arr['data'], $jogousado_item);

        }

        echo json_encode($jogousados_arr);

    }

    else {

        echo json_encode(
            array('message' => 'Não foram encontrados jogos usados.')
        );
        
    }