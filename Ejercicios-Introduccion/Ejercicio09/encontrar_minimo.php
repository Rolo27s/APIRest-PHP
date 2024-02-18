<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["numeros"])) {
    $numeros = json_decode($_GET["numeros"]);

    // Verificar si se proporcionaron números válidos
    if (!is_array($numeros) || empty($numeros)) {
        echo json_encode(["error" => "Por favor, proporcione un conjunto válido de números."]);
        exit;
    }

    // Encontrar el mínimo de los números
    $minimo = min($numeros);

    // Devolver el resultado como JSON
    echo json_encode(["minimo" => $minimo]);
} else {
    // Si el parámetro no es válido, devolver un error
    echo json_encode(["error" => "Por favor, proporcione un conjunto de números como parámetro."]);
}
