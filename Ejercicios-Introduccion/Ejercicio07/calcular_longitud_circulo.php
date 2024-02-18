<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["radio"])) {
    $radio = $_GET["radio"];

    // Calcular la longitud del círculo
    $longitud = 2 * M_PI * $radio;

    // Devolver el resultado como JSON
    echo json_encode(["longitud" => $longitud]);
} else {
    // Si el parámetro no es válido, devolver un error
    echo json_encode(["error" => "Parámetro incorrecto"]);
}
