<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["numero"])) {
    $numero = $_GET["numero"];

    // Verificar si se proporcionó un número válido
    if (!is_numeric($numero)) {
        echo json_encode(["error" => "Por favor, proporcione un número válido."]);
        exit;
    }

    // Determinar si el número es positivo, negativo o cero
    if ($numero > 0) {
        $resultado = "positivo";
    } elseif ($numero < 0) {
        $resultado = "negativo";
    } else {
        $resultado = "cero";
    }

    // Devolver el resultado como JSON
    echo json_encode(["resultado" => $resultado]);
} else {
    // Si el parámetro no es válido, devolver un error
    echo json_encode(["error" => "Por favor, proporcione un número como parámetro."]);
}
