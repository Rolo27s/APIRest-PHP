<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["lado"])) {
    $lado = $_GET["lado"];

    // Calcular la longitud del perímetro del cuadrado
    $perimetro = 4 * $lado;

    // Devolver el resultado como JSON
    echo json_encode(["perimetro" => $perimetro]);
} else {
    // Si el parámetro no es válido, devolver un error
    echo json_encode(["error" => "Parámetro incorrecto"]);
}
?>
