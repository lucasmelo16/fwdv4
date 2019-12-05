<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/JogosUsados.php';

    $database = new Database();
    $db = $database->connect();

    $jogousado = new JogosUsados($db);

    